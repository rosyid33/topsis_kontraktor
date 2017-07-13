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

$sql = "SELECT proyek.* 
        FROM 
            proyek,
            hasil
        WHERE hasil.`proyek_id` = proyek.`id`
        GROUP BY proyek.`id`";
$query=$db_object->db_query($sql);
$jumlah=$db_object->db_num_rows($query);
?>
<div class="main">
    <div class="container">
        <div class="row margin-bottom-35 ">
            <!-- BEGIN CONTENT -->
            <!--<div class="col-md-9 col-sm-7">-->
                <h1>Laporan Hasil</h1>
                <?php
                if (!empty($pesan_error)) {
                    display_error($pesan_error);
                }
                if (!empty($pesan_success)) {
                    display_success($pesan_success);
                }
                ?>
                <div class="content-form-page">
                    
                    <table class='table table-bordered table-striped  table-hover' style="width: 90%;">
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
                                            ." <a href='export/CLP.php?proyekId=".$row['id']."&person=".
                                            $_SESSION['topsis_kontraktor_nama']."'>"
                                            . "<img src='assets/images/icon/pdf.gif'/></a>"
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