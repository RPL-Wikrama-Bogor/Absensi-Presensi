<?php
include '../config/database.php';

$perintah = new oop();

@$table = "tbl_rombel";
@$where = "id_rombel = $_GET[id]";
@$redirect = "?menu=rombel";
@$field = array('rombel' => $_POST['rombel']);

if (isset($_POST['simpan'])) {
    $perintah->simpan($conn, $table, $field, $redirect);
}

if (isset($_GET['hapus'])) {
    $perintah->hapus($conn, $table, $where, $redirect);
}

if (isset($_GET['edit'])) {
    $edit = $perintah->edit($conn, $table, $where);
}

if (isset($_POST['ubah'])) {
    $perintah->ubah($conn, $table, $field, $where, $redirect);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <form action="" method="post" autocomplete="off">
        <table align="center">
            <tr>
                <td>Rombel</td>
                <td> : </td>
                <td><input type="text" name="rombel" value="<?= @$edit['rombel'] ?>" required placeholder="Rombel" autofocus></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <?php if (@$_GET['id'] == "") { ?>
                        <button type="submit" name="simpan">Simpan</button>
                    <?php } else { ?>
                        <button type="submit" name="ubah">Ubah</button>
                    <?php } ?>
                </td>
            </tr>
        </table>
    </form>
    <br>
    <table align="center" border="1">
        <tr>
            <td>No</td>
            <td>Rombel</td>
            <td colspan="2">Aksi</td>
        </tr>
        <?php
        $a = $perintah->tampil($conn,  $table);
        $no = 0;
        if ($a == "") {
            echo "<tr><td align='center' colspan='4'>NO RECORD</td></tr>";
        } else {
            foreach ($a as $r) {
                $no++;
        ?>
        <tr>
            <td><?= @$no ?></td>
            <td><?= @$r['rombel'] ?></td>
            <td>
                <a href="?menu=rombel&edit&id=<?= $r['id_rombel'] ?>">
                    <img src="../images/edit_icon.png" alt="Edit | Images From Flaticon">
                </a>
            </td>
            <td>
                <a href="?menu=rombel&hapus&id=<?= $r['id_rombel'] ?>" onClick="return confirm('Hapus Data ?')">
                    <img src="../images/delete_icon.png" alt="Delete | Images From Flaticon">
                </a>
            </td>
        </tr>
        <?php 
            }
        }
        ?>
    </table>
</body>
</html>