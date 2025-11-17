<?php define("GUVENLIK",true);?>
<!DOCTYPE html>
<?php 
if($moduller['alan17'] == "1"){
	if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off")
	{
		$redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: ' . $redirect);
		exit();
	}
}
?> 
<?php 
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
$protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
$url=$protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER['PHP_SELF']); 
$sayfalink = $protocol.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$dilsay		= $db->query("SELECT * FROM  diller")->rowCount();
$dilyaz  	= $db->query("SELECT * FROM diller WHERE id = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
?>
<?php include('pages/sayac.php');?>
<html lang="tr">
<head>

	<base href="<?php echo url; ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Barlow:100,200,300,400,500,600,700,800&amp;display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;600&display=swap" rel="stylesheet">
    <title><?php echo $title;?></title>
	<meta name="description" content="<?php echo $description;?>" />
	<meta name="keywords" content="<?php echo $keywords;?>" />
	<!-- Facebook Metadata Start -->
	<meta property="og:image:height" content="300" />
	<meta property="og:image:width" content="573" />
	<meta property="og:title" content="<?php echo $title;?>" />
	<meta property="og:description" content="<?php echo $description;?>" />
	<meta property="og:url" content="<?php echo $sayfalink;?>" />
	<meta property="og:image" content="<?php echo $url;?><?php echo $paylasim;?>" />
	
	<?php echo dogrulama;?>
	    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo tema;?>/uploads/favicon/<?php echo fav;?>" type="image/x-icon">
    <link rel="icon" href="<?php echo tema;?>/uploads/favicon/<?php echo fav;?>" type="image/x-icon">
    <!-- Custom CSS -->
    <link href="<?php echo tema;?>/assets/css/styles.css" rel="stylesheet">
    <link href="<?php echo tema;?>/assets/css/yeni.css" rel="stylesheet">
    <!-- Custom Color Option -->
    <link href="<?php echo tema;?>/assets/css/colors.php" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo yonetim;?>/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css" />
	<link rel="stylesheet" href="<?php echo tema;?>/assets/css/chosen.css" />

	<!--sweetalert2 -->
	<link rel="stylesheet" href="<?php echo tema;?>/assets/css/sweetalert2.min.css">
	<script src="<?php echo tema;?>/assets/js/jquery.min.js"></script>
	<script src="<?php echo tema;?>/assets/js/sweetalert2.all.min.js"></script>
	<script src="<?php echo tema;?>/assets/js/sweetalert2.min.js"></script>
	
	<?php echo analytics;?>
	<?php echo canli_destek;?>
	
	<script src='https://www.google.com/recaptcha/api.js'></script>	
	<script type="text/javascript" src="https://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58b57282384b6d76"></script>
	<?php
	if($moduller['alan16'] == "1"){
		$html = ".html";
	}
	else
	{
		$html = "";
	}	
	?>
		
</head>
<body class="red-skin">
	

	
	<?php /*if($dilsay > 0){?>
	<div class="diller">
		<a data-toggle="modal" data-target="#lang"  class="trigger-link" title="<?=@$dil['txt1'];?>" alt="<?=@$dil['txt1'];?>"><i class="flag-icon rounded-25 <?php echo $dilyaz['bayrak'];?>"></i></a>
		<span class="tooltiptext"><?=@$dil['txt1'];?></span>
	</div>
	   <div class="modal fade" id="lang" tabindex="-2" role="dialog" aria-labelledby="registermodal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered login-pop-form text-center" role="document">
                <div class="modal-content" id="registermodal">
                    <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                    <div class="modal-body">
              <div class="lang">
				<h4><?=@$dil['txt2'];?></h4>
				<?php 
				$DILSorgu = $db->prepare("SELECT * FROM diller ORDER BY sira ASC");
				$DILSorgu->execute();
				$DILislem 	= $DILSorgu->fetchALL(PDO::FETCH_ASSOC);?>						
				<?php foreach ( $DILislem as $DILSonuc ){?> 
					<a data-id="<?=@$DILSonuc['id'];?>" href="javascript:;" class="<?php echo($dilyaz['id'] == $DILSonuc['id'] ? 'activelang' : '');?> dildegis"><i class="flag-icon <?php echo $DILSonuc['bayrak'];?>"></i> <?php echo $DILSonuc['adi'];?></a>				
				<?php }?>								
				<div class="clear"></div>
			</div>
                        
                    </div>
                </div>
            </div>
        </div>
	
	<?php }*/?>
	<?php echo whatsapp;?>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
	<?php if($moduller['alan19'] == "1"){?>
    <div id="preloader">
        <div class="preloader"><span></span><span></span></div>
    </div>
	<?php }?>
    <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
		
            <!-- ============================================================== -->
            <!-- Top header  -->
            <!-- ============================================================== -->
            <!-- Start Navigation -->
			<div class="top-header">
				<div class="container">
					<div class="row">
					
						<div class="col-lg-6 col-md-6">
							<div class="cn-info">
								<ul>
									<li><i class="lni-phone-handset"></i><a href="tel:<?php echo telefon;?>" style="color:white;"><?php echo telefon;?></a></li>
									<li><i class="ti-email"></i><a href="mailto:<?php echo email;?>" style="color:white;"><?php echo email;?></a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<ul class="top-social">							
								<?php if(facebook){?> <li><a href="<?php echo facebook;?>"><i class="lni-facebook"></i></a></li><?php }?>
								<?php if(twitter){?> <li><a href="<?php echo twitter;?>"><i class="lni-twitter"></i></a></li><?php }?>
                                <?php if(instagram){?><li><a href="<?php echo instagram;?>"><i class="lni-instagram"></i></a></li><?php }?>
								<?php if(linkedin){?> <li><a href="<?php echo linkedin;?>"><i class="lni-linkedin"></i></a></li><?php }?>
								<?php if(youtube){?> <li><a href="<?php echo youtube;?>"><i class="lni-youtube"></i></a></li><?php }?>
								
								
								<?php /*if($moduller["alan13"]=='1'){?>
								<?php if(isset($_SESSION["site_email"])){?>
								<li class="hsb_btn1">
									<a href="<?php echo $htc['hesabimurl'];?><?php echo $html;?>">
										<i class="fas fa-user-circle mr-1"></i><?=@$dil['yaz1'];?></a>
								</li>
								<li class="hsb_btn2">
									<a href="ilan-ekle<?php echo $html;?>"><i class="fas fa-plus mr-1"></i> <?=@$dil['yaz2'];?></a>
								</li>
								<?php }else{?>
								
								<li class="hsb_btn1">
									<a href="#" data-toggle="modal" data-target="#login">
										<i class="fas fa-user-circle mr-1"></i> <?=@$dil['yaz3'];?></a>
								</li>
								<li class="hsb_btn2">
									<a href="#" data-toggle="modal" data-target="#login"><i class="fas fa-plus mr-1"></i> <?=@$dil['yaz4'];?></a>
								</li>
								
								<?php }?>
								<?php }*/?>
							</ul>
							</div>
							
						</div>
						
					</div>
				</div>
			</div>
			<div class="header header-light">
				<div class="container">
					<nav id="navigation" class="navigation navigation-landscape">
						<div class="nav-header">
							<a class="nav-brand" href="./"><img src="<?php echo tema;?>/uploads/logo/<?php echo logo;?>" class="logo" alt="" /></a>
							<div class="nav-toggle"></div>
						</div>
						<div class="nav-menus-wrapper" style="transition-property: none;">
							  <ul class="nav-menu">
								<?php $MENUSorgu = $db->prepare("SELECT * FROM menu WHERE menu_durum = ? AND menu_ust = ? AND dil = ? ORDER BY menu_sira ASC");
								$MENUSorgu->execute(array("1","0",$_SESSION['k_dil']));
								$MENUislem = $MENUSorgu->fetchALL(PDO::FETCH_ASSOC);?>
									<?php foreach ( $MENUislem as $MENUSonuc ){?>
									<?php $altvarmi	= $db->query("SELECT * FROM menu WHERE menu_durum = '1' AND menu_ust = '{$MENUSonuc['id']}' ORDER BY id DESC")->rowCount();?>
									<?php if($MENUSonuc['tip']==0){?>
                                    <li>
                                        <a <?php echo($MENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($MENUSonuc['menu_url'] == "0" ? $MENUSonuc['link'] : $MENUSonuc['menu_url'].$html); ?>"><?php echo $MENUSonuc['menu_isim']; ?> <?php echo($altvarmi > 0 ? '<span class="submenu-indicator"></span>' : '');?></a>
                                        <?php $ALTMENUSorgu = $db->prepare("SELECT * FROM menu WHERE menu_durum = ? AND menu_ust = ? AND dil = ? ORDER BY menu_sira ASC");
										$ALTMENUSorgu->execute(array("1",$MENUSonuc['id'],$_SESSION['k_dil']));
										$ALTMENUislem = $ALTMENUSorgu->fetchALL(PDO::FETCH_ASSOC);?>
										<?php if($ALTMENUSorgu->rowCount()){?>
										<ul class="nav-dropdown nav-submenu">
                                            <?php foreach ( $ALTMENUislem as $ALTMENUSonuc ){?>
											<li><a <?php echo($ALTMENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($ALTMENUSonuc['menu_url'] == "0" ? $ALTMENUSonuc['link'] : $ALTMENUSonuc['menu_url'].$html); ?>"><?php echo $ALTMENUSonuc['menu_isim']; ?></a></li>
											<?php }?>
                                        </ul>
										<?php }?>
                                    </li>
									<?php } else { ?>
									
									<?php if($MENUSonuc['tip']==1){?>											
									<li><a <?php echo($MENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($MENUSonuc['menu_url'] == "0" ? $MENUSonuc['link'] : $MENUSonuc['menu_url'].$html); ?>"><?php echo $MENUSonuc['menu_isim']; ?> <i class="far fa-angle-down"></i></a>
										 <ul class="nav-dropdown nav-submenu">
										<?php 
										function getCategory($CatID=0){
											global $db;
											global $htc;
											global $html;
											$AllMenus = $db->query("SELECT * FROM emlak_kategori WHERE ustid = '{$CatID}' AND dil = '{$_SESSION['k_dil']}' order by sira asc")->fetchALL(PDO::FETCH_ASSOC);														
											foreach($AllMenus as $Menu){														
												$SubCategory = $db->query("SELECT COUNT(*) as total FROM emlak_kategori WHERE ustid = '{$Menu['id']}' AND dil = '{$_SESSION['k_dil']}' order by sira asc")->fetch(PDO::FETCH_ASSOC);
												if($SubCategory['total'] != 0){?>
													<li><a href="<?php echo $htc['emlakkategoriurl']; ?>/<?=$Menu['seo'];?><?php echo $html;?>"><?=ilkbuyuk($Menu['adi']);?> <i class="far fa-angle-right icon-right"></i></a>
														<ul class="nav-dropdown nav-submenu">	
														<?php getCategory($Menu['id']); ?>
														</ul>
													</li>
													<?php }else{?>
														<li><a href="<?php echo $htc['emlakkategoriurl']; ?>/<?=$Menu['seo'];?><?php echo $html;?>"><?=ilkbuyuk($Menu['adi']);?></a></li>
													<?php 
												}
												
											}
										}
										getCategory(0) ;
										?>
										<?php if($MENUSonuc['tbuton']!=""){?>
										<li><a href="<?php echo $MENUSonuc['tbuton']; ?>"><?=@$dil['txt10'];?></a></li>
										<?php } ?>
										</ul>
									</li>
									
									
									<?php }?>
									
									<?php if($MENUSonuc['tip']==2){?>
									<li><a <?php echo($MENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($MENUSonuc['menu_url'] == "0" ? $MENUSonuc['link'] : $MENUSonuc['menu_url'].$html); ?>"><?php echo $MENUSonuc['menu_isim']; ?> <i class="far fa-angle-down"></i></a>
									<?php $MENUURUNSorgu = $db->prepare("SELECT * FROM emlaklar WHERE durum = ? AND dil = ? ORDER BY sira ASC LIMIT ".$MENUSonuc['klimit']."");
									$MENUURUNSorgu->execute(array("1",$_SESSION['k_dil']));
									$MENUURUNislem = $MENUURUNSorgu->fetchALL(PDO::FETCH_ASSOC);?>	
										 <ul class="nav-dropdown nav-submenu">													
											<?php foreach ( $MENUURUNislem as $MENUURUNSonuc ){?>
											<li><a href="<?php echo $htc['ilandetayurl']; ?>/<?php echo $MENUURUNSonuc['seo']; ?><?php echo $html;?>"><?php echo ilkbuyuk($MENUURUNSonuc['adi']);?></a></li>
											<?php }?>
											
											<?php if($MENUSonuc['tbuton']!=""){?>
											<li><a href="<?php echo $MENUSonuc['tbuton']; ?>"><?=@$dil['txt10'];?></a></li>
											<?php } ?>
										</ul>
									</li>
									<?php }?>
									
									<?php if($MENUSonuc['tip']==3){?>
									<li><a <?php echo($MENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($MENUSonuc['menu_url'] == "0" ? $MENUSonuc['link'] : $MENUSonuc['menu_url'].$html); ?>"><?php echo $MENUSonuc['menu_isim']; ?> <i class="far fa-angle-down"></i></a>
									<?php $MENUPKATSorgu = $db->prepare("SELECT * FROM proje_kategori WHERE durum = ? AND dil = ? ORDER BY sira ASC LIMIT ".$MENUSonuc['klimit']."");
									$MENUPKATSorgu->execute(array("1",$_SESSION['k_dil']));
									$MENUPKATislem = $MENUPKATSorgu->fetchALL(PDO::FETCH_ASSOC);?>	
										 <ul class="nav-dropdown nav-submenu">															
											<?php foreach ( $MENUPKATislem as $MENUPKATSonuc ){?>
											<li><a href="<?php echo $htc['projekategoriurl']; ?>/<?php echo $MENUPKATSonuc['seo']; ?><?php echo $html;?>"><?php echo ilkbuyuk($MENUPKATSonuc['adi']);?></a></li>
											<?php }?>
											
											<?php if($MENUSonuc['tbuton']!=""){?>
											<li><a href="<?php echo $MENUSonuc['tbuton']; ?>"><?=@$dil['txt10'];?></a></li>
											<?php } ?>
										</ul>
									</li>
									<?php }?>
									
									<?php if($MENUSonuc['tip']==4){?>
									<li><a <?php echo($MENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($MENUSonuc['menu_url'] == "0" ? $MENUSonuc['link'] : $MENUSonuc['menu_url'].$html); ?>"><?php echo $MENUSonuc['menu_isim']; ?> <i class="far fa-angle-down"></i></a>
									<?php $MENUPKATSorgu = $db->prepare("SELECT * FROM projeler WHERE durum = ? AND dil = ? ORDER BY sira ASC LIMIT ".$MENUSonuc['klimit']."");
									$MENUPKATSorgu->execute(array("1",$_SESSION['k_dil']));
									$MENUPKATislem = $MENUPKATSorgu->fetchALL(PDO::FETCH_ASSOC);?>	
										 <ul class="nav-dropdown nav-submenu">														
											<?php foreach ( $MENUPKATislem as $MENUPKATSonuc ){?>
											<li><a href="<?php echo $htc['projedetayurl']; ?>/<?php echo $MENUPKATSonuc['seo']; ?><?php echo $html;?>"><?php echo ilkbuyuk($MENUPKATSonuc['adi']);?></a></li>
											<?php }?>
											
											<?php if($MENUSonuc['tbuton']!=""){?>
											<li><a href="<?php echo $MENUSonuc['tbuton']; ?>"><?=@$dil['txt10'];?></a></li>
											<?php } ?>
										</ul>
									</li>
									<?php }?>
									
									<?php if($MENUSonuc['tip']==5){?>
									<li><a <?php echo($MENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($MENUSonuc['menu_url'] == "0" ? $MENUSonuc['link'] : $MENUSonuc['menu_url'].$html); ?>"><?php echo $MENUSonuc['menu_isim']; ?> <i class="far fa-angle-down"></i></a>
									<?php $MENUHIZMETSorgu = $db->prepare("SELECT * FROM hizmetler WHERE durum = ? AND dil = ? ORDER BY sira ASC LIMIT ".$MENUSonuc['klimit']."");
									$MENUHIZMETSorgu->execute(array("1",$_SESSION['k_dil']));
									$MENUHIZMETislem = $MENUHIZMETSorgu->fetchALL(PDO::FETCH_ASSOC);?>	
										 <ul class="nav-dropdown nav-submenu">													
											<?php foreach ( $MENUHIZMETislem as $MENUHIZMETSonuc ){?>
											<li><a href="<?php echo $htc['hizmetdetayurl']; ?>/<?php echo $MENUHIZMETSonuc['seo']; ?><?php echo $html;?>"><?php echo ilkbuyuk($MENUHIZMETSonuc['adi']);?></a></li>
											<?php }?>
											
											<?php if($MENUSonuc['tbuton']!=""){?>
											<li><a href="<?php echo $MENUSonuc['tbuton']; ?>"><?=@$dil['txt10'];?></a></li>
											<?php } ?>
										</ul>
									</li>
									<?php }?>								
								

									<?php }?>
									<?php }?>									
                                </ul>
							
							
						</div>
					</nav>
				</div>
			</div>
			<!-- End Navigation -->
			<div class="clearfix"></div>
			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
      <?php 
	if(isset($_GET['sayfa'])){
		$s = $_GET['sayfa'];
		switch($s){
			
		case 'ilan-ekle';
		require_once("pages/ilan_ekle.php");
		break;	
		
		case 'arama';
		require_once("pages/arama.php");
		break;	
		
		case 'ilanlarim';
		require_once("pages/ilanlarim.php");
		break;
			
		case ''.$htc['anaurl'].'';
		require_once("pages/anasayfa.php");
		break;
		
		case ''.$htc['sayfaurl'].'';
		require_once("pages/sayfalar.php");
		break;
		
		case ''.$htc['emlakkategoriurl'].'';
		require_once("pages/emlak_kategori.php");
		break;
		
		case ''.$htc['ilanlarurl'].'';
		require_once("pages/ilanlar.php");
		break;
		
		case ''.$htc['ilandetayurl'].'';
		require_once("pages/ilan.php");
		break;
		
		case ''.$htc['projekategoriurl'].'';
		require_once("pages/proje_kategori.php");
		break;
		
		case ''.$htc['projelerurl'].'';
		require_once("pages/projeler.php");
		break;
		
		case ''.$htc['projedetayurl'].'';
		require_once("pages/proje_detay.php");
		break;
		
		case ''.$htc['ekibdetayurl'].'';
		require_once("pages/ekip.php");
		break;
		
		case ''.$htc['ekiburl'].'';
		require_once("pages/ekibimiz.php");
		break;
		
		case ''.$htc['haberurl'].'';
		require_once("pages/haberler.php");
		break;
		
		case ''.$htc['haberdetayurl'].'';
		require_once("pages/haber_detay.php");
		break;				
		
		case ''.$htc['hizmeturl'].'';
		require_once("pages/hizmetler.php");
		break;
		
		case ''.$htc['hizmetdetayurl'].'';
		require_once("pages/hizmet_detay.php");
		break;						
				
		case ''.$htc['refurl'].'';
		require_once("pages/referanslar.php");
		break;
		
		case ''.$htc['refdetayurl'].'';
		require_once("pages/referans.php");
		break;
		
		case ''.$htc['belgeurl'].'';
		require_once("pages/belgelerimiz.php");
		break;		
		
		case ''.$htc['katalogurl'].'';
		require_once("pages/e_katalog.php");
		break;
		
		case ''.$htc['musteriurl'].'';
		require_once("pages/musteri_gorusleri.php");
		break;
		
		case '404';
		require_once("pages/404.php");
		break;
		
		case ''.$htc['sssurl'].'';
		require_once("pages/sss.php");
		break;
		
		case ''.$htc['ikurl'].'';
		require_once("pages/ik.php");
		break;
		
		case ''.$htc['iletisimurl'].'';
		require_once("pages/iletisim.php");
		break;		
				
		case ''.$htc['hesapolustururl'].'';
		require_once("pages/hesap_olustur.php");
		break;
		
		case ''.$htc['girisyapurl'].'';
		require_once("pages/giris_yap.php");
		break;
		
		case ''.$htc['hesabimurl'].'';
		require_once("pages/hesabim.php");
		break;			
		
		case ''.$htc['bankahesapurl'].'';
		require_once("pages/banka_hesaplari.php");
		break;	
					
		default:
		require_once("pages/anasayfa.php");
		}
	}else{
	require_once("pages/anasayfa.php");
	}
	?>

        <!-- ============================ Call To Action ================================== -->
        <section class="theme-bg call-to-act-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="call-to-act">
                            <div class="call-to-act-head">
                                <h3><?=@$dil['yaz5'];?></h3>
                                <span><?=@$dil['yaz6'];?></span>
                            </div>
                            <a href="<?php echo $htc['ikurl']; ?><?php echo $html; ?>" class="btn btn-call-to-act"><?=@$dil['yaz7'];?></a>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- ============================ Call To Action End ================================== -->

        <!-- ============================ Footer Start ================================== -->
        <footer class="dark-footer skin-dark-footer">
            <div>
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3 col-md-4">
                            <div class="footer-widget">
                                <img src="<?php echo tema;?>/uploads/logo/footer/<?php echo footerlogo;?>" class="img-footer" alt="<?php echo firma_adi;?>" />
                                <div class="footer-add">
                                    <p><?php echo adres;?></p>
                                    <p><a href="tel:<?php echo trim(telefon);?>"><?php echo telefon;?></a></p>
                                    <p><a href="mailto:<?php echo email;?>"><?php echo email;?></a></p>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <div class="footer-widget">
                                <h4 class="widget-title"><?=@$dil['yaz8'];?></h4>
                                <ul class="footer-menu">
                                   <?php $FMENUSorgu = $db->prepare("SELECT * FROM footermenu WHERE menu_durum = ? AND menu_ust = ? AND dil = ? ORDER BY menu_sira ASC LIMIT 0,4");
								$FMENUSorgu->execute(array("1","0",$_SESSION['k_dil']));
								$FMENUislem = $FMENUSorgu->fetchALL(PDO::FETCH_ASSOC);?>
									<?php foreach ( $FMENUislem as $FMENUSonuc ){?>
									<li><a <?php echo($FMENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($FMENUSonuc['menu_url'] == "0" ? $FMENUSonuc['link'] : $FMENUSonuc['menu_url'].$html); ?>"> <?php echo $FMENUSonuc['menu_isim']; ?></a></li>
									<?php }?> 
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-4">
                            <div class="footer-widget">
                               
                                <ul class="footer-menu">
                                   <?php $FMENUSorgu = $db->prepare("SELECT * FROM footermenu WHERE menu_durum = ? AND menu_ust = ? AND dil = ? ORDER BY menu_sira ASC LIMIT 4,4");
								$FMENUSorgu->execute(array("1","0",$_SESSION['k_dil']));
								$FMENUislem = $FMENUSorgu->fetchALL(PDO::FETCH_ASSOC);?>
									<?php foreach ( $FMENUislem as $FMENUSonuc ){?>
									<li><a <?php echo($FMENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($FMENUSonuc['menu_url'] == "0" ? $FMENUSonuc['link'] : $FMENUSonuc['menu_url'].$html); ?>"> <?php echo $FMENUSonuc['menu_isim']; ?></a></li>
									<?php }?> 
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-6">
                            <div class="footer-widget">
                               
                                <ul class="footer-menu">
                                   <?php $FMENUSorgu = $db->prepare("SELECT * FROM footermenu WHERE menu_durum = ? AND menu_ust = ? AND dil = ? ORDER BY menu_sira ASC LIMIT 8,4");
								$FMENUSorgu->execute(array("1","0",$_SESSION['k_dil']));
								$FMENUislem = $FMENUSorgu->fetchALL(PDO::FETCH_ASSOC);?>
									<?php foreach ( $FMENUislem as $FMENUSonuc ){?>
									<li><a <?php echo($FMENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($FMENUSonuc['menu_url'] == "0" ? $FMENUSonuc['link'] : $FMENUSonuc['menu_url'].$html); ?>"><?php echo $FMENUSonuc['menu_isim']; ?></a></li>
									<?php }?> 
                                </ul>
                            </div>
                        </div>
					
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget">
                                <h4 class="widget-title"><?=@$dil['yaz9'];?></h4>
                              
							<form method="post" action="_class/site_islem.php" id="demo-form">
							
							<div class="form-group">
								<div class="input-with-icon">
									<input type="email" name="email" class="form-control" placeholder="<?=@$dil['yaz10'];?>">
									<i class="ti-email"></i>
								</div>
							</div>
							
							<div class="form-group">
							<input type="hidden" name="kontrol" value="" id="kontrol">	
							<input type="hidden" name="donus_url" value="<?php echo $sayfalink;?>" />
							<button style="width: 100%;" type="submit" class="btn btn-theme g-recaptcha" name="ebultenbtn"><?=@$dil['yaz11'];?></button>
							</div>
							
							
							
							</form>
					
                            </div>
                        </div>
						

                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-lg-8 col-md-8">
                            <p class="mb-0"><?php echo copyright;?></p>
                        </div>

                        <div class="col-lg-4 col-md-4 text-right">
                            <ul class="footer-bottom-social">
								<?php if(facebook){?> <li><a href="<?php echo facebook;?>"><i class="ti-facebook"></i></a></li><?php }?>
								<?php if(twitter){?> <li><a href="<?php echo twitter;?>"><i class="ti-twitter"></i></a></li><?php }?>
                                <?php if(instagram){?><li><a href="<?php echo instagram;?>"><i class="ti-instagram"></i></a></li><?php }?>
								<?php if(linkedin){?> <li><a href="<?php echo linkedin;?>"><i class="ti-linkedin"></i></a></li><?php }?>
								<?php if(youtube){?> <li><a href="<?php echo youtube;?>"><i class="ti-youtube"></i></a></li><?php }?>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </footer>
        <!-- ============================ Footer End ================================== -->

        <!-- Üye Girişi Modal -->
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                <div class="modal-content" id="registermodal">
                    <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                    <div class="modal-body">
                        <h4 class="modal-header-title"><?=@$dil['yaz12'];?></h4>
                        <div class="login-form">
                              <form method="post" action="_class/site_islem.php" autocomplete="off">

                                <div class="form-group">
                                    <label><?=@$dil['yaz10'];?></label>
                                    <div class="input-with-icon">
                                        <input type="email" name="email" class="form-control" placeholder="<?=@$dil['yaz10'];?>" value="demo@demo.com">
                                        <i class="ti-user"></i>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label><?=@$dil['yaz'];?>Şifre</label>
                                    <div class="input-with-icon">
                                        <input type="password" name="sifre" class="form-control" placeholder="*******" value="demo">
                                        <i class="ti-unlock"></i>
                                    </div>
                                </div>

                                <div class="form-group">							
                                    <button type="submit" name="giris" class="btn btn-md full-width pop-login"><?=@$dil['yaz13'];?></button>									
                                </div>

                            </form>
                        </div>
                        
                        <div class="row">
                        <div class="col-md-6">
                        <div class="text-center">
                            <p class="mt-5"><a href="<?php echo $htc['hesapolustururl'];?><?php echo $html;?>" class="link"><?=@$dil['yaz14'];?></a></p>                           
                        </div>
                        </div>
						 <div class="col-md-6">
						<div class="text-center">                           
                            <p class="mt-5"><a href="#" data-toggle="modal" data-target="#sifre" class="link" data-dismiss="modal"><?=@$dil['yaz15'];?></a></p>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Üye Girişi End Modal -->
		
		      <!-- Şifremi Unuttum Modal -->
        <div class="modal fade" id="sifre" tabindex="-2" role="dialog" aria-labelledby="registermodal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                <div class="modal-content" id="registermodal">
                    <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                    <div class="modal-body">
                        <h4 class="modal-header-title"><?=@$dil['yaz15'];?></h4>
                        <div class="login-form">
                              <form method="post" action="_class/site_islem.php" autocomplete="off">

                                <div class="form-group">
                                    <label><?=@$dil['yaz10'];?></label>
                                    <div class="input-with-icon">
                                        <input type="email" name="email" class="form-control" placeholder="<?=@$dil['yaz10'];?>">
                                        <i class="ti-user"></i>
                                    </div>
                                </div>


                                <div class="form-group">
									<input type="hidden" name="kontrol" value="" id="kontrol">	
                                    <button type="submit" name="sifre_hatirlat" class="btn btn-md full-width pop-login"><?=@$dil['yaz16'];?></button>
                                </div>

                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Üye Girişi End Modal -->

     

        <a id="back2Top" class="top-scroll" title="<?=@$dil['yaz17'];?>" href="#"><i class="ti-arrow-up"></i></a>


    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

	
<?php 
site_mesaj("giris_yap",2,"no",@$dil['txt57'],@$dil['txt225'],@$dil['txt56']);
site_mesaj("giris_yap",3,"bos",@$dil['txt59'],@$dil['txt128'],@$dil['txt56']);
site_mesaj("musteri_kontol",3,"pasif",@$dil['txt59'],@$dil['txt226'],@$dil['txt56']);
site_mesaj("musteri_kontol",3,"engel",@$dil['txt59'],@$dil['txt227'],@$dil['txt56']);
site_mesaj("sifre_hatirlat",1,"yes",@$dil['txt45'],@$dil['txt228'],@$dil['txt56']);
site_mesaj("sifre_hatirlat",2,"no",@$dil['txt57'],@$dil['txt229'],@$dil['txt56']);
site_mesaj("mesajbtn",1,"yes",@$dil['txt45'],@$dil['txt55'],@$dil['txt56']);
site_mesaj("mesajbtn",2,"no",@$dil['txt57'],@$dil['txt58'],@$dil['txt56']);
site_mesaj("mesajbtn",3,"bos",@$dil['txt59'],@$dil['txt60'],@$dil['txt56']);
site_mesaj("ebultenbtn",1,"yes",@$dil['txt45'],@$dil['txt55'],@$dil['txt56']);
site_mesaj("ebultenbtn",2,"no",@$dil['txt57'],@$dil['txt58'],@$dil['txt56']);
site_mesaj("ebultenbtn",3,"bos",@$dil['txt59'],@$dil['txt60'],@$dil['txt56']);

site_mesaj("yorumbtn",1,"yes",@$dil['txt45'],@$dil['txt55'],@$dil['txt56']);
site_mesaj("yorumbtn",2,"no",@$dil['txt57'],@$dil['txt58'],@$dil['txt56']);
site_mesaj("yorumbtn",3,"bos",@$dil['txt59'],@$dil['txt60'],@$dil['txt56']);

site_mesaj("sitedemo",3,"no",@$dil['txt57'],@$dil['txt61'],@$dil['txt56']);
?>


    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    
    <script src="<?php echo tema;?>/assets/js/popper.min.js"></script>
    <script src="<?php echo tema;?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo tema;?>/assets/js/rangeslider.js"></script>
    <script src="<?php echo tema;?>/assets/js/select2.min.js"></script>
    <script src="<?php echo tema;?>/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo tema;?>/assets/js/slick.js"></script>
    <script src="<?php echo tema;?>/assets/js/slider-bg.js"></script>
    <script src="<?php echo tema;?>/assets/js/lightbox.js"></script>
    <script src="<?php echo tema;?>/assets/js/imagesloaded.js"></script>
	<script src="<?php echo tema;?>/assets/js/chosen.jquery.js"></script>	
    <script src="<?php echo tema;?>/assets/js/custom.js"></script>
    <script src="<?php echo tema;?>/assets/js/cl-switch.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
	
	
	<?php
	error_reporting(0);
	$sayfa=isset($_GET['sayfa']) ? addslashes($_GET['sayfa']) : "";
	if($sayfa=="ilan-ekle"){?>
	<link rel="stylesheet" href="../../<?php echo $ayar['yonetim'];?>/vendors/iconfonts/mdi/font/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="../../<?php echo $ayar['yonetim'];?>/vendors/css/vendor.bundle.addons.css">
	<!-- inject:css -->
	<link rel="stylesheet" href="<?php echo tema;?>/assets/css/style.css">
	<!-- plugins:js -->
	<script src="../../<?php echo $ayar['yonetim'];?>/vendors/js/vendor.bundle.base.js"></script>
	<script src="../../<?php echo $ayar['yonetim'];?>/vendors/js/vendor.bundle.addons.js"></script>
	<!-- endinject -->
	<script src="//cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>
	<link href="../../<?php echo $ayar['yonetim'];?>/vendors/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
	<script src="../../<?php echo $ayar['yonetim'];?>/vendors/datetimepicker/jquery.datetimepicker.js"></script>
	<!-- End custom js for this page-->
	<script src="../../<?php echo $ayar['yonetim'];?>/js/file-upload.js"></script>
	<script src="../../<?php echo $ayar['yonetim'];?>/js/select2.js"></script>	
	<script src="../../<?php echo $ayar['yonetim'];?>/js/form-addons.js"></script>

		<script type="text/javascript">
		
		$(document).ready(function(e) {
			$('#secenek').bind('change', secenekGetir);
		});
		function secenekGetir()
		{
			var id		=$(this).val();	
			var ozellik	=$("#ozellik").val();
			var dil		=$("#dil").val();
			$.ajax({
				type: 'post',
				url: '../../<?php echo $ayar['yonetim'];?>/data/secenek.php',
				data:{"id":id,"ozellik":ozellik,"dil":dil},
				success: function(result) 
				{
					$('#secyaz').html(result);
				}
			});
		}

		$('#secenek').ready(function(){
			var id 		= $("#secenek").val();
			var ozellik	= $("#ozellik").val();
			var dil		= $("#dil").val();
			if(id != 0)
			{
			 $.ajax({
				type: 'post',
				url: '../../<?php echo $ayar['yonetim'];?>/data/secenek.php',
				data:{"id":id,"ozellik":ozellik,"dil":dil},
				success: function(result) 
				{
					$('#secyaz').html(result);
				}
				});
			}
			else
			{
				$("#secyaz").html('Kategori Seçiniz.');
			}
		});	
		</script>
		<script>
			$(document).ready(function(e) {
				$('#il').bind('change', ilceleriGetir);
				$('#ilce').bind('change', semtleriGetir);
			});

			function ilceleriGetir() {
				var ilid = $(this).val();
				var ilceid=$("#ilceid").val();
				$.ajax({
					type: "post",
					url: "../../<?php echo $ayar['yonetim'];?>/dinamik.php",
					data: {
						"ilid": ilid,
						"ilceid": ilceid
					},
					dataType: "json",
					success: function(fur) {
						$("#ilce").html(fur.basari);
					}
				});
			}

			function semtleriGetir() {
				var ilceid = $("#ilce").val();
				var semtid = $("#semtid").val();
				$.ajax({
					type: "post",
					url: "../../<?php echo $ayar['yonetim'];?>/dinamik.php",
					data: {
						"ilceid": ilceid,
						"semtid": semtid
					},
					dataType: "json",
					success: function(fur) {
						$("#semt").html(fur.basari);
					}
				});
			}

			$('#il').ready(function() {
				var ilid = $("#il").val();
				var ilceid=$("#ilceid").val();
				var semtid=$("#semtid").val();
				if (ilid != 0) {
					$.ajax({
						type: "post",
						url: "../../<?php echo $ayar['yonetim'];?>/dinamik.php",
						data: {
							"ilid": ilid,
							"ilceid": ilceid,
							"semtid": semtid
						},
						dataType: "json",
						success: function(fur) {
							$("#ilce").html(fur.basari);
							setTimeout(function() { semtleriGetir(); }, 500);
						}
					});
				} else {
				    console.log('aa');
					$("#ilce").html('<option value="0">Önce İl Seçiniz</option>');
				}
			});
		</script>
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
	<?php }else{?>	
	<?php }?>
<script>
	$(document).on('click', '.dildegis', function () {
		var dilID = $(this).data("id");
		$.ajax({
			url: 'dildegis.php',
			dataType: 'JSON',
			data: {id: dilID},
		})
		.done(function(msg) {
			if(msg.hata){
				alert("<?=@$dil['txt39'];?>");
			}else{
				window.location = "<?php echo $htc['anaurl'];?><?php echo $html;?>";
			}
		})
		.fail(function(err) {
			console.log(err);
		});
	});
	
	
	
	function oturum_kapat(){
		swal({
		  title: '<?=@$dil['txt41'];?>',
		  text: '<?=@$dil['txt42'];?>',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: '<?=@$dil['txt43'];?>', 
		  confirmButtonText: '<?=@$dil['txt44'];?>'
		}).then((result) => {
		  if (result.value) {
			swal({
			  title: '<?=@$dil['txt45'];?>',
			  text: '<?=@$dil['txt46'];?>',
			  type: "success",
			  icon: 'success',
			  timer: 5000
			}).then(function() {
			  window.location.href = '_class/site_islem.php?cikis=ok';
			});
		  }
		});
	}	
	
	
	</script>
<script>
	$(function() {
		$('.chosen-select').chosen();
		$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
	});	
	$(document).ready(function(e) {
		$('#il').bind('change', ilceleriGetir);
	});
	function ilceleriGetir(){
		var id=$(this).val();
		var ilceid=$("#ilceid").val();		
		  $.ajax({
			  type:"post",
			  url:"<?php echo tema;?>/ajax/iller.php",
			  data:{"id":id,"ilceid":ilceid},
			  dataType:"json",
			  success:function(fur){
				  $("#ilce").html(fur.basari);
                  $("#ilce").trigger("chosen:updated");
			  }		  
		  });
	}
	$('#il').ready(function(){
		var id = $("#il").val();
		var ilceid=$("#ilceid").val();
		if(id != 0){
		$.ajax({
			type:"post",
			url:"<?php echo tema;?>/ajax/iller.php",
			data:{"id":id,"ilceid":ilceid},
			dataType:"json",
			success:function(fur){
				$("#ilce").html(fur.basari);
                $("#ilce").trigger("chosen:updated");
			}
		  });
		}else{
			$("#ilce").html('<option value="0">Önce İl Seçiniz</option>');
 		}
	});
	</script>
	
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.4/cookieconsent.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.4/cookieconsent.min.js"></script>
    <script>
        window.addEventListener("load", function() {
            window.cookieconsent.initialise({
                "palette": {
                    "popup": {
                        "background": "<?=@$ayar['renk2'];?>"
                    },
                    "button": {
                        "background": "#fff",
                        "text": "#000000"
                    }
                },
                "theme": "classic",
                "content": {
                    "message": "<?=@$dil['yaz290'];?>",
                    "dismiss": "<?=@$dil['yaz291'];?>",
                    "link": "<?=@$dil['yaz292'];?>",
                    "href":"<?=@$dil['yaz293'];?>"
                }
            })
        });
    </script>
<script>
	$(window).bind('load', function() {
  $('img').each(function() {
    if( (typeof this.naturalWidth != "undefined" && this.naturalWidth == 0) 
    ||  this.readyState == 'uninitialized'                                  ) {
        $(this).attr('src', '<?php echo tema;?>/uploads/logo/<?php echo logo;?>');
    }
  });
});
	
	</script>
	
</body>
</html>