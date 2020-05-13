<?php

include("config.php");

if ( isset($_REQUEST['aidi']) ) {
    $aidi = $_REQUEST['aidi'];
    $query = "UPDATE `meseiji` SET `meseiji_no_nakami` = '' WHERE `aidi` = $aidi ";
    $result = mysqli_query($koneksi, $query);
    if(!$result){
    die ("Query Error: ".mysqli_errno($koneksi).
    " - ".mysqli_error($koneksi));
    }else{
    	echo "Berhasil Delete";
    }
}

