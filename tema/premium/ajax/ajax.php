<?php
    require_once('../../../_class/baglan.php');
    require_once('../../../_class/fonksiyon.php');
		
	if(isset($_POST['type'])){
	    $type = $_POST['type'];
	    switch($type){
	        case 'emlakResimSirala':
	            $resimID = $_POST['resim_id'];
	            $sira = $_POST['sira'];
	            $guncelle = $db->query("UPDATE `emlakresim` SET `sira`='{$sira}' WHERE id='{$resimID}'");
                break;
            case 'danismana_ulas':
                $tarih = date('d.m.Y');
                $emlakID = $_POST['emlak_id'];
                $danismanID = $_POST['danisman_id'];
                $adsoyad = $_POST['adsoyad'];
                $email = $_POST['email'];
                $telefon = $_POST['telefon'];
                $mesaj = $_POST['mesaj'];
                
                $ekle = $db->prepare("INSERT INTO `emlak_mesajlar`(`emlak_id`, `danisman_id`, `adsoyad`, `telefon`, `email`, `mesaj`) VALUES (?,?,?,?,?,?)");
                $ekle->execute(array($emlakID,$danismanID,$adsoyad,$telefon,$email,$mesaj));
                
                
                $ilanDetay = $db->query("SELECT * FROM emlaklar WHERE id='{$emlakID}' AND danisman='{$danismanID}'")->fetch(PDO::FETCH_ASSOC);
                $danismanDetay 	= $db->query("SELECT * FROM ekibimiz WHERE id = '{$danismanID}' ORDER BY id ASC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                $sablon 		= $db->query("SELECT * FROM bildirim_sablonu WHERE id = '17'")->fetch(PDO::FETCH_ASSOC);
    			$gelendegisken 	= explode(",", $sablon['degiskenler']);
    			$gidendegisken	= [$danismanDetay['adi'],$adSoyad,$telefon,$ilanDetay['adi'],$mesaj,$tarih];
    			
    			echo json_encode(['status' => true,'msg' => 'Mesaj başarıyla gönderildi']);
				if($sablon["ubildirim"] == "1"){
					$uyekonu 	= turkce($sablon['konu']);
					$uyesablon 	= $sablon['icerik'];
					mailgonder($gelendegisken,$gidendegisken,$uyesablon,$danismanDetay['email']," ".$uyekonu."",$uyesablon);
				}
				if($sablon["abildirim"] == "1"){
					$adminkonu 	= turkce($sablon['konu2']);
					$adminsablon= $sablon['icerik2'];
					mailgonder($gelendegisken,$gidendegisken,$adminsablon,m_kime," ".$adminkonu."",$adminsablon);
				}
				if($sablon["ysbildirim"] == "1"){
					$ysmssablon = $sablon['icerik4'];
					smsgonder($gelendegisken,$gidendegisken,$ysmssablon,$ayar['firma_telefon'],$ysmssablon);
				}
				
				
				
                break;
	    }
	}

?>