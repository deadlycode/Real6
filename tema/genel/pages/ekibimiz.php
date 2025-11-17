<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
$page = @intval($_GET['s']);
if(!$page) $page = 1;
$ttsorgu = $db->prepare("SELECT COUNT(*) FROM ekibimiz WHERE durum = ? AND dil = ?");
$ttsorgu->execute(array("1",$_SESSION['k_dil']));
$total = $ttsorgu->fetchColumn();
$limit= $limitayar['limit_sayfaekibimiz'];
$page_count = ceil($total/$limit);
if($page > $page_count) $page = 1;
$show = $page * $limit - $limit;
$BSorgu = $db->prepare("SELECT * FROM ekibimiz WHERE durum = ? AND dil = ? ORDER BY sira ASC LIMIT $show,$limit");
$BSorgu->execute(array("1",$_SESSION['k_dil']));
$Bislem = $BSorgu->fetchALL(PDO::FETCH_ASSOC);
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['ekiburl']."' OR link = '".$htc['ekiburl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);	
?>
  <!-- ============================ Page Title Start================================== -->
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">

                        <h2 class="ipt-title"><?=@$dil['yaz68'];?></h2>
                        <span class="ipn-subtitle"><?=@$dil['yaz65'];?></span>

                    </div>
                </div>
            </div>
        </div>
        <!-- ============================ Page Title End ================================== -->

        <!-- ============================ Agent List Start ================================== -->
        <section>
	
            <div class="container">
		<?php if($BSorgu->rowCount()){?>

                <div class="row">
					<?php foreach ( $Bislem as $BSonuc ){?>
                    <!-- Single Agent -->
                    <div class="col-lg-<?php echo $limitayar['limit_ekip'];?> col-md-<?php echo $limitayar['limit_ekip'];?> col-sm-12">
                        <div class="agents-grid">                            
                            <?php if($BSonuc['telefon']){?><div class="agent-call"><a href="tel:<?php echo trim($BSonuc['telefon']);?>"><i class="lni-phone-handset"></i></a></div><?php }?>
                            <div class="agents-grid-wrap">

                                <div class="pr-grid-thumb">
                                    <a href="<?php echo $htc['ekibdetayurl']; ?>/<?php echo $BSonuc['seo']; ?><?php echo $html;?>">                                      
                                        <img src="<?php echo tema;?>/uploads/ekibimiz/<?php echo $BSonuc['resim']; ?>" class="img-fluid mx-auto pr-img" alt="<?php echo $BSonuc['adi']; ?>" />
                                    </a>
                                </div>
                                <div class="fr-grid-deatil">
                                    <h5 class="fr-can-name"><a href="#"><?php echo $BSonuc['adi']; ?></a></h5>
                                    <span class="fr-position"><i class="lni-user-secret"></i><?php echo $BSonuc['gorev']; ?></span>
                                    <div class="fr-can-rating">
                                        <?php if($BSonuc['facebook']){?><a href="<?php echo $BSonuc['facebook'];?>"><i class="ti-facebook filled"></i></a><?php }?>
                                        <?php if($BSonuc['twitter']){?><a href="<?php echo $BSonuc['twitter'];?>"><i class="ti-twitter filled"></i></a><?php }?>
                                        <?php if($BSonuc['instagram']){?><a href="<?php echo $BSonuc['instagram'];?>"><i class="ti-instagram filled"></i></a><?php }?>
                                        <?php if($BSonuc['youtube']){?><a href="<?php echo $BSonuc['youtube'];?>"><i class="ti-youtube filled"></i></a><?php }?>
                                        <?php if($BSonuc['linkedin']){?><a href="<?php echo $BSonuc['linkedin'];?>"><i class="ti-linkedin filled"></i></a><?php }?>
                                    </div>
                                </div>

                            </div>

                            <div class="fr-grid-info">
                                <ul>
                                    <?php if($BSonuc['email']){?><li><?=@$dil['yaz49'];?><span><?php echo $BSonuc['email'];?></span></li><?php }?>
                                    <?php if($BSonuc['telefon']){?><li><?=@$dil['yaz50'];?><span><?php echo $BSonuc['telefon'];?></span></li><?php }?>
                                </ul>
                            </div>

                            <div class="fr-grid-footer">
                                <a <?php if($BSonuc['detay'] == 1){?> href="<?php echo $htc['ekibdetayurl']; ?>/<?php echo $BSonuc['seo']; ?><?php echo $html;?>" <?php }else{?><?php }?> class="btn btn-outline-theme full-width"><?=@$dil['yaz44'];?><i class="ti-arrow-right ml-1"></i></a>
                            </div>

                        </div>
                    </div>
					<?php }?>
					
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<ul class="pagination p-center">
						<?php
						if($limitayar['limit_sayfaekibimiz'] < $total && $limitayar['limit_sayfaekibimiz'] > 0){
						$showing = 3;
						if($page > 1){?>
						<?php $previous = $page - 1;?>
								<li class="page-item">
									<a class="page-link" href="<?php echo $htc['ekiburl'];?>/<?php echo $previous;?><?php echo $html;?>" aria-label="Previous">
										<span class="ti-arrow-left"></span>
										<span class="sr-only"><?=@$dil['yaz24'];?></span>
									</a>
								</li>
								<?php }
								for($i= $page - $showing; $i < $page + $showing + 1; $i++){
								if($i > 0 and $i <= $page_count){
								if($i == $page){?>								
								<li class="page-item active"><a class="page-link" href="#"><?php echo $i; ?></a></li>
								<?php }else{?>								
								<li class="page-item"><a class="page-link" href="<?php echo $htc['ekiburl'];?>/<?php echo $i; ?><?php echo $html;?>"><?php echo $i; ?></a></li>
								<?php }}}if($page != $page_count){?>
								<?php  $next = $page +1;?>
								<li class="page-item">
									<a class="page-link" href="<?php echo $htc['ekiburl'];?>/<?php echo $next; ?><?php echo $html;?>" aria-label="Next">
										<span class="ti-arrow-right"></span>
										<span class="sr-only"><?=@$dil['yaz24'];?></span>
									</a>
								</li>
								<?php }} ?>	
							</ul>
						</div>
					</div>
                  

                </div>
		<?php }else{?>
		<div class="alert alert-warning text-left w-100" role="alert">
			<p><strong><?=@$dil['txt104'];?></strong></p>
			<?=@$dil['txt105'];?></br>
			<?=@$dil['txt106'];?>
		</div>
		<?php }?>	
            </div>

        </section>
        <!-- ============================ Agent List End ================================== -->