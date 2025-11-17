<?php


echo !defined("GUVENLIK") ? exit : NULL;
oturumkontrol($url);
if (isset($_GET["islem"]) == "duzenle") {
    $durum = "duzenle";
    $Sorgu = $db->prepare("SELECT * FROM ekibimiz WHERE id = ?");
    $Sorgu->execute([$_GET["id"]]);
    if ($Sorgu->rowCount()) {
        $Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
    } else {
        header("Location:" . $url . "/404" . $html . "");
        exit;
    }
}
echo " \r\n<div class=\"page-header\">\r\n\t<div class=\"page-title mt-0 mb-0\">\r\n\t\t<h3>";
echo $admindil["txt120"];
echo "</h3>\r\n\t\t<div class=\"crumbs\">\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\n\t\t\t\t<li><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt119"];
echo "</a></li>\r\n\t\t\t\t<li class=\"active\"><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt120"];
echo "</a></li>\r\n\t\t\t</ul>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n<div class=\"row\">\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\n\t\t<div class=\"card\">\r\n\t\t\t<div class=\"card-body\">\r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\">\r\n\t\t\t\t<input id=\"id\" name=\"id\" type=\"hidden\" value=\"";
echo $Sonuc["id"];
echo "\">\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"sira\">Sıra</label>\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"sira\" id=\"sira\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["sira"] : "";
echo "\" />\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"adi\">Başlık</label>\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"adi\" id=\"adi\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["adi"] : "";
echo "\" />\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"row\">\t\t\t\t\t\t\r\n\t\t\t\t\t\t<div class=\"form-group col-md-4\">\r\n\t\t\t\t\t\t\t<label>Görevi <i class=\"icon-info text-info\" data-toggle=\"popover\" data-content=\"Tamamında büyük harf kullanmadan, ekip sahibinin görevi veya unvanını kısaca belirtin. Ör: Yönetim Kurulu Başkanı, Üye, Genel Müdür\" data-trigger=\"hover\" data-original-title=\"Görevi\"></i></label>\r\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"gorev\" id=\"gorev\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["gorev"] : "";
echo "\" />\r\n\t\t\t\t\t\t</div>\t\t\t\t\t\t<div class=\"form-group col-md-4\">\t\t\t\t\t\t\t<label>E-Posta <i class=\"icon-info text-info\" data-toggle=\"popover\" data-content=\"Bu seçeneği kullanmayacaksanız boş bırakınız\" data-trigger=\"hover\" data-original-title=\"E-mail\"></i></label>\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"email\" id=\"email\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["email"] : "";
echo "\" />\t\t\t\t\t\t</div>\t\t\t\t\t\t<div class=\"form-group col-md-4\">\t\t\t\t\t\t\t<label>Telefon <i class=\"icon-info text-info\" data-toggle=\"popover\" data-content=\"Bu seçeneği kullanmayacaksanız boş bırakınız\" data-trigger=\"hover\" data-original-title=\"Telefon\"></i></label>\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"telefon\" id=\"telefon\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["telefon"] : "";
echo "\" />\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\t\t\t\t\t\t\r\n\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\t\t\t\t\t<div class=\"row\">\r\n\t\t\t\t\t\t";
    if ($Sonuc["resim"]) {
        echo "\t\t\t\t\t\t<div class=\"form-group col-md-2\">\r\n\t\t\t\t\t\t\t<img src=\"../";
        echo tema;
        echo "/uploads/ekibimiz/";
        echo $Sonuc["resim"];
        echo "\" class=\"img-responsive img-thumbnail\" style=\"margin-bottom:2px;width:100%;min-height:150px;\">\r\n\t\t\t\t\t\t\t<a style=\"width: 100%;\" class=\"btn btn-danger btn-sm popconfirm\" title=\"Kapak Resmini Sil\" href=\"../_class/yonetim_islem.php?ekipresimsil=ok&sid=";
        echo $Sonuc["id"];
        echo "\"><i class=\"fal fa-trash\"></i> Kapak Sil</a>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t";
    }
    echo "\t\t\t\t\t</div>\r\n\t\t\t\t\t";
}
echo "\t\t\t\t\t\r\n\t\t\t\t\t<div class=\"form-group row col-md-6\">\r\n\t\t\t\t\t<label>Profil Görseli</label>\r\n\t\t\t\t\t\t<input type=\"file\" name=\"resim\" class=\"file-upload-default\">\r\n\t\t\t\t\t\t<div class=\"input-group col-xs-12\">\r\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control file-upload-info form-control-sm\" disabled=\"\" placeholder=\"Resim dosyası seçiniz\">\r\n\t\t\t\t\t\t\t<span class=\"input-group-append\">\r\n\t\t\t\t\t\t\t\t<button class=\"file-upload-browse btn btn-primary btn-sm\" type=\"button\"><i class=\"icon-cloud-upload font-12\"></i> Dosya Seç</button>\r\n\t\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\t\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<div class=\"form-check\">\r\n\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" id=\"checkbox11\" name=\"detay\" class=\"form-check-input\" onchange=\"degistir()\" ";
if ($Sonuc["detay"] == "1") {
    echo " checked ";
}
echo ">Detay Gösterilsin mi ?<i class=\"input-helper\"></i></label>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<script>\r\n\t\t\t\t\t\tfunction degistir() {\r\n\t\t\t\t\t\t\t if(document.getElementById(\"checkbox11\").checked) {\r\n\t\t\t\t\t\t\t\t document.getElementById(\"divimiz\").style.display=\"block\";\r\n\t\t\t\t\t\t\t } else {\r\n\t\t\t\t\t\t\t\t document.getElementById(\"divimiz\").style.display=\"none\";\r\n\t\t\t\t\t\t\t }\r\n\t\t\t\t\t\t };\r\n\t\t\t\t\t</script>\r\n\t\t\t\t\t<div class=\"card mb-4\">\r\n\t\t\t\t\t\t<div class=\"card-header\">\r\n\t\t\t\t\t\t\tSOSYAL MEDYA AYARLARI\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t<div class=\"card-body\">\r\n\t\t\t\t\t\t<div class=\"row\">\r\n\t\t\t\t\t\t\t<div class=\"form-group col-md-6\">\r\n\t\t\t\t\t\t\t\t<label for=\"facebook\">Facebook Sayfa URL</label>\r\n\t\t\t\t\t\t\t\t<div class=\"input-group\">\r\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"facebook\" id=\"facebook\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["facebook"] : "";
echo "\" />\r\n\t\t\t\t\t\t\t\t\t<div class=\"input-group-append\">\r\n\t\t\t\t\t\t\t\t\t<button class=\"btn btn-sm btn-facebook\" type=\"button\">\r\n\t\t\t\t\t\t\t\t\t  <i class=\"mdi mdi-facebook\"></i>\r\n\t\t\t\t\t\t\t\t\t</button>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t<div class=\"form-group col-md-6\">\r\n\t\t\t\t\t\t\t\t<label for=\"twitter\">Twitter Sayfa URL</label>\r\n\t\t\t\t\t\t\t\t<div class=\"input-group\">\r\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"twitter\" id=\"twitter\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["twitter"] : "";
echo "\" />\r\n\t\t\t\t\t\t\t\t\t<div class=\"input-group-append\">\r\n\t\t\t\t\t\t\t\t\t<button class=\"btn btn-sm btn-twitter\" type=\"button\">\r\n\t\t\t\t\t\t\t\t\t  <i class=\"mdi mdi-twitter\"></i>\r\n\t\t\t\t\t\t\t\t\t</button>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t<div class=\"form-group col-md-6\">\r\n\t\t\t\t\t\t\t\t<label for=\"instagram\">Instagram Sayfa URL</label>\r\n\t\t\t\t\t\t\t\t<div class=\"input-group\">\r\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"instagram\" id=\"instagram\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["instagram"] : "";
echo "\" />\r\n\t\t\t\t\t\t\t\t\t<div class=\"input-group-append\">\r\n\t\t\t\t\t\t\t\t\t<button class=\"btn btn-sm btn-instagram\" type=\"button\">\r\n\t\t\t\t\t\t\t\t\t  <i class=\"mdi mdi-instagram\"></i>\r\n\t\t\t\t\t\t\t\t\t</button>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t<div class=\"form-group col-md-6\">\r\n\t\t\t\t\t\t\t\t<label for=\"linkedin\">LinkedIn Sayfa URL</label>\r\n\t\t\t\t\t\t\t\t<div class=\"input-group\">\r\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"linkedin\" id=\"linkedin\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["linkedin"] : "";
echo "\" />\r\n\t\t\t\t\t\t\t\t\t<div class=\"input-group-append\">\r\n\t\t\t\t\t\t\t\t\t<button class=\"btn btn-sm btn-linkedin\" type=\"button\">\r\n\t\t\t\t\t\t\t\t\t  <i class=\"mdi mdi-linkedin\"></i>\r\n\t\t\t\t\t\t\t\t\t</button>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t<div class=\"form-group col-md-6\">\r\n\t\t\t\t\t\t\t\t<label for=\"youtube\">Youtube Sayfa URL</label>\r\n\t\t\t\t\t\t\t\t<div class=\"input-group\">\r\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"youtube\" id=\"youtube\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["youtube"] : "";
echo "\" />\r\n\t\t\t\t\t\t\t\t\t<div class=\"input-group-append\">\r\n\t\t\t\t\t\t\t\t\t<button class=\"btn btn-sm btn-youtube\" type=\"button\">\r\n\t\t\t\t\t\t\t\t\t  <i class=\"mdi mdi-youtube\"></i>\r\n\t\t\t\t\t\t\t\t\t</button>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div id=\"divimiz\" ";
if ($Sonuc["detay"] == "1") {
    echo " style=\"display: block;\" ";
} else {
    echo " style=\"display: none;\" ";
}
echo ">\r\n\t\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t\t<label for=\"aciklama\">Kısa Özgeçmiş</label>\r\n\t\t\t\t\t\t\t<textarea name=\"aciklama\" id=\"myTextarea\">";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["aciklama"] : "";
echo "</textarea>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t<div class=\"card mb-4\">\r\n\t\t\t\t\t\t\t<div class=\"card-header\">\r\n\t\t\t\t\t\t\t\tSEO AYARLARI\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t<div class=\"card-body\">\r\n\t\t\t\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t\t\t\t<label for=\"maxlength-textarea\">SEO Açıklama (Description)</label>\r\n\t\t\t\t\t\t\t\t\t<textarea id=\"maxlength-textarea\" name=\"description\"  class=\"form-control\" maxlength=\"260\" rows=\"2\">";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["description"] : "";
echo "</textarea>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<div class=\"form-group mb-0\">\r\n\t\t\t\t\t\t\t\t\t<label for=\"tags\">SEO Kelimeler (Keywords) <small>(Kelimenin sonuna virgül koyunuz)</small></label>\r\n\t\t\t\t\t\t\t\t\t<input name=\"keywords\" id=\"tags\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["keywords"] : "";
echo "\" />\r\n\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\t\t\t\t\t\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t<div class=\"form-group mb-2\">\t\t\t\t\t\t\r\n\t\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\t\t\t\t\t\t<label class=\"switch\">\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"durum\" id=\"durum\" value=\"1\" ";
    if ($Sonuc["durum"] == "1") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\n\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t";
} else {
    echo "\t\t\t\t\t\t<label class=\"switch\">\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"durum\" id=\"durum\" value=\"1\" checked>\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\n\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t";
}
echo "\t\t\t\t\t\t<label class=\"d-inline-block\" style=\"line-height: 34px;\" for=\"durum\">Durum</label>\t\t\t\t\t\t\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t<div class=\"form-group mb-2\">\t\t\t\t\t\t\r\n\t\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\t\t\t\t\t\t<label class=\"switch\">\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"anasayfa\" id=\"anasayfa\" value=\"1\" ";
    if ($Sonuc["anasayfa"] == "1") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\n\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t";
} else {
    echo "\t\t\t\t\t\t<label class=\"switch\">\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"anasayfa\" id=\"anasayfa\" value=\"1\" checked>\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\n\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t";
}
echo "\t\r\n\t\t\t\t\t\t<label class=\"d-inline-block\" style=\"line-height: 34px;\" for=\"anasayfa\">Anasayfa'da Gözüksün mü ?</label>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t\r\n\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\t\t\t\t\t<button type=\"submit\" name=\"ekip_guncelle\" class=\"btn btn-success btn-icon-text btn-sm\">\r\n\t\t\t\t\t\t<i class=\"mdi mdi-reload  btn-icon-prepend\"></i>                                                    \r\n\t\t\t\t\t\tGÜNCELLE\r\n\t\t\t\t\t</button>\r\n\t\t\t\t\t";
} else {
    echo "\t\t\t\t\t<button type=\"submit\" name=\"ekip_ekle\" class=\"btn btn-primary btn-icon-text btn-sm\">\r\n\t\t\t\t\t\t<i class=\"mdi mdi-file-check btn-icon-prepend\"></i>\r\n\t\t\t\t\t\tKAYDET\r\n\t\t\t\t\t</button>\r\n\t\t\t\t\t";
}
echo "\t\t\t\t</form>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n\r\n</div>\r\n";
mesaj("ekip_ekle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("ekip_guncelle", 1, "yes", "Başarı ile guncellenmiştir.");
mesaj("ekip_guncelle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("ekipresimsil", 1, "yes", "Başarı ile siinmiştir.");
mesaj("ekipresimsil", 2, "no", "Hata oluştu tekrar deneyiniz.!");


?>