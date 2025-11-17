<?php


echo !defined("GUVENLIK") ? exit : NULL;
echo "\r\n";
oturumkontrol($url);
if (isset($_GET["islem"]) == "duzenle") {
    $durum = "duzenle";
    $Sorgu = $db->prepare("SELECT * FROM rehber WHERE id = ?");
    $Sorgu->execute([$_GET["id"]]);
    if ($Sorgu->rowCount()) {
        $Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
    } else {
        header("Location:" . $url . "/404" . $html . "");
        exit;
    }
}
echo "\r\n<div class=\"page-header\">\r\r\n\t<div class=\"page-title mt-0 mb-0\">\r\r\n\t\t<h3>";
echo $admindil["txt29"];
echo "</h3>\r\r\n\t\t<div class=\"crumbs\">\r\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\r\n\t\t\t\t<li><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt26"];
echo "</a></li>\r\r\n\t\t\t\t<li class=\"active\"><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt29"];
echo "</a></li>\r\r\n\t\t\t</ul>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n</div>\r\r\n<div class=\"row\">\r\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\r\n\t\t<div class=\"card\">\r\r\n\t\t\t<div class=\"card-body\">\r\r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\">\r\r\n\t\t\t\t<input id=\"id\" name=\"id\" type=\"hidden\" value=\"";
echo $Sonuc["id"];
echo "\">\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"adi\">Adı Soyadı</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"adi\" id=\"adi\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["adi"] : "";
echo "\" />\r\r\n\t\t\t\t\t</div>\t\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"email\">E-Mail Adresi</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"email\" id=\"email\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["email"] : "";
echo "\" />\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"telefon\">Telefon</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"telefon\" id=\"telefon\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["telefon"] : "";
echo "\" />\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label class=\"d-block\" for=\"durum\">Durum</label>\r\r\n\t\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\r\n\t\t\t\t\t\t<label class=\"switch\">\r\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"durum\" id=\"durum\" value=\"1\" ";
    if ($Sonuc["durum"] == "1") {
        echo " checked ";
    }
    echo ">\r\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\r\n\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t";
} else {
    echo "\r\n\t\t\t\t\t\t<label class=\"switch\">\r\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"durum\" id=\"durum\" value=\"1\" checked>\r\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\r\n\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t";
}
echo "\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"adi\">Notunuz</label>\r\r\n\t\t\t\t\t\t<textarea name=\"notunuz\" id=\"myTextarea\">";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["notunuz"] : "";
echo "</textarea>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\r\n\t\t\t\t\t<button type=\"submit\" name=\"rehber_guncelle\" class=\"btn btn-success btn-icon-text btn-sm\">\r\r\n\t\t\t\t\t\t<i class=\"mdi mdi-reload  btn-icon-prepend\"></i>                                                    \r\r\n\t\t\t\t\t\tGÜNCELLE\r\r\n\t\t\t\t\t</button>\r\r\n\t\t\t\t\t";
} else {
    echo "\r\n\t\t\t\t\t<button type=\"submit\" name=\"rehber_ekle\" class=\"btn btn-primary btn-icon-text btn-sm\">\r\r\n\t\t\t\t\t\t<i class=\"mdi mdi-file-check btn-icon-prepend\"></i>\r\r\n\t\t\t\t\t\tKAYDET\r\r\n\t\t\t\t\t</button>\r\r\n\t\t\t\t\t";
}
echo "\r\n\t\t\t\t</form>\r\r\n\t\t\t</div>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n\r\r\n</div>\r\r\n";
mesaj("rehber_ekle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("rehber_guncelle", 1, "yes", "Başarı ile guncellenmiştir.");
mesaj("rehber_guncelle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
echo "\t\r\r\n";


?>