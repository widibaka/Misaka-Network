<?php

include("app/config.php");
include("app/auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Selamat Datang di Misaka Network</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo $base_url ?>assets/css/style.css?ver3" />
<style type="text/css">

	.content {
		padding: 20px;
		max-width: 300px;
	}
</style>
</head>
<body>
<div class="loader-container">
	<div class="loader"></div>
</div>
<div class="h-100">
	<div class="row justify-content-center main-content" style="display: none; ">
		<div class="vertical-center" style="width: 100%">
			<div class="content">
				<p>Selamat datang <?php echo $_SESSION['riyousha']; ?>!</p>
				<p>"Pilih Chatroom kamu." Misaka memberikan pilihan.</p>
				<p><a class="btn btn-info navigasi" alamat="app/chatroom.php" href="javascript:void(0)">Pergi Ke Chatroom 1</a></p>
				<p><a class="btn btn-info disabled navigasi" alamat="#" href="javascript:void(0)">Pergi Ke Chatroom 2</a></p>
				<p><a class="btn btn-info disabled navigasi" alamat="#" href="javascript:void(0)">Pergi Ke Chatroom 3</a></p>
				<a class="btn btn-info mb-2 mt-2 navigasi" alamat="logout.php" href="javascript:void(0)">Logout</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
	$(document).ready(function() {
		// Transisi halaman
		$(".main-content").fadeIn("fast");
		setTimeout(function() {
			$('.loader-container').fadeOut("fast");
		},500);

		// button .navigasi kalau diklik akan menampilkan putih overlay
		$(".navigasi").click(function(){
			$('.loader-container').fadeIn("fast");
			var url = $(this).attr("alamat");
			setTimeout(function() {
				window.location.replace(url);
			}, 1000);
		});
	});
</script>