<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
$page = @intval($_GET['s']);
if(!$page) $page = 1;
$ttsorgu = $db->prepare("SELECT COUNT(*) FROM banka_hesaplari WHERE durum = ?");
$ttsorgu->execute(array("1"));
$total = $ttsorgu->fetchColumn();
$limit= $limitayar['limit_sayfabhesaplari'];
$page_count = ceil($total/$limit);
if($page > $page_count) $page = 1;
$show = $page * $limit - $limit;
$BSorgu = $db->prepare("SELECT * FROM banka_hesaplari WHERE durum = ? ORDER BY sira ASC LIMIT $show,$limit");
$BSorgu->execute(array("1"));
$Bislem = $BSorgu->fetchALL(PDO::FETCH_ASSOC);
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['bankahesapurl']."' OR link = '".$htc['bankahesapurl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
?>
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h2 class="ipt-title"><?=@$dil['yaz64'];?></h2>
                <span class="ipn-subtitle"><?=@$dil['yaz65'];?></span>
            </div>
        </div>
    </div>
</div>

<section id="workers">
    <div class="container">
		<?php if($BSorgu->rowCount()){?>
        <div class="row">
			<?php foreach ( $Bislem as $BSonuc ){?>
			<div class="col-lg-<?php echo $limitayar['limit_bhesaplari'];?> col-md-<?php echo $limitayar['limit_bhesaplari'];?> col-12 workers-col">
				<div class="card card-active">
					<div class="row">
						<div class="col-md-3 col-3">
							<div style="display: table-cell;vertical-align: middle;height: 144px;padding: 10px;">
								<img style="width: 135px;" src="<?php echo tema;?>/uploads/bankalar/<?php echo $BSonuc['resim']; ?>" alt="<?php echo $BSonuc['banka']; ?>">
							</div>
						</div>
						<div class="col-md-9 col-9">
							<div class="blog-info text-left" style="display: table-cell;vertical-align: middle;height: 144px;">
								<p><?php echo $BSonuc['banka']; ?>, <?php echo $BSonuc['hesap']; ?>,<br> 
									<strong><?php echo $BSonuc['iban']; ?></strong><br>
									<?=@$dil['txt100'];?> <strong><?php echo $BSonuc['sube']; ?></strong><br>
									<?=@$dil['txt101'];?> <strong><?php echo $BSonuc['hnumara']; ?></strong></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php }?>
		</div>
		
		<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
						<p class="text-center"><?php echo $total;?> <?=@$dil['txt102'];?>  <?php echo $page;?> - <?php echo $limitayar['limit_sayfayorumlar'];?> <?=@$dil['txt103'];?></p>
						<ul class="pagination p-center">
						<?php
						if($limitayar['limit_sayfabhesaplari'] < $total && $limitayar['limit_sayfabhesaplari'] > 0){
						$showing = 3;
						if($page > 1){?>
						<?php $previous = $page - 1;?>
								<li class="page-item">
									<a class="page-link" href="<?php echo $htc['bankahesapurl'];?>/<?php echo $previous;?><?php echo $html;?>" aria-label="Previous">
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
								<li class="page-item"><a class="page-link" href="<?php echo $htc['bankahesapurl'];?>/<?php echo $i; ?><?php echo $html;?>"><?php echo $i; ?></a></li>
								<?php }}}if($page != $page_count){?>
								<?php  $next = $page +1;?>
								<li class="page-item">
									<a class="page-link" href="<?php echo $htc['bankahesapurl'];?>/<?php echo $next; ?><?php echo $html;?>" aria-label="Next">
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
