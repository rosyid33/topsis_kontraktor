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

$IdKriteria = 0;
if(isset($_REQUEST['kriteriaId'])){
    $IdKriteria = $_REQUEST['kriteriaId'];
    $kriteria_row = $db_object->find_in_table("kriteria", "*", "WHERE id = ".$IdKriteria);
}


//action
if (isset($_POST['save'])) {
    $can_process = true;
    
    $sql = "SELECT id FROM sub_kriteria "
            . " WHERE id_kriteria = '".$IdKriteria."' "
            . " AND sub_kriteria = \"".$db_object->db_real_escape_string($_POST['sub_kriteria'])."\"";
    $result = $db_object->db_query($sql);
    $thereis = $db_object->db_num_rows($result);
    $rowCek = $db_object->db_fetch_array($result);
    if($thereis > 0){
        $can_process = false;
        ?>
        <script> location.replace("?menu=sub_kriteria&kriteriaId=<?php echo $IdKriteria; ?>&pesan_error=Kode sudah ada");</script>
        <?php
    }
    
    
    if($can_process){
        $sql1 = "INSERT INTO sub_kriteria "
                . " (id_kriteria, sub_kriteria)"
                . " VALUES (\"".$IdKriteria."\", \"".$db_object->db_real_escape_string($_POST['sub_kriteria'])."\")";
        $result1 = $db_object->db_query($sql1);

        if($result1 ){
            ?>
            <script> location.replace("?menu=sub_kriteria&kriteriaId=<?php echo $IdKriteria; ?>&pesan_success=Data berhasil disimpan");</script>
            <?php
        }
        else{
            ?>
            <script> location.replace("?menu=sub_kriteria&kriteriaId=<?php echo $IdKriteria; ?>&pesan_error=Data gagal disimpan");</script>
            <?php
        }
    }
}

if(isset($_POST['update'])){
    $can_process = true;
    
    $sql = "SELECT id FROM sub_kriteria "
            . " WHERE id_kriteria = '".$IdKriteria."' "
            . " AND sub_kriteria = \"".$db_object->db_real_escape_string($_POST['sub_kriteria'])."\" ";
    $result = $db_object->db_query($sql);
    $thereis = $db_object->db_num_rows($result);
    $rowCek = $db_object->db_fetch_array($result);
    if($thereis > 0 && $rowCek['id']!=$_POST['id_edit']){
        $can_process = false;
        ?>
        <script> location.replace("?menu=sub_kriteria&kriteriaId=<?php echo $IdKriteria; ?>&pesan_error=data sudah ada");</script>
        <?php
    }
    
    if($can_process){
        $sql1 = "UPDATE sub_kriteria "
                . " SET sub_kriteria = \"".$db_object->db_real_escape_string($_POST['sub_kriteria'])."\" "
                . " WHERE id = ".$_POST['id_edit'];
        $result1 = $db_object->db_query($sql1);

        if($result1 ){
            ?>
            <script> location.replace("?menu=sub_kriteria&kriteriaId=<?php echo $IdKriteria; ?>&pesan_success=Data berhasil disimpan");</script>
            <?php
        }
        else{
            ?>
            <script> location.replace("?menu=sub_kriteria&kriteriaId=<?php echo $IdKriteria; ?>&pesan_error=Data gagal disimpan");</script>
            <?php
        }
    }
}

if (isset($_GET['delete'])) {
    $id_delete = $_GET['delete'];
    
    $sql = "DELETE FROM sub_kriteria WHERE id=".$id_delete;
    $db_object->db_query($sql);
    ?>
    <script> location.replace("?menu=sub_kriteria&kriteriaId=<?php echo $IdKriteria; ?>&pesan_success=Data berhasil dihapus");</script>
    <?php
}

if(isset($_GET['edit'])){
    $id_edit = $_GET['edit'];
    $sql = "SELECT * FROM sub_kriteria WHERE id = ".$id_edit;
    $result = $db_object->db_query($sql);
    $row_edit = $db_object->db_fetch_array($result);
}


$sql = "SELECT
        *
        FROM
         sub_kriteria WHERE id_kriteria = ".$IdKriteria;
$query=$db_object->db_query($sql);
$jumlah=$db_object->db_num_rows($query);
?>
<div class="main">
    <div class="container">
        <div class="row margin-bottom-35 ">
            <!-- BEGIN CONTENT -->
            <!--<div class="col-md-9 col-sm-7">-->
                <h1>Sub Kriteria <?php echo $kriteria_row['kriteria_code']." - ".$kriteria_row['kriteria_nama']; ?></h1>
                <?php
                if (!empty($pesan_error)) {
                    display_error($pesan_error);
                }
                if (!empty($pesan_success)) {
                    display_success($pesan_success);
                }
                ?>
                
                <div class="content-form-page">
                    <a href="index.php?menu=kriteria" class="btn btn-default">
                        <img src="assets/images/icon/enter.png" /> back
                    </a>
                    <form role="form" class="form-horizontal form-without-legend" method="post" action="">
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="first-name">Sub-Kriteria
                                <span class="require">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="sub_kriteria" id="first-name" class="form-control"
                                       value="<?php echo (!empty($row_edit))?$row_edit['sub_kriteria']:""; ?>" required="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-offset-2 padding-left-0 padding-top-20">
                                <input type="hidden" value="<?php echo $IdKriteria; ?>" name="kriteriaId"/>
                                <?php
                                if(!empty($row_edit)){
                                    ?>
                                    <input type="hidden" value="<?php echo $row_edit['id']; ?>" name="id_edit"/>
                                    <a href="index.php?menu=sub_kriteria&kriteriaId=<?php echo $IdKriteria; ?>" class="btn btn-default">cancel</a>
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
                    <table class='table table-bordered table-striped  table-hover' style="width: 90%;">
                        <tr>
                        <th>No</th>
                        <th>Sub-Kriteria</th>
                        <th></th>
                        </tr>
                        <?php
                            $no=1;
                            while($row=$db_object->db_fetch_array($query)){
                                echo "<tr>";
                                    echo "<td>".$no."</td>";
                                    echo "<td>".$row['sub_kriteria']."</td>";
                                    echo "<td>"
                                            ." <a href='?menu=sub_kriteria&kriteriaId=".$IdKriteria."&edit=".$row['id']."'>"
                                            . "<img src='assets/images/icon/edit.gif'/></a>"
                                            ."&nbsp;&nbsp;&nbsp;"
                                            . "<a href='?menu=sub_kriteria&kriteriaId=".$IdKriteria."&delete=".$row['id']."' "
                                            . " onclick=\"return confirm('are you sure?')\">"
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