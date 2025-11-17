<?php define("GUVENLIK",true);?>
<?php
require_once('../_class/baglan.php');
require_once('../_class/fonksiyon.php');
require_once('../_class/class.upload.php');
require_once('../language/admin_dil.php');
require_once('../_class/yonetim_seo.php');
?> 
<?php 
$url="//".$_SERVER["HTTP_HOST"].dirname($_SERVER['PHP_SELF']);
$sayfalink = "//".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
?>
<?php 
$sayfa=isset($_GET['sayfa']) ? addslashes($_GET['sayfa']) : "";
$oturumkontrol = $db->prepare("SELECT * FROM kullanici WHERE BINARY id = ? AND kadi = ? AND sifre = ? AND rutbe = ?");
$oturumkontrol->execute(array($_SESSION['Yonetim_Id'],$_SESSION['Yonetim_Kadi'],$_SESSION['Yonetim_Sifre'],$_SESSION['rutbe']));
if($oturumkontrol->rowCount())
{
	$Bilgilerim = $oturumkontrol->fetch(PDO::FETCH_ASSOC);
	if($sayfa!="yonetici-ekle")
	{
		if($Bilgilerim['sifre'] == "1234" || $Bilgilerim['sifre'] == "demo" || $Bilgilerim['sifre'] == "admin" || $Bilgilerim['sifre'] == "123" || $Bilgilerim['sifre'] == "1234" || $Bilgilerim['sifre'] == "123456" || $Bilgilerim['sifre'] == "123" || $Bilgilerim['sifre'] == "user" || $Bilgilerim['sifre'] == "1" ){
		header("Location:".$url."/yonetici-duzenle/".$Bilgilerim['id']."".$html."");
		exit();	
		}
	}
}
else
{
	unset($_SESSION['Yonetim_Id']);
	unset($_SESSION['Yonetim_Kadi']);
	unset($_SESSION['Yonetim_Sifre']);
	unset($_SESSION['rutbe']);
	unset($_SESSION['guvenlik']);
	header("Location:".$url."/giris".$html."");
	exit();
}
?>
<meta charset="utf-8">
<?php
$ua=getBrowser();
$tarayici= "Web tarayucınız: " . $ua['name'] . " " . $ua['version'] . " " .$ua['platform'];
//Örneğin mozilla Firefox kullananların girmesini istemiyorsak
if ($ua['name']=='Mozilla Firefox'){
	print_r($tarayici);	
	echo "<center>";
	echo "<h2>Mozilla Firefox tarayıcısı desteklenmiyor.</h2><br>" ;
	echo "<h4>Lütfen Internet Explorer, Opera, Safari, Chrome tarayıcılarından birini kullanınız.</h4>";
	echo "</center>";
	exit();
}?>
<?php 
if (isset($_GET['dil']) && is_numeric($_GET['dil'])) 
{
    $_SESSION['admin_dil'] = @$_GET['dil'];
}
if(!isset($_SESSION['admin_dil']))
{
    $mevcutDil  = $db->query("SELECT * FROM diller WHERE anadil = 1")->fetch(PDO::FETCH_ASSOC);
    $_SESSION['admin_dil'] = @$mevcutDil['id'];
}
else
{
    $mevcutDil = $db->query("SELECT * FROM diller WHERE id = {$_SESSION['admin_dil']}");
    $mevcutDil = $mevcutDil->fetch(PDO::FETCH_ASSOC);
    $_SESSION['admin_dil'] = @$mevcutDil['id'];
}
?>
<?php
if($moduller['alan20'] == "1"){
	$html = ".html";
}
else
{
	$html = "";
}	
?>
<!DOCTYPE html>
<html lang="tr">
<head>
	<base href="<?php echo $url;?>/<?php echo yonetim; ?>">
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $title;?></title>
	<!-- plugins:css -->
	<link rel="stylesheet" href="vendors/iconfonts/mdi/font/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
	<link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
	<link href="https://fonts.googleapis.com/css?family=Fira+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Titillium+Web:300,400,600,700&display=swap" rel="stylesheet">
	<!-- endinject -->
	<link rel="stylesheet" href="vendors/iconfonts/ti-icons/css/themify-icons.css">
	<link rel="stylesheet" href="vendors/iconfonts/simple-line-icon/css/simple-line-icons.css">
	<link rel="stylesheet" href="vendors/iconfonts/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="vendors/iconfonts/font-awesome/css/all.css" />
	<link rel="stylesheet" href="vendors/iconfonts/flag-icon-css/css/flag-icon.min.css" />
	<link rel="stylesheet" href="vendors/multiselect2/css/multi-select.css" type="text/css" />
	
	<link rel="stylesheet" href="vendors/lightgallery/css/lightgallery.css">
	<link rel="stylesheet" href="vendors/summernote/dist/summernote-bs4.css">
	<!-- inject:css -->
	<link rel="stylesheet" href="css/vertical-layout-light/style.css">
	<!-- endinject -->
	<link rel="shortcut icon" href="images/favicon.png" />
	
	<!-- codemirror css -->
	<link href="vendors/codemirror/lib/codemirror.css" rel="stylesheet" type="text/css" />
	<link href="vendors/codemirror/theme/neat.css" rel="stylesheet" type="text/css" />
	<link href="vendors/codemirror/theme/ambiance.css" rel="stylesheet" type="text/css" />
	<link href="vendors/codemirror/theme/material.css" rel="stylesheet" type="text/css" />
	<link href="vendors/codemirror/theme/neo.css" rel="stylesheet" type="text/css" />
	<link href="vendors/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
	
	<!--Perfect-Scrollbar css-->
    <link rel="stylesheet" href="vendors/css/perfect-scrollbar.min.css">
	<link rel="stylesheet" href="vendors/css/jquery.mCustomScrollbar.css">
	
	<!--Multi Select css-->
	<link rel="stylesheet" href="vendors/multiselect/jquery.multiselect.css">

	
	<!-- plugins:js -->
	<script src="vendors/js/vendor.bundle.base.js"></script>
	<script src="vendors/js/vendor.bundle.addons.js"></script>
	<!-- endinject -->
	<script src="vendors/lightgallery/js/lightgallery-all.min.js"></script>
	<script src="vendors/tinymce/tinymce.min.js"></script>
	<!-- codemirror js -->
	<script src="vendors/codemirror/lib/codemirror.js" type="text/javascript"></script>
	<script src="vendors/codemirror/addon/edit/matchbrackets.js" type="text/javascript"></script>
	<script src="vendors/codemirror/mode/htmlmixed/htmlmixed.js" type="text/javascript"></script>
	<script src="vendors/codemirror/mode/xml/xml.js" type="text/javascript"></script>
	<script src="vendors/codemirror/mode/javascript/javascript.js" type="text/javascript"></script>
	<script src="vendors/codemirror/mode/css/css.js" type="text/javascript"></script>
	<script src="vendors/codemirror/mode/clike/clike.js" type="text/javascript"></script>
	<script src="vendors/codemirror/mode/php/php.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(function() {
			var pageTitle = $("title").text();
			$(window).blur(function() {
				$("title").text("<?=@$admindil['txt160'];?>");
			});
			$(window).focus(function() {
				$("title").text(pageTitle);
			});
		});
	</script>
	
	<style>
