<?php
include("app/config.php");
include("app/functions.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Misaka Network - Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo $base_url ?>assets/css/style.css" />
<style type="text/css">
	.vertical-center{
		max-width: 300px;
	}
</style>
</head>
<body style="background-image: url(assets/img/thumb-1920-209324.jpg); background-size: cover; background-attachment: fixed; background-position: center top; background-repeat: no-repeat;">
<?php
	require('app/config.php');
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['submit'])){
		$yuzaaneimu = stripslashes($_REQUEST['yuzaaneimu']); // removes backslashes
		$yuzaaneimu = mysqli_real_escape_string($koneksi,$yuzaaneimu); //escapes special characters in a string
		$pasuwaado = stripslashes($_REQUEST['pasuwaado']);
		$pasuwaado = mysqli_real_escape_string($koneksi,$pasuwaado);

		$pasuwaado_confirm = stripslashes($_REQUEST['pasuwaado_confirm']);
		$pasuwaado_confirm = mysqli_real_escape_string($koneksi,$pasuwaado_confirm);

		//Checking is user existing in the database or not
        $query = "SELECT * FROM `riyousha` WHERE yuzaaneimu='$yuzaaneimu' and pasuwaado='$pasuwaado' LIMIT 1";
		$result = mysqli_query($koneksi,$query) or die(mysql_error());
		$rows = mysqli_num_rows($result);

        if ( $pasuwaado === $pasuwaado_confirm AND $rows!=1) {
        	$iro = rand_color();
        	$query = "INSERT into `riyousha` (yuzaaneimu, pasuwaado, iro) VALUES ('$yuzaaneimu', '$pasuwaado', '$iro')";
        	$result = mysqli_query($koneksi,$query);
        	if($result){
        	    echo '
        	    <div class="form container" >
        	    	<div class="vertical-center">
        	    		<h3>Anda sekarang telah terdaftar.</h3>
        	    		<a class="btn btn-info" href="login.php" style="margin-top: 10px; margin-bottom: 10px;">Login</a>
        	    	</div>
        	    </div>';
        	}
        }
        else if( $rows == 1 ) {
        	echo '
        	<div class="form container" >
        		<div class="vertical-center">
        			<h3>Anda sudah terdaftar dari dulu woy!</h3>
        			<p>Kontak admin kalau lupa password.</p>
        			<a class="btn btn-info" href="login.php" style="margin-top: 10px; margin-bottom: 10px;">Login</a>
        		</div>
        	</div>';
        }
        else {
        	echo '
				<div class="form container" >
					<div class="vertical-center">
						<h3>Konfirmasi password Anda keliru.</h3>
						<a class="btn btn-info" href="" style="margin-top: 10px; margin-bottom: 10px;">Reload</a>
					</div>
				</div>';
        }
    }else{
?>


<div class="loader-container">
	<div class="loader"></div>
</div>

<div class="main-content " style="display: none; ">
	<div class="form container" >
		<div class="vertical-center">
			<h1>Registrasi</h1>
			<form name="registration" action="" method="post">
			<input type="text" name="yuzaaneimu" placeholder="Username" required /><br>
			<input type="password" name="pasuwaado" placeholder="Password" required /><br>
			<input type="password" name="pasuwaado_confirm" placeholder="Confirm Password" required /><br>
			<a class="btn btn-info navigasi" alamat="login.php" href="javascript:void(0)" style="margin-top: 10px; margin-bottom: 10px;">Kembali</a>
			<input class="btn btn-info" type="submit" name="submit" value="Register" style="margin-top: 10px; margin-bottom: 10px;" />
			</form>

		</div>
	</div>
</div>
<?php } ?>
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