<?php
session_start();
include('koneksi.php');

$nipd = $_POST['nipd'];
$pass = $_POST['password'];

$query = $koneksi->prepare("SELECT nipd, password FROM murid WHERE nipd = ?");
$query->bind_param("s", $nipd);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if ($pass === $row['password']) {
        $_SESSION['nipd'] = $row['nipd'];
        header('Location: ../view/beranda.php');
        exit;
    } else {
        echo "<script>alert('NIPD atau password salah, coba lagi');</script>";
    }

}


$_SESSION['error'] = "NIPD atau password salah, coba lagi";
header('Location: ../view/index.php');
exit;
?>