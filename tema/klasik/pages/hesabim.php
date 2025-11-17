<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
if(!isset($_SESSION["site_email"])){
	header("Location:".$url.(altklasor == "1" ? '/' : '')."".$htc['girisyapurl']."".$html."");
}
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['hesabimurl']."' OR link = '".$htc['hesabimurl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$onayli 	= $db->query("SELECT * FROM emlaklar WHERE ekleyen = '{$_SESSION['site_uyeid']}' AND dil = '{$_SESSION['k_dil']}' and uye = '1'")->rowCount();
$onaysiz 	= $db->query("SELECT * FROM emlaklar WHERE ekleyen = '{$_SESSION['site_uyeid']}' AND dil = '{$_SESSION['k_dil']}' and uye = '1' and durum = '0'")->rowCount();
?>

			<!-- ============================ Page Title Start================================== -->
			<div class="page-title">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							
							<h2 class="ipt-title"><?=@$dil['yaz1'];?></h2>
							<span class="ipn-subtitle"><?=@$dil['yaz78'];?></span>
							
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
						
						<div class="col-lg-9 col-md-8">
						
						<div class="row">
					
								
								
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="dashboard-stat widget-2">
										<div class="dashboard-stat-content"><h4><?php echo $onayli;?></h4> <span><?=@$dil['yaz79'];?></span></div>
										<div class="dashboard-stat-icon"><i class="ti-pie-chart"></i></div>
									</div>	
								</div>
								
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="dashboard-stat widget-3">
										<div class="dashboard-stat-content"><h4><?php echo $onaysiz;?></h4> <span><?=@$dil['yaz80'];?></span></div>
										<div class="dashboard-stat-icon"><i class="ti-user"></i></div>
									</div>	
								</div>
								<!--
								<div class="col-lg-4 col-md-6 col-sm-12">
									<div class="dashboard-stat widget-4">
										<div class="dashboard-stat-content"><h4>30</h4> <span><?=@$dil['yaz81'];?></span></div>
										<div class="dashboard-stat-icon"><i class="ti-location-pin"></i></div>
									</div>	
								</div>
								
								-->
								
								

							</div>
						
							<div class="dashboard-wraper">
							  <form action="_class/site_islem.php" method="post" autocomplete="off" enctype="multipart/form-data">
								<!-- Basic Information -->
								<div class="form-submit">										
									<div class="submit-section">
										<div class="form-row">
										
											<div class="form-group col-md-6">
												<label><?=@$dil['yaz82'];?></label>
												<input type="text" name="adsoyad" class="form-control" value="<?php echo $Bilgilerim['adsoyad']; ?>">
											</div>
											
											<div class="form-group col-md-6">
												<label><?=@$dil['yaz83'];?></label>
												 <input type="email" name="email" class="form-control" value="<?php echo $Bilgilerim['email']; ?>">
											</div>
											
											<div class="form-group col-md-6">
												<label><?=@$dil['yaz84'];?></label>
												 <input type="text" name="gorev" class="form-control" value="<?php echo $Bilgilerim['gorev']; ?>">
											</div>
											
											<div class="form-group col-md-6">
												<label><?=@$dil['yaz85'];?></label>
												 <input type="text" name="telefon" class="form-control" value="<?php echo $Bilgilerim['telefon']; ?>">
											</div>
											
											<div class="col-lg-6">
											<div class="form-group">
												<label class="label-text"><?=@$dil['yaz86'];?>
													<span class="span-star-color">*</span>
												</label>
												<select name="il" class="form-control" id="il" title="İl">
													<?php $ILSorgu = $db->prepare("SELECT * FROM il ORDER BY id ASC");
													$ILSorgu->execute();
													$ILislem = $ILSorgu->fetchALL(PDO::FETCH_ASSOC);?>
													<?php foreach ( $ILislem as $ILSonuc ){?>
														<option value="<?php echo $ILSonuc['id']; ?>" <?php echo($Bilgilerim['il'] == $ILSonuc['id'] ? 'selected' : '');?>><?php echo $ILSonuc['il_adi']; ?></option>
													<?php }?>	
												</select>
												<input id="ilceid" name="ilceid" type="hidden" value="<?php echo $Bilgilerim['ilce']; ?>">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label class="label-text"><?=@$dil['yaz87'];?>
													<span class="span-star-color">*</span>
												</label>
												<select class="form-control chosen-select" name="ilce" id="ilce" title="İlçe">
													<option><?=@$dil['txt123'];?></option>
												</select>
											</div>
										</div>
											
											<div class="form-group col-md-12">
												<label><?=@$dil['yaz88'];?></label>
												<input type="text" name="adres" class="form-control" value="<?php echo $Bilgilerim['adres']; ?>">
											</div>
										
											
										</div>
									</div>
								</div>
								
								<div class="form-submit">									
									<div class="submit-section">
										<div class="form-row">
										
											
										<div class="form-group col-md-6">
										
												<label><?=@$dil['yaz89'];?></label>
												<?php if ($Bilgilerim['profil']=='') {?> 
												<img src="<?php echo tema;?>/assets/img/profil.jpg" class="img-fluid avater" alt="<?php echo $Bilgilerim['adsoyad']; ?>" style="width: 290px; height: 290px;">										
												<?php }else{ ?>
												<img src="<?php echo tema;?>/uploads/uyeler/<?php echo $Bilgilerim['profil']; ?>" class="img-fluid avater" alt="<?php echo $Bilgilerim['adsoyad']; ?>" style="width: 290px; height: 290px;">										
												<?php } ?>
												
												<input type="file" class="form-control"  name="profil">
											</div>
											
													
											<div class="form-group col-md-6">
												<label><?=@$dil['yaz90'];?></label>
												<?php if ($Bilgilerim['resim']=='') {?> 
																				
												<?php }else{ ?>
												<a href="<?php echo tema;?>/uploads/uyeler/<?php echo $Bilgilerim['resim']; ?>" target="_blank">
												<img src="<?php echo tema;?>/assets/img/dosya.png" class="img-fluid avater" alt="<?php echo $Bilgilerim['adsoyad']; ?>" style="width: 290px; height: 290px;">										
												</a>									
												<?php } ?>
												
												<input type="file" class="form-control"  name="resim">
											</div>
											
											
											
										</div>
									</div>
								</div>
								
								<div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="label-text"><?=@$dil['yaz91'];?></label>
                                        <input type="password" name="sifre" class="form-control" placeholder="<?=@$dil['yaz91'];?>">
                                    </div>
                                </div>
								<div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="label-text"><?=@$dil['yaz92'];?></label>
                                        <input type="password" name="sifret" class="form-control" placeholder="<?=@$dil['yaz92'];?>">
                                    </div>
                                </div>
                                <div class="col-lg-12">
									<div class="form-condition">
										<div class="custom-checkbox mb-0">
											<input type="checkbox" name="email_bildirim" value="1" id="chb2" <?php echo ($Bilgilerim['email_bildirim'] == "1" ? 'checked' : '');?>>
											<label for="chb2"><?=@$dil['yaz94'];?></label>
										</div>
										<div class="custom-checkbox mb-0">
											<input type="checkbox" name="sms_bildirim" value="1" id="chb3"<?php echo ($Bilgilerim['sms_bildirim'] == "1" ? 'checked' : '');?>>
											<label for="chb3"><?=@$dil['yaz95'];?></label>
										</div>
									</div>
								</div>
								<div class="col-lg-12 mt-3">
                                    <div class="form-group">
                                        <button type="submit" name="panel_bilgi_guncelle" class="btn btn-theme"><?=@$dil['yaz93'];?> <i class="fa fa-angle-right btn-icon"></i></button>
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
site_mesaj("panel_bilgi_guncelle",2,"no",@$dil['txt57'],@$dil['yaz287'],@$dil['txt56']);
?>