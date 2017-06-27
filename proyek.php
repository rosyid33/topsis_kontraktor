<?php
//session_start();
if (!isset($_SESSION['topsis_kontraktor_id'])) {
    header("location:index.php?menu=forbidden");
}

include_once "database.php";
include_once "fungsi.php";
include_once "import/excel_reader2.php";

//object database class
$db_object = new database();

$pesan_error = $pesan_success = "";
if(isset($_GET['pesan_error'])){
    $pesan_error = $_GET['pesan_error'];
}
if(isset($_GET['pesan_success'])){
    $pesan_success = $_GET['pesan_success'];
}


//action
if (isset($_POST['save'])) {
    $sql1 = "INSERT INTO proyek "
            . " (nama_proyek)"
            . " VALUES (\"".$_POST['nama_proyek']."\")";
    $result1 = $db_object->db_query($sql1);

    if($result1 ){
        ?>
        <script> location.replace("?menu=proyek&pesan_success=Data berhasil disimpan");</script>
        <?php
    }
    else{
        ?>
        <script> location.replace("?menu=proyek&pesan_error=Data gagal disimpan");</script>
        <?php
    }
}

if(isset($_POST['update'])){
    $sql1 = "UPDATE proyek "
            . " SET nama_proyek = \"".$_POST['nama_proyek']."\" "
            . " WHERE id = ".$_POST['id_edit'];
    $result1 = $db_object->db_query($sql1);

    if($result1 ){
        ?>
        <script> location.replace("?menu=proyek&pesan_success=Data berhasil disimpan");</script>
        <?php
    }
    else{
        ?>
        <script> location.replace("?menu=proyek&pesan_error=Data gagal disimpan");</script>
        <?php
    }
}

if (isset($_GET['delete'])) {
    $id_delete = $_GET['delete'];
    
    $sql = "DELETE FROM proyek WHERE id=".$id_delete;
    $db_object->db_query($sql);
    ?>
    <script> location.replace("?menu=proyek&pesan_success=Data berhasil dihapus");</script>
    <?php
}

if(isset($_GET['edit'])){
    $id_edit = $_GET['edit'];
    $sql = "SELECT * FROM proyek WHERE id = ".$id_edit;
    $result = $db_object->db_query($sql);
    $row_edit = $db_object->db_fetch_array($result);
}


$sql = "SELECT
        *
        FROM
         proyek";
$query=$db_object->db_query($sql);
$jumlah=$db_object->db_num_rows($query);
?>
<div class="main">
    <div class="container">
        <div class="row margin-bottom-35 ">
            <!-- BEGIN CONTENT -->
            <!--<div class="col-md-9 col-sm-7">-->
                <h1>Master Proyek</h1>
                <?php
                if (!empty($pesan_error)) {
                    display_error($pesan_error);
                }
                if (!empty($pesan_success)) {
                    display_success($pesan_success);
                }
                ?>
                <div class="content-form-page">
                    <form role="form" class="form-horizontal form-without-legend" method="post" action="">
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="first-name">Nama Proyek
                                <span class="require">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="nama_proyek" id="first-name" class="form-control"
                                       value="<?php echo (!empty($row_edit))?$row_edit['nama_proyek']:""; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-offset-2 padding-left-0 padding-top-20">
                                <?php
                        if(!empty($row_edit)){
                            ?>
                            <input type="hidden" value="<?php echo $row_edit['id']; ?>" name="id_edit"/>
                            <button class="btn btn-primary" name="update" type="submit">Update</button>
                            <?php
                        }
                        else{
                            ?>
                            <button class="btn btn-primary" name="save" type="submit">Save</button>
                            <?php
                        }
                        ?>
                                
                            </div>
                        </div>
                    </form>
                    <br>
                    <table class='table table-bordered table-striped  table-hover' style="width: 40%;">
                        <tr>
                        <th>No</th>
                        <th>Proyek</th>
                        <th></th>
                        </tr>
                        <?php
                            $no=1;
                            while($row=$db_object->db_fetch_array($query)){
                                echo "<tr>";
                                    echo "<td>".$no."</td>";
                                    echo "<td>".$row['nama_proyek']."</td>";
                                    echo "<td>"
                                            ." <a href='?menu=proyek&edit=".$row['id']."'>"
                                            . "<img src='assets/images/icon/edit.gif'/></a>"
                                            ."&nbsp;&nbsp;&nbsp;"
                                            . "<a href='?menu=proyek&delete=".$row['id']."' onclick=\"return confirm('are you sure?')\">"
                                            . "<img src='assets/images/icon/delete.gif'/></a>"
                                        . "</td>";
                                echo "</tr>";
                                $no++;
                            }
                            ?>
                    </table>
                </div>
            <!--</div>-->
            <!-- END CONTENT -->
        </div>        

    </div>
</div>