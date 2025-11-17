<?php


echo !defined("GUVENLIK") ? exit : NULL;
echo "\r\n";
oturumkontrol($url);
if (isset($_GET["islem"]) == "duzenle") {
    $durum = "duzenle";
    $Sorgu = $db->prepare("SELECT * FROM projeler WHERE id = ?");
    $Sorgu->execute([$_GET["id"]]);
    if ($Sorgu->rowCount()) {
        $Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
    } else {
        header("Location:" . $url . "/404" . $html . "");
        exit;
    }
}
echo "\r\n<div class=\"page-header\">\r\r\n\t<div class=\"page-title mt-0 mb-0\">\r\r\n\t\t<h3>";
echo $admindil["txt43"];
echo "</h3>\r\r\n\t\t<div class=\"crumbs\">\r\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\r\n\t\t\t\t<li><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt42"];
echo "</a></li>\r\r\n\t\t\t\t<li><a href=\"projeler";
echo $html;
echo "\">";
echo $admindil["txt44"];
echo "</a></li>\r\r\n\t\t\t\t<li class=\"active\"><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt43"];
echo "</a></li>\r\r\n\t\t\t</ul>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n</div>\r\r\n<div class=\"row\">\r\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\r\n\t\t<div class=\"card\">\r\r\n\t\t\t<div class=\"card-body\">\r\r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\">\r\r\n\t\t\t\t<input id=\"id\" name=\"id\" type=\"hidden\" value=\"";
echo $Sonuc["id"];
echo "\">\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"sira\">Sıra</label>\r\r\n\t\t\t\t\t\t<input type=\"number\" class=\"form-control form-control-sm\" min=\"0\" name=\"sira\" id=\"sira\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["sira"] : "";
echo "\" />\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"adi\">Başlık <i class=\"icon-info text-info\" data-toggle=\"popover\" data-content=\"Proje adında tamamen BÜYÜK harf kullanmayın. 70 karakterden uzun başlıkları Google indexlemede göstermez ve değerlendirmez. Bu nedenle uzun başlıklar kullanmaktan kaçının. Başlıklarda çift tırnak kesinlikle kullanmayın.\" data-trigger=\"hover\" data-original-title=\"Başlık\"></i></label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"adi\" id=\"adi\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["adi"] : "";
echo "\" />\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"row\">\r\r\n\t\t\t\t\t\t<div class=\"form-group col-md-6\">\r\r\n\t\t\t\t\t\t\t<label for=\"kategori\">Kategori</label>\r\r\n\t\t\t\t\t\t\t<select class=\"js-example-basic-single form-control-sm\" name=\"kategori\" id=\"kategori\" required style=\"width:100%\">\r\r\n\t\t\t\t\t\t\t";
$KATEGORISorgu = $db->prepare("SELECT * FROM proje_kategori WHERE durum = ? AND dil = ? ORDER BY id ASC");
$KATEGORISorgu->execute(["1", $_SESSION["admin_dil"]]);
$KATEGORIislem = $KATEGORISorgu->fetchALL(PDO::FETCH_ASSOC);
echo "\r\n\t\t\t\t\t\t\t\t";
foreach ($KATEGORIislem as $KATEGORISonuc) {
    echo "\r\n\t\t\t\t\t\t\t\t<option value=\"";
    echo $KATEGORISonuc["id"];
    echo "\" ";
    echo $Sonuc["kategori"] == $KATEGORISonuc["id"] ? "selected" : "";
    echo ">";
    echo $KATEGORISonuc["adi"];
    echo "</option>\r\r\n\t\t\t\t\t\t\t\t";
}
echo "\r\n\t\t\t\t\t\t\t</select>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t<div class=\"form-group col-md-6\">\r\r\n\t\t\t\t\t\t\t<label for=\"videoid\">YouTube Video ID <i class=\"icon-info text-info\" data-toggle=\"popover\" data-content=\"Haber içeriğinizin haber detay görseli alanında görsel yerine, haberin videosunu gösterebilirsiniz. Bunun için Youtube'a yüklediğiniz videonuzun sadece ID numarasını bu alana yapıştırmanız yeterlidir. (Ör: https://www.youtube.com/watch?v=TqeSxMdnEQE adresindeki videonun ID'si v= sorasındaki ID numarasıdır. TqeSxMdnEQE eklenmesi yeterlidir.)\" data-trigger=\"hover\" data-original-title=\"YouTube Video ID\"></i></label>\r\r\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"videoid\" id=\"videoid\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["videoid"] : "";
echo "\" />\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t<div class=\"form-group col-md-6\">\r\r\n\t\t\t\t\t\t\t<label>Yayın Tarihi <i class=\"icon-info text-info\" data-toggle=\"popover\" data-content=\"İçeriğin ilk eklendiği tarihtir. Sistem ekleme sırasında otomatik olarak verir. Dilerseniz tarihi değiştirebilirsiniz.\" data-trigger=\"hover\" data-original-title=\"Yayın Tarihi\"></i></label>\r\r\n\t\t\t\t\t\t\t<div class=\"input-group\">\r\r\n\t\t\t\t\t\t\t\t<input type=\"text\" autocomplete=\"off\" name=\"tarih\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["tarih"] : date("d-m-Y H:i");
echo "\" class=\"form-control form-control-sm date-timepicker\" />\r\r\n\t\t\t\t\t\t\t\t<span class=\"input-group-addon input-group-append border-left\" style=\"height: 35px;\">\r\r\n\t\t\t\t\t\t\t\t  <span class=\"mdi mdi-calendar input-group-text\"></span>\r\r\n\t\t\t\t\t\t\t\t</span>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t<div class=\"form-group col-md-6\">\r\r\n\t\t\t\t\t\t\t<label>Güncelleme Tarihi <i class=\"icon-info text-info\" data-toggle=\"popover\" data-content=\"İçeriğinizde güncelleme yaptıysanız takvim simgesine tıklayarak güncelleme tarihini belirtmeniz gerekir. İlk içerik girişinde yayın tarih ve saatiyle aynı seçilmesinde yarar vardır.\" data-trigger=\"hover\" data-original-title=\"Güncelleme Tarihi\"></i></label>\r\r\n\t\t\t\t\t\t\t<div class=\"input-group\">\r\r\n\t\t\t\t\t\t\t\t<input type=\"text\" autocomplete=\"off\" name=\"tarihg\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["tarihg"] : "";
echo "\" class=\"form-control form-control-sm date-timepicker\" />\r\r\n\t\t\t\t\t\t\t\t<span class=\"input-group-addon input-group-append border-left\" style=\"height: 35px;\">\r\r\n\t\t\t\t\t\t\t\t  <span class=\"mdi mdi-calendar input-group-text\"></span>\r\r\n\t\t\t\t\t\t\t\t</span>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\r\n\t\t\t\t\t<div class=\"row\">\r\r\n\t\t\t\t\t\t";
    if ($Sonuc["kapak"]) {
        echo "\r\n\t\t\t\t\t\t<div class=\"form-group col-md-2\">\r\r\n\t\t\t\t\t\t\t<img src=\"../";
        echo tema;
        echo "/uploads/projeler/";
        echo $Sonuc["kapak"];
        echo "\" class=\"img-responsive img-thumbnail\" style=\"margin-bottom:2px;width:100%;min-height:150px;\">\r\r\n\t\t\t\t\t\t\t<a style=\"width: 100%;\" class=\"btn btn-danger btn-sm popconfirm\" title=\"Kapak Sil\" href=\"../_class/yonetim_islem.php?projeresimsil=ok&sid=";
        echo $Sonuc["id"];
        echo "\"><i class=\"fal fa-trash\"></i> Kapak Sil</a>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t";
    }
    echo "\r\n\t\t\t\t\t\t";
    $resimler = $db->prepare("SELECT * FROM projeresim WHERE pid = ? ");
    $resimler->execute([$Sonuc["id"]]);
    $ral = $resimler->fetchALL(PDO::FETCH_ASSOC);
    echo "\r\n\t\t\t\t\t\t";
    foreach ($ral as $r) {
        echo "\r\n\t\t\t\t\t\t<div class=\"form-group col-md-2\">\r\r\n\t\t\t\t\t\t\t<img src=\"../";
        echo tema;
        echo "/uploads/projeler/diger/";
        echo $r["resim"];
        echo "\" class=\"img-responsive img-thumbnail\" style=\"margin-bottom:2px;width:100%;min-height:150px;\">\r\r\n\t\t\t\t\t\t\t<a style=\"width: 100%;\" class=\"btn btn-danger btn-sm popconfirm\" title=\"Resmi Sil\" href=\"../_class/yonetim_islem.php?projetopluresimsil=ok&id=";
        echo $Sonuc["id"];
        echo "&sid=";
        echo $r["id"];
        echo "\"><i class=\"fal fa-trash\"></i> Resmi Sil</a>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t";
    }
    echo "\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t";
}
echo "\t\t\t\t\t\r\r\n\t\t\t\t\t<div class=\"form-group row col-md-6\">\r\r\n\t\t\t\t\t<label>Listeleme Görseli</label>\r\r\n\t\t\t\t\t\t<input type=\"file\" name=\"resim\" class=\"file-upload-default\">\r\r\n\t\t\t\t\t\t<div class=\"input-group col-xs-12\">\r\r\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control file-upload-info form-control-sm\" disabled=\"\" placeholder=\"Resim dosyası seçiniz\">\r\r\n\t\t\t\t\t\t\t<span class=\"input-group-append\">\r\r\n\t\t\t\t\t\t\t\t<button class=\"file-upload-browse btn btn-primary btn-sm\" type=\"button\"><i class=\"icon-cloud-upload font-12\"></i> Dosya Seç</button>\r\r\n\t\t\t\t\t\t\t</span>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\t\t\t\t\t\r\r\n\t\t\t\t\t<div class=\"form-group row col-md-6\">\r\r\n\t\t\t\t\t<label>Fotoğraflar</label>\r\r\n\t\t\t\t\t\t<input type=\"file\" name=\"resimler[]\" multiple class=\"file-upload-default\">\r\r\n\t\t\t\t\t\t<div class=\"input-group col-xs-12\">\r\r\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control file-upload-info form-control-sm\" disabled=\"\" placeholder=\"Ürüne ait resimleri toplu şekilde buradan seçebilirsiniz.\">\r\r\n\t\t\t\t\t\t\t<span class=\"input-group-append\">\r\r\n\t\t\t\t\t\t\t\t<button class=\"file-upload-browse btn btn-primary btn-sm\" type=\"button\"><i class=\"icon-cloud-upload font-12\"></i> Dosya Seç</button>\r\r\n\t\t\t\t\t\t\t</span>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group mb-2\">\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\r\n\t\t\t\t\t\t<label class=\"switch\">\r\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"durum\" id=\"durum\" value=\"1\" ";
    if ($Sonuc["durum"] == "1") {
        echo " checked ";
    }
    echo ">\r\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\r\n\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t";
} else {
    echo "\r\n\t\t\t\t\t\t<label class=\"switch\">\r\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"durum\" id=\"durum\" value=\"1\" checked>\r\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\r\n\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t";
}
echo "\r\n\t\t\t\t\t\t<label class=\"d-inline-block\" style=\"line-height: 34px;\" for=\"durum\">Durum</label>\t\t\t\t\t\t\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group mb-4\">\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\r\n\t\t\t\t\t\t<label class=\"switch\">\r\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"anasayfa\" id=\"anasayfa\" value=\"1\" ";
    if ($Sonuc["anasayfa"] == "1") {
        echo " checked ";
    }
    echo ">\r\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\r\n\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t";
} else {
    echo "\r\n\t\t\t\t\t\t<label class=\"switch\">\r\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"anasayfa\" id=\"anasayfa\" value=\"1\" checked>\r\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\r\n\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t";
}
echo "\t\r\r\n\t\t\t\t\t\t<label class=\"d-inline-block\" style=\"line-height: 34px;\" for=\"anasayfa\">Anasayfa'da Gözüksün mü ?</label>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"spot\">Spot Metin <i class=\"icon-info text-info\" data-toggle=\"popover\" data-content=\"Spot metin, içeriğinizi özetleyen bir ya da iki cümlelik metindir. 180 karakteri geçmemesi gerekmektedir.  Spot metinde de tamamen BÜYÜK harften kaçınmalı ve çift tırnak kullanılmamalıdır.\" data-trigger=\"hover\" data-original-title=\"Spot Metin\"></i></label>\r\r\n\t\t\t\t\t\t<textarea id=\"spot\" name=\"spot\" class=\"form-control\" rows=\"4\">";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["spot"] : "";
echo "</textarea>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"aciklama\">İçerik</label>\r\r\n\t\t\t\t\t\t<textarea name=\"aciklama\" id=\"myTextarea\">";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["aciklama"] : "";
echo "</textarea>\r\r\n\t\t\t\t\t</div>\t\r\r\n\t\t\t\t\t<div class=\"card mb-4\">\r\r\n\t\t\t\t\t\t<div class=\"card-header\">\r\r\n\t\t\t\t\t\t\tSEO AYARLARI\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t<div class=\"card-body\">\r\r\n\t\t\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t\t\t<label for=\"maxlength-textarea\">SEO Açıklama (Description)</label>\r\r\n\t\t\t\t\t\t\t\t<textarea id=\"maxlength-textarea\" name=\"description\"  class=\"form-control\" maxlength=\"260\" rows=\"2\">";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["description"] : "";
echo "</textarea>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t<div class=\"form-group mb-0\">\r\r\n\t\t\t\t\t\t\t\t<label for=\"tags\">SEO Kelimeler (Keywords) <small>(Kelimenin sonuna virgül koyunuz)</small></label>\r\r\n\t\t\t\t\t\t\t\t<input name=\"keywords\" id=\"tags\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["keywords"] : "";
echo "\" />\r\r\n\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\t\t\t\t\t\r\r\n\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\r\n\t\t\t\t\t<button type=\"submit\" name=\"proje_guncelle\" class=\"btn btn-success btn-icon-text btn-sm\">\r\r\n\t\t\t\t\t\t<i class=\"mdi mdi-reload  btn-icon-prepend\"></i>                                                    \r\r\n\t\t\t\t\t\tGÜNCELLE\r\r\n\t\t\t\t\t</button>\r\r\n\t\t\t\t\t";
} else {
    echo "\r\n\t\t\t\t\t<button type=\"submit\" name=\"proje_ekle\" class=\"btn btn-primary btn-icon-text btn-sm\">\r\r\n\t\t\t\t\t\t<i class=\"mdi mdi-file-check btn-icon-prepend\"></i>\r\r\n\t\t\t\t\t\tKAYDET\r\r\n\t\t\t\t\t</button>\r\r\n\t\t\t\t\t";
}
echo "\r\n\t\t\t\t</form>\r\r\n\t\t\t</div>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n\r\r\n</div>\r\r\n";
mesaj("proje_ekle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("proje_guncelle", 1, "yes", "Başarı ile guncellenmiştir.");
mesaj("proje_guncelle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("projeresimsil", 1, "yes", "Başarı ile siinmiştir.");
mesaj("projeresimsil", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("projetopluresimsil", 1, "yes", "Başarı ile siinmiştir.");
mesaj("projetopluresimsil", 2, "no", "Hata oluştu tekrar deneyiniz.!");
echo "\r\n";

?>