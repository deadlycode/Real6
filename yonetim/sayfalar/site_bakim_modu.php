<?php


echo !defined("GUVENLIK") ? exit : NULL;
oturumkontrol($url);
$ayar_dizi = $db->prepare("SELECT * FROM bakim_modu WHERE id = ?");
$ayar_dizi->execute([1]);
if ($ayar_dizi->rowCount()) {
    $Sonuc = $ayar_dizi->fetch(PDO::FETCH_ASSOC);
    echo " \r\n<div class=\"page-header\">\r\n\t<div class=\"page-title mt-0 mb-0\">\r\n\t\t<h3>";
    echo $admindil["txt9"];
    echo "</h3>\r\n\t\t<div class=\"crumbs\">\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\n\t\t\t\t<li><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt2"];
    echo "</a></li>\r\n\t\t\t\t<li class=\"active\"><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt9"];
    echo "</a></li>\r\n\t\t\t</ul>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n<div class=\"row\">\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\n\t\t<div class=\"card\">\r\n\t\t\t<div class=\"card-body\">\t\t\r\n<center><b style=\"color:red; font-size: 14px;\" >Site bakım modunu eğer yönetim paneline giriş yapmışsanız göremezsiniz. (Bu şekilde yönetim panelinde yapmış olduğunuz değişiklikleri bakım modunu kapatmadan görebileceksiniz.!)</b></center></br>\t\t\t\r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\">\r\n\t\t\t\t\t<div class=\"row\">\t\t\t\t\t\r\n\t\t\t\t\t\t<div class=\"col-md-6\">\r\n\t\t\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t\t\t<label for=\"site_url\">Site Açılış Tarihi</label>\r\n\t\t\t\t\t\t\t\t<div id=\"datepicker-popup\" class=\"input-group date datepicker\">\r\n\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"acilis_tarih\" value=\"";
    echo $Sonuc["acilis_tarih"];
    echo "\" />\r\n\t\t\t\t\t\t\t\t\t<span class=\"input-group-addon input-group-append border-left\">\r\n\t\t\t\t\t\t\t\t\t\t<span class=\"mdi mdi-calendar input-group-text\"></span>\r\n\t\t\t\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\t\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t<div class=\"col-md-6\">\r\n\t\t\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t\t\t<label for=\"site_url\">Site Açılış Zamanı</label>\r\n\t\t\t\t\t\t\t\t<div class=\"input-group date\" id=\"timepicker-example\" data-target-input=\"nearest\">\r\n\t\t\t\t\t\t\t\t\t<div class=\"input-group\" data-target=\"#timepicker-example\" data-toggle=\"datetimepicker\">\r\n\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"acilis_zaman\" class=\"form-control datetimepicker-input\" value=\"";
    echo $Sonuc["acilis_zaman"];
    echo "\" data-target=\"#timepicker-example\" />\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"input-group-addon input-group-append\"><i class=\"mdi mdi-clock input-group-text\"></i></div>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\t\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"baslik\">Başlık</label>\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"baslik\" id=\"baslik\" value=\"";
    echo $Sonuc["baslik"];
    echo "\" />\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"aciklama\">Açıklama</label>\r\n\t\t\t\t\t\t<textarea id=\"aciklama\" name=\"aciklama\" class=\"form-control\" rows=\"4\">";
    echo $Sonuc["aciklama"];
    echo "</textarea>\r\n\t\t\t\t\t</div>\t\t\t\t\t\t\t\r\n\t\t\t\t\t<button type=\"submit\" name=\"site_bakim_modu\" class=\"btn btn-success btn-icon-text btn-sm\">\r\n\t\t\t\t\t\t<i class=\"mdi mdi-spin mdi-loading\"></i>                                                   \r\n\t\t\t\t\t\tGÜNCELLE\r\n\t\t\t\t\t</button>\r\n\t\t\t\t</form>\t\t\t\t\t\t\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n";
    mesaj("site_bakim_modu", 1, "yes", "Başarı ile guncellenmiştir.");
    mesaj("site_bakim_modu", 2, "no", "Hata oluştu tekrar deneyiniz.!");
    echo "\t\r\n";
    
} else {
    header("Location:" . $url . "/404" . $html . "");
    exit;
}

?>