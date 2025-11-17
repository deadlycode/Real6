<?php
	ob_start();
	session_start();	
	date_default_timezone_set('Europe/Istanbul');
	error_reporting(0);
	ini_set('display_errors', 0);

	$host = 'localhost'; // Linux sunucularda değiştirmeyiniz
	$data = 'emlakdemo'; // Veri tabanı Adını Yazın.
	$user = 'emlakdemo'; // Veri tabanı Kullanıcı adını yazın
	$pass = 'Osman998***'; // Veri tabanı Şifrenizi Yazın
	
	try
	{
		$db = new PDO('mysql:host='.$host.';dbname='.$data.';charset=UTF8;', $user, $pass);
	}
	catch(PDOException $e)
	{
		echo 'Hata: '.$e->getMessage();
	}
	
	if(is_numeric(@$_GET['dil']))
	{
		$_SESSION['k_dil'] = $_GET['dil'];
	}	
	if(!isset($_SESSION['k_dil']))
	{
		$anadil = $db->prepare("SELECT * FROM diller WHERE anadil = ?");
		$anadil->execute([1]);
		if($anadil->rowCount() == 0) die("Lütfen bir anadil seçiniz !!");
		$anadil = $anadil->fetch(PDO::FETCH_ASSOC);
		$_SESSION['k_dil'] = @$anadil['id'];
	}
	else
	{
		$mevcutDil = $db->prepare("SELECT * FROM diller WHERE id = ?");
		$mevcutDil->execute([(int) $_SESSION['k_dil']]);
		if($mevcutDil->rowCount() == 0)
		{
			$anadil = $db->prepare("SELECT * FROM diller WHERE anadil = ?");
			$anadil->execute([1]);
			if($anadil->rowCount() == 0) die("Lütfen bir anadil seçiniz !!");
			$anadil = $anadil->fetch(PDO::FETCH_ASSOC);
			$_SESSION['k_dil'] = @$anadil['id'];
		}
		else
		{
			$mevcutDil = $mevcutDil->fetch(PDO::FETCH_ASSOC);
			$_SESSION['k_dil'] = @$mevcutDil['id'];
		}
	}
	$ayar 		= $db->query("SELECT * FROM ayarlar")->fetch();
	$popup 		= $db->query("SELECT * FROM popup_ayarlar")->fetch();
	$htc 		= $db->query("SELECT * FROM sabit_url")->fetch();
	// Çift slash sorununu önlemek için URL'lerin başındaki ve sonundaki / karakterini temizle
	if(is_array($htc)) {
		foreach($htc as $key => $value) {
			if(is_string($value) && $key != 'id' && $key != 'durum') {
				$htc[$key] = trim($value, '/');
			}
		}
	}
	$bakim_modu = $db->query("SELECT * FROM bakim_modu")->fetch(); 
	$moduller 	= $db->query("SELECT * FROM moduller WHERE id = '1' ORDER BY id ASC LIMIT 1")->fetch();
	$mailayar 	= $db->query("SELECT * FROM mail_ayar")->fetch();
	$smsayar 	= $db->query("SELECT * FROM sms")->fetch();	
	$limitayar 	= $db->query("SELECT * FROM limit_ayarlari WHERE id = '1' ORDER BY id ASC LIMIT 1")->fetch();
	
	// Üye Giriş
	$UYESorgu = $db->prepare("SELECT * FROM uyeler WHERE email = ?");
	$UYESorgu->execute(array(@$_SESSION["site_email"]));
	if($UYESorgu->rowCount()){
		$Bilgilerim = $UYESorgu->fetch(PDO::FETCH_ASSOC);
	}
	
	define("baslik", $ayar["site_baslik"]);
	define("url", $ayar["site_url"]);
	define("tema_dir", $ayar["site_tema"]);
	define("tema","tema/".$ayar["site_tema"]);
	define("tema_url", $ayar["site_url"]."tema/".$ayar["site_tema"]);	
	define("logo", $ayar["firma_logo"]);
	define("watermark", $ayar["watermark"]);
	define("footerlogo", $ayar["firma_footerlogo"]);
	define("fav", $ayar["favicon"]);
	define("firma_adi", $ayar["firma_adi"]);
	define("telefon", $ayar["firma_telefon"]);
	define("fax", $ayar["firma_fax"]);
	define("email", $ayar["firma_email"]);
	define("adres", $ayar["firma_adres"]);
	define("maps", $ayar["google_maps"]);
	define("analytics", $ayar["google_analytics"]);
	define("dogrulama", $ayar["dogrulama_kodu"]);
	define("canli_destek", $ayar["canli_destek"]);
	define("whatsapp", $ayar["whatsapp"]);
	define("facebook", $ayar["facebook"]);
	define("twitter", $ayar["twitter"]);
	define("instagram", $ayar["instagram"]);
	define("linkedin", $ayar["linkedin"]);
	define("youtube", $ayar["youtube"]);
	define("copyright", $ayar["copyright"]);
	define("site_desc", $ayar["site_desc"]);
	define("site_keyw", $ayar["site_keyw"]);
	define("durum", $moduller["alan19"]);
	define("altklasor", $moduller["alan18"]);
	define("renk1", $ayar["renk1"]);
	define("renk2", $ayar["renk2"]);
	define("renk3", $ayar["renk3"]);
	define("yonetim", $ayar["yonetim"]);
	
	
	// Mail Sabitler
	define("m_server", 	$mailayar["m_server"]);
	define("m_adresi", 	$mailayar["m_adresi"]);
	define("m_parola", 	$mailayar["m_parola"]);
	define("m_port", 	$mailayar["m_port"]);
	define("m_sertifika", 	$mailayar["m_sertifika"]);
	define("m_kime", 	$mailayar["m_kime"]);
	
	// SMS Sabitler
	define("postUrl", 	$smsayar["postUrl"]);
	define("sms_kadi", 	$smsayar["KULLANICIADI"]);
	define("sms_sifre", 	$smsayar["SIFRE"]);
	define("sms_baslik", $smsayar["ORGINATOR"]);
	define("sms_kime", $smsayar["m_kime"]);
	
	
	function para_format($fiyat){
		return number_format((float)$fiyat, 0, ',', '.');
	}
	
	function kdv_fiyat($emlak_fiyat,$emlak_kdv)
	{
		$toplam = $emlak_fiyat * ($emlak_kdv/100);
		return $toplam;
	}
	
	function kdv_ekle($tutar,$oran){
		$kdv = $tutar * ($oran / 100);
		$ytutar = $tutar + $kdv;
		return $ytutar;
	}
	
	function kdv_cikar($tutar,$oran){
		$ytutar = $tutar / (1 + ($oran/100));
		return $ytutar;
	}
	
	function kategori($katid = 0, $string = 0, $ustid = 0)
	{
		global $db;
		$query 	= $db->prepare("SELECT * FROM emlak_kategori WHERE ustid = ?");
		$query->execute(array($katid));
		$islem 	= $query->fetchALL(PDO::FETCH_ASSOC);
		if($query->rowCount())
		{
			foreach ( $islem as $Row )
			{
				echo '<option ';
				echo $Row['id'] == $ustid ? ' selected ' : null;
				echo 'value="'.$Row['id'].'">'.str_repeat('-', $string).$Row['adi'].'</option>';
				kategori($Row['id'], $string + 2, $ustid);
			}
		}
		else
		{
			return false;
		}
	}

	function panelmenukategori($katid = 0, $string = 0, $ustid = 0, $menuurl = "")
	{
		global $db;
		global $htc;
		$query 	= $db->prepare("SELECT * FROM emlak_kategori WHERE ustid = ? order by sira asc");
		$query->execute(array($katid));
		$islem 	= $query->fetchALL(PDO::FETCH_ASSOC);
		if($query->rowCount())
		{
			foreach ( $islem as $Row )
			{
				
				$selected = '';
				if($menuurl == $htc['emlakkategoriurl'].'/'.$Row['seo'].'.html'){
					$selected = 'selected';
				}
				echo '<option data-menuurl="'.$menuurl.'" data-if="'.$htc['emlakkategoriurl'].'/'.$Row['seo'].'.html'.'" '.$selected;
				echo ' value="'.$htc['emlakkategoriurl'].'/'.$Row['seo'].'.html">'.str_repeat('-', $string).$Row['adi'].'</option>';
				panelmenukategori($Row['id'], $string + 2, $ustid, $menuurl);
			}
		}
		else
		{
			return false;
		}
	}


	function modulmenukategori($katid = 0, $string = 0, $ustid = 0, $menuurl = "")
	{
		global $db;
		global $htc;
		$query 	= $db->prepare("SELECT * FROM emlak_kategori WHERE ustid = ? order by sira asc");
		$query->execute(array($katid));
		$islem 	= $query->fetchALL(PDO::FETCH_ASSOC);
		if($query->rowCount())
		{
			foreach ( $islem as $Row )
			{
				
				$selected = '';
				if($menuurl == $Row['id']){
					$selected = 'selected';
				}
				echo '<option data-menuurl="'.$menuurl.'" data-if="'.$htc['emlakkategoriurl'].'/'.$Row['seo'].'.html'.'" '.$selected;
				echo ' value="'.$Row['id'].'">'.str_repeat('-', $string).$Row['adi'].'</option>';
				modulmenukategori($Row['id'], $string + 2, $ustid, $menuurl);
			}
		}
		else
		{
			return false;
		}
	}	
	
	function menukategori($katid = 0, $string = 0, $ustid = 0)
	{
		global $db;
		$query 	= $db->prepare("SELECT * FROM emlak_kategori WHERE ustid = ?");
		$query->execute(array($katid));
		$islem 	= $query->fetchALL(PDO::FETCH_ASSOC);
		if($query->rowCount())
		{
			foreach ( $islem as $Row )
			{
				echo '<option ';
				echo 'kategori/'.$Row['seo'].'.html' == $ustid ? ' selected ' : null;
				echo 'value="kategori/'.$Row['seo'].'.html">'.str_repeat('-', $string).$Row['adi'].'</option>';
				menukategori($Row['id'], $string + 2, $ustid);
			}
		}
		else
		{
			return false;
		}
	}
	
	function emlakkategori($katid = 0, $string = 0, $ustid = 0)
	{
		global $db;
		$query 	= $db->prepare("SELECT * FROM emlak_kategori WHERE ustid = ? order by sira asc");
		$query->execute(array($katid));
		$islem 	= $query->fetchALL(PDO::FETCH_ASSOC);
		if($query->rowCount())
		{
			foreach ( $islem as $liste )
			{
				echo '<option ';
				if(in_array($liste['id'],$ustid)){echo " selected ";}
				echo 'value="'.$liste['id'].'">'.str_repeat('-', $string).$liste['adi'].'</option>';
				emlakkategori($liste['id'], $string + 2, $ustid);
			}
		}
		else
		{
			return false;
		}
	}
	
	function kategoriListele($kategoriler, $parent = 0)
	{
		global $db;
		$html = '';
		foreach ($kategoriler as $kategori){
			if ($kategori['ustid'] == $parent){
				$altvarmi = $db->prepare("SELECT * FROM emlak_kategori WHERE ustid = ?");
				$altvarmi->execute([ $kategori['id'] ]);
				$html .= ''.(($kategori['ustid'] == 0 ) ? '<div class="col-sidebar__category">' : '').'';
				$html .= ''.(($kategori['ustid'] == 0 ) ? '' : '<li>').'<a '.(($kategori['ustid'] == 0 ) ? 'class="page-content__heading"' : '').'  href="emlak-kategori/'.$kategori['seo'] .'.html" >'.$kategori['adi'] .'</a>'.(($kategori['ustid'] == 0 ) ? '' : '</li>').'';
				if($altvarmi->rowCount()>0)
					$html .= "<ul>".kategoriListele($kategoriler, $kategori['id']).'</ul>';
				$html .= ''.(($kategori['ustid'] == 0 ) ? '</div>' : '').'';
			}
		}
		return $html;
	}
	
	function mailgonder($gelendegisken,$gidendegisken,$mailsablon,$kullanici_mail,$mailKonu,$mesaj) 
	{
		$mail = new PHPMailer();
		$mail->IsSMTP(true);
		$mail->SMTPSecure = m_sertifika;
		$mail->From     = m_adresi;
		$mail->Sender   = m_adresi;
		$mail->AddAddress($kullanici_mail, firma_adi); 
		$mail->AddReplyTo=(m_adresi);
		$mail->FromName = firma_adi;
		$mail->Host     = m_server;
		$mail->SMTPAuth = true;
		$mail->Port     = m_port;
		$mail->CharSet = 'UTF-8';
		$mail->Username = m_adresi;
		$mail->Password = m_parola;
		$mail->Subject  = $mailKonu;
		$gelen 	= $gelendegisken;
		$giden 	= $gidendegisken;
		$mesaj = str_replace($gelen,$giden,$mailsablon);
		$mail->IsHTML(true);
		$mail->Body = $mesaj;
		$mail->Send();
	}
	
	function smsgonder($gelendegisken,$gidendegisken,$smssablon,$sms_telefon,$sms_mesaj) 
	{
		$postUrl	= postUrl;
		$username	= sms_kadi;
		$password	= sms_sifre;
		$header		= sms_baslik;
		$gelen 		= $gelendegisken;
		$giden 		= $gidendegisken;
		$sms_mesaj 	= str_replace($gelen,$giden,$smssablon);
		$postData=''.
		'<sms>'.
		'<username>'.$username.'</username>'.
		'<password>'.$password.'</password>'.
		'<header><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'.$header.'</header>'.
		'<validity>2880</validity>'.
		'<message>'.
		'<gsm>'.
		'<no>'.$sms_telefon.'</no>'.
		'</gsm>'.
		'<msg><![CDATA['.$sms_mesaj.']]></msg>'.
		'</message>'.
		'</sms>';
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$postUrl);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$postData);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_TIMEOUT,5);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_HTTPHEADER,Array('Content-Type: text/xml; charset=UTF-8'));
		$response=curl_exec($ch);
		curl_close($ch);
	}
	
	function toplusmsgonder($sms_telefon,$sms_mesaj) 
	{
		$postUrl	= postUrl;
		$username	= sms_kadi;
		$password	= sms_sifre;
		$header		= sms_baslik;
		$postData="".
		"<sms>".
		"<username>$username</username>".
		"<password>$password</password>".
		"<header>$header</header>".
		"<validity>2880</validity>".
		"<message>".
		"<gsm>".
		"<no>$sms_telefon</no>".
		"</gsm>".
		"<msg><![CDATA[$sms_mesaj]]></msg>".
		"</message>".
		"</sms>";
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$postUrl);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$postData);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_TIMEOUT,5);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_HTTPHEADER,Array('Content-Type: text/xml; charset=UTF-8'));
		$response=curl_exec($ch);
		curl_close($ch);
	}
	

?>