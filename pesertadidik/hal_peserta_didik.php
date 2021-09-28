<?php
@session_start();

include "../config/database.php";
include "../library/controllers.php";

$perintah = new oop();

$perintah->tampil($conn, "tbl_siswa WHERE nis = '$_SESSION[username]'");

if (empty($_SESSION['username'])) {
    echo "<script>
            alert('Silahkan Login Terlebih Dahulu');
            document.location.href='index.php';
        </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PRESENSI | Peserta Didik</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div id="utama">
        <ul class="menu">
            <li><a href="?menu=home">Home</a></li>
            <li><a href="#">Data Diri</a>
                <ul>
                    <li><a href="?menu=lihat_data">Lihat</a></li>
                    <li><a href="?menu=edit_data&nis=<?= $_SESSION['username'] ?>">Edit</a></li>
                </ul>
            </li>
            <li><a href="#">Laporan</a>
                <ul>
                    <li><a target="_blank" href="laporan_today.php?menu=laporan&nis=<?= $_SESSION['username'] ?>">Lihat</a></li>
                </ul>        
            </li>
            <li>
                <a href="logout.php" onClick="return confirm('Anda Yakin Ingin Keluar?'); ">Keluar</a>
            </li>
        </ul>
        <div class="konten"> 
            <?php
                switch ($_GET['menu']) {
                    case "home";
                        include "home.php";
                        break;
                    
                    case "lihat_data";
                        include "lihat_data.php";
                        break;
                    
                    case "edit_data";
                        include "edit_data.php";
                        break;
                }
            ?>
        </div>
    </div>
</body>
</html>