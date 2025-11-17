<?php


echo !defined("GUVENLIK") ? exit : NULL;
oturumkontrol($url);
if (isset($_GET["islem"]) == "duzenle") {
    $sayfaid = $_GET["id"];
    $durum = "duzenle";
    $Sorgu = $db->prepare("SELECT * FROM menu WHERE id = ? AND dil = ?");
    $Sorgu->execute([$sayfaid, $_SESSION["admin_dil"]]);
    if ($Sorgu->rowCount()) {
        $Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
    } else {
        header("Location:" . $url . "/404" . $html . "");
        exit;
    }
}
echo "<div class=\"page-header\"> \r\n\t<div class=\"page-title mt-0 mb-0\">\r\n\t\t<h3>";
echo $admindil["txt19"];
echo "</h3>\r\n\t\t<div class=\"crumbs\">\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\n\t\t\t\t<li><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt17"];
echo "</a></li>\r\n\t\t\t\t<li class=\"active\"><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt19"];
echo "</a></li>\r\n\t\t\t</ul>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n<div class=\"row\">\r\n\t<div class=\"col-lg-6 grid-margin stretch-card\">\r\n\t\t<div class=\"card\">\r\n\t\t\t<div class=\"card-body\">                        \r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\">\r\n\t\t\t\t\t<input id=\"id\" name=\"id\" type=\"hidden\" value=\"";
echo $Sonuc["id"];
echo "\">\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"menu_ust\">Üst Menü Seç</label>\r\n\t\t\t\t\t\t<select class=\"js-example-basic-single form-control-sm\" name=\"menu_ust\" id=\"menu_ust\" required style=\"width:100%\">\r\n\t\t\t\t\t\t\t<option value=\"0\">Üst Menü</option>\r\n\t\t\t\t\t\t\t";
$MENUSorgu = $db->prepare("SELECT * FROM menu WHERE menu_ust = ? AND dil = ? ORDER BY menu_sira ASC");
$MENUSorgu->execute(["0", $_SESSION["admin_dil"]]);
$MENUislem = $MENUSorgu->fetchALL(PDO::FETCH_ASSOC);
echo "\t\t\t\t\t\t\t";
foreach ($MENUislem as $MENUSonuc) {
    echo "\t\t\t\t\t\t\t<option value=\"";
    echo $MENUSonuc["id"];
    echo "\" ";
    echo $Sonuc["menu_ust"] == $MENUSonuc["id"] ? "selected" : "";
    echo ">";
    echo $MENUSonuc["menu_isim"];
    echo "</option>\r\n\t\t\t\t\t\t\t";
}
echo "\t\t\t\t\t\t</select>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"menu_sira\">Menü Sıra</label>\r\n\t\t\t\t\t\t<input type=\"number\" min=\"0\" class=\"form-control form-control-sm\" name=\"menu_sira\" id=\"menu_sira\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["menu_sira"] : "";
echo "\" />\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label for=\"menu_isim\">Menü Adı</label>\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"menu_isim\" required id=\"menu_isim\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["menu_isim"] : "";
echo "\" />\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group tip\">\r\n\t\t\t\t\t\t<label for=\"tip\">Otomatik Listeleme</label>\r\n\t\t\t\t\t\t<select class=\"js-example-basic-single form-control-sm\" name=\"tip\" id=\"tip\" required style=\"width:100%\">\t\t\t\t\t\r\n\t\t\t\t\t\t\t<option value=\"0\" ";
echo $Sonuc["tip"] == 0 ? "selected" : "";
echo " >Otomatik listeleme Yok</option>\r\n\t\t\t\t\t\t\t<option value=\"1\" ";
echo $Sonuc["tip"] == 1 ? "selected" : "";
echo " >Emlak Kategori</option>\r\n\t\t\t\t\t\t\t<option value=\"2\" ";
echo $Sonuc["tip"] == 2 ? "selected" : "";
echo " >Emlaklar</option>\r\n\t\t\t\t\t\t\t<option value=\"3\" ";
echo $Sonuc["tip"] == 3 ? "selected" : "";
echo " >Proje Kategori</option>\r\n\t\t\t\t\t\t\t<option value=\"4\" ";
echo $Sonuc["tip"] == 4 ? "selected" : "";
echo " >Projeler</option>\r\n\t\t\t\t\t\t\t<option value=\"5\" ";
echo $Sonuc["tip"] == 5 ? "selected" : "";
echo " >Hizmetler</option>\t\t\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t</select>\r\n\t\t\t\t\t</div>\r\n\r\n\t\t\t\t\t<div class=\"form-group katlimit\">\r\n\t\t\t\t\t\t<label for=\"klimit\">Otomatik Listeleme Limiti</label>\r\n\t\t\t\t\t\t<input type=\"number\" class=\"form-control form-control-sm\" min=\"0\" name=\"klimit\" id=\"klimit\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["klimit"] : "";
echo "\" />\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t\r\n\t\t\t\t\t<div class=\"form-group katlimit\">\r\n\t\t\t\t\t\t<label for=\"tbuton\">Tümünü gör buton linki (Eğer tümünü gör butonunu istemiyorsanız bu alanı boş bırakınız) </label>\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"tbuton\" id=\"tbuton\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["tbuton"] : "";
echo "\" />\r\n\t\t\t\t\t</div>\t\r\n\t\t\t\t\t<style>\r\n\t\t\t\t.select2-container--default .select2-results>.select2-results__options {\r\n\t\t\t\t\t\tmax-height: 600px !important;\r\n\t\t\t\t\t\toverflow-y: auto;\r\n\t\t\t\t\t}\r\n\t\t\t\t\t</style>\r\n\t\t\t\t\t\r\n\t\t\t\t\t<div class=\"form-group sayfalar\">\r\n\t\t\t\t\t\t<label for=\"menu_url\">Bağlantı Sayfası</label>\r\n\t\t\t\t\t\t<select name=\"menu_url\" id=\"menu_url\" class=\"js-example-basic-single form-control-sm\" style=\"width:100%\">\r\n\t\t\t\t\t\t<option value=\"0\">Diğer (Manuel Link Ekle)</option>\t\t\t\t\t\t\r\n\t\t\t\t\t\t<optgroup label=\"Emlak Kategori\">\t\t\t\t\t\t\r\n\t\t\t\t\t\t";
panelmenukategori(0, 0, $Sonuc["ustid"], $Sonuc["menu_url"]);
echo "\t\t\t\t\t\r\n\t\t\t\t\t\t</optgroup>\r\n\t\t\t\t\t\t<optgroup label=\"Sayfalarım\">\r\n\t\t\t\t\t\t";
$SAYFASorgu = $db->prepare("SELECT * FROM sayfalar WHERE durum = ? AND dil = ? ORDER BY id ASC");
$SAYFASorgu->execute(["1", $_SESSION["admin_dil"]]);
$SAYFAislem = $SAYFASorgu->fetchALL(PDO::FETCH_ASSOC);
echo "\t\t\t\t\t\t\t";
foreach ($SAYFAislem as $SAYFASonuc) {
    echo "\t\t\t\t\t\t\t<option value=\"";
    echo $htc["sayfaurl"];
    echo "/";
    echo $SAYFASonuc["seo"];
    echo "\" ";
    echo $Sonuc["menu_url"] == "" . $htc["sayfaurl"] . "/" . $SAYFASonuc["seo"] . "" ? "selected" : "";
    echo ">";
    echo $SAYFASonuc["adi"];
    echo "</option>\r\n\t\t\t\t\t\t\t";
}
echo "\t\t\t\t\t\t</optgroup>\r\n\t\t\t\t\t\t<optgroup label=\"Proje Kategori\">\r\n\t\t\t\t\t\t";
$HSorgu = $db->prepare("SELECT * FROM proje_kategori WHERE durum = ? AND dil = ? ORDER BY id ASC");
$HSorgu->execute(["1", $_SESSION["admin_dil"]]);
$Hislem = $HSorgu->fetchALL(PDO::FETCH_ASSOC);
echo "\t\t\t\t\t\t\t";
foreach ($Hislem as $HSonuc) {
    echo "\t\t\t\t\t\t\t<option value=\"";
    echo $htc["projekategoriurl"];
    echo "/";
    echo $HSonuc["seo"];
    echo "\" ";
    echo $Sonuc["menu_url"] == "" . $htc["projekategoriurl"] . "/" . $HSonuc["seo"] . "" ? "selected" : "";
    echo ">";
    echo $HSonuc["adi"];
    echo "</option>\r\n\t\t\t\t\t\t\t";
}
echo "\t\t\t\t\t\t</optgroup>\r\n\t\t\t\t\t\t<optgroup label=\"Projeler\">\r\n\t\t\t\t\t\t";
$HSorgu = $db->prepare("SELECT * FROM projeler WHERE durum = ? AND dil = ? ORDER BY id ASC");
$HSorgu->execute(["1", $_SESSION["admin_dil"]]);
$Hislem = $HSorgu->fetchALL(PDO::FETCH_ASSOC);
echo "\t\t\t\t\t\t\t";
foreach ($Hislem as $HSonuc) {
    echo "\t\t\t\t\t\t\t<option value=\"";
    echo $htc["projedetayurl"];
    echo "/";
    echo $HSonuc["seo"];
    echo "\" ";
    echo $Sonuc["menu_url"] == "" . $htc["projedetayurl"] . "/" . $HSonuc["seo"] . "" ? "selected" : "";
    echo ">";
    echo $HSonuc["adi"];
    echo "</option>\r\n\t\t\t\t\t\t\t";
}
echo "\t\t\t\t\t\t</optgroup>\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t\t<optgroup label=\"Haberler\">\r\n\t\t\t\t\t\t";
$HSorgu = $db->prepare("SELECT * FROM haberler WHERE durum = ? AND dil = ? ORDER BY id ASC");
$HSorgu->execute(["1", $_SESSION["admin_dil"]]);
$Hislem = $HSorgu->fetchALL(PDO::FETCH_ASSOC);
echo "\t\t\t\t\t\t\t";
foreach ($Hislem as $HSonuc) {
    echo "\t\t\t\t\t\t\t<option value=\"";
    echo $htc["haberdetayurl"];
    echo "/";
    echo $HSonuc["seo"];
    echo "\" ";
    echo $Sonuc["menu_url"] == "" . $htc["haberdetayurl"] . "/" . $HSonuc["seo"] . "" ? "selected" : "";
    echo ">";
    echo $HSonuc["adi"];
    echo "</option>\r\n\t\t\t\t\t\t\t";
}
echo "\t\t\t\t\t\t</optgroup>\r\n\t\t\t\t\t\t<optgroup label=\"Hizmetler\">\r\n\t\t\t\t\t\t";
$HSorgu = $db->prepare("SELECT * FROM hizmetler WHERE durum = ? AND dil = ? ORDER BY id ASC");
$HSorgu->execute(["1", $_SESSION["admin_dil"]]);
$Hislem = $HSorgu->fetchALL(PDO::FETCH_ASSOC);
echo "\t\t\t\t\t\t\t";
foreach ($Hislem as $HSonuc) {
    echo "\t\t\t\t\t\t\t<option value=\"";
    echo $htc["hizmetdetayurl"];
    echo "/";
    echo $HSonuc["seo"];
    echo "\" ";
    echo $Sonuc["menu_url"] == "" . $htc["hizmetdetayurl"] . "/" . $HSonuc["seo"] . "" ? "selected" : "";
    echo ">";
    echo $HSonuc["adi"];
    echo "</option>\r\n\t\t\t\t\t\t\t";
}
echo "\t\t\t\t\t\t</optgroup>\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t\t<optgroup label=\"Sabit Sayfalar\">\r\n\t\t\t\t\t\t\t<option value=\"";
echo $htc["anaurl"];
echo "\" ";
echo $Sonuc["menu_url"] == "" . $htc["anaurl"] ? "selected" : "";
echo ">Anasayfa</option>\r\n\t\t\t\t\t\t\t<option value=\"";
echo $htc["emlakurl"];
echo "\" ";
echo $Sonuc["menu_url"] == "" . $htc["emlakurl"] . "" ? "selected" : "";
echo ">İlanlar</option>\r\n\t\t\t\t\t\t\t<option value=\"";
echo $htc["projelerurl"];
echo "\" ";
echo $Sonuc["menu_url"] == "" . $htc["projelerurl"] . "" ? "selected" : "";
echo ">Projeler</option>\r\n\t\t\t\t\t\t\t<option value=\"";
echo $htc["haberurl"];
echo "\" ";
echo $Sonuc["menu_url"] == "" . $htc["haberurl"] . "" ? "selected" : "";
echo ">Haberler</option>\r\n\t\t\t\t\t\t\t<option value=\"";
echo $htc["hizmeturl"];
echo "\" ";
echo $Sonuc["menu_url"] == "" . $htc["hizmeturl"] . "" ? "selected" : "";
echo ">Hizmetlerimiz</option>\r\n\t\t\t\t\t\t\t<option value=\"";
echo $htc["belgeurl"];
echo "\" ";
echo $Sonuc["menu_url"] == "" . $htc["belgeurl"] . "" ? "selected" : "";
echo ">Belgelerimiz</option>\r\n\t\t\t\t\t\t\t<option value=\"";
echo $htc["ekiburl"];
echo "\" ";
echo $Sonuc["menu_url"] == "" . $htc["ekiburl"] . "" ? "selected" : "";
echo ">Ekibimiz</option>\r\n\t\t\t\t\t\t\t<option value=\"";
echo $htc["refurl"];
echo "\" ";
echo $Sonuc["menu_url"] == "" . $htc["refurl"] . "" ? "selected" : "";
echo ">Referanslarımız</option>\r\n\t\t\t\t\t\t\t<option value=\"";
echo $htc["musteriurl"];
echo "\" ";
echo $Sonuc["menu_url"] == "" . $htc["musteriurl"] . "" ? "selected" : "";
echo ">Müşteri Görüşleri</option>\r\n\t\t\t\t\t\t\t<option value=\"";
echo $htc["katalogurl"];
echo "\" ";
echo $Sonuc["menu_url"] == "" . $htc["katalogurl"] . "" ? "selected" : "";
echo ">E-Katalog</option>\t\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t<option value=\"";
echo $htc["sssurl"];
echo "\" ";
echo $Sonuc["menu_url"] == "" . $htc["sssurl"] . "" ? "selected" : "";
echo ">SSS</option>\r\n\t\t\t\t\t\t\t<option value=\"";
echo $htc["ikurl"];
echo "\" ";
echo $Sonuc["menu_url"] == "" . $htc["ikurl"] . "" ? "selected" : "";
echo ">İnsan Kaynakları</option>\r\n\t\t\t\t\t\t\t<option value=\"";
echo $htc["bankahesapurl"];
echo "\" ";
echo $Sonuc["menu_url"] == "" . $htc["bankahesapurl"] . "" ? "selected" : "";
echo ">Banka Hesapları</option>\r\n\t\t\t\t\t\t\t";
if ($moduller["alan18"] == "1") {
    echo "\t\t\t\t\t\t\t<option value=\"";
    echo $htc["girisyapurl"];
    echo "\" ";
    echo $Sonuc["menu_url"] == "" . $htc["girisyapurl"] . "" ? "selected" : "";
    echo ">Giriş Yap</option>\r\n\t\t\t\t\t\t\t<option value=\"";
    echo $htc["hesabimurl"];
    echo "\" ";
    echo $Sonuc["menu_url"] == "" . $htc["hesabimurl"] . "" ? "selected" : "";
    echo ">Hesap Oluştur</option>\r\n\t\t\t\t\t\t\t";
}
echo "\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t<option value=\"";
echo $htc["iletisimurl"];
echo "\" ";
echo $Sonuc["menu_url"] == "" . $htc["iletisimurl"] . "" ? "selected" : "";
echo ">İletisim</option>\r\n\t\t\t\t\t\t</optgroup>\r\n\t\t\t\t\t\t</select>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group link sayfalar\">\r\n\t\t\t\t\t\t<label for=\"link\">Bağlantı Adresi (Manuel Link Ekle)</label>\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"link\" id=\"link\" value=\"";
echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["link"] : "";
echo "\" />\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group sayfalar\">\r\n\t\t\t\t\t\t<div class=\"form-check form-check-flat form-check-primary\">\r\n\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"sekme\" ";
if ($Sonuc["sekme"] == "1") {
    echo " checked ";
}
echo " class=\"form-check-input\">\r\n\t\t\t\t\t\t\tTıklandığında yeni sekmeye gitsin mi ?\r\n\t\t\t\t\t\t\t<i class=\"input-helper\"></i></label>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t\t<label class=\"d-block\" for=\"menu_durum\">Menü Durumu</label>\r\n\t\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\t\t\t\t\t\t<label class=\"switch\">\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"menu_durum\" id=\"menu_durum\" value=\"1\" ";
    if ($Sonuc["menu_durum"] == "1") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\n\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t";
} else {
    echo "\t\t\t\t\t\t<label class=\"switch\">\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"menu_durum\" id=\"menu_durum\" value=\"1\" checked>\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\n\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t";
}
echo "\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t";
if (isset($_GET["islem"]) == "duzenle") {
    echo "\t\t\t\t\t<button type=\"submit\" name=\"MenuGuncelle\" class=\"btn btn-primary mr-2 btn-sm\"><i class=\"mdi mdi-spin mdi-loading\"></i> Güncelle</button>\r\n\t\t\t\t\t<a href=\"header-menu.html\" class=\"btn btn-success btn-sm\">\r\n\t\t\t\t\t\t<span class=\"btn-label\"><i class=\"mdi mdi-spin mdi-loading\"></i></span> Yeni Ekle\r\n\t\t\t\t\t</a>\r\n\t\t\t\t\t";
} else {
    echo "\t\t\t\t\t<button type=\"submit\" name=\"MenuKaydet\" class=\"btn btn-primary mr-2 btn-sm\"><i class=\"mdi mdi-spin mdi-loading\"></i>  Kaydet</button>\r\n\t\t\t\t\t";
}
echo "\t\t\t\t</form>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n\t<div class=\"col-lg-6 grid-margin stretch-card \">\r\n\t\t<div class=\"card\">\r\n\t\t\t<div class=\"card-body\">    \r\n\t\t\t\t<div class=\"clearfix m-b-20\">\r\n\t\t\t\t\t<div class=\"dd nestable-with-handle\">\r\n\t\t\t\t\t\t<ol class=\"dd-list\">\r\n\t\t\t\t\t\t";
$USTMENUSorgu = $db->prepare("SELECT * FROM menu WHERE menu_ust = ? AND dil = ? ORDER BY menu_sira ASC");
$USTMENUSorgu->execute(["0", $_SESSION["admin_dil"]]);
$USTMENUislem = $USTMENUSorgu->fetchALL(PDO::FETCH_ASSOC);
echo "\t\t\t\t\t\t\t";
foreach ($USTMENUislem as $USTMENUSonuc) {
    echo "\t\t\t\t\t\t\t<li class=\"dd-item dd3-item\">\r\n\t\t\t\t\t\t\t\t<div class=\"dd-handle dd3-handle\">";
    echo $USTMENUSonuc["menu_sira"];
    echo "</div>\r\n\t\t\t\t\t\t\t\t<div class=\"dd3-content ";
    echo $USTMENUSonuc["menu_durum"] == 1 ? "aktif-menu" : "pasif-menu";
    echo "\">";
    echo $USTMENUSonuc["menu_isim"];
    echo " \r\n\t\t\t\t\t\t\t\t\t<div class=\"nestablebtns\">\r\n\t\t\t\t\t\t\t\t\t\t<a data-toggle=\"tooltip\" data-placement=\"top\" title=\"Düzenle\" href=\"header-menu-duzenle/";
    echo $USTMENUSonuc["id"];
    echo ".html\"><i class=\"ti-pencil-alt\"></i></a>\r\n\t\t\t\t\t\t\t\t\t\t<a data-toggle=\"tooltip\" data-placement=\"top\" title=\"Sil\" class=\"popconfirm\" href=\"../_class/yonetim_islem.php?menusil=ok&id=";
    echo $USTMENUSonuc["id"];
    echo "\"><i class=\"ti-trash\"></i></a>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t";
    $ALTMENUSorgu = $db->prepare("SELECT * FROM menu WHERE menu_ust = ? AND dil = ? ORDER BY menu_sira ASC");
    $ALTMENUSorgu->execute([$USTMENUSonuc["id"], $_SESSION["admin_dil"]]);
    $ALTMENUislem = $ALTMENUSorgu->fetchALL(PDO::FETCH_ASSOC);
    echo "\t\t\t\t\t\t\t\t";
    foreach ($ALTMENUislem as $ALTMENUSonuc) {
        echo "\t\t\t\t\t\t\t\t<ol class=\"dd-list\">\r\n\t\t\t\t\t\t\t\t\t<li class=\"dd-item dd3-item\">\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"dd-handle dd3-handle\">";
        echo $ALTMENUSonuc["menu_sira"];
        echo "</div>\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"dd3-content ";
        echo $ALTMENUSonuc["menu_durum"] == 1 ? "aktif-menu" : "pasif-menu";
        echo "\">";
        echo $ALTMENUSonuc["menu_isim"];
        echo "\t\t\t\t\t\t\t\t\t\t\t<div class=\"nestablebtns\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<a data-toggle=\"tooltip\" data-placement=\"top\" title=\"Düzenle\" href=\"header-menu-duzenle/";
        echo $ALTMENUSonuc["id"];
        echo ".html\"><i class=\"ti-pencil-alt\"></i></a>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<a data-toggle=\"tooltip\" data-placement=\"top\" title=\"Sil\" class=\"popconfirm\" href=\"../_class/yonetim_islem.php?menusil=ok&id=";
        echo $ALTMENUSonuc["id"];
        echo "\"><i class=\"ti-trash\"></i></a>\r\n\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t\t\t</ol>\r\n\t\t\t\t\t\t\t\t";
    }
    echo "\t\t\t\t\t\t\t</li>\r\n\t\t\t\t\t\t\t";
}
echo "\t\t\t\t\t\t</ol>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n\r\n</div>\r\n<!-- main-panel ends -->\r\n<script> \r\n\$(document).ready(function(e) {\r\n\t\$('#menu_url').bind('change', linkGetir);\r\n\t\$('#tip').bind('change', menutipi_getir);\r\n\t\$('#menu_ust').bind('change', ust_getir);\r\n});\r\n\r\n\r\nfunction menutipi_getir(){\r\n\tvar ustid = \$(this).val();\r\n\tif(ustid=='0'){\r\n\t\t\$(\".katlimit\").css(\"display\", \"none\");\r\n\t}else{\r\n\t\t\$(\".katlimit\").css(\"display\", \"block\");\r\n\t}\r\n}\r\n\r\n\$('#tip').ready(function(){\r\n\tvar ustid = \$(\"#tip\").val();\r\n\tif(ustid=='0'){\r\n\t\t\$(\".katlimit\").css(\"display\", \"none\");\r\n\t}else{\r\n\t\t\$(\".katlimit\").css(\"display\", \"block\");\r\n\t}\r\n});\r\n\r\nfunction ust_getir(){\r\n\tvar ustid = \$(this).val();\r\n\tif(ustid=='0'){\r\n\t\t\$(\".tip\").css(\"display\", \"block\");\r\n\t}else{\r\n\t\t\$(\".tip\").css(\"display\", \"none\");\r\n\t}\r\n}\r\n\r\n\$('#menu_ust').ready(function(){\r\n\tvar ustid = \$(\"#menu_ust\").val();\r\n\tif(ustid=='0'){\r\n\t\t\$(\".tip\").css(\"display\", \"block\");\r\n\t}else{\r\n\t\t\$(\".tip\").css(\"display\", \"none\");\r\n\t}\r\n});\r\n\r\nfunction linkGetir(){\r\n\tvar value = \$(this).val();\r\n\tif(value=='0'){\r\n\t\t \$('.link').removeClass('hidden');\r\n\t}else{\r\n\t\t \$('.link').addClass('hidden'); \r\n\t}\r\n}\r\n\$('#menu_url').ready(function(){\r\n\tvar value = \$(\"#menu_url\").val();\r\n\tif(value=='0'){\r\n\t\t \$('.link').removeClass('hidden');\r\n\t}else{\r\n\t\t \$('.link').addClass('hidden');\r\n\t}\r\n});\t\r\n\r\n</script>\r\n";
mesaj("MenuKaydet", 1, "yes", "Başarı ile eklenmiştir.");
mesaj("MenuKaydet", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("MenuGuncelle", 1, "yes", "Başarı ile guncellenmiştir.");
mesaj("MenuGuncelle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("menusil", 1, "yes", "Başarı ile silinmiştir.");
mesaj("menusil", 2, "no", "Hata oluştu tekrar deneyiniz.!");
echo "\r\n";

?>