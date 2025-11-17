<?php
    require_once('../../../_class/baglan.php');
    require_once('../../../_class/fonksiyon.php');

	if(isset($_POST['type'])){
	    $type = $_POST['type'];
	    switch($type){
	        case 'emlakResimSirala':
	            $resimID = $_POST['resim_id'];
	            $sira = $_POST['sira'];

	            // SQL Injection'a karşı güvenli hale getirildi
	            $guncelle = $db->prepare("UPDATE `emlakresim` SET `sira` = ? WHERE `id` = ?");
                $guncelle->execute([$sira, $resimID]);
                break;

            case 'danismana_ulas':
                $tarih = date('d.m.Y');
                $emlakID = $_POST['emlak_id'];
                $danismanID = $_POST['danisman_id'];
                $adsoyad = $_POST['adsoyad'];
                $email = $_POST['email'];
                $telefon = $_POST['telefon'];
                $mesaj = $_POST['mesaj'];

                // SQL Injection'a karşı zaten güvenli (prepared statement kullanılıyor)
                $ekle = $db->prepare("INSERT INTO `emlak_mesajlar`(`emlak_id`, `danisman_id`, `adsoyad`, `telefon`, `email`, `mesaj`) VALUES (?,?,?,?,?,?)");
                $ekle->execute(array($emlakID,$danismanID,$adsoyad,$telefon,$email,$mesaj));

                // SQL Injection'a karşı güvenli hale getirildi
                $ilanDetaySorgu = $db->prepare("SELECT * FROM emlaklar WHERE id = ? AND danisman = ?");
                $ilanDetaySorgu->execute([$emlakID, $danismanID]);
                $ilanDetay = $ilanDetaySorgu->fetch(PDO::FETCH_ASSOC);

                // SQL Injection'a karşı güvenli hale getirildi
                $danismanDetaySorgu = $db->prepare("SELECT * FROM ekibimiz WHERE id = ? ORDER BY id ASC LIMIT 1");
                $danismanDetaySorgu->execute([$danismanID]);
                $danismanDetay = $danismanDetaySorgu->fetch(PDO::FETCH_ASSOC);

                // Sabit sorgu, güvenlik riski yok
                $sablon = $db->query("SELECT * FROM bildirim_sablonu WHERE id = '17'")->fetch(PDO::FETCH_ASSOC);

			// Tanımsız 'adSoyad' değişkeni düzeltildi -> '$adsoyad' kullanılıyor
			$gelendegisken 	= explode(",", $sablon['degiskenler']);
			$gidendegisken	= [$danismanDetay['adi'], $adsoyad, $telefon, $ilanDetay['adi'], $mesaj, $tarih];

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
