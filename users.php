<?php
//session_start();
if (!isset($_SESSION['topsis_kontraktor_id'])) {
    header("location:index.php?menu=forbidden");
}

include_once "database.php";
include_once "fungsi.php";

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
    $sql1 = "INSERT INTO users "
            . " (username, nama, password, akses)"
            . " VALUES (\"".$_POST['username']."\" , \"".$_POST['nama']."\", \"".md5($_POST['password'])."\", \"".$_POST['akses']."\")";
    $result1 = $db_object->db_query($sql1);

    if($result1 ){
        ?>
        <script> location.replace("?menu=users&pesan_success=Data berhasil disimpan");</script>
        <?php
    }
    else{
        ?>
        <script> location.replace("?menu=users&pesan_error=Data gagal disimpan");</script>
        <?php
    }
}

if(isset($_POST['update'])){
    $sql1 = "UPDATE users "
            . " SET "
            . " username = \"".$_POST['username']."\" , "
            . " nama = \"".$_POST['nama']."\" , ";
    if(!empty($_POST['password'])){
        $sql1 .= " password = \"".md5($_POST['password'])."\" , ";
    }
    $sql1 .= " akses = \"".$_POST['akses']."\"  "    
            . " WHERE id = ".$_POST['id_edit'];
    $result1 = $db_object->db_query($sql1);

    if($result1 ){
        ?>
        <script> location.replace("?menu=users&pesan_success=Data berhasil disimpan");</script>
        <?php
    }
    else{
        ?>
        <script> location.replace("?menu=users&pesan_error=Data gagal disimpan");</script>
        <?php
    }
}

if (isset($_GET['delete'])) {
    $id_delete = $_GET['delete'];
    
    $sql = "DELETE FROM users WHERE id=".$id_delete;
    $db_object->db_query($sql);
    ?>
    <script> location.replace("?menu=users&pesan_success=Data berhasil dihapus");</script>
    <?php
}

if(isset($_GET['edit'])){
    $id_edit = $_GET['edit'];
    $sql = "SELECT * FROM users WHERE id = ".$id_edit;
    $result = $db_object->db_query($sql);
    $row_edit = $db_object->db_fetch_array($result);
}


$sql = "SELECT
        *
        FROM
         users ";
$query=$db_object->db_query($sql);
$jumlah=$db_object->db_num_rows($query);
?>
<div class="main">
    <div class="container">
        <div class="row margin-bottom-35 ">
            <!-- BEGIN CONTENT -->
            <!--<div class="col-md-9 col-sm-7">-->
                <h1>Master User</h1>
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
                            <label class="col-lg-2 control-label" for="first-name">Username
                                <span class="require">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="username" id="first-name" class="form-control"
                                       value="<?php echo (!empty($row_edit))?$row_edit['username']:""; ?>" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="first-name">Nama
                                <span class="require">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="nama" id="first-name" class="form-control"
                                       value="<?php echo (!empty($row_edit))?$row_edit['nama']:""; ?>" required="">
                            </div>
                        </div>
                        <div class="form-group">
                        <?php
                         text_with_list_levels("Level", 'akses', $row_edit['akses'], true, true, '-');
                        ?>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="first-name">Password
                                <span class="require">*</span></label>
                            <div class="col-lg-8">
                                <input type="password" name="password" id="first-name" class="form-control" 
                                        <?php if(empty($row_edit)){ echo  "required=''"; }?> />
                            </div>
                        </div>
                        <div class="row">`
                            <div class="col-lg-8 col-md-offset-2 padding-left-0 padding-top-20">
                                <?php
                        if(!empty($row_edit)){
                            ?>
                            <input type="hidden" value="<?php echo $row_edit['id']; ?>" name="id_edit"/>
                            <a href="index.php?menu=users" class="btn btn-default">cancel</a>
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
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th></th>
                        </tr>
                        <?php
                            $no=1;
                            while($row=$db_object->db_fetch_array($query)){
                                echo "<tr>";
                                    echo "<td>".$no."</td>";
                                    echo "<td>".$row['username']."</td>";
                                    echo "<td>".$row['nama']."</td>";
                                    echo "<td>".get_level_name($row['akses'])."</td>";
                                    echo "<td>"
                                            ." <a href='?menu=users&edit=".$row['id']."'>"
                                            . "<img src='assets/images/icon/edit.gif'/></a>"
                                            ."&nbsp;&nbsp;&nbsp;"
                                            . "<a href='?menu=users&delete=".$row['id']."' onclick=\"return confirm('are you sure?')\">"
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