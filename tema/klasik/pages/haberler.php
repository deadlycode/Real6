<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
$page = @intval($_GET['s']);
if(!$page) $page = 1;
$ttsorgu = $db->prepare("SELECT COUNT(*) FROM haberler WHERE durum = ? AND dil = ?");
$ttsorgu->execute(array("1",$_SESSION['k_dil']));
$total = $ttsorgu->fetchColumn();
$limit= $limitayar['limit_sayfahaber'];
$page_count = ceil($total/$limit);
if($page > $page_count) $page = 1;
$show = $page * $limit - $limit;
$BSorgu = $db->prepare("SELECT * FROM haberler WHERE durum = ? AND dil = ? ORDER BY sira ASC LIMIT $show,$limit");
$BSorgu->execute(array("1",$_SESSION['k_dil']));
$Bislem = $BSorgu->fetchALL(PDO::FETCH_ASSOC);
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['haberurl']."' OR link = '".$htc['haberurl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
?>

<!-- ============================ Page Title Start================================== -->
			<div class="page-title">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							
							<h2 class="ipt-title"><?=@$dil['yaz75'];?></h2>
							<span class="ipn-subtitle"><?=@$dil['yaz76'];?></span>
							
						</div>
					</div>
				</div>
			</div>
			<!-- ============================ Page Title End ================================== -->
			
			<!-- ============================ Agency List Start ================================== -->
			<section>
			
				<div class="container">
				
					
				<?php if($BSorgu->rowCount()){?>
					<!-- row Start -->
					<div class="row">
					<?php foreach ( $Bislem as $BSonuc ){?>	
						<!-- Single blog Grid -->
						<div class="col-lg-<?php echo $limitayar['limit_haber'];?> col-md-<?php echo $limitayar['limit_haber'];?>">
							<div class="blog-wrap-grid">
								
								<div class="blog-thumb">
									<a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $BSonuc['seo']; ?><?php echo $html;?>"><img style="height:200px; width:100%; object-fit: cover;" src="<?php echo tema;?>/uploads/haberler/<?php echo $BSonuc['resim']; ?>" class="img-fluid" alt="<?php echo $BSonuc['adi']; ?>" /></a>
								</div>
								 
								<div class="blog-info">
									<span class="post-date"><i class="ti-calendar"></i><?php echo $BSonuc['tarih']; ?></span>
								</div>
								
								<div class="blog-body">
									<h4 class="bl-title"><a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $BSonuc['seo']; ?><?php echo $html;?>"><?php echo $BSonuc['adi']; ?></a></h4>
									<p><?php echo kisa(strip_tags($BSonuc['aciklama']),200); ?></p>
									<a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $BSonuc['seo']; ?><?php echo $html;?>" class="bl-continue"><?=@$dil['yaz77'];?></a>
								</div>
								
							</div>
						</div>
						<?php }?>
						
						
					</div>
					<!-- /row -->


				</br>
				<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
						<p class="text-center"><?php echo $total;?> <?=@$dil['txt102'];?>  <?php echo $page;?> - <?php echo $limitayar['limit_sayfahaber'];?> <?=@$dil['txt103'];?></p>
						<ul class="pagination p-center">
						<?php
						if($limitayar['limit_sayfahaber'] < $total && $limitayar['limit_sayfahaber'] > 0){
						$showing = 3;
						if($page > 1){?>
						<?php $previous = $page - 1;?>
								<li class="page-item">
									<a class="page-link" href="<?php echo $htc['haberurl'];?>/<?php echo $previous;?><?php echo $html;?>" aria-label="Previous">
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
								<li class="page-item"><a class="page-link" href="<?php echo $htc['haberurl'];?>/<?php echo $i; ?><?php echo $html;?>"><?php echo $i; ?></a></li>
								<?php }}}if($page != $page_count){?>
								<?php  $next = $page +1;?>
								<li class="page-item">
									<a class="page-link" href="<?php echo $htc['haberurl'];?>/<?php echo $next; ?><?php echo $html;?>" aria-label="Next">
										<span class="ti-arrow-right"></span>
										<span class="sr-only"><?=@$dil['yaz24'];?></span>
									</a>
								</li>
								<?php }} ?>	
							</ul>
						</div>
					</div>
	
		<?php }else{?>	
		<div class="col-12">
			<div class="alert alert-warning text-left w-100" role="alert">
				<p><strong><?=@$dil['txt104'];?></strong></p>
				<?=@$dil['txt105'];?></br>
				<?=@$dil['txt106'];?>
			</div>
		</div>
		<?php }?>				
					
				</div>
						
			</section>
			<!-- ============================ Agency List End ================================== -->