<?php
require_once('config.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
require_once('functions.php');
require_once("auth.php");
?>
<?php 
if ( isset($_POST['riyousha_no_aidi']) ) {
	// Memakai patokan waktu dari PHP, bukan server
	$timestamp = date("Y-m-d H:i:s");

	$meseiji_post = $_POST['meseiji_no_nakami'];

	$meseiji_array = explode(" ", $meseiji_post);
// echo '<script>alert("'.$meseiji_array.'")</script>';
	foreach ( $meseiji_array as $key => $value ) {
		// kalau ada alamat URL, dibuat clickable
		if (
			strpos($value,"http") !== false AND substr($value, 0,4) == "http" OR
	 		strpos($value,"Http") !== false AND substr($value, 0,4) == "Http" 
	 	) {
			$replacement = '<a target="_blank" class="link" href="'.$value.'">'.$value.'</a>';
		    $meseiji_array[$key] = str_replace($value, $replacement, $meseiji_array[$key]);
		// kalau bukan URL, dibikin htmlentities aja
		}else{
			$meseiji_array[$key] = htmlentities($value);
		}
	}
	$meseiji_no_nakami = implode(" ", $meseiji_array);

	// ini kalau membalas pesan dari temannya
	if ( !empty($_POST['reply']) ) {
		$quoted_message = $_POST['reply'];
		$meseiji_no_nakami = $quoted_message . $meseiji_no_nakami; // digabung sama quote-nya. Quote nya di depan
	}

	// Memasukkan ke database, masukinnya pelan-pelan ...
	$sql = "INSERT INTO meseiji (riyousha_no_aidi, meseiji_no_nakami, nichiji)
	VALUES ('".$_POST['riyousha_no_aidi']."','".$meseiji_no_nakami."','".$timestamp."')";
	if ($koneksi->query($sql) === TRUE) {
	    // echo "Berhasil mengirim";
	} else {
	    echo "Error: " . $sql . "<br>" . $koneksi->error;
	}

}
?>
<!DOCTYPE html>
<html>
<head>
<title>Misaka Network</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 	<link rel="stylesheet" href="<?php echo $base_url ?>assets/css/style.css?v01">
 	<script src="https://kit.fontawesome.com/713db9fa6b.js" crossorigin="anonymous"></script>
</head>
<style type="text/css">
	/**{border: solid 1px red;}*/
</style>
<body class="light" onmouseover="nonaktifkan_bunyi()" onmouseout="aktifkan_bunyi()" >

<!-- Audio File -->
<div id="sound"></div>

<div class="loader-container">
	<div class="loader"></div>
</div>

<div class="row main-content" style="display: none;">
    <div class="col-md-3 offset-md-1 col-sm-12" id="member-online-container">
    	<div class="member-online">
    		<input type="text" id="search-member" class="mb-3 mt-2" placeholder="Cari member ..." style="height:22px">
    		<table id="member-online" class="display col-sm-12 mb-2">
    		</table>
    	</div>
    </div>
    <div class="col-md-7 col-sm-12">
        <div class="comment-wrapper">
            <div class="panel-info">
                <div class="panel-body">
                	<div class="navbar-atas">
                		<a class="navbar-item navigasi" alamat="../index.php" href="javascript:void(0)">Kembali</a>
                		<a class="navbar-item" id="tombol_pengaturan" href="javascript:void(0)">Pengaturan</a>
                		<a class="navbar-item" id="tombol_show_member" href="javascript:void(0)">Tampilkan Member</a>
                		<a class="navbar-item navigasi" alamat="../logout.php" href="javascript:void(0)">Logout</a>
                	</div>
                	<div id="isi_pengaturan" style="display: none;">
                		<a href='javascript:void(0)' class='switch_theme btn btn-info btn-sm'>Tema: Light</a>
                		<a href='javascript:void(0)' class='notifikasi_suara btn btn-info btn-sm'>Suara: Hidup</a>
                	</div>
                    <form action="" method="post" id="form_chat">
                    <textarea class="d-none" name="reply" id="reply"></textarea>
                    <div class="quoted-message mt-0" id="replying-msg" style="display: none;">
                      <a href="javascript:void(0)" class="float-right font-weight-bold" onclick="cancel_reply()"><span>x</span></a>
                      <p class="mt-0 mb-2">
                             
                      </p>
                    </div>
                    <textarea class="form-control" name="meseiji_no_nakami" id="meseiji_no_nakami" placeholder='Tulis di sini ...' rows="3" autocomplete="off" type="text"></textarea>
                    <input type="hidden" name="riyousha_no_aidi" id="riyousha_no_aidi" value="<?php echo getIdByUsername($users, $_SESSION['riyousha']) ?>"><br>
                    <button type="submit" class="btn btn-info float-right" id="but_post">Post</button>
                    </form>

                    <div class="clearfix"></div>
                    <hr style="background-color: white; opacity: .5">

                    <div class="chatMessages col-sm-12">
                    	
                    	<ul class="media-list">
                    	    <li class="kotak">
                    	    	<img class="text-center" width="30" src="../assets/img/ajax-loader-black.gif" style="margin-left: 48%;">
                    	    </li>
                    	</ul>
                    </div>
                    <div class="text-center">
                    	<button type="submit" class="btn btn-info d-none" id="tambahLimitPesan">Tampilkan Lebih Banyak</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>

<script>

/*
* Ranah post pesan chat
*/

$(document).ready(function() {

	// Transisi halaman saat benar2 loaded
	document.onreadystatechange = function () {
	    if (document.readyState == "complete") {
	        // Transisi halaman
	        $(".main-content").fadeIn("fast");
	        setTimeout(function() {
	        	$('.loader-container').fadeOut("fast");
	        },500);

	        $("#meseiji_no_nakami").focus(); // fokus ke textarea lagi
	    }
	}

	// pencarian member
	$("#search-member").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	    $("#member-online tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	});

	// button .navigasi kalau diklik akan menampilkan putih overlay
	$(".navigasi").click(function(){
		$('.loader-container').fadeIn("fast");
		var url = $(this).attr("alamat");
		setTimeout(function() {
			window.location.replace(url);
		}, 1000);
	});

	// pertama update kolom chat dulu
	updateMessages();
	// update status online
	setOnline();

	// fokus ke text area langsung
	$("#meseiji_no_nakami").focus();

	// membuat tombol enter untuk submit chat message
	$(function() {
	    $("#meseiji_no_nakami").keypress(function (e) {
	        if(e.which == 13) {
	            //submit form via ajax, this is not JS but server side scripting so not showing here
	            $(this).closest("form").submit();
	            $(this).val("");
	            e.preventDefault();
	        }
	    });
	});

	// untuk mewadahi hasil submit
	$('#form_chat').on('submit',function(e) {
		var riyousha_no_aidi = $('#riyousha_no_aidi').val();
		var meseiji_no_nakami = $('#meseiji_no_nakami').val();
		if( $('#riyousha_no_aidi').val()==undefined || 
			$('#meseiji_no_nakami').val()==undefined || 
			$('#riyousha_no_aidi').val()=="" || 
			$('#meseiji_no_nakami').val()=="" ){
			alert('Tolong isi dengan baik!');

			e.preventDefault();// Mencegah PHP submit form
			return;
		}else {
			e.preventDefault();
			  	
			$("#but_post").addClass("disabled");
			$("#but_post").attr("disabled", "disabled");
			$.ajax({
			  type: $(this).attr('method'),
			  url: $(this).attr('action'),
			  data: $(this).serialize(),
			  success: function() {
			  	notifikasi_suara = false; //matikan notifikasi
			  	updateMessages();
			  	$("#but_post").removeClass("disabled");
			  	cancel_reply(); // hilangkan reply-nya soalnya gak selamanya menjawab 1 message tertentu kan?
			  	$("#but_post").removeAttr("disabled");
			  	$('#meseiji_no_nakami').val("")
			  	$("#meseiji_no_nakami").focus();
			  	setTimeout( function(){
			  		notifikasi_suara = true; //hidupkan notifikasi lagi setelah 3 det
			  	},3000 );
			  	
			  },
			  fail: function(xhr, textStatus, errorThrown){
			     alert('Tolong isi dengan baik!');
			  }
			  
			});


		}
	});	


});



function aktifkan_bunyi(){
	notifikasi_suara = true; // kalau mouseout, dia bunyi
}

function nonaktifkan_bunyi(){
	notifikasi_suara = false;// kalau mouseover, dia ga bunyi
	
}	
// variable - variable penting

var notifikasi_suara = false;
var panjang_data = 0; // nilai inisialisasi utk membandingkan jumlah message.
var limit_pesan = 50; // jumlah awal message yang di-load 
var add = 50; // jumlah pesan yang akan ditambahkan pas mencet tombol
var riyousha_no_aidi = <?php echo getIdByUsername($users,$_SESSION['riyousha']) ?>;


function setOnline(){
	$.get("status_online.php?riyousha_no_aidi="+riyousha_no_aidi, function(data){
		$("#member-online").html(data);
	});
}

function hapus(aidi){
	var txt;
	var r = confirm("Yakin mau dihapus?");
	if (r == true) {
	  $.ajax({
	    url: 'delete_message.php?aidi='+aidi,
	    success: function(data) {
	      updateMessages();
	    },
	    fail: function() {
	    	alert("Pesan gagal dihapus");
	    }
	  });
	}
	
}

function goyangin(msg_id){
	$("#"+msg_id).animate({
      marginLeft: '-50px',
      marginRight: '-15px',
      opacity: '0.6'
    });
    $("#"+msg_id).animate({
      marginLeft: '-55px',
      marginRight: '-10px',
      opacity: '1'
    });
	$("#"+msg_id).animate({
      marginLeft: '-50px',
      marginRight: '-15px',
      opacity: '0.6'
    });
    $("#"+msg_id).animate({
      marginLeft: '-55px',
      marginRight: '-10px',
      opacity: '1'
    });
}

function scroll_to(element_id) {
	var b = eval($('#'+element_id).offset().top - 70);
    $('html').animate({
        scrollTop: b
    }, 1000);
    setTimeout(function() {
    	goyangin(element_id);
    },1000)
};

$("#tombol_pengaturan").click(function(){
	if ($(this).text() === "Pengaturan") {
        $(this).text("Tutup Pengaturan");
		$("#isi_pengaturan").show(200);
    } else {
        $(this).text("Pengaturan");
		$("#isi_pengaturan").hide(200);
    }
});

$("#tombol_show_member").click(function(){
	if ($(this).text() === "Tampilkan Member") {
        $(this).text("Sembunyikan Member");
		$("#member-online-container").show(200);
    } else {
        $(this).text("Tampilkan Member");
		$("#member-online-container").hide(200);
    }
});

  $(".switch_theme").click(function(){
    $("body").toggleClass("dark");
    $("body").toggleClass("light");
    if ($(this).text() === "Tema: Light") {
        $(this).text("Tema: Dark");
    } else {
        $(this).text("Tema: Light");
    }
  });
  $(".notifikasi_suara").click(function(){
    if ($(this).text() === "Suara: Hidup") {
        $(this).text("Suara: Mati");
        $(this).addClass("btn-secondary");
        $(this).removeClass("btn-info");
        notifikasi_suara = false;

    } else {
        $(this).text("Suara: Hidup");
        $(this).removeClass("btn-secondary");
        $(this).addClass("btn-info");
        notifikasi_suara = true;
    }
    
  });
/*
// Ranah update konten
*/

//to convert htmlentities using JS
function htmlentities(string){
    var encodedStr = string.replace(/[\u00A0-\u9999<>\&]/gim, function(i) {
       return '&#'+i.charCodeAt(0)+';';
    });
    return encodedStr.replace(/&/gim, '&amp;');
}

function reply(friend_id, msg_id){
	var pesan = $("#p-pesan-"+msg_id).text();
	pesan = htmlentities(pesan.substring(0,70))+"..."; // batasi sampai 70 karakter saja.
	// menyalin warna dari yang dipunyai teman
	var iro = $("#77").css("border-color");
	$("#replying-msg").css("border-color",iro);
	// Pastikan sesuai format yg ane bikin [[id_teman=id_pesan=isipesan]]. Ini nanti di-explode pake php
	var paket = "[["+friend_id+"="+msg_id+"="+pesan+"]]";
	$("#reply").val(paket);
	$('html').animate({ scrollTop: 0 }, 1000); // scroll ke paling atas
	$("#replying-msg").show(500);
	$("#replying-msg p").html(pesan);
	$("#meseiji_no_nakami").focus(); // fokus ke textarea lagi
}

function cancel_reply(){
	$("#reply").val(""); // kosongkan textarea utk reply
	$("#replying-msg").hide(500);
}

function getMessages(){
	$.get('count_messages.php', function(data){
		// Kalau nilai inisialisasinya masih (kosong), maka jangan update dan jangan bunyikan notifikasi 
		if ( data > panjang_data ) {
			updateMessages(); // kalau panjangnya barubah  berarti ada orang yg ngechat, maka update konten
			if ( notifikasi_suara == true && panjang_data != 0) { // bunyikan notifikasi
				playSound("time-is-now");
			}
		}
		panjang_data = data; // update nilai panjang
		// console.log("sedang_getMessages")
		// console.log(panjang_data)
		// console.log(data)
		// console.log(".")
	});
}

$("#tambahLimitPesan").click(function(){
	$(".chatMessages").append('<ul class="media-list"><li class="kotak"><img class="text-center" width="30" src="../assets/img/ajax-loader-black.gif" style="margin-left: 48%;"></li></ul>');
	limit_pesan = limit_pesan+add;
	$("#tambahLimitPesan").addClass("d-none");
	setTimeout(function(){
	  updateMessages(); // niar kelihatan loading hehe
	  // $("#tambahLimitPesan").removeClass("hidden");
	  
	}, 1500);
	$("#tambahLimitPesan").delay(1500).removeClass("d-none");
	
	
});
function updateMessages(){
	$.get('chatMessages.php?limit_pesan='+limit_pesan, function(data){
		$(".chatMessages").html(data); // update
	});
	
	// console.log("sedang_updateMessages")
}

	

</script>


<!--
/*
// Notifikasi Audio 
*/  
-->

<script>
	/**
	  * Plays a sound using the HTML5 audio tag. Provide mp3 and ogg files for best browser support.
	  * @param {string} filename The name of the file. Omit the ending!
	*/
	function playSound(filename){
	  var mp3Source = '<source src="../assets/sounds/' + filename + '.mp3" type="audio/mpeg">';
	  var oggSource = '<source src="../assets/sounds/' + filename + '.ogg" type="audio/ogg">';
	  var embedSource = '<embed hidden="true" autostart="true" loop="false" src="' + filename +'.mp3">';
	  document.getElementById("sound").innerHTML='<audio autoplay="autoplay">' + mp3Source + oggSource + embedSource + '</audio>';
	}

	

// Jalankan getMessages setiap 1/2 detik
setInterval(function(){
	getMessages();
	if (panjang_data > limit_pesan) {
		$("#tambahLimitPesan").removeClass("d-none");
	}
},500);

// update chatroom reguler per 60 detik
setInterval(function(){
	updateMessages();
},60000);

// update status online tiap 15 detik
setInterval(function(){
	setOnline();
},15000);


</script>