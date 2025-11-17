<?php


echo !defined("GUVENLIK") ? exit : NULL;
oturumkontrol($url);
$ayar_dizi = $db->prepare("SELECT * FROM ayarlar WHERE id = ?");
$ayar_dizi->execute([1]);
if ($ayar_dizi->rowCount()) {
    $Sonuc = $ayar_dizi->fetch(PDO::FETCH_ASSOC);
    echo " \r\n<div class=\"page-header\">\r\n\t<div class=\"page-title mt-0 mb-0\">\r\n\t\t<h3>";
    echo $admindil["txt4"];
    echo "</h3>\r\n\t\t<div class=\"crumbs\">\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\n\t\t\t\t<li><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt2"];
    echo "</a></li>\r\n\t\t\t\t<li class=\"active\"><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt4"];
    echo "</a></li>\r\n\t\t\t</ul>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n<div class=\"row\">\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\n\t\t<div class=\"card\">\r\n\t\t\t<div class=\"card-body\">\r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/uptade.php\" enctype=\"multipart/form-data\">\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"whatsapp\">Whatsapp Kodu</label>\r\n\t\t\t\t\t\t<textarea id=\"whatsapp\" name=\"whatsapp\" class=\"w-100\">";
    echo $Sonuc["whatsapp"];
    echo "</textarea>\r\n\t\t\t\t\t</div>\t\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"google_analytics\">Google Analytics .js Kodu</label>\r\n\t\t\t\t\t\t<textarea id=\"google_analytics\" name=\"google_analytics\" class=\"w-100\">";
    echo $Sonuc["google_analytics"];
    echo "</textarea>\r\n\t\t\t\t\t</div>\t\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"dogrulama_kodu\">Webmaster Tools Site Doğrulama Kodu</label>\r\n\t\t\t\t\t\t<textarea id=\"dogrulama_kodu\" name=\"dogrulama_kodu\" class=\"w-100\">";
    echo $Sonuc["dogrulama_kodu"];
    echo "</textarea>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"google_maps\">İletişim Harita Embed Kodu</label>\r\n\t\t\t\t\t\t<textarea id=\"google_maps\" name=\"google_maps\" class=\"w-100\">";
    echo $Sonuc["google_maps"];
    echo "</textarea>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"canli_destek\">Canlı Destek Kodu</label>\r\n\t\t\t\t\t\t<textarea id=\"canli_destek\" name=\"canli_destek\" class=\"w-100\">";
    echo $Sonuc["canli_destek"];
    echo "</textarea>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"rcaptha\">Google Rcaptha Site Anahtar Kodu <a href=\"https://www.youtube.com/watch?v=eFgD_txPic0\" target=\"_blank\">Site key nasıl alınırz ? </a></label>\r\n\t\t\t\t\t\t<textarea id=\"rcaptha\" name=\"rcaptha\" class=\"w-100\">";
    echo $Sonuc["rcaptha"];
    echo "</textarea>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<button type=\"submit\" name=\"api_ayarlar\" class=\"btn btn-success btn-icon-text btn-sm\">\r\n\t\t\t\t\t\t<i class=\"mdi mdi-spin mdi-loading\"></i>                                                    \r\n\t\t\t\t\t\tGÜNCELLE\r\n\t\t\t\t\t</button>\r\n\t\t\t\t</form>\t\t\t\t\t\t\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n\r\n</div>\r\n";
    mesaj("api_ayarlar", 1, "yes", "Başarı ile guncellenmiştir.");
    mesaj("api_ayarlar", 2, "no", "Hata oluştu tekrar deneyiniz.!");
    echo "\t\r\n";
    
} else {
    header("Location:" . $url . "/404" . $html . "");
    exit;
}

?>