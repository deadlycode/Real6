<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php
if(strip_tags(isset($_GET['id'])))
{
	$Sorgu = $db->prepare("SELECT * FROM referanslar WHERE seo = ? AND durum = ? AND dil = ?");
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
	$Sorgu = $db->prepare("SELECT * FROM referanslar WHERE durum = ? AND dil = ? ORDER BY id ASC");
	$Sorgu->execute(array(1,$_SESSION['k_dil']));
	if($Sorgu->rowCount()){
		$Sonuc 		= $Sorgu->fetch(PDO::FETCH_ASSOC);
	}else{
		header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
		exit();
	}
}
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['sayfaurl']."/".$Sonuc['seo']."' OR link = '".$htc['sayfaurl']."/".$Sonuc['seo']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);		
?>


<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h2 class="ipt-title"><?php echo $Sonuc['adi'];?></h2>
                <span class="ipn-subtitle"><?=@$dil['yaz256'];?></span>
            </div>
        </div>
    </div>
</div>

<!-- ============================ Agency List Start ================================== -->
<section>
    <div class="container">
        <!-- row Start -->
        <div class="row">
            <!-- Blog Detail -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="blog-details single-post-item format-standard">
                    <div class="post-details">
						<?php if ($Sonuc['resim']!='') {?>
                        <div class="post-featured-img center">
                            <img class="img-fluid" src="<?php echo tema;?>/uploads/referanslar/<?php echo $Sonuc['resim'];?>" alt="<?php echo $Sonuc['adi'];?>" >
                        </div>    
						<?php } ?>		
                       
                       <p><?php echo $Sonuc['aciklama'];?></p>            
                  </div>
                </div>
           </div>
         </div>
		 
		 
        <!-- /row -->
    </div>
</section>
<!-- ============================ Agency List End ================================== -->