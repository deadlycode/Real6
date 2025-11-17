<?php


echo !defined("GUVENLIK") ? exit : NULL;
echo "\r\n";
oturumkontrol($url);
if (isset($_GET["islem"]) == "duzenle") {
    $durum = "duzenle";
    $Sorgu = $db->prepare("SELECT * FROM banka_hesaplari WHERE id = ?");
    $Sorgu->execute([$_GET["id"]]);
    if ($Sorgu->rowCount()) {
        $Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
    } else {
        header("Location:" . $url . "/404" . $html . "");
    }
}
echo "\r\n<div class=\"page-header\">\r\r\n\t<div class=\"page-title mt-0 mb-0\">\r\r\n\t\t<h3>";
echo $admindil["txt135"];
echo "</h3>\r\r\n\t\t<div class=\"crumbs\">\r\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\r\n\t\t\t\t<li><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt133"];
echo "</a></li>\r\r\n\t\t\t\t<li class=\"active\"><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt135"];
echo "</a></li>\r\r\n\t\t\t</ul>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n</div>\r\r\n<div class=\"row\">\r\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\r\n\t\t<div class=\"card\">\r\r\n\t\t\t<div class=\"card-body\">\r\r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\" autocomplete=\"off\">\r\r\n\t\t\t\t\t<input id=\"id\" name=\"id\" type=\"hidden\" value=\"";
echo $Sonuc["id"];
echo "\">\r\r\n\t\t\t\t\t<div class=\"form-group row mb-0\">\r\r\n\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\r\n\t\t\t\t\t\t\t<label class=\"col-form-label font-weight-bold\" for=\"banka\">Banka Adı</label>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t<div class=\"col-lg-9\">\r\r\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"banka\" id=\"banka\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["banka"] : "";
echo "\" />\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group row mb-0\">\r\r\n\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\r\n\t\t\t\t\t\t\t<label class=\"col-form-label font-weight-bold\" for=\"hesap\">Hesap Sahibi</label>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t<div class=\"col-lg-9\">\r\r\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"hesap\" id=\"hesap\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["hesap"] : "";
echo "\" />\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group row mb-0\">\r\r\n\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\r\n\t\t\t\t\t\t\t<label class=\"col-form-label font-weight-bold\" for=\"sube\">Şube Kodu - Şube Adı</label>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t<div class=\"col-lg-9\">\r\r\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"sube\" id=\"sube\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["sube"] : "";
echo "\" />\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group row mb-0\">\r\r\n\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\r\n\t\t\t\t\t\t\t<label class=\"col-form-label font-weight-bold\" for=\"hnumara\">Hesap Numarası</label>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t<div class=\"col-lg-9\">\r\r\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"hnumara\" id=\"hnumara\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["hnumara"] : "";
echo "\" />\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group row mb-0\">\r\r\n\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\r\n\t\t\t\t\t\t\t<label class=\"col-form-label font-weight-bold\" for=\"iban\">Iban</label>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t<div class=\"col-lg-9\">\r\r\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"iban\" id=\"iban\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["iban"] : "";
echo "\" />\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group row mb-0\">\r\r\n\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\r\n\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t<div class=\"col-lg-9\">\r\r\n\t\t\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t\t\t";
    if ($Sonuc["resim"]) {
        echo "\r\n\t\t\t\t\t\t\t\t<div class=\"form-group row col-md-3\">\r\r\n\t\t\t\t\t\t\t\t\t<div id=\"lightgallery\" class=\"row lightGallery\">\r\r\n\t\t\t\t\t\t\t\t\t\t<a href=\"../";
        echo tema;
        echo "/uploads/bankalar/";
        echo $Sonuc["resim"];
        echo "\"><img src=\"../";
        echo tema;
        echo "/uploads/bankalar/";
        echo $Sonuc["resim"];
        echo "\" class=\"img-responsive img-thumbnail\" style=\"margin-bottom:2px;width:100%;\"></a>\r\r\n\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t<a style=\"width: 100%;\" class=\"btn btn-danger btn-sm popconfirm\" title=\"Logo Sil\" href=\"../_class/yonetim_islem.php?bankaresimsil=ok&sid=";
        echo $Sonuc["id"];
        echo "\"><i class=\"fa fa-trash\"></i> Logo Sil</a>\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t";
    }
    echo "\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t\t";
}
echo "\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group row mb-0\">\r\r\n\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\r\n\t\t\t\t\t\t\t<label class=\"col-form-label font-weight-bold\" for=\"resim\">Banka Logo</label>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t<div class=\"col-lg-4\">\r\r\n\t\t\t\t\t\t\t<input type=\"file\" name=\"resim\" class=\"file-upload-default\">\r\r\n\t\t\t\t\t\t\t<div class=\"input-group col-xs-12\">\r\r\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control file-upload-info form-control-sm\" disabled=\"\" placeholder=\"Banka logosu seçiniz\">\r\r\n\t\t\t\t\t\t\t\t<span class=\"input-group-append\">\r\r\n\t\t\t\t\t\t\t\t\t<button class=\"file-upload-browse btn btn-primary btn-sm\" type=\"button\"><i class=\"icon-cloud-upload font-12\"></i> Dosya Seç</button>\r\r\n\t\t\t\t\t\t\t\t</span>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group row mb-0\">\r\r\n\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\r\n\t\t\t\t\t\t\t<label class=\"col-form-label font-weight-bold\" for=\"durum\">Durum</label>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t<div class=\"col-lg-9\">\r\r\n\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\r\n\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\r\n\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"durum\" id=\"durum1\" value=\"1\" ";
if ($Sonuc["durum"] == "1") {
    echo " checked ";
}
echo " checked>\r\r\n\t\t\t\t\t\t\t\t\tAktif\r\r\n\t\t\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t<div class=\"form-check form-check-danger d-inline-block mr-2\">\r\r\n\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\r\n\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"durum\" id=\"durum2\" value=\"0\" ";
if ($Sonuc["durum"] == "0") {
    echo " checked ";
}
echo ">\r\r\n\t\t\t\t\t\t\t\t\tPasif\r\r\n\t\t\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\r\r\n\t\t\t\t\t<div class=\"form-group row\">\r\r\n\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\r\n\t\t\t\t\t\t\t<label class=\"col-form-label\"></label>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t<div class=\"col-lg-9\">\r\r\n\t\t\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\r\n\t\t\t\t\t\t\t<button type=\"submit\" name=\"banka_guncelle\" class=\"btn btn-success btn-icon-text btn-sm\">\r\r\n\t\t\t\t\t\t\t\t<i class=\"mdi mdi-reload  btn-icon-prepend\"></i>                                                    \r\r\n\t\t\t\t\t\t\t\tGÜNCELLE\r\r\n\t\t\t\t\t\t\t</button>\r\r\n\t\t\t\t\t\t\t";
} else {
    echo "\r\n\t\t\t\t\t\t\t<button type=\"submit\" name=\"banka_ekle\" class=\"btn btn-primary btn-icon-text btn-sm\">\r\r\n\t\t\t\t\t\t\t\t<i class=\"mdi mdi-file-check btn-icon-prepend\"></i>\r\r\n\t\t\t\t\t\t\t\tKAYDET\r\r\n\t\t\t\t\t\t\t</button>\r\r\n\t\t\t\t\t\t\t";
}
echo "\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\t\t\t\t\t\r\r\n\t\t\t\t</form>\r\r\n\t\t\t</div>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n\r\r\n</div>\r\r\n";
mesaj("banka_ekle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("banka_guncelle", 1, "yes", "Başarı ile guncellenmiştir.");
mesaj("banka_guncelle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("bankaresimsil", 1, "yes", "Başarı ile siinmiştir.");
mesaj("bankaresimsil", 2, "no", "Hata oluştu tekrar deneyiniz.!");
echo "\t\t\r\r\n";


?>