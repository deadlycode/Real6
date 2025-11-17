<?php


echo !defined("GUVENLIK") ? exit : NULL;
echo "\r\n";
oturumkontrol($url);
if (isset($_GET["islem"]) == "duzenle") {
    $durum = "duzenle";
    $Sorgu = $db->prepare("SELECT * FROM sayfalar WHERE id = ?");
    $Sorgu->execute([$_GET["id"]]);
    if ($Sorgu->rowCount()) {
        $Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
    } else {
        header("Location:" . $url . "/404" . $html . "");
        exit;
    }
}
echo "\r\n<div class=\"page-header\">\r\r\n\t<div class=\"page-title mt-0 mb-0\">\r\r\n\t\t<h3>";
echo $admindil["txt50"];
echo "</h3>\r\r\n\t\t<div class=\"crumbs\">\r\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\r\n\t\t\t\t<li><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt49"];
echo "</a></li>\r\r\n\t\t\t\t<li class=\"active\"><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt50"];
echo "</a></li>\r\r\n\t\t\t</ul>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n</div>\r\r\n<div class=\"row\">\r\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\r\n\t\t<div class=\"card\">\r\r\n\t\t\t<div class=\"card-body\">\r\r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\">\r\r\n\t\t\t\t<input id=\"id\" name=\"id\" type=\"hidden\" value=\"";
echo $Sonuc["id"];
echo "\">\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"adi\">Başlık</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"adi\" id=\"adi\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["adi"] : "";
echo "\" />\r\r\n\t\t\t\t\t</div>\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t";
    if ($Sonuc["resim"]) {
        echo "\r\n\t\t\t\t\t\t<div class=\"form-group row col-md-2\">\r\r\n\t\t\t\t\t\t\t<div id=\"lightgallery\" class=\"row lightGallery\">\r\r\n\t\t\t\t\t\t\t\t<a href=\"../";
        echo tema;
        echo "/uploads/sayfalar/";
        echo $Sonuc["resim"];
        echo "\"><img src=\"../";
        echo tema;
        echo "/uploads/sayfalar/";
        echo $Sonuc["resim"];
        echo "\" class=\"img-responsive img-thumbnail\" style=\"margin-bottom:2px;width:100%;\"></a>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t<a style=\"width: 100%;\" class=\"btn btn-danger btn-sm popconfirm\" title=\"Resim Sil\" href=\"../_class/yonetim_islem.php?sayfaresimsil=ok&sid=";
        echo $Sonuc["id"];
        echo "\"><i class=\"fal fa-trash\"></i> Resim Sil</a>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t";
    }
    echo "\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t";
}
echo "\r\n\t\t\t\t\t<div class=\"form-group row col-md-6\">\r\r\n\t\t\t\t\t<label>Sayfa Resmi</label>\r\r\n\t\t\t\t\t\t<input type=\"file\" name=\"resim\" class=\"file-upload-default\">\r\r\n\t\t\t\t\t\t<div class=\"input-group col-xs-12\">\r\r\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control file-upload-info form-control-sm\" disabled=\"\" placeholder=\"Resim dosyası seçiniz\">\r\r\n\t\t\t\t\t\t\t<span class=\"input-group-append\">\r\r\n\t\t\t\t\t\t\t\t<button class=\"file-upload-browse btn btn-primary btn-sm\" type=\"button\"><i class=\"icon-cloud-upload font-12\"></i> Dosya Seç</button>\r\r\n\t\t\t\t\t\t\t</span>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group row col-md-6\">\r\r\n\t\t\t\t\t\t<label for=\"sayfa\">Bağlantı Sayfası</label>\r\r\n\t\t\t\t\t\t<select class=\"js-example-basic-single form-control-sm w-100\" name=\"sayfa\" id=\"sayfa\" required>\r\r\n\t\t\t\t\t\t\t<option value=\"0\" ";
echo $Sonuc["sayfa"] == "0" ? "selected" : "";
echo ">Genel</option>\r\r\n\t\t\t\t\t\t\t<option value=\"1\" ";
echo $Sonuc["sayfa"] == "1" ? "selected" : "";
echo ">İş Başvurusu</option>\r\r\n\t\t\t\t\t\t\t";
if ($moduller["alan18"] == "1") {
    echo "\r\n\t\t\t\t\t\t\t<option value=\"2\" ";
    echo $Sonuc["sayfa"] == "2" ? "selected" : "";
    echo ">Üyelik Sözleşme</option>\r\r\n\t\t\t\t\t\t\t";
}
echo "\r\n\t\t\t\t\t\t\t";
if ($moduller["alan23"] == "1") {
    echo "\r\n\t\t\t\t\t\t\t<option value=\"3\" ";
    echo $Sonuc["sayfa"] == "3" ? "selected" : "";
    echo ">Ödeme Sözleşme</option>\r\r\n\t\t\t\t\t\t\t";
}
echo "\r\n\t\t\t\t\t\t</select>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group mb-2\">\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\r\n\t\t\t\t\t\t<label class=\"switch\">\r\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"durum\" id=\"durum\" value=\"1\" ";
    if ($Sonuc["durum"] == "1") {
        echo " checked ";
    }
    echo ">\r\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\r\n\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t";
} else {
    echo "\r\n\t\t\t\t\t\t<label class=\"switch\">\r\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"durum\" id=\"durum\" value=\"1\" checked>\r\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\r\n\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t";
}
echo "\r\n\t\t\t\t\t\t<label class=\"d-inline-block\" style=\"line-height: 34px;\" for=\"durum\">Durum</label>\t\t\t\t\t\t\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\r\r\n\t\t\t\t\t<div class=\"form-group mb-2\">\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\r\n\t\t\t\t\t\t<label class=\"switch\">\r\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"anasayfa\" id=\"anasayfa\" value=\"1\" ";
    if ($Sonuc["anasayfa"] == "1") {
        echo " checked ";
    }
    echo ">\r\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\r\n\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t";
} else {
    echo "\r\n\t\t\t\t\t\t<label class=\"switch\">\r\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"anasayfa\" id=\"anasayfa\" value=\"1\">\r\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\r\n\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t";
}
echo "\r\n\t\t\t\t\t\t<label class=\"d-inline-block\" style=\"line-height: 34px;\" for=\"anasayfa\">Anasayfa'da Gözüksün mü ?</label>\t\t\t\t\t\t\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"adi\">İçerik</label>\r\r\n\t\t\t\t\t\t<textarea name=\"aciklama\" id=\"myTextarea\">";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["aciklama"] : "";
echo "</textarea>\r\r\n\t\t\t\t\t</div>\t\t\t\t\t\r\r\n\r\r\n\t\t\t\t\t<div class=\"card mb-4\">\r\r\n\t\t\t\t\t\t<div class=\"card-header\">\r\r\n\t\t\t\t\t\t\tSEO AYARLARI\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t<div class=\"card-body\">\r\r\n\t\t\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t\t\t<label for=\"maxlength-textarea\">Sayfa Açıklama (description)</label>\r\r\n\t\t\t\t\t\t\t\t<textarea id=\"maxlength-textarea\" name=\"description\"  class=\"form-control\" maxlength=\"260\" rows=\"4\">";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["description"] : "";
echo "</textarea>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t<div class=\"form-group mb-0\">\r\r\n\t\t\t\t\t\t\t\t<label for=\"tags\">Sayfa Meta <small>(Kelimenin sonuna virgül koyunuz)</small></label>\r\r\n\t\t\t\t\t\t\t\t<input name=\"keywords\" id=\"tags\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["keywords"] : "";
echo "\" />\r\r\n\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\r\n\t\t\t\t\t<button type=\"submit\" name=\"sayfa_guncelle\" class=\"btn btn-success btn-icon-text btn-sm\">\r\r\n\t\t\t\t\t\t<i class=\"mdi mdi-reload  btn-icon-prepend\"></i>                                                    \r\r\n\t\t\t\t\t\tGÜNCELLE\r\r\n\t\t\t\t\t</button>\r\r\n\t\t\t\t\t";
} else {
    echo "\r\n\t\t\t\t\t<button type=\"submit\" name=\"sayfa_ekle\" class=\"btn btn-primary btn-icon-text btn-sm\">\r\r\n\t\t\t\t\t\t<i class=\"mdi mdi-file-check btn-icon-prepend\"></i>\r\r\n\t\t\t\t\t\tKAYDET\r\r\n\t\t\t\t\t</button>\r\r\n\t\t\t\t\t";
}
echo "\r\n\t\t\t\t</form>\r\r\n\t\t\t</div>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n\r\r\n</div>\r\r\n";
mesaj("sayfa_ekle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("sayfa_guncelle", 1, "yes", "Başarı ile guncellenmiştir.");
mesaj("sayfa_guncelle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("sayfaresimsil", 1, "yes", "Başarı ile siinmiştir.");
mesaj("sayfaresimsil", 2, "no", "Hata oluştu tekrar deneyiniz.!");
echo "\t\r\r\n";


?>