<?php


echo !defined("GUVENLIK") ? exit : NULL;
echo "\r\n";
oturumkontrol($url);
$ayar_dizi = $db->prepare("SELECT * FROM ayarlar WHERE id = ?");
$ayar_dizi->execute([1]);
if ($ayar_dizi->rowCount()) {
    $Sonuc = $ayar_dizi->fetch(PDO::FETCH_ASSOC);
    echo "\r\n<div class=\"page-header\">\r\r\n\t<div class=\"page-title mt-0 mb-0\">\r\r\n\t\t<h3>";
    echo $admindil["txt6"];
    echo "</h3>\r\r\n\t\t<div class=\"crumbs\">\r\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\r\n\t\t\t\t<li><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt2"];
    echo "</a></li>\r\r\n\t\t\t\t<li class=\"active\"><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt6"];
    echo "</a></li>\r\r\n\t\t\t</ul>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n</div>\r\r\n<div class=\"row\">\r\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\r\n\t\t<div class=\"card\">\r\r\n\t\t\t<div class=\"card-body\">\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\">\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"facebook\">Facebook Sayfa URL</label>\r\r\n\t\t\t\t\t\t<div class=\"input-group\">\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"facebook\" id=\"facebook\" value=\"";
    echo $Sonuc["facebook"];
    echo "\" />\r\r\n\t\t\t\t\t\t\t<div class=\"input-group-append\">\r\r\n\t\t\t\t\t\t\t<button class=\"btn btn-sm btn-facebook\" type=\"button\">\r\r\n\t\t\t\t\t\t\t  <i class=\"mdi mdi-facebook\"></i>\r\r\n\t\t\t\t\t\t\t</button>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"twitter\">Twitter Sayfa URL</label>\r\r\n\t\t\t\t\t\t<div class=\"input-group\">\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"twitter\" id=\"twitter\" value=\"";
    echo $Sonuc["twitter"];
    echo "\" />\r\r\n\t\t\t\t\t\t\t<div class=\"input-group-append\">\r\r\n\t\t\t\t\t\t\t<button class=\"btn btn-sm btn-twitter\" type=\"button\">\r\r\n\t\t\t\t\t\t\t  <i class=\"mdi mdi-twitter\"></i>\r\r\n\t\t\t\t\t\t\t</button>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"instagram\">Instagram Sayfa URL</label>\r\r\n\t\t\t\t\t\t<div class=\"input-group\">\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"instagram\" id=\"instagram\" value=\"";
    echo $Sonuc["instagram"];
    echo "\" />\r\r\n\t\t\t\t\t\t\t<div class=\"input-group-append\">\r\r\n\t\t\t\t\t\t\t<button class=\"btn btn-sm btn-instagram\" type=\"button\">\r\r\n\t\t\t\t\t\t\t  <i class=\"mdi mdi-instagram\"></i>\r\r\n\t\t\t\t\t\t\t</button>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"linkedin\">LinkedIn Sayfa URL</label>\r\r\n\t\t\t\t\t\t<div class=\"input-group\">\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"linkedin\" id=\"linkedin\" value=\"";
    echo $Sonuc["linkedin"];
    echo "\" />\r\r\n\t\t\t\t\t\t\t<div class=\"input-group-append\">\r\r\n\t\t\t\t\t\t\t<button class=\"btn btn-sm btn-linkedin\" type=\"button\">\r\r\n\t\t\t\t\t\t\t  <i class=\"mdi mdi-linkedin\"></i>\r\r\n\t\t\t\t\t\t\t</button>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"youtube\">Youtube Sayfa URL</label>\r\r\n\t\t\t\t\t\t<div class=\"input-group\">\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"youtube\" id=\"youtube\" value=\"";
    echo $Sonuc["youtube"];
    echo "\" />\r\r\n\t\t\t\t\t\t\t<div class=\"input-group-append\">\r\r\n\t\t\t\t\t\t\t<button class=\"btn btn-sm btn-youtube\" type=\"button\">\r\r\n\t\t\t\t\t\t\t  <i class=\"mdi mdi-youtube\"></i>\r\r\n\t\t\t\t\t\t\t</button>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<button type=\"submit\" name=\"sosyal_ayarlar\" class=\"btn btn-success btn-icon-text btn-sm\">\r\r\n\t\t\t\t\t\t<i class=\"mdi mdi-spin mdi-loading\"></i>                                                    \r\r\n\t\t\t\t\t\tGÜNCELLE\r\r\n\t\t\t\t\t</button>\r\r\n\t\t\t\t</form>\r\r\n\t\t\t</div>\t\t\t\t\t\t\t\t\t\t\t\t\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n\r\r\n</div>\r\r\n";
    mesaj("sosyal_ayarlar", 1, "yes", "Başarı ile guncellenmiştir.");
    mesaj("sosyal_ayarlar", 2, "no", "Hata oluştu tekrar deneyiniz.!");
    echo "\t\r\r\n";
    
} else {
    header("Location:" . $url . "/404" . $html . "");
    exit;
}

?>