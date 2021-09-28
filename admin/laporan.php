<?php
date_default_timezone_set("Asia/Jakarta");

include "../config/database.php";

$perintah = new oop();

if (!empty($_GET['rombel'])) {
    $query = "SELECT * FROM tbl_rombel WHERE id_rombel = '$_GET[rombel]' ";
    $isinya = mysqli_fetch_array((mysqli_query($conn, $query)));
}
?>

<title>Laporan Absensi</title>
<br>
<center>
    <font size="+3">Form Laporan Absensi</font>
</center>
<hr>
<form action="" method="post">
    <table align="center">
        <tr>
            <td>Pilih Rombel</td>
            <td>:</td>
            <td>
                <select name="rombel">
                    <option value="<?= @$isinya['id_rombel'] ?>"><?= @$isinya['rombel'] ?></option>
                    <?php
                        $a = $perintah->tampil($conn, "tbl_rombel");
                        foreach ($a as $r) {
                    ?>
                    <option value="<?= $r['0'] ?>"><?= $r['1'] ?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
            <td>
                <button type="submit" name="cetak">Cetak</button>
            </td>
        </tr>
    </table>
    <br>
    <?php
        if (isset($_POST['cetak'])) {
            echo "<script>
                    document.location.href='laporan_today.php?menu=laporan&rombel=$_POST[rombel]';
                </script>";
        }
    ?>
</form>
<br>