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
    $can_process = true;
    
    $sql = "SELECT nama_kontraktor FROM kontraktor "
            . " WHERE nama_kontraktor = '".$_POST['nama_kontraktor']."' ";
    $result = $db_object->db_query($sql);
    $thereis = $db_object->db_num_rows($result);
    if($thereis > 0){
        $can_process = false;
        ?>
        <script> location.replace("?menu=kontraktor&pesan_error=Data sudah ada");</script>
        <?php
    }
    
    if($can_process){
        $sql1 = "INSERT INTO kontraktor "
                . " (nama_kontraktor, alamat, telepon)"
                . " VALUES (\"".$_POST['nama_kontraktor']."\", "
                . " \"".$_POST['alamat']."\", "
                . " \"".$_POST['telepon']."\" )";
        $result1 = $db_object->db_query($sql1);

        if($result1){
            ?>
            <script> location.replace("?menu=kontraktor&pesan_success=Data berhasil disimpan");</script>
            <?php
        }
        else{
            ?>
            <script> location.replace("?menu=kontraktor&pesan_error=Data gagal disimpan");</script>
            <?php
        }
    }
}

if(isset($_POST['update'])){
    $can_process = true;
    
    $sql = "SELECT id, nama_kontraktor FROM kontraktor "
            . " WHERE nama_kontraktor = '".$_POST['nama_kontraktor']."' ";
    $result = $db_object->db_query($sql);
    $thereis = $db_object->db_num_rows($result);
    $rowCek = $db_object->db_fetch_array($result);
    if($thereis > 0 && $rowCek['id']!=$_POST['id_edit']){
        $can_process = false;
        ?>
        <script> location.replace("?menu=kontraktor&pesan_error=Data sudah ada");</script>
        <?php
    }
    
    if($can_process){
        $sql1 = "UPDATE kontraktor "
                . " SET nama_kontraktor = \"".$_POST['nama_kontraktor']."\", "
                . " alamat = \"".$_POST['alamat']."\","
                . " telepon = \"".$_POST['telepon']."\" "
                . " WHERE id = ".$_POST['id_edit'];
        $result1 = $db_object->db_query($sql1);

        if($result1 ){
            ?>
            <script> location.replace("?menu=kontraktor&pesan_success=Data berhasil disimpan");</script>
            <?php
        }
        else{
            ?>
            <script> location.replace("?menu=kontraktor&pesan_error=Data gagal disimpan");</script>
            <?php
        }
    }
}

if (isset($_GET['delete'])) {
    $id_delete = $_GET['delete'];
    
    $sql = "DELETE FROM kontraktor WHERE id=".$id_delete;
    $db_object->db_query($sql);
    ?>
    <script> location.replace("?menu=kontraktor&pesan_success=Data berhasil dihapus");</script>
    <?php
}

if(isset($_GET['edit'])){
    $id_edit = $_GET['edit'];
    $sql = "SELECT * FROM kontraktor WHERE id = ".$id_edit;
    $result = $db_object->db_query($sql);
    $row_edit = $db_object->db_fetch_array($result);
}


$sql = "SELECT
        *
        FROM
         kontraktor";
$query=$db_object->db_query($sql);
$jumlah=$db_object->db_num_rows($query);
?>
<div class="main">
    <div class="container">
        <div class="row margin-bottom-35 ">
            <!-- BEGIN CONTENT -->
            <!--<div class="col-md-9 col-sm-7">-->
                <h1>Master Kontraktor</h1>
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
                            <label class="col-lg-2 control-label" for="first-name">Nama Kontraktor
                                <span class="require">*</span>
                            </label>
                            <div class="col-lg-8">
                                <input type="text" name="nama_kontraktor" id="first-name" class="form-control"
                                       value="<?php echo (!empty($row_edit))?$row_edit['nama_kontraktor']:""; ?>" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="first-name">Alamat
                            </label>
                            <div class="col-lg-8">
                                <textarea name="alamat" class="form-control" ><?php echo (!empty($row_edit))?$row_edit['alamat']:""; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="first-name">Telepon
                            </label>
                            <div class="col-lg-8">
                                <input type="text" name="telepon" id="first-name" class="form-control"
                                       value="<?php echo (!empty($row_edit))?$row_edit['telepon']:""; ?>">
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
                        <th>Nama Kontraktor</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th></th>
                        </tr>
                        <?php
                            $no=1;
                            while($row=$db_object->db_fetch_array($query)){
                                echo "<tr>";
                                    echo "<td>".$no."</td>";
                                    echo "<td>".$row['nama_kontraktor']."</td>";
                                    echo "<td>".$row['alamat']."</td>";
                                    echo "<td>".$row['telepon']."</td>";
                                    echo "<td>"
                                            ." <a href='?menu=kontraktor&edit=".$row['id']."'>"
                                            . "<img src='assets/images/icon/edit.gif'/></a>"
                                            ."&nbsp;&nbsp;&nbsp;"
                                            . "<a href='?menu=kontraktor&delete=".$row['id']."' onclick=\"return confirm('are you sure?')\">"
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