<?php


echo !defined("GUVENLIK") ? exit : NULL;
echo "\r\n";
oturumkontrol($url);
$ayar_dizi = $db->prepare("SELECT * FROM ayarlar WHERE id = ?");
$ayar_dizi->execute([1]);
if ($ayar_dizi->rowCount()) {
    $Sonuc = $ayar_dizi->fetch(PDO::FETCH_ASSOC);
    echo "\r\n<div class=\"page-header\">\r\r\n\t<div class=\"page-title mt-0 mb-0\">\r\r\n\t\t<h3>";
    echo $admindil["txt5"];
    echo "</h3>\r\r\n\t\t<div class=\"crumbs\">\r\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\r\n\t\t\t\t<li><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt2"];
    echo "</a></li>\r\r\n\t\t\t\t<li class=\"active\"><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt5"];
    echo "</a></li>\r\r\n\t\t\t</ul>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n</div>\r\r\n<div class=\"row\">\r\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\r\n\t\t<div class=\"card\">\r\r\n\t\t\t<div class=\"card-body\">\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\">\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"firma_adi\">Firma Ünvanı</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"firma_adi\" id=\"firma_adi\" value=\"";
    echo $Sonuc["firma_adi"];
    echo "\" />\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"firma_telefon\">Firma Telefon</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"firma_telefon\" id=\"firma_telefon\" value=\"";
    echo $Sonuc["firma_telefon"];
    echo "\" />\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"firma_fax\">Firma Fax</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"firma_fax\" id=\"firma_fax\" value=\"";
    echo $Sonuc["firma_fax"];
    echo "\" />\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"firma_email\">Firma E-Mail</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"firma_email\" id=\"firma_email\" value=\"";
    echo $Sonuc["firma_email"];
    echo "\" data-inputmask=\"'alias': 'email'\" />\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"firma_adres\">Firma Adres</label>\r\r\n\t\t\t\t\t\t<textarea class=\"form-control\" name=\"firma_adres\" id=\"firma_adres\" rows=\"4\">";
    echo $Sonuc["firma_adres"];
    echo "</textarea>\r\r\n\t\t\t\t\t</div>\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t<button type=\"submit\" name=\"iletisim_ayarlar\" class=\"btn btn-success btn-icon-text btn-sm\">\r\r\n\t\t\t\t\t\t<i class=\"mdi mdi-spin mdi-loading\"></i>                                                   \r\r\n\t\t\t\t\t\tGÜNCELLE\r\r\n\t\t\t\t\t</button>\r\r\n\t\t\t\t</form>\r\r\n\t\t\t</div>\t\t\t\t\t\t\t\t\t\t\t\t\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n\r\r\n</div>\r\r\n";
    mesaj("iletisim_ayarlar", 1, "yes", "Başarı ile guncellenmiştir.");
    mesaj("iletisim_ayarlar", 2, "no", "Hata oluştu tekrar deneyiniz.!");
    echo "\r\n\r\r\n";
    
} else {
    header("Location:" . $url . "/404" . $html . "");
    exit;
}

?>