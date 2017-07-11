
<!-- BEGIN HEADER -->
<div class="header">
    <div class="container">
        <a class="site-logo" href="index.php">
            <!--<img src="assets/corporate/img/logos/logo-shop-red.png" alt="Metronic Shop UI">-->
            TOPSIS KONTRAKTOR
        </a>

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

        <!-- BEGIN NAVIGATION -->
        <div class="header-navigation pull-right">
            <ul>
                <?php
                if (empty($_SESSION['topsis_kontraktor_id'])) {
                    //echo "<li><a href='index.php'>Halaman Utama</a></li>";
                    echo "<li><a href='login.php'>Log In</a></li>";
                }
                else{
                ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                        Master 
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php?menu=kontraktor">Kontraktor</a></li>
                        <li><a href="index.php?menu=proyek">Master Proyek</a></li>
                        <li><a href="index.php?menu=kriteria">Kriteria</a></li>
                        <li><a href="index.php?menu=user">User</a></li>
                    </ul>
                </li>
                
                
                <li><a href="index.php?menu=input_nilai">Input Nilai</a></li>

                <li><a href="index.php?menu=proses_topsis">Proses Topsis</a></li>
                <li><a href="index.php?menu=laporan_hasil">Laporan Hasil</a></li>
                
                <li><a href="logout.php">Logout</a></li>
                <?php
                }
                ?>
            </ul>
        </div>
        <!-- END NAVIGATION -->
    </div>
</div>
<!-- Header END -->