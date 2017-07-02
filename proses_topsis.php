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

//action 
if (isset($_POST['process'])) {
    
}


$sql = "SELECT
            nilai.*,
            kontraktor.`nama_kontraktor`,
            sub_kr.`sub_kriteria`,
            kr.`kriteria_code`
          FROM
            nilai_kriteria nilai,
            sub_kriteria sub_kr,
            kriteria kr,
            kontraktor kontraktor
          WHERE sub_kr.`id_kriteria` = kr.`id`
          AND nilai.`sub_kriteria_id` = sub_kr.`id` 
          AND nilai.`kontraktor_id` = kontraktor.`id` ";
if (!empty($IdProyek)) {
    $sql .= " AND nilai.`proyek_id` = " . $IdProyek;
}
$sql .= " ORDER BY nilai.id";
$query = $db_object->db_query($sql);
$jumlah = $db_object->db_num_rows($query);

//
$nilai_kriteria = array();
$kontraktor = array();
$sub_kriteria = array();
$kriteria_code = array();
while ($row = $db_object->db_fetch_array($query)) {
    $nilai_kriteria[$row['sub_kriteria_id']][$row['kontraktor_id']] = $row['nilai'];
    
    //tampung kontraktor
    if(!in_array($row['nama_kontraktor'], $kontraktor)){
        $kontraktor[$row['kontraktor_id']] = $row['nama_kontraktor'];
    }
    if(!in_array($row['sub_kriteria'], $sub_kriteria)){
        $sub_kriteria[$row['sub_kriteria_id']] = $row['sub_kriteria'];
    }
    if(!in_array($row['kriteria_code'], $kriteria_code)){
        $kriteria_code[$row['sub_kriteria_id']] = $row['kriteria_code'];
    }
}
?>
<div class="main">
    <div class="container">
        <div class="row margin-bottom-35 ">
            <!-- BEGIN CONTENT -->
            <!--<div class="col-md-9 col-sm-7">-->
            <h1>Proses Topsis</h1>
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
                    
                    if(isset($_POST['select_display'])){
                    ?>
                    <div class="row">
                        <input type="hidden" value="<?php echo $IdProyek; ?>" name="proyekId"/>                    
                        <table class='table table-bordered table-striped table-hover' style="width: 100%;">
                            <tr>
                                <th colspan="2">Kontraktor</th>
                                <?php
                                foreach ($kontraktor as $id => $nama) {
                                  echo "<th>".$nama."</th>";  
                                }
                                ?>
                            </tr>
                            <?php
                            foreach ($nilai_kriteria as $id => $nilainya) {
                                echo "<tr>";
                                echo "<td>".$kriteria_code[$id]."</td>"; 
                                echo "<td>".$id."</td>"; 
                                foreach ($nilainya as $id_kontraktor => $nilai) {
                                    echo "<td>".$nilai."</td>";
                                }
                                echo "</tr>";
                            }
                            ?>
                        </table>
                        <center>
                            <button class="btn btn-primary" name="process" type="submit">Process</button>
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