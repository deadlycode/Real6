<?php


echo !defined("GUVENLIK") ? exit : NULL;
oturumkontrol($url);
$ayar_dizi = $db->prepare("SELECT * FROM limit_ayarlari WHERE id = ?");
$ayar_dizi->execute([1]);
if ($ayar_dizi->rowCount()) {
    $Sonuc = $ayar_dizi->fetch(PDO::FETCH_ASSOC);
    echo " \r\n<div class=\"page-header\">\r\n\t<div class=\"page-title mt-0 mb-0\">\r\n\t\t<h3>";
    echo $admindil["txt8_1"];
    echo "</h3>\r\n\t\t<div class=\"crumbs\">\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\n\t\t\t\t<li><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt2"];
    echo "</a></li>\r\n\t\t\t\t<li class=\"active\"><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt8_1"];
    echo "</a></li>\r\n\t\t\t</ul>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n<div class=\"row\">\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\n\t\t<div class=\"card\">\r\n\t\t\t<div class=\"card-body\">\r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\" autocomplete=\"off\">\r\n\t\t\t\t<div class=\"row\">\r\n\t\t\t\t\t<div class=\"col-md-6\">\r\n\t\t\t\t\t\t<div class=\"table-responsive\">\r\n\t\t\t\t\t\t\t<table class=\"table table-hover m-b-0 without-header   text-left\">\r\n\t\t\t\t\t\t\t\t<tbody>\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-column2 text-c-red\"></i> Belgelerimiz\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-right\">\r\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-radio\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2 mb-1 mt-1\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_belge\" value=\"12\" ";
    if ($Sonuc["limit_belge"] == "12") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t1\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2 mb-1 mt-1\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_belge\" value=\"6\" ";
    if ($Sonuc["limit_belge"] == "6") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t2\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2 mb-1 mt-1\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_belge\" value=\"4\" ";
    if ($Sonuc["limit_belge"] == "4") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t3\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2 mb-1 mt-1\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_belge\" value=\"3\" ";
    if ($Sonuc["limit_belge"] == "3") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t4\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2 mb-1 mt-1\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_belge\" value=\"2\" ";
    if ($Sonuc["limit_belge"] == "2") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t6\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-column2 text-c-red\"></i> Ekibimiz\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-right\">\r\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-radio\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_ekip\" value=\"12\" ";
    if ($Sonuc["limit_ekip"] == "12") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t1\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_ekip\" value=\"6\" ";
    if ($Sonuc["limit_ekip"] == "6") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t2\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_ekip\" value=\"4\" ";
    if ($Sonuc["limit_ekip"] == "4") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t3\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_ekip\" value=\"3\" ";
    if ($Sonuc["limit_ekip"] == "3") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t4\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_ekip\" value=\"2\" ";
    if ($Sonuc["limit_ekip"] == "2") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t6\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-column2 text-c-red\"></i> Referanslar\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-right\">\r\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-radio\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_referanslar\" value=\"12\" ";
    if ($Sonuc["limit_referanslar"] == "12") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t1\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_referanslar\" value=\"6\" ";
    if ($Sonuc["limit_referanslar"] == "6") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t2\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_referanslar\" value=\"4\" ";
    if ($Sonuc["limit_referanslar"] == "4") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t3\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_referanslar\" value=\"3\" ";
    if ($Sonuc["limit_referanslar"] == "3") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t4\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_referanslar\" value=\"2\" ";
    if ($Sonuc["limit_referanslar"] == "2") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t6\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-column2 text-c-red\"></i> Emlak Kategori\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-right\">\r\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-radio\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_urun\" value=\"12\" ";
    if ($Sonuc["limit_urun"] == "12") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t1\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_urun\" value=\"6\" ";
    if ($Sonuc["limit_urun"] == "6") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t2\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_urun\" value=\"4\" ";
    if ($Sonuc["limit_urun"] == "4") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t3\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_urun\" value=\"3\" ";
    if ($Sonuc["limit_urun"] == "3") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t4\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_urun\" value=\"2\" ";
    if ($Sonuc["limit_urun"] == "2") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t6\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-column2 text-c-red\"></i> Emlaklar\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-right\">\r\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-radio\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_urunler\" value=\"12\" ";
    if ($Sonuc["limit_urunler"] == "12") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t1\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_urunler\" value=\"6\" ";
    if ($Sonuc["limit_urunler"] == "6") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t2\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_urunler\" value=\"4\" ";
    if ($Sonuc["limit_urunler"] == "4") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t3\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_urunler\" value=\"3\" ";
    if ($Sonuc["limit_urunler"] == "3") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t4\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_urunler\" value=\"2\" ";
    if ($Sonuc["limit_urunler"] == "2") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t6\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-column2 text-c-red\"></i> Proje Kategori\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-right\">\r\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-radio\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_proje\" value=\"12\" ";
    if ($Sonuc["limit_proje"] == "12") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t1\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_proje\" value=\"6\" ";
    if ($Sonuc["limit_proje"] == "6") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t2\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_proje\" value=\"4\" ";
    if ($Sonuc["limit_proje"] == "4") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t3\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_proje\" value=\"3\" ";
    if ($Sonuc["limit_proje"] == "3") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t4\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_proje\" value=\"2\" ";
    if ($Sonuc["limit_proje"] == "2") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t6\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-column2 text-c-red\"></i> Projeler\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-right\">\r\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-radio\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_projeler\" value=\"12\" ";
    if ($Sonuc["limit_projeler"] == "12") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t1\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_projeler\" value=\"6\" ";
    if ($Sonuc["limit_projeler"] == "6") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t2\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_projeler\" value=\"4\" ";
    if ($Sonuc["limit_projeler"] == "4") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t3\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_projeler\" value=\"3\" ";
    if ($Sonuc["limit_projeler"] == "3") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t4\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_projeler\" value=\"2\" ";
    if ($Sonuc["limit_projeler"] == "2") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t6\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-column2 text-c-red\"></i> Haberler\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-right\">\r\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-radio\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_haber\" value=\"12\" ";
    if ($Sonuc["limit_haber"] == "12") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t1\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_haber\" value=\"6\" ";
    if ($Sonuc["limit_haber"] == "6") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t2\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_haber\" value=\"4\" ";
    if ($Sonuc["limit_haber"] == "4") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t3\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_haber\" value=\"3\" ";
    if ($Sonuc["limit_haber"] == "3") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t4\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_haber\" value=\"2\" ";
    if ($Sonuc["limit_haber"] == "2") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t6\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-column2 text-c-red\"></i> Müşteri Görüşleri\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-right\">\r\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-radio\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_yorum\" value=\"12\" ";
    if ($Sonuc["limit_yorum"] == "12") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t1\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_yorum\" value=\"6\" ";
    if ($Sonuc["limit_yorum"] == "6") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t2\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_yorum\" value=\"4\" ";
    if ($Sonuc["limit_yorum"] == "4") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t3\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_yorum\" value=\"3\" ";
    if ($Sonuc["limit_yorum"] == "3") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t4\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_yorum\" value=\"2\" ";
    if ($Sonuc["limit_yorum"] == "2") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t6\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-column2 text-c-red\"></i> E-Katalog\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-right\">\r\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-radio\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_katalog\" value=\"12\" ";
    if ($Sonuc["limit_katalog"] == "12") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t1\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_katalog\" value=\"6\" ";
    if ($Sonuc["limit_katalog"] == "6") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t2\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_katalog\" value=\"4\" ";
    if ($Sonuc["limit_katalog"] == "4") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t3\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_katalog\" value=\"3\" ";
    if ($Sonuc["limit_katalog"] == "3") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t4\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_katalog\" value=\"2\" ";
    if ($Sonuc["limit_katalog"] == "2") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t6\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-column2 text-c-red\"></i> Hizmetlerimiz\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-right\">\r\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-radio\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_hizmetler\" value=\"12\" ";
    if ($Sonuc["limit_hizmetler"] == "12") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t1\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_hizmetler\" value=\"6\" ";
    if ($Sonuc["limit_hizmetler"] == "6") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t2\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_hizmetler\" value=\"4\" ";
    if ($Sonuc["limit_hizmetler"] == "4") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t3\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_hizmetler\" value=\"3\" ";
    if ($Sonuc["limit_hizmetler"] == "3") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t4\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_hizmetler\" value=\"2\" ";
    if ($Sonuc["limit_hizmetler"] == "2") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t6\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-column2 text-c-red\"></i> Banka Hesapları\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-right\">\r\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-radio\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_bhesaplari\" value=\"12\" ";
    if ($Sonuc["limit_bhesaplari"] == "12") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t1\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_bhesaplari\" value=\"6\" ";
    if ($Sonuc["limit_bhesaplari"] == "6") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t2\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_bhesaplari\" value=\"4\" ";
    if ($Sonuc["limit_bhesaplari"] == "4") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t3\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_bhesaplari\" value=\"3\" ";
    if ($Sonuc["limit_bhesaplari"] == "3") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t4\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-success d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"radio\" class=\"form-check-input\" name=\"limit_bhesaplari\" value=\"2\" ";
    if ($Sonuc["limit_bhesaplari"] == "2") {
        echo " checked ";
    }
    echo " >\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t6\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\t\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t</tbody>\r\n\t\t\t\t\t\t\t</table>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t<div class=\"col-md-6\">\r\n\t\t\t\t\t\t<div class=\"table-responsive\">\r\n\t\t\t\t\t\t\t<table class=\"table table-hover m-b-0 without-header   text-left\">\r\n\t\t\t\t\t\t\t\t<tbody>\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-grid3 text-c-red\"></i> Belgelerimiz Sayfasındaki Kayıt Sayısı\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\" maxlength=\"3\" name=\"limit_sayfabelgeler\" type=\"number\" value=\"";
    echo $Sonuc["limit_sayfabelgeler"];
    echo "\" required=\"\">\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-grid3 text-c-red\"></i> Ekibimiz Sayfasındaki Kayıt Sayısı\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\" name=\"limit_sayfaekibimiz\" type=\"number\" value=\"";
    echo $Sonuc["limit_sayfaekibimiz"];
    echo "\" required=\"\">\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-grid3 text-c-red\"></i> Referans Sayfasındaki Kayıt Sayısı\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\" name=\"limit_sayfareferans\" type=\"number\" value=\"";
    echo $Sonuc["limit_sayfareferans"];
    echo "\" required=\"\">\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-grid3 text-c-red\"></i> Emlak Kategori Sayfasındaki Kayıt Sayısı\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\" name=\"limit_sayfaurun\" type=\"number\" value=\"";
    echo $Sonuc["limit_sayfaurun"];
    echo "\" required=\"\">\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-grid3 text-c-red\"></i> Emlaklar Sayfasındaki Kayıt Sayısı\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\" name=\"limit_sayfaurunler\" type=\"number\" value=\"";
    echo $Sonuc["limit_sayfaurunler"];
    echo "\" required=\"\">\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-grid3 text-c-red\"></i> Proje Kategori Sayfasındaki Kayıt Sayısı\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\" name=\"limit_sayfaproje\" type=\"number\" value=\"";
    echo $Sonuc["limit_sayfaproje"];
    echo "\" required=\"\">\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-grid3 text-c-red\"></i> Projeler Sayfasındaki Kayıt Sayısı\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\" name=\"limit_sayfaprojeler\" type=\"number\" value=\"";
    echo $Sonuc["limit_sayfaprojeler"];
    echo "\" required=\"\">\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-grid3 text-c-red\"></i> Haberler Sayfasındaki Kayıt Sayısı\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\" name=\"limit_sayfahaber\" type=\"number\" value=\"";
    echo $Sonuc["limit_sayfahaber"];
    echo "\" required=\"\">\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-grid3 text-c-red\"></i> Müşteri Görüşleri Sayfasındaki Kayıt Sayısı\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\" name=\"limit_sayfayorumlar\" type=\"number\" value=\"";
    echo $Sonuc["limit_sayfayorumlar"];
    echo "\" required=\"\">\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-grid3 text-c-red\"></i> E-Katalog Sayfasındaki Kayıt Sayısı\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\" name=\"limit_sayfakatalog\" type=\"number\" value=\"";
    echo $Sonuc["limit_sayfakatalog"];
    echo "\" required=\"\">\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-grid3 text-c-red\"></i> Hizmetler Sayfasındaki Kayıt Sayısı\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\" name=\"limit_sayfahizmetler\" type=\"number\" value=\"";
    echo $Sonuc["limit_sayfahizmetler"];
    echo "\" required=\"\">\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\r\n\t\t\t\t\t\t\t\t\t<tr style=\"height: 75px;\">\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"text-left\">\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"ti-layout-grid3 text-c-red\"></i> Banka Hesapları Sayfasındaki Kayıt Sayısı\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t\t<td>\r\n\t\t\t\t\t\t\t\t\t\t\t<input class=\"form-control\" name=\"limit_sayfabhesaplari\" type=\"number\" value=\"";
    echo $Sonuc["limit_sayfabhesaplari"];
    echo "\" required=\"\">\r\n\t\t\t\t\t\t\t\t\t\t</td>\r\n\t\t\t\t\t\t\t\t\t</tr>\t\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t</tbody>\r\n\t\t\t\t\t\t\t</table>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t\t\t<button type=\"submit\" name=\"limit_ayarlar\" class=\"btn btn-success btn-icon-text btn-sm mt-3\">\r\n\t\t\t\t\t\t<i class=\"mdi mdi-spin mdi-loading\"></i>                                                   \r\n\t\t\t\t\t\tGÜNCELLE\r\n\t\t\t\t\t</button>\r\n\t\t\t\t</form>\r\n\t\t\t</div>\t\t\t\t\t\t\t\t\t\t\t\t\r\n\t\t</div>\r\n\t</div>\r\n\r\n</div>\r\n";
    mesaj("limit_ayarlar", 1, "yes", "Başarı ile guncellenmiştir.");
    mesaj("limit_ayarlar", 2, "no", "Hata oluştu tekrar deneyiniz.!");
    echo "\t\r\n";
    
} else {
    header("Location:" . $url . "/404" . $html . "");
    exit;
}

?>