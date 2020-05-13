<?php
require_once('config.php');
require_once('functions.php');

session_start();

// Membatasi jumlah pesan yang di-load
$limit = 0;
if ( isset($_REQUEST['limit_pesan']) ) {
    $limit = $_REQUEST['limit_pesan'];
}


// Mengambil data dr database
$query = "SELECT * FROM meseiji ORDER BY aidi DESC LIMIT $limit";
// saat mengambil data untuk keperluan notifikasi, jangan dilimit
if ($_REQUEST['limit_pesan'] == "jangan_dilimit") {
    $query = "SELECT * FROM meseiji ORDER BY aidi DESC";
}
$result = mysqli_query($koneksi, $query);
//mengecek apakah ada error ketika menjalankan query
if(!$result){
die ("Query Error: ".mysqli_errno($koneksi).
" - ".mysqli_error($koneksi));
}


// data inisialisasi
$current_riyousha_no_aidi = 0;

while($row = mysqli_fetch_assoc($result))
{


?>

<?php 
if ( $current_riyousha_no_aidi != $row['riyousha_no_aidi'] ): //kalau chat-nya beda orang, dikasih jarak atas-bawah sedikit ?>
<div class="mb-3"></div>
<?php endif ?>

<ul class="media-list mb-1" id="<?php echo $row['aidi']; ?>">
    <!-- Quote pesan teman -->
    <?php 
        // quoted from friend
        $quote = getStringBetween($row['meseiji_no_nakami'], "[[", "]]");
    ?>
    <?php if ( $quote != false ): //hanya tampilkan ini ketika ada quote saja 
        $quote_array = explode("=", $quote);
        $quoted_friend_id = $quote_array[0];
        $quoted_msg_id = $quote_array[1];
        $quoted_msg = $quote_array[2];
    ?>
    <a href="javascript:void(0)" onclick="scroll_to(<?= $quoted_msg_id ?>)" scroll_to="">
    <li class="quoted-message mt-0" id="<?php echo $row['aidi']; ?>" style="border-color: <?= getColorById($users, $quoted_friend_id); ?>">
                <p class="font-weight-bold mt-0 mb-0"><?php echo getUsernameById($users, $quoted_friend_id); ?></p>
                <p class="mt-0 mb-2">
                    <?php echo nl2br( // linebreak \n biar jadi <br> 
                        $quoted_msg ) ;?>
                </p>
    </li>
    </a>
    <?php endif ?>
    
    <!-- Isi pesan -->
    <li class="media kotak" style="border-color: <?= getColorById($users, $row['riyousha_no_aidi']); ?>">
      <?php if ( $current_riyousha_no_aidi != $row['riyousha_no_aidi'] ): //kalau chat-nya orangnya masih sama, gak usah ditampilin fotonya ?>
        <!-- photo -->
        <a href="javascript:void(0)" class="float-left photo">
            <div style="height: 50px; width: 50px; background-size: cover; background-image: url(<?php echo $base_url ?>assets/img/no_photo.jpg);" alt="" class="rounded-circle"></div>
        </a>
      <?php endif ?>
        
        <div class="media-body">
            <span class="text-muted float-right">
                <small class="ket-waktu"><?php echo getTimeAgo($row['nichiji']); ?></small>
            </span>
            <!-- nama -->
            <strong class="text-username"><?php echo getUsernameById($users, $row['riyousha_no_aidi']); ?></strong>
            
            <?php if (!empty($row['meseiji_no_nakami'])): ?>
            <!-- pesan -->
            <p class="mb-0" id="p-pesan-<?php echo $row['aidi']; ?>"><?php 
                // the message
                echo nl2br(
                    str_replace("[[".$quote."]]", "", $row['meseiji_no_nakami']) // hilangkan quote-nya
                );
                ?></p>
            <?php else : ?>
            <p class="mb-0 text-muted" id="p-pesan-<?php echo $row['aidi']; ?>"><i>Pesan ini telah dihapus</i></p>

            <?php endif ?>
        </div>
        <span class="control-pesan">
            <?php if ( !empty($row['meseiji_no_nakami']) AND getIdByUsername($users, $_SESSION['riyousha']) == $row['riyousha_no_aidi'] ): 
            //tombol delete  hanya muncul kalo ID pengirim ppesan sama dgn user, dan pesan tidak kosong  ?>
                <a title="Hapus pesan ini" href="javascript:void(0)" onclick="hapus(<?= $row['aidi'] ?>)"><i class="fas fa-trash"></i></a>
            <?php endif ?>
            <a title="Balas pesan ini" href="javascript:void(0)" onclick="reply(<?= $row['riyousha_no_aidi'] ?>,<?= $row['aidi'] ?>)"><i class="fas fa-reply"></i></a>
        </span>
    </li>
</ul>


<?php

$current_riyousha_no_aidi = $row['riyousha_no_aidi']; // update data yg ada di awal tadi

if (empty($row['aidi'])) {
    ?>
<ul class="media-list">
    <li class="media kotak" id="<?php echo $row['aidi']; ?>">
        <div class="media-body text-muted">
            Tidak ada chat
        </div>
    </li>
</ul>


<?php
}
}
