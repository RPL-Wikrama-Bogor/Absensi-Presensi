<?php
@session_start();

include "../config/database.php";

$query = "SELECT * FROM query_siswa WHERE nis = '$_SESSION[username]'";
$tampil = mysqli_fetch_array(mysqli_query($conn, $query));

if (empty($_SESSION['username'])) {  
    echo "<script>
            alert('Anda Belum Melakukan Login');
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
</head>
<body>
    <h1 align="center">Welcome 
        <a href="?menu=lihat_data" class="name" title="<?= $tampil['nama']; ?>">
            <?= $tampil['nama']; ?>
        </a>
    </h1>
    <h1 align="center">
        Sistem Presensi Versi 1.0
    </h1>
</body>
</html>