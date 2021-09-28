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

if ($tampil['jk'] == "L") {
    $l = "checked"; 
} else {
    $p = "checked";
}

$date = explode("-", $tampil['tgl_lahir']);
$thn = $date[0];
$bln = $date[1];
$tgl = $date[2];

$perintah = new oop();
@$table = "tbl_siswa";
@$tanggal = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tgl'];
@$field = array('nama' => $_POST['nama'],
                'jk' => $_POST['jk'],
                'tgl_lahir' => $tanggal);
@$where = "nis = $_GET[nis]";
@$redirect = "?menu=lihat_data";

if (isset($_POST['ubah'])) {
    echo $perintah->ubah($conn, $table, $field, $where, $redirect);
    echo "OK";
}
?>

<title>Form Siswa</title>
<form action="" method="post">
    <table align="center">
        <tr>
            <td></td>
            <td>
                <img border="5" height="175" width="155" src="../foto/<?= $tampil['foto'] ?>">
            </td>
            <td></td>
        </tr>
    </table>
    <table align="center">
        <tr>
            <td>NIS</td>
            <td>:</td>
            <td><?= $tampil['nis'] ?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><input type="text" name="nama" value="<?= $tampil['nama'] ?>"></td>
        </tr>
        <tr>
            <td>Kelamin</td>
            <td>:</td>
            <td>
                <input type="radio" name="jk" value="L" <?= @$l ?>>Laki-laki
                <input type="radio" name="jk" value="P" <?= @$p ?>>Perempuan
            </td>
        </tr>
        <tr>
            <td>Rayon</td>
            <td>:</td>
            <td><?= $tampil['rayon'] ?></td>
        </tr>
        <tr>
            <td>Rombel</td>
            <td>:</td>
            <td><?= $tampil['rombel'] ?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>
                <select name="tgl">
                    <option value="<?= $tgl ?>"><?= $tgl ?></option>
                    <option value="">------</option>
                    <?php
                        for ($tgl = 1; $tgl <= 31; $tgl++) {
                            if ($tgl <= 9) {
                    ?>
                    <option value="<?= "0" . $tgl; ?>"><?= "0" . $tgl; ?></option>
                    <?php
                            } else {
                                ;
                    ?>
                    <option value="<?= $tgl ?>"><?= $tgl ?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
                <select name="bln">
                    <option value="<?= $bln ?>"><?= $bln ?></option>
                    <option value="">------</option>
                    <?php
                        for ($bln = 1; $bln <= 12; $bln++) {
                            if ($bln <= 9) {
                    ?>
                    <option value="<?= "0" . $bln; ?>"><?= "0" . $bln; ?></option>
                    <?php
                            } else {
                                ;
                    ?>
                    <option value="<?= $bln ?>"><?= $bln ?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
                <select name="thn">
                    <option value="<?= $thn ?>"><?= $thn ?></option>
                    <option value="">------</option>
                    <?php
                        for ($thn = 1990; $thn <= 2021; $thn++) {
                    ?>
                    <option value="<?= $thn ?>"><?= $thn ?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <button type="submit" name="ubah">Ubah</button>
            </td>
        </tr>
    </table>
</form>
<br>