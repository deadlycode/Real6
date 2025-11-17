<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php
if(strip_tags(isset($_GET['id'])))
{
	$Sorgu = $db->prepare("SELECT * FROM ekibimiz WHERE seo = ? AND durum = ? AND dil = ?");
	$Sorgu->execute(array($_GET['id'],1,$_SESSION['k_dil']));
	if($Sorgu->rowCount()){
		$Sonuc 		= $Sorgu->fetch(PDO::FETCH_ASSOC);
	}else{
		header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
		exit();
	}
}
else
{
	$Sorgu = $db->prepare("SELECT * FROM ekibimiz WHERE durum = ? AND dil = ? ORDER BY id ASC");
	$Sorgu->execute(array(1,$_SESSION['k_dil']));
	if($Sorgu->rowCount()){
		$Sonuc 		= $Sorgu->fetch(PDO::FETCH_ASSOC);
	}else{
		header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
		exit();
	}
}
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['ekiburl']."' OR link = '".$htc['ekiburl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);		
?>


<!-- ============================ Agency Name Start================================== -->
<div class="agent-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="agency agency-list shadow-0 mt-2 mb-2">

                    <a href="#" class="agency-avatar">
                        <img src="<?php echo tema;?>/uploads/ekibimiz/<?php echo $Sonuc['resim'];?>" alt="<?php echo ilkbuyuk($Sonuc['adi']);?>">
                    </a>

                    <div class="agency-content">
                        <div class="agency-name">
                            <h4><a href="agency-page.html"><?php echo ilkbuyuk($Sonuc['adi']);?></a></h4>
                            <span><i class="lni-map-marker"></i><?php echo ilkbuyuk($Sonuc['gorev']);?></span>
                        </div>

                        <div class="agency-desc">
                            <p><?php echo $Sonuc['aciklama'];?></p>
                        </div>

                        <ul class="agency-detail-info">
                            <?php if($Sonuc['telefon']){?><li><i class="lni-phone-handset"></i><?php echo $Sonuc['telefon'];?></li><?php }?>
                            <?php if($Sonuc['email']){?><li><i class="lni-envelope"></i><a href="#"><?php echo $Sonuc['email'];?></a></li><?php }?>
                        </ul>

                        <ul class="social-icons">
                           <?php if($Sonuc['facebook']){?><li><a class="facebook" href="<?php echo $Sonuc['facebook'];?>"><i class="lni-facebook"></i></a></li><?php }?>
                            <?php if($Sonuc['twitter']){?><li><a class="twitter" href="<?php echo $Sonuc['twitter'];?>"><i class="lni-twitter"></i></a></li><?php }?>
                            <?php if($Sonuc['instagram']){?><li><a class="instagram" href="<?php echo $Sonuc['instagram'];?>"><i class="lni-instagram"></i></a></li><?php }?>
                            <?php if($Sonuc['youtube']){?><li><a class="youtube" href="<?php echo $Sonuc['youtube'];?>"><i class="lni-youtube"></i></a></li><?php }?>
                            <?php if($Sonuc['linkedin']){?><li><a class="linkedin" href="<?php echo $Sonuc['linkedin'];?>"><i class="lni-linkedin"></i></a></li><?php }?>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================ Agency Name ================================== -->

<!-- ============================ About Agency ================================== -->
<!-- ============================ All Property ================================== -->
<section class="gray">

    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12 list-layout">
                <div class="row">

                    <div class="col-lg-12 col-md-12">
                        <div class="filter-fl">
                            <h4> <?=@$dil['yaz289'];?></h4>

                        </div>
                    </div>



					<?php $BSorgu = $db->prepare("SELECT * FROM emlaklar WHERE durum = ? AND dil = ? and danisman = ? ORDER BY sira ASC limit 20");
					$BSorgu->execute(array("1",$_SESSION['k_dil'],$Sonuc['id']));
					$islem = $BSorgu->fetchALL(PDO::FETCH_ASSOC);?>
					<?php foreach ( $islem as $Sliderkey => $BSonuc ){?>
					 <?php 
                        $ilanUrl = $htc['ilandetayurl'].'/'.$BSonuc['seo'].$html;
                        $ilanKategori = $db->query("SELECT * FROM emlak_kategori WHERE id='{$BSonuc['kategori']}' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                        $ilDetay = $db->query("SELECT * FROM il WHERE id='{$BSonuc['il']}' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                        $ilceDetay = $db->query("SELECT * FROM ilce WHERE id='{$BSonuc['ilce']}' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                        $semtDetay = $db->query("SELECT * FROM semt WHERE id='{$BSonuc['semt']}' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
						$danisman 	= $db->query("SELECT * FROM ekibimiz WHERE id = '{$BSonuc['danisman']}' ORDER BY id ASC LIMIT 1")->fetch();
                        ?>
                        <!-- Single Property Start -->
                        <div class="col-lg-12 col-md-12">
                            <div class="property-listing property-1 ekip">

                                <div class="listing-img-wrapper">
                                    <a href="<?=$ilanUrl;?>">
                                        <img src="<?php echo tema;?>/uploads/emlaklar/<?=$BSonuc['kapak'];?>" alt="" />
                                    </a>
                                    <span class="property-type"><?=$ilanKategori['adi'];?></span>
                                </div>

                                <div class="listing-content">

                                    <div class="listing-detail-wrapper">
                                        <div class="listing-short-detail">
                                            <h4 class="listing-name"><a href="<?=$ilanUrl;?>"><?=$BSonuc['adi'];?></a></h4>
                                            <span class="listing-location"><i class="ti-location-pin"></i>
                                            <?=$semtDetay['semt_adi'];?> <?=$ilceDetay['ilce_adi'];?> / <?=$ilDetay['il_adi'];?>
                                            </span>
                                        </div>
										<?php if($danisman['id']){?>
                                        <div class="list-author">
                                            <a href="<?php echo $htc['ekibdetayurl']; ?>/<?php echo $EKIPSonuc['seo']; ?><?php echo $html;?>"><img src="<?php echo tema;?>/uploads/ekibimiz/<?php echo $danisman['resim']?>" class="img-fluid img-circle avater-30" alt="<?php echo $danisman['adi']?>" title="<?php echo $danisman['adi']?>"></a>
                                        </div>
										<?php } ?>
                                    </div>

                                    <div class="listing-features-info">
                                        <ul>
                                            <li style="width:auto;flex:auto"><strong><?=@$dil['yaz20'];?>:</strong><?=$BSonuc['kdrumu'];?></li>
                                            <li style="width:auto;flex:auto"><strong><?=@$dil['yaz21'];?>:</strong><?=$BSonuc['takas'] ? $BSonuc['takas'] : '-';?></li>
                                            <li style="width:auto;flex:auto"><strong><?=@$dil['yaz22'];?>:</strong><?=$BSonuc['net'];?></li>
                                        </ul>
                                    </div>

                                    <div class="listing-footer-wrapper">
                                        <div class="listing-price">
                                            <h4 class="list-pr"><?=$BSonuc['fiyat'];?> <?=$BSonuc['pbirim'];?></h4>
                                        </div>
                                        <div class="listing-detail-btn">
                                            <a href="<?=$ilanUrl;?>" class="more-btn"><?=@$dil['yaz23'];?></a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- Single Property End -->
                    <?php } ?>


                </div>

                <!-- Pagination -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <ul class="pagination p-center">
                            <?php if($limitayar['limit_emlakkategori'] < $total && $limitayar['limit_emlakkategori'] > 0){
                                $showing = 3;
                                if($page > 1){?>
                                    <?php $previous = $page - 1;?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo $htc['emlakkategoriurl'];?>/<?=$categorySeo;?>?s=<?php echo $previous;?>" aria-label="Previous">
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
                                            <li class="page-item"><a class="page-link" href="<?php echo $htc['emlakkategoriurl'];?>/<?=$categorySeo;?>?s=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                        <?php }}}if($page != $page_count){?>
                                    <?php  $next = $page +1;?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo $htc['emlakkategoriurl'];?>/<?=$categorySeo;?>?s=<?php echo $next; ?>" aria-label="Next">
                                            <span class="ti-arrow-right"></span>
                                            <span class="sr-only"><?=@$dil['yaz24'];?></span>
                                        </a>
                                    </li>
                                <?php }} ?>
                        </ul>
                    </div>
                </div>

            </div>

        
        </div>
    </div>
</section>