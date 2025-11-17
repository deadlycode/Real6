<?php


echo !defined("GUVENLIK") ? exit : NULL;
oturumkontrol($url);
if (isset($_GET["islem"]) == "duzenle") {
    $durum = "duzenle";
    $Sorgu = $db->prepare("SELECT * FROM slider WHERE id = ?");
    $Sorgu->execute([$_GET["id"]]);
    if ($Sorgu->rowCount()) {
        $Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
    } else {
        header("Location:" . $url . "/404" . $html . "");
        exit;
    }
}
echo "<div class=\"page-header\">\r\n\t<div class=\"page-title mt-0 mb-0\">\r\n\t\t<h3>";
echo $admindil["txt82"];
echo "</h3>\r\n\t\t<div class=\"crumbs\">\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\n\t\t\t\t<li><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt81"];
echo "</a></li>\r\n\t\t\t\t<li class=\"active\"><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt82"];
echo "</a></li>\r\n\t\t\t</ul>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n<div class=\"row\">\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\n\t\t<div class=\"card\">\r\n\t\t\t<div class=\"card-body\">\r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\">\r\n\t\t\t\t<input id=\"id\" name=\"id\" type=\"hidden\" value=\"";
echo $Sonuc["id"];
echo "\">\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"sira\">Slayt Sıra Nosu</label>\r\n\t\t\t\t\t\t<input type=\"number\" class=\"form-control form-control-sm\" name=\"sira\" id=\"sira\" min=\"0\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["sira"] : "";
echo "\" />\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"adi\">Slayt Başlığı</label>\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"adi\" id=\"adi\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["adi"] : "";
echo "\" />\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<!--\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"url\">Slayt URL</label>\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"url\" id=\"url\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["url"] : "";
echo "\" />\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t\r\n\t\t\t\t\t-->\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<div class=\"form-check\">\r\n\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"sekme\" class=\"form-check-input\" ";
if ($Sonuc["sekme"] == "1") {
    echo " checked ";
}
echo ">Tıklandığında yeni sekmeye gitsin mi ?<i class=\"input-helper\"></i></label>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t";
    if ($Sonuc["resim"]) {
        echo "\t\t\t\t\t\t<div class=\"form-group row col-md-2\">\r\n\t\t\t\t\t\t\t<div id=\"lightgallery\" class=\"row lightGallery\">\r\n\t\t\t\t\t\t\t\t<a href=\"../";
        echo tema;
        echo "/uploads/slider/";
        echo $Sonuc["resim"];
        echo "\"><img src=\"../";
        echo tema;
        echo "/uploads/slider/";
        echo $Sonuc["resim"];
        echo "\" class=\"img-responsive img-thumbnail\" style=\"margin-bottom:2px;width:100%;\"></a>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t<a style=\"width: 100%;\" class=\"btn btn-danger btn-sm popconfirm\" title=\"Resim Sil\" href=\"../_class/yonetim_islem.php?sliderresimsil=ok&sid=";
        echo $Sonuc["id"];
        echo "\"><i class=\"fal fa-trash\"></i> Resim Sil</a>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t";
    }
    echo "\t\t\t\t\t\t\t\r\n\t\t\t\t\t";
}
echo "\t\t\t\t\t<div class=\"form-group row col-md-6\">\r\n\t\t\t\t\t<label>Slayt Görseli Seçiniz</label>\r\n\t\t\t\t\t\t<input type=\"file\" name=\"resim\" class=\"file-upload-default\">\r\n\t\t\t\t\t\t<div class=\"input-group col-xs-12\">\r\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control file-upload-info form-control-sm\" disabled=\"\" placeholder=\"Resim dosyası seçiniz\">\r\n\t\t\t\t\t\t\t<span class=\"input-group-append\">\r\n\t\t\t\t\t\t\t\t<button class=\"file-upload-browse btn btn-primary btn-sm\" type=\"button\"><i class=\"icon-cloud-upload font-12\"></i> Dosya Seç</button>\r\n\t\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label class=\"d-block\" for=\"durum\">Durum</label>\r\n\t\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\t\t\t\t\t\t<label class=\"switch\">\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"durum\" id=\"durum\" value=\"1\" ";
    if ($Sonuc["durum"] == "1") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\n\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t";
} else {
    echo "\t\t\t\t\t\t<label class=\"switch\">\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"durum\" id=\"durum\" value=\"1\" checked>\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\n\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t";
}
echo "\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<!--\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"adi\">Açıklama</label>\r\n\t\t\t\t\t\t<textarea class=\"form-control\" name=\"aciklama\">";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["aciklama"] : "";
echo "</textarea>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t-->\r\n\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\t\t\t\t\t<button type=\"submit\" name=\"slider_guncelle\" class=\"btn btn-success btn-icon-text btn-sm\">\r\n\t\t\t\t\t\t<i class=\"mdi mdi-reload  btn-icon-prepend\"></i>                                                    \r\n\t\t\t\t\t\tGÜNCELLE\r\n\t\t\t\t\t</button>\r\n\t\t\t\t\t";
} else {
    echo "\t\t\t\t\t<button type=\"submit\" name=\"slider_ekle\" class=\"btn btn-primary btn-icon-text btn-sm\">\r\n\t\t\t\t\t\t<i class=\"mdi mdi-file-check btn-icon-prepend\"></i>\r\n\t\t\t\t\t\tKAYDET\r\n\t\t\t\t\t</button>\r\n\t\t\t\t\t";
}
echo "\t\t\t\t</form>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n\r\n</div>\r\n";
mesaj("slider_ekle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("slider_guncelle", 1, "yes", "Başarı ile guncellenmiştir.");
mesaj("slider_guncelle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("sliderresimsil", 1, "yes", "Başarı ile siinmiştir.");
mesaj("sliderresimsil", 2, "no", "Hata oluştu tekrar deneyiniz.!");

echo "\t";

?>