.bootstrap-select>.dropdown-toggle {
    padding-top: 8px;
    padding-bottom: 8px;
    border-radius: 5px;
}
.select2-container-multi .select2-choices .select2-search-field input {
    padding: 7px 5px;
}
.select2-container-multi .select2-choices .select2-search-choice{
	background-color: #f5f5f5;
    border: 1px solid #e3e3e3;
    border-radius: 1px;
    padding: 7px 20px;
}
.select2-container-multi .select2-search-choice-close {
    left: 5px;
    margin-top: 4px;
}
</style>

				<style>
								/* Main Search with Maps */
#map-container .main-search-container {
	position: absolute;
	bottom: 50px;
	left: 50%;
	transform: translate(-50%, 100%);
	z-index: 9999;
	transition: all 0.4s;
	width: auto;
}
#map-container .main-search-container.active {
	position: absolute;
	bottom: 40px;
	left: 50%;
	transform: translate(-50%, 0);
	z-index: 9999;
}
#map-container .main-search-form {
	width: 100%;
	margin-top: 0;
}
#map-container .main-search-box {
	padding-bottom: 15px;
	margin-top: 0;
	border-radius: 0 3px 3px 3px;
}
#map-container.homepage-map {
	height: 580px;
	overflow: hidden;
}
@media (max-width: 1369px) {
	#map-container.homepage-map {
		height: 480px;
	}
}
#map-container.homepage-map.overflow {
	overflow: visible;
}
a.button.adv-search-btn {
	color: #fff;
	border-radius: 3px 3px 0 0;
	font-size: 16px;
	padding: 0 24px;
	position: relative;
	z-index: 9999;
	margin: 0;
	height: 50px;
	line-height: 50px;
	display: inline-block;
	overflow: visible;
}
a.adv-search-btn i {
	font-size: 14px;
	margin-left: 7px;
	transition: 0.2s;
}
a.adv-search-btn.active i.fa.fa-caret-up {
	transform: rotate(-540deg);
}
 #map {
   width: 100%; height: 100%; padding: 0; margin: 0;
}
		

			
    </style>

	<script src="https://api-maps.yandex.ru/2.1/?lang=tr_TR&amp;apikey=f225c725-dda6-42d7-aee6-b822af2b3216" type="text/javascript"></script>
