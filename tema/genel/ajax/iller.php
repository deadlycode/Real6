<?php
    require_once('../../../_class/baglan.php');
    require_once('../../../_class/fonksiyon.php');
		
	$id 	= $_POST['id'];
	$ilceid = $_POST['ilceid'];
	$dizi 	= array();
	$geridon= "<option value=''>-Seçiniz-</option>";
	$geridonb= "<option value=''>-Seçiniz-</option>";
	
	$query = $db->prepare("SELECT * FROM ilce WHERE il_id = ? ORDER BY ilce_adi ASC");
	$query->execute(array($id));
	$islem = $query->fetchALL(PDO::FETCH_ASSOC);
	foreach ( $islem as $ILCESonuc )
	{			
		$geridon .= '<option value="'. $ILCESonuc['id'].'" '.($ILCESonuc['id'] == $ilceid ? 'selected' : '').'>'.$ILCESonuc['ilce_adi'].'</option>';				
	}	
	if($geridon != "")
	{
		$dizi['basari']=$geridon;
	}
	else
	{
		$dizi['basari']=$geridonb;
	}
	
	echo json_encode($dizi);

?>