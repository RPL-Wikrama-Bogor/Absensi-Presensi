<?php
session_start();

include "../config/database.php";
include "../library/controllers.php";

@$a = mysqli_query($conn, "SELECT * FROM tbl_siswa WHERE nis = '$_POST[user]'");
@$b = mysqli_fetch_array($a);
@$c = mysqli_num_rows($a);
@$nama = $b['nama'];

// function loginUser
$login = new oop();
$login->loginUser($c, $nama);

if (isset($_POST['batal'])) {
    echo "<script>
            document.location.href='../';
        </script>";
}
?>

<title>Login</title>
<form action="" method="post" autocomplete="off">
    <table align="center">
        <tr>
            <td>Username</td>
            <td>:</td>
            <td>
                <input type="text" name="user">
            </td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td>
                <input type="password" name="pass">
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <button type="submit" name="login">Login</button>
                <button type="submit" name="batal">Batal</button>
            </td>
        </tr>
    </table>
</form>