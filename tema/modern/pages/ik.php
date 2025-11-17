<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['ikurl']."' OR link = '".$htc['ikurl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$iksayfa 	= $db->query("SELECT * FROM sayfalar WHERE sayfa = '1' AND dil = '{$_SESSION['k_dil']}' ORDER BY id ASC LIMIT 1")->fetch();
?> 
<!-- ============================ Page Title Start================================== -->
			<div class="page-title">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							
							<h2 class="ipt-title"><?=@$dil['yaz101'];?></h2>
							<span class="ipn-subtitle"><?=@$dil['yaz65'];?></span>
							
						</div>
					</div>
				</div>
			</div>
			<!-- ============================ Page Title End ================================== -->
			
			<!-- ============================ Submit Property Start ================================== -->
			<section>
			
				<div class="container">
					<div class="row">
					<?php if($iksayfa){?>
						<div class="col-lg-12 col-md-12">
						
							
							<p><?php echo $iksayfa['aciklama'];?></p>
							
						
						</div>
						<?php }?>
						<!-- Submit Form -->
						<div class="<?php echo($iksayfa == true ? 'col-lg-12' : 'col-lg-12');?>">
						
							<div class="submit-page">
						 <form method="post" action="_class/site_islem.php" enctype="multipart/form-data">
								<!-- Basic Information -->
								<div class="form-submit">							
									<div class="submit-section">
										<div class="form-row">
										
											<div class="form-group col-md-12">
												<label><?=@$dil['yaz82'];?></label>
												<input type="text" class="form-control"  name="isim">
											</div>
											
											<div class="form-group col-md-12">
												<label><?=@$dil['yaz83'];?></label>
												<input type="text" class="form-control"  name="email">
											</div>
											
											<div class="form-group col-md-12">
												<label><?=@$dil['yaz85'];?></label>
												<input type="text" class="form-control"  name="telefon">
											</div>
											
											<div class="form-group col-md-12">
												<label><?=@$dil['yaz96'];?></label>
												<input type="text" class="form-control"  name="tc">
											</div>
											
											<div class="form-group col-md-12">
												<label><?=@$dil['yaz102'];?></label>
												<input type="file" class="form-control"  name="cv_dosya">
											</div>
											
											<div class="form-group col-md-12">
												<label><?=@$dil['yaz103'];?></label>
												<textarea class="form-control h-120" name="mesaj"></textarea>
											</div>
											
											
											
											<div class="form-group col-md-12">
												 <div class="g-recaptcha" data-sitekey="<?php echo $ayar['rcaptha'];?>"></div>
											</div>
											
											
											
										</div>
									</div>
								</div>
								
								<div class="form-group col-lg-12 col-md-12">
									<input type="hidden" name="kontrol" value="" id="kontrol">
									<button class="btn btn-theme" type="submit" name="ikbtn"><?=@$dil['yaz11'];?></button>
								</div>
								</form>
											
							</div>
						</div>
						
					</div>
				</div>
						
			</section>
			<!-- ============================ Submit Property End ================================== -->
<?php 
site_mesaj("ikbtn",1,"yes",@$dil['txt45'],@$dil['txt55'],@$dil['txt56']);
site_mesaj("ikbtn",2,"no",@$dil['txt57'],@$dil['txt58'],@$dil['txt56']);
site_mesaj("ikbtn",3,"bos",@$dil['txt59'],@$dil['txt60'],@$dil['txt56']);
?>