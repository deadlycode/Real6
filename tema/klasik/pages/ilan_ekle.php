<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
if(!isset($_SESSION["site_email"])){
	header("Location:".$url.(altklasor == "1" ? '/' : '')."".$htc['girisyapurl']."".$html."");
}
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['hesabimurl']."' OR link = '".$htc['hesabimurl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
?>
<?php 
if(isset($_GET['islem'])=="duzenle")
{
	$durum = "duzenle" ;
	$Sorgu = $db->prepare("SELECT * FROM emlaklar WHERE id = ? and ekleyen = ?");
	$Sorgu->execute(array($_GET['id'],$_SESSION['site_uyeid']));
	if($Sorgu->rowCount())
	{
		$Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
	}
	else
	{
		header("Location:".$url."/404".$html."");
		exit;
	}
}
?>
	<style>
	
.form-check-label {
    padding-left: 0 !important;
    margin-bottom: 0;
}
	
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
		
.ymaps-2-1-77-controls__control_toolbar ymaps {
	
	display:none;
			
}	

.flex-column, .nav-tabs.nav-tabs-vertical, .nav-tabs.nav-tabs-vertical-custom, .nav-pills.nav-pills-vertical, .email-wrapper .mail-sidebar .menu-bar .profile-list-item a .user {
    flex-direction: row !important;
}
			
    </style>
	<script src="//api-maps.yandex.ru/2.1/?lang=tr_TR" type="text/javascript"></script>

			<!-- ============================ Page Title Start================================== -->
			<div class="page-title">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							
							<h2 class="ipt-title"><?=@$dil['yaz104'];?></h2>
							<span class="ipn-subtitle"><?=@$dil['yaz105'];?></span>
							
						</div>
					</div>
				</div>
			</div>
			<!-- ============================ Page Title End ================================== -->
			
			<!-- ============================ User Dashboard ================================== -->
			<section>
				<div class="container">
					<div class="row">
					
					<?php require_once("uye_menu.php");?>
												
						<div class="col-lg-9 col-md-9">					
						
						
							<div class="dashboard-wraper">
							  <form class="forms-sample" method="post" action="../_class/site.php" enctype="multipart/form-data">
								<input id="id" name="id" type="hidden" value="<?php echo $Sonuc['id']; ?>">
								<input id="ozellik" name="ozellik" type="hidden" value="<?php echo $Sonuc['ozellik']; ?>">
								<input id="dil" name="dil" type="hidden" value="<?php echo $_SESSION['k_dil']; ?>">
								<input id="ilceid" name="ilceid" type="hidden" value="<?php echo $Sonuc['ilce']; ?>">
								<input id="semtid" name="semtid" type="hidden" value="<?php echo $Sonuc['semt']; ?>">
								<input id="ekleyen" name="ekleyen" type="hidden" value="<?php echo $Bilgilerim['id']; ?>">
								<input id="uye" name="uye" type="hidden" value="1">
								<input id="uyeadsoyad" name="uyeadsoyad" type="hidden" value="<?php echo $Bilgilerim['adsoyad']; ?>">

					<div class="row">
					
					<div class="col-12">
							<ul class="nav nav-tabs nav-tabs-vertical" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="home-tab-vertical" data-toggle="tab" href="#emlak-bilgileri" role="tab" aria-controls="emlak-bilgileri" aria-selected="true">
										<?=@$dil['yaz106'];?>
									</a>
								</li>
								
								<li class="nav-item">
									<a class="nav-link" id="contact-tab-vertical" data-toggle="tab" href="#emlak-ozellikleri" role="tab" aria-controls="emlak-ozellikleri" aria-selected="false">
										<?=@$dil['yaz107'];?>
									</a>
								</li>
								
								<li class="nav-item">
									<a class="nav-link" id="contact-tab-vertical" data-toggle="tab" href="#seo-ayarlari" role="tab" aria-controls="seo-ayarlari" aria-selected="false">
										<?=@$dil['yaz108'];?>
									</a>
								</li>
							</ul>
						</div>
						</br>
					
						<div class="col-12">
							
						
							<div class="tab-content tab-content-vertical pt-3 pb-0">
								<div class="tab-pane fade show active" id="emlak-bilgileri" role="tabpanel" aria-labelledby="home-tab-vertical">
									<div class="form-group">
										<label for="adi"><?=@$dil['yaz109'];?></label>
										<input type="text" class="form-control form-control-sm" name="adi" id="adi" value="<?php echo(isset($_GET['islem'])=="duzenle" ? $Sonuc['adi'] : '');?>" />
									</div>
									<div class="form-group">
										<label><?=@$dil['yaz110'];?></label>
										<?php 
										$emlakidbul 	= $db->query("SELECT * FROM emlaklar ORDER BY id desc LIMIT 1")->fetch();
										$idtopla = $emlakidbul['id']+1;										
										?>
										<input type="text" class="form-control form-control-sm" name="emlak_kodu" id="emlak_kodu" value="<?php echo(isset($_GET['islem'])=="duzenle" ? $Sonuc['emlak_kodu'] : $idtopla);?>" />
									</div>
									<div class="form-group">
										<label><?=@$dil['yaz111'];?> <i class="icon-info text-info" data-toggle="popover" data-content="<?=@$dil['yaz123'];?>" data-trigger="hover" data-original-title="İlan Tarihi"></i></label>
										<div class="input-group">
											<input type="text" autocomplete="off" name="tarih" value="<?php echo(isset($_GET['islem'])=="duzenle" ? $Sonuc['tarih'] : date('d-m-Y H:i'));?>" class="form-control form-control-sm date-timepicker" />
										
										</div>
									</div>
									
									<div class="row">
									<!-- /.form-group -->
									<div class="form-group col-md-6">
										<?php $kategoriler = explode(",", $Sonuc['kategori']);?>
										<label for="secenek"><?=@$dil['yaz112'];?></label>
										<select class="js-example-basic-multiple form-control-sm" name="kategori" id="secenek" required style="width:100%">
										<?php emlakkategori(0,0,$kategoriler);?>	
										</select>
									</div>
									
									
									<div class="form-group col-md-6">
									
										<label for="secenek"><?=@$dil['yaz113'];?></label>
										<select class="js-example-basic-multiple form-control-sm" name="danisman" id="danisman" required style="width:100%">
									<option value="0" <?php echo($Sonuc['danisman'] == 0 ? 'selected' : '');?>><?=@$dil['yaz114'];?></option>
									<?php $DANISMANSorgu = $db->prepare("SELECT * FROM ekibimiz ORDER BY sira ASC");
									$DANISMANSorgu->execute();
									$DANISMANislem = $DANISMANSorgu->fetchALL(PDO::FETCH_ASSOC);?>
									<?php foreach ( $DANISMANislem as $DANISMANSonuc ){?>
										<option value="<?php echo $DANISMANSonuc['id']; ?>" <?php echo($Sonuc['danisman'] == $DANISMANSonuc['id'] ? 'selected' : '');?>><?php echo $DANISMANSonuc['adi']; ?></option>
									<?php }?>		
										</select>
									</div>
									
									
								</div>
								<div class="form-group">
										<label for="video"><?=@$dil['yaz116'];?> (<a href="<?php echo tema;?>/assets/img/video.png" target="_blank"><?=@$dil['yaz117'];?></a>)</label>
										<input type="text" class="form-control form-control-sm" name="video" id="video" value="<?php echo(isset($_GET['islem'])=="duzenle" ? $Sonuc['video'] : '');?>" />
									</div>
									<div class="row">
									<div class="form-group col-md-6">
										<label for="brut"><?=@$dil['yaz118'];?> <i class="icon-info text-info" data-toggle="popover" data-content="<?=@$dil['yaz114'];?>" data-trigger="hover"></i></label>
										<input type="text" class="form-control form-control-sm" name="brut" id="brut" value="<?php echo(isset($_GET['islem'])=="duzenle" ? $Sonuc['brut'] : '');?>" />
									</div>
									
									<div class="form-group col-md-6">
										<label for="net"><?=@$dil['yaz119'];?> <i class="icon-info text-info" data-toggle="popover" data-content="<?=@$dil['yaz114'];?>" data-trigger="hover"></i></label>
										<input type="text" class="form-control form-control-sm" name="net" id="net" value="<?php echo(isset($_GET['islem'])=="duzenle" ? $Sonuc['net'] : '');?>" />
									</div>
									</div>
									<div class="row">
									<div class="form-group col-md-6">
										<label for="oda"><?=@$dil['yaz120'];?></label>
										<select class="form-control w-100" name="oda" id="oda" required>
											<option value="0" <?php echo($Sonuc['oda'] == 0 ? 'selected' : '');?>><?=@$dil['yaz114'];?></option>
											<option value="Stüdyo 1+0" <?php echo($Sonuc['oda'] == 'Stüdyo 1+0' ? 'selected' : '');?>><?=@$dil['yaz121'];?> 1+0</option>										
											<option value="1+1" <?php echo($Sonuc['oda'] == '1+1' ? 'selected' : '');?>>1+1</option>
											<option value="1.5+1" <?php echo($Sonuc['oda'] == '1.5+1' ? 'selected' : '');?>>1.5+1</option>
											<option value="2+0" <?php echo($Sonuc['oda'] == '2+0' ? 'selected' : '');?>>2+0</option>
											<option value="2+1" <?php echo($Sonuc['oda'] == '2+1' ? 'selected' : '');?>>2+1</option>
											<option value="2.5+1" <?php echo($Sonuc['oda'] == '2.5+1' ? 'selected' : '');?>>2.5+1</option>
											<option value="2+2" <?php echo($Sonuc['oda'] == '2+2' ? 'selected' : '');?>>2+2</option>
											<option value="3+1" <?php echo($Sonuc['oda'] == '3+1' ? 'selected' : '');?>>3+1</option>
											<option value="3.5+1" <?php echo($Sonuc['oda'] == '3.5+1' ? 'selected' : '');?>>3.5+1</option>
											<option value="3+2" <?php echo($Sonuc['oda'] == '3+2' ? 'selected' : '');?>>3+2</option>
											<option value="4+1" <?php echo($Sonuc['oda'] == '4+1' ? 'selected' : '');?>>4+1</option>
											<option value="4.5+1" <?php echo($Sonuc['oda'] == '4.5+1' ? 'selected' : '');?>>4.5+1</option>
											<option value="4+2" <?php echo($Sonuc['oda'] == '4+2' ? 'selected' : '');?>>4+2</option>
											<option value="4+3" <?php echo($Sonuc['oda'] == '4+3' ? 'selected' : '');?>>4+3</option>
											<option value="4+4" <?php echo($Sonuc['oda'] == '4+4' ? 'selected' : '');?>>4+4</option>
											<option value="5+1" <?php echo($Sonuc['oda'] == '5+1' ? 'selected' : '');?>>5+1</option>
											<option value="5+2" <?php echo($Sonuc['oda'] == '5+2' ? 'selected' : '');?>>5+2</option>
											<option value="5+3" <?php echo($Sonuc['oda'] == '5+3' ? 'selected' : '');?>>5+3</option>
											<option value="5+4" <?php echo($Sonuc['oda'] == '5+4' ? 'selected' : '');?>>5+4</option>
											<option value="6+1" <?php echo($Sonuc['oda'] == '6+1' ? 'selected' : '');?>>6+1</option>
											<option value="6+2" <?php echo($Sonuc['oda'] == '6+2' ? 'selected' : '');?>>6+2</option>
											<option value="6+3" <?php echo($Sonuc['oda'] == '6+3' ? 'selected' : '');?>>6+3</option>
											<option value="7+1" <?php echo($Sonuc['oda'] == '7+1' ? 'selected' : '');?>>7+1</option>
											<option value="7+2" <?php echo($Sonuc['oda'] == '7+2' ? 'selected' : '');?>>7+2</option>
											<option value="7+3" <?php echo($Sonuc['oda'] == '7+3' ? 'selected' : '');?>>7+3</option>
											<option value="8+1" <?php echo($Sonuc['oda'] == '8+1' ? 'selected' : '');?>>8+1</option>
											<option value="8+2" <?php echo($Sonuc['oda'] == '8+2' ? 'selected' : '');?>>8+2</option>
											<option value="8+3" <?php echo($Sonuc['oda'] == '8+3' ? 'selected' : '');?>>8+3</option>
											<option value="8+4" <?php echo($Sonuc['oda'] == '8+4' ? 'selected' : '');?>>8+4</option>
											<option value="9+1" <?php echo($Sonuc['oda'] == '9+1' ? 'selected' : '');?>>9+1</option>
											<option value="9+2" <?php echo($Sonuc['oda'] == '9+2' ? 'selected' : '');?>>9+2</option>
											<option value="9+3" <?php echo($Sonuc['oda'] == '9+3' ? 'selected' : '');?>>9+3</option>
											<option value="9+4" <?php echo($Sonuc['oda'] == '9+4' ? 'selected' : '');?>>9+4</option>
											<option value="9+5" <?php echo($Sonuc['oda'] == '9+5' ? 'selected' : '');?>>9+5</option>
											<option value="9+6" <?php echo($Sonuc['oda'] == '9+6' ? 'selected' : '');?>>9+6</option>
											<option value="10+1" <?php echo($Sonuc['oda'] == '10+1' ? 'selected' : '');?>>10+1</option>
											<option value="10+2" <?php echo($Sonuc['oda'] == '10+2' ? 'selected' : '');?>>10+2</option>
											<option value="10 Üzeri" <?php echo($Sonuc['oda'] == '10 Üzeri' ? 'selected' : '');?>>10 <?=@$dil['yaz122'];?></option>		 									
										</select>
									</div>
									<div class="form-group col-md-6">
										<label for="katsayisi"><?=@$dil['yaz124'];?></label>
										<select class="form-control w-100" name="katsayisi" id="katsayisi" required>
											<option value="0" <?php echo($Sonuc['katsayisi'] == 0 ? 'selected' : '');?>><?=@$dil['yaz114'];?></option>											
											<option value="1" <?php echo($Sonuc['katsayisi'] == '1' ? 'selected' : '');?>>1</option>
											<option value="2" <?php echo($Sonuc['katsayisi'] == '2' ? 'selected' : '');?>>2</option>
											<option value="3" <?php echo($Sonuc['katsayisi'] == '3' ? 'selected' : '');?>>3</option>
											<option value="4" <?php echo($Sonuc['katsayisi'] == '4' ? 'selected' : '');?>>4</option>
											<option value="5" <?php echo($Sonuc['katsayisi'] == '5' ? 'selected' : '');?>>5</option>
											<option value="6" <?php echo($Sonuc['katsayisi'] == '6' ? 'selected' : '');?>>6</option>
											<option value="7" <?php echo($Sonuc['katsayisi'] == '7' ? 'selected' : '');?>>7</option>
											<option value="8" <?php echo($Sonuc['katsayisi'] == '8' ? 'selected' : '');?>>8</option>
											<option value="9" <?php echo($Sonuc['katsayisi'] == '9' ? 'selected' : '');?>>9</option>
											<option value="10" <?php echo($Sonuc['katsayisi'] == '10' ? 'selected' : '');?>>10</option>
											<option value="11" <?php echo($Sonuc['katsayisi'] == '11' ? 'selected' : '');?>>11</option>
											<option value="12" <?php echo($Sonuc['katsayisi'] == '12' ? 'selected' : '');?>>12</option>
											<option value="13" <?php echo($Sonuc['katsayisi'] == '13' ? 'selected' : '');?>>13</option>
											<option value="14" <?php echo($Sonuc['katsayisi'] == '14' ? 'selected' : '');?>>14</option>
											<option value="15" <?php echo($Sonuc['katsayisi'] == '15' ? 'selected' : '');?>>15</option>
											<option value="16" <?php echo($Sonuc['katsayisi'] == '16' ? 'selected' : '');?>>16</option>
											<option value="17" <?php echo($Sonuc['katsayisi'] == '17' ? 'selected' : '');?>>17</option>
											<option value="18" <?php echo($Sonuc['katsayisi'] == '18' ? 'selected' : '');?>>18</option>
											<option value="19" <?php echo($Sonuc['katsayisi'] == '19' ? 'selected' : '');?>>19</option>
											<option value="20" <?php echo($Sonuc['katsayisi'] == '20' ? 'selected' : '');?>>20</option>
											<option value="21" <?php echo($Sonuc['katsayisi'] == '21' ? 'selected' : '');?>>21</option>
											<option value="22" <?php echo($Sonuc['katsayisi'] == '22' ? 'selected' : '');?>>22</option>
											<option value="23" <?php echo($Sonuc['katsayisi'] == '23' ? 'selected' : '');?>>23</option>
											<option value="24" <?php echo($Sonuc['katsayisi'] == '24' ? 'selected' : '');?>>24</option>
											<option value="25" <?php echo($Sonuc['katsayisi'] == '25' ? 'selected' : '');?>>25</option>
											<option value="26" <?php echo($Sonuc['katsayisi'] == '26' ? 'selected' : '');?>>26</option>
											<option value="27" <?php echo($Sonuc['katsayisi'] == '27' ? 'selected' : '');?>>27</option>
											<option value="28" <?php echo($Sonuc['katsayisi'] == '28' ? 'selected' : '');?>>28</option>
											<option value="29" <?php echo($Sonuc['katsayisi'] == '29' ? 'selected' : '');?>>29</option>
											<option value="30 ve üzeri" <?php echo($Sonuc['katsayisi'] == '30 ve üzeri' ? 'selected' : '');?>>30 <?=@$dil['yaz125'];?></option>	 									
										</select>
									</div>
									
									<div class="form-group col-md-6">
										<label for="bulundugukat"><?=@$dil['yaz126'];?></label>
										<select class="form-control w-100" name="bulundugukat" id="bulundugukat" required>
											<option value="0" <?php echo($Sonuc['bulundugukat'] == 0 ? 'selected' : '');?>><?=@$dil['yaz114'];?></option>
											<option value="Kot 4" <?php echo($Sonuc['bulundugukat'] == 'Kot 4' ? 'selected' : '');?>><?=@$dil['yaz127'];?> 4</option>										
											<option value="Kot 3" <?php echo($Sonuc['bulundugukat'] == 'Kot 3' ? 'selected' : '');?>><?=@$dil['yaz127'];?> 3</option>
											<option value="Kot 2" <?php echo($Sonuc['bulundugukat'] == 'Kot 2' ? 'selected' : '');?>><?=@$dil['yaz127'];?> 2</option>
											<option value="Kot 1" <?php echo($Sonuc['bulundugukat'] == 'Kot 1' ? 'selected' : '');?>><?=@$dil['yaz127'];?> 1</option>
											<option value="Bodrum Kat" <?php echo($Sonuc['bulundugukat'] == 'Bodrum Kat' ? 'selected' : '');?>><?=@$dil['yaz128'];?></option>
											<option value="Zemin Kat" <?php echo($Sonuc['bulundugukat'] == 'Zemin Kat' ? 'selected' : '');?>><?=@$dil['yaz129'];?></option>
											<option value="Bahçe Katı" <?php echo($Sonuc['bulundugukat'] == 'Bahçe Katı' ? 'selected' : '');?>><?=@$dil['yaz130'];?></option>
											<option value="Giriş Katı" <?php echo($Sonuc['bulundugukat'] == 'Giriş Katı' ? 'selected' : '');?>><?=@$dil['yaz131'];?></option>
											<option value="Yüksek Giriş" <?php echo($Sonuc['bulundugukat'] == 'Yüksek Giriş' ? 'selected' : '');?>><?=@$dil['yaz132'];?></option>
											<option value="Müstakil" <?php echo($Sonuc['bulundugukat'] == 'Müstakil' ? 'selected' : '');?>><?=@$dil['yaz133'];?></option>
											<option value="Villa Tipi" <?php echo($Sonuc['bulundugukat'] == 'Villa Tipi' ? 'selected' : '');?>><?=@$dil['yaz134'];?></option>
											<option value="Çatı Katı" <?php echo($Sonuc['bulundugukat'] == 'Çatı Katı' ? 'selected' : '');?>><?=@$dil['yaz135'];?></option>
											<option value="1" <?php echo($Sonuc['bulundugukat'] == '1' ? 'selected' : '');?>>1</option>
											<option value="2" <?php echo($Sonuc['bulundugukat'] == '2' ? 'selected' : '');?>>2</option>
											<option value="3" <?php echo($Sonuc['bulundugukat'] == '3' ? 'selected' : '');?>>3</option>
											<option value="4" <?php echo($Sonuc['bulundugukat'] == '4' ? 'selected' : '');?>>4</option>
											<option value="5" <?php echo($Sonuc['bulundugukat'] == '5' ? 'selected' : '');?>>5</option>
											<option value="6" <?php echo($Sonuc['bulundugukat'] == '6' ? 'selected' : '');?>>6</option>
											<option value="7" <?php echo($Sonuc['bulundugukat'] == '7' ? 'selected' : '');?>>7</option>
											<option value="8" <?php echo($Sonuc['bulundugukat'] == '8' ? 'selected' : '');?>>8</option>
											<option value="9" <?php echo($Sonuc['bulundugukat'] == '9' ? 'selected' : '');?>>9</option>
											<option value="10" <?php echo($Sonuc['bulundugukat'] == '10' ? 'selected' : '');?>>10</option>
											<option value="11" <?php echo($Sonuc['bulundugukat'] == '11' ? 'selected' : '');?>>11</option>
											<option value="12" <?php echo($Sonuc['bulundugukat'] == '12' ? 'selected' : '');?>>12</option>
											<option value="13" <?php echo($Sonuc['bulundugukat'] == '13' ? 'selected' : '');?>>13</option>
											<option value="14" <?php echo($Sonuc['bulundugukat'] == '14' ? 'selected' : '');?>>14</option>
											<option value="15" <?php echo($Sonuc['bulundugukat'] == '15' ? 'selected' : '');?>>15</option>
											<option value="16" <?php echo($Sonuc['bulundugukat'] == '16' ? 'selected' : '');?>>16</option>
											<option value="17" <?php echo($Sonuc['bulundugukat'] == '17' ? 'selected' : '');?>>17</option>
											<option value="18" <?php echo($Sonuc['bulundugukat'] == '18' ? 'selected' : '');?>>18</option>
											<option value="19" <?php echo($Sonuc['bulundugukat'] == '19' ? 'selected' : '');?>>19</option>
											<option value="20" <?php echo($Sonuc['bulundugukat'] == '20' ? 'selected' : '');?>>20</option>
											<option value="21" <?php echo($Sonuc['bulundugukat'] == '21' ? 'selected' : '');?>>21</option>
											<option value="22" <?php echo($Sonuc['bulundugukat'] == '22' ? 'selected' : '');?>>22</option>
											<option value="23" <?php echo($Sonuc['bulundugukat'] == '23' ? 'selected' : '');?>>23</option>
											<option value="24" <?php echo($Sonuc['bulundugukat'] == '24' ? 'selected' : '');?>>24</option>
											<option value="25" <?php echo($Sonuc['bulundugukat'] == '25' ? 'selected' : '');?>>25</option>
											<option value="26" <?php echo($Sonuc['bulundugukat'] == '26' ? 'selected' : '');?>>26</option>
											<option value="27" <?php echo($Sonuc['bulundugukat'] == '27' ? 'selected' : '');?>>27</option>
											<option value="28" <?php echo($Sonuc['bulundugukat'] == '28' ? 'selected' : '');?>>28</option>
											<option value="29" <?php echo($Sonuc['bulundugukat'] == '29' ? 'selected' : '');?>>29</option>
											<option value="30 ve üzeri" <?php echo($Sonuc['bulundugukat'] == '30 ve üzeri' ? 'selected' : '');?>>30 <?=@$dil['yaz125'];?></option>	 									
										</select>
									</div>
									
									<div class="form-group col-md-6">
										<label for="bina"><?=@$dil['yaz136'];?></label>
										<select class="form-control w-100" name="bina" id="bina" required>
											<option value="0" <?php echo($Sonuc['bina'] == 0 ? 'selected' : '');?>><?=@$dil['yaz114'];?></option>											
											<option value="1" <?php echo($Sonuc['bina'] == '1' ? 'selected' : '');?>>1</option>
											<option value="2" <?php echo($Sonuc['bina'] == '2' ? 'selected' : '');?>>2</option>
											<option value="3" <?php echo($Sonuc['bina'] == '3' ? 'selected' : '');?>>3</option>
											<option value="4" <?php echo($Sonuc['bina'] == '4' ? 'selected' : '');?>>4</option>
											<option value="5-10 arası" <?php echo($Sonuc['bina'] == '5-10 arası' ? 'selected' : '');?>>5-10 <?=@$dil['yaz137'];?></option>
											<option value="11-15 arası" <?php echo($Sonuc['bina'] == '11-15 arası' ? 'selected' : '');?>>11-15 <?=@$dil['yaz137'];?></option>
											<option value="16-20 arası" <?php echo($Sonuc['bina'] == '16-20 arası' ? 'selected' : '');?>>16-20 <?=@$dil['yaz137'];?></option>
											<option value="21-25 arası" <?php echo($Sonuc['bina'] == '21-25 arası' ? 'selected' : '');?>>21-25 <?=@$dil['yaz137'];?></option>
											<option value="26-30 arası" <?php echo($Sonuc['bina'] == '26-30 arası' ? 'selected' : '');?>>26-30 <?=@$dil['yaz137'];?></option>
											<option value="31 ve üzeri" <?php echo($Sonuc['bina'] == '31 ve üzeri' ? 'selected' : '');?>>31 <?=@$dil['yaz125'];?></option>					
										</select>
									</div>
									</div>
									
									<div class="row">
									<div class="form-group col-md-6">
										<label for="isitma"><?=@$dil['yaz138'];?></label>
										<select class="form-control w-100" name="isitma" id="isitma" required>
											<option value="0" <?php echo($Sonuc['isitma'] == 0 ? 'selected' : '');?>><?=@$dil['yaz'];?><?=@$dil['yaz114'];?></option>											
											<option value="Yok" <?php echo($Sonuc['isitma'] == 'Yok' ? 'selected' : '');?>><?=@$dil['yaz139'];?></option>
											<option value="Soba" <?php echo($Sonuc['isitma'] == 'Soba' ? 'selected' : '');?>><?=@$dil['yaz140'];?></option>
											<option value="Doğalgaz Sobası" <?php echo($Sonuc['isitma'] == 'Doğalgaz Sobası' ? 'selected' : '');?>><?=@$dil['yaz141'];?></option>
											<option value="Kat Kaloriferi" <?php echo($Sonuc['isitma'] == 'Kat Kaloriferi' ? 'selected' : '');?>><?=@$dil['yaz142'];?></option>
											<option value="Merkezi" <?php echo($Sonuc['isitma'] == 'Merkezi' ? 'selected' : '');?>><?=@$dil['yaz143'];?></option>
											<option value="Merkezi (Pay Ölçer)" <?php echo($Sonuc['isitma'] == 'Merkezi (Pay Ölçer)' ? 'selected' : '');?>><?=@$dil['yaz144'];?></option>
											<option value="Doğalgaz (Kombi)" <?php echo($Sonuc['isitma'] == 'Doğalgaz (Kombi)' ? 'selected' : '');?>><?=@$dil['yaz145'];?></option>
											<option value="Yerden Isıtma" <?php echo($Sonuc['isitma'] == 'Yerden Isıtma' ? 'selected' : '');?>><?=@$dil['yaz146'];?></option>
											<option value="Klima" <?php echo($Sonuc['isitma'] == 'Klima' ? 'selected' : '');?>><?=@$dil['yaz147'];?></option>
											<option value="Fancoil Ünitesi" <?php echo($Sonuc['isitma'] == 'Fancoil Ünitesi' ? 'selected' : '');?>><?=@$dil['yaz148'];?></option>					
											<option value="Güneş Enerjisi" <?php echo($Sonuc['isitma'] == 'Güneş Enerjisi' ? 'selected' : '');?>><?=@$dil['yaz149'];?></option>					
											<option value="Jeotermal" <?php echo($Sonuc['isitma'] == 'Jeotermal' ? 'selected' : '');?>><?=@$dil['yaz150'];?></option>					
											<option value="Şömine" <?php echo($Sonuc['isitma'] == 'Şömine' ? 'selected' : '');?>><?=@$dil['yaz151'];?></option>					
											<option value="VRV" <?php echo($Sonuc['isitma'] == 'VRV' ? 'selected' : '');?>><?=@$dil['yaz152'];?></option>					
											<option value="Isı Pompası" <?php echo($Sonuc['isitma'] == 'Isı Pompası' ? 'selected' : '');?>><?=@$dil['yaz153'];?></option>					
										</select>
									</div>
									
								<div class="form-group col-md-6">
										<label for="banyo"><?=@$dil['yaz154'];?></label>
										<select class="form-control w-100" name="banyo" id="banyo" required>
											<option value="0" <?php echo($Sonuc['banyo'] == 0 ? 'selected' : '');?>><?=@$dil['yaz'];?>114</option>											
											<option value="1" <?php echo($Sonuc['banyo'] == '1' ? 'selected' : '');?>>1</option>
											<option value="2" <?php echo($Sonuc['banyo'] == '2' ? 'selected' : '');?>>2</option>
											<option value="3" <?php echo($Sonuc['banyo'] == '3' ? 'selected' : '');?>>3</option>
											<option value="4" <?php echo($Sonuc['banyo'] == '4' ? 'selected' : '');?>>4</option>
											<option value="5" <?php echo($Sonuc['banyo'] == '5' ? 'selected' : '');?>>5</option>
											<option value="6" <?php echo($Sonuc['banyo'] == '6' ? 'selected' : '');?>>6</option>											
											<option value="6 ve üzeri" <?php echo($Sonuc['banyo'] == '6 ve üzeri' ? 'selected' : '');?>>6 <?=@$dil['yaz125'];?></option>					
										</select>
									</div>
									
									<div class="form-group col-md-6">
										<label for="balkon"><?=@$dil['yaz155'];?></label>
										<select class="form-control w-100" name="balkon" id="balkon" required>
											<option value="0" <?php echo($Sonuc['balkon'] == 0 ? 'selected' : '');?>><?=@$dil['yaz114'];?></option>											
											<option value="Var" <?php echo($Sonuc['balkon'] == 'Var' ? 'selected' : '');?>><?=@$dil['yaz156'];?></option>
											<option value="Yok" <?php echo($Sonuc['balkon'] == 'Yok' ? 'selected' : '');?>><?=@$dil['yaz157'];?></option>														
										</select>
									</div>
									
								<div class="form-group col-md-6">
										<label for="esya"><?=@$dil['yaz158'];?></label>
										<select class="form-control w-100" name="esya" id="esya">
											<option value="0" <?php echo($Sonuc['esya'] == 0 ? 'selected' : '');?>><?=@$dil['yaz'];?><?=@$dil['yaz114'];?></option>											
											<option value="Eşyalı" <?php echo($Sonuc['esya'] == 'Eşyalı' ? 'selected' : '');?>><?=@$dil['yaz159'];?></option>
											<option value="Eşyasız" <?php echo($Sonuc['esya'] == 'Eşyasız' ? 'selected' : '');?>><?=@$dil['yaz160'];?></option>														
										</select>
									</div>				
									
									</div>
									
									
								<div class="row">
								<div class="form-group col-md-6">
										<label for="kdrumu"><?=@$dil['yaz161'];?></label>
										<select class="form-control w-100" name="kdrumu" id="kdrumu">
											<option value="0" <?php echo($Sonuc['kdrumu'] == 0 ? 'selected' : '');?>><?=@$dil['yaz114'];?></option>											
											<option value="Boş" <?php echo($Sonuc['kdrumu'] == 'Boş' ? 'selected' : '');?>><?=@$dil['yaz162'];?></option>
											<option value="Kiracılı" <?php echo($Sonuc['kdrumu'] == 'Kiracılı' ? 'selected' : '');?>><?=@$dil['yaz163'];?></option>														
											<option value="Mülk Sahibi" <?php echo($Sonuc['kdrumu'] == 'Mülk Sahibi' ? 'selected' : '');?>><?=@$dil['yaz164'];?></option>														
										</select>
									</div>
									
									
									
								<div class="form-group col-md-6">
										<label for="takas"><?=@$dil['yaz165'];?></label>
										<select class="form-control w-100" name="takas" id="takas" required>
											<option value="0" <?php echo($Sonuc['takas'] == 0 ? 'selected' : '');?>><?=@$dil['yaz114'];?></option>											
											<option value="Evet" <?php echo($Sonuc['takas'] == 'Evet' ? 'selected' : '');?>><?=@$dil['yaz166'];?></option>
											<option value="Hayır" <?php echo($Sonuc['takas'] == 'Hayır' ? 'selected' : '');?>><?=@$dil['yaz167'];?></option>														
										</select>
									</div>	
									
									<div class="form-group col-md-6">
										<label for="krediu"><?=@$dil['yaz168'];?></label>
										<select class="form-control w-100" name="krediu" id="krediu" required>
											<option value="0" <?php echo($Sonuc['krediu'] == 0 ? 'selected' : '');?>><?=@$dil['yaz114'];?></option>											
											<option value="Evet" <?php echo($Sonuc['krediu'] == 'Evet' ? 'selected' : '');?>><?=@$dil['yaz166'];?></option>
											<option value="Hayır" <?php echo($Sonuc['krediu'] == 'Hayır' ? 'selected' : '');?>><?=@$dil['yaz167'];?></option>														
										</select>
									</div>
									
									<div class="form-group col-md-6">
										<label for="garama"><?=@$dil['yaz169'];?></label>
										<select class="form-control w-100" name="garama" id="garama" required>
											<option value="0" <?php echo($Sonuc['garama'] == 0 ? 'selected' : '');?>><?=@$dil['yaz114'];?></option>											
											<option value="Evet" <?php echo($Sonuc['garama'] == 'Evet' ? 'selected' : '');?>><?=@$dil['yaz166'];?></option>
											<option value="Hayır" <?php echo($Sonuc['garama'] == 'Hayır' ? 'selected' : '');?>><?=@$dil['yaz167'];?></option>														
										</select>
									</div>								
									
								</div>
								
								<div class="row">
								<div class="form-group col-md-6">
										<label for="imardurumu"><?=@$dil['yaz170'];?></label>
										<select class="form-control w-100" name="imardurumu" id="imardurumu" required>
											<option value="0" <?php echo($Sonuc['imardurumu'] == 0 ? 'selected' : '');?>><?=@$dil['yaz114'];?></option>
											<option value="Ada" <?php echo($Sonuc['imardurumu'] == 'Ada' ? 'selected' : '');?>><?=@$dil['yaz171'];?></option>											
											<option value="A-Lejantlı" <?php echo($Sonuc['imardurumu'] == 'A-Lejantlı' ? 'selected' : '');?>><?=@$dil['yaz172'];?></option>
											<option value="Arazi" <?php echo($Sonuc['imardurumu'] == '€' ? 'selected' : '');?>><?=@$dil['yaz173'];?></option>														
											<option value="Bağ & Bahçe" <?php echo($Sonuc['imardurumu'] == '£' ? 'selected' : '');?>><?=@$dil['yaz174'];?></option>														
											<option value="Depo & Antrepo" <?php echo($Sonuc['imardurumu'] == 'Depo & Antrepo' ? 'selected' : '');?>><?=@$dil['yaz175'];?></option>														
											<option value="Eğitim" <?php echo($Sonuc['imardurumu'] == 'Eğitim' ? 'selected' : '');?>><?=@$dil['yaz176'];?></option>														
											<option value="Enerji Depolama" <?php echo($Sonuc['imardurumu'] == 'Enerji Depolama' ? 'selected' : '');?>><?=@$dil['yaz177'];?></option>
											<option value="Konut" <?php echo($Sonuc['imardurumu'] == 'Konut' ? 'selected' : '');?>><?=@$dil['yaz178'];?></option>		
											<option value="Muhtelif" <?php echo($Sonuc['imardurumu'] == 'Muhtelif' ? 'selected' : '');?>><?=@$dil['yaz179'];?></option>		
											<option value="Özel Kullanım" <?php echo($Sonuc['imardurumu'] == 'Özel Kullanım' ? 'selected' : '');?>><?=@$dil['yaz180'];?></option>		
											<option value="Sağlık" <?php echo($Sonuc['imardurumu'] == 'Sağlık' ? 'selected' : '');?>><?=@$dil['yaz181'];?></option>		
											<option value="Sanayi" <?php echo($Sonuc['imardurumu'] == 'Sanayi' ? 'selected' : '');?>><?=@$dil['yaz182'];?></option>		
											<option value="Sera" <?php echo($Sonuc['imardurumu'] == 'Sera' ? 'selected' : '');?>><?=@$dil['yaz183'];?></option>		
											<option value="Sit Alanı" <?php echo($Sonuc['imardurumu'] == 'Sit Alanı' ? 'selected' : '');?>><?=@$dil['yaz184'];?></option>		
											<option value="Spor Alanı" <?php echo($Sonuc['imardurumu'] == 'Spor Alanı' ? 'selected' : '');?>><?=@$dil['yaz185'];?></option>		
											<option value="Tarla" <?php echo($Sonuc['imardurumu'] == 'Tarla' ? 'selected' : '');?>><?=@$dil['yaz186'];?></option>		
											<option value="Ticari" <?php echo($Sonuc['imardurumu'] == 'Ticari' ? 'selected' : '');?>><?=@$dil['yaz187'];?></option>		
											<option value="Ticari + Konut" <?php echo($Sonuc['imardurumu'] == 'Ticari + Konut' ? 'selected' : '');?>><?=@$dil['yaz188'];?></option>		
											<option value="Toplu Konut" <?php echo($Sonuc['imardurumu'] == 'Toplu Konut' ? 'selected' : '');?>><?=@$dil['yaz189'];?></option>		
											<option value="Turizm" <?php echo($Sonuc['imardurumu'] == 'Turizm' ? 'selected' : '');?>><?=@$dil['yaz190'];?></option>		
											<option value="Turizm + Konut" <?php echo($Sonuc['imardurumu'] == 'Turizm + Konut' ? 'selected' : '');?>><?=@$dil['yaz191'];?></option>		
											<option value="Villa" <?php echo($Sonuc['imardurumu'] == 'Villa' ? 'selected' : '');?>><?=@$dil['yaz192'];?></option>		
											<option value="Zeytinlik" <?php echo($Sonuc['imardurumu'] == 'Zeytinlik' ? 'selected' : '');?>><?=@$dil['yaz193'];?></option>		
											
										</select>
									</div>
									
								<div class="form-group col-md-6">
										<label for="adano"><?=@$dil['yaz195'];?> <i class="icon-info text-info" data-toggle="popover" data-content="<?=@$dil['yaz194'];?>" data-trigger="hover"></i></label>
										<input type="text" class="form-control form-control-sm" name="adano" value="<?php echo $Sonuc['adano']; ?>">
									</div>
									
									<div class="form-group col-md-6">
										<label for="parselno"><?=@$dil['yaz196'];?> <i class="icon-info text-info" data-toggle="popover" data-content="<?=@$dil['yaz194'];?>" data-trigger="hover"></i></label>
										<input type="text" class="form-control form-control-sm" name="parselno" value="<?php echo $Sonuc['parselno']; ?>">
									</div>
									
								<div class="form-group col-md-6">
										<label for="paftano"><?=@$dil['yaz197'];?> <i class="icon-info text-info" data-toggle="popover" data-content="<?=@$dil['yaz194'];?>" data-trigger="hover"></i></label>
										<input type="text" class="form-control form-control-sm" name="paftano" value="<?php echo $Sonuc['paftano']; ?>">
									</div>
									
								<div class="form-group col-md-6">
										<label for="kaks"><?=@$dil['yaz198'];?> <i class="icon-info text-info" data-toggle="popover" data-content="<?=@$dil['yaz194'];?>" data-trigger="hover"></i></label>
										<input type="text" class="form-control form-control-sm" name="kaks" value="<?php echo $Sonuc['kaks']; ?>">
									</div>
									
								<div class="form-group col-md-6">
										<label for="gabari"><?=@$dil['yaz199'];?> <i class="icon-info text-info" data-toggle="popover" data-content="<?=@$dil['yaz194'];?>" data-trigger="hover"></i></label>
										<input type="text" class="form-control form-control-sm" name="gabari" value="<?php echo $Sonuc['gabari']; ?>">
									</div>
									
									<div class="form-group col-md-6">
										<label for="tapudurumu"><?=@$dil['yaz200'];?> <i class="icon-info text-info" data-toggle="popover" data-content="<?=@$dil['yaz194'];?>" data-trigger="hover"></i></label>
										<select class="form-control w-100" name="tapudurumu" id="tapudurumu" required>
											<option value="0" <?php echo($Sonuc['tapudurumu'] == 0 ? 'selected' : '');?>><?=@$dil['yaz114'];?></option>											
											<option value="Hisseli Tapu" <?php echo($Sonuc['tapudurumu'] == 'Hisseli Tapu' ? 'selected' : '');?>><?=@$dil['yaz201'];?></option>
											<option value="Müstakil Parsel" <?php echo($Sonuc['tapudurumu'] == 'Müstakil Parsel' ? 'selected' : '');?>><?=@$dil['yaz202'];?></option>														
											<option value="Tahsis" <?php echo($Sonuc['tapudurumu'] == 'Tahsis' ? 'selected' : '');?>><?=@$dil['yaz203'];?></option>														
											<option value="Zilliyet" <?php echo($Sonuc['tapudurumu'] == 'Zilliyet' ? 'selected' : '');?>><?=@$dil['yaz204'];?></option>														
										</select>
									</div>	
									
									
								<div class="form-group col-md-6">
										<label for="katkarsiligi"><?=@$dil['yaz205'];?></label>
										<select class="form-control w-100" name="katkarsiligi" id="katkarsiligi" required>
											<option value="0" <?php echo($Sonuc['katkarsiligi'] == 0 ? 'selected' : '');?>><?=@$dil['yaz114'];?></option>											
											<option value="Evet" <?php echo($Sonuc['katkarsiligi'] == 'Evet' ? 'selected' : '');?>><?=@$dil['yaz166'];?></option>
											<option value="Hayır" <?php echo($Sonuc['katkarsiligi'] == 'Hayır' ? 'selected' : '');?>><?=@$dil['yaz167'];?></option>														
										</select>
									</div>
								 
								
								</div>
								
																	
									<div class="row">
									<div class="form-group col-md-3">
										<label><?=@$dil['yaz206'];?> <i class="icon-info text-info" data-toggle="popover" data-content="<?=@$dil['yaz207'];?>" data-trigger="hover"></i></label>
										<input type="text" class="form-control form-control-sm" name="fiyat" value="<?php echo $Sonuc['fiyat']; ?>">
									</div>
									
									
								<div class="form-group col-md-3">
										<label for="aidat"><?=@$dil['yaz208'];?> <i class="icon-info text-info" data-toggle="popover" data-content="<?=@$dil['yaz209'];?>" data-trigger="hover"></i></label>
										<input type="text" class="form-control form-control-sm" name="aidat" value="<?php echo $Sonuc['aidat']; ?>">
									</div>
								
								
								<div class="form-group col-md-3">
										<label><?=@$dil['yaz210'];?> <i class="icon-info text-info" data-toggle="popover" data-content="<?=@$dil['yaz209'];?>" data-trigger="hover"></i></label>
										<input type="text" class="form-control form-control-sm" name="depozito" value="<?php echo $Sonuc['depozito']; ?>">
									</div>
								
								
								<div class="form-group col-md-3">
										<label for="pbirim"><?=@$dil['yaz211'];?></label>
										<select class="form-control w-100" name="pbirim" id="pbirim" required>
											<option value="TL" <?php echo($Sonuc['pbirim'] == '₺' ? 'selected' : '');?>>TL</option>											
											<option value="$" <?php echo($Sonuc['pbirim'] == '$' ? 'selected' : '');?>>$</option>
											<option value="€" <?php echo($Sonuc['pbirim'] == '€' ? 'selected' : '');?>>€</option>														
											<option value="£" <?php echo($Sonuc['pbirim'] == '£' ? 'selected' : '');?>>£</option>														
											<option value="AZN" <?php echo($Sonuc['pbirim'] == 'AZN' ? 'selected' : '');?>>AZN</option>														
										</select>
									</div>

									
									
								</div>
									
									<div class="row">
									
									<div class="form-group col-sm-4">
								<label><?=@$dil['yaz86'];?></label>
								<select name="il" id="il" class="form-control" onchange="findAddress();return false">
									<?php $ILSorgu = $db->prepare("SELECT * FROM il ORDER BY id ASC");
									$ILSorgu->execute();
									$ILislem = $ILSorgu->fetchALL(PDO::FETCH_ASSOC);?>
									<?php foreach ( $ILislem as $ILSonuc ){?>
										<option value="<?php echo $ILSonuc['id']; ?>" data-foo="<?php echo $ILSonuc['il_adi']; ?>" <?php echo($Sonuc['il'] == $ILSonuc['id'] ? 'selected' : '');?>><?php echo $ILSonuc['il_adi']; ?></option>
									<?php }?>	
								</select>
							</div>
							<div class="form-group col-sm-4">
								<label><?=@$dil['yaz87'];?></label>
								<select class="form-control w-100" name="ilce" id="ilce" onchange="findAddress2();return false">
								<option><?=@$dil['yaz87'];?></option>
								</select>
							</div>
							<div class="form-group col-sm-4">
								<label><?=@$dil['yaz212'];?></label>
								<select class="form-control w-100" name="semt" id="semt" onchange="findAddress3();return false">
								<option><?=@$dil['yaz213'];?></option>
								</select>
							</div>
							
							</div>
							
							
							<script>							
								ymaps.ready(init);
								var myMap;

								function init () {
									myMap = new ymaps.Map("map", {
										<?php if($_GET['islem']=="duzenle"){?>
										<?php if($Sonuc['latfield']==""){?>
										center: [<?php echo $ayar['latfield']; ?>, <?php echo $ayar['lngfield']; ?>],
										zoom: <?php echo $ayar['zoom']; ?>
										<?php }else{?>
										center: [<?php echo $Sonuc['latfield']; ?>, <?php echo $Sonuc['lngfield']; ?>],
										zoom: <?php echo $Sonuc['zoom']; ?>
										<?php } ?>
										<?php }else{?>
									   center: [<?php echo $ayar['latfield']; ?>, <?php echo $ayar['lngfield']; ?>],
										zoom: <?php echo $ayar['zoom']; ?>
										<?php } ?>
									}, 
									{
										balloonMaxWidth: 200,
										searchControlProvider: 'yandex#search'
									});
									
									<?php if($_GET['islem']=="duzenle"){?>
									 myPlacemark1 = new ymaps.Placemark([<?php echo $Sonuc['latfield'];?>, <?php echo $Sonuc['lngfield'];?>], {
										 <?php }else{?>
										 myPlacemark1 = new ymaps.Placemark([<?php echo $ayar['latfield'];?>, <?php echo $ayar['lngfield'];?>], {
											 <?php } ?>
											balloonContent: '<?php echo tirnak($Sonuc['adi']); ?>'
										}, {
											iconLayout: 'default#image',
											iconImageClipRect: [[69,0], [97, 46]],
											iconImageHref: 'images/sprite.png',
											iconImageSize: [35, 63],
											iconImageOffset: [-35, -63]
										}),

									/**
									 * Processing events that occur when the user
									 * left-clicks anywhere on the map.
									 * When such an event occurs, we open the balloon.
									 */
									myMap.events.add('click', function (e) {
										if (!myMap.balloon.isOpen()) {
											var coords = e.get('coords');
											myMap.balloon.open(coords, {
												contentHeader:'Latfield-Lngfield Kordinatlar',
												contentBody:'<p>Haritada Seçeceğiniz yerin üstüne tıklayıp, çıkan kordinatları aşağı kopyalayın</p>' +
													'<p>Kordinatlar: ' + [
													coords[0].toPrecision(6),
													coords[1].toPrecision(6)
													].join(', ') + '</p>',
												contentFooter:'<sup>Kopyalayın</sup>'
											});
											$('#latfield').val(coords[0].toPrecision(6));
											$('#lngfield').val(coords[1].toPrecision(6));
										}
										else {
											myMap.balloon.close();
										}
									});
									myMap.events.add('boundschange', function(event) {
									  $('#zoom').val(event.get('newZoom'));
									});
									/**
									 * 
									 * Processing events that occur when the user
									 * right-clicks anywhere on the map.
									 * When such an event occurs, we display a popup hint
									 * at the point of click.
									 */
									myMap.events.add('contextmenu', function (e) {
										myMap.hint.open(e.get('coords'), 'Someone right-clicked');
									});
									
									// Hiding the hint when opening the balloon.
									myMap.events.add('balloonopen', function (e) {
										myMap.hint.close();
									});
									
									myMap.geoObjects.add(myPlacemark1);
								}
							</script>
							<div class="row">
							<label><?=@$dil['yaz214'];?></label>
							<div class="form-group col-sm-12" style="margin-left: -10px;padding-right: 0px;">
							<div id="map-container" class="homepage-map margin-bottom-0">
							<div id="map"></div>
							</div>
							</div>		
							
						
							<div class="form-group col-sm-4">
							<label><?=@$dil['yaz215'];?></label>
							<input type="text" id="latfield" class="form-control" value="<?php echo $Sonuc['latfield']; ?>"  name="latfield" />
							</div>
							
							<div class="form-group col-sm-4">
							<label><?=@$dil['yaz216'];?></label>
							<input type="text" id="lngfield" class="form-control" value="<?php echo $Sonuc['lngfield']; ?>" name="lngfield" />
							</div>
							
							<div class="guncellemegizle form-group col-sm-4">
							<label><?=@$dil['yaz217'];?></label>
							<input id="zoom" name="zoom" class="form-control" type="text" value="<?php echo $Sonuc['zoom']; ?>" />
							</div>	

							</div>							
									
									
									
									<?php if(isset($_GET['islem'])=="duzenle"){?>
									<div class="row">
										<?php if($Sonuc['kapak'] == true){?>
										<div class="form-group col-md-4">
											<img src="<?php echo tema;?>/uploads/emlaklar/<?php echo $Sonuc['kapak'];?>" class="img-responsive img-thumbnail" style="margin-bottom:2px;width:100%;min-height:150px;">
											<a style="width: 100%;" class="btn btn-danger btn-sm popconfirm" title="Kapak Sil" href="../_class/site_islem.php?emlakresimsil=ok&sid=<?php echo $Sonuc['id'];?>"><i class="fas fa-trash"></i> <?=@$dil['yaz220'];?></a>
										</div>
										<?php }?>
										<?php $resimler = $db->prepare("SELECT * FROM emlakresim WHERE pid = ? ");
										$resimler->execute(array($Sonuc['id']));
										$ral = $resimler->fetchALL(PDO::FETCH_ASSOC);?>
										<?php foreach ($ral as $r) {?>
										<div class="form-group col-md-4">
											<img src="<?php echo tema;?>/uploads/emlaklar/diger/<?php echo $r['resim'];?>" class="img-responsive img-thumbnail" style="margin-bottom:2px;width:100%;min-height:150px;">
											<a style="width: 100%;" class="btn btn-danger btn-sm popconfirm" title="Resmi Sil" href="../_class/site_islem.php?emlaktopluresimsil=ok&id=<?php echo $Sonuc['id'];?>&sid=<?php echo $r['id'];?>"><i class="fas fa-trash"></i> <?=@$dil['yaz221'];?></a>
										</div>
										<?php } ?>
									</div>
									<?php }?>					
									<div class="form-group row col-md-12">
									<label><?=@$dil['yaz218'];?></label>
										<input type="file" name="resim" class="file-upload-default">
										<div class="input-group col-xs-12">
											<input type="text" class="form-control file-upload-info form-control-sm" disabled="" placeholder="<?=@$dil['yaz225'];?>">
											<span class="input-group-append">
												<button class="file-upload-browse btn btn-primary btn-sm" type="button"><i class="icon-cloud-upload font-12"></i> <?=@$dil['yaz222'];?></button>
											</span>
										</div>
									</div>					
									<div class="form-group row col-md-12">
									<label><?=@$dil['yaz219'];?></label>
										<input type="file" name="resimler[]" multiple class="file-upload-default">
										<div class="input-group col-xs-12">
											<input type="text" class="form-control file-upload-info form-control-sm" disabled="" placeholder="<?=@$dil['yaz226'];?>">
											<span class="input-group-append">
												<button class="file-upload-browse btn btn-primary btn-sm" type="button"><i class="icon-cloud-upload font-12"></i> <?=@$dil['yaz222'];?></button>
											</span>
										</div>
									</div>
									
									<?php if(isset($_GET['islem'])=="duzenle"){?>							
										<?php if($Sonuc['katalog'] == true){?>
										<div class="form-group col-md-3">
											<div class="row">
												<a class="btn btn-primary btn-sm mr-2" target="_blank" href="<?php echo tema;?>/uploads/emlaklar/katalog/<?php echo $Sonuc['katalog'];?>"><i class="fa fa-download" aria-hidden="true"></i></a>
												<a class="btn btn-danger btn-sm popconfirm" title="Katalog Sil" href="../_class/site_islem.php?katalogsil=ok&sid=<?php echo $Sonuc['id'];?>"><i class="fas fa-trash"></i> <?=@$dil['yaz223'];?></a>
											</div>											
										</div>
										<?php }?>							
									<?php }?>
										<div class="form-group row col-md-12">
									<label><?=@$dil['yaz224'];?></label>
										<input type="file" name="katalog" class="file-upload-default">
										<div class="input-group col-xs-12">
											<input type="text" class="form-control file-upload-info form-control-sm" disabled="" placeholder="<?=@$dil['yaz227'];?>">
											<span class="input-group-append">
												<button class="file-upload-browse btn btn-primary btn-sm" type="button"><i class="icon-cloud-upload font-12"></i> <?=@$dil['yaz222'];?></button>
											</span>
										</div>
									</div>
								
									
									
								<?php if(isset($Sonuc['durum'])=="1"){?>	
									<div class="row">
								<div class="form-group col-md-4">
										<label for="durum"><?=@$dil['yaz228'];?></label>
										<select class="form-control w-100" name="durum" id="durum" required>
											<option value="1" <?php echo($Sonuc['durum'] == '1' ? 'selected' : '');?>>Aktif</option>											
											<option value="0" <?php echo($Sonuc['durum'] == '0' ? 'selected' : '');?>>Pasif</option>
																							
										</select>
									</div>
									</div>
									<?php }else{?>
									<input id="durum" name="durum" class="form-control" type="hidden" value="0" />
									<?php } ?>
									
									
									
									
								
									<div class="form-group">
										<label for="aciklama"><?=@$dil['yaz229'];?></label>
										<textarea name="aciklama" id="ckeditor" class="ckeditor"><?php echo(isset($_GET['islem'])=="duzenle" ? $Sonuc['aciklama'] : '');?></textarea>
									</div>
									
									
								</div>
								
								<div class="tab-pane fade" id="emlak-ozellikleri" role="tabpanel" aria-labelledby="contact-tab-vertical">
									
									<div class="tab-pane" id="ozellikler">
										<div id="secyaz"></div>
									</div>
									
								</div>
								
								<div class="tab-pane fade" id="seo-ayarlari" role="tabpanel" aria-labelledby="contact-tab-vertical">
									
									<div class="form-group">
										<label for="maxlength-textarea"><?=@$dil['yaz230'];?></label>
										<textarea id="maxlength-textarea" name="description"  class="form-control" maxlength="260" rows="2"><?php echo(isset($_GET['islem'])=="duzenle" ? $Sonuc['description'] : '');?></textarea>
									</div>
									<div class="form-group">
										<label for="tags"><?=@$dil['yaz231'];?></small></label>
										<input name="keywords" id="tags" value="<?php echo(isset($_GET['islem'])=="duzenle" ? $Sonuc['keywords'] : '');?>" />
									</div>
									
								</div>
							</div>
						</div>
						
						<div class="col-3"></div>
						<div class="col-9">
							<?php if(isset($_GET['islem'])=="duzenle"){?>
							<button type="submit" name="emlak_guncelle" class="btn btn-success btn-icon-text btn-sm mt-3">
								<i class="mdi mdi-reload  btn-icon-prepend"></i>                                                    
								<?=@$dil['yaz232'];?>
							</button>
							<?php }else{?>
							<button type="submit" name="emlak_ekle" class="btn btn-primary btn-icon-text btn-sm mt-3">
								<i class="mdi mdi-file-check btn-icon-prepend"></i>
								<?=@$dil['yaz233'];?>
							</button>
							<?php } ?>
						</div>						
					</div>						

				</form>
								
							</div>
						</div>
						
					</div>
				</div>
			</section>
			<!-- ============================ User Dashboard End ================================== -->
<?php 
site_mesaj("giris_yap",1,"yes",@$dil['txt45'],@$dil['txt264'],@$dil['txt56']);
site_mesaj("uyelik",1,"yes",@$dil['txt45'],@$dil['txt265'],@$dil['txt56']);
?>
<?php 
site_mesaj("panel_bilgi_guncelle",1,"yes",@$dil['txt45'],@$dil['txt131'],@$dil['txt56']);
site_mesaj("panel_bilgi_guncelle",3,"bos",@$dil['txt59'],@$dil['txt60'],@$dil['txt56']);
site_mesaj("panel_bilgi_guncelle",3,"sifre",@$dil['txt59'],@$dil['txt132'],@$dil['txt56']);
site_mesaj("panel_bilgi_guncelle",2,"no",@$dil['txt57'],@$dil['txt58'],@$dil['txt56']);
?>
<?php 
site_mesaj("emlak_ekle",1,"yes",@$dil['txt45'],@$dil['txt131'],@$dil['txt56']);
site_mesaj("emlak_guncelle",1,"yes",@$dil['txt45'],@$dil['txt131'],@$dil['txt56']);
site_mesaj("emlakresimsil",1,"yes",@$dil['txt45'],@$dil['txt131'],@$dil['txt56']);
site_mesaj("emlaktopluresimsil",1,"yes",@$dil['txt45'],@$dil['txt131'],@$dil['txt56']);
site_mesaj("katalogsil",1,"yes",@$dil['txt45'],@$dil['txt131'],@$dil['txt56']);

site_mesaj("emlak_ekle",2,"no",@$dil['txt57'],@$dil['txt58'],@$dil['txt56']);
site_mesaj("emlak_guncelle",2,"no",@$dil['txt57'],@$dil['txt58'],@$dil['txt56']);
site_mesaj("emlakresimsil",2,"no",@$dil['txt57'],@$dil['txt58'],@$dil['txt56']);
site_mesaj("emlaktopluresimsil",2,"no",@$dil['txt57'],@$dil['txt58'],@$dil['txt56']);
site_mesaj("dokumansil",2,"no",@$dil['txt57'],@$dil['txt58'],@$dil['txt56']);
site_mesaj("katalogsil",2,"no",@$dil['txt57'],@$dil['txt58'],@$dil['txt56']);
?>