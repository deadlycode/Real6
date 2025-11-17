<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
$page = @intval($_GET['s']);
if(!$page) $page = 1;
$ttsorgu = $db->prepare("SELECT COUNT(*) FROM katalog WHERE durum = ? AND dil = ?");
$ttsorgu->execute(array("1",$_SESSION['k_dil']));
$total = $ttsorgu->fetchColumn();
$limit= $limitayar['limit_sayfabelgeler'];
$page_count = ceil($total/$limit);
if($page > $page_count) $page = 1;
$show = $page * $limit - $limit;
$BSorgu = $db->prepare("SELECT * FROM katalog WHERE durum = ? AND dil = ? ORDER BY sira ASC LIMIT $show,$limit");
$BSorgu->execute(array("1",$_SESSION['k_dil']));
$Bislem = $BSorgu->fetchALL(PDO::FETCH_ASSOC);
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['belgeurl']."' OR link = '".$htc['belgeurl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
?>
<!-- ============================ Page Title Start================================== -->
			<div class="page-title">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							
							<h2 class="ipt-title"><?=@$dil['yaz67'];?></h2>
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
					<!-- /row -->				
					<div class="row">						
						<!-- Single Agent -->
						
						<?php foreach ( $Bislem as $BSonuc ){?>
						<div class="col-lg-<?php echo $limitayar['limit_katalog'];?> col-md-<?php echo $limitayar['limit_katalog'];?> col-sm-12">
							<div class="agents-grid">
								<div class="agents-grid-wrap">									
									<div class="ek-grid-thumb">
										<a <?php if($BSonuc['dosya'] != ""){?> href="<?php echo tema;?>/uploads/katalog/dosya/<?php echo $BSonuc['dosya']; ?>" target="_blank" <?php }else{?> href="<?php echo tema;?>/uploads/katalog/<?php echo $BSonuc['resim']; ?>"  class="mfp-gallery" <?php }?>>											
											<img src="<?php echo tema;?>/uploads/katalog/<?php echo $BSonuc['resim']; ?>" class="img-fluid mx-auto" alt="<?php echo $BSonuc['adi']; ?>" title="<?php echo $BSonuc['adi']; ?>" />
										</a>
									</div>									
								</div>							
								<div class="fr-grid-footer">
									<p class="btn btn-outline-theme full-width mfp-gallery"><?php echo $BSonuc['adi']; ?></p>
								</div>								
							</div>
						</div>	
					<?php }?>									
					</div>				
					
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<ul class="pagination p-center">
						<?php
						if($limitayar['limit_sayfakatalog'] < $total && $limitayar['limit_sayfakatalog'] > 0){
						$showing = 3;
						if($page > 1){?>
						<?php $previous = $page - 1;?>
								<li class="page-item">
									<a class="page-link" href="<?php echo $htc['katalogurl'];?>/<?php echo $previous;?><?php echo $html;?>" aria-label="Previous">
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
								<li class="page-item"><a class="page-link" href="<?php echo $htc['katalogurl'];?>/<?php echo $i; ?><?php echo $html;?>"><?php echo $i; ?></a></li>
								<?php }}}if($page != $page_count){?>
								<?php  $next = $page +1;?>
								<li class="page-item">
									<a class="page-link" href="<?php echo $htc['katalogurl'];?>/<?php echo $next; ?><?php echo $html;?>" aria-label="Next">
										<span class="ti-arrow-right"></span>
										<span class="sr-only"><?=@$dil['yaz24'];?></span>
									</a>
								</li>
								<?php }} ?>	
							</ul>
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