<?php

include("config.php");

$users = [];
$query = "SELECT COUNT(aidi) FROM meseiji";
$result = mysqli_query($koneksi, $query);
if(!$result){
die ("Query Error: ".mysqli_errno($koneksi).
" - ".mysqli_error($koneksi));
}
$row = mysqli_fetch_row($result);
echo($row)[0]; // <-- jumlahnya diprint di sini, dan nanti diambil oleh ajax