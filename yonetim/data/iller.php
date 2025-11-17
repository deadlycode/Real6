<?php 
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{ 	
	require_once('../../_class/baglan.php');
	require_once('../../_class/fonksiyon.php');
	
	$request=$_REQUEST;
	$col =array(
		0   =>  'id',
		1   =>  'id',
		2   =>  'il_adi',
		3   =>  'islem'
	);
	
	$sql ="SELECT * FROM il";
	$totalFilter = $db->query($sql)->rowCount();
	
	//Search
	$sql ="SELECT * FROM il WHERE 1=1";
	if(!empty($request['search']['value'])){
		$sql.=" AND (id LIKE '".$request['search']['value']."%' ";
		$sql.=" OR il_adi LIKE '".$request['search']['value']."%' ";
		$sql.=" OR slug LIKE '".$request['search']['value']."%' )";
	}
	$totalData = $db->query($sql)->rowCount();
	
	//Order
	$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".$request['start']."  ,".$request['length']."  ";
	$query 	= $db->prepare($sql);
	$query->execute();
	$islem 	= $query->fetchALL(PDO::FETCH_ASSOC);
	$data	= array();
	$say 	= $request['start']+1;
	foreach($islem as $row) 
	{
		$subdata=array();
		$subdata[]='<div class="form-check mb-0 mt-0"><label class="form-check-label"><input type="checkbox" name="id[]" value="'.$row['id'].'" class="form-check-input checkbox"><i class="input-helper"></i></label></div>';
		$subdata[]=$row['id'];
		$subdata[]='<a href="il/'.$row['id'].''.$html.'"  class="renk_baslik" title="İlçeleri Göster">'.$row['il_adi'].'</a>';
		$subdata[]='<a href="il/'.$row['id'].''.$html.'" class="btn btn-inverse-info btn-sm"><i class="fa fa-eye" title="Düzenle"></i> İlçeleri Göster</a>
					<a href="" data-toggle="modal" data-target="#il-'.$row['id'].'" data-id="'.$row['id'].'" data-backdrop="static" data-keyboard="false" class="btn btn-inverse-primary btn-sm"><i class="ti-pencil-alt" title="Düzenle"></i></a>
					<a href="../_class/il_ilce_semt.php?ilsil=ok&id='.$row["id"].'" class="btn btn-inverse-danger btn-sm popconfirm" data-original-title="" title="Sil"><i class="ti-trash"></i></a>
					<div class="modal fade" id="il-'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document" style="transform: translate(0, 0%);">
							<div class="modal-content">
								<div class="modal-header p-2 pl-2">
									<h5 class="modal-title" id="ModalLabel">İl Düzenle</h5>
								</div>
								<form role="form" action="../_class/il_ilce_semt.php" method="POST">
								<div class="modal-body text-left">	
									<div class="form-group row mb-1">
										<label class="col-md-3 col-form-label text-right pt-2">İl Adı</label>
										<div class="col-md-9">
											<input type="text" class="form-control form-control-sm" name="il_adi" value="'.$row['il_adi'].'">
										</div>
									</div>	
								</div>
								<div class="modal-footer">
									<input type="hidden" name="id" value="'.$row['id'].'" />
									<button type="submit" name="il_guncelle" class="btn btn-success btn-icon-text p-2"><i class="fa fa-check"></i> Güncelle</button>
									<a href="../_class/il_ilce_semt.php?ilsil=ok&id='.$row["id"].'" class="btn btn-danger btn-icon-text p-2 popconfirm" title="Sil"><i class="ti-trash"></i> Sil</a>
									<button type="button" data-dismiss="modal" class="btn btn-outline-default btn-icon-text p-2"><i class="fa fa-times" aria-hidden="true"></i> Kapat</button>
								</div>
								</form>
							</div>
						</div>
					</div>';
		$data[]=$subdata;
	}
	$json_data=array(
		"draw"              	=>  intval($request['draw']),
		"recordsTotal"      	=>  intval($totalData),
		"recordsFiltered"   	=>  intval($totalFilter),
		"data"              	=>  $data
	);
	echo json_encode($json_data);
}
else
{
	die("Erişim engellendi");
}
?>
