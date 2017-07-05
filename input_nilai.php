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
    $proyek_row = $db_object->find_in_table("proyek", "*", "WHERE id = " . $IdProyek);
}

//action tombol check
if (isset($_POST['save_data'])) {
    $can_process = true;
    
    $sql = "SELECT id FROM nilai_kriteria "
            . " WHERE proyek_id = '".$IdProyek."' "
            . " AND kontraktor_id = '".$_POST['kontraktor_id']."' ";
    $result = $db_object->db_query($sql);
    $thereis = $db_object->db_num_rows($result);
    if($thereis > 0){
        $can_process = false;
        ?>
        <script> location.replace("?menu=input_nilai&pesan_error=Data sudah diinput");</script>
        <?php
    }
    
    if($can_process){
        $val_sql = array();
        foreach ($_POST['nilai'] as $key => $value) {
            $val_sql[] = "(\"" . $IdProyek . "\", \"" . $_POST['kontraktor_id'] . "\", \"" . $_POST['kriteria'][$key] . "\", "
                    . " \"".$key."\", \"".$value."\")";
        }

        $sql_value = implode(",", $val_sql);
        $sql1 = "INSERT INTO nilai_kriteria "
                . " (proyek_id, kontraktor_id, kriteria_id, sub_kriteria_id, nilai) "
                . " VALUES " . $sql_value;
        $result1 = $db_object->db_query($sql1);
        if ($result1) {
            ?>
            <script> location.replace("?menu=input_nilai&pesan_success=Data berhasil disimpan");</script>
            <?php
        } else {
            ?>
            <script> location.replace("?menu=input_nilai&pesan_error=Data gagal disimpan");</script>
            <?php
        }
    }
}


$sql = "SELECT
            kr.*,
            sub_kr.`sub_kriteria`,
            pr.`nama_proyek`,
            k_proyek.`proyek_id`,
            sub_kr.`id` AS id_sub_kriteria
          FROM
            kriteria_proyek k_proyek
            RIGHT JOIN 
            proyek pr
            ON k_proyek.`proyek_id` = pr.`id`
            RIGHT JOIN kriteria kr
            ON k_proyek.`kriteria_id` = kr.`id`,
            sub_kriteria sub_kr 
          WHERE 
          sub_kr.`id_kriteria` = kr.`id` ";
if(!empty($IdProyek)){
    $sql .= " AND k_proyek.`proyek_id` = ".$IdProyek;
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
            <h1>Input Nilai</h1>
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

                    <?php
                    if(!isset($_POST['select_display'])){
                    ?>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <?php
                                text_with_list_proyek("Proyek", "proyekId", "", true, true);
                                ?>
                            </div>
                            
                            <div class="col-sm-6">
                                <button class="btn btn-primary" name="select_display" type="submit">Select</button>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    else{
                        echo "<div class='row'>
                                <div class='form-group'>";
                                echo "<div class='col-sm-6'>";
                                    label("Proyek:");
                                    echo "<div class='col-lg-10'>";
                                        echo "<input type='text' class='form-control' value='".$proyek_row['nama_proyek']."' disabled/>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    }
                    ?>
                    
                    <?php
                    if(isset($_POST['select_display'])){
                    ?>
                    <div class='row'>
                        <div class='form-group'>
                            <div class="col-sm-6">
                                <?php
                                text_with_list_kontraktor("Kontraktor", "kontraktor_id", "", true, true);
                                ?>
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
                                <th>Nilai</th>
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
                                }
                                else{
                                    echo "<td>" . $no . "</td>";
                                    echo "<td>" . $row['kriteria_code'] . "</td>";
                                    echo "<td>" . $row['kriteria_nama'] . "</td>";
                                    $no++;
                                }
                                echo "<td>" . $row['sub_kriteria'] . "</td>";
                                echo "<td>"
//                                . "<center>"
                                . " <input type='hidden' name='kriteria[" . $row['id_sub_kriteria'] . "]' value=\"".$row['id']."\" />"
//                                . " <input type='text' name='nilai[" . $row['id_sub_kriteria'] . "]' "
//                                        . " onkeyup=\"this.value=this.value.replace(/[^\d]/,'')\" required='required'/>"
                                . list_numbers("nilai[".$row['id_sub_kriteria']."]", '', true, true, '-', 3, '')
//                                . "</center>"
                                . "</td>";
                                echo "</tr>";
                                $podo = $row['id'];
                            }
                            ?>
                        </table>
                        <center>
                        <button class="btn btn-primary" name="save_data" type="submit">Submit</button>
                        </center>
                        <?php
                    }
                        ?>
                        
                </form>
            </div>
        </div>
        <!--</div>-->
        <!-- END CONTENT -->
    </div>        

</div>
</div>