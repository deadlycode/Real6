<?php


echo !defined("GUVENLIK") ? exit : NULL;
echo "\r\n";
oturumkontrol($url);
if (isset($_GET["islem"]) == "duzenle") {
    $durum = "duzenle";
    $Sorgu = $db->prepare("SELECT * FROM bildirim_sablonu WHERE id = ?");
    $Sorgu->execute([$_GET["id"]]);
    if ($Sorgu->rowCount()) {
        $Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
        echo "\r\n<div class=\"page-header\">\r\r\n\t<div class=\"page-title mt-0 mb-0\">\r\r\n\t\t<h3>";
        echo $admindil["txt33"];
        echo "</h3>\r\r\n\t\t<div class=\"crumbs\">\r\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\r\n\t\t\t\t<li><a href=\"";
        echo $sayfalink;
        echo "\">";
        echo $admindil["txt26"];
        echo "</a></li>\r\r\n\t\t\t\t<li class=\"active\"><a href=\"";
        echo $sayfalink;
        echo "\">";
        echo $admindil["txt33"];
        echo "</a></li>\r\r\n\t\t\t</ul>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n</div>\r\r\n<div class=\"row\">\r\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\r\n\t\t<div class=\"card\">\r\r\n\t\t\t<div class=\"card-body\">\r\r\n\t\t\t\t<label class=\"badge badge-primary\" style=\"font-size:15px;\">";
        echo $Sonuc["sablon_adi"];
        echo "</label>\r\r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\">\r\r\n\t\t\t\t<input id=\"id\" name=\"id\" type=\"hidden\" value=\"";
        echo $Sonuc["id"];
        echo "\">\r\r\n\t\t\t\t\t<div class=\"card mb-4\">\r\r\n\t\t\t\t\t\t<div class=\"card-header\">\r\r\n\t\t\t\t\t\t\tÜye'ye E-Posta Gönder\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t<div class=\"card-body m-0 p-0 pl-3\">\r\r\n\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\r\n\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\r\n\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"ubildirim\" id=\"ubildirim_sec1\" value=\"1\" ";
        if ($Sonuc["ubildirim"] == "1") {
            echo " checked ";
        }
        echo " checked>\r\r\n\t\t\t\t\t\t\t\t\tAktif\r\r\n\t\t\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t<div class=\"form-check form-check-danger d-inline-block mr-2\">\r\r\n\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\r\n\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"ubildirim\" id=\"ubildirim_sec2\" value=\"0\" ";
        if ($Sonuc["ubildirim"] == "0") {
            echo " checked ";
        }
        echo ">\r\r\n\t\t\t\t\t\t\t\t\tPasif\r\r\n\t\t\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"card mb-4\">\r\r\n\t\t\t\t\t\t<div class=\"card-header\">\r\r\n\t\t\t\t\t\t\tÜye'ye SMS Gönder\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t<div class=\"card-body m-0 p-0 pl-3\">\r\r\n\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\r\n\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\r\n\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"sbildirim\" id=\"sbildirim_sec1\" value=\"1\" ";
        if ($Sonuc["sbildirim"] == "1") {
            echo " checked ";
        }
        echo " checked>\r\r\n\t\t\t\t\t\t\t\t\tAktif\r\r\n\t\t\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t<div class=\"form-check form-check-danger d-inline-block mr-2\">\r\r\n\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\r\n\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"sbildirim\" id=\"sbildirim_sec2\" value=\"0\" ";
        if ($Sonuc["sbildirim"] == "0") {
            echo " checked ";
        }
        echo ">\r\r\n\t\t\t\t\t\t\t\t\tPasif\r\r\n\t\t\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"card mb-4\">\r\r\n\t\t\t\t\t\t<div class=\"card-header\">\r\r\n\t\t\t\t\t\t\tYönetici'ye E-Posta Gönder\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t<div class=\"card-body m-0 p-0 pl-3\">\r\r\n\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\r\n\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\r\n\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"abildirim\" id=\"abildirim_sec1\" value=\"1\" ";
        if ($Sonuc["abildirim"] == "1") {
            echo " checked ";
        }
        echo " checked>\r\r\n\t\t\t\t\t\t\t\t\tAktif\r\r\n\t\t\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t<div class=\"form-check form-check-danger d-inline-block mr-2\">\r\r\n\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\r\n\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"abildirim\" id=\"abildirim_sec2\" value=\"0\" ";
        if ($Sonuc["abildirim"] == "0") {
            echo " checked ";
        }
        echo ">\r\r\n\t\t\t\t\t\t\t\t\tPasif\r\r\n\t\t\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"card mb-4\">\r\r\n\t\t\t\t\t\t<div class=\"card-header\">\r\r\n\t\t\t\t\t\t\tYönetici'ye SMS Gönder\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t<div class=\"card-body m-0 p-0 pl-3\">\r\r\n\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\r\n\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\r\n\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"ysbildirim\" id=\"ysbildirim_sec1\" value=\"1\" ";
        if ($Sonuc["ysbildirim"] == "1") {
            echo " checked ";
        }
        echo " checked>\r\r\n\t\t\t\t\t\t\t\t\tAktif\r\r\n\t\t\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t<div class=\"form-check form-check-danger d-inline-block mr-2\">\r\r\n\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\r\n\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"ysbildirim\" id=\"ysbildirim_sec2\" value=\"0\" ";
        if ($Sonuc["ysbildirim"] == "0") {
            echo " checked ";
        }
        echo ">\r\r\n\t\t\t\t\t\t\t\t\tPasif\r\r\n\t\t\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group ubildirim\">\r\r\n\t\t\t\t\t\t<label for=\"konu\">E-Posta Konu Başlığı (Üye)</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"konu\" id=\"konu\" value=\"";
        echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["konu"] : "";
        echo "\" />\r\r\n\t\t\t\t\t</div>\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t<div class=\"form-group abildirim\">\r\r\n\t\t\t\t\t\t<label for=\"konu2\">E-Posta Konu Başlığı (Yönetici)</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"konu2\" id=\"konu2\" value=\"";
        echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["konu2"] : "";
        echo "\" />\r\r\n\t\t\t\t\t</div>\r\r\n\r\r\n\t\t\t\t\t<div class=\"form-group ubildirim\">\r\r\n\t\t\t\t\t\t<label for=\"adi\">Üye'ye Gidecek E-Posta</label>\r\r\n\t\t\t\t\t\t<textarea name=\"icerik\" id=\"myTextarea\">";
        echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["icerik"] : "";
        echo "</textarea>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\r\r\n\t\t\t\t\t<div class=\"form-group abildirim\">\r\r\n\t\t\t\t\t\t<label for=\"adi\">Yönetici'ye Gidecek E-Posta</label>\r\r\n\t\t\t\t\t\t<textarea name=\"icerik2\" id=\"myTextarea\">";
        echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["icerik2"] : "";
        echo "</textarea>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\r\r\n\t\t\t\t\t<div class=\"form-group sbildirim\">\r\r\n\t\t\t\t\t\t<label for=\"icerik3\">Üye'ye Gidecek SMS</label>\r\r\n\t\t\t\t\t\t<textarea name=\"icerik3\" class=\"form-control\" id=\"icerik3\" rows=\"9\">";
        echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["icerik3"] : "";
        echo "</textarea>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\r\r\n\t\t\t\t\t<div class=\"form-group ysbildirim\">\r\r\n\t\t\t\t\t\t<label for=\"icerik4\">Yönetici'ye Gidecek SMS</label>\r\r\n\t\t\t\t\t\t<textarea name=\"icerik4\" class=\"form-control\" id=\"icerik4\" rows=\"9\">";
        echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["icerik4"] : "";
        echo "</textarea>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"alert alert-info\" role=\"alert\">\r\r\n\t\t\t\t\t\tDeğişkenler : <strong>";
        echo $Sonuc["degiskenler"];
        echo "</strong>  Belirtilen değişkenleri içerik'de istediğiniz yere koyarak bildirim'de belirtilmesini sağlayabilirsiniz.\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<button type=\"submit\" name=\"sablon_guncelle\" class=\"btn btn-success btn-icon-text btn-sm\">\r\r\n\t\t\t\t\t\t<i class=\"mdi mdi-reload  btn-icon-prepend\"></i>                                                    \r\r\n\t\t\t\t\t\tKAYDET\r\r\n\t\t\t\t\t</button>\r\r\n\t\t\t\t</form>\r\r\n\t\t\t</div>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n\r\r\n</div>\r\r\n<script>\r\r\n\$(document).ready(function(e) {\r\r\n\t\$('input[name=ubildirim]').bind('change', ubildirim);\r\r\n\t\$('input[name=abildirim]').bind('change', abildirim);\r\r\n\t\$('input[name=sbildirim]').bind('change', sbildirim);\r\r\n\t\$('input[name=ysbildirim]').bind('change', ysbildirim);\r\r\n});\r\r\nfunction ubildirim(){\r\r\n\tvar secilen = \$(this).val();\r\r\n\tif (secilen == 0) {\r\r\n\t\t\$(\".ubildirim\").slideUp(500);\r\r\n\t} else {\r\r\n\t\t\$(\".ubildirim\").slideDown(500);\r\r\n\t}\r\r\n}\r\r\nfunction abildirim(){\r\r\n\tvar secilen = \$(this).val();\r\r\n\tif (secilen == 0) {\r\r\n\t\t\$(\".abildirim\").slideUp(500);\r\r\n\t} else {\r\r\n\t\t\$(\".abildirim\").slideDown(500);\r\r\n\t}\r\r\n}\r\r\nfunction sbildirim(){\r\r\n\tvar secilen = \$(this).val();\r\r\n\tif (secilen == 0) {\r\r\n\t\t\$(\".sbildirim\").slideUp(500);\r\r\n\t} else {\r\r\n\t\t\$(\".sbildirim\").slideDown(500);\r\r\n\t}\r\r\n}\r\r\nfunction ysbildirim(){\r\r\n\tvar secilen = \$(this).val();\r\r\n\tif (secilen == 0) {\r\r\n\t\t\$(\".ysbildirim\").slideUp(500);\r\r\n\t} else {\r\r\n\t\t\$(\".ysbildirim\").slideDown(500);\r\r\n\t}\r\r\n}\r\r\n\$('input[name=ubildirim]').ready(function(){\r\r\n\tvar secilen = \$(\"input[name=ubildirim]:checked\").val();\r\r\n\tif (secilen == 0) {\r\r\n\t\t\$(\".ubildirim\").slideUp(0);\r\r\n\t} else {\r\r\n\t\t\$(\".ubildirim\").slideDown(0);\r\r\n\t}\r\r\n});\r\r\n\r\r\n\$('input[name=abildirim]').ready(function(){\r\r\n\tvar secilen = \$(\"input[name=abildirim]:checked\").val();\r\r\n\tif (secilen == 0) {\r\r\n\t\t\$(\".abildirim\").slideUp(0);\r\r\n\t} else {\r\r\n\t\t\$(\".abildirim\").slideDown(0);\r\r\n\t}\r\r\n});\r\r\n\r\r\n\$('input[name=sbildirim]').ready(function(){\r\r\n\tvar secilen = \$(\"input[name=sbildirim]:checked\").val();\r\r\n\tif (secilen == 0) {\r\r\n\t\t\$(\".sbildirim\").slideUp(0);\r\r\n\t} else {\r\r\n\t\t\$(\".sbildirim\").slideDown(0);\r\r\n\t}\r\r\n});\r\r\n\r\r\n\$('input[name=ysbildirim]').ready(function(){\r\r\n\tvar secilen = \$(\"input[name=ysbildirim]:checked\").val();\r\r\n\tif (secilen == 0) {\r\r\n\t\t\$(\".ysbildirim\").slideUp(0);\r\r\n\t} else {\r\r\n\t\t\$(\".ysbildirim\").slideDown(0);\r\r\n\t}\r\r\n});\r\r\n\r\r\nfunction tumunu_gizle() {\r\r\n    \$(\".ubildirim,.abildirim,.sbildirim,.ysbildirim\").slideUp(500);\r\r\n}\r\r\n</script>\r\r\n";
        mesaj("sablon_guncelle", 1, "yes", "Başarı ile guncellenmiştir.");
        mesaj("sablon_guncelle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
        echo "\t\r\r\n";
        
    } else {
        header("Location:" . $url . "/404" . $html . "");
        exit;
    }
} else {
    header("Location:" . $url . "/404" . $html . "");
    exit;
}

?>