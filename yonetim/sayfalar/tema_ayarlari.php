<?php
echo !defined("GUVENLIK") ? exit : NULL;
oturumkontrol($url);

// Fetch all themes
$tema_sorgu = $db->prepare("SELECT * FROM tema_ayarlari ORDER BY id ASC");
$tema_sorgu->execute();
$temalar = $tema_sorgu->fetchAll(PDO::FETCH_ASSOC);

// Fetch current active theme
$aktif_tema = $db->query("SELECT * FROM ayarlar WHERE id = 1")->fetch(PDO::FETCH_ASSOC);
?>

<div class="page-header">
	<div class="page-title mt-0 mb-0">
		<h3>Tema Ayarları</h3>
		<div class="crumbs">
			<ul id="breadcrumbs" class="breadcrumb">
				<li><a href="./"><i class="icon-home menu-icon"></i></a></li>
				<li><a href="<?php echo $sayfalink;?>">Site Yönetimi</a></li>
				<li class="active"><a href="<?php echo $sayfalink;?>">Tema Ayarları</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Mevcut Temalar</h4>
				<p class="card-description">Aşağıdaki temalardan birini seçerek sitenizin görünümünü değiştirebilirsiniz.</p>
				
				<div class="row">
					<?php foreach($temalar as $tema){ ?>
					<div class="col-md-4 mb-4">
						<div class="card <?php echo ($aktif_tema['site_tema'] == $tema['tema_klasor']) ? 'border-success' : ''; ?>">
							<div class="card-body">
								<h5 class="card-title">
									<?php echo $tema['tema_adi']; ?>
									<?php if($aktif_tema['site_tema'] == $tema['tema_klasor']){ ?>
										<span class="badge badge-success float-right">Aktif</span>
									<?php } ?>
								</h5>
								<p class="card-text"><?php echo $tema['aciklama']; ?></p>
								
								<?php if($tema['onizleme_resim']){ ?>
								<div class="mb-3">
									<img src="../tema/<?php echo $tema['tema_klasor'];?>/<?php echo $tema['onizleme_resim'];?>" 
									     class="img-fluid" alt="<?php echo $tema['tema_adi'];?>" style="max-height: 200px; width: 100%; object-fit: cover;">
								</div>
								<?php } ?>
								
								<form method="post" action="../_class/yonetim_islem.php">
									<input type="hidden" name="tema_id" value="<?php echo $tema['id'];?>">
									<input type="hidden" name="tema_klasor" value="<?php echo $tema['tema_klasor'];?>">
									
									<?php if($aktif_tema['site_tema'] != $tema['tema_klasor']){ ?>
									<button type="submit" name="tema_aktif_et" class="btn btn-primary btn-sm">
										<i class="icon-check"></i> Temayı Aktif Et
									</button>
									<?php } ?>
									
									<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#temaAyarModal<?php echo $tema['id'];?>">
										<i class="icon-settings"></i> Renk Ayarları
									</button>
								</form>
							</div>
						</div>
					</div>
					
					<!-- Tema Renk Ayarları Modal -->
					<div class="modal fade" id="temaAyarModal<?php echo $tema['id'];?>" tabindex="-1" role="dialog">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title"><?php echo $tema['tema_adi'];?> - Renk Ayarları</h5>
									<button type="button" class="close" data-dismiss="modal">
										<span>&times;</span>
									</button>
								</div>
								<form method="post" action="../_class/yonetim_islem.php">
									<div class="modal-body">
										<input type="hidden" name="tema_id" value="<?php echo $tema['id'];?>">
										
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Ana Renk (Renk 1)</label>
													<input type="text" name="renk1" class="color-picker form-control" 
													       value="<?php echo $tema['renk1'];?>" />
													<small class="form-text text-muted">Genel tema rengi</small>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>İkincil Renk (Renk 2)</label>
													<input type="text" name="renk2" class="color-picker form-control" 
													       value="<?php echo $tema['renk2'];?>" />
													<small class="form-text text-muted">Vurgu rengi</small>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Footer Rengi (Renk 3)</label>
													<input type="text" name="renk3" class="color-picker form-control" 
													       value="<?php echo $tema['renk3'];?>" />
													<small class="form-text text-muted">Footer arka plan rengi</small>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Ekstra Renk (Renk 4)</label>
													<input type="text" name="renk4" class="color-picker form-control" 
													       value="<?php echo $tema['renk4'];?>" />
													<small class="form-text text-muted">Ek renk seçeneği</small>
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<label>Buton Rengi</label>
											<input type="text" name="buton_renk" class="color-picker form-control" 
											       value="<?php echo $tema['buton_renk'];?>" />
										</div>
										
										<div class="form-group">
											<label>Link Rengi</label>
											<input type="text" name="link_renk" class="color-picker form-control" 
											       value="<?php echo $tema['link_renk'];?>" />
										</div>
										
										<div class="form-group">
											<label>Başlık Rengi</label>
											<input type="text" name="baslik_renk" class="color-picker form-control" 
											       value="<?php echo $tema['baslik_renk'];?>" />
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
										<button type="submit" name="tema_renk_guncelle" class="btn btn-primary">
											<i class="mdi mdi-content-save"></i> Kaydet
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
				
				<hr class="my-4">
				
				<div class="alert alert-info">
					<strong>Bilgi:</strong> Tema değişikliği yaptıktan sonra sitenizin önbelleğini temizlemeniz önerilir.
				</div>
			</div>
		</div>
	</div>
</div>

<?php
mesaj("tema_aktif_et", 1, "yes", "Tema başarıyla aktif edildi.");
mesaj("tema_aktif_et", 2, "no", "Tema aktif edilirken hata oluştu!");
mesaj("tema_renk_guncelle", 1, "yes", "Renk ayarları başarıyla güncellendi.");
mesaj("tema_renk_guncelle", 2, "no", "Renk ayarları güncellenirken hata oluştu!");
?>

<script>
$(document).ready(function(){
	// Color picker initialization
	$('.color-picker').spectrum({
		type: "color",
		showInput: true,
		showInitial: true,
		showAlpha: false,
		showButtons: true,
		preferredFormat: "hex"
	});
});
</script>
