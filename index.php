<?php
include'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="icon" href="favicon.ico"/>

	<title>Source Code Sistem Pakar Metode Forward Chaining</title>
	<link href="assets/css/sandstone-bootstrap.min.css" rel="stylesheet"/>
	<link href="assets/css/general.css" rel="stylesheet"/>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>  
	<script src="assets/js/bootstrap.bundle.min.js"></script>  
	<script src="assets/js/jquery.slim.min.js"></script>           

  </head>
  <body>
  	
	<nav class="navbar navbar-default navbar-static-top">
	  <div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="?">SKRINING COVID-19</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
			  <ul class="nav navbar-nav">
				<?php if($_SESSION['login']):?>
				<a class="navbar-brand" href="?">ADMINISTRATOR</a>
				<li><a href="?m=kelompok"><span class="glyphicon glyphicon-pushpin"></span> Kelompok</a></li>
				<li><a href="?m=gejala"><span class="glyphicon glyphicon-flash"></span> Gejala</a></li>				
				<li><a href="?m=rule"><span class="glyphicon glyphicon-star"></span> Rule</a></li> 
				<li><a href="?m=cek_rule&act=new"><span class="glyphicon glyphicon-stats"></span> Cek Konsultasi</a></li>
				<li><a href="?m=rumahsakit"><span class="glyphicon glyphicon-tint"></span> Rumah Sakit</a></li>   
				<li><a href="?m=password_ubah"><span class="glyphicon glyphicon-lock"></span> Ubah Password</a></li>
				<li><a onclick="return confirm('Anda yakin keluar?')" href="aksi.php?act=logout" ><span class="glyphicon glyphicon-off"></span> Logout</a></li>
				<?php else:?>
				<li><a href="?m=input_user" class="btn btn-hover"><span class="glyphicon glyphicon-stats"></span> Konsultasi </a></li>    
				<li><a href="?m=info_rs"><span class="glyphicon glyphicon-info-sign"></span> Informasi Rumah Sakit Rujukan</a></li>   
				<li><a href="?m=tentang"><span class="glyphicon glyphicon-phone"></span> Tentang</a></li>
				<li class="pull-right"><a href="?m=login"><span class="glyphicon glyphicon-log-in"></span> Login Admin</a></li>            
				<?php endif?>    
			  </ul>          
			</div>
		</div>
	</nav>
	
	<div class="container">
	<?php
		if(in_array($mod, array('kelompok', 'gejala', 'rule', 'password', 'rumahsakit')) && !$_SESSION['login']){
			redirect_js('?m=login');
		}
		if(file_exists($mod.'.php')){
			include $mod.'.php';
		}
		else{
			include 'home.php';
		}
	?>
	</div>
	<footer class="footer bg-primary">
	  <div class="container">
			<p>Copyright &copy; <?=date('Y')?> <em class="pull-right">By 1611510767 UBL Clandy Febriana</em></p>

	  </div>
	</footer>
	</body>
</html>