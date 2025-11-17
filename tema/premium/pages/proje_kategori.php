<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php
if(strip_tags(isset($_GET['id'])))
{
	$Sorgu = $db->prepare("SELECT * FROM proje_kategori WHERE seo = ? AND dil = ?");
	$Sorgu->execute(array($_GET['id'],$_SESSION['k_dil']));
	if($Sorgu->rowCount()){
		$Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
	}else{
		header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
		exit();
	}
}
else
{
	$Sorgu = $db->prepare("SELECT * FROM proje_kategori WHERE dil = ? ORDER BY sira ASC");
	$Sorgu->execute(array($_SESSION['k_dil']));
	if($Sorgu->rowCount()){
		$Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
	}else{
		header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
		exit();
	}
}
$page = @intval($_GET['s']);
if(!$page) $page = 1;
$ttsorgu = $db->prepare("SELECT COUNT(*) FROM projeler WHERE durum = ? AND kategori = ? AND dil = ?");
$ttsorgu->execute(array("1",$Sonuc['id'],$_SESSION['k_dil']));
$total = $ttsorgu->fetchColumn();
$limit= $limitayar['limit_sayfaprojeler'];
$page_count = ceil($total/$limit);
if($page > $page_count) $page = 1;
$show = $page * $limit - $limit;
$PROJESorgu = $db->prepare("SELECT * FROM projeler WHERE durum = ? AND kategori = ? AND dil = ? ORDER BY sira ASC LIMIT $show,$limit");
$PROJESorgu->execute(array("1",$Sonuc['id'],$_SESSION['k_dil']));
$PROJEislem = $PROJESorgu->fetchALL(PDO::FETCH_ASSOC);	
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['projekategoriurl']."/".$Sonuc['seo']."' OR link = '".$htc['projekategoriurl']."/".$Sonuc['seo']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
?>

<!-- ============================ Page Title Start================================== -->
			<div class="page-title">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							
							<h2 class="ipt-title"><?php echo ilkbuyuk($Sonuc['adi'])?></h2>
							<span class="ipn-subtitle"><?=@$dil['yaz255'];?></span>
							
						</div>
					</div>
				</div>
			</div>
			<!-- ============================ Page Title End ================================== -->
			
			<!-- ============================ Agency List Start ================================== -->
			<section>
			
				<div class="container">
				
					
				<?php if($PROJESorgu->rowCount()){?>
					<!-- row Start -->
					<div class="row">
					<?php foreach ( $PROJEislem as $PROJESonuc ){?>	
						<!-- Single blog Grid -->
						<div class="col-lg-<?php echo $limitayar['limit_projeler'];?> col-md-<?php echo $limitayar['limit_projeler'];?>">
							<div class="blog-wrap-grid">
								
								<div class="blog-thumb">
									<a href="<?php echo $htc['projedetayurl']; ?>/<?php echo $PROJESonuc['seo']; ?><?php echo $html;?>"><img style="height:200px; width:100%; object-fit: cover;" src="<?php echo tema;?>/uploads/projeler/kapak/<?php echo $PROJESonuc['kapak']; ?>" class="img-fluid" alt="<?php echo $PROJESonuc['adi']; ?>" /></a>
								</div>
								
								<!-- 
								<div class="blog-info">
									<span class="post-date"><i class="ti-calendar"></i><?php echo $PROJESonuc['tarih']; ?></span>
								</div>
								 -->
								<div class="blog-body">
									<h4 class="bl-title"><a href="<?php echo $htc['projedetayurl']; ?>/<?php echo $PROJESonuc['seo']; ?><?php echo $html;?>"><?php echo $PROJESonuc['adi']; ?></a></h4>
									<p><?php echo kisa(strip_tags($PROJESonuc['aciklama']),200); ?></p>
									<!-- <a href="<?php echo $htc['projedetayurl']; ?>/<?php echo $PROJESonuc['seo']; ?><?php echo $html;?>" class="bl-continue">Devamı</a> -->
								</div>
								
							</div>
						</div>
						<?php }?>
						
						
					</div>
					<!-- /row -->


				</br>
				<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
						<p class="text-center"><?php echo $total;?> <?=@$dil['txt102'];?>  <?php echo $page;?> - <?php echo $limitayar['limit_sayfaprojeler'];?> <?=@$dil['txt103'];?></p>
						<ul class="pagination p-center">
						<?php
						if($limitayar['limit_sayfaprojeler'] < $total && $limitayar['limit_sayfaprojeler'] > 0){
						$showing = 3;
						if($page > 1){?>
						<?php $previous = $page - 1;?>
								<li class="page-item">
									<a class="page-link" href="<?php echo $htc['hizmeturl'];?>/<?php echo $previous;?><?php echo $html;?>" aria-label="Previous">
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
								<li class="page-item"><a class="page-link" href="<?php echo $htc['hizmeturl'];?>/<?php echo $i; ?><?php echo $html;?>"><?php echo $i; ?></a></li>
								<?php }}}if($page != $page_count){?>
								<?php  $next = $page +1;?>
								<li class="page-item">
									<a class="page-link" href="<?php echo $htc['hizmeturl'];?>/<?php echo $next; ?><?php echo $html;?>" aria-label="Next">
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