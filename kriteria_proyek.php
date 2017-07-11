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
if (isset($_GET['pesan_error'])) {
    $pesan_error = $_GET['pesan_error'];
}
if (isset($_GET['pesan_success'])) {
    $pesan_success = $_GET['pesan_success'];
}

$IdProyek = 0;
if (isset($_REQUEST['proyekId'])) {
    $IdProyek = $_REQUEST['proyekId'];
    $kriteria_row = $db_object->find_in_table("proyek", "*", "WHERE id = " . $IdProyek);
}

//action tombol check
if (isset($_POST['check'])) {
    $val_sql = array();
    foreach ($_POST['ceker'] as $key => $value) {
        $val_sql[] = "(\"" . $IdProyek . "\", \"" . ($value) . "\")";
    }

    $sql_value = implode(",", $val_sql);
    $sql1 = "INSERT INTO kriteria_proyek "
            . " (proyek_id, kriteria_id) "
            . " VALUES " . $sql_value;
    $result1 = $db_object->db_query($sql1);
    if ($result1) {
        ?>
        <script> location.replace("?menu=kriteria_proyek&proyekId=<?php echo $IdProyek; ?>&pesan_success=Data berhasil disimpan");</script>
        <?php
    } else {
        ?>
        <script> location.replace("?menu=kriteria_proyek&proyekId=<?php echo $IdProyek; ?>&pesan_error=Data gagal disimpan");</script>
        <?php
    }
}

if (isset($_POST['uncheck'])) {
    $val_sql = array();
    foreach ($_POST['unceker'] as $key => $value) {
        $val_sql[] = $value;
    }
    $sql_value = implode(",", $val_sql);
    $sql1 = "DELETE FROM kriteria_proyek "
            . " WHERE proyek_id = " . $IdProyek
            . " AND kriteria_id IN (" . $sql_value . ")";
    $result1 = $db_object->db_query($sql1);
    if ($result1) {
        ?>
        <script> location.replace("?menu=kriteria_proyek&proyekId=<?php echo $IdProyek; ?>&pesan_success=Data berhasil disimpan");</script>
        <?php
    } else {
        ?>
        <script> location.replace("?menu=kriteria_proyek&proyekId=<?php echo $IdProyek; ?>&pesan_error=Data gagal disimpan");</script>
        <?php
    }
}


$sql = "SELECT
            kr.*,
            sub_kr.`sub_kriteria`
          FROM
            kriteria kr,
            sub_kriteria sub_kr 
          WHERE 
          sub_kr.`id_kriteria` = kr.`id` ";
if(!empty($_POST['kriteria'])){
    $sql .= " AND kr.kriteria_nama LIKE '%".$_POST['kriteria']."%' ";
}
if(!empty($_POST['kriteria_code'])){
    $sql .= " AND kr.kriteria_code LIKE '%".$_POST['kriteria_code']."%' ";
}
if(!empty($_POST['sub_kriteria'])){
    $sql .= " AND sub_kr.sub_kriteria LIKE '%".$_POST['sub_kriteria']."%' ";
}
$sql .= " ORDER BY kr.id";

$query = $db_object->db_query($sql);
$jumlah = $db_object->db_num_rows($query);
?>
<div class="main">
    <div class="container">
        <div class="row margin-bottom-35 ">
            <!-- BEGIN CONTENT -->
            <!--<div class="col-md-9 col-sm-7">-->
            <h1>Kriteria Proyek <?php echo $kriteria_row['nama_proyek']; ?></h1>
            <?php
            if (!empty($pesan_error)) {
                display_error($pesan_error);
            }
            if (!empty($pesan_success)) {
                display_success($pesan_success);
            }
            ?>

            <div class="content-form-page">
                <a href="index.php?menu=proyek" class="btn btn-default">
                    <img src="assets/images/icon/enter.png" /> back
                </a>
                <form role="form" class="form-horizontal form-without-legend" method="post" action="">

                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <input type="text" name="kriteria" id="first-name" class="form-control"
                                       value="<?php echo (!empty($_POST['kriteria'])) ? $_POST['kriteria'] : ""; ?>"
                                       placeholder="Kriteria">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="kriteria_code" id="first-name" class="form-control"
                                       value="<?php echo (!empty($_POST['kriteria_code'])) ? $_POST['kriteria_code'] : ""; ?>" 
                                       placeholder="Kriteria Code">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="sub_kriteria" id="first-name" class="form-control"
                                       value="<?php echo (!empty($_POST['sub_kriteria'])) ? $_POST['sub_kriteria'] : ""; ?>" 
                                       placeholder="Sub-kriteria">
                            </div>
                            <div class="col-sm-3">
                                <button class="btn btn-primary" name="Search_filter" type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                    <br><br>

                    <div class="row">
                        <input type="hidden" value="<?php echo $IdProyek; ?>" name="proyekId"/>                    
                        <table class='table table-bordered table-striped table-hover' style="width: 100%;">
                            <tr>
                                <th>No</th>
                                <th>Kriteria Kode</th>
                                <th>Kriteria</th>
                                <th>Sub-Kriteria</th>
                                <th><button class="btn btn-primary" name="check" type="submit">Check</button></th>
                                <th><button class="btn btn-primary" name="uncheck" type="submit">UnCheck</button></th>
                            </tr>
                            <?php
                            $no = 1;
                            $podo = "";
                            while ($row = $db_object->db_fetch_array($query)) {
                                echo "<tr>";
                                if ($podo == $row['id']) {
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>" . $row['sub_kriteria'] . "</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                } else {
                                    echo "<td>" . $no . "</td>";
                                    echo "<td>" . $row['kriteria_code'] . "</td>";
                                    echo "<td>" . $row['kriteria_nama'] . "</td>";
                                    echo "<td>" . $row['sub_kriteria'] . "</td>";
                                    
                                    $sql = "SELECT * FROM kriteria_proyek
                                            WHERE proyek_id = ".$IdProyek." AND kriteria_id = ".$row['id'];
                                    $res_cek = $db_object->db_query($sql);
                                    $ada = $db_object->db_num_rows($res_cek);
                                    if ($ada > 0) {
                                            echo "<td><center>Cheked</center></td>";
                                        echo "<td>"
                                        . "<center>"
                                        . " <input type='checkbox' name='unceker[" . $row['id'] . "]' value='" . $row['id'] . "'/>"
                                        . "</center>"
                                        . "</td>";
                                    } 
                                    else {
                                        echo "<td>"
                                        . "<center>"
                                        . " <input type='checkbox' name='ceker[" . $row['id'] . "]' value='" . $row['id'] . "'/>"
                                        . "</center>"
                                        . "</td>";
                                        echo "<td><center>UnCheked</center></td>";
                                    }

                                    $no++;
                                }
                                echo "</tr>";
                                $podo = $row['id'];
                            }
                            ?>
                        </table>
                </form>
            </div>
        </div>
        <!--</div>-->
        <!-- END CONTENT -->
    </div>        

</div>
</div>