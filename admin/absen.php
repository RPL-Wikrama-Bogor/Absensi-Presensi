<?php
date_default_timezone_set('Asia/Jakarta');
include "../config/database.php";

$perintah = new oop();

if (!empty($_GET['rombel'])) {
    $isinya = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tbl_rombel WHERE id_rombel = '$_GET[rombel]'"));
    $id_rombel = $isinya['id_rombel'];
    $rombel = $isinya['rombel'];
}
?>

<form action="" method="post">
    <table align="center">
        <tr>
            <td>Pilih Rombel</td>
            <td>:</td>
            <td>
                <select name="rombel">
                    <option value="<?= @$id_rombel ?>"><?= @$rombel ?></option>
                    <?php 
                        $a = $perintah->tampil($conn, "tbl_rombel");
                        foreach ($a as $r) { ?>
                    <option value="<?= $r[0] ?>"><?= $r[1] ?></option>
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
    <hr>
    <?php 
        if (isset($_POST['cetak'])) {
            echo "<script>
                    document.location.href='?menu=absen&rombel=$_POST[rombel]'
                  </script>";
        }
        if (!empty($_GET['rombel'])) {
            $tgl_sekarang = date('Y-m-d');
            $query = "SELECT * FROM query_absen WHERE id_rombel = '$_GET[rombel]' AND tgl_absen = '$tgl_sekarang'";
            $cek = mysqli_fetch_array(mysqli_query($conn, $query));

            if (@$cek['tgl_absen'] == @$tgl_sekarang AND @$cek['id_rombel'] == @$_GET['rombel']) {
                echo "<script>
                        alert('Rombel $rombel sudah di absen hari ini');
                        document.location.href='?menu=absen';
                      </script>";
            } else {
    ?>
    <br>
    <table align="center" border="1">
        <tr>
            <td rowspan="2">No</td>
            <td rowspan="2">Nis</td>
            <td rowspan="2">Nama</td>
            <td rowspan="2">Rombel</td>
            <td colspan="4" align="center">Keterangan</td>
        </tr>
        <tr>
            <td>Hadir</td>
            <td>Sakit</td>
            <td>Izin</td>
            <td>Alpa</td>
        </tr>
        <?php 
            $no = 0;
            $sql = "SELECT * FROM query_siswa WHERE id_rombel = '$_GET[rombel]'";
            $query = mysqli_query($conn, $sql);
            $cek = mysqli_num_rows($query);

            if ($cek == "") {
                echo "<tr><td align='center' colspan='8'>No Record</td></tr>";
            } else {
                while ($r = mysqli_fetch_array($query)) {
                    $no++;
        ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $r['nis'] ?></td>
            <td><?= $r['nama'] ?></td>
            <td><?= $r['rombel'] ?></td>
            <td>
                <input type="radio" checked name="keterangan<?= $r['nis'] ?>" value="hadir">
            </td>
            <td>
                <input type="radio" name="keterangan<?= $r['nis'] ?>" value="sakit">
            </td>
            <td>
                <input type="radio" name="keterangan<?= $r['nis'] ?>" value="ijin">
            </td>
            <td>
                <input type="radio" name="keterangan<?= $r['nis'] ?>" value="alpa">
            </td>
        </tr>
        <?php 
            $tgl = date('Y-m-d');
            $table = "tbl_absen";
            $redirect = '?menu=absen';

            if (@$_POST['keterangan' . $r['nis']] == 'hadir') {

                $field = array('nis' => $r['nis'], 'hadir' => '1', 'sakit' => '0', 'ijin' => '0', 'alpa' => '0', 'tgl_absen' => $tgl);

            } elseif (@$_POST['keterangan' . $r['nis']] == 'sakit') {

                $field = array('nis' => $r['nis'], 'hadir' => '0', 'sakit' => '1', 'ijin' => '0', 'alpa' => '0', 'tgl_absen' => $tgl);

            } elseif (@$_POST['keterangan' . $r['nis']] == 'ijin') {

                $field = array('nis' => $r['nis'], 'hadir' => '0', 'sakit' => '0', 'ijin' => '1', 'alpa' => '0', 'tgl_absen' => $tgl);

            } else {

                $field = array('nis' => $r['nis'], 'hadir' => '0', 'sakit' => '0', 'ijin' => '0', 'alpa' => '1', 'tgl_absen' => $tgl);
                
            }

            if (isset($_REQUEST['simpan'])) {
                $perintah->simpan($conn, $table, $field, $redirect);
            }

        }

    }

        ?>
        <tr>
            <td colspan="10" align="center">
                <button type="submit" name="simpan">Simpan</button>
            </td>
        </tr>
    </table>
    <?php  
            }
        }
    ?>
</form>