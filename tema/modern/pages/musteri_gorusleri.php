<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
$page = @intval($_GET['s']);
if(!$page) $page = 1;
$ttsorgu = $db->prepare("SELECT COUNT(*) FROM musteri_gorusleri WHERE durum = ?");
$ttsorgu->execute(array("1"));
$total = $ttsorgu->fetchColumn();
$limit= $limitayar['limit_sayfayorumlar'];
$page_count = ceil($total/$limit);
if($page > $page_count) $page = 1;
$show = $page * $limit - $limit;
$BSorgu = $db->prepare("SELECT * FROM musteri_gorusleri WHERE durum = ? ORDER BY id DESC LIMIT $show,$limit");
$BSorgu->execute(array("1"));
$Bislem = $BSorgu->fetchALL(PDO::FETCH_ASSOC);
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['musteriurl']."' OR link = '".$htc['musteriurl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);	
?>
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h2 class="ipt-title"><?=@$dil['yaz249'];?></h2>
                <span class="ipn-subtitle"><?=@$dil['yaz65'];?></span>
            </div>
        </div>
    </div>
</div>

<section class="testimonial-area">
    <img src="<?php echo tema;?>/assets/img/unnamed.png" alt="<?php echo firma_adi;?>" class="random-img">
    <img src="<?php echo tema;?>/assets/img/unnamed.png" alt="<?php echo firma_adi;?>" class="random-img">
    <img src="<?php echo tema;?>/assets/img/unnamed.png" alt="<?php echo firma_adi;?>" class="random-img">
    <img src="<?php echo tema;?>/assets/img/unnamed.png" alt="<?php echo firma_adi;?>" class="random-img">
    <img src="<?php echo tema;?>/assets/img/unnamed.png" alt="<?php echo firma_adi;?>" class="random-img">
    <img src="<?php echo tema;?>/assets/img/unnamed.png" alt="<?php echo firma_adi;?>" class="random-img">
    <img src="<?php echo tema;?>/assets/img/unnamed.png" alt="<?php echo firma_adi;?>" class="random-img">
    <img src="<?php echo tema;?>/assets/img/unnamed.png" alt="<?php echo firma_adi;?>" class="random-img">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sec-heading text-right mb-4">
                    <a href="" data-toggle="modal" data-target="#yorum" style="    background: rgba(25,189,88,0.1);    color: #19bd58;    border: none;    border-radius: 2px;    padding: 4px 12px;    cursor: pointer;    outline: none;    display: table;    margin: 5px auto 0;"><?=@$dil['yaz250'];?></a>
                </div>
            </div>
        </div>
		<?php if($BSorgu->rowCount()){?>
        <div class="row">
			<?php foreach ( $Bislem as $BSonuc ){?>
			<div class="col-lg-6">
				<div class="testimonial-item mb-3">
					<div class="testi-desc-box">
						<p class="testi__desc">
							<?php echo $BSonuc['yorum']; ?>
						</p>
					</div>
					<div class="testi-author-box d-flex align-items-center">
						<div class="author-avatar">
							<img src="<?php echo tema;?>/assets/img/unnamed.png" alt="<?php echo $BSonuc['isim']; ?>">
						</div>
						<div class="author-details">
							<h4 class="author__title"><?php echo $BSonuc['isim']; ?></h4>
							<span class="author__meta"><?php echo $BSonuc['meslek']; ?></span>
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
						if($limitayar['limit_sayfayorumlar'] < $total && $limitayar['limit_sayfayorumlar'] > 0){
						$showing = 3;
						if($page > 1){?>
						<?php $previous = $page - 1;?>
								<li class="page-item">
									<a class="page-link" href="<?php echo $htc['musteriurl'];?>/<?php echo $previous;?><?php echo $html;?>" aria-label="Previous">
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
								<li class="page-item"><a class="page-link" href="<?php echo $htc['musteriurl'];?>/<?php echo $i; ?><?php echo $html;?>"><?php echo $i; ?></a></li>
								<?php }}}if($page != $page_count){?>
								<?php  $next = $page +1;?>
								<li class="page-item">
									<a class="page-link" href="<?php echo $htc['musteriurl'];?>/<?php echo $next; ?><?php echo $html;?>" aria-label="Next">
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


 <!-- Sign Up Modal -->
        <div class="modal fade signup" id="yorum" tabindex="-1" role="dialog" aria-labelledby="yorum" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                <div class="modal-content" id="yorum">
                    <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                    <div class="modal-body">
                        <h4 class="modal-header-title kucuk"><?=@$dil['yaz250'];?></h4>
                        <div class="login-form">
                             <form action="_class/site_islem.php" class="form-column yorum-form" method="post" autocomplete="off">
								<div class="inner-column mt-0 rounded-0">								
									<!--Default Form-->
									<div class="default-form">
										<div class="row clearfix">

											<div class="form-group col-md-12 col-sm-12 col-xs-12">
												<input type="text" name="isim" class="form-control" placeholder="<?=@$dil['yaz82'];?>" required="">
											</div>

											<div class="form-group col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="meslek" class="form-control" placeholder="<?=@$dil['yaz251'];?>">
											</div>

											<div class="form-group col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="sehir" class="form-control" placeholder="<?=@$dil['yaz252'];?>">
											</div>

											<div class="form-group col-md-12 col-sm-12 col-xs-12">
												<textarea name="yorum" class="form-control" placeholder="<?=@$dil['yaz253'];?>" required=""></textarea>
											</div>
											
											<div class="form-group col-md-12 col-sm-12 col-xs-12" style="z-index:999;">
												<div class="form-group">
												   <div class="g-recaptcha" data-sitekey="<?php echo $ayar['rcaptha'];?>"></div>
												</div>
											</div>

											<div class="form-group text-center btn-column col-md-3 col-sm-3 col-xs-3">
												<input type="hidden" name="kontrol" value="" id="kontrol">	
												<input type="hidden" name="yorumurl" value="<?php echo $sayfalink;?>" />
												<button type="submit" name="yorumbtn" class="btn btn-md full-width pop-login"><?=@$dil['yaz254'];?> <i class="fa fa-angle-right btn-icon"></i></button>
											</div>

										</div>
									</div>

								</div>
							</form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->


