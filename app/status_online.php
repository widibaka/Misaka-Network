<?php

include("config.php");
include("functions.php");

$time_yang_diupdate = time()+15; // karena ajax-nya dijalanin tiap 15 detik ya kan. Ini akan timeout dan berubah jd offline setelah user meninggalkan chatroom lebih dari 15 detik gitu lho
$riyousha_no_aidi = $_REQUEST['riyousha_no_aidi'];
$username = getUsernameById($users,$_REQUEST['riyousha_no_aidi']);
$query = "UPDATE `riyousha`SET `roguin_no_saigo`= '$time_yang_diupdate' WHERE `aidi`='$riyousha_no_aidi'";
$result = mysqli_query($koneksi, $query);
if(!$result){
die ("Query Error: ".mysqli_errno($koneksi).
" - ".mysqli_error($koneksi));
}

?>
    			<?php foreach ($users as $key => $value) : ?>
    			<tr>
    				<td>
    				<?php if ( $value['roguin_no_saigo'] > time()-5 AND $value['yuzaaneimu']!=$username ): // minus 5 maksudnya untuk toleransi 5 detik. soalnya komputer org kan beda-beda, ada yg lemot ada yg cepet  ?>
			    		<strong style="color: <?= getColorById($users, $value['aidi']); ?>"><?php 
			    			echo $value['yuzaaneimu'];
			    		?></strong>
    				<?php elseif ( $value['yuzaaneimu']==$username ) : //kalo cocok sama username di SESSION, langsung print online aja, soalnya ajax suka telat 15 detik ?>
    					<strong style="color: <?= getColorById($users, $value['aidi']); ?>"><?php 
    						echo $value['yuzaaneimu']." (Anda)";
    					?></strong>
    				<?php else : ?>
			    		<strong style="color: #999"><?php echo $value['yuzaaneimu']; ?></strong>
    				<?php endif ?>
					</td>
    				
    				<td>
			    		<?php if ( $value['roguin_no_saigo'] > time()-5 AND $value['yuzaaneimu']!=$username ): // minus 5 maksudnya untuk toleransi 5 detik. soalnya komputer org kan beda-beda, ada yg lemot ada yg cepet  ?>
			    			<strong style="color: #a1c556">online</strong>
			    		<?php elseif ( $value['yuzaaneimu']==$username ) : //kalo cocok sama username di SESSION, langsung print online aja, soalnya ajax suka telat 15 detik ?>
			    			<strong style="color: #a1c556">online</strong>
			    		<?php else: ?>
			    			<span class="text-muted">off <?php 
			    			$terakhir_login = date('Y-m-d H:i:s', $value['roguin_no_saigo']); // diubah ke dlm format tanggal
			    			$terakhir_login = getTimeAgo($terakhir_login); // diubah jadi satuan waktu universal
			    			echo str_replace(" yang lalu", "", $terakhir_login); 

			    			?></span>
			    		<?php endif ?>
					</td>
    			</tr>
    			<?php endforeach; ?>