</head>
<body>
	<div class="container-scroller">
		
		<div class="theme-setting-wrapper">
			<div id="settings-trigger"><i class="flag-icon <?=@$mevcutDil['bayrak'];?>"></i></div>
			<div id="theme-settings" class="settings-panel">
				<i class="settings-close mdi mdi-close"></i>
				<p class="settings-heading">Düzenleme Dili</p>
				<?php $DILSorgu = $db->prepare("SELECT * FROM diller ORDER BY sira ASC");
				$DILSorgu->execute();
				$DILislem = $DILSorgu->fetchALL(PDO::FETCH_ASSOC);?>
				<?php foreach ( $DILislem as $DILSonuc ){?>
				<div class="sidebar-bg-options <?php echo($mevcutDil['id'] == $DILSonuc['id'] ? 'selected' : '' );?>">
					<a href="index<?php echo $html;?>?dil=<?=$DILSonuc['id'];?>"><div class="flag-icon <?=$DILSonuc['bayrak'];?> mr-3"></div><?=@$DILSonuc['adi'];?></a>
				</div>
				<?php } ?>
			</div>
		</div>
	
		<!-- partial:partials/_navbar.html -->
		<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
			<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
				<a class="navbar-brand brand-logo" href="index<?php echo $html;?>">YÖNETİM PANELİ</a>
				<a class="navbar-brand brand-logo-mini" href="index<?php echo $html;?>"><img src="images/logo-mini.svg" alt="logo"/></a>
			</div>
			<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
				<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
				<span class="mdi mdi-apps"></span>
				</button>
				<ul class="navbar-nav mr-lg-2">
					<li class="nav-item nav-search d-none d-lg-block">
						<a href="../" target="_blank" class="btn btn-primary btn-sm"><i class="mdi mdi-home-outline font-13"></i> Siteyi Görüntüle</a>
					</li>
				</ul>
				<ul class="navbar-nav navbar-nav-right">
					<li class="nav-item dropdown">
						<a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="notificationDropdown" href="#" data-toggle="dropdown">
						<i class="mdi mdi-email-outline mx-0"></i>
						<span class="count count-email"></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pt-0" aria-labelledby="messageDropdown">
							<p class="mb-0 font-weight-normal float-left dropdown-header bg-dark text-white w-100">Bugün Gelen Mesajlar</p>
							<?php 
							$bgntarih	= tr_tarih('Y-m-d');
							$buguntarih = strtotime($bgntarih);
							$Sorgu = $db->prepare("SELECT * FROM mesajlar WHERE buguntarih = ? ORDER BY id ASC");
							$Sorgu->execute(array($buguntarih));						
							$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
							<?php if($Sorgu->rowCount() != "0"){?>
							<?php foreach ( $islem as $Sonuc ){?>
							<a class="dropdown-item preview-item">
								<div class="preview-item-content flex-grow">
									<h6 class="preview-subject ellipsis font-weight-normal"><?php echo $Sonuc['isim']?>
									</h6>
									<p class="font-weight-light small-text text-muted mb-0">
										<?php echo $Sonuc['konu']?>
									</p>
								</div>
							</a>
							<?php }?>
							<?php }else{?>
							<p class="text-center pt-5 text-muted">Bugün gelen mesaj yok.</p>
							<?php }?>
						</div>
					</li>
					
					<li class="nav-item nav-profile dropdown">
						<a class="nav-link dropdown-toggle" href="yonetici-duzenle/<?php echo $Bilgilerim['id'];?><?php echo $html;?>" data-toggle="dropdown" id="profileDropdown">
						<?php if($Bilgilerim['resim'] != ""){?>
						<img src="images/users/<?php echo $Bilgilerim['resim'];?>" alt="<?php echo $Bilgilerim['isim'];?>">
						<?php }else{?>
						<img src="images/users/avatar.jpg" alt="<?php echo $Bilgilerim['isim'];?>">
						<?php }?>
						</a>
						<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
							<a href="yonetici-duzenle/<?php echo $Bilgilerim['id'];?><?php echo $html;?>" class="dropdown-item">
								<i class="icon-user text-primary"></i>
								Profili Görüntüle
							</a>
							<a href="genel-ayarlar<?php echo $html;?>" class="dropdown-item">
								<i class="icon-settings text-primary"></i>
								Ayarlar
							</a>
							<a href="../_class/yonetim_islem.php?cikis=ok" class="dropdown-item">
								<i class="icon-power text-primary"></i>
								Oturumu Kapat
							</a>
						</div>
					</li>
				</ul>
				<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
				<span class="mdi mdi-menu"></span>
				</button>
			</div>
		</nav>	
		<!-- partial -->
		<div class="container-fluid page-body-wrapper">
			<!-- partial:partials/_sidebar.html -->
			<nav class="sidebar sidebar-offcanvas" id="sidebar">
				<ul class="nav">
					<li class="nav-item sidebar-category mt-4">
						<span style="margin-left: -10px;"><?=@$admindil['txt1_1'];?></span>
					</li>
					<li class="nav-item <?php echo $anasayfa; ?>">
						<a class="nav-link" href="./">
						<i class="icon-home  menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt1'];?></span>
						</a>
					</li>
					
					<li class="nav-item <?php echo $genelayarlar; ?> <?php echo $apiayarlari; ?> <?php echo $alisverisayarlari; ?> <?php echo $iletisimayarlari; ?> <?php echo $sitebakimmodu; ?> <?php echo $resimoptimize; ?> <?php echo $limitayarlari; ?> <?php echo $modulayarlari; ?> <?php echo $sosyalmedyaayarlari; ?> <?php echo $mailayarlari; ?> <?php echo $smsayarlari; ?> <?php echo $popup; ?> <?php echo $sanalposlar; ?>">
						<a class="nav-link" data-toggle="collapse" href="#site-yonetimi" aria-expanded="false" aria-controls="site-yonetimi">
						<i class="icon-settings menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt2'];?></span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse <?php echo $ayarlarshow;?>" id="site-yonetimi">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item <?php echo $genelayarlar; ?>"> 
									<a class="nav-link <?php echo $genelayarlar; ?>" href="genel-ayarlar<?php echo $html;?>"><?=@$admindil['txt3'];?></a>
								</li>
								<li class="nav-item <?php echo $popup; ?>"> 
									<a class="nav-link <?php echo $popup; ?>" href="popup<?php echo $html;?>"><?=@$admindil['txt99'];?></a>
								</li>
								<li class="nav-item <?php echo $temaayarlari; ?>"> 
									<a class="nav-link <?php echo $temaayarlari; ?>" href="tema-ayarlari<?php echo $html;?>">Tema Ayarları</a>
								</li>
								<li class="nav-item <?php echo $apiayarlari; ?>"> 
									<a class="nav-link <?php echo $apiayarlari; ?>" href="api-ayarlari<?php echo $html;?>"><?=@$admindil['txt4'];?></a>
								</li>
															
								<li class="nav-item <?php echo $iletisimayarlari; ?>"> 
									<a class="nav-link <?php echo $iletisimayarlari; ?>" href="iletisim-ayarlari<?php echo $html;?>"><?=@$admindil['txt5'];?></a>
								</li>
								<li class="nav-item <?php echo $sosyalmedyaayarlari; ?>"> 
									<a class="nav-link <?php echo $sosyalmedyaayarlari; ?>" href="sosyal-medya-ayarlari<?php echo $html;?>"><?=@$admindil['txt6'];?></a>
								</li>
								<li class="nav-item <?php echo $modulayarlari; ?>"> 
									<a class="nav-link <?php echo $modulayarlari; ?>" href="modul-ayarlari<?php echo $html;?>"><?=@$admindil['txt7'];?></a>
								</li>
								<li class="nav-item <?php echo $anasayfamodulsiralama; ?>"> 
									<a class="nav-link <?php echo $anasayfamodulsiralama; ?>" href="anasayfa-modul-siralama<?php echo $html;?>"><?=@$admindil['txt159'];?></a>
								</li>
								<li class="nav-item <?php echo $limitayarlari; ?>"> 
									<a class="nav-link <?php echo $limitayarlari; ?>" href="limit-ayarlari<?php echo $html;?>"><?=@$admindil['txt8'];?></a>
								</li>
								<li class="nav-item <?php echo $sitebakimmodu; ?>"> 
									<a class="nav-link <?php echo $sitebakimmodu; ?>" href="site-bakim-modu<?php echo $html;?>"><?=@$admindil['txt9'];?></a>
								</li>
								<li class="nav-item <?php echo $mailayarlari; ?>"> 
									<a class="nav-link <?php echo $mailayarlari; ?>" href="mail-ayarlari<?php echo $html;?>"><?=@$admindil['txt10'];?></a>
								</li>
								<li class="nav-item <?php echo $smsayarlari; ?>"> 
									<a class="nav-link <?php echo $smsayarlari; ?>" href="sms-ayarlari<?php echo $html;?>"><?=@$admindil['txt11'];?></a>
								</li>
								
							</ul>
						</div>
					</li>
					
					<li class="nav-item <?php echo $dilekle; ?> <?php echo $dillistele; ?> <?php echo $admindilduzenle; ?>">
						<a class="nav-link" data-toggle="collapse" href="#dil-yonetimi" aria-expanded="false" aria-controls="dil-yonetimi">
						<i class="icon-globe menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt13'];?></span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse <?php echo $dilshow;?>" id="dil-yonetimi">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item <?php echo $dilekle; ?>"> 
									<a class="nav-link <?php echo $dilekle; ?>" href="dil-ekle<?php echo $html;?>"><?=@$admindil['txt16'];?></a>
								</li>
								<li class="nav-item <?php echo $dillistele; ?>"> 
									<a class="nav-link <?php echo $dillistele; ?>" href="dil-listele<?php echo $html;?>"><?=@$admindil['txt15'];?></a>
								</li>
								<li class="nav-item <?php echo $admindilduzenle; ?>"> 
									<a class="nav-link <?php echo $admindilduzenle; ?>" href="admin-dil-duzenle<?php echo $html;?>"><?=@$admindil['txt15_1'];?></a>
								</li>						
							</ul>
						</div>
					</li>
					
					<li class="nav-item <?php echo $headermenu; ?> <?php echo $footermenu; ?> <?php echo $sabitlinkler; ?>">
						<a class="nav-link" data-toggle="collapse" href="#menu-yonetimi" aria-expanded="false" aria-controls="menu-yonetimi">
						<i class="icon-menu menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt17'];?></span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse <?php echo $menushow;?>" id="menu-yonetimi">
							<ul class="nav flex-column sub-menu">								
								<li class="nav-item <?php echo $headermenu; ?>"> 
									<a class="nav-link <?php echo $headermenu; ?>" href="header-menu<?php echo $html;?>"><?=@$admindil['txt18'];?></a>
								</li>
								<li class="nav-item <?php echo $footermenu; ?>"> 
									<a class="nav-link <?php echo $footermenu; ?>" href="footer-menu<?php echo $html;?>"><?=@$admindil['txt22'];?></a>
								</li>
								<li class="nav-item <?php echo $sabitlinkler; ?>"> 
									<a class="nav-link <?php echo $sabitlinkler; ?>" href="sabit-linkler<?php echo $html;?>"><?=@$admindil['txt24'];?></a>
								</li>
							</ul>
						</div>
					</li>					
					
					<li class="nav-item <?php echo $rehberim; ?> <?php echo $rehberekle; ?> <?php echo $topluemail; ?> <?php echo $toplusms; ?> <?php echo $bildirimsablonlari; ?> <?php echo $tummusteriler; ?> <?php echo $engellenenmusteriler; ?> <?php echo $musteriekle; ?> <?php echo $musteriduzenle; ?>">
						<a class="nav-link" data-toggle="collapse" href="#rehber-yonetimi" aria-expanded="false" aria-controls="rehber-yonetimi">
						<i class="icon-people menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt26'];?></span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse <?php echo $rehbershow;?>" id="rehber-yonetimi">
							<ul class="nav flex-column sub-menu">
				
								<li class="nav-item <?php echo $tummusteriler; ?> <?php echo $musteriekle; ?> <?php echo $musteriduzenle; ?>">
                                    <a class="nav-link <?php echo $tummusteriler; ?> <?php echo $musteriekle; ?> <?php echo $musteriduzenle; ?>" href="tum-musteriler<?php echo $html;?>"><?=@$admindil['txt143'];?></a>
                                </li>                             
								<li class="nav-item <?php echo $rehberim; ?> <?php echo $rehberekle; ?>"> 
									<a class="nav-link <?php echo $rehberim; ?> <?php echo $rehberekle; ?>" href="rehberim<?php echo $html;?>"><?=@$admindil['txt27'];?></a>
								</li>
								<li class="nav-item <?php echo $topluemail; ?>"> 
									<a class="nav-link <?php echo $topluemail; ?>" href="toplu-email<?php echo $html;?>"><?=@$admindil['txt30'];?></a>
								</li>
								<li class="nav-item <?php echo $toplusms; ?>"> 
									<a class="nav-link <?php echo $toplusms; ?>" href="toplu-sms<?php echo $html;?>"><?=@$admindil['txt31'];?></a>
								</li>
								<li class="nav-item <?php echo $bildirimsablonlari; ?>"> 
									<a class="nav-link <?php echo $bildirimsablonlari; ?>" href="bildirim-sablonlari<?php echo $html;?>"><?=@$admindil['txt32'];?></a>
								</li>
							</ul>
						</div>
					</li>
					
					
					<li class="nav-item sidebar-category mt-4">
						<span style="margin-left: -10px;"><?=@$admindil['txt34'];?></span>
					</li>
					
					<li class="nav-item position-relative <?php echo $iller; ?>">
						<a class="nav-link" data-toggle="collapse" href="#ililceyonetimi" aria-expanded="false" aria-controls="ililceyonetimi">
						<i class="icon-location-pin menu-icon"></i>
						<span class="menu-title">İl / İlçe / Semt</span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse <?php echo $ililceshow;?>" id="ililceyonetimi">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item <?php echo $iller; ?>"> 
									<a class="nav-link <?php echo $iller; ?>" href="iller<?php echo $html;?>">İller</a>
								</li>
							</ul>
						</div>
					</li>
					
					<li class="nav-item position-relative <?php echo $emlaklar; ?> <?php echo $emlak_kategori; ?> <?php echo $varyant_kategori; ?> <?php echo $ozellik_gruplari; ?> <?php echo $ozellik_degerleri; ?>">
						<a class="nav-link" data-toggle="collapse" href="#emlak-yonetimi" aria-expanded="false" aria-controls="emlak-yonetimi">
						<i class="icon-drawer menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt57'];?></span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse <?php echo $emlakshow;?>" id="emlak-yonetimi">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item <?php echo $emlaklar; ?>"> 
									<a class="nav-link <?php echo $emlaklar; ?>" href="emlaklar<?php echo $html;?>"><?=@$admindil['txt59'];?></a>
								</li>
								<li class="nav-item <?php echo $emlaklar; ?>"> 
									<a class="nav-link <?php echo $emlaklar; ?>" href="emlak-mesajlar<?php echo $html;?>">Emlak Danışman Mesajları</a>
								</li>
								
								<li class="nav-item <?php echo $emlak_kategori; ?>"> 
									<a class="nav-link <?php echo $emlak_kategori; ?>" href="emlak-kategoriler<?php echo $html;?>"><?=@$admindil['txt62'];?></a>
								</li>								
								<li class="nav-item <?php echo $emlaklar; ?>"> 
									<a class="nav-link <?php echo $emlaklar; ?>" href="uyeemlaklar<?php echo $html;?>">Üye İlanları</a>
								</li>								
								<li class="nav-item <?php echo $ozellik_gruplari; ?>"> 
									<a class="nav-link <?php echo $ozellik_gruplari; ?>" href="ozellik-gruplari<?php echo $html;?>"><?=@$admindil['txt64'];?></a>
								</li>
							</ul>
						</div>
					</li>
					<li class="nav-item position-relative <?php echo $projeler; ?> <?php echo $proje_kategori; ?>">
						<a class="nav-link" data-toggle="collapse" href="#proje-yonetimi" aria-expanded="false" aria-controls="proje-yonetimi">
						<i class="icon-layers menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt42'];?></span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse <?php echo $projeshow;?>" id="proje-yonetimi">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item <?php echo $projeler; ?>"> 
									<a class="nav-link <?php echo $projeler; ?>" href="projeler<?php echo $html;?>"><?=@$admindil['txt44'];?></a>
								</li>
								<li class="nav-item <?php echo $proje_kategori; ?>"> 
									<a class="nav-link <?php echo $proje_kategori; ?>" href="proje-kategoriler<?php echo $html;?>"><?=@$admindil['txt47'];?></a>
								</li>
							</ul>
						</div>
					</li>

					<li class="nav-item position-relative <?php echo $paketler; ?> <?php echo $paket_kategori; ?>">
						<a class="nav-link" data-toggle="collapse" href="#paket-yonetimi" aria-expanded="false" aria-controls="paket-yonetimi">
						<i class="icon-rocket menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt123'];?></span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse <?php echo $paketshow;?>" id="paket-yonetimi">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item <?php echo $paketler; ?>"> 
									<a class="nav-link <?php echo $paketler; ?>" href="paketler<?php echo $html;?>"><?=@$admindil['txt125'];?></a>
								</li>
								<li class="nav-item <?php echo $paket_kategori; ?>"> 
									<a class="nav-link <?php echo $paket_kategori; ?>" href="paket-kategoriler<?php echo $html;?>"><?=@$admindil['txt128'];?></a>
								</li>
							</ul>
						</div>
					</li>	
					
					<li class="nav-item <?php echo $sayfaekle; ?> <?php echo $sayfalistele; ?>">
						<a class="nav-link" data-toggle="collapse" href="#sayfa-yonetimi" aria-expanded="false" aria-controls="sayfa-yonetimi">
						<i class="icon-note menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt49'];?></span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse <?php echo $sayfalarshow;?>" id="sayfa-yonetimi">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item <?php echo $sayfaekle; ?>"> 
									<a class="nav-link <?php echo $sayfaekle; ?>" href="sayfa-ekle<?php echo $html;?>"><?=@$admindil['txt52'];?></a>
								</li>
								<li class="nav-item <?php echo $sayfalistele; ?>"> 
									<a class="nav-link <?php echo $sayfalistele; ?>" href="sayfa-listele<?php echo $html;?>"><?=@$admindil['txt51'];?></a>
								</li>
							</ul>
						</div>
					</li>
					<li class="nav-item <?php echo $hizmetekle; ?> <?php echo $hizmetlistele; ?>">
						<a class="nav-link" data-toggle="collapse" href="#hizmet-yonetimi" aria-expanded="false" aria-controls="hizmet-yonetimi">
						<i class="icon-docs menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt53'];?></span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse <?php echo $hizmetlershow;?>" id="hizmet-yonetimi">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item <?php echo $hizmetekle; ?>"> 
									<a class="nav-link <?php echo $hizmetekle; ?>" href="hizmet-ekle<?php echo $html;?>"><?=@$admindil['txt56'];?></a>
								</li>
								<li class="nav-item <?php echo $hizmetlistele; ?>"> 
									<a class="nav-link <?php echo $hizmetlistele; ?>" href="hizmet-listele<?php echo $html;?>"><?=@$admindil['txt55'];?></a>
								</li>
							</ul>
						</div>
					</li>
					<li class="nav-item <?php echo $soruekle; ?> <?php echo $sorulistele; ?>">
						<a class="nav-link" data-toggle="collapse" href="#soru-yonetimi" aria-expanded="false" aria-controls="soru-yonetimi">
						<i class="icon-question menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt105'];?></span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse <?php echo $sorushow;?>" id="soru-yonetimi">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item <?php echo $sorulistele; ?>"> 
									<a class="nav-link <?php echo $sorulistele; ?>" href="soru-listele<?php echo $html;?>"><?=@$admindil['txt107'];?></a>
								</li>
								<li class="nav-item <?php echo $soruekle; ?>"> 
									<a class="nav-link <?php echo $soruekle; ?>" href="soru-ekle<?php echo $html;?>"><?=@$admindil['txt108'];?></a>
								</li>								
							</ul>
						</div>
					</li>
					<li class="nav-item <?php echo $referansekle; ?> <?php echo $referanslistele; ?>">
						<a class="nav-link" data-toggle="collapse" href="#referans-yonetimi" aria-expanded="false" aria-controls="referans-yonetimi">
						<i class="icon-magnifier-add menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt67'];?></span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse <?php echo $referansshow; ?>" id="referans-yonetimi">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item <?php echo $referansekle; ?>"> 
									<a class="nav-link <?php echo $referansekle; ?>" href="referans-ekle<?php echo $html;?>"><?=@$admindil['txt70'];?></a>
								</li>
								<li class="nav-item <?php echo $referanslistele; ?>"> 
									<a class="nav-link <?php echo $referanslistele; ?>" href="referans-listele<?php echo $html;?>"><?=@$admindil['txt69'];?></a>
								</li>
							</ul>
						</div>
					</li>
					<li class="nav-item <?php echo $belgeekle; ?> <?php echo $belgelistele; ?>">
						<a class="nav-link" data-toggle="collapse" href="#belge-yonetimi" aria-expanded="false" aria-controls="belge-yonetimi">
						<i class="icon-docs menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt71'];?></span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse <?php echo $belgeshow; ?>" id="belge-yonetimi">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item <?php echo $belgeekle; ?>"> 
									<a class="nav-link <?php echo $belgeekle; ?>" href="belge-ekle<?php echo $html;?>"><?=@$admindil['txt74'];?></a>
								</li>
								<li class="nav-item <?php echo $belgelistele; ?>"> 
									<a class="nav-link <?php echo $belgelistele; ?>" href="belge-listele<?php echo $html;?>"><?=@$admindil['txt73'];?></a>
								</li>
							</ul>
						</div>
					</li>
					<li class="nav-item <?php echo $katalogekle; ?> <?php echo $kataloglistele; ?>">
						<a class="nav-link" data-toggle="collapse" href="#katalog-yonetimi" aria-expanded="false" aria-controls="katalog-yonetimi">
						<i class="icon-folder-alt menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt109'];?></span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse <?php echo $katalogshow;?>" id="katalog-yonetimi">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item <?php echo $katalogekle; ?>"> 
									<a class="nav-link <?php echo $katalogekle; ?>" href="katalog-ekle<?php echo $html;?>"><?=@$admindil['txt112'];?></a>
								</li>
								<li class="nav-item <?php echo $kataloglistele; ?>"> 
									<a class="nav-link <?php echo $kataloglistele; ?>" href="katalog-listele<?php echo $html;?>"><?=@$admindil['txt111'];?></a>
								</li>
							</ul>
						</div>
					</li>
					<li class="nav-item <?php echo $ekipekle; ?> <?php echo $ekiplistele; ?>">
						<a class="nav-link" data-toggle="collapse" href="#ekip-yonetimi" aria-expanded="false" aria-controls="ekip-yonetimi">
						<i class="icon-user menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt119'];?></span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse <?php echo $ekipshow;?>" id="ekip-yonetimi">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item <?php echo $ekipekle; ?>"> 
									<a class="nav-link <?php echo $ekipekle; ?>" href="ekip-ekle<?php echo $html;?>"><?=@$admindil['txt122'];?></a>
								</li>
								<li class="nav-item <?php echo $ekiplistele; ?>"> 
									<a class="nav-link <?php echo $ekiplistele; ?>" href="ekip-listele<?php echo $html;?>"><?=@$admindil['txt121'];?></a>
								</li>
							</ul>
						</div>
					</li>
							
										
					<li class="nav-item <?php echo $haberekle; ?> <?php echo $haberlistele; ?>">
						<a class="nav-link" data-toggle="collapse" href="#haber-yonetimi" aria-expanded="false" aria-controls="haber-yonetimi">
						<i class="icon-book-open menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt77'];?></span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse <?php echo $habershow; ?>" id="haber-yonetimi">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item <?php echo $haberekle; ?>"> 
									<a class="nav-link <?php echo $haberekle; ?>" href="haber-ekle<?php echo $html;?>"><?=@$admindil['txt80'];?></a>
								</li>
								<li class="nav-item <?php echo $haberlistele; ?>"> 
									<a class="nav-link <?php echo $haberlistele; ?>" href="haber-listele<?php echo $html;?>"><?=@$admindil['txt79'];?></a>
								</li>
							</ul>
						</div>
					</li>					
					<li class="nav-item <?php echo $sliderekle; ?> <?php echo $sliderlistele; ?>">
						<a class="nav-link" data-toggle="collapse" href="#slider-yonetimi" aria-expanded="false" aria-controls="slider-yonetimi">
						<i class="icon-picture menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt81'];?></span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse <?php echo $slidershow; ?>" id="slider-yonetimi">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item <?php echo $sliderekle; ?>"> 
									<a class="nav-link <?php echo $sliderekle; ?>" href="slider-ekle<?php echo $html;?>"><?=@$admindil['txt84'];?></a>
								</li>
								<li class="nav-item <?php echo $sliderlistele; ?>"> 
									<a class="nav-link <?php echo $sliderlistele; ?>" href="slider-listele<?php echo $html;?>"><?=@$admindil['txt83'];?></a>
								</li>
							</ul>
						</div>
					</li>
					
					
					<li class="nav-item <?php echo $bankahesapekle; ?> <?php echo $bankahesaplari; ?>">
                        <a class="nav-link" data-toggle="collapse" href="#banka-hesaplari" aria-expanded="false" aria-controls="banka-hesaplari">
                            <i class="icon-wallet menu-icon"></i>
                            <span class="menu-title"><?=@$admindil['txt133'];?></span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse <?php echo $bankahesapshow; ?>" id="banka-hesaplari">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item <?php echo $bankahesapekle; ?>">
                                    <a class="nav-link <?php echo $bankahesapekle; ?>" href="banka-hesap-ekle<?php echo $html;?>"><?=@$admindil['txt134'];?></a>
                                </li>
                                <li class="nav-item <?php echo $bankahesaplari; ?>">
                                    <a class="nav-link <?php echo $bankahesaplari; ?>" href="banka-hesaplari<?php echo $html;?>"><?=@$admindil['txt136'];?></a>
                                </li>
                            </ul>
                        </div>
                    </li>
					<li class="nav-item <?php echo $yoneticiekle; ?> <?php echo $yoneticilistele; ?>">
						<a class="nav-link" data-toggle="collapse" href="#yoneticiler" aria-expanded="false" aria-controls="yoneticiler">
						<i class="icon-user-follow menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt93'];?></span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse <?php echo $yoneticishow; ?>" id="yoneticiler">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item <?php echo $yoneticiekle; ?>">
									<a class="nav-link <?php echo $yoneticiekle; ?>" href="yonetici-ekle<?php echo $html;?>"><?=@$admindil['txt96'];?> </a>
								</li>
								<li class="nav-item <?php echo $yoneticilistele; ?>">
									<a class="nav-link <?php echo $yoneticilistele; ?>" href="yonetici-listele<?php echo $html;?>"> <?=@$admindil['txt95'];?> </a>
								</li>
							</ul>
						</div>
					</li>
					<li class="nav-item sidebar-category mt-4">
						<span style="margin-left: -10px;"><?=@$admindil['txt97'];?></span>
					</li>
									
					<li class="nav-item <?php echo $mesajlar; ?>">
						<a class="nav-link" href="mesajlar<?php echo $html;?>">
						<i class="icon-envelope menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt98'];?></span> <span style="padding: 2px 5px;" class="badge badge-outline-danger"><?php echo tumu("mesajlar",3); ?></span>
						</a>
					</li>
					<?php if($moduller['alan17'] == "1"){?>
					<li class="nav-item <?php echo $ebulten; ?>">
						<a class="nav-link" href="ebulten<?php echo $html;?>">
						<i class="icon-envelope-open menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt75'];?></span> <span style="padding: 2px 5px;" class="badge badge-outline-danger"><?php echo tumu("ebulten",2); ?></span>
						</a>
					</li>
					<?php }?>
				
					
					<li class="nav-item <?php echo $ik; ?>">
						<a class="nav-link" href="ik<?php echo $html;?>">
						<i class="icon-speech menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt35'];?></span> <span style="padding: 2px 5px;" class="badge badge-outline-danger"><?php echo tumu("ik",3); ?></span>
						</a>
					</li>	
					
					<li class="nav-item <?php echo $yorumlar; ?>">
						<a class="nav-link" href="yorumlar<?php echo $html;?>">
						<i class="icon-bubbles menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt117'];?></span> <span style="padding: 2px 5px;" class="badge badge-outline-danger"><?php echo tumu("musteri_gorusleri",3); ?></span>
						</a>
					</li>
									
					

					<li class="nav-item sidebar-category mt-4">
						<span style="margin-left: -10px;"><?=@$admindil['txt102'];?></span>
					</li>
					<li class="nav-item <?php echo $notdefteri; ?>">
						<a class="nav-link" href="not-defteri<?php echo $html;?>">
						<i class="icon-calendar menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt103'];?></span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../_class/yonetim_islem.php?cikis=ok">
						<i class="icon-power menu-icon"></i>
						<span class="menu-title"><?=@$admindil['txt104'];?></span>
						</a>
					</li>
				</ul>
			</nav>
			<!-- partial -->
			<!-- Start content -->
			<div class="main-panel">
				<div class="content-wrapper">
				<?php if($mevcutDil['anadil'] != 1): ?>
				<div class="alert alert-fill-danger" role="alert">
                    <i class="mdi mdi-alert-circle"></i>
                    Şuanda <strong><?=@$mevcutDil['adi'];?></strong> dil versiyonundasınız. Yaptığınız tüm işlemler <strong><?=@$mevcutDil['adi'];?></strong> dili için geçerli olacaktır.
                  </div>
				<?php endif; ?>
				<?php 
				if(isset($_GET['sayfa']))
				{
					$s = $_GET['sayfa'];
					switch($s)
					{			
						case 'anasayfa';
						require_once("sayfalar/anasayfa.php");
						break;											
						
						case 'admin-dil-duzenle';
						require_once("sayfalar/admin_dil_ayar.php");
						break;
						
						case 'genel-ayarlar';
						require_once("sayfalar/genel_ayarlar.php");
						break;
						
						case 'popup';
						require_once("sayfalar/popup.php");
						break;
						
						case 'tema-ayarlari';
						require_once("sayfalar/tema_ayarlari.php");
						break;
						
						case 'sabit-linkler';
						require_once("sayfalar/sabit_linkler.php");
						break;
						
						case 'hizmet-ekle';
						require_once("sayfalar/hizmet_ekle.php");
						break;
						
						case 'hizmet-listele';
						require_once("sayfalar/hizmet_listele.php");
						break;						
						
						case 'emlak-mesajlar';
						require_once("sayfalar/emlak_mesajlar.php");
						break;
						
						case 'api-ayarlari';
						require_once("sayfalar/api_ayarlari.php");
						break;			
						
						
						case 'iletisim-ayarlari';
						require_once("sayfalar/iletisim_ayarlari.php");
						break;
						
						case 'sosyal-medya-ayarlari';
						require_once("sayfalar/sosyal_medya_ayarlari.php");
						break;
						
						case 'modul-ayarlari';
						require_once("sayfalar/modul_ayarlari.php");
						break;
						
						case 'limit-ayarlari';
						require_once("sayfalar/limit_ayarlari.php");
						break;
						
						case 'site-bakim-modu';
						require_once("sayfalar/site_bakim_modu.php");
						break;
						
						case 'mail-ayarlari';
						require_once("sayfalar/mail_ayarlari.php");
						break;
						
						case 'sms-ayarlari';
						require_once("sayfalar/sms_ayarlari.php");
						break;						
						
						case 'sayfa-ekle';
						require_once("sayfalar/sayfa_ekle.php");
						break;
						
						case 'sayfa-listele';
						require_once("sayfalar/sayfa_listele.php");
						break;
						
						case 'ekip-ekle';
						require_once("sayfalar/ekip_ekle.php");
						break;
						
						case 'ekip-listele';
						require_once("sayfalar/ekip_listele.php");
						break;
						
						case 'haber-ekle';
						require_once("sayfalar/haber_ekle.php");
						break;
						
						case 'haber-listele';
						require_once("sayfalar/haber_listele.php");
						break;
						
						case 'haber-fotograflar';
						require_once("sayfalar/haber_fotograflar.php");
						break;
												
						
						case 'slider-ekle';
						require_once("sayfalar/slider_ekle.php");
						break;
						
						case 'slider-listele';
						require_once("sayfalar/slider_listele.php");
						break;	
												
						case 'header-menu';
						require_once("sayfalar/header_menu.php");
						break;
						
						case 'footer-menu';
						require_once("sayfalar/footer_menu.php");
						break;
						
						case 'dil-ekle';
						require_once("sayfalar/dil_ekle.php");
						break;
						
						case 'dil-listele';
						require_once("sayfalar/dil_listele.php");
						break;

						case 'mesajlar';
						require_once("sayfalar/mesajlar.php");
						break;
						
						case 'bildirim-sablonlari';
						require_once("sayfalar/bildirim_sablonlari.php");
						break;
						
						case 'sablon-duzenle';
						require_once("sayfalar/sablon_duzenle.php");
						break;
						
						case 'yonetici-ekle';
						require_once("sayfalar/yonetici_ekle.php");
						break;
						
						case 'yonetici-listele';
						require_once("sayfalar/yonetici_listele.php");
						break;
						
						case 'not-defteri';
						require_once("sayfalar/not_defteri.php");
						break;
						
						case 'rehberim';
						require_once("sayfalar/rehberim.php");
						break;
						
						case 'rehber-ekle';
						require_once("sayfalar/rehber_ekle.php");
						break;
						
						case 'toplu-email';
						require_once("sayfalar/toplu_email.php");
						break;
						
						case 'toplu-sms';
						require_once("sayfalar/toplu_sms.php");
						break;						
						
						case 'proje-kategoriler';
						require_once("sayfalar/proje_kategoriler.php");
						break;
						
						case 'proje-kategori-ekle';
						require_once("sayfalar/proje_kategori_ekle.php");
						break;
						
						case 'projeler';
						require_once("sayfalar/projeler.php");
						break;
						
						case 'proje-ekle';
						require_once("sayfalar/proje_ekle.php");
						break;
						
						case 'paket-kategoriler';
						require_once("sayfalar/paket_kategoriler.php");
						break;
						
						case 'paket-kategori-ekle';
						require_once("sayfalar/paket_kategori_ekle.php");
						break;
						
						case 'paketler';
						require_once("sayfalar/paketler.php");
						break;
						
						case 'paket-ekle';
						require_once("sayfalar/paket_ekle.php");
						break;		
						
						case 'ekip-ekle';
						require_once("sayfalar/ekip_ekle.php");
						break;
						
						case 'ekip-listele';
						require_once("sayfalar/ekip_listele.php");
						break;
						
						case 'emlak-kategoriler';
						require_once("sayfalar/emlak_kategoriler.php");
						break;
						
						case 'emlak-kategori-ekle';
						require_once("sayfalar/emlak_kategori_ekle.php");
						break;
						
						case 'emlaklar';
						require_once("sayfalar/emlaklar.php");
						break;
						
						case 'uyeemlaklar';
						require_once("sayfalar/uyeemlaklar.php");
						break;
						
						case 'emlak-ekle';
						require_once("sayfalar/emlak_ekle.php");
						break;
						
						case 'ozellik-gruplari';
						require_once("sayfalar/ozellik_gruplari.php");
						break;
						
						case 'ozellik-degerleri';
						require_once("sayfalar/ozellik_degerleri.php");
						break;
						
						case 'referans-ekle';
						require_once("sayfalar/referans_ekle.php");
						break;
						
						case 'referans-listele';
						require_once("sayfalar/referans_listele.php");
						break;
						
						case 'belge-ekle';
						require_once("sayfalar/belge_ekle.php");
						break;
						
						case 'belge-listele';
						require_once("sayfalar/belge_listele.php");
						break;
						
						case 'soru-ekle';
						require_once("sayfalar/soru_ekle.php");
						break;

						case 'soru-listele';
						require_once("sayfalar/soru_listele.php");
						break;
						
						case 'katalog-ekle';
						require_once("sayfalar/katalog_ekle.php");
						break;
						
						case 'katalog-listele';
						require_once("sayfalar/katalog_listele.php");
						break;											
						
						case 'ebulten';
						require_once("sayfalar/ebulten.php");
						break;						
						
						case 'ik';
						require_once("sayfalar/ik.php");
						break;
						
						case 'yorumlar';
						require_once("sayfalar/yorumlar.php");
						break;						
											
						case 'banka-hesap-ekle';
						require_once("sayfalar/banka_hesap_ekle.php");
						break;

						case 'banka-hesaplari';
						require_once("sayfalar/banka_hesaplari.php");
						break;
						
						case 'tum-musteriler';
						require_once("sayfalar/tum_musteriler.php");
						break;

						case 'engellenen-musteriler';
						require_once("sayfalar/engellenen_musteriler.php");
						break;

						case 'musteri-ekle';
						require_once("sayfalar/musteri_ekle.php");
						break;

						case 'musteri-duzenle';
						require_once("sayfalar/musteri_duzenle.php");
						break;						
											
												
						case 'anasayfa-modul-siralama';
						require_once("sayfalar/anasayfa_modul_siralama.php");
						break;
						
						case 'iller';
						require_once("sayfalar/iller.php");
						break;
						
						case 'ilceler';
						require_once("sayfalar/ilceler.php");
						break;
						
						case 'semtler';
						require_once("sayfalar/semtler.php");
						break;

						case '404';
						require_once("sayfalar/404.php");
						break;
									
						default:
						require_once("sayfalar/anasayfa.php");
					}
				}
				else
				{
					require_once("sayfalar/anasayfa.php");
				}
				?> 
				</div>
			<!-- content-wrapper ends -->
			<footer class="footer">
				<div class="d-sm-flex justify-content-center justify-content-sm-between">
					<span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date("Y");?>  Tüm hakları saklıdır.</span>
				</div>
			</footer>
			<!-- partial -->
			</div>
		</div>
		<!-- page-body-wrapper ends -->
	</div>
	
	<!-- Plugin js for this page-->
	<!-- End plugin js for this page-->
	<!-- inject:js -->
	<script src="js/off-canvas.js"></script>
	<script src="js/hoverable-collapse.js"></script>
	<script src="js/template.js"></script>
	<script src="js/settings.js"></script>
	<script src="js/todolist.js"></script>
	<!-- endinject -->
	<!-- Custom js for this page-->
	<script src="js/dashboard.js"></script>
	<!-- End custom js for this page-->
	<script src="js/file-upload.js"></script>
	<script src="js/typeahead.js"></script>
	<script src="js/select2.js"></script>
	
	<script src="js/formpickers.js"></script>
	<script src="js/form-addons.js"></script>
	<script src="js/x-editable.js"></script>
	<script src="js/dropify.js"></script>
	<script src="js/form-repeater.js"></script>
	<script src="js/bt-maxLength.js"></script>
	<script src="js/tooltips.js"></script>
	<script src="js/codeEditor_mirror.js"></script>
	<script src="js/editorDemo.js"></script>
	<script src="vendors/multiselect/jquery.multiselect.js"></script>
	<script src="vendors/multiselect2/js/jquery.multi-select.js"></script>
	<!--Custom-Scrollbar js-->
	<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script type="text/javascript" src="js/jquery.popconfirm.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".popconfirm").popConfirm();			
			$(".popconfirm1").popConfirm();
			$(".popconfirm2").popConfirm();			
		});
	</script>
	<script>
	tinymce.init({
		selector: '#myTextarea,#myTextarea2',
		language: 'tr',
		entity_encoding : "utf-8",
		theme: "silver",
		branding: false,
        height:400,
		fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
		plugins: [
			"image code",
			"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
			"searchreplace wordcount visualblocks visualchars code filemanager responsivefilemanager fullscreen insertdatetime media nonbreaking",
			"save table contextmenu directionality emoticons template paste textcolor"
		],
		toolbar: "responsivefilemanager | undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image code | print preview media | forecolor backcolor fontsizeselect emoticons",
		image_advtab: true ,
		external_filemanager_path:"<?php echo $url;?>/vendors/filemanager/",
	    filemanager_title:"Dosya Yöneticisi" ,
		external_plugins: {
			"responsivefilemanager": "<?php echo $url;?>/vendors/tinymce/plugins/responsivefilemanager/plugin.min.js",
			"flickr": "<?php echo $url;?>/vendors/tinymce/plugins/flickr/plugin.min.js",
			"youtube": "<?php echo $url;?>/vendors/tinymce/plugins/youtube/plugin.min.js",
			"filemanager": "<?php echo $url;?>/vendors/filemanager/plugin.min.js"
		},
		filemanager_access_key:"demo"
	});	
	
	</script>
	
	<script src="js/light-gallery.js"></script>
	
	<script>
	
	$(window).on("load",function(){
		$(".scroll").mCustomScrollbar({
			setWidth:false,
			setHeight:false,
			setTop:0,
			setLeft:0,
			axis:"y",
			scrollbarPosition:"inside",
			scrollInertia:950,
			autoDraggerLength:true,
			autoHideScrollbar:false,
			autoExpandScrollbar:false,
			alwaysShowScrollbar:0,
			snapAmount:null,
			snapOffset:0,
			mouseWheel:{
				enable:true,
				scrollAmount:"auto",
				axis:"y",
				preventDefault:false,
				deltaFactor:"auto",
				normalizeDelta:false,
				invert:false,
				disableOver:["select","option","keygen","datalist","textarea"]
			},
			scrollButtons:{
				enable:false,
				scrollType:"stepless",
				scrollAmount:"auto"
			},
			keyboard:{
				enable:true,
				scrollType:"stepless",
				scrollAmount:"auto"
			},
			contentTouchScroll:25,
			advanced:{
				autoExpandHorizontalScroll:false,
				autoScrollOnFocus:"input,textarea,select,button,datalist,keygen,a[tabindex],area,object,[contenteditable='true']",
				updateOnContentResize:true,
				updateOnImageLoad:true,
				updateOnSelectorChange:false,
				releaseDraggableSelectors:false
			},
			theme:"light",
			callbacks:{
				onInit:false,
				onScrollStart:false,
				onScroll:false,
				onTotalScroll:false,
				onTotalScrollBack:false,
				whileScrolling:false,
				onTotalScrollOffset:0,
				onTotalScrollBackOffset:0,
				alwaysTriggerOffsets:true,
				onOverflowY:false,
				onOverflowX:false,
				onOverflowYNone:false,
				onOverflowXNone:false
			},
			live:false,
			liveSelector:null
		});
		
	});
	</script>
	<script>
    $(function () {
		$('select#uyeler').multiselect({
			columns: 3,
			placeholder: '-Seçiniz-',
			search: true,
			searchOptions: {
				'default': 'Arama'
			},
			selectAll: true
		});
	});
	</script>
	<script>
		! function(o, e, p) {
			"use strict";
			p('[data-toggle="popover"]').popover(), p("#show-popover").popover({
				title: "Popover Show Event",
				content: "Bonbon chocolate cake. Pudding halvah pie apple pie topping marzipan pastry marzipan cupcake.",
				trigger: "click",
				placement: "right"
			}).on("show.bs.popover", function() {
				alert("Show event fired.")
			}), p("[data-popup=popover-color]").popover({
				template: '<div class="popover"><div class="bg-teal"><div class="popover-arrow"></div><div class="popover-inner"></div></div></div>'
			}), p("[data-popup=popover-border]").popover({
				template: '<div class="popover"><div class="border-orange"><div class="popover-arrow"></div><div class="popover-inner"></div></div></div>'
			})
		}(window, document, jQuery);
	</script>
	<script src="vendors/datetimepicker/jquery.datetimepicker.js"></script>
	<script>
	$('#datetimepicker_mask').datetimepicker({
		mask:'9999/19/39 29:59',
	});
	$('#datetimepicker').datetimepicker();
	$('#datetimepicker').datetimepicker({value:'2015/04/15 05:06'});
	$('#datetimepicker1').datetimepicker({
		datepicker:false,
		format:'H:i',
		step:5
	});
	$('.date-timepicker2').datetimepicker({
		timepicker:false,
		format:'d/m/Y',
		formatDate:'d/m/Y'
	});
	$('#datetimepicker3').datetimepicker({
		inline:true
	});
	$('.date-timepicker').datetimepicker();
	$('#open').click(function(){
		$('#datetimepicker4').datetimepicker('show');
	});
	$('#close').click(function(){
		$('#datetimepicker4').datetimepicker('hide');
	});
	</script>	
	<?php 
	mesaj("kullanici_giris",1,"yes","Sisteme başarıyla giriş yapılmıştır.");
	mesaj("demohesap",3,"no","Demo hesapta işlem yapamassınız.!");
	?>	
</body>
</html>
<?php ob_end_flush(); ?>