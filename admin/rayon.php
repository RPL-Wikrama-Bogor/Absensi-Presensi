<?php
include "../config/database.php";

$perintah = new oop();

@$table = "tbl_rayon";
@$where = "id_rayon = $_GET[id]";
@$redirect = "?menu=rayon";
@$field = array('rayon' => $_POST['rayon']);

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

<form action="" method="post" autocomplete="off">
    <table align="center">
        <tr>
            <td>Rayon</td>
            <td> : </td>
            <td><input type="text" name="rayon" value="<?= @$edit['rayon'] ?>" required placeholder="Rayon" autofocus></td>
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
        <td>Rayon</td>
        <td colspan="2">Aksi</td>
    </tr>
    <?php 
        $a = $perintah->tampil($conn, $table);
        $no = 0;
        if ($a == "") {
            echo "<tr><td align='center' colspan='4'>No Record</td></tr>";
        } else {
            foreach ($a as $r) {
                $no++;
            ?>
    <tr>
        <td><?= $no ?></td>
        <td><?= $r['rayon'] ?></td>
        <td>
            <a href="?menu=rayon&edit&id=<?= $r['id_rayon'] ?>">
                <img src="../images/edit_icon.png" alt="Edit | Images From Flaticon">
            </a>
        </td>
        <td>
            <a href="?menu=rayon&hapus&id=<?= $r['id_rayon'] ?>" onClick="return confirm('Hapus Data ?')">
                <img src="../images/delete_icon.png" alt="Delete | Images From Flaticon">
            </a>
        </td>
    </tr>
    <?php 
            }
        }
    ?>
</table>
<br>