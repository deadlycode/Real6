					<div class="col-lg-3 col-md-4">
							<div class="dashboard-navbar">
								<div class="d-user-avater">
										<?php if ($Bilgilerim['profil']=='') {?> 
										<img src="<?php echo tema;?>/assets/img/profil.jpg" class="img-fluid avater" alt="<?php echo $Bilgilerim['adsoyad']; ?>">										
										<?php }else{ ?>
										<img src="<?php echo tema;?>/uploads/uyeler/<?php echo $Bilgilerim['profil']; ?>" class="img-fluid avater" alt="<?php echo $Bilgilerim['adsoyad']; ?>">										
										<?php } ?>
										
									<h4><?php echo $Bilgilerim['adsoyad']; ?></h4>
									<span><?php echo $Bilgilerim['gorev']; ?></span>
								</div>
								
								<div class="d-navigation">
									<ul>
										<li class="active"><a href="<?php echo $htc['hesabimurl'];?><?php echo $html;?>"><i class="ti-user"></i><?=@$dil['yaz1'];?></a></li>
										<!--<li><a href="favorilerim<?php echo $html;?>"><i class="ti-bookmark"></i><?=@$dil['yaz259'];?></a></li>-->
										<li><a href="ilanlarim<?php echo $html;?>"><i class="ti-layers"></i><?=@$dil['yaz105'];?></a></li>
										<li><a href="ilan-ekle<?php echo $html;?>"><i class="ti-pencil-alt"></i><?=@$dil['yaz260'];?></a></li>										
										<li><a href="javascript:;" onclick="oturum_kapat()"><i class="ti-power-off"></i><?=@$dil['yaz261'];?></a></li>
									</ul>
								</div>
								
							</div>
							</div>


