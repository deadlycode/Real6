<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
$Sorgu = $db->prepare("SELECT * FROM sorular WHERE durum = ? AND dil = ? ORDER BY sira ASC");
$Sorgu->execute(array("1",$_SESSION['k_dil']));
$activeblock = 1;
$active = 1;
$current = 1;
$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['sssurl']."' OR link = '".$htc['sssurl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
?>
<!-- ================= Our Mission ================= -->
<section>
    <div class="container">

        <div class="row">

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="contact-box">
                    <i class="ti-home theme-cl"></i>
                    <h4><?=@$dil['yaz88'];?></h4>
                    <p><?php echo adres;?></p>                    
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="contact-box">
                    <i class="ti-email theme-cl"></i>
                    <h4><?=@$dil['yaz49'];?></h4>
                    <p><?php echo email;?></p>                   
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="contact-box">
                    <i class="ti-mobile theme-cl"></i>
                    <h4><?=@$dil['yaz50'];?></h4>
                    <span><?php echo telefon;?></span>
                    
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12">

                
                <div class="tab-content" id="myTabContent">

                    <!-- general Query -->
                    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">

                        <div class="accordion" id="generalac">
							<?php foreach ( $islem as $skey => $Sonuc ){?>	
                            <div class="card">						
                                <div class="card-header" id="headingOne<?php echo $Sonuc['id'];?>">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne<?php echo $Sonuc['id'];?>" aria-expanded="true" aria-controls="collapseOne<?php echo $Sonuc['id'];?>">
                                             <?php echo $Sonuc['adi'];?>
                                        </button>
                                    </h2>
                                </div>
							
                                <div id="collapseOne<?php echo $Sonuc['id'];?>" class="collapse <?php echo($skey == 0 ? 'show' : '')?>" aria-labelledby="headingOne<?php echo $Sonuc['id'];?>" data-parent="#generalac">
                                    <div class="card-body">
                                        <p class="ac-para"> <?php echo $Sonuc['aciklama'];?></p>
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
</section>
<!-- ================= Our Mission ================= -->