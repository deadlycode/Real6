<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
if(!isset($_SESSION["site_email"])){
	header("Location:".$url.(altklasor == "1" ? '/' : '')."".$htc['girisyapurl']."".$html."");
}
?>
<script>
function emlak_sil(emlakID,emlakAdi){
	swal({
	  title: '<?=@$dil['yaz235'];?>',
	  text: '<?=@$dil['yaz236'];?>',
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  cancelButtonText: '<?=@$dil['yaz237'];?>', 
	  confirmButtonText: '<?=@$dil['yaz238'];?>'
	}).then((result) => {
	  if (result.value) {
		swal({
		  title: '<?=@$dil['yaz240'];?>',
		  text: '<?=@$dil['yaz239'];?>',
		  type: "success",
		  icon: 'success',
		  timer: 5000
		}).then(function() {
		  window.location.href = '_class/site_islem.php?emlaksil=ok&id='+emlakID+'&adi='+emlakAdi;
		});
	  }
	});
}	
</script>

			<!-- ============================ Page Title Start================================== -->
			<div class="page-title">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							
							<h2 class="ipt-title"><?=@$dil['yaz1'];?></h2>
							<span class="ipn-subtitle"><?=@$dil['yaz78'];?></span>
							
						</div>
					</div>
				</div>
			</div>
			<!-- ============================ Page Title End ================================== -->
			
			<!-- ============================ User Dashboard ================================== -->
			<section>
				<div class="container">
					<div class="row">
						
						<?php require_once("uye_menu.php");?>
						
						<div class="col-lg-9 col-md-8">
							<div class="dashboard-wraper">
							
								<!-- Bookmark Property -->
								<div class="form-submit">	
									<h4><?=@$dil['yaz105'];?></h4>
								</div>
								
								<div class="row">
								
								
								<?php $Sorgu = $db->prepare("SELECT * FROM emlaklar WHERE ekleyen = ? AND dil = ? and uye = ? ORDER BY sira ASC");
									$Sorgu->execute(array($_SESSION['site_uyeid'],$_SESSION['k_dil'],"1"));
									$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
									<?php foreach ( $islem as $Sliderkey => $Sonuc ){?>	
									<?php $kategori 	= $db->query("SELECT * FROM emlak_kategori WHERE id = '{$Sonuc['kategori']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
									<?php $ustkategori 	= $db->query("SELECT * FROM emlak_kategori WHERE ustid = '{$kategori['id']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
									<?php $il 	= $db->query("SELECT * FROM il WHERE id = '{$Sonuc['il']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
									<?php $ilce 	= $db->query("SELECT * FROM ilce WHERE id = '{$Sonuc['ilce']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
									<?php $semt 	= $db->query("SELECT * FROM semt WHERE id = '{$Sonuc['semt']}' ORDER BY id ASC LIMIT 1")->fetch(); ?>
									<!-- Single Property -->
									<div class="col-md-12 col-sm-12 col-md-12">
										<div class="singles-dashboard-list">
											<div class="sd-list-left">
												<img src="<?php echo tema;?>/uploads/emlaklar/kapak/<?php echo $Sonuc['kapak']?>" class="img-fluid" alt="<?php echo $Sonuc['adi']?>" />
											</div>
											<div class="sd-list-right">
												<h4 class="listing_dashboard_title"><a href="#" class="theme-cl"><?php echo $Sonuc['adi']?></a></h4>
												<div class="user_dashboard_listed">
													<b><?=@$dil['yaz206'];?> :</b> <?php echo $Sonuc['fiyat']?> <?php echo $Sonuc['pbirim']?>
												</div>
												<div class="user_dashboard_listed">
													<b><?=@$dil['yaz112'];?> :</b> <?php echo $ustkategori['adi']?> / <?php echo $kategori['adi']?>
												</div>
												<div class="user_dashboard_listed">
													<?=@$dil['yaz234'];?> : <?php echo $il['il_adi']?> / <?php echo $ilce['ilce_adi']?> / <?php echo $semt['semt_adi']?>
												</div>
												<div class="user_dashboard_listed">
													<i class="ti-eye"></i> <?php echo $Sonuc['hit']?>
												</div>
												<div class="user_dashboard_listed">
												 <?php echo($Sonuc['durum'] == '1' ? 'Aktif' : 'Pasif');?>
												</div>
												<div class="action">
																													
													<a href="ilan-ekle/<?php echo $Sonuc['id']?>" data-toggle="tooltip" data-placement="top" title="Düzenle"><i class="ti-pencil"></i></a>
													<a href="<?php echo $htc['ilandetayurl']?>/<?php echo $Sonuc['seo']?><?php echo $html?>" data-toggle="tooltip" data-placement="top" title="<?=@$dil['yaz241'];?>"><i class="ti-eye"></i></a>
													<a href="javascript:;" onclick="emlak_sil('<?php echo $Sonuc['id']?>','<?php echo $Sonuc['adi']?>')" title="<?=@$dil['yaz242'];?>" class="delete"><i class="ti-close"></i></a>													
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
			</section>
			<!-- ============================ User Dashboard End ================================== -->