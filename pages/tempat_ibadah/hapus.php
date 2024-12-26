<?php
include '../../config/koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM tempat_ibadah WHERE id='$id'");

if($query) {
    header('location: index.php');
}
?>
