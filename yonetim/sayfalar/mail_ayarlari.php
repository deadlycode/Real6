<?php


echo !defined("GUVENLIK") ? exit : NULL;
echo "\r\n";
oturumkontrol($url);
$ayar_dizi = $db->prepare("SELECT * FROM mail_ayar WHERE id = ?");
$ayar_dizi->execute([1]);
if ($ayar_dizi->rowCount()) {
    $Sonuc = $ayar_dizi->fetch(PDO::FETCH_ASSOC);
    echo "\r\n<div class=\"page-header\">\r\r\n\t<div class=\"page-title mt-0 mb-0\">\r\r\n\t\t<h3>";
    echo $admindil["txt10"];
    echo "</h3>\r\r\n\t\t<div class=\"crumbs\">\r\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\r\n\t\t\t\t<li><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt2"];
    echo "</a></li>\r\r\n\t\t\t\t<li class=\"active\"><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt10"];
    echo "</a></li>\r\r\n\t\t\t</ul>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n</div>\r\r\n<div class=\"row\">\r\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\r\n\t\t<div class=\"card\">\r\r\n\t\t\t<div class=\"card-body\">\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\">\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"m_server\">SMTP Server</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"m_server\" id=\"m_server\" value=\"";
    echo $Sonuc["m_server"];
    echo "\" />\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"m_port\">SMTP Port</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"m_port\" id=\"m_port\" value=\"";
    echo $Sonuc["m_port"];
    echo "\" />\r\r\n\t\t\t\t\t</div>\t\r\r\n\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"m_sertifika\">Mail Sertifika</label>\r\r\n\t\t\t\t\t\t<select class=\"js-example-basic-single form-control-sm\" name=\"m_sertifika\" id=\"m_sertifika\" style=\"width:100%\">\r\r\n\t\t\t\t\t\t\t<option value=\"tls\" ";
    echo $Sonuc["m_sertifika"] == "tls" ? "selected" : "";
    echo ">TLS</option>\r\r\n\t\t\t\t\t\t\t<option value=\"ssl\" ";
    echo $Sonuc["m_sertifika"] == "ssl" ? "selected" : "";
    echo ">SSL</option>\r\r\n\t\t\t\t\t\t</select>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"m_adresi\">SMTP Email</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"m_adresi\" id=\"m_adresi\" value=\"";
    echo $Sonuc["m_adresi"];
    echo "\" data-inputmask=\"'alias': 'email'\" />\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"m_parola\">SMTP Email Şifre</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"m_parola\" id=\"m_parola\" value=\"";
    echo $Sonuc["m_parola"];
    echo "\" />\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label class=\"d-block\" for=\"durum\">Aktif / Pasif</label>\r\r\n\t\t\t\t\t\t<label class=\"switch\">\r\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"durum\" id=\"durum\" value=\"1\" ";
    if ($Sonuc["durum"] == "1") {
        echo " checked ";
    }
    echo ">\r\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\r\n\t\t\t\t\t\t</label>\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"m_kime\">Mesajın Geleceği E-Posta Adresi</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"m_kime\" id=\"m_kime\" value=\"";
    echo $Sonuc["m_kime"];
    echo "\" data-inputmask=\"'alias': 'email'\" />\r\r\n\t\t\t\t\t</div>\t\t\t\t\t\t\r\r\n\t\t\t\t\t<button type=\"submit\" name=\"mail_ayarlar\" class=\"btn btn-success btn-icon-text btn-sm\">\r\r\n\t\t\t\t\t\t<i class=\"mdi mdi-spin mdi-loading\"></i>                                                   \r\r\n\t\t\t\t\t\tGÜNCELLE\r\r\n\t\t\t\t\t</button>\r\r\n\t\t\t\t</form>\r\r\n\t\t\t</div>\t\t\t\t\t\t\t\t\t\t\t\t\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n\r\r\n</div>\r\r\n";
    mesaj("mail_ayarlar", 1, "yes", "Başarı ile guncellenmiştir.");
    mesaj("mail_ayarlar", 2, "no", "Hata oluştu tekrar deneyiniz.!");
    echo "\t\r\r\n";
    
} else {
    header("Location:" . $url . "/404" . $html . "");
    exit;
}

?>