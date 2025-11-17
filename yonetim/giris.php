<?php


require_once "../_class/baglan.php";
require_once "../_class/fonksiyon.php";
require_once "../_class/class.upload.php";
oturumgiris();
echo "\r\n";
$ua = getBrowser();
$tarayici = "Web tarayucınız: " . $ua["name"] . " " . $ua["version"] . " " . $ua["platform"];
if ($ua["name"] == "Mozilla Firefox") {
    print_r($tarayici);
    echo "<center><h2>Mozilla Firefox tarayıcısı desteklenmiyor.</h2><br><h4>Lütfen Internet Explorer, Opera, Safari, Chrome tarayıcılarından birini kullanınız.</h4></center>";
} else {
    echo "\r\n<!DOCTYPE html>\r\r\n<html lang=\"en\">\r\r\n<head>\r\r\n\t<meta charset=\"utf-8\">\r\r\n\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">\r\r\n\t<title>Yönetim Paneli</title>\r\r\n\t<link rel=\"stylesheet\" href=\"vendors/iconfonts/mdi/font/css/materialdesignicons.min.css\">\r\r\n\t<link rel=\"stylesheet\" href=\"vendors/iconfonts/simple-line-icon/css/simple-line-icons.css\">\r\r\n\t<link rel=\"stylesheet\" href=\"vendors/css/vendor.bundle.base.css\">\r\r\n\t<link rel=\"stylesheet\" href=\"vendors/css/vendor.bundle.addons.css\">\r\r\n\t<link rel=\"stylesheet\" href=\"css/vertical-layout-light/style.css\">\r\r\n\t<link rel=\"shortcut icon\" href=\"images/favicon.png\" />\r\r\n</head>\r\r\n<body>\r\r\n\t<div class=\"container-scroller\">\r\r\n\t\t<div class=\"container-fluid page-body-wrapper full-page-wrapper\">\r\r\n\t\t\t<div class=\"content-wrapper d-flex align-items-stretch auth auth-img-bg\">\r\r\n\t\t\t\t<div class=\"row flex-grow\">\r\r\n\t\t\t\t\t<div class=\"col-lg-6 d-flex align-items-center justify-content-center\">\r\r\n\t\t\t\t\t\t<div class=\"auth-form-transparent text-left p-3\">\r\r\n\t\t\t\t\t\t\t<h3>YÖNETİM PANELİ</h3>\r\r\n\t\t\t\t\t\t\t<form class=\"pt-3\" method=\"post\" action=\"../_class/yonetim_islem.php\" autocomplete=\"off\">\r\r\n\t\t\t\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t\t\t\t<label for=\"kadi\">Kullanıcı Adı</label>\r\r\n\t\t\t\t\t\t\t\t\t<div class=\"input-group\">\r\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"input-group-prepend bg-transparent\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-text bg-transparent border-right-0\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"mdi mdi-account-outline text-primary\"></i>\r\r\n\t\t\t\t\t\t\t\t\t\t\t</span>\r\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-lg border-left-0\" ";
    if (isset($_COOKIE["Yonetim_Kadi"])) {
        echo " value=\"";
        echo $_COOKIE["Yonetim_Kadi"];
        echo "\" ";
    }
    echo " name=\"kadi\" id=\"kadi\">\r\r\n\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t\t\t\t<label for=\"sifre\">Şifre</label>\r\r\n\t\t\t\t\t\t\t\t\t<div class=\"input-group\">\r\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"input-group-prepend bg-transparent\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-text bg-transparent border-right-0\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"mdi mdi-lock-outline text-primary\"></i>\r\r\n\t\t\t\t\t\t\t\t\t\t\t</span>\r\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t\t<input type=\"password\" class=\"form-control form-control-lg border-left-0\" ";
    if (isset($_COOKIE["Yonetim_Sifre"])) {
        echo " value=\"";
        echo $_COOKIE["Yonetim_Sifre"];
        echo "\" ";
    }
    echo " name=\"sifre\" id=\"sifre\">                        \r\r\n\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t<div class=\"my-2 d-flex justify-content-between align-items-center\">\r\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-check\">\r\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label text-muted\">\r\r\n\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" ";
    echo isset($_COOKIE["Yonetim_Kadi"]) ? "checked" : "";
    echo " name=\"beni_hatirla\" class=\"form-check-input\">\r\r\n\t\t\t\t\t\t\t\t\t\tBeni Hatırla\r\r\n\t\t\t\t\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t<a href=\"#\" data-toggle=\"modal\" data-target=\"#sifremi-unuttum\" data-backdrop=\"static\" data-keyboard=\"false\" data-whatever=\"@mdo\" class=\"auth-link text-black\">Parolamı Unuttum</a>\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t<div class=\"my-3\">\r\r\n\t\t\t\t\t\t\t\t\t<button type=\"submit\" name=\"kullanici_giris\" class=\"btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn\"><i class=\"icon-lock\"></i> GİRİŞ YAP</button>\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t</form>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"col-lg-6 login-half-bg d-flex flex-row\">\r\r\n\t\t\t\t\t\t<p class=\"text-white font-weight-medium text-center flex-grow align-self-end\">Copyright © ";
    echo date("Y");
    echo " Tüm hakları saklıdır.</p>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t</div>\r\r\n\t\t\t</div>\r\r\n\t\t\t<!-- content-wrapper ends -->\r\r\n\t\t</div>\r\r\n\t\t<!-- page-body-wrapper ends -->\r\r\n\t</div>\r\r\n\t<!-- container-scroller -->\r\r\n\t<!-- plugins:js -->\r\r\n\t<script src=\"vendors/js/vendor.bundle.base.js\"></script>\r\r\n\t<script src=\"vendors/js/vendor.bundle.addons.js\"></script>\r\r\n\t<!-- endinject -->\r\r\n\t<!-- inject:js -->\r\r\n\t<script src=\"js/off-canvas.js\"></script>\r\r\n\t<script src=\"js/hoverable-collapse.js\"></script>\r\r\n\t<script src=\"js/template.js\"></script>\r\r\n\t<script src=\"js/settings.js\"></script>\r\r\n\t<script src=\"js/todolist.js\"></script>\r\r\n\t<div class=\"modal fade\" id=\"sifremi-unuttum\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"ModalLabel\" aria-hidden=\"true\">\r\r\n\t\t<div class=\"modal-dialog\" role=\"document\">\r\r\n\t\t\t<div class=\"modal-content\">\r\r\n\t\t\t\t<div class=\"modal-header\">\r\r\n\t\t\t\t\t<h5 class=\"modal-title\" id=\"ModalLabel\">Parolamı Unutum?</h5>\r\r\n\t\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\r\r\n\t\t\t\t\t\t<span aria-hidden=\"true\">&times;</span>\r\r\n\t\t\t\t\t</button>\r\r\n\t\t\t\t</div>\r\r\n\t\t\t\t<form method=\"post\" action=\"../_class/yonetim_islem.php\" autocomplete=\"off\">\r\r\n\t\t\t\t\t<div class=\"modal-body\">\t\t\t\t\t\r\r\n\t\t\t\t\t\t<div class=\"form-group mb-0\">\r\r\n\t\t\t\t\t\t\t<label for=\"email\" class=\"col-form-label mb-0\">E-Posta Adresiniz</label>\r\r\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"email\" id=\"email\" />\r\r\n\t\t\t\t\t\t</div>\t\t\t\t\t\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"modal-footer\">\r\r\n\t\t\t\t\t\t<button type=\"submit\" name=\"sifirla\" class=\"btn btn-success\"><i class=\"icon-refresh\"></i> Sıfırla</button>\r\r\n\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-light\" data-dismiss=\"modal\"><i class=\"icon-close\"></i> İptal</button>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t</form>\r\r\n\t\t\t</div>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n\t";
    mesaj("kullanici_giris", 3, "bos", "Boş alan bıraktınız.");
    mesaj("kullanici_giris", 2, "no", "Kullanıcı Adı veya Şifreniz Yanlış.");
    mesaj("sifirla", 1, "yes", "Kullanıcı adınız ve şifreniz sistemde kayıtlı mail adresinize gönderilmiştir.");
    mesaj("sifirla", 2, "no", "E-Mail adresiniz sistemde kayıtlı değildir.");
    mesaj("demohesap", 3, "no", "Demo hesapta işlem yapamassınız.!");
    echo "\r\n\t<!-- endinject -->\r\r\n</body>\r\r\n</html>\r\r\n";
    ob_end_flush();
    echo "\r\n";
}

?>