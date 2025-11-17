<?php


echo !defined("GUVENLIK") ? exit : NULL;
echo "\r\n";
oturumkontrol($url);
echo "\r\n<div class=\"page-header\">\r\r\n\t<div class=\"page-title mt-0 mb-0\">\r\r\n\t\t<h3>";
echo $admindil["txt31"];
echo "</h3>\r\r\n\t\t<div class=\"crumbs\">\r\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\r\n\t\t\t\t<li><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt26"];
echo "</a></li>\r\r\n\t\t\t\t<li class=\"active\"><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt31"];
echo "</a></li>\r\r\n\t\t\t</ul>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n</div>\r\r\n<div class=\"row\">\r\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\r\n\t\t<div class=\"card\">\r\r\n\t\t\t<div class=\"card-body\">\r\r\n\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\">\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t<label for=\"uyeler\">Numara Listesi</label>\r\r\n\t\t\t\t\t<select name=\"uyeler[]\" multiple=\"multiple\" id=\"uyeler\" class=\"form-control\">\r\r\n\t\t\t\t\t";
$KATSorgu = $db->prepare("SELECT * FROM rehber WHERE durum = ? ORDER BY id ASC");
$KATSorgu->execute(["1"]);
$KATislem = $KATSorgu->fetchALL(PDO::FETCH_ASSOC);
echo "\r\n\t\t\t\t\t\t";
foreach ($KATislem as $KATSonuc) {
    echo "\r\n\t\t\t\t\t\t<option value=\"";
    echo $KATSonuc["telefon"];
    echo "\">";
    echo $KATSonuc["adi"];
    echo "</option>\r\r\n\t\t\t\t\t\t";
}
echo "\r\n\t\t\t\t\t</select>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"diger\">Harici Telefon Numaraları <small class=\"text-danger\">virgüllerle ayırınız</small></label>\r\r\n\t\t\t\t\t\t<textarea id=\"diger\" name=\"diger\" class=\"form-control\" rows=\"6\"></textarea>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t<label for=\"aciklama\">SMS İçeriği</label>\r\r\n\t\t\t\t\t\t<textarea name=\"aciklama\" rows=\"6\" class=\"form-control\" id=\"aciklama\"></textarea>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<button type=\"submit\" name=\"toplu_sms_gonder\" class=\"btn btn-primary btn-icon-text btn-sm\">\r\r\n\t\t\t\t\t\t<i class=\"mdi mdi-file-check btn-icon-prepend\"></i>\r\r\n\t\t\t\t\t\tGÖNDER\r\r\n\t\t\t\t\t</button>\r\r\n\t\t\t\t</form>\r\r\n\t\t\t</div>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n\r\r\n</div>\r\r\n";
mesaj("toplu_sms_gonder", 1, "yes", "Başarı ile gönderilmiştir.");
mesaj("toplu_sms_gonder", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("toplu_sms_gonder", 3, "bos", "Boş alanlar bıraktınız!");
echo "\r\n";


?>