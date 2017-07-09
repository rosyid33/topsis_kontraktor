<?php

function process_topsis($nilai_kriteria, $kontraktor, $kriteria_code, $bobot){
    //di tampung di variable array dulu
    $data_nilai = array();
    foreach ($nilai_kriteria as $id => $nilainya) {
        $kriteria_code[$id];
        foreach ($nilainya as $id_kontraktor => $nilai) {
            $data_nilai[$kriteria_code[$id]][$id_kontraktor] += $nilai;
        }
    }
    
    //==========================================================================
    //display data normalisasi
    echo "<strong>Matrik Ternormalisasi:</strong>";
    br();
    echo "<div class='row'>
            <div class='form-group'>";
            echo "<div class='col-sm-12'>";
            
            echo "<table class='table table-bordered table-striped table-hover' style='width: 50%;'>
                    <tr>
                        <th rowspan='2'>Kriteria</th>
                        <th colspan='".(count($kontraktor))."'><center>Alternatif</center></th>
                        <th rowspan='2'>Nilai</th>
                    </tr>";
            
            echo "<tr>";    
            foreach ($kontraktor as $id => $nama) {
                echo "<th>".$nama."</th>";  
            }
            echo "</tr>";
            
            //variable penampung nilai
            $NilaiAkarSumKuadrat = array();
            
            foreach ($data_nilai as $kriteria_code => $nilainya) {
                echo "<tr>";
                echo "<td>".$kriteria_code."</td>"; 
                
                $nilai_sum_kuadrat = 0;
                foreach ($nilainya as $id_kontraktor => $nilai) {
                    echo "<td>".$nilai."</td>";
                    $nilai_sum_kuadrat += $nilai*$nilai;   
                }
                $nilai_akar_sum_kuadrat = sqrt($nilai_sum_kuadrat);
                $NilaiAkarSumKuadrat[$kriteria_code] = $nilai_akar_sum_kuadrat;
                echo "<td>".price_format($nilai_akar_sum_kuadrat)."</td>";
                echo "</tr>";
            }
        echo "</table>";
        
        //======================================================================
        br();br();
        //normalisasi matrik
        echo "<strong>Normalisasi Matrik:</strong>";
        br();
        echo "<table class='table table-bordered table-striped table-hover' style='width: 50%;'>
                    <tr>
                        <th rowspan='2'>Kriteria</th>
                        <th colspan='".(count($kontraktor))."'><center>Alternatif</center></th>
                    </tr>";
            
            echo "<tr>";    
            foreach ($kontraktor as $id => $nama) {
                echo "<th>".$nama."</th>";  
            }
            echo "</tr>";
            
            $NilaiNormalisasi = array();
            foreach ($data_nilai as $kriteria_code => $nilainya) {
                echo "<tr>";
                echo "<td>".$kriteria_code."</td>"; 
                foreach ($nilainya as $id_kontraktor => $nilai) {
                    $nilai_normalisasi = $nilai / $NilaiAkarSumKuadrat[$kriteria_code];
                    $NilaiNormalisasi[$kriteria_code][$id_kontraktor] = $nilai_normalisasi;
                    echo "<td>".price_format($nilai_normalisasi)."</td>";
                }
                echo "</tr>";
            }
        echo "</table>";
        
        
        //======================================================================
        br();br();
        //normalisasi matrik terbobot
        echo "<strong>Normalisasi Matrik Terbobot:</strong>";
        br();
        echo "<table class='table table-bordered table-striped table-hover' style='width: 80%;'>
                    <tr>
                        <th rowspan='2'>Kriteria</th>
                        <th colspan='".(count($kontraktor))."'><center>Alternatif</center></th>
                        <th rowspan='2'>Max</th>
                        <th rowspan='2'>Min</th>
                    </tr>";
            
            echo "<tr>";    
            foreach ($kontraktor as $id => $nama) {
                echo "<th>".$nama."</th>";  
            }
            echo "</tr>";
            
            $NilaiMax = $NilaiMin = array();
            foreach ($NilaiNormalisasi as $kriteria_code => $nilainya) {
                echo "<tr>";
                echo "<td>".$kriteria_code."</td>"; 
                $array_nampung = array();
                foreach ($nilainya as $id_kontraktor => $nilai) {
                    $nilai_normalisasi_bobot = $nilai * $bobot[$kriteria_code];
                    $array_nampung[] = $nilai_normalisasi_bobot;
                    echo "<td>".price_format($nilai_normalisasi_bobot)."</td>";
                }
                
                $max_val = max($array_nampung);
                $min_val = min($array_nampung);
                
                $NilaiMax[$kriteria_code] = $max_val;
                $NilaiMin[$kriteria_code] = $min_val;
                echo "<td>".price_format($max_val)."</td>";
                echo "<td>".price_format($min_val)."</td>";
                echo "</tr>";
            }
        echo "</table>";
        
    echo "</div>";
    echo "</div>";
    echo "</div>";
        
        
}