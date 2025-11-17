<?php


echo !defined("GUVENLIK") ? exit : NULL;
oturumkontrol($url);
if (isset($_GET["islem"]) == "duzenle") {
    $durum = "duzenle";
    $Sorgu = $db->prepare("SELECT * FROM emlak_kategori WHERE id = ?");
    $Sorgu->execute([$_GET["id"]]);
    if ($Sorgu->rowCount()) {
        $Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
    } else {
        header("Location:" . $url . "/404" . $html . "");
        exit;
    }
}
echo "<div class=\"page-header\">\r\n\t<div class=\"page-title mt-0 mb-0\">\r\n\t\t<h3>";
echo $admindil["txt61"];
echo "</h3>\r\n\t\t<div class=\"crumbs\">\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\n\t\t\t\t<li><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt57"];
echo "</a></li>\r\n\t\t\t\t<li><a href=\"emlak-kategoriler";
echo $html;
echo "\">";
echo $admindil["txt62"];
echo "</a></li>\r\n\t\t\t\t<li class=\"active\"><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt61"];
echo "</a></li>\r\n\t\t\t</ul>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n<div class=\"row\">\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\n\t\t<div class=\"card\">\r\n\t\t\t<div class=\"card-body\">\r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\">\r\n\t\t\t\t<input id=\"id\" name=\"id\" type=\"hidden\" value=\"";
echo $Sonuc["id"];
echo "\">\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"sira\">Sıra</label>\r\n\t\t\t\t\t\t<input type=\"number\" min=\"0\" class=\"form-control form-control-sm\" name=\"sira\" id=\"sira\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["sira"] : "";
echo "\" />\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"ustid\">Üst Kategori Seç</label>\r\n\t\t\t\t\t\t<select class=\"js-example-basic-single form-control-sm\" name=\"ustid\" id=\"ustid\" required style=\"width:100%\">\r\n\t\t\t\t\t\t<option value=\"0\">Üst Kategori</option>\r\n\t\t\t\t\t\t";
kategori(0, 0, $Sonuc["ustid"]);
echo "\t\t\t\t\t\t</select>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"adi\">Başlık</label>\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"adi\" id=\"adi\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["adi"] : "";
echo "\" />\r\n\t\t\t\t\t</div>\r\n\r\n\t\t\t\t\t<!--\t\t\t\t\t\r\n\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\t\t\t\t\t<div class=\"row\">\r\n\t\t\t\t\t\t";
    if ($Sonuc["kapak"]) {
        echo "\t\t\t\t\t\t<div class=\"form-group col-md-2\">\r\n\t\t\t\t\t\t\t<img src=\"../";
        echo tema;
        echo "/uploads/kategoriler/";
        echo $Sonuc["kapak"];
        echo "\" class=\"img-responsive img-thumbnail\" style=\"margin-bottom:2px;width:100%;min-height:150px;\">\r\n\t\t\t\t\t\t\t<a style=\"width: 100%;\" class=\"btn btn-danger btn-sm popconfirm\" title=\"Görseli Sil\" href=\"../_class/yonetim_islem.php?kategoriresimsil=ok&sid=";
        echo $Sonuc["id"];
        echo "\"><i class=\"fas fa-trash\"></i> Görseli Sil</a>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t";
    }
    echo "\t\t\t\t\t</div>\r\n\t\t\t\t\t";
}
echo "\t\t\t\t\t<div class=\"form-group row col-md-6\">\r\n\t\t\t\t\t<label>Listeleme Görseli</label>\r\n\t\t\t\t\t\t<input type=\"file\" name=\"kapak\" class=\"file-upload-default\">\r\n\t\t\t\t\t\t<div class=\"input-group col-xs-12\">\r\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control file-upload-info form-control-sm\" disabled=\"\" placeholder=\"Resim dosyası seçiniz\">\r\n\t\t\t\t\t\t\t<span class=\"input-group-append\">\r\n\t\t\t\t\t\t\t\t<button class=\"file-upload-browse btn btn-primary btn-sm\" type=\"button\"><i class=\"icon-cloud-upload font-12\"></i> Dosya Seç</button>\r\n\t\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\t\r\n\t\t\t\t\t\r\n\t\t\t\t\t-->\r\n\t\t\t\t\t<div class=\"card mb-4\">\r\n\t\t\t\t\t\t<div class=\"card-header\">\r\n\t\t\t\t\t\t\tSEO AYARLARI\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t<div class=\"card-body\">\r\n\t\t\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t\t\t<label for=\"maxlength-textarea\">Sayfa Açıklama (description)</label>\r\n\t\t\t\t\t\t\t\t<textarea id=\"maxlength-textarea\" name=\"description\"  class=\"form-control\" maxlength=\"260\" rows=\"4\">";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["description"] : "";
echo "</textarea>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t<div class=\"form-group mb-0\">\r\n\t\t\t\t\t\t\t\t<label for=\"tags\">Sayfa Meta <small>(Kelimenin sonuna virgül koyunuz)</small></label>\r\n\t\t\t\t\t\t\t\t<input name=\"keywords\" id=\"tags\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["keywords"] : "";
echo "\" />\r\n\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group mb-2\">\t\t\t\t\t\t\r\n\t\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\t\t\t\t\t\t<label class=\"switch\">\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"durum\" id=\"durum\" value=\"1\" ";
    if ($Sonuc["durum"] == "1") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\n\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t";
} else {
    echo "\t\t\t\t\t\t<label class=\"switch\">\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"durum\" id=\"durum\" value=\"1\" checked>\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\n\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t";
}
echo "\t\t\t\t\t\t<label class=\"d-inline-block\" style=\"line-height: 34px;\" for=\"durum\">Durum</label>\t\t\t\t\t\t\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group mb-2\">\t\t\t\t\t\t\r\n\t\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\t\t\t\t\t\t<label class=\"switch\">\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"anasayfa\" id=\"anasayfa\" value=\"1\" ";
    if ($Sonuc["anasayfa"] == "1") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\n\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t";
} else {
    echo "\t\t\t\t\t\t<label class=\"switch\">\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"anasayfa\" id=\"anasayfa\" value=\"1\">\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\n\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t";
}
echo "\t\r\n\t\t\t\t\t\t<label class=\"d-inline-block\" style=\"line-height: 34px;\" for=\"anasayfa\">Anasayfa'da Gözüksün mü ?</label>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\t\t\t\t\t<button type=\"submit\" name=\"emlak_kategori_guncelle\" class=\"btn btn-success btn-icon-text btn-sm\">\r\n\t\t\t\t\t\t<i class=\"mdi mdi-reload  btn-icon-prepend\"></i>                                                    \r\n\t\t\t\t\t\tGÜNCELLE\r\n\t\t\t\t\t</button>\r\n\t\t\t\t\t";
} else {
    echo "\t\t\t\t\t<button type=\"submit\" name=\"emlak_kategori_ekle\" class=\"btn btn-primary btn-icon-text btn-sm\">\r\n\t\t\t\t\t\t<i class=\"mdi mdi-file-check btn-icon-prepend\"></i>\r\n\t\t\t\t\t\tKAYDET\r\n\t\t\t\t\t</button>\r\n\t\t\t\t\t";
}
echo "\t\t\t\t\t</div>\r\n\t\t\t\t</form>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n\r\n</div>\r\n";
mesaj("emlak_kategori_ekle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("emlak_kategori_guncelle", 1, "yes", "Başarı ile guncellenmiştir.");
mesaj("emlak_kategori_guncelle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("kategoriresimsil", 1, "yes", "Başarı ile siinmiştir.");
mesaj("kategoriresimsil", 2, "no", "Hata oluştu tekrar deneyiniz.!");


?>