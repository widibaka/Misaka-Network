<?php
$host = "localhost";
$user = "root";
$pass = "";
$nama_db = "misaka_network"; //nama database
$koneksi = mysqli_connect($host,$user,$pass,$nama_db); //pastikan urutan nya seperti ini, jangan tertukar
if(!$koneksi){ //jika tidak terkoneksi maka akan tampil error
die ("Koneksi dengan database gagal: ".mysql_connect_error());
}

# Membuat base_url otomatis mengikuti directory install
$base_url = "http://localhost/misaka_network/";