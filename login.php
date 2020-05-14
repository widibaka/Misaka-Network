<?php
session_start();
require_once('app/config.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include

if ( isset($_SESSION['riyousha']) ) {
	header("Location: index.php"); // kalau ada session, lempar ke halaman chatroom
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Misaka Network - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo $base_url ?>assets/css/style.css" />
<style type="text/css">
</style>
</head>
<body">
<?php
    // If form submitted, insert values into the database.
    if (isset($_POST['riyousha'])){
		
		$riyousha = stripslashes($_REQUEST['riyousha']); // removes backslashes
		$riyousha = mysqli_real_escape_string($koneksi,$riyousha); //escapes special characters in a string
		$pasuwaado = stripslashes($_REQUEST['pasuwaado']);
		$pasuwaado = mysqli_real_escape_string($koneksi,$pasuwaado);
		
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `riyousha` WHERE yuzaaneimu='".$riyousha."' and pasuwaado='".$pasuwaado."'";
		$result = mysqli_query($koneksi,$query) or die(mysql_error());
		$rows = mysqli_num_rows($result);
        if($rows==1){
			$_SESSION['riyousha'] = $riyousha;
			header("Location: index.php"); // Redirect user to index.php
            }else{
				echo '
        	    <div class="form container" >
        	    	<div class="vertical-center">
        	    		<h3>Username/password Anda keliru.</h3>
        	    		<p>Kontak admin kalau lupa password.</p>
        	    		<a class="btn btn-info" href="login.php" style="margin-top: 10px; margin-bottom: 10px;">Login</a>
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
			<h1>Log In</h1>
			<form action="" method="post" name="login">
			<input type="text" name="riyousha" placeholder="Username" required /><br>
			<input type="password" name="pasuwaado" placeholder="Password" required /><br>
			<input class="btn btn-info" style="margin: 10px 0px; float: right; width: 100%" name="submit" type="submit" value="Login" />
			</form>
			<p>Belum daftar? <a class="navigasi" alamat='registration.php' href="javascript:void(0)">Registrasi</a></p>

			<?php } ?>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
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