<?php


echo !defined("GUVENLIK") ? exit : NULL;
oturumkontrol($url);
if (isset($_GET["islem"]) == "duzenle") {
    $sayfaid = $_GET["id"];
    $durum = "duzenle";
    $Sorgu = $db->prepare("SELECT * FROM kullanici WHERE id = ?");
    $Sorgu->execute([$sayfaid]);
    if ($Sorgu->rowCount()) {
        $Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
    } else {
        header("Location:" . $url . "/404" . $html . "");
        exit;
    }
}
echo " \r\n<div class=\"page-header\">\r\n\t<div class=\"page-title mt-0 mb-0\">\r\n\t\t<h3>";
echo $admindil["txt94"];
echo "</h3>\r\n\t\t<div class=\"crumbs\">\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\n\t\t\t\t<li><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt93"];
echo "</a></li>\r\n\t\t\t\t<li class=\"active\"><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt94"];
echo "</a></li>\r\n\t\t\t</ul>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n<div class=\"row\">\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\n\t\t<div class=\"card\">\r\n\t\t\t<div class=\"card-body\">\r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\">\r\n\t\t\t\t</br>\r\n\t\t\t\t<div class=\"alert alert-danger\" role=\"alert\">\r\n\t\t\t\t<i class=\"mdi mdi-alert-circle\" style=\"font-size: 50px;line-height: normal;float: left;\"></i>\r\n\t\t\t\t<p style=\"font-style: italic;\">Şifre Olarak: <b>123,1234, 123456, 1, admin, user, demo </b>  gibi basit düzeyde şifreleri sistem kabul etmemektedir. Şifreniz bu şifrelerden herhangi birisine sahipse panelde hiç bir işlem yapamazsınız.! </br> <b>Not:</b> Yönetim panel giriş linkini Site Yönetimi -> Genel Ayarlar kısmından değiştiriniz.! </p> \r\n\r\n\t\t\t\t</div>\r\n\t\t\t\t</br>\r\n\t\t\t\t<input id=\"id\" name=\"id\" type=\"hidden\" value=\"";
echo $Sonuc["id"];
echo "\">\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"isim\">İsim</label>\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"isim\" id=\"isim\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["isim"] : "";
echo "\" />\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"email\">E-Mail</label>\r\n\t\t\t\t\t\t<input class=\"form-control form-control-sm\" name=\"email\" id=\"email\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["email"] : "";
echo "\" data-inputmask=\"'alias': 'email'\" />\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"kadi\">Kullanıcı Adı</label>\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"kadi\" id=\"kadi\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["kadi"] : "";
echo "\" />\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"sifre\">Şifre</label>\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"sifre\" id=\"sifre\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["sifre"] : "";
echo "\" />\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t";
    if ($Sonuc["resim"]) {
        echo "\t\t\t\t\t\t<div class=\"form-group row col-md-2\">\r\n\t\t\t\t\t\t\t<div id=\"lightgallery\" class=\"row lightGallery\">\r\n\t\t\t\t\t\t\t\t<a href=\"../";
        echo yonetim;
        echo "/images/users/";
        echo $Sonuc["resim"];
        echo "\"><img src=\"../";
        echo yonetim;
        echo "/images/users/";
        echo $Sonuc["resim"];
        echo "\" class=\"img-responsive img-thumbnail\" style=\"margin-bottom:2px;width:100%;\"></a>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t<a style=\"width: 100%;\" class=\"btn btn-danger btn-sm popconfirm\" title=\"Resim Sil\" href=\"../_class/yonetim_islem.php?yoneticiresimsil=ok&sid=";
        echo $Sonuc["id"];
        echo "\"><i class=\"fa fa-trash-o\"></i> Resim Sil</a>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t";
    }
    echo "\t\t\t\t\t\t\t\r\n\t\t\t\t\t";
}
echo "\t\t\t\t\t<div class=\"form-group row col-md-6\">\r\n\t\t\t\t\t<label>Profil Resmi</label>\r\n\t\t\t\t\t\t<input type=\"file\" name=\"resim\" class=\"file-upload-default\">\r\n\t\t\t\t\t\t<div class=\"input-group col-xs-12\">\r\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control file-upload-info form-control-sm\" disabled=\"\" placeholder=\"Resim dosyası seçiniz\">\r\n\t\t\t\t\t\t\t<span class=\"input-group-append\">\r\n\t\t\t\t\t\t\t\t<button class=\"file-upload-browse btn btn-primary btn-sm\" type=\"button\"><i class=\"icon-cloud-upload font-12\"></i> Dosya Seç</button>\r\n\t\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\t\t\t\t\t<button type=\"submit\" name=\"yonetici_guncelle\" class=\"btn btn-success btn-icon-text btn-sm\">\r\n\t\t\t\t\t\t<i class=\"mdi mdi-reload  btn-icon-prepend\"></i>                                                    \r\n\t\t\t\t\t\tGÜNCELLE\r\n\t\t\t\t\t</button>\r\n\t\t\t\t\t";
} else {
    echo "\t\t\t\t\t<button type=\"submit\" name=\"yonetici_kaydet\" class=\"btn btn-primary btn-icon-text btn-sm\">\r\n\t\t\t\t\t\t<i class=\"mdi mdi-file-check btn-icon-prepend\"></i>\r\n\t\t\t\t\t\tKAYDET\r\n\t\t\t\t\t</button>\r\n\t\t\t\t\t";
}
echo "\t\t\t\t</form>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n\r\n</div>\r\n";
mesaj("yonetici_kaydet", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("yonetici_guncelle", 1, "yes", "Başarı ile guncellenmiştir.");
mesaj("yonetici_guncelle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("yoneticiresimsil", 1, "yes", "Başarı ile siinmiştir.");
mesaj("yoneticiresimsil", 2, "no", "Hata oluştu tekrar deneyiniz.!");
echo "\t\r\n";


?>