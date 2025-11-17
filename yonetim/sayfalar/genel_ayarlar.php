<?php


echo !defined("GUVENLIK") ? exit : NULL;
oturumkontrol($url);
$ayar_dizi = $db->prepare("SELECT * FROM ayarlar WHERE id = ?");
$ayar_dizi->execute([1]);
if ($ayar_dizi->rowCount()) {
    $Sonuc = $ayar_dizi->fetch(PDO::FETCH_ASSOC);
    echo " \r\n<div class=\"page-header\">\r\n\t<div class=\"page-title mt-0 mb-0\">\r\n\t\t<h3>";
    echo $admindil["txt3"];
    echo "</h3>\r\n\t\t<div class=\"crumbs\">\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\n\t\t\t\t<li><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt2"];
    echo "</a></li>\r\n\t\t\t\t<li class=\"active\"><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt3"];
    echo "</a></li>\r\n\t\t\t</ul>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n<div class=\"row\">\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\n\t\t<div class=\"card\">\r\n\t\t\t<div class=\"card-body\">\t\t\t\t\t\t\t\t\r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\">\r\n\t\t\t\t<div class=\"row\">\r\n\t\t\t\t\t<div class=\"col-md-3\">\r\n\t\t\t\t\t\t<div class=\"card mb-4\">\r\n\t\t\t\t\t\t\t<div class=\"card-header\">\r\n\t\t\t\t\t\t\t\tLogo Yükle\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t<div class=\"card-body\">\r\n\t\t\t\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t\t\t<label>Logo</label>\r\n\t\t\t\t\t\t\t\t\t<input type=\"file\" name=\"resim\" class=\"file-upload-default\">\r\n\t\t\t\t\t\t\t\t\t<div class=\"input-group col-xs-12\">\r\n\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control file-upload-info form-control-sm\" disabled=\"\" placeholder=\"Resim dosyası seçiniz\">\r\n\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-append\">\r\n\t\t\t\t\t\t\t\t\t\t\t<button class=\"file-upload-browse btn btn-primary btn-sm\" type=\"button\"><i class=\"icon-cloud-upload font-12\"></i> Dosya Seç</button>\r\n\t\t\t\t\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t";
    if ($Sonuc["firma_logo"]) {
        echo "\t\t\t\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t\t\t\t<div id=\"lightgallery\" class=\"row lightGallery\">\r\n\t\t\t\t\t\t\t\t\t\t<a class=\"mx-auto\" href=\"../";
        echo tema;
        echo "/uploads/logo/";
        echo $Sonuc["firma_logo"];
        echo "\"><img src=\"../";
        echo tema;
        echo "/uploads/logo/";
        echo $Sonuc["firma_logo"];
        echo "\" style=\"max-height:70px;height:70px;\"></a>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t";
    }
    echo "\t\t\t\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"col-md-3\">\r\n\t\t\t\t\t\t<div class=\"card mb-4\">\r\n\t\t\t\t\t\t\t<div class=\"card-header\">\r\n\t\t\t\t\t\t\t\tMail Şablonu ve Footer logo yükle\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t<div class=\"card-body\">\r\n\t\t\t\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t\t\t\t<label>Logo Yükle</label>\r\n\t\t\t\t\t\t\t\t\t<input type=\"file\" name=\"footer\" class=\"file-upload-default\">\r\n\t\t\t\t\t\t\t\t\t<div class=\"input-group col-xs-12\">\r\n\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control file-upload-info form-control-sm\" disabled=\"\" placeholder=\"Resim dosyası seçiniz\">\r\n\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-append\">\r\n\t\t\t\t\t\t\t\t\t\t\t<button class=\"file-upload-browse btn btn-primary btn-sm\" type=\"button\"><i class=\"icon-cloud-upload font-12\"></i> Dosya Seç</button>\r\n\t\t\t\t\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\t\r\n\t\t\t\t\t\t\t\t";
    if ($Sonuc["firma_footerlogo"]) {
        echo "\t\t\t\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t\t\t\t<div id=\"lightgallery\" class=\"row lightGallery\">\r\n\t\t\t\t\t\t\t\t\t\t<a class=\"mx-auto\" href=\"../";
        echo tema;
        echo "/uploads/logo/footer/";
        echo $Sonuc["firma_footerlogo"];
        echo "\"><img src=\"../";
        echo tema;
        echo "/uploads/logo/footer/";
        echo $Sonuc["firma_footerlogo"];
        echo "\" style=\"max-height:70px;height:70px;\"></a>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t";
    }
    echo "\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"col-md-3\">\r\n\t\t\t\t\t\t<div class=\"card mb-4\">\r\n\t\t\t\t\t\t\t<div class=\"card-header\">\r\n\t\t\t\t\t\t\t\tFavicon Yükle\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t<div class=\"card-body\">\r\n\t\t\t\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t\t\t\t<label>Favicon</label>\r\n\t\t\t\t\t\t\t\t\t<input type=\"file\" name=\"favicon\" class=\"file-upload-default\">\r\n\t\t\t\t\t\t\t\t\t<div class=\"input-group col-xs-12\">\r\n\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control file-upload-info form-control-sm\" disabled=\"\" placeholder=\"Resim dosyası seçiniz\">\r\n\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-append\">\r\n\t\t\t\t\t\t\t\t\t\t\t<button class=\"file-upload-browse btn btn-primary btn-sm\" type=\"button\"><i class=\"icon-cloud-upload font-12\"></i> Dosya Seç</button>\r\n\t\t\t\t\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t";
    if ($Sonuc["favicon"]) {
        echo "\t\t\t\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t\t\t\t<div id=\"lightgallery\" class=\"row lightGallery\">\r\n\t\t\t\t\t\t\t\t\t\t<a class=\"mx-auto\" href=\"../";
        echo tema;
        echo "/uploads/favicon/";
        echo $Sonuc["favicon"];
        echo "\"><img src=\"../";
        echo tema;
        echo "/uploads/favicon/";
        echo $Sonuc["favicon"];
        echo "\" style=\"max-height:70px;height:70px;\"></a>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t";
    }
    echo "\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"col-md-3\">\r\n\t\t\t\t\t\t<div class=\"card mb-4\">\r\n\t\t\t\t\t\t\t<div class=\"card-header\">\r\n\t\t\t\t\t\t\t\tWatermark\r\n\t\t\t\t\t\t\t</div> \r\n\t\t\t\t\t\t\t<div class=\"card-body\">\r\n\t\t\t\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t\t\t\t<label>Watermark Resmi</label>\r\n\t\t\t\t\t\t\t\t\t<input type=\"file\" name=\"watermark\" class=\"file-upload-default\">\r\n\t\t\t\t\t\t\t\t\t<div class=\"input-group col-xs-12\">\r\n\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control file-upload-info form-control-sm\" disabled=\"\" placeholder=\"Resim dosyası seçiniz\">\r\n\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-append\">\r\n\t\t\t\t\t\t\t\t\t\t\t<button class=\"file-upload-browse btn btn-primary btn-sm\" type=\"button\"><i class=\"icon-cloud-upload font-12\"></i> Dosya Seç</button>\r\n\t\t\t\t\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t";
    if ($Sonuc["watermark"]) {
        echo "\t\t\t\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t\t\t\t<div id=\"lightgallery\" class=\"row lightGallery\">\r\n\t\t\t\t\t\t\t\t\t\t<a class=\"mx-auto\" href=\"../";
        echo tema;
        echo "/uploads/watermark/";
        echo $Sonuc["watermark"];
        echo "\"><img src=\"../";
        echo tema;
        echo "/uploads/watermark/";
        echo $Sonuc["watermark"];
        echo "\" style=\"max-height:70px;\"></a>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t";
    }
    echo "\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"row grid-margin\">\r\n\t\t\t\t\t\t<div class=\"col-12\">\r\n\t\t\t\t\t\t\t<div class=\"card\">\r\n\t\t\t\t\t\t\t\t<div class=\"row\">\r\n\t\t\t\t\t\t\t\t\t<div class=\"col-lg-3 grid-margin grid-margin-lg-0\">\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"card-body\">\r\n\t\t\t\t\t\t\t\t\t\t\t<h4 class=\"card-title\">Renk 1 (Genel Renk)</h4>\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"renk1\" class=\"color-picker\" value=\"";
    echo $Sonuc["renk1"];
    echo "\" />\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t<div class=\"col-lg-3 grid-margin grid-margin-lg-0\">\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"card-body\">\r\n\t\t\t\t\t\t\t\t\t\t\t<h4 class=\"card-title\">Renk 2</h4>\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"renk2\" class=\"color-picker\" value=\"";
    echo $Sonuc["renk2"];
    echo "\" />\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t<div class=\"col-lg-3\">\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"card-body\">\r\n\t\t\t\t\t\t\t\t\t\t\t<h4 class=\"card-title\">Renk 3</h4>\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"renk3\" class=\"color-picker\" value=\"";
    echo $Sonuc["renk3"];
    echo "\" />\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t<div class=\"col-lg-3\">\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"card-body\">\r\n\t\t\t\t\t\t\t\t\t\t\t<h4 class=\"card-title\">Renk 4</h4>\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" name=\"renk4\" class=\"color-picker\" value=\"";
    echo $Sonuc["renk4"];
    echo "\" />\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"site_url\">Site Url</label>\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"site_url\" id=\"site_url\" value=\"";
    echo $Sonuc["site_url"];
    echo "\" />\r\n\t\t\t\t\t</div>\t\t\t\t\t\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"site_title\">Site Title</label>\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"site_title\" id=\"site_title\" value=\"";
    echo $Sonuc["site_baslik"];
    echo "\" />\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<!--\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"video\">Firma Tanıtım Video Url Linki <small></label>\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"video\" id=\"video\" value=\"";
    echo $Sonuc["video"];
    echo "\" />\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t-->\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"site_url\"><b>Yönetim Paneli Girişi Link Adresi (Örnek: xyonetim, ypanel, yadminx, Not: TR Karekter Kullanmayınız.!)</b></label>\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"yonetim\" id=\"yonetim\" value=\"";
    echo $Sonuc["yonetim"];
    echo "\" />\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"slider\">Slider Tipi</label>\r\n\t\t\t\t\t\t<select class=\"form-control form-control-sm\" name=\"slider\">\r\n\t\t\t\t\t\t\t<option value=\"0\" ";
    echo $Sonuc["slider"] == "0" ? "selected" : "";
    echo ">Contain (Slider Alanına Resmi Orjinal Boyutlarda Gösterir)</option>\r\n\t\t\t\t\t\t\t<option value=\"1\" ";
    echo $Sonuc["slider"] == "1" ? "selected" : "";
    echo ">Cover (Slider Alanına Resmi Doldurur)</option>\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t</select>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"tags\">SEO Kelimeler (Keywords) <small>(Kelimenin sonuna virgül koyunuz)</small></label>\r\n\t\t\t\t\t\t<input name=\"site_keyw\" id=\"tags\" value=\"";
    echo $Sonuc["site_keyw"];
    echo "\" />\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"maxlength-textarea\">SEO Açıklama (Description)</label>\r\n\t\t\t\t\t\t<textarea id=\"maxlength-textarea\" name=\"site_desc\" class=\"form-control\" maxlength=\"260\" rows=\"4\">";
    echo $Sonuc["site_desc"];
    echo "</textarea>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"copyright\">Copyright Metni</label>\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"copyright\" id=\"copyright\" value=\"";
    echo $Sonuc["copyright"];
    echo "\" />\r\n\t\t\t\t\t</div>\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t<button type=\"submit\" name=\"genel_ayarlar\" class=\"btn btn-success btn-icon-text btn-sm\">\r\n\t\t\t\t\t\t<i class=\"mdi mdi-spin mdi-loading\"></i>                                                   \r\n\t\t\t\t\t\tGÜNCELLE\r\n\t\t\t\t\t</button>\r\n\t\t\t\t</form>\t\t\t\t\t\t\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n\r\n</div>\r\n";
    mesaj("genel_ayarlar", 1, "yes", "Başarı ile guncellenmiştir.");
    mesaj("genel_ayarlar", 2, "no", "Hata oluştu tekrar deneyiniz.!");
    echo "\t\r\n";
    
} else {
    header("Location:" . $url . "/404" . $html . "");
    exit;
}

?>