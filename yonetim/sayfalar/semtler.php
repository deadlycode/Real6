<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
$sorgu = $db->prepare("SELECT * FROM ilce WHERE id = ?");
$sorgu->execute(array($_GET['id']));
if($sorgu->rowCount()){
	$Sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);
	$il = $db->query("SELECT * FROM il WHERE id = '{$Sonuc['il_id']}'")->fetch(PDO::FETCH_ASSOC);
}
else
{
	echo '<meta http-equiv="refresh" content="0; url=404'.$html.'">';
}
?>
<?php oturumkontrol($url);?>
<div class="page-header">
	<div class="page-title mt-0 mb-0">
		<h3><?php echo $Sonuc['ilce_adi'];?> Semtleri</h3>
		<div class="crumbs">
			<ul id="breadcrumbs" class="breadcrumb">
				<li><a href="./"><i class="icon-home menu-icon"></i></a></li>
				<li><a href="iller<?php echo $html;?>">İl / İlçe / Semt</a></li>
				<li class="active"><a href="il/<?php echo $il['id'];?><?php echo $html;?>"><?php echo $il['il_adi'];?> İlçeleri</a></li>
				<li class="active"><a href="<?php echo $sayfalink;?>"><?php echo $Sonuc['ilce_adi'];?> Semtleri</a></li>
			</ul>
		</div>
	</div>
</div> 
<div class="card">
	<form action="../_class/il_ilce_semt.php" method="POST">
	<input type="hidden" value="<?php echo $Sonuc['id'];?>" name="ilce_id">
	<div class="card-body">
		<div class="row mb-3">
			<div class="col-lg-12">
				<div class="btn-toolbar" role="toolbar">
					<a href="" data-toggle="modal" data-target="#semt-ekle-<?php echo $Sonuc['id'];?>" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-sm mr-1">
						<i class="icon-plus font-12"></i> Yeni <?php echo $Sonuc['ilce_adi'];?> Semt Ekle
					</a>
					<div class="dropdown mr-1">
						<button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="icon-options-vertical font-12"></i> Seçilenlere Uygula
						</button>
						<div class="dropdown-menu p-0 min-width-full" aria-labelledby="dropdownMenuSizeButton3">
							<button class="dropdown-item p-2 cursor-pointer" type="submit" name="semt_tumu"><i class="icon-trash"></i> Seçilenleri Sil</button>
						</div>
					</div>
					<a href="../_class/il_ilce_semt.php?semttumunusil=ok&ilce_id=<?php echo $Sonuc['id']?>" title="Tüm Veriyi Sil" class="btn btn-danger btn-sm mr-1 popconfirm">
						<i class="ti-trash font-12"></i> Tüm Veriyi Sil
					</a>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-12">
				<div class="table-responsive">
					<table id="order-listingg" class="table table-bordered table-hover">
						<thead class="headbg">
							<tr>
								<th class="noshort" style="width:20px;" data-toggle="tooltip" data-placement="top" title="Tümünü Seç">
									<input id="checkbox-4" class="select-all checkbox-custom" type="checkbox" style="width:100px;">
									<label for="checkbox-4" class="checkbox-custom-label mb-0"><span class="checktext"></span></label>
								</th>
								<th style="width:30px;">ID</th>
								<th>Semt Adı</th>
								<th style="width:210px;">İşlem</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>

<!-- Yeni iLçe Ekle !-->
<div class="modal fade" id="semt-ekle-<?php echo $Sonuc['id'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header p-2 pl-2">
				<h5 class="modal-title" id="ModalLabel"><?php echo $Sonuc['ilce_adi'];?> Semti Ekle</h5>
			</div>
			<form role="form" action="../_class/il_ilce_semt.php" method="POST">
			<div class="modal-body text-left">
				<div class="form-group row mb-1">
					<label class="col-md-3 col-form-label text-right pt-2">Semt Adı</label>
					<div class="col-md-9">
						<input type="text" class="form-control form-control-sm" name="semt_adi">
					</div>
				</div>	
				<div class="form-group row mb-1">
					<label class="col-md-3 col-form-label text-right pt-2">Posta Kodu</label>
					<div class="col-md-9">
						<input type="text" class="form-control form-control-sm" name="posta_kodu">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" class="form-control form-control-sm" value="<?php echo $Sonuc['il_id'];?>" name="il_id">
				<input type="hidden" class="form-control form-control-sm" value="<?php echo $Sonuc['id'];?>" name="ilce_id">
				<button type="submit" name="semt_ekle" class="btn btn-primary btn-icon-text p-2"><i class="fa fa-check"></i> Kaydet</button>
				<button type="button" data-dismiss="modal" class="btn btn-outline-default btn-icon-text p-2"><i class="fa fa-times" aria-hidden="true"></i> Kapat</button>
			</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		var dataTable=$('#order-listingg').DataTable({
			"processing": true,
			"serverSide":true,
			"ajax":{
				url:"data/semtler.php?id=<?php echo $Sonuc['id'];?>",
				type:"post"
			},
			"order": [[ 2, "asc" ]],
			"aLengthMenu": [
				[5, 10, 15, 99999],
				[5, 10, 15, "Tümü"]
			],
			"columnDefs": [
				{ "orderable": false, "targets": [0, 3] },
				{ "targets": [ 1 ],"visible": false },
				{  "className": "secili", targets: [2] },
				{  "className": "text-center", targets: [3] }
			],
			"iDisplayLength": 10,
			"language": {
				"url":"js/Turkish.json"
			},
			"fnCreatedRow": function( nRow, aData, iDataIndex ) {
				$(nRow).attr('id', 'item-'+aData[1]);
			},
			"fnDrawCallback": function( oSettings ) {
				$(".popconfirm").popConfirm();
				$('.multi-select').multiSelect({});
		    }
		});
		$('#order-listingg').on('click', 'tbody tr td.secili', function(event) {	
			$(this).closest("tr").find("td:eq(0)").find("input[type=checkbox]").trigger('click');
			if($(this).closest("tr").find("input[type=checkbox]").prop("checked")){
				$(this).closest("tr").addClass('highlight');
			}else{
				$(this).closest("tr").removeClass('highlight');
			}
		});
		$(".select-all").click(function () {
			$("input:checkbox").not(this).prop('checked', this.checked);

			if(this.checked){
				$("input:checkbox").not(this).closest("tr").addClass('highlight');
			}else{
				$("input:checkbox").not(this).closest("tr").removeClass('highlight');
			}			
		});
		$('.multi-select').multiSelect({});
	});
</script>
<?php 
mesaj("semt_ekle",1,"yes","Başarı ile eklenmiştir.");
mesaj("semt_ekle",2,"no","Hata oluştu tekrar deneyiniz.!");
mesaj("semt_guncelle",1,"yes","Başarı ile guncellenmiştir.");
mesaj("semt_guncelle",2,"no","Hata oluştu tekrar deneyiniz.!");
mesaj("semtsil",1,"yes","Başarı ile silinmiştir.");
mesaj("semtsil",2,"no","Hata oluştu tekrar deneyiniz.!");
mesaj("semt_tumu",1,"yes","Seçilen kayıtlar başarıyla silinmiştir.");
mesaj("semt_tumu",2,"no","Hata oluştu tekrar deneyiniz.!");
mesaj("semttumunusil",1,"yes","Tüm kayıtlar başarıyla silinmiştir.");
mesaj("semttumunusil",2,"no","Hata oluştu tekrar deneyiniz.!");
mesaj("secim",3,"secimyok","Hiç bir şey seçmediniz. Lütfen işlem yapmak istediğiniz eylemi ve ID leri seçin.");
?>