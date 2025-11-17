<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?> 
<?php 
if($moduller['alan13'] == "0"){
	header("Location:".$url.(altklasor == "1" ? '/' : '')."".$htc['anaurl']."".$html."");
}
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['hesapolustururl']."' OR link = '".$htc['hesapolustururl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$sozlesme 	= $db->query("SELECT * FROM sayfalar WHERE sayfa = '2' AND dil = '{$_SESSION['k_dil']}' ORDER BY id ASC LIMIT 1")->fetch();
?>
<!-- ============================ Page Title Start================================== -->
			<div class="page-title">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							
							<h2 class="ipt-title"><?=@$dil['yaz14'];?></h2>
							<span class="ipn-subtitle"><?=@$dil['yaz3'];?></span>
							
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
												  <input class="form-control" type="text" name="adsoyad" value="<?php echo $_SESSION['uyebilgi']['adsoyad']; ?>" placeholder="<?=@$dil['yaz82'];?>">
											</div>
											
											<div class="form-group col-md-12">
												<label><?=@$dil['yaz83'];?></label>
												<input class="form-control" type="email" name="email" value="<?php echo $_SESSION['uyebilgi']['email']; ?>" placeholder="<?=@$dil['yaz83'];?>">
											</div>
											
											<div class="form-group col-md-12">
												<label><?=@$dil['yaz85'];?></label>
												<input class="form-control" type="text" name="telefon" value="<?php echo $_SESSION['uyebilgi']['telefon']; ?>" placeholder="<?=@$dil['yaz85'];?>">
											</div>
											
											<div class="form-group col-md-12">
												<label><?=@$dil['yaz84'];?></label>
												<input class="form-control" type="text" name="gorev" value="<?php echo $_SESSION['uyebilgi']['gorev']; ?>" placeholder="<?=@$dil['yaz84'];?>">
											</div>
											
											<div class="form-group col-md-12">
												<label><?=@$dil['yaz96'];?></label>
												<input class="form-control" type="text" name="tc" value="<?php echo $_SESSION['uyebilgi']['tc']; ?>" placeholder="<?=@$dil['yaz96'];?>">
											</div>							
											
											<div class="form-group col-md-12">
												<label><?=@$dil['yaz88'];?></label>
												<input class="form-control" type="text" name="adres" value="<?php echo $_SESSION['uyebilgi']['adres']; ?>" placeholder="<?=@$dil['yaz88'];?>">
											</div>
											
											<div class="form-group col-md-12">
												<label><?=@$dil['yaz89'];?></label>
												<input type="file" class="form-control"  name="profil">
											</div>
											
													
											<div class="form-group col-md-12">
												<label><?=@$dil['yaz90'];?></label>
												<input type="file" class="form-control"  name="resim">
											</div>
											
											<div class="form-group col-lg-12">											
												<input class="form-control" type="password" name="parola"  placeholder="<?=@$dil['yaz91'];?>">											
											</div>
											
											<div class="form-group col-lg-12">											
													<input class="form-control" type="password" name="parola_tekrar" placeholder="<?=@$dil['yaz92'];?>">											
											</div>											
											
											
											<div class="form-group col-md-12">
												 <div class="g-recaptcha" data-sitekey="<?php echo $ayar['rcaptha'];?>"></div>
											</div>
											
											 <div class="col-lg-12">
											<div class="form-condition">
												<div class="custom-checkbox mb-0">
													<input type="checkbox" name="sozlesme" value="1" id="chb1" <?php echo ($_SESSION['uyebilgi']['sozlesme']== "1" ? 'checked' : '');?>>
													<label for="chb1"><a href="" data-toggle="modal" data-target="#sozlesme"><?php echo $sozlesme['adi'];?>Kullanıcı Sözleşmesi</a><?=@$dil['yaz97'];?></label>
												</div>
												<div class="custom-checkbox mb-0">
													<input type="checkbox" name="email_bildirim" value="1" id="chb2" <?php echo ($_SESSION['uyebilgi'] == false ? 'checked' : '');?> <?php echo ($_SESSION['uyebilgi']['email_bildirim']== "1" ? 'checked' : '');?>>
													<label for="chb2"><?=@$dil['yaz94'];?></label>
												</div>
												<div class="custom-checkbox mb-0">
													<input type="checkbox" name="sms_bildirim" value="1" id="chb3" <?php echo ($_SESSION['uyebilgi'] == false ? 'checked' : '');?> <?php echo ($_SESSION['uyebilgi']['email_bildirim']== "1" ? 'checked' : '');?>>
													<label for="chb3"><?=@$dil['yaz95'];?></label>
												</div>
											</div>
										</div>
											
											
											
										</div>
									</div>
								</div>
								
								<div class="form-group col-lg-12 col-md-12">
									<input type="hidden" name="kontrol" value="" id="kontrol">
									<button class="btn btn-theme" type="submit" name="uyelik"><?=@$dil['yaz11'];?></button>
								</div>
								</form>
											
							</div>
						</div>
						
					</div>
				</div>
						
			</section>
			<!-- ============================ Submit Property End ================================== -->

<!-- Üye Girişi Modal -->
        <div class="modal fade" id="sozlesme" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                <div class="modal-content" id="registermodal">
                    <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                    <div class="modal-body">
                        <h4 class="modal-header-title" style="font-size:18px;"><?php echo $sozlesme['adi'];?></h4>
                        <div class="login-form">
                          <?php echo $sozlesme['aciklama'];?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Üye Girişi End Modal -->		
<?php 
site_mesaj("uyelik",2,"no",@$dil['txt57'],@$dil['txt58'],@$dil['txt56']);
site_mesaj("uyelik",3,"bos",@$dil['txt59'],@$dil['txt60'],@$dil['txt56']);
site_mesaj("uyelik",3,"sifre",@$dil['txt59'],@$dil['txt132'],@$dil['txt56']);
site_mesaj("uyelik",3,"sozlesme",@$dil['txt59'],@$dil['txt273'],@$dil['txt56']);
site_mesaj("uyelik",3,"kayitli",@$dil['txt59'],@$dil['txt274'],@$dil['txt56']);
?>