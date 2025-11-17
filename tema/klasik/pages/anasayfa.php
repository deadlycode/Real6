<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var my_cookie = $.cookie($('.modal-check').attr('name'));
		if (my_cookie && my_cookie == "true") {
			$(this).prop('checked', my_cookie);
			console.log('checked checkbox');
		} else {
			$('#actionsModal').modal('show');
			console.log('uncheck checkbox');
		}
		$(".modal-check").change(function() {
			$.cookie($(this).attr("name"), $(this).prop('checked'), {
				path: '/',
				expires: 1
			});
		});
	});
</script>
<?php if($popup['durum'] == 1){?>
<!-- Modal -->
<div class="modal fade" id="actionsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0 p-top">
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-1">
				<div class="col-md-12 text-center">
					<a href="<?php echo $popup['url']?>" <?php echo($popup['sekme'] == 1 ? 'target="_blank"' : '');?> title="<?php echo $popup['adi']?>">
						<img src="<?php echo tema;?>/uploads/popup/<?php echo $popup['resim']?>" class="img-responsive" alt="<?php echo $popup['adi']?>" title="<?php echo $popup['adi']?>" style="margin: 0 auto;">
					</a>
				</div>
			</div>
			<div class="modal-footer border-0 p-bottom">
				<div class="checkbox w-100">
					<div class="custom-checkbox mb-0">
						<input type="checkbox" class="modal-check" name="modal-check" id="modal-check">
						<label for="modal-check"><?=@$dil['yaz286'];?></label>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
<?php }?>
<?php if($ayar['slider'] == '1'){?>
<style>
.home-slider .item {
    min-height: 520px;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    text-align: left;
    height: 40vh;
    background-size: cover !important;
    background-position: center !important;
    background-repeat: no-repeat;
}
</style>
<?php }else{ ?>
<style>
.home-slider .item {
    min-height: 520px;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    text-align: left; 
    background-size: contain !important;
    background-position: center !important;
    background-repeat: no-repeat;
}
</style>
<?php } ?>
<!-- ============================ Hero Banner  Start================================== -->
			<div class="home-slider margin-bottom-0">
			<!-- Slide -->					
				<?php $Sorgu = $db->prepare("SELECT * FROM slider WHERE durum = ? AND dil = ? ORDER BY sira ASC");
				$Sorgu->execute(array("1",$_SESSION['k_dil']));
				$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
					<?php foreach ( $islem as $Sliderkey => $Sonuc ){?>	
				<div data-background-image="<?php echo tema;?>/uploads/slider/<?php echo $Sonuc['resim']?>" class="item"></div>				
					<?php }?>		
				</div>		
			<div class="container pcslider">
					<?php if($moduller['alan1'] == "1"){?>	
					<h1 class="big-header-capt mb-0"><?=@$dil['yaz36'];?></h1>
					<p class="text-center mb-5 yazibeyaz"><?=@$dil['yaz37'];?></p>
					<?php }?>
					<?php if($moduller['alan2'] == "1"){?>						
					<div class="full-search-2 eclip-search italian-search hero-search-radius">
						<div class="hero-search-content">
							<form method="POST" action="arama">
    							<div class="row">
    								<div class="col-lg-4 col-md-4 col-sm-12 small-padd">
    									<div class="form-group">
    										<div class="input-with-icon">
    											<input type="text" class="form-control b-r" name="kelime" placeholder="<?=@$dil['yaz38'];?>">
    											<i class="ti-search"></i>
    										</div>
    									</div>
    								</div>								
    								<div class="col-lg-3 col-md-3 col-sm-12 small-padd">
    									<div class="form-group">
    										<div class="input-with-icon">
    											<select id="ptypes" class="form-control" name="kategori">
    												<option value="">&nbsp;</option>
    												<?php $Sorgu = $db->prepare("SELECT * FROM emlak_kategori WHERE durum = ? AND dil = ? and ustid = ? ORDER BY sira ASC");
    												$Sorgu->execute(array("1",$_SESSION['k_dil'],"0"));
    												$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
    													<?php foreach ( $islem as $Sliderkey => $Sonuc ){?>	
    												<option value="<?php echo $Sonuc['id']?>"><?php echo $Sonuc['adi']?></option>
    												<?php }?>
    											</select>
    											<i class="ti-briefcase"></i>
    										</div>
    									</div>
    								</div>								
    								<div class="col-lg-3 col-md-3 col-sm-12 small-padd">
    									<div class="form-group">
    										<div class="input-with-icon b-l b-r">
    											<select id="location" class="form-control" name="il">
    												<option value="">&nbsp;</option>
    												<?php $Sorgu = $db->prepare("SELECT * FROM il ORDER BY id ASC");
    												$Sorgu->execute();
    												$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
    												<?php foreach ( $islem as $Sliderkey => $Sonuc ){?>	
    												<option value="<?php echo $Sonuc['id']?>"><?php echo $Sonuc['il_adi']?></option>
    											<?php }?>
    											</select>
    											<i class="ti-location-pin"></i>
    										</div>
    									</div>
    								</div>								
    								<div class="col-lg-2 col-md-2 col-sm-12 small-padd">
    									<div class="form-group">
    										<button class="btn search-btn" type="submit" name="filtre_uygula"><?=@$dil['yaz39'];?></a>
    									</div>
    								</div>								
    							</div>	
							</form>
						</div>
					</div>
					<?php }?>	
				</div>	
			
			
		<?php $SiralamaSorgu = $db->prepare("SELECT * FROM siralama ORDER BY sira ASC");
		$SiralamaSorgu->execute();
		$Siralamaislem = $SiralamaSorgu->fetchALL(PDO::FETCH_ASSOC);?>
		<?php foreach ( $Siralamaislem as $Siralamakey => $SiralamaSonuc ){ // Forech Döngü Başlangıç//?>			
					
		<?php  if ($SiralamaSonuc['id']=='3') { // Banner?>					
		<?php if($moduller['alan3'] == "1"){?>	
        <section class="gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="sec-heading center">
                            <h2><?=@$dil['yaz40'];?></h2>
                            <p><?=@$dil['yaz41'];?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="property-slide">						
									<?php $Sorgu = $db->prepare("SELECT * FROM emlaklar WHERE durum = ? AND dil = ? and anasayfa = ? ORDER BY sira ASC limit 20");
									$Sorgu->execute(array("1",$_SESSION['k_dil'],"1"));
									$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
									<?php foreach ( $islem as $Sliderkey => $Sonuc ){?>	
									<?php $kategori 	= $db->query("SELECT * FROM emlak_kategori WHERE id = '{$Sonuc['kategori']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
									<?php $ustkategori 	= $db->query("SELECT * FROM emlak_kategori WHERE ustid = '{$kategori['id']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
									<?php $il 	= $db->query("SELECT * FROM il WHERE id = '{$Sonuc['il']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
									<?php $ilce 	= $db->query("SELECT * FROM ilce WHERE id = '{$Sonuc['ilce']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
									<?php $semt 	= $db->query("SELECT * FROM semt WHERE id = '{$Sonuc['semt']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>                           
                            <!-- Single Property -->
                            <div class="single-items">
                                <div class="property-listing property-2">
                                    <div class="listing-img-wrapper">
                                        <div class="list-img-slide">
                                            <div class="click">
                                                <div><a href="<?php echo $htc['ilandetayurl']?>/<?php echo $Sonuc['seo']?><?php echo $html?>"><img src="<?php echo tema;?>/uploads/emlaklar/kapak/<?php echo $Sonuc['kapak']?>" class="img-fluid mx-auto" alt="<?php echo $Sonuc['adi']?>" /></a></div>
												<?php $resimler = $db->prepare("SELECT * FROM emlakresim WHERE pid = ? order by rand() asc limit 2");
												$resimler->execute(array($Sonuc['id']));
												$ral = $resimler->fetchALL(PDO::FETCH_ASSOC);?>
												<?php foreach ($ral as $r) {?>
                                                <div><a href="<?php echo $htc['ilandetayurl']?>/<?php echo $Sonuc['seo']?><?php echo $html?>"><img src="<?php echo tema;?>/uploads/emlaklar/diger/<?php echo $r['resim'];?>" class="img-fluid mx-auto" alt="" /></a></div>
												<?php } ?>
                                            </div>
                                        </div>
                                        <div class="listing-price">
                                            <h4 class="list-pr"><?php echo $il['il_adi']?> / <?php echo $ilce['ilce_adi']?></h4>
                                        </div>
                                        <span class="property-type"><?php echo $kategori['adi']?></span>
                                    </div>

                                    <div class="listing-detail-wrapper pb-0">
                                        <div class="listing-short-detail">
                                            <h4 class="listing-name"><a href="<?php echo $htc['ilandetayurl']?>/<?php echo $Sonuc['seo']?><?php echo $html?>"><?php echo $Sonuc['adi']?></a><i class="list-status ti-check"></i></h4>
                                        </div>
                                    </div>
                                    <div class="price-features-wrapper">
                                        <div class="listing-price-fx">
                                            <h6 class="listing-card-info-price price-prefix fiyatrenk"><?php echo para_format($Sonuc['fiyat'])?> <?php echo $Sonuc['pbirim']?></h6>
                                        </div>                                       
                                    </div>
                                </div>
                            </div>
						<?php }?>	                          
						</div>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>		
		<?php }?>	
		
		
		
		<?php  if ($SiralamaSonuc['id']=='1') { // Banner?>		
		<?php if($moduller['alan4'] == "1"){?>	
			<section>
				<div class="container">
				
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="sec-heading center">
								<h2><?=@$dil['yaz42'];?></h2>
								<p><?=@$dil['yaz43'];?></p>
							</div>
						</div>
					</div>
					
					<div class="row">
					
					<?php $Sorgu = $db->prepare("SELECT * FROM emlaklar WHERE durum = ? AND dil = ?  and kategori = ? ORDER BY sira ASC limit 18");
									$Sorgu->execute(array("1",$_SESSION['k_dil'],$moduller['alan20']));
									$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
									<?php foreach ( $islem as $Sliderkey => $Sonuc ){?>	
									<?php $kategori 	= $db->query("SELECT * FROM emlak_kategori WHERE id = '{$Sonuc['kategori']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
									<?php $ustkategori 	= $db->query("SELECT * FROM emlak_kategori WHERE ustid = '{$kategori['id']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
									<?php $il 	= $db->query("SELECT * FROM il WHERE id = '{$Sonuc['il']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
									<?php $ilce 	= $db->query("SELECT * FROM ilce WHERE id = '{$Sonuc['ilce']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
									<?php $semt 	= $db->query("SELECT * FROM semt WHERE id = '{$Sonuc['semt']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
									<?php $danisman 	= $db->query("SELECT * FROM ekibimiz WHERE id = '{$Sonuc['danisman']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
					
							
								<!-- Single Property Start -->
								<div class="col-lg-4 col-md-6">
									<div class="property-listing property-1">
											
										<div class="listing-img-wrapper">
											<a href="<?php echo $htc['ilandetayurl']?>/<?php echo $Sonuc['seo']?><?php echo $html?>">
												<img src="<?php echo tema;?>/uploads/emlaklar/kapak/<?php echo $Sonuc['kapak']?>" class="img-fluid mx-auto" alt="" />
											</a>
											
											<span class="property-type"><?php echo $kategori['adi']?></span>
										</div>
										
										<div class="listing-content">
										
											<div class="listing-detail-wrapper">
												<div class="listing-short-detail">
													<h4 class="listing-name"><a href="<?php echo $htc['ilandetayurl']?>/<?php echo $Sonuc['seo']?><?php echo $html?>"><?php echo $Sonuc['adi']?></a></h4>
													<span class="listing-location"><i class="ti-location-pin"></i><?php echo $il['il_adi']?> / <?php echo $ilce['ilce_adi']?></span>
												</div>
												<div class="list-author">
													<a href="<?php echo $htc['ekibdetayurl']?>/<?php echo $danisman['seo']?><?php echo $html?>"><img src="<?php echo tema;?>/uploads/ekibimiz/<?php echo $danisman['resim']?>" class="img-fluid img-circle avater-30" alt="<?php echo $danisman['adi']?>" title="<?php echo $danisman['adi']?>"></a>
												</div>
											</div>
										
										
											<div class="listing-footer-wrapper">
												<div class="listing-price">
													<h4 class="list-pr fiyatrenk"><?php echo para_format($Sonuc['fiyat'])?> <?php echo $Sonuc['pbirim']?></h4>
												</div>
												<div class="listing-detail-btn">
													<a href="<?php echo $htc['ilandetayurl']?>/<?php echo $Sonuc['seo']?><?php echo $html?>" class="more-btn"><?=@$dil['yaz44'];?></a>
												</div>
											</div>
											
										</div>
										
									</div>
								</div>
								<!-- Single Property End -->
								
								<?php }?>	
								
							</div>
												
						</div>
						
					
					
				</div>
			</section>
			<?php } ?>
			<?php } ?>
		

      
<?php  if ($SiralamaSonuc['id']=='2') { // Banner?>		
     	<?php if($moduller['alan5'] == "1"){?>	
			<section class="gray">
				<div class="container">
				
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="sec-heading center">
								<h2><?=@$dil['yaz45'];?></h2>
								<p><?=@$dil['yaz46'];?></p>
							</div>
						</div>
					</div>
					
					<div class="row">
						
						<?php $Sorgu = $db->prepare("SELECT * FROM emlaklar WHERE durum = ? AND dil = ?  and kategori = ? ORDER BY sira ASC limit 18");
									$Sorgu->execute(array("1",$_SESSION['k_dil'],$moduller['alan21']));
									$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
									<?php foreach ( $islem as $Sliderkey => $Sonuc ){?>	
									<?php $kategori 	= $db->query("SELECT * FROM emlak_kategori WHERE id = '{$Sonuc['kategori']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
									<?php $ustkategori 	= $db->query("SELECT * FROM emlak_kategori WHERE ustid = '{$kategori['id']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
									<?php $il 	= $db->query("SELECT * FROM il WHERE id = '{$Sonuc['il']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
									<?php $ilce 	= $db->query("SELECT * FROM ilce WHERE id = '{$Sonuc['ilce']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
									<?php $semt 	= $db->query("SELECT * FROM semt WHERE id = '{$Sonuc['semt']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
									<?php $danisman 	= $db->query("SELECT * FROM ekibimiz WHERE id = '{$Sonuc['danisman']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
					
							
								<!-- Single Property Start -->
								<div class="col-lg-4 col-md-6">
									<div class="property-listing property-1">
											
										<div class="listing-img-wrapper">
											<a href="<?php echo $htc['ilandetayurl']?>/<?php echo $Sonuc['seo']?><?php echo $html?>">
												<img src="<?php echo tema;?>/uploads/emlaklar/kapak/<?php echo $Sonuc['kapak']?>" class="img-fluid mx-auto" alt="" />
											</a>
											
											<span class="property-type"><?php echo $kategori['adi']?></span>
										</div>
										
										<div class="listing-content">
										
											<div class="listing-detail-wrapper">
												<div class="listing-short-detail">
													<h4 class="listing-name"><a href="<?php echo $htc['ilandetayurl']?>/<?php echo $Sonuc['seo']?><?php echo $html?>"><?php echo $Sonuc['adi']?></a></h4>
													<span class="listing-location"><i class="ti-location-pin"></i><?php echo $il['il_adi']?> / <?php echo $ilce['ilce_adi']?></span>
												</div>
												<div class="list-author">
													<a href="<?php echo $htc['ekibdetayurl']?>/<?php echo $danisman['seo']?><?php echo $html?>"><img src="<?php echo tema;?>/uploads/ekibimiz/<?php echo $danisman['resim']?>" class="img-fluid img-circle avater-30" alt="<?php echo $danisman['adi']?>" title="<?php echo $danisman['adi']?>"></a>
												</div>
											</div>
										
										
											<div class="listing-footer-wrapper">
												<div class="listing-price">
													<h4 class="list-pr fiyatrenk"><?php echo para_format($Sonuc['fiyat'])?> <?php echo $Sonuc['pbirim']?></h4>
												</div>
												<div class="listing-detail-btn">
													<a href="<?php echo $htc['ilandetayurl']?>/<?php echo $Sonuc['seo']?><?php echo $html?>" class="more-btn"><?=@$dil['yaz44'];?></a>
												</div>
											</div>
											
										</div>
										
									</div>
								</div>
								<!-- Single Property End -->
								
								<?php }?>	
						
						
						
					</div>
					
					
				</div>
			</section>
		<?php } ?>
		<?php } ?>
		
		
		<?php  if ($SiralamaSonuc['id']=='13') { // Banner?>		
		<?php if($moduller['alan12'] == "1"){?>	
		<?php $kurumsal = $db->query("SELECT * FROM sayfalar WHERE anasayfa = '1' AND dil = '{$_SESSION['k_dil']}' ORDER BY id ASC LIMIT 1")->fetch();?>
		<section class="pb-0">
				<div class="container">
					<div class="row align-items-center">
						<?php if($kurumsal['resim']){?>
						<div class="col-lg-6 col-md-6">
							<img src="<?php echo tema;?>/uploads/sayfalar/<?php echo $kurumsal['resim'];?>" class="img-fluid" alt="<?php echo $kurumsal['adi'];?>" title="<?php echo $kurumsal['adi'];?>"> 
						</div>
						<?php }?>
						<div class="col-lg-6 col-md-6">
							<div class="explore-content">
								<h2><?php echo $kurumsal['adi'];?></h2>
								<p><?php echo kisa(strip_tags($kurumsal['aciklama']),700);?></p>
							</div>
						</div>
						
					</div>
					
				</div>		
			</section>
			<?php } ?>
			<?php } ?>



<?php  if ($SiralamaSonuc['id']=='4') { // Banner?>		
      	<?php if($moduller['alan6'] == "1"){?>	
			<section class="gray">
				<div class="container">
					
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="sec-heading center">
								<h2><?=@$dil['yaz47'];?></h2>
								<p><?=@$dil['yaz48'];?></p>
							</div>
						</div>
					</div>
					
					<div class="row">
					<?php $EKIPSorgu = $db->prepare("SELECT * FROM ekibimiz WHERE durum = ? AND anasayfa = ? AND dil = ? ORDER BY id DESC");
					$EKIPSorgu->execute(array("1","1",$_SESSION['k_dil']));
					$EKIPislem = $EKIPSorgu->fetchALL(PDO::FETCH_ASSOC);?>
						<?php foreach ( $EKIPislem as $EKIPSonuc ){?>
						<!-- Single Agent -->
						<div class="col-lg-<?php echo $limitayar['limit_ekip'];?> col-md-<?php echo $limitayar['limit_ekip'];?> col-sm-12">
							<div class="agents-grid">								
								
								<div class="agent-call"><a href="tel:<?php echo trim($EKIPSonuc['telefon']); ?>"><i class="lni-phone-handset"></i></a></div>
								<div class="agents-grid-wrap">
									
									<div class="pr-grid-thumb">
										<a <?php if($EKIPSonuc['detay'] != 1){?> href="<?php echo $htc['ekibdetayurl']; ?>/<?php echo $EKIPSonuc['seo']; ?><?php echo $html;?>" <?php }?>>										
											<img src="<?php echo tema;?>/uploads/ekibimiz/<?php echo $EKIPSonuc['resim']; ?>" class="img-fluid mx-auto pr-img" alt="<?php echo $EKIPSonuc['adi']; ?>" />
										</a>
									</div>
									<div class="fr-grid-deatil">
										<h5 class="fr-can-name"><a <?php if($EKIPSonuc['detay'] != 1){?> href="<?php echo $htc['ekibdetayurl']; ?>/<?php echo $EKIPSonuc['seo']; ?><?php echo $html;?>" <?php }?>><?php echo $EKIPSonuc['adi']; ?></a></h5>
										<span class="fr-position"><i class="lni-map-marker"></i><?php echo $EKIPSonuc['gorev']; ?></span>										
									</div>
									
								</div>
								
								<div class="fr-grid-info">
									<ul>										
										<li><?=@$dil['yaz49'];?><span><?php echo $EKIPSonuc['email']; ?></span></li>
										<?php if($EKIPSonuc['telefon'] != ''){?><li><?=@$dil['yaz50'];?><span><?php echo $EKIPSonuc['telefon']; ?></span></li><?php }?>
									</ul>
								</div>
								<?php if($EKIPSonuc['detay'] != 1){?>
								<div class="fr-grid-footer">
									<a href="<?php echo $htc['ekibdetayurl']; ?>/<?php echo $EKIPSonuc['seo']; ?><?php echo $html;?>" class="btn btn-outline-theme full-width"><?=@$dil['yaz51'];?><i class="ti-arrow-right ml-1"></i></a>
								</div>								
								<?php }else{ ?>								
								<div class="fr-grid-footer">
									<a href="tel:<?php echo trim($EKIPSonuc['telefon']); ?>" class="btn btn-outline-theme full-width"><?=@$dil['yaz52'];?><i class="ti-arrow-right ml-1"></i></a>
								</div>								
								
								<?php }?>
							</div>
						</div>
						<?php }?>
						
						
					</div>
					
				</div>
			</section>
		<?php } ?>
		<?php } ?>
			
			
<?php  if ($SiralamaSonuc['id']=='5') { // Banner?>		
       	<?php if($moduller['alan7'] == "1"){?>	
        <section class="image-cover" style="background:url(<?php echo tema;?>/assets/img/tour-6.jpg) no-repeat;" data-overlay="8">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-lg-8 col-md-8">

                        <div class="smart-textimonials smart-light smart-center" id="smart-textimonials">

                            <?php $Sorgu = $db->prepare("SELECT * FROM musteri_gorusleri WHERE durum = ? ORDER BY id DESC");
							$Sorgu->execute(array("1"));
							$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
								<?php foreach ( $islem as $Sonuc ){?>	
                            <div class="item">
                                <div class="smart-tes-content">
                                    <p><?php echo $Sonuc['yorum']; ?></p>
                                </div>

                                <div class="smart-tes-author">
                                    <div class="st-author-box">
                                        <div class="st-author-thumb">
                                            <img src="<?php echo tema;?>/assets/img/unnamed.png" class="img-fluid" alt="<?php echo $EKIPSonuc['adi']; ?>" />
                                        </div>
                                        <div class="st-author-info">
                                            <h4 class="st-author-title"><?php echo $EKIPSonuc['adi']; ?></h4>
                                            <span class="st-author-subtitle"><?php echo $EKIPSonuc['gorev']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<?php }?>
                          

                        </div>
                    </div>

                </div>
            </div>
        </section>
        <?php } ?>
        <?php } ?>
		
		
			<?php  if ($SiralamaSonuc['id']=='6') { // Banner?>		
			<?php if($moduller['alan8'] == "1"){?>	
			<section class="gray">
				<div class="container">
				
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="sec-heading2 center">
								<div class="sec-left">
									<h3><?=@$dil['yaz53'];?></h3>
									<p><?=@$dil['yaz54'];?></p>
								</div>
								<div class="sec-right">
									<a href="<?php echo $htc['projeurl'];?><?php echo $html;?>"><?=@$dil['yaz55'];?><i class="ti-angle-double-right ml-2"></i></a>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="location-slide">
							
							<?php $Sorgu = $db->prepare("SELECT projeler.*, proje_kategori.adi AS kategori_adi FROM projeler LEFT JOIN proje_kategori ON FIND_IN_SET(proje_kategori.id,projeler.kategori) WHERE projeler.durum = ? AND projeler.anasayfa = ? AND projeler.dil = ? ORDER BY projeler.sira ASC");
							$Sorgu->execute(array("1","1",$_SESSION['k_dil']));
							$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
								<?php foreach ( $islem as $Sonuc ){?>
								<!-- Single location -->
								<div class="single-items">
									<a href="<?php echo $htc['projedetayurl'];?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="img-wrap">
											<div class="img-wrap-content visible">
												<h4><?php echo kisa($Sonuc['adi'],30); ?></h4>
												<span><?php echo kisa($Sonuc['spot'],120); ?></span>
											</div>
										<div class="img-wrap-background" style="background-image: url(<?php echo tema;?>/uploads/projeler/<?php echo $Sonuc['kapak'];?>);"></div>
									</a>
								</div>
								<?php }?>
								
								
							</div>
						</div>
					</div>
					
				</div>
			</section>
			<?php } ?>
			<?php } ?>
			
			<?php  if ($SiralamaSonuc['id']=='10') { // Banner?>		
			<?php if($moduller['alan9'] == "1"){?>	
			<section>
				<div class="container">
					
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="sec-heading center">
								<h2><?=@$dil['yaz56'];?></h2>
								<p><?=@$dil['yaz57'];?></p>
							</div>
						</div>
					</div>
					
					<div class="row">
						
						
						<?php $Sorgu = $db->prepare("SELECT * FROM referanslar WHERE durum = ? AND anasayfa = ? AND dil = ? ORDER BY id DESC");
							$Sorgu->execute(array("1","1",$_SESSION['k_dil']));
							$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
								<?php foreach ( $islem as $Sonuc ){?>
						<!-- Single Location Listing -->
						<div class="col-lg-3 col-md-3 col-sm-6">
							<div class="location-listing">
								<div class="location-listing-thumb">
									<a <?php if($Sonuc['detay'] == 1){?>href="<?php echo $htc['refdetayurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" <?php }else{?> class="mfp-gallery" href="<?php echo tema;?>/uploads/referanslar/<?php echo $Sonuc['resim']; ?>" <?php }?>><img src="<?php echo tema;?>/uploads/referanslar/<?php echo $Sonuc['resim']; ?>" class="img-fluid" alt="<?php echo $Sonuc['adi']; ?>" /></a>
								</div>
								<div class="location-listing-caption">
									<h4><a <?php if($Sonuc['detay'] == 1){?>href="<?php echo $htc['refdetayurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" <?php }else{?> class="mfp-gallery" href="<?php echo tema;?>/uploads/referanslar/<?php echo $Sonuc['resim']; ?>" <?php }?>><?php echo $Sonuc['adi']; ?></a></h4>									
								</div>
							</div>
						</div>
						<?php }?>
						
					</div>
				</div>
			</section>
			<?php } ?>
			<?php } ?>
			
			
		<?php  if ($SiralamaSonuc['id']=='12') { // Banner?>		
       	<?php if($moduller['alan10'] == "1"){?>	
        <section class="gray">
            <div class="container">

                <div class="row">
                    <div class="col text-center">
                        <div class="sec-heading center">
                            <h2><?=@$dil['yaz58'];?></h2>
                            <p><?=@$dil['yaz59'];?></p>
                        </div>
                    </div>
                </div>

                <div class="row">
				
				

                    <?php $Sorgu = $db->prepare("SELECT * FROM haberler WHERE durum = ? AND anasayfa = ? AND dil = ? ORDER BY id DESC LIMIT 6");
					$Sorgu->execute(array("1","1",$_SESSION['k_dil']));
					$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
						<?php foreach ( $islem as $Sonuc ){?>
					<!-- Single blog Grid -->
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-wrap-grid">

                            <div class="blog-thumb">
                                <a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>"><img style="height:200px;" src="<?php echo tema;?>/uploads/haberler/<?php echo $Sonuc['resim']; ?>" class="img-fluid" alt="<?php echo $Sonuc['adi']; ?>" /></a>
                            </div>

                            <div class="blog-info">
                                <span class="post-date"><i class="ti-calendar"></i><?php echo tarih2($Sonuc['tarih']);?></span>
                            </div>

                            <div class="blog-body">
                                <h4 class="bl-title"><a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>"><?php echo $Sonuc['adi']; ?></a></h4>
                                <p><?php echo $Sonuc['spot']; ?></p>
                                <a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="bl-continue"><?=@$dil['yaz60'];?></a>
                            </div>

                        </div>
                    </div>
					<?php }?>
                   

                </div>

            </div>
        </section>
        <?php } ?>
        <?php } ?>
		
			<?php  if ($SiralamaSonuc['id']=='11') { // Banner?>		
			<?php if($moduller['alan10'] == "1"){?>	
			<section>
				<div class="container">
					
					<div class="row">
						<div class="col text-center">
							<div class="sec-heading center">
								<h2><?=@$dil['yaz61'];?></h2>
								<p><?=@$dil['yaz62'];?></p>
							</div>
						</div>
					</div>
					
					<div class="row">
					
					
					
					<?php $Sorgu = $db->prepare("SELECT * FROM paketler WHERE durum = ? AND dil = ? ORDER BY id DESC");
							$Sorgu->execute(array("1",$_SESSION['k_dil']));
							$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
								<?php foreach ( $islem as $Sonuc ){?>
						<style>
						.pr-value:before {
							content: "<?php echo $ayar['pbirim']; ?>";
							position: absolute;
							font-size: 2rem;
							top: -20px;
							left: -40px;
							color: #a6b0d0;
							font-family: 'Lora', serif;
						}						
						</style>
									
						<!-- Single Package -->
						<div class="col-lg-4 col-md-4">
							<div class="pricing-wrap">
								
								<div class="pricing-header">
									<div class="pricing-value">
										<h4 class="pr-value "><?php echo $Sonuc['fiyat']; ?></h4>
									</div>
									<h4 class="pr-title"><?php echo $Sonuc['adi']; ?></h4>
									<span class="pr-subtitle"><?php if($Sonuc['periyod'] == 0){?>
											<?=@$dil['txt90'];?>
											<?php }elseif($Sonuc['periyod'] == 1){?>
												<?php echo($Sonuc['periyod_sure'] > 1 ? $Sonuc['periyod_sure'] : '');?> <?=@$dil['txt91'];?>
											<?php }else{?>
												<?php echo($Sonuc['periyod_sure'] > 1 ? $Sonuc['periyod_sure'] : '');?> <?=@$dil['txt92'];?>
											<?php }?></span>
								</div>
								
								<div class="pricing-body">
									<ul>
										<?php $parcala = preg_split('/,/', $Sonuc['ozellikler'], null, PREG_SPLIT_NO_EMPTY);
										foreach($parcala as $ozellik){?>
											<li><i class="fa fa-check"></i> <?php echo $ozellik;?></li>
										<?php }?>
									</ul>
								</div>
								<div class="pricing-bottom">
									<a href="<?php echo $Sonuc['link']; ?>" class="btn-pricing"><?=@$dil['yaz63'];?></a>
								</div>
								
							</div>
						</div>
								<?php }?>
						
						
					</div>
					
				</div>
			</section>
			<div class="clearfix"></div>
			<?php } ?>
			<?php } ?>
<?php } // Sıralama Forech Döngü Sonu//?>