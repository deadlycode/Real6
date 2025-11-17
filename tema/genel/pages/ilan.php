<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php
if(strip_tags(isset($_GET['id'])))
{
	$Sorgu = $db->prepare("SELECT * FROM emlaklar WHERE seo = ? AND durum = ? AND dil = ?");
	$Sorgu->execute(array($_GET['id'],"1",$_SESSION['k_dil']));
	if($Sorgu->rowCount())
	{
		$Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
		$kategori =$db->query("SELECT * FROM emlak_kategori WHERE durum = '1' AND find_in_set('{$Sonuc['kategori']}',id) AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
	}
	else
	{
		header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
		exit();
	}
}
else
{
	$Sorgu = $db->prepare("SELECT * FROM emlaklar WHERE durum = ? AND dil = ? ORDER BY id ASC");
	$Sorgu->execute(array("1",$_SESSION['k_dil']));
	if($Sorgu->rowCount())
	{
		$Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
		$kategori =$db->query("SELECT * FROM emlak_kategori WHERE durum = '1' AND find_in_set('{$Sonuc['kategori']}',id) AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
	}
	else
	{
		header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
		exit();
	}
}
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['urunkategoriurl']."/".$kategori['seo'].".html' OR link = '".$htc['urunkategoriurl']."/".$kategori['seo'].".html' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$Bread = [];
function breadcrumb($id)
{
    global $db;
    global $Bread;
    $query = $db->query("SELECT * FROM emlak_kategori WHERE id = '{$id}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
    $Bread[$query['ustid']] = [
        'seo' => $query['seo'],
        'adi' => $query['adi'],
    ];
    if($query['ustid']!=0){
        breadcrumb($query['ustid']);
    }

    return $Bread;
}

$bc = breadcrumb($Sonuc['kategori']);
asort($bc);

$haberid = $Sonuc['id'];
if(!@$_COOKIE["hit".$haberid]){
    $hit = $db->prepare("UPDATE emlaklar SET emlak_hit = emlak_hit + 1 WHERE id = ?");
    $hit->execute(array($haberid));
    setcookie("hit".$haberid,"_",time()+60);
}
?>

<?php $il 	= $db->query("SELECT * FROM il WHERE id = '{$Sonuc['il']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
<?php $ilce 	= $db->query("SELECT * FROM ilce WHERE id = '{$Sonuc['ilce']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
<?php $semt 	= $db->query("SELECT * FROM semt WHERE id = '{$Sonuc['semt']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
<?php $danisman 	= $db->query("SELECT * FROM ekibimiz WHERE id = '{$Sonuc['danisman']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>

<!-- ============================ Page Title Start================================== -->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <h2 class="ipt-title"><?php echo $Sonuc['adi']; ?></h2>

                <?php foreach($bc as $b){?>
                <span class="prt-type rent"><a href="<?php echo $htc['emlakkategoriurl'];?>/<?php echo $b['seo'];?><?php echo $html;?>" style="color:white;"> <?php echo ilkbuyuk($b['adi']);?></a></span>
                <?php }?>

            </div>
        </div>
    </div>
</div>
<!-- ============================ Page Title End ================================== -->


<!-- ============================ Property Detail Start ================================== -->
<section>
    <div class="container">
        <div class="row">

            <!-- property main detail -->
            <div class="col-lg-8 col-md-12 col-sm-12">



                <div class="property3-slide single-advance-property mb-4">

                    <div class="slider-for">
                        <a href="<?php echo tema;?>/uploads/emlaklar/<?php echo $Sonuc['kapak']; ?>" class="item-slick"><img src="<?php echo tema;?>/uploads/emlaklar/<?php echo $Sonuc['kapak']; ?>" alt="<?php echo $Sonuc['adi']; ?>"></a>
                        <?php $ISorgu = $db->prepare("SELECT * FROM emlakresim WHERE pid = ? ORDER BY sira ASC");
							$ISorgu->execute(array($Sonuc['id']));
							$Iislem = $ISorgu->fetchALL(PDO::FETCH_ASSOC);?>
                        <?php foreach ( $Iislem as $Ikey => $ISonuc ){?>
                        <a href="<?php echo tema;?>/uploads/emlaklar/diger/<?php echo $ISonuc['resim']; ?>" class="item-slick"><img src="<?php echo tema;?>/uploads/emlaklar/diger/<?php echo $ISonuc['resim']; ?>" alt="<?php echo $Sonuc['adi']; ?>"></a>
                        <?php }?>

                    </div>
                    <div class="slider-nav" style="margin-top: 10px;">
                        <div class="item-slick"><img style="height: 85px;   width: 98%;    object-fit: cover;" src="<?php echo tema;?>/uploads/emlaklar/<?php echo $Sonuc['kapak']; ?>" alt="<?php echo $Sonuc['adi']; ?>" style="height:100px; width:100%;"></div>
                        <?php $ISorgu = $db->prepare("SELECT * FROM emlakresim WHERE pid = ? ORDER BY sira ASC");
							$ISorgu->execute(array($Sonuc['id']));
							$Iislem = $ISorgu->fetchALL(PDO::FETCH_ASSOC);?>
                        <?php foreach ( $Iislem as $Ikey => $ISonuc ){?>
                        <div class="item-slick"><img style="height: 85px;   width: 98%;    object-fit: cover;" src="<?php echo tema;?>/uploads/emlaklar/diger/<?php echo $ISonuc['resim']; ?>" alt="<?php echo $Sonuc['adi']; ?>" style="height:100px; width:100%;"></div>
                        <?php }?>
                    </div>

                </div>
				
				<div class="agent-widget d-block d-sm-none">
					<?php if($Sonuc['fiyat']){?><h2 class="fiyatrenk"><?php echo para_format($Sonuc['fiyat']); ?> <?php echo $Sonuc['pbirim']; ?></h2><?php }?>
					<span><i class="lni-map-marker"></i> <?php echo $il['il_adi']?> / <?php echo $ilce['ilce_adi']?><?php if($semt['semt_adi']){?> / <?php echo $semt['semt_adi']?><?php }?></span></br>



					<ul class="detaylist">
						<?php if($Sonuc['emlak_kodu']){?><li><strong><?=@$dil['yaz110'];?> :</strong><span style="color:red"><?php echo $Sonuc['emlak_kodu']; ?></span></li><?php }?>
						<?php if($Sonuc['tarih']){?><li><strong><?=@$dil['yaz111'];?> :</strong><span><?php echo tarih($Sonuc['tarih']); ?></span></li><?php }?>
						<?php if($Sonuc['brut']){?><li><strong><?=@$dil['yaz118'];?> :</strong><span><?php echo $Sonuc['brut']; ?></span></li><?php }?>
						<?php if($Sonuc['net']){?><li><strong><?=@$dil['yaz119'];?> :</strong><span><?php echo $Sonuc['net']; ?></span></li><?php }?>
						<?php if($Sonuc['oda']){?><li><strong><?=@$dil['yaz120'];?> :</strong><span><?php echo $Sonuc['oda']; ?></span></li><?php }?>
						<?php if($Sonuc['katsayisi']){?><li><strong><?=@$dil['yaz124'];?> :</strong><span><?php echo $Sonuc['katsayisi']; ?></span></li><?php }?>
						<?php if($Sonuc['bulundugukat']){?><li><strong><?=@$dil['yaz126'];?> :</strong><span><?php echo $Sonuc['bulundugukat']; ?></span></li><?php }?>
						<?php if($Sonuc['bina']){?><li><strong><?=@$dil['yaz136'];?> :</strong><span><?php echo $Sonuc['bina']; ?></span></li><?php }?>
						<?php if($Sonuc['isitma']){?><li><strong><?=@$dil['yaz138'];?> :</strong><span><?php echo $Sonuc['isitma']; ?></span></li><?php }?>
						<?php if($Sonuc['banyo']){?><li><strong><?=@$dil['yaz154'];?> :</strong><span><?php echo $Sonuc['banyo']; ?></span></li><?php }?>
						<?php if($Sonuc['balkon']){?><li><strong><?=@$dil['yaz155'];?> :</strong><span><?php echo $Sonuc['balkon']; ?></span></li><?php }?>
						<?php if($Sonuc['esya']){?><li><strong><?=@$dil['yaz158'];?> :</strong><span><?php echo $Sonuc['esya']; ?></span></li><?php }?>
						<?php if($Sonuc['kdrumu']){?><li><strong><?=@$dil['yaz161'];?> :</strong><span><?php echo $Sonuc['kdrumu']; ?></span></li><?php }?>
						<?php if($Sonuc['takas']){?><li><strong><?=@$dil['yaz165'];?> :</strong><span><?php echo $Sonuc['takas']; ?></span></li><?php }?>
						<?php if($Sonuc['krediu']){?><li><strong><?=@$dil['yaz168'];?> :</strong><span><?php echo $Sonuc['krediu']; ?></span></li><?php }?>
						<?php if($Sonuc['garama']){?><li><strong><?=@$dil['yaz169'];?> :</strong><span><?php echo $Sonuc['garama']; ?></span></li><?php }?>
						<?php if($Sonuc['imardurumu']){?><li><strong><?=@$dil['yaz170'];?> :</strong><span><?php echo $Sonuc['imardurumu']; ?></span></li><?php }?>
						<?php if($Sonuc['adano']){?><li><strong><?=@$dil['yaz195'];?> :</strong><span><?php echo $Sonuc['adano']; ?></span></li><?php }?>
						<?php if($Sonuc['parselno']){?><li><strong><?=@$dil['yaz196'];?> :</strong><span><?php echo $Sonuc['parselno']; ?></span></li><?php }?>
						<?php if($Sonuc['paftano']){?><li><strong><?=@$dil['yaz197'];?> :</strong><span><?php echo $Sonuc['paftano']; ?></span></li><?php }?>
						<?php if($Sonuc['kaks']){?><li><strong><?=@$dil['yaz198'];?> :</strong><span><?php echo $Sonuc['kaks']; ?></span></li><?php }?>
						<?php if($Sonuc['gabari']){?><li><strong><?=@$dil['yaz199'];?> :</strong><span><?php echo $Sonuc['gabari']; ?></span></li><?php }?>
						<?php if($Sonuc['tapudurumu']){?><li><strong><?=@$dil['yaz200'];?> :</strong><span><?php echo $Sonuc['tapudurumu']; ?></span></li><?php }?>
						<?php if($Sonuc['katkarsiligi']){?><li><strong><?=@$dil['yaz205'];?> :</strong><span><?php echo $Sonuc['katkarsiligi']; ?></span></li><?php }?>
						<?php if($Sonuc['fiyat']){?><li><strong><?=@$dil['yaz206'];?> :</strong><span><?php echo para_format($Sonuc['fiyat']); ?> <?php echo $Sonuc['pbirim']; ?></span></li><?php }?>
						<?php if($Sonuc['aidat']){?><li><strong><?=@$dil['yaz208'];?> :</strong><span><?php echo $Sonuc['aidat']; ?> <?php echo $Sonuc['pbirim']; ?></span></li><?php }?>
						<?php if($Sonuc['depozito']){?><li><strong><?=@$dil['yaz210'];?> :</strong><span><?php echo $Sonuc['depozito']; ?> <?php echo $Sonuc['pbirim']; ?></span></li><?php }?>
					</ul>
				</div>



                <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="custom-tab style-1">
                        <div class="butonarkaplan">
                            <ul class="nav nav-tabs pb-2 b-0" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" aria-expanded="true"><?=@$dil['yaz262'];?></a>
                                </li>
								<?php if($Sonuc['latfield']){?>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" aria-expanded="false"><?=@$dil['yaz263'];?></a>
                                </li>
								<?php } ?>
								<?php if($Sonuc['video']){?>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false" aria-expanded="false"><?=@$dil['yaz264'];?></a>
                                </li>
								<?php } ?>

                            </ul>
                        </div>
                        </br>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab" aria-expanded="true">
                                <!-- Single Block Wrap -->
                                <div class="block-wrap">

                                    <div class="block-body">
                                        <p><?php echo $Sonuc['aciklama']; ?></p>
										
										</br>
										<h3 style="font-size:20px; color: #2D3954; font-weight: 200;    text-transform: none; font-family: 'Poppins', sans-serif; text-align:center;"><?=@$dil['yaz265'];?> <strong style="font-weight:bold;"><?php echo $Sonuc['emlak_hit']; ?></strong> <?=@$dil['yaz266'];?></h3>
										
                                    </div>

                                </div>

                                <!-- Single Block Wrap -->
                                <div class="block-wrap">

                                    <?php 
                                    
                                    
                                    $dahiller = explode(",", $Sonuc['ozellik']);
                                    
                                    
                                    ?>
                                    <!-- Features -->
                                    <?php $OZKATSorgu = $db->prepare("SELECT * FROM ozellik_kategori ORDER BY id ASC");
									$OZKATSorgu->execute();
									$OZKATislem = $OZKATSorgu->fetchALL(PDO::FETCH_ASSOC);?>
                                    <?php foreach ( $OZKATislem as $OZKATSonuc ){?>
                                    <style>
                                        #ozblok<?=$OZKATSonuc['id'];?> {
                                            display:none;
                                        }
                                    </style>
                                    <div id="ozblok<?=$OZKATSonuc['id'];?>">
                                        <div class="block-header">
                                            <h4 class="block-title"><?php echo $OZKATSonuc['adi'];?></h4>
                                        </div>
    
                                        <div class="block-body">
                                            <ul class="avl-features third">
                                                <?php $OZELLIKSorgu = $db->prepare("SELECT * FROM ozellik WHERE kategori = ? ORDER BY id ASC");
    											$OZELLIKSorgu->execute(array($OZKATSonuc['id']));
    											$OZELLIKislem = $OZELLIKSorgu->fetchALL(PDO::FETCH_ASSOC);?>
                                                <?php foreach ( $OZELLIKislem as $OZELLIKSonuc ){
                                                    $katIDS = $OZKATSonuc['id'].'-';
                                                    foreach($dahiller as $dahilll){
                                                        if(strstr($dahilll,$katIDS)){
                                                           if(strstr($dahilll,$OZELLIKSonuc['id'])){?>
                                                           <style>
                                        #ozblok<?=$OZKATSonuc['id'];?> {
                                            display:block;
											    margin-bottom: 10px;
                                        }
                                    </style>
                                                           <li>
                                                                <?php echo $OZELLIKSonuc['adi'];?>
                                                            </li>
                                                            <?php 
                                                           }
                                                        }
                                                    }
    				                            }?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php }?>

                                </div>
                            </div>
							<?php if($Sonuc['latfield']){?>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="false">
                                <!-- Single Block Wrap -->
                                <div class="block-wrap">

                                    <div class="block-header">
                                        <h4 class="block-title"><?=@$dil['yaz267'];?></h4>
                                    </div>
                                    <script src="https://api-maps.yandex.ru/2.1/?lang=tr_TR&amp;load=package.full"></script>
                                    <div class="block-body">
                                        <div class="map-container">
                                            <script>
                                                ymaps.ready(init);

                                                function init() {
                                                    var myMap = new ymaps.Map('map', {
                                                            center: [<?php echo $Sonuc['latfield'];?>,<?php echo $Sonuc['lngfield']; ?>],
                                                            zoom: <?php echo $Sonuc['zoom'];?>
                                                        }),


                                                        myPlacemark1 = new ymaps.Placemark([<?php echo $Sonuc['latfield']; ?> , <?php echo $Sonuc['lngfield'];?> ], {
                                                            balloonContent: '<?php echo tirnak($Sonuc['adi']); ?>'}, {
                                                            iconLayout: 'default#image',
                                                            iconImageClipRect: [
                                                                [69, 0],
                                                                [97, 46]
                                                            ],
                                                            iconImageHref: '<?php echo tema;?>/assets/img/sprite.png',
                                                            iconImageSize: [35, 63],
                                                            iconImageOffset: [-35, -63]
                                                        });


                                                    myMap.geoObjects.add(myPlacemark1)

                                                }
                                            </script>
                                            <div id="map-container" class="homepage-map margin-bottom-0">
                                                <div id="map"></div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
							<?php }?>
							<?php if($Sonuc['video']){?>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab" aria-expanded="false">
                                <div class="block-wrap">
                                    <iframe width="100%" height="500" src="https://www.youtube.com/embed/<?php echo $Sonuc['video']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>
							<?php }?>
                        </div>
                    </div>
                </div>
                </div>
			</div>

            <!-- property Sidebar -->
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="page-sidebar">

                    <div class="agent-widget d-none d-sm-block">
                        <?php if($Sonuc['fiyat']){?><h2 class="fiyatrenk"><?php echo para_format($Sonuc['fiyat']); ?> <?php echo $Sonuc['pbirim']; ?></h2><?php }?>
                        <span><i class="lni-map-marker"></i> <?php echo $il['il_adi']?> / <?php echo $ilce['ilce_adi']?><?php if($semt['semt_adi']){?> / <?php echo $semt['semt_adi']?><?php }?></span></br>



                        <ul class="detaylist">
                            <?php if($Sonuc['emlak_kodu']){?><li><strong><?=@$dil['yaz110'];?> :</strong><span style="color:red"><?php echo $Sonuc['emlak_kodu']; ?></span></li><?php }?>
                            <?php if($Sonuc['tarih']){?><li><strong><?=@$dil['yaz111'];?> :</strong><span><?php echo tarih($Sonuc['tarih']); ?></span></li><?php }?>
                            <?php if($Sonuc['brut']){?><li><strong><?=@$dil['yaz118'];?> :</strong><span><?php echo $Sonuc['brut']; ?></span></li><?php }?>
                            <?php if($Sonuc['net']){?><li><strong><?=@$dil['yaz119'];?> :</strong><span><?php echo $Sonuc['net']; ?></span></li><?php }?>
                            <?php if($Sonuc['oda']){?><li><strong><?=@$dil['yaz120'];?> :</strong><span><?php echo $Sonuc['oda']; ?></span></li><?php }?>
                            <?php if($Sonuc['katsayisi']){?><li><strong><?=@$dil['yaz124'];?> :</strong><span><?php echo $Sonuc['katsayisi']; ?></span></li><?php }?>
                            <?php if($Sonuc['bulundugukat']){?><li><strong><?=@$dil['yaz126'];?> :</strong><span><?php echo $Sonuc['bulundugukat']; ?></span></li><?php }?>
                            <?php if($Sonuc['bina']){?><li><strong><?=@$dil['yaz136'];?> :</strong><span><?php echo $Sonuc['bina']; ?></span></li><?php }?>
                            <?php if($Sonuc['isitma']){?><li><strong><?=@$dil['yaz138'];?> :</strong><span><?php echo $Sonuc['isitma']; ?></span></li><?php }?>
                            <?php if($Sonuc['banyo']){?><li><strong><?=@$dil['yaz154'];?> :</strong><span><?php echo $Sonuc['banyo']; ?></span></li><?php }?>
                            <?php if($Sonuc['balkon']){?><li><strong><?=@$dil['yaz155'];?> :</strong><span><?php echo $Sonuc['balkon']; ?></span></li><?php }?>
                            <?php if($Sonuc['esya']){?><li><strong><?=@$dil['yaz158'];?> :</strong><span><?php echo $Sonuc['esya']; ?></span></li><?php }?>
                            <?php if($Sonuc['kdrumu']){?><li><strong><?=@$dil['yaz161'];?> :</strong><span><?php echo $Sonuc['kdrumu']; ?></span></li><?php }?>
                            <?php if($Sonuc['takas']){?><li><strong><?=@$dil['yaz165'];?> :</strong><span><?php echo $Sonuc['takas']; ?></span></li><?php }?>
                            <?php if($Sonuc['krediu']){?><li><strong><?=@$dil['yaz168'];?> :</strong><span><?php echo $Sonuc['krediu']; ?></span></li><?php }?>
                            <?php if($Sonuc['garama']){?><li><strong><?=@$dil['yaz169'];?> :</strong><span><?php echo $Sonuc['garama']; ?></span></li><?php }?>
                            <?php if($Sonuc['imardurumu']){?><li><strong><?=@$dil['yaz170'];?> :</strong><span><?php echo $Sonuc['imardurumu']; ?></span></li><?php }?>
                            <?php if($Sonuc['adano']){?><li><strong><?=@$dil['yaz195'];?> :</strong><span><?php echo $Sonuc['adano']; ?></span></li><?php }?>
                            <?php if($Sonuc['parselno']){?><li><strong><?=@$dil['yaz196'];?> :</strong><span><?php echo $Sonuc['parselno']; ?></span></li><?php }?>
                            <?php if($Sonuc['paftano']){?><li><strong><?=@$dil['yaz197'];?> :</strong><span><?php echo $Sonuc['paftano']; ?></span></li><?php }?>
                            <?php if($Sonuc['kaks']){?><li><strong><?=@$dil['yaz198'];?> :</strong><span><?php echo $Sonuc['kaks']; ?></span></li><?php }?>
                            <?php if($Sonuc['gabari']){?><li><strong><?=@$dil['yaz199'];?> :</strong><span><?php echo $Sonuc['gabari']; ?></span></li><?php }?>
                            <?php if($Sonuc['tapudurumu']){?><li><strong><?=@$dil['yaz200'];?> :</strong><span><?php echo $Sonuc['tapudurumu']; ?></span></li><?php }?>
                            <?php if($Sonuc['katkarsiligi']){?><li><strong><?=@$dil['yaz205'];?> :</strong><span><?php echo $Sonuc['katkarsiligi']; ?></span></li><?php }?>
                            <?php if($Sonuc['fiyat']){?><li><strong><?=@$dil['yaz206'];?> :</strong><span><?php echo para_format($Sonuc['fiyat']); ?> <?php echo $Sonuc['pbirim']; ?></span></li><?php }?>
                            <?php if($Sonuc['aidat']){?><li><strong><?=@$dil['yaz208'];?> :</strong><span><?php echo $Sonuc['aidat']; ?> <?php echo $Sonuc['pbirim']; ?></span></li><?php }?>
                            <?php if($Sonuc['depozito']){?><li><strong><?=@$dil['yaz210'];?> :</strong><span><?php echo $Sonuc['depozito']; ?> <?php echo $Sonuc['pbirim']; ?></span></li><?php }?>
                        </ul>
                    </div>


                    <!-- slide-property-sec -->
                    <div class="slide-property-sec mb-4" style="background-color: #fff; padding: 15px">
                        <div class="pr-all-info">

                           <div class="addthis_inline_share_toolbox_34zm"></div>

                        </div>
                    </div>
					<?php if($danisman['id']){?>
                    <!-- Agent Detail -->
                    <div class="agent-widget">
                        <form method="POST" id="danismana_ulas" onsubmit="return danismanMesaj()">
                            <input type="hidden" name="emlak_id" value="<?=$Sonuc['id'];?>">
                            <input type="hidden" name="danisman_id" value="<?=$danisman['id'];?>">
                            <input type="hidden" name="type" value="danismana_ulas">
                            <div class="agent-title">
                                <div class="agent-photo"><img src="<?php echo tema;?>/uploads/ekibimiz/<?php echo $danisman['resim']?>" alt=""></div>
                                <div class="agent-details">
                                    <h4><a href="<?php echo $htc['ekibdetayurl'];?>/<?php echo $danisman['seo']?><?php echo $html;?>"><?php echo $danisman['adi'];?></a></h4>
                                    <span><i class="lni-phone-handset"></i><a href="tel:<?php echo $danisman['telefon']?>"><?php echo $danisman['telefon']?></a></span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
    
                            <div class="form-group">
                                <input type="text" class="form-control" name="adsoyad" placeholder="<?=@$dil['yaz82'];?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="<?=@$dil['yaz83'];?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="telefon" placeholder="<?=@$dil['yaz85'];?>">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="mesaj" placeholder="<?=@$dil['yaz103'];?>"></textarea>
                            </div>
                            <button type="submit" class="btn btn-theme full-width"><?=@$dil['yaz246'];?></button>
                        </form>
                    </div>
					
					<?php } ?>



                    <div class="agent-widget" style="padding:15px;">
                        <!-- Featured Property -->
                        <div class="sidebar-widgets">

                            <h4><?=@$dil['yaz268'];?></h4>

                            <div class="sidebar_featured_property">



                                <?php $Sorgu = $db->prepare("SELECT * FROM emlaklar WHERE durum = ? AND dil = ?  and kategori = ? ORDER BY sira ASC limit 10");
									$Sorgu->execute(array("1",$_SESSION['k_dil'],$Sonuc['kategori']));
									$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
                                <?php foreach ( $islem as $Sliderkey => $ESonuc ){?>
                                <?php $akategori 	= $db->query("SELECT * FROM emlak_kategori WHERE id = '{$ESonuc['kategori']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
                                <?php $austkategori 	= $db->query("SELECT * FROM emlak_kategori WHERE ustid = '{$kategori['id']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
                                <?php $ail 	= $db->query("SELECT * FROM il WHERE id = '{$ESonuc['il']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
                                <?php $ailce 	= $db->query("SELECT * FROM ilce WHERE id = '{$ESonuc['ilce']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
                                <?php $asemt 	= $db->query("SELECT * FROM semt WHERE id = '{$ESonuc['semt']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>

                                <!-- List Sibar Property -->
                                <div class="sides_list_property">
                                    <div class="sides_list_property_thumb">
                                        <a href="<?php echo $htc['ilandetayurl']?>/<?php echo $ESonuc['seo']?><?php echo $html?>">
											<img src="<?php echo tema;?>/uploads/emlaklar/kapak/<?php echo $ESonuc['kapak']?>" class="img-fluid" alt="<?php echo $ESonuc['adi']?>">
										</a>
									</div>
                                    <div class="sides_list_property_detail">
                                        <h4><a href="<?php echo $htc['ilandetayurl']?>/<?php echo $ESonuc['seo']?><?php echo $html?>"><?php echo $ESonuc['adi']?></a></h4>
                                        <span><i class="ti-location-pin"></i><?php echo $ail['il_adi']?> / <?php echo $ailce['ilce_adi']?></span>
                                        <div class="lists_property_price">
                                            <div class="lists_property_types">
                                                <div class="property_types_vlix sale"><?php echo $akategori['adi']?></div>
                                            </div>
                                            <div class="lists_property_price_value">
                                                <h4 class="fiyatrenk"><?php echo para_format($ESonuc['fiyat'])?> <?php echo $ESonuc['pbirim']?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>



                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
<!-- ============================ Property Detail End ================================== -->
<script>
    function danismanMesaj(){
        var formData = $('#danismana_ulas').serialize();
        $.ajax({
			type: "post",
			url: "/<?=tema;?>/ajax/ajax.php",
			data: formData,
			success: function(data) {
			    var response = JSON.parse(data);
			    if(response.status == true){
			        alert(response.msg);
			    }
            }
		});
        return false;
    }
</script>