<?php

// Mengubah Username menjadi id
function getIdByUsername($users, $username) {
	foreach ($users as $key => $value) {
		if ($value['yuzaaneimu']==$username) {
			return $value['aidi'];
		}
	}
}
// Mengubah id menjadi warna/iro
function getColorById($users, $id) {
    foreach ($users as $key => $value) {
        if ($value['aidi']==$id) {
            return $value['iro'];
        }
    }
}
// Mengubah nomor id menjadi nama user
function getUsernameById($users, $id) {
    foreach ($users as $key => $value) {
        if ($value['aidi']==$id) {
            return $value['yuzaaneimu'];
        }
    }
}


// untuk ngambil quote di message
function getStringBetween($str,$from,$to)
{
    $sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
    $result = substr($sub,0,strpos($sub,$to));
    if ($result=="") {
        return false;
    }else {
        return $result;
    }
}

// get random
function rand_color() {
    $str = '#';
    for($i = 0 ; $i < 3 ; $i++) {
        $str .= dechex( rand(60 , 220) ); // 0 s.d 169 itu gelap. 170 s.d 255 itu warna cerah
    }
    return $str;
}
//Fungsi utk bikin waktu mundur buat chat dan lain-lain
function getTimeAgo( $tgl )
{
	$tgl = strtotime($tgl);
    $time_difference = time() - $tgl;
    
    if( $time_difference < 1 ) { return '1 detik lalu'; }
    
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'tahun',
                30 * 24 * 60 * 60       =>  'bulan',
                24 * 60 * 60            =>  'hari',
                60 * 60                 =>  'jam',
                60                      =>  'menit',
                1                       =>  'detik'
    );
    
    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return $t . ' ' . $str . ' yang lalu';
        }
    }
}



// Semua user masukin ke dalam array
$users = [];
$query = "SELECT * FROM riyousha";
$result = mysqli_query($koneksi, $query);
//mengecek apakah ada error ketika menjalankan query
if(!$result){
die ("Query Error: ".mysqli_errno($koneksi).
" - ".mysqli_error($koneksi));
}
while($row = mysqli_fetch_assoc($result)){
    array_push($users, $row);
}