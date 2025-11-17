<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php
if(strip_tags(isset($_GET['id'])))
{
	$aSorgu = $db->prepare("SELECT * FROM haberler WHERE seo = ? AND durum = ? AND dil = ?");
	$aSorgu->execute(array($_GET['id'],1,$_SESSION['k_dil']));
	if($aSorgu->rowCount()){
		$aSonuc 		= $aSorgu->fetch(PDO::FETCH_ASSOC);
	}else{
		header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
		exit();
	}
}
else
{
	$aSorgu = $db->prepare("SELECT * FROM haberler WHERE durum = ? AND dil = ? ORDER BY id ASC");
	$aSorgu->execute(array(1,$_SESSION['k_dil']));
	if($aSorgu->rowCount()){
		$aSonuc 		= $aSorgu->fetch(PDO::FETCH_ASSOC);
	}else{
		header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
		exit();
	}
}
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['hizmetdetayurl']."/".$aSonuc['seo']."' OR link = '".$htc['hizmetdetayurl']."/".$aSonuc['seo']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);		
$geri	= $db->query("SELECT * FROM haberler WHERE id < '{$aSonuc['id']}' AND dil = '{$_SESSION['k_dil']}' ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$ileri = $db->query("SELECT * FROM haberler WHERE id > '{$aSonuc['id']}' AND dil = '{$_SESSION['k_dil']}' ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);		
$rastgele 	= $db->query("SELECT * FROM haberler WHERE durum = '1' AND dil = '{$_SESSION['k_dil']}' order by rand()")->fetch(PDO::FETCH_ASSOC);		
?>
<!-- ============================ Page Title Start================================== -->
			<div class="page-title">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							
							<h2 class="ipt-title"><?php echo $aSonuc['adi'];?></h2>
							<span class="ipn-subtitle"><?=@$dil['yaz70'];?></span>
							
						</div>
					</div>
				</div>
			</div>
			<!-- ============================ Page Title End ================================== -->
			
			<!-- ============================ Agency List Start ================================== -->
			<section>
			
				<div class="container">
				
					<!-- row Start -->
					<div class="row">
					
						<!-- Blog Detail -->
						<div class="col-lg-8 col-md-12 col-sm-12 col-12">
							<div class="blog-details single-post-item format-standard">
								<div class="post-details">	
								<?php if($aSonuc['resim'] != ""){?>								
									<div class="post-featured-img">
										<img class="img-fluid" src="<?php echo tema;?>/uploads/haberler/<?php echo $aSonuc['resim'];?>" alt="<?php echo $aSonuc['adi'];?>">
									</div>	
									<?php }?>
									<h2 class="post-title"><?php echo $aSonuc['adi'];?></h2>									
									<p><?php echo $aSonuc['aciklama'];?></p>
									<?php if($aSonuc['videoid']){?>
									<iframe style="width:100%;height:500px;" src="https://www.youtube.com/embed/<?php echo $aSonuc['videoid']; ?>?rel=0&amp;showinfo=0" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
									<?php }?>	
									<?php $ISorgu = $db->prepare("SELECT * FROM haberfoto WHERE resimid = ? ORDER BY id ASC");
									$ISorgu->execute(array($aSonuc['id']));
									$Iislem = $ISorgu->fetchALL(PDO::FETCH_ASSOC);?>
									<?php if($ISorgu->rowCount() != "0"){?>									
									<?php foreach ( $Iislem as $ISonuc ){?>		
									<div class="col-lg-<?php echo $limitayar['limit_referanslar'];?> col-md-<?php echo $limitayar['limit_referanslar'];?> col-sm-<?php echo $limitayar['limit_referanslar'];?>">
										
											<div class="agents-grid-wrap">									
												<div class="rf-grid-thumb">
													<a href="<?php echo tema;?>/uploads/haberler/fotogaleri/<?php echo $ISonuc['resim']; ?>" class="mfp-gallery">											
														<img src="<?php echo tema;?>/uploads/haberler/fotogaleri/<?php echo $ISonuc['resim']; ?>" class="img-fluid mx-auto" alt="<?php echo $aSonuc['adi']; ?>" title="<?php echo $aSonuc['adi']; ?>" />
													</a>
												</div>									
											</div>						
																		
										
									</div>
									<?php }}?>		
								</div>
								
								<div class="single-post-pagination">
										<div class="prev-post">
											<a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $geri['seo']; ?><?php echo $html;?>">
												<div class="title-with-link">
													<span class="intro"><?=@$dil['yaz71'];?></span>
													<h3 class="title"><?php echo $geri['adi'];?></h3>
												</div>
											</a>
										</div>
										<div class="post-pagination-center-grid">
											<a href="<?php echo $htc['haberurl']; ?>/<?php echo $html;?>" title="Tüm Haberler"><i class="ti-layout-grid3"></i></a>
										</div>
										<div class="next-post">
											<a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $ileri['seo']; ?><?php echo $html;?>">
												<div class="title-with-link">
													<span class="intro"><?=@$dil['yaz24'];?> <?=@$dil['yaz72'];?></span>
													<h3 class="title"><?php echo $ileri['adi'];?></h3>
												</div>
											</a>
										</div>
									</div>
							</div>						
						</div>
						
						<!-- Single blog Grid -->
						<div class="col-lg-4 col-md-12 col-sm-12 col-12">
							
							<!-- Categories -->
							<div class="single-widgets widget_category">
								<h4 class="title"><?=@$dil['yaz73'];?></h4>
								<ul>
								<?php $SSorgu = $db->prepare("SELECT * FROM hizmetler WHERE durum = ? AND dil = ? ORDER BY id DESC limit 10");
						$SSorgu->execute(array("1",$_SESSION['k_dil']));
						$islem = $SSorgu->fetchALL(PDO::FETCH_ASSOC);?>
							<?php foreach ( $islem as $SSonuc ){?>
                            <li class="<?php echo($SSonuc['seo'] == $aSonuc['seo'] ? 'active' : '' );?>"><a href="<?php echo $htc['hizmetdetayurl']; ?>/<?php echo $SSonuc['seo']; ?><?php echo $html;?>"><?php echo $SSonuc['adi']; ?></a></li>
							<?php }?>
								</ul>
							</div>
							
							<!-- Trending Posts -->
							<div class="single-widgets widget_thumb_post">
								<h4 class="title"><?=@$dil['yaz70'];?></h4>
								<ul>
								<?php $SSorgu = $db->prepare("SELECT * FROM haberler WHERE durum = ? AND dil = ? ORDER BY id DESC limit 5");
						$SSorgu->execute(array("1",$_SESSION['k_dil']));
						$islem = $SSorgu->fetchALL(PDO::FETCH_ASSOC);?>
							<?php foreach ( $islem as $SSonuc ){?>
								
									<li>
										<span class="left">
											<img src="<?php echo tema;?>/uploads/haberler/<?php echo $SSonuc['resim']; ?>" alt="<?php echo $SSonuc['adi']; ?>" class="">
										</span>
										<span class="right">
											<a class="feed-title" href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $SSonuc['seo']; ?><?php echo $html;?>"><?php echo $SSonuc['adi']; ?></a> 
											<span class="post-date"><i class="ti-calendar"></i><?php echo $SSonuc['tarih']; ?></span>
										</span>
									</li>
									<?php }?>
								</ul>
							</div>
							
							<!-- Tags Cloud -->
							<div class="single-widgets widget_tags">
								<h4 class="title"><?=@$dil['yaz74'];?></h4>
								<ul>
								
									<?php $parcala = explode(",",$aSonuc['keywords']);
									$last_key = end(array_keys($parcala));
									foreach($parcala as $key => $ozellik){?>
									<li><a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $aSonuc['seo']; ?><?php echo $html;?>"><?php echo $ozellik;?></a></li>
									<?php }?>
									
								</ul>
							</div>
							
						</div>
						
					</div>
					<!-- /row -->					
					
				</div>
						
			</section>
			<!-- ============================ Agency List End ================================== -->