<?php
require_once "baglan.php";
require_once "fonksiyon.php";
require_once('class.upload.php');
require_once("class.phpmailer.php");
$logo	= url.tema.'/uploads/logo/'.logo;
$domain_bilgi	= url;
$bildirimkt 		= strtotime(tr_tarih('Y-m-d'));
$bildirimt 		= strtotime(tr_tarih('Y-m-d H:i:s'));
if($moduller['alan20'] == "1"){
	$html = ".html";
}
else
{
	$html = "";
}
 
##GET POST VARMI ##
if(empty($_POST) && empty($_GET))
{
	header("Location:../".yonetim."/index".$html."");
	exit();
}


##İl Kaydet ##
if(isset($_POST['il_ekle']))
{
	panelislemkontrol();
	if($_SESSION['rutbe'] == 0)
	{
		$il_adi 	= $_POST['il_adi'];
		$slug		= seo($il_adi);
		
		$sorgu = $db->prepare("INSERT INTO il SET
				il_adi	= ?,
				slug 	= ?");
		$Ekle = $sorgu->execute(array(
				$il_adi,
				$slug
		));
		
		if($Ekle)
		{
			$last_id = $db->lastInsertId();
			bildirim("İl Ekledi","icon-location-pin",$last_id,$il_adi,"başlıklı il ekledi.");
			$_SESSION['il_ekle'] = 'yes';
			header("Location:../".yonetim."/iller".$html."");
			exit();
		}
		else
		{
			$_SESSION['il_ekle'] = 'no';
			header("Location:../".yonetim."/iller".$html."");
			exit();
		}
	}
	else
	{
		$_SESSION['demohesap'] = 'no';
		header("Location:../".yonetim."/iller".$html."");
		exit();
	}
}

##İl Güncelle ##
if(isset($_POST['il_guncelle']))
{
	panelislemkontrol();
	$d_id 	= $_POST['id'];
	if($_SESSION['rutbe'] == 0)
	{
		$il_adi 	= $_POST['il_adi'];
		$slug		= seo($il_adi);
		
		$sorgu = $db->prepare("UPDATE il SET
			il_adi	= ?,
			slug 	= ?
			WHERE id= ?");
		$guncelle = $sorgu->execute(array(
			$il_adi,
			$slug,
			$d_id
		));
		if($guncelle)
		{
			$last_id = $d_id;
			bildirim("İl Güncellendi","icon-location-pin",$last_id,$il_adi,"başlıklı ili güncelledi.");
			$_SESSION['il_guncelle'] = 'yes';
			header("Location:../".yonetim."/iller".$html."");
			exit();
		}
		else
		{
			$_SESSION['il_guncelle'] = 'no';
			header("Location:../".yonetim."/iller".$html."");
			exit();
		}		
	}
	else
	{
		$_SESSION['demohesap'] = 'no';
		header("Location:../".yonetim."/iller".$html."");
		exit();
	}
}

##İl Sil##
if(@$_GET['ilsil'] == "ok")
{
	panelislemkontrol();
	if($_SESSION['rutbe'] == 0)
	{
		$id = $_GET['id'];
		$resim_bul= $db->query("SELECT * FROM il WHERE id = '{$id}'")->fetch(PDO::FETCH_ASSOC);
		$Sorgu = $db->prepare("DELETE FROM il WHERE id = :id");
		$sil_sorgu = $Sorgu->execute(array('id' => $id));
		if($Sorgu->rowCount())
		{
			if($sil_sorgu)
			{
				$TopluSorgu = $db->prepare("SELECT * FROM ilce WHERE il_id = ?");
				$TopluSorgu->execute(array($_GET['id']));
				$Topluislem = $TopluSorgu->fetchALL(PDO::FETCH_ASSOC);
				foreach ( $Topluislem as $TopluSonuc )
				{
					$last_id = $TopluSonuc['id'];
					$TSorgu = $db->prepare("DELETE FROM ilce WHERE id = :id");
					$TSorgu->execute(array('id' => $TopluSonuc['id']));
				}
				
				$last_id = $resim_bul['id'];
				bildirim("İl Silindi","icon-trash",$last_id,$resim_bul['il_adi'],"başlıklı ili sildi.");
				$_SESSION['ilsil'] = 'yes';
				header("Location:../".yonetim."/iller".$html."");
				exit();
			}
			else
			{
				$_SESSION['ilsil'] = 'no';
				header("Location:../".yonetim."/iller".$html."");
				exit();
			}
		}
		else
		{
			echo '<meta http-equiv="refresh" content="0; url=404".$html."">';
			exit();
		}
	}
	else
	{
		$_SESSION['demohesap'] = 'no';
		header("Location:../".yonetim."/iller".$html."");
		exit();
	}
}

##İl Toplu Sil ##
if(isset($_POST['il_tumu']))
{
	panelislemkontrol();
	if($_SESSION['rutbe'] == 0)
	{
		if($_POST['id'])
		{
			foreach($_POST['id'] as $i)
			{
				$resim_bul= $db->query("SELECT * FROM il WHERE id = '{$i}'")->fetch(PDO::FETCH_ASSOC);
				$TopluSorgu = $db->prepare("DELETE FROM il WHERE id = :id");
				$TopluSil	= $TopluSorgu->execute(array('id' => $i));
				if($TopluSil)
				{
					$TopluSorgu = $db->prepare("SELECT * FROM ilce WHERE il_id = ?");
					$TopluSorgu->execute(array($i));
					$Topluislem = $TopluSorgu->fetchALL(PDO::FETCH_ASSOC);
					foreach ( $Topluislem as $TopluSonuc )
					{
						$last_id = $TopluSonuc['id'];
						$TSorgu = $db->prepare("DELETE FROM ilce WHERE id = :id");
						$TSorgu->execute(array('id' => $TopluSonuc['id']));
					}
					$last_id = $i;
					bildirim("İl Silindi","icon-trash",$last_id,$resim_bul['il_adi'],"başlıklı ili sildi.");
					$_SESSION['il_tumu'] = 'yes';
					header("Location:../".yonetim."/iller".$html."");
				}
				else
				{
					$_SESSION['il_tumu'] = 'no';
					header("Location:../".yonetim."/iller".$html."");
				}
			}
		}
		else
		{
			$_SESSION['secim'] = 'secimyok';
			header("Location:../".yonetim."/iller".$html."");
			exit();
		}
	}
	else
	{
		$_SESSION['demohesap'] = 'no';
		header("Location:../".yonetim."/iller".$html."");
		exit();
	}	
}


##İl Tümünü Sil ##
if(@$_GET['iltumunusil'] == "ok")
{
	panelislemkontrol();
	if($_SESSION['rutbe'] == 0)
	{
		$Sorgu = $db->prepare("DELETE FROM il");
		$sil_sorgu	= $Sorgu->execute();
		if($sil_sorgu)
		{
			$_SESSION['iltumunusil'] = 'yes';
			header("Location:../".yonetim."/iller".$html."");
			exit();
		}
		else
		{
			$_SESSION['iltumunusil'] = 'no';
			header("Location:../".yonetim."/iller".$html."");
			exit();
		}		
	}
	else
	{
		$_SESSION['demohesap'] = 'no';
		header("Location:../".yonetim."/iller".$html."");
		exit();
	}
}


##İlçe Kaydet ##
if(isset($_POST['ilce_ekle']))
{
	panelislemkontrol();
	$kategori 	= $_POST['kategori'];
	if($_SESSION['rutbe'] == 0)
	{
		$ilce_adi 	= $_POST['ilce_adi'];
		$slug		= seo($ilce_adi);
		
		$sorgu = $db->prepare("INSERT INTO ilce SET
				il_id		= ?,
				ilce_adi	= ?,
				slug 		= ?");
		$Ekle = $sorgu->execute(array(
				$kategori,
				$ilce_adi,
				$slug
		));
		
		if($Ekle)
		{
			$last_id = $db->lastInsertId();
			bildirim("İlçe Ekledi","icon-location-pin",$last_id,$ilce_adi,"başlıklı ilçe ekledi.");
			$_SESSION['ilce_ekle'] = 'yes';
			header("Location:../".yonetim."/il/".$kategori ."".$html."");
			exit();
		}
		else
		{
			$_SESSION['ilce_ekle'] = 'no';
			header("Location:../".yonetim."/il/".$kategori ."".$html."");
			exit();
		}
	}
	else
	{
		$_SESSION['demohesap'] = 'no';
		header("Location:../".yonetim."/il/".$kategori ."".$html."");
		exit();
	}
}

##İlce Güncelle ##
if(isset($_POST['ilce_guncelle']))
{
	panelislemkontrol();
	$d_id 	= $_POST['id'];
	$kategori 	= $_POST['kategori'];
	if($_SESSION['rutbe'] == 0)
	{
		$ilce_adi 	= $_POST['ilce_adi'];
		$slug		= seo($ilce_adi);
		
		$sorgu = $db->prepare("UPDATE ilce SET
			il_id		= ?,
			ilce_adi	= ?,
			slug 		= ?
			WHERE id	= ?");
		$guncelle = $sorgu->execute(array(
			$kategori,
			$ilce_adi,
			$slug,
			$d_id
		));
		if($guncelle)
		{
			$last_id = $d_id;
			bildirim("İlçe Güncellendi","icon-location-pin",$last_id,$ilce_adi,"başlıklı ilçeyi güncelledi.");
			$_SESSION['ilce_guncelle'] = 'yes';
			header("Location:../".yonetim."/il/".$kategori ."".$html."");
			exit();
		}
		else
		{
			$_SESSION['ilce_guncelle'] = 'no';
			header("Location:../".yonetim."/il/".$kategori ."".$html."");
			exit();
		}		
	}
	else
	{
		$_SESSION['demohesap'] = 'no';
		header("Location:../".yonetim."/il/".$kategori ."".$html."");
		exit();
	}
}

##İlçe Sil##
if(@$_GET['ilcesil'] == "ok")
{
	panelislemkontrol();
	$kategori = $_GET['kategori'];
	if($_SESSION['rutbe'] == 0)
	{
		$id = $_GET['id'];
		$resim_bul= $db->query("SELECT * FROM ilce WHERE id = '{$id}'")->fetch(PDO::FETCH_ASSOC);
		$Sorgu = $db->prepare("DELETE FROM ilce WHERE id = :id");
		$sil_sorgu = $Sorgu->execute(array('id' => $id));
		if($Sorgu->rowCount())
		{
			if($sil_sorgu)
			{
				$TopluSorgu = $db->prepare("SELECT * FROM semt WHERE ilce_id = ?");
				$TopluSorgu->execute(array($_GET['id']));
				$Topluislem = $TopluSorgu->fetchALL(PDO::FETCH_ASSOC);
				foreach ( $Topluislem as $TopluSonuc )
				{
					$last_id = $TopluSonuc['id'];
					$TSorgu = $db->prepare("DELETE FROM semt WHERE id = :id");
					$TSorgu->execute(array('id' => $TopluSonuc['id']));
				}				
				$last_id = $resim_bul['id'];
				bildirim("İlçe Silindi","icon-trash",$last_id,$resim_bul['ilce_adi'],"başlıklı ilçe sildi.");
				$_SESSION['ilcesil'] = 'yes';
				header("Location:../".yonetim."/il/".$kategori ."".$html."");
				exit();
			}
			else
			{
				$_SESSION['ilcesil'] = 'no';
				header("Location:../".yonetim."/il/".$kategori ."".$html."");
				exit();
			}
		}
		else
		{
			echo '<meta http-equiv="refresh" content="0; url=404".$html."">';
			exit();
		}
	}
	else
	{
		$_SESSION['demohesap'] = 'no';
		header("Location:../".yonetim."/il/".$kategori ."".$html."");
		exit();
	}
}

##İlçe Toplu Sil ##
if(isset($_POST['ilce_tumu']))
{
	panelislemkontrol();
	$kategori = $_POST['kategori'];
	if($_SESSION['rutbe'] == 0)
	{
		if($_POST['id'])
		{
			foreach($_POST['id'] as $i)
			{
				$resim_bul= $db->query("SELECT * FROM ilce WHERE id = '{$i}'")->fetch(PDO::FETCH_ASSOC);
				$TopluSorgu = $db->prepare("DELETE FROM ilce WHERE id = :id");
				$TopluSil	= $TopluSorgu->execute(array('id' => $i));
				if($TopluSil)
				{
					$TopluSorgu = $db->prepare("SELECT * FROM semt WHERE ilce_id = ?");
					$TopluSorgu->execute(array($i));
					$Topluislem = $TopluSorgu->fetchALL(PDO::FETCH_ASSOC);
					foreach ( $Topluislem as $TopluSonuc )
					{
						$last_id = $TopluSonuc['id'];
						$TSorgu = $db->prepare("DELETE FROM semt WHERE id = :id");
						$TSorgu->execute(array('id' => $TopluSonuc['id']));
					}					
					$last_id = $i;
					bildirim("İlçe Silindi","icon-trash",$last_id,$resim_bul['ilce_adi'],"başlıklı ilçeyi sildi.");
					$_SESSION['ilce_tumu'] = 'yes';
					header("Location:../".yonetim."/il/".$kategori ."".$html."");
				}
				else
				{
					$_SESSION['ilce_tumu'] = 'no';
					header("Location:../".yonetim."/il/".$kategori ."".$html."");
				}
			}
		}
		else
		{
			$_SESSION['secim'] = 'secimyok';
			header("Location:../".yonetim."/il/".$kategori ."".$html."");
			exit();
		}
	}
	else
	{
		$_SESSION['demohesap'] = 'no';
		header("Location:../".yonetim."/il/".$kategori ."".$html."");
		exit();
	}	
}

##İlçe Tümünü Sil ##
if(@$_GET['ilcetumunusil'] == "ok")
{
	panelislemkontrol();
	$kategori = $_GET['kategori'];
	if($_SESSION['rutbe'] == 0)
	{
		$Sorgu = $db->prepare("DELETE FROM ilce WHERE il_id = ?");
		$sil_sorgu	= $Sorgu->execute(array($kategori));
		if($sil_sorgu)
		{
			$_SESSION['ilcetumunusil'] = 'yes';
			header("Location:../".yonetim."/il/".$kategori ."".$html."");
			exit();
		}
		else
		{
			$_SESSION['ilcetumunusil'] = 'no';
			header("Location:../".yonetim."/il/".$kategori ."".$html."");
			exit();
		}		
	}
	else
	{
		$_SESSION['demohesap'] = 'no';
		header("Location:../".yonetim."/il/".$kategori ."".$html."");
		exit();
	}
}

##Semt Kaydet ##
if(isset($_POST['semt_ekle']))
{
	panelislemkontrol();
	$il_id 		= $_POST['il_id'];
	$ilce_id 	= $_POST['ilce_id'];
	if($_SESSION['rutbe'] == 0)
	{
		$semt_adi 		= $_POST['semt_adi'];
		$posta_kodu 	= $_POST['posta_kodu'];
		$semt_adi_kucuk	= mb_strtolower($semt_adi,"UTF-8");
		$semt_adi_buyuk	= mb_strtoupper($semt_adi, "UTF-8");
		
		$sorgu = $db->prepare("INSERT INTO semt SET
				il_id			= ?,
				ilce_id			= ?,
				semt_adi_buyuk	= ?,
				semt_adi		= ?,
				semt_adi_kucuk	= ?,
				posta_kodu 		= ?");
		$Ekle = $sorgu->execute(array(
				$il_id,
				$ilce_id,
				$semt_adi_buyuk,
				$semt_adi,
				$semt_adi_kucuk,
				$posta_kodu
		));
		
		if($Ekle)
		{
			$last_id = $db->lastInsertId();
			bildirim("Semt Ekledi","icon-location-pin",$last_id,$semt_adi,"başlıklı semti ekledi.");
			$_SESSION['semt_ekle'] = 'yes';
			header("Location:../".yonetim."/ilce/".$ilce_id ."".$html."");
			exit();
		}
		else
		{
			$_SESSION['semt_ekle'] = 'no';
			header("Location:../".yonetim."/ilce/".$ilce_id ."".$html."");
			exit();
		}
	}
	else
	{
		$_SESSION['demohesap'] = 'no';
		header("Location:../".yonetim."/ilce/".$ilce_id ."".$html."");
		exit();
	}
}

##Semt Güncelle ##
if(isset($_POST['semt_guncelle']))
{
	panelislemkontrol();
	$d_id 		= $_POST['id'];
	$il_id 		= $_POST['il_id'];
	$ilce_id 	= $_POST['ilce_id'];
	if($_SESSION['rutbe'] == 0)
	{
		$semt_adi 		= $_POST['semt_adi'];
		$posta_kodu 	= $_POST['posta_kodu'];
		$semt_adi_kucuk	= mb_strtolower($semt_adi,"UTF-8");
		$semt_adi_buyuk	= mb_strtoupper($semt_adi, "UTF-8");
		
		$sorgu = $db->prepare("UPDATE semt SET
			il_id			= ?,
			ilce_id			= ?,
			semt_adi_buyuk	= ?,
			semt_adi		= ?,
			semt_adi_kucuk	= ?,
			posta_kodu 		= ?
			WHERE id		= ?");
		$guncelle = $sorgu->execute(array(
			$il_id,
			$ilce_id,
			$semt_adi_buyuk,
			$semt_adi,
			$semt_adi_kucuk,
			$posta_kodu,
			$d_id
		));
		if($guncelle)
		{
			$last_id = $d_id;
			bildirim("Semt Güncellendi","icon-location-pin",$last_id,$semt_adi,"başlıklı semti güncelledi.");
			$_SESSION['semt_guncelle'] = 'yes';
			header("Location:../".yonetim."/ilce/".$ilce_id ."".$html."");
			exit();
		}
		else
		{
			$_SESSION['semt_guncelle'] = 'no';
			header("Location:../".yonetim."/ilce/".$ilce_id ."".$html."");
			exit();
		}		
	}
	else
	{
		$_SESSION['demohesap'] = 'no';
		header("Location:../".yonetim."/ilce/".$ilce_id ."".$html."");
		exit();
	}
}

##Semt Sil##
if(@$_GET['semtsil'] == "ok")
{
	panelislemkontrol();
	$ilce_id = $_GET['ilce_id'];
	if($_SESSION['rutbe'] == 0)
	{
		$id = $_GET['id'];
		$resim_bul= $db->query("SELECT * FROM semt WHERE id = '{$id}'")->fetch(PDO::FETCH_ASSOC);
		$Sorgu = $db->prepare("DELETE FROM semt WHERE id = :id");
		$sil_sorgu = $Sorgu->execute(array('id' => $id));
		if($Sorgu->rowCount())
		{
			if($sil_sorgu)
			{
				$last_id = $resim_bul['id'];
				bildirim("Semt Silindi","icon-trash",$last_id,$resim_bul['semt_adi'],"başlıklı semti sildi.");
				$_SESSION['semtsil'] = 'yes';
				header("Location:../".yonetim."/ilce/".$ilce_id ."".$html."");
				exit();
			}
			else
			{
				$_SESSION['semtsil'] = 'no';
				header("Location:../".yonetim."/ilce/".$ilce_id ."".$html."");
				exit();
			}
		}
		else
		{
			echo '<meta http-equiv="refresh" content="0; url=404".$html."">';
			exit();
		}
	}
	else
	{
		$_SESSION['demohesap'] = 'no';
		header("Location:../".yonetim."/ilce/".$ilce_id ."".$html."");
		exit();
	}
}

##Semt Toplu Sil ##
if(isset($_POST['semt_tumu']))
{
	panelislemkontrol();
	$ilce_id = $_POST['ilce_id'];
	if($_SESSION['rutbe'] == 0)
	{
		if($_POST['id'])
		{
			foreach($_POST['id'] as $i)
			{
				$resim_bul= $db->query("SELECT * FROM semt WHERE id = '{$i}'")->fetch(PDO::FETCH_ASSOC);
				$TopluSorgu = $db->prepare("DELETE FROM semt WHERE id = :id");
				$TopluSil	= $TopluSorgu->execute(array('id' => $i));
				if($TopluSil)
				{
					$last_id = $i;
					bildirim("Semt Silindi","icon-trash",$last_id,$resim_bul['semt_adi'],"başlıklı semti sildi.");
					$_SESSION['semt_tumu'] = 'yes';
					header("Location:../".yonetim."/ilce/".$ilce_id ."".$html."");
				}
				else
				{
					$_SESSION['semt_tumu'] = 'no';
					header("Location:../".yonetim."/ilce/".$ilce_id ."".$html."");
				}
			}
		}
		else
		{
			$_SESSION['secim'] = 'secimyok';
			header("Location:../".yonetim."/ilce/".$ilce_id ."".$html."");
			exit();
		}
	}
	else
	{
		$_SESSION['demohesap'] = 'no';
		header("Location:../".yonetim."/ilce/".$ilce_id ."".$html."");
		exit();
	}	
}

##Semt Tümünü Sil ##
if(@$_GET['semttumunusil'] == "ok")
{
	panelislemkontrol();
	$ilce_id = $_GET['ilce_id'];
	if($_SESSION['rutbe'] == 0)
	{
		$Sorgu = $db->prepare("DELETE FROM semt WHERE ilce_id = ?");
		$sil_sorgu	= $Sorgu->execute(array($ilce_id));
		if($sil_sorgu)
		{
			$_SESSION['semttumunusil'] = 'yes';
			header("Location:../".yonetim."/ilce/".$ilce_id ."".$html."");
			exit();
		}
		else
		{
			$_SESSION['semttumunusil'] = 'no';
			header("Location:../".yonetim."/ilce/".$ilce_id ."".$html."");
			exit();
		}		
	}
	else
	{
		$_SESSION['demohesap'] = 'no';
		header("Location:../".yonetim."/ilce/".$ilce_id ."".$html."");
		exit();
	}
}


ob_end_flush();
?>