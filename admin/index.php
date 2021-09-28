<?php
session_start();

include "../config/database.php";
include "../library/controllers.php";

$perintah = new oop();

@$table = "tbl_user";
@$username = $_POST['user'];
@$password = $_POST['pass'];

@$redirect = "hal_admin.php?menu=home";

if (isset($_POST['login'])) {
    $perintah->login($conn, $table, $username, $password, $redirect);
}

if (isset($_POST['batal'])) {
    echo "<script>
            document.location.href='../'
        </script>";
}

?>
<title>Login</title>
<form action="" method="post" autocomplete="off"> 
    <table align="center">
        <tr>
            <td>Username</td>
            <td>:</td>
            <td><input type="text" name="user"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td><input type="password" name="pass"></td>
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