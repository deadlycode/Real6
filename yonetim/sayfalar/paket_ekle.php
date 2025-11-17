<?php


echo !defined("GUVENLIK") ? exit : NULL;
echo "\r\n";
oturumkontrol($url);
if (isset($_GET["islem"]) == "duzenle") {
    $durum = "duzenle";
    $Sorgu = $db->prepare("SELECT * FROM paketler WHERE id = ?");
    $Sorgu->execute([$_GET["id"]]);
    if ($Sorgu->rowCount()) {
        $Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
    } else {
        header("Location:" . $url . "/404" . $html . "");
        exit;
    }
}
echo "\r\n<div class=\"page-header\">\r\r\n\t<div class=\"page-title mt-0 mb-0\">\r\r\n\t\t<h3>";
echo $admindil["txt124"];
echo "</h3>\r\r\n\t\t<div class=\"crumbs\">\r\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\r\n\t\t\t\t<li><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt123"];
echo "</a></li>\r\r\n\t\t\t\t<li><a href=\"paketler";
echo $html;
echo "\">";
echo $admindil["txt125"];
echo "</a></li>\r\r\n\t\t\t\t<li class=\"active\"><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt124"];
echo "</a></li>\r\r\n\t\t\t</ul>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n</div>\r\r\n<div class=\"row\">\r\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\r\n\t\t<div class=\"card\">\r\r\n\t\t\t<div class=\"card-body\">\r\r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\">\r\r\n\t\t\t\t<input id=\"id\" name=\"id\" type=\"hidden\" value=\"";
echo $Sonuc["id"];
echo "\">\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"sira\">Sıra</label>\r\r\n\t\t\t\t\t\t<input type=\"number\" class=\"form-control form-control-sm\" min=\"0\" name=\"sira\" id=\"sira\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["sira"] : "";
echo "\" />\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"adi\">Başlık <i class=\"icon-info text-info\" data-toggle=\"popover\" data-content=\"Paket adında tamamen BÜYÜK harf kullanmayın. 70 karakterden uzun başlıkları Google indexlemede göstermez ve değerlendirmez. Bu nedenle uzun başlıklar kullanmaktan kaçının. Başlıklarda çift tırnak kesinlikle kullanmayın.\" data-trigger=\"hover\" data-original-title=\"Başlık\"></i></label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"adi\" id=\"adi\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["adi"] : "";
echo "\" />\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\" style=\"overflow: hidden;\">\r\r\n\t\t\t\t\t\t<label class=\"d-block\">Fiyat</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"fiyat\" value=\"";
echo $Sonuc["fiyat"];
echo "\" style=\"width:200px;display: inline-block;float: left;\">\r\r\n\t\t\t\t\t\t<select class=\"form-control form-control-sm\" name=\"pbirim\" style=\"width:120px;float:left;height: 33px;margin-top: 1px;\">\r\r\n\t\t\t\t\t\t\t<option ";
echo $Sonuc["pbirim"] == "TL" ? "selected" : "";
echo ">TL</option>\r\r\n\t\t\t\t\t\t\t<option ";
echo $Sonuc["pbirim"] == "USD" ? "selected" : "";
echo ">USD</option>\r\r\n\t\t\t\t\t\t\t<option ";
echo $Sonuc["pbirim"] == "EURO" ? "selected" : "";
echo ">EURO</option>\t\t\t\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t</select>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\" style=\"overflow: hidden;\">\r\r\n\t\t\t\t\t\t<label class=\"d-block\">Periyod</label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"periyod_sure\" value=\"";
echo $Sonuc["periyod_sure"];
echo "\" style=\"width:200px;display: inline-block;float: left;\">\r\r\n\t\t\t\t\t\t<select class=\"form-control form-control-sm\" name=\"periyod\" style=\"width:120px;float:left;height: 33px;margin-top: 1px;\">\r\r\n\t\t\t\t\t\t\t<option value=\"0\" ";
echo $Sonuc["periyod"] == "0" ? "selected" : "";
echo ">Tek Sefer</option>\r\r\n\t\t\t\t\t\t\t<option value=\"1\" ";
echo $Sonuc["periyod"] == "1" ? "selected" : "";
echo ">Aylık</option>\r\r\n\t\t\t\t\t\t\t<option value=\"2\" ";
echo $Sonuc["periyod"] == "2" ? "selected" : "";
echo ">Yıllık</option>\t\t\t\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t</select>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"kategori\">Kategori</label>\r\r\n\t\t\t\t\t\t<select class=\"js-example-basic-single form-control-sm\" name=\"kategori\" id=\"kategori\" required style=\"width:100%\">\r\r\n\t\t\t\t\t\t";
$KATEGORISorgu = $db->prepare("SELECT * FROM paket_kategori WHERE durum = ? AND dil = ? ORDER BY id ASC");
$KATEGORISorgu->execute(["1", $_SESSION["admin_dil"]]);
$KATEGORIislem = $KATEGORISorgu->fetchALL(PDO::FETCH_ASSOC);
echo "\r\n\t\t\t\t\t\t\t";
foreach ($KATEGORIislem as $KATEGORISonuc) {
    echo "\r\n\t\t\t\t\t\t\t<option value=\"";
    echo $KATEGORISonuc["id"];
    echo "\" ";
    echo $Sonuc["kategori"] == $KATEGORISonuc["id"] ? "selected" : "";
    echo ">";
    echo $KATEGORISonuc["adi"];
    echo "</option>\r\r\n\t\t\t\t\t\t\t";
}
echo "\r\n\t\t\t\t\t\t</select>\r\r\n\t\t\t\t\t</div>\r\r\n\r\r\n\t\t\t\t\t<div class=\"form-group mb-2\">\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\r\n\t\t\t\t\t\t<label class=\"switch\">\r\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"durum\" id=\"durum\" value=\"1\" ";
    if ($Sonuc["durum"] == "1") {
        echo " checked ";
    }
    echo ">\r\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\r\n\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t";
} else {
    echo "\r\n\t\t\t\t\t\t<label class=\"switch\">\r\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"durum\" id=\"durum\" value=\"1\" checked>\r\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\r\n\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t";
}
echo "\r\n\t\t\t\t\t\t<label class=\"d-inline-block\" style=\"line-height: 34px;\" for=\"durum\">Durum</label>\t\t\t\t\t\t\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"link\">Satın Al Harici Link <i class=\"icon-info text-info\" data-toggle=\"popover\" data-content=\"Var ise yazınız.(http kullanarak)\" data-trigger=\"hover\" data-original-title=\"Satın Al Harici Link\"></i></label>\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"link\" id=\"link\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["link"] : "";
echo "\" />\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"ozellikler\">Özellikler <i class=\"icon-info text-info\" data-toggle=\"popover\" data-content=\"Özellikler alt alta gelecek şekilde yazınız.\" data-trigger=\"hover\" data-original-title=\"Özellikler\"></i></label>\r\r\n\t\t\t\t\t\t<textarea id=\"ozellikler\" name=\"ozellikler\" class=\"form-control\" rows=\"8\">";
echo isset($_GET["islem"]) == "duzenle" ? implode("\n", explode(",", $Sonuc["ozellikler"])) : "";
echo "</textarea>\r\r\n\t\t\t\t\t</div>\t\t\t\t\t\r\r\n\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\r\n\t\t\t\t\t<button type=\"submit\" name=\"paket_guncelle\" class=\"btn btn-success btn-icon-text btn-sm\">\r\r\n\t\t\t\t\t\t<i class=\"mdi mdi-reload  btn-icon-prepend\"></i>                                                    \r\r\n\t\t\t\t\t\tGÜNCELLE\r\r\n\t\t\t\t\t</button>\r\r\n\t\t\t\t\t";
} else {
    echo "\r\n\t\t\t\t\t<button type=\"submit\" name=\"paket_ekle\" class=\"btn btn-primary btn-icon-text btn-sm\">\r\r\n\t\t\t\t\t\t<i class=\"mdi mdi-file-check btn-icon-prepend\"></i>\r\r\n\t\t\t\t\t\tKAYDET\r\r\n\t\t\t\t\t</button>\r\r\n\t\t\t\t\t";
}
echo "\r\n\t\t\t\t</form>\r\r\n\t\t\t</div>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n\r\r\n</div>\r\r\n";
mesaj("paket_ekle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("paket_guncelle", 1, "yes", "Başarı ile guncellenmiştir.");
mesaj("paket_guncelle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
echo "\r\n";


?>