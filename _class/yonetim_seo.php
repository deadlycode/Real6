<?php 
if(isset($_GET['sayfa']))
{
	$s = $_GET['sayfa'];
	switch($s) 
	{			
		case 'anasayfa';
		$title 		= "Yönetim Paneli";
		$anasayfa 	= "active";
		break;	
		
		case 'hizmet-ekle';
		$title 			= @$admindil['txt54'];
		$hizmetekle		= "active";
		$hizmetlershow	= "show";
		break;
		
		case 'hizmet-listele';
		$title 			= @$admindil['txt55'];
		$hizmetlistele	= "active";
		$hizmetlershow	= "show";
		break;
		
		case 'genel-ayarlar';
		$title 			= @$admindil['txt3'];
		$genelayarlar 	= "active";
		$ayarlarshow	= "show";
		break;
		
		case 'popup';
		$title 			= @$admindil['txt99'];
		$popup 			= "active";
		$ayarlarshow	= "show";
		break;
		
		case 'tema-ayarlari';
		$title 			= "Tema Ayarları";
		$temaayarlari 	= "active";
		$ayarlarshow	= "show";
		break;
		
		case 'api-ayarlari';
		$title 			= @$admindil['txt4'];
		$apiayarlari 	= "active";
		$ayarlarshow	= "show";
		break;
		
		case 'alisveris-ayarlari';
		$title 				= @$admindil['txt130'];
		$alisverisayarlari 	= "active";
		$ayarlarshow		= "show";
		break;
		
		case 'iletisim-ayarlari';
		$title 				= @$admindil['txt5'];
		$iletisimayarlari 	= "active";
		$ayarlarshow	= "show";
		break;
		
		case 'sosyal-medya-ayarlari';
		$title 				= @$admindil['txt6'];
		$sosyalmedyaayarlari= "active";
		$ayarlarshow		= "show";
		break;
		
		case 'modul-ayarlari';
		$title 				= @$admindil['txt7'];
		$modulayarlari		= "active";
		$ayarlarshow		= "show";
		break;
		
		case 'anasayfa-modul-siralama';
		$title 					= @$admindil['txt159'];
		$anasayfamodulsiralama 	= "active";
		$ayarlarshow			= "show";
		break;
		
		case 'limit-ayarlari';
		$title 				= @$admindil['txt8'];
		$limitayarlari		= "active";
		$ayarlarshow		= "show";
		break;
		
		case 'site-bakim-modu';
		$title 			= @$admindil['txt9'];
		$sitebakimmodu	= "active";
		$ayarlarshow	= "show";
		break;
		
		case 'mail-ayarlari';
		$title 			= @$admindil['txt10'];
		$mailayarlari	= "active";
		$ayarlarshow	= "show";
		break;
		
		case 'sms-ayarlari';
		$title 			= @$admindil['txt11'];
		$smsayarlari	= "active";
		$ayarlarshow	= "show";
		break;
		
		case 'sanal-poslar';
		$title 			= @$admindil['txt100'];
		$sanalposlar	= "active";
		$ayarlarshow	= "show";
		break;
		
		case 'arkaplan-ayarlari';
		$title 				= @$admindil['txt12'];
		$arkaplanayarlari	= "active";
		$ayarlarshow		= "show";
		break;
		
		case 'sayfa-ekle';
		$title 			= @$admindil['txt50'];
		$sayfaekle		= "active";
		$sayfalarshow	= "show";
		break;
		
		case 'sayfa-listele';
		$title 			= @$admindil['txt51'];
		$sayfalistele	= "active";
		$sayfalarshow	= "show";
		break;
		
		case 'haber-ekle';
		$title 		= @$admindil['txt78'];
		$haberekle	= "active";
		$habershow	= "show";
		break;
		
		case 'haber-listele';
		$title 			= @$admindil['txt79'];
		$haberlistele	= "active";
		$habershow		= "show";
		break;
		
		case 'haber-fotograflar';
		$title 			= @$admindil['txt80_1'];
		$haberlistele	= "active";
		$habershow		= "show";
		break;
		
		case 'slider-ekle';
		$title 		= @$admindil['txt82'];
		$sliderekle	= "active";
		$slidershow	= "show";
		break;
		
		case 'slider-listele';
		$title 			= @$admindil['txt83'];
		$sliderlistele	= "active";
		$slidershow		= "show";
		break;
		
		case 'banner-ekle';
		$title 		= @$admindil['txt156'];
		$bannerekle	= "active";
		$bannershow	= "show";
		break;
		
		case 'banner-listele';
		$title 			= @$admindil['txt157'];
		$bannerlistele	= "active";
		$bannershow		= "show";
		break;
		
		case 'header-menu';
		$title 			= @$admindil['txt18'];
		$headermenu		= "active";
		$menushow		= "show";
		break;
		
		case 'footer-menu';
		$title 			= @$admindil['txt20'];
		$footermenu		= "active";
		$menushow		= "show";
		break;
		
		case 'sabit-linkler';
		$title 			= @$admindil['txt25'];
		$sabitlinkler	= "active";
		$menushow		= "show";
		break;
		
		case 'dil-ekle';
		$title 		= @$admindil['txt14'];
		$dilekle	= "active";
		$dilshow	= "show";
		break;
		
		case 'dil-listele';
		$title 			= @$admindil['txt15'];
		$dillistele		= "active";
		$dilshow		= "show";
		break;
		
		case 'admin-dil-duzenle';
		$title 			= @$admindil['txt15_1'];
		$admindilduzenle= "active";
		$dilshow		= "show";
		break;
		
		case 'yonetici-ekle';
		$title 			= @$admindil['txt94'];
		$yoneticiekle	= "active";
		$yoneticishow	= "show";
		break;
		
		case 'yonetici-listele';
		$title 			= @$admindil['txt95'];
		$yoneticilistele= "active";
		$yoneticishow	= "show";
		break;
		
		case 'mesajlar';
		$title 			= @$admindil['txt98'];
		$mesajlar		= "active";
		break;
		
		case 'bildirim-sablonlari';
		$title 				= @$admindil['txt32'];
		$bildirimsablonlari	= "active";
		$rehbershow			= "show";
		break;
		
		case 'sablon-duzenle';
		$title 				= @$admindil['txt33'];
		$bildirimsablonlari	= "active";
		$rehbershow			= "show";
		break;
		
		case 'not-defteri';
		$title 			= @$admindil['txt103'];
		$notdefteri		= "active";
		break;
		
		case 'rehberim';
		$title 			= @$admindil['txt27'];
		$rehberim		= "active";
		$rehbershow		= "show";
		break;
		
		case 'rehber-ekle';
		$title 		= @$admindil['txt29'];
		$rehberekle	= "active";
		$rehbershow	= "show";
		break;
		
		case 'toplu-email';
		$title 		= @$admindil['txt30'];
		$topluemail	= "active";
		$rehbershow	= "show";
		break;
		
		case 'toplu-sms';
		$title 		= @$admindil['txt31'];
		$toplusms	= "active";
		$rehbershow	= "show";
		break;
		
		case 'proje-kategoriler';
		$title 				= @$admindil['txt47'];
		$proje_kategori		= "active";
		$projeshow			= "show";
		break;
		
		case 'proje-kategori-ekle';
		$title 				= @$admindil['txt46'];
		$proje_kategori		= "active";
		$projeshow			= "show";
		break;
		
		case 'projeler';
		$title 				= @$admindil['txt44'];
		$projeler			= "active";
		$projeshow			= "show";
		break;
		
		case 'proje-ekle';
		$title 				= @$admindil['txt43'];
		$projeler			= "active";
		$projeshow			= "show";
		break;
		
		case 'paket-kategoriler';
		$title 				= @$admindil['txt128'];
		$paket_kategori		= "active";
		$paketshow			= "show";
		break;
		
		case 'paket-kategori-ekle';
		$title 				= @$admindil['txt127'];
		$paket_kategori		= "active";
		$paketshow			= "show";
		break;
		
		case 'paketler';
		$title 				= @$admindil['txt125'];
		$paketler			= "active";
		$paketshow			= "show";
		break;
		
		case 'paket-ekle';
		$title 				= @$admindil['txt126'];
		$paketler			= "active";
		$paketshow			= "show";
		break;

		case 'galeri-ekle';
		$title 			= @$admindil['txt86'];
		$galeriekle		= "active";
		$galerishow		= "show";
		break;

		case 'galeri-listele';
		$title 			= @$admindil['txt87'];
		$galerilistele	= "active";
		$galerishow		= "show";
		break;
		
		case 'fotograflar';
		$title 			= @$admindil['txt88_1'];
		$galerilistele	= "active";
		$galerishow		= "show";
		break;
		
		case 'video-ekle';
		$title 			= @$admindil['txt90'];
		$videoekle		= "active";
		$videoshow		= "show";
		break;

		case 'video-listele';
		$title 			= @$admindil['txt91'];
		$videolistele	= "active";
		$videoshow		= "show";
		break;
		
		case 'ekip-listele';
		$title 				= @$admindil['txt121'];
		$ekiplistele		= "active";
		$ekipshow			= "show";
		break;
		
		case 'ekip-ekle';
		$title 				= @$admindil['txt120'];
		$ekipekle			= "active";
		$ekipshow			= "show";
		break;
		
		case 'emlak-kategoriler';
		$title 				= @$admindil['txt62'];
		$emlak_kategori		= "active";
		$emlakshow			= "show";
		break;
		
		case 'emlak-kategori-ekle';
		$title 				= @$admindil['txt61'];
		$emlak_kategori		= "active";
		$emlakshow			= "show";
		break;
		
		case 'emlaklar';
		$title 				= @$admindil['txt59'];
		$emlaklar			= "active";
		$emlakshow			= "show";
		break;
		
		case 'emlak-ekle';
		$title 				= @$admindil['txt60'];
		$emlaklar			= "active";
		$emlakshow			= "show";
		break;
		
		case 'emlaklar-excel';
		$title 			= @$admindil['txt138'];
		$emlaklar		= "active";
		$emlakshow		= "show";
		break;
		
		case 'emlaklar-resim-excel';
		$title 			= @$admindil['txt139'];
		$emlaklar		= "active";
		$emlakshow		= "show";
		break;
		
		case 'varyant-kategori';
		$title 				= @$admindil['txt141'];
		$varyant_kategori	= "active";
		$emlakshow			= "show";
		break;
		
		case 'varyant-degerler';
		$title 				= @$admindil['txt142'];
		$varyant_kategori	= "active";
		$emlakshow			= "show";
		break;
		
		case 'ozellik-gruplari';
		$title 				= @$admindil['txt64'];
		$ozellik_gruplari	= "active";
		$emlakshow			= "show";
		break;
		
		case 'ozellik-degerleri';
		$title 				= @$admindil['txt65'];
		$ozellik_gruplari	= "active";
		$emlakshow			= "show";
		break;
		
		case 'referans-ekle';
		$title 				= @$admindil['txt68'];
		$referansekle		= "active";
		$referansshow		= "show";
		break;
		
		case 'referans-listele';
		$title 				= @$admindil['txt69'];
		$referanslistele	= "active";
		$referansshow		= "show";
		break;
		
		case 'belge-ekle';
		$title 			= @$admindil['txt72'];
		$belgeekle		= "active";
		$belgeshow		= "show";
		break;
		
		case 'belge-listele';
		$title 			= @$admindil['txt73'];
		$belgelistele	= "active";
		$belgeshow		= "show";
		break;
		
		case 'soru-ekle';
		$title 			= @$admindil['txt106'];
		$soruekle		= "active";
		$sorushow		= "show";
		break;

		case 'soru-listele';
		$title 			= @$admindil['txt107'];
		$sorulistele	= "active";
		$sorushow		= "show";
		break;
		
		case 'katalog-ekle';
		$title 			= @$admindil['txt110'];
		$katalogekle	= "active";
		$katalogshow	= "show";
		break;
		
		case 'katalog-listele';
		$title 			= @$admindil['txt111'];
		$kataloglistele	= "active";
		$katalogshow	= "show";
		break;
		
		case 'bayi-ekle';
		$title 		= @$admindil['txt114'];
		$bayiekle	= "active";
		$bayishow	= "show";
		break;
		
		case 'bayi-listele';
		$title 			= @$admindil['txt115'];
		$bayilistele	= "active";
		$bayishow		= "show";
		break;
		
		case 'ebulten';
		$title 			= @$admindil['txt75'];
		$ebulten		= "active";
		break;
		
		case 'teklif-formu';
		$title 			= @$admindil['txt76'];
		$teklifformu	= "active";
		break;
		
		case 'insan-kaynaklari';
		$title 				= @$admindil['txt35'];
		$insankaynaklari	= "active";
		break;
		
		case 'yorumlar';
		$title 			= @$admindil['txt117'];
		$yorumlar		= "active";
		break;
		
		case 'destek-merkezi';
		$title 			= @$admindil['txt131'];
		$destekmerkezi	= "active";
		break;
		
		case 'destek';
		$title 			= @$admindil['txt132'];
		$destekmerkezi	= "active";
		break;
		
		case 'banka-hesap-ekle';
		$title 			= @$admindil['txt135'];
		$bankahesapekle	= "active";
		$bankahesapshow	= "show";
		break;
		
		case 'banka-hesaplari';
		$title 			= @$admindil['txt136'];
		$bankahesaplari	= "active";
		$bankahesapshow	= "show";
		break;
		
		case 'tum-musteriler';
		$title 			= @$admindil['txt143'];
		$tummusteriler	= "active";
		$rehbershow		= "show";
		break;
		
		case 'engellenen-musteriler';
		$title 					= @$admindil['txt144'];
		$engellenenmusteriler	= "active";
		$rehbershow				= "show";
		break;
		
		case 'musteri-ekle';
		$title 			= @$admindil['txt147'];
		$musteriekle	= "active";
		$rehbershow		= "show";
		break;
		
		case 'musteri-duzenle';
		$title 			= @$admindil['txt146'];
		$musteriduzenle	= "active";
		$rehbershow		= "show";
		break;
		
		case 'indirim-kuponlari';
		$title 				= @$admindil['txt148'];
		$indirimkuponlari	= "active";
		break;
		
		case 'odeme-bekleyen-siparisler';
		$title 			= @$admindil['txt151'];
		$odeme_bekleyen_siparisler	= "active";
		$siparisshow		= "show";
		break;
		
		case 'tum-siparisler';
		$title 			= @$admindil['txt152'];
		$tum_siparisler	= "active";
		$siparisshow		= "show";
		break;
		
		case 'siparis-formu';
		$title 			= @$admindil['txt153'];
		$siparis_formu	= "active";
		$siparisshow	= "show";
		break;
		
		case 'siparis-detay';
		$title 			= @$admindil['txt154'];
		$siparisdetay	= "active";
		$siparisshow	= "show";
		break;
		
		case 'il-ekle';
		$title 			= "İl Ekle / Düzenle";
		$ilekle			= "active";
		$ililceshow		= "show";
		break;
		
		case 'iller';
		$title 			= "İller";
		$iller			= "active";
		$ililceshow		= "show";
		break;
		
		case 'ilceler';
		$title 			= "İlçeler";
		$iller			= "active";
		$ililceshow		= "show";
		break;
		
		case 'semtler';
		$title 			= "Semtler";
		$iller			= "active";
		$ililceshow		= "show";
		break;
		
		case '404';
		$title 			= "404 Sayfa Bulunamadı";
		break;		
					
		default:
		$title 		= "Yönetim Paneli";
		$anasayfa 	= "active";
	}
}
else
{
	$title 		= "Yönetim Paneli";
	$anasayfa 	= "active";
}
?> 