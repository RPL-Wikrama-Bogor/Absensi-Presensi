<?php
class oop {

    function simpan($conn, $table, array $field, $redirect) {
        $sql = "INSERT INTO $table SET";
        foreach ($field as $key => $value) {
            $sql .= " $key = '$value',";
        }
        $sql = rtrim($sql, ',');
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo "<script>
                    alert('Berhasil Simpan Data');
                    document.location.href = '$redirect';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal Tambah Data');
                    document.location.href = '$redirect';
                </script>";
        }
    }

    function tampil($conn, $table) {
        $sql = "SELECT * FROM $table";
        $query = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_array($query))
            $isi[] = $data;
        return @$isi;
    }

    function hapus($conn, $table, $where, $redirect) {
        $sql = "DELETE FROM $table WHERE $where";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo "<script>
                    alert('Berhasil Hapus Data');
                    document.location.href = '$redirect';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal Hapus Data');
                    document.location.href = '$redirect';
                  </script>";
        }
    }

    function edit($conn, $table, $where) {
        $sql = "SELECT * FROM $table WHERE $where";
        $query = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($query);
        return $data;
    }

    function ubah($conn, $table, array $field, $where, $redirect) {
        $sql = "UPDATE $table SET";
        foreach ($field as $key => $value) {
            $sql .= " $key = '$value',";
        }
        $sql = rtrim($sql, ',');
        $sql .= "WHERE $where";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo "<script>
                    alert('Berhasil Ubah Data');
                    document.location.href = '$redirect';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal Ubah Data');
                    document.location.href = '$redirect';
                  </script>";
        }
    }

    function upload($foto, $folder) {
        $tmp = $foto['tmp_name'];
        $namaFile = $foto['name'];
        move_uploaded_file($tmp, "$folder/$namaFile");

        return $namaFile;
    }

    function login($conn, $table, $username, $password, $redirect) {
        @session_start();
        $sql = "SELECT * FROM $table WHERE username = '$username' and password = '$password'";
        $query = mysqli_query($conn, $sql);
        $cek = mysqli_num_rows($query);
        if ($cek > 0) {
            $_SESSION['username'] = $username;
            echo "<script>
                    alert('Login Berhasil');
                    document.location.href = '$redirect';
                  </script>";
        } else {
            echo "<script>
                    alert('Login Gagal : Cek Username dan Password!');
                  </script>";
        }

    }
    // login user "index.php" (pesertadidik)
    function loginUser($c, $nama) {
        if (isset($_POST['login'])) {
            if ($c > 0) {
                if ($_POST['pass'] == $_POST['user']) {
                    $_SESSION['username'] = $_POST['user'];
                    $_SESSION['password'] = $_POST['pass'];
                    echo "<script>
                            alert('Selamat Datang $nama');
                            document.location.href='hal_peserta_didik.php?menu=home';
                        </script>";
                } else {
                    echo "<script>
                            alert('Login Gagal : Cek Username dan Password!');
                            document.location.href='index.php';
                        </script>";
                }
            } 
        }
    }

}
?>