<!-- ============================ Page Title Start================================== -->
			<div class="page-title">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							
							<h2 class="ipt-title"><?=@$dil['yaz243'];?></h2>
							<span class="ipn-subtitle"><?=@$dil['yaz244'];?></span>
							
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
					
						<div class="col-lg-7 col-md-7">
							<form method="post" action="_class/site_islem.php">
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label><?=@$dil['yaz82'];?></label>
										<input type="text" name="isim" class="form-control simple">
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label><?=@$dil['yaz83'];?></label>
										<input type="email" name="email" class="form-control simple">
									</div>
								</div>
								
							</div>
							<div class="row">
							<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label><?=@$dil['yaz85'];?></label>
								<input type="text" name="telefon" class="form-control simple">
							</div>
							</div>
							<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label><?=@$dil['yaz245'];?></label>
								<input type="text" name="konu" class="form-control simple">
							</div>
							</div>
							
							</div>
							
							<div class="form-group">
								<label><?=@$dil['yaz103'];?></label>
								<textarea class="form-control simple" name="mesaj"></textarea>
							</div>
							
							<div class="form-group">
							 <div class="g-recaptcha" data-sitekey="<?php echo $ayar['rcaptha'];?>"></div>
							</div>
							
							<div class="form-group">
								<input type="hidden" name="kontrol" value="" id="kontrol">	
								<input type="hidden" name="iletisimurl" value="<?php echo $sayfalink;?>" />
								<button class="btn btn-theme" type="submit" name="mesajbtn"><?=@$dil['yaz246'];?></button>
							</div>
							</form>
							
											
						</div>
						
						<div class="col-lg-5 col-md-5">
							<div class="contact-info">
								
								<h2><?=@$dil['yaz247'];?></h2>
								<p><?=@$dil['yaz248'];?></p>
								
								<div class="cn-info-detail">
									<div class="cn-info-icon">
										<i class="ti-home"></i>
									</div>
									<div class="cn-info-content">
										<h4 class="cn-info-title"><?=@$dil['yaz88'];?></h4>
										 <?php echo adres;?>
									</div>
								</div>
								
								<div class="cn-info-detail">
									<div class="cn-info-icon">
										<i class="ti-email"></i>
									</div>
									<div class="cn-info-content">
										<h4 class="cn-info-title"><?=@$dil['yaz83'];?></h4>
										<?php echo email;?>
									</div>
								</div>
								
								<div class="cn-info-detail">
									<div class="cn-info-icon">
										<i class="ti-mobile"></i>
									</div>
									<div class="cn-info-content">
										<h4 class="cn-info-title"><?=@$dil['yaz85'];?></h4>
										<?php echo telefon;?></br> F. <?php echo fax;?>
									</div>
								</div>
								
							</div>
						</div>
						
						<?php echo maps;?>
						
					</div>
					<!-- /row -->		
					
				</div>
						
			</section>
			<!-- ============================ Agency List End ================================== -->