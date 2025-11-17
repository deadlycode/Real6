<?php


echo !defined("GUVENLIK") ? exit : NULL;
echo "\r\n";
oturumkontrol($url);
$ayar_dizi = $db->prepare("SELECT * FROM sms WHERE id = ?");
$ayar_dizi->execute([1]);
if ($ayar_dizi->rowCount()) {
    $Sonuc = $ayar_dizi->fetch(PDO::FETCH_ASSOC);
    echo "\r\n<div class=\"page-header\">\r\r\n\t<div class=\"page-title mt-0 mb-0\">\r\r\n\t\t<h3>";
    echo $admindil["txt11"];
    echo "</h3>\r\r\n\t\t<div class=\"crumbs\">\r\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\r\n\t\t\t\t<li><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt2"];
    echo "</a></li>\r\r\n\t\t\t\t<li class=\"active\"><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt11"];
    echo "</a></li>\r\r\n\t\t\t</ul>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n</div>\r\r\n<div class=\"row\">\r\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\r\n\t\t<div class=\"card\">\r\r\n\t\t\t<div class=\"card-body\">\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\">\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"postUrl\">Post URL</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"postUrl\" id=\"postUrl\" value=\"";
    echo $Sonuc["postUrl"];
    echo "\" />\r\r\n\t\t\t\t\t</div>\t\t\t\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"KULLANICIADI\">Kullanıcı Adı</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"KULLANICIADI\" id=\"KULLANICIADI\" value=\"";
    echo $Sonuc["KULLANICIADI"];
    echo "\" />\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"SIFRE\">Api Secret</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"SIFRE\" id=\"SIFRE\" value=\"";
    echo $Sonuc["SIFRE"];
    echo "\" />\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"ORGINATOR\">Başlık</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"ORGINATOR\" id=\"ORGINATOR\" value=\"";
    echo $Sonuc["ORGINATOR"];
    echo "\" />\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"m_kime\">Mesajın Geleceği Telefon Numarası</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"m_kime\" id=\"m_kime\" value=\"";
    echo $Sonuc["m_kime"];
    echo "\" />\r\r\n\t\t\t\t\t</div>\t\r\r\n\t\t\t\t\t<p class=\"mb-2\"><strong>Not: Sistemde <a target=\"_blank\" href=\"http://bizimsms.mobi/\">bizimsms</a> apileri mevcuttur. Farklı bir api entegrasyonu için bizimle iletişime geçiniz.</strong></p>\t\t\t\t\t\r\r\n\t\t\t\t\t<button type=\"submit\" name=\"sms_ayarlar\" class=\"btn btn-success btn-icon-text btn-sm\">\r\r\n\t\t\t\t\t\t<i class=\"mdi mdi-spin mdi-loading\"></i>                                                   \r\r\n\t\t\t\t\t\tGÜNCELLE\r\r\n\t\t\t\t\t</button>\r\r\n\t\t\t\t</form>\r\r\n\t\t\t</div>\t\t\t\t\t\t\t\t\t\t\t\t\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n\r\r\n</div>\r\r\n";
    mesaj("sms_ayarlar", 1, "yes", "Başarı ile guncellenmiştir.");
    mesaj("sms_ayarlar", 2, "no", "Hata oluştu tekrar deneyiniz.!");
    echo "\t\r\r\n";
    
} else {
    header("Location:" . $url . "/404" . $html . "");
    exit;
}

?>