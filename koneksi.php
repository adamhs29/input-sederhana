<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "input_sederhana"; // Ganti dengan nama database yang diinginkan

$kon = mysqli_connect($servername, $username, $password, $database);

if (!$kon) {
    die("Koneksi gagal: ".mysqli_connect_error());
}
