<?php


$sorgu = $db->prepare("SELECT * FROM ozellik_kategori WHERE id = ?");
$sorgu->execute([$_GET["id"]]);
if ($sorgu->rowCount()) {
    $Sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);
} else {
    echo "<meta http-equiv=\"refresh\" content=\"0; url=404" . $html . "\">";
}
echo "\r\n<div class=\"page-header\">\r\r\n\t<div class=\"page-title mt-0 mb-0\">\r\r\n\t\t<h3>";
echo $Sonuc["adi"];
echo " Seçenekleri</h3>\r\r\n\t\t<div class=\"crumbs\">\r\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\r\n\t\t\t\t<li><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt57"];
echo "</a></li>\r\r\n\t\t\t\t<li><a href=\"ozellik-gruplari";
echo $html;
echo "\">";
echo $admindil["txt64"];
echo "</a></li>\r\r\n\t\t\t\t<li class=\"active\"><a href=\"";
echo $sayfalink;
echo "\">";
echo $Sonuc["adi"];
echo " Seçenekleri</a></li>\r\r\n\t\t\t</ul>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n</div>\r\r\n<div class=\"card\">\r\r\n\t<form action=\"../_class/yonetim_islem.php\" method=\"POST\">\r\r\n\t<input type=\"hidden\" value=\"";
echo $Sonuc["id"];
echo "\" name=\"kategori\">\r\r\n\t<div class=\"card-body\">\r\r\n\t\t<div class=\"row mb-3\">\r\r\n\t\t\t<div class=\"col-lg-12\">\r\r\n\t\t\t\t<div class=\"btn-toolbar\" role=\"toolbar\">\t\t\t\t\t\r\r\n\t\t\t\t\t<a href=\"\" data-toggle=\"modal\" data-target=\"#ozellik-degerleri-ekle\" data-backdrop=\"static\" data-keyboard=\"false\" class=\"btn btn-primary btn-sm mr-1\">\r\r\n\t\t\t\t\t\t<i class=\"icon-plus font-12\"></i> ";
echo $admindil["txt66"];
echo "\r\n\t\t\t\t\t</a>\r\r\n\t\t\t\t\t<div class=\"dropdown mr-1\">\r\r\n\t\t\t\t\t\t<button class=\"btn btn-primary btn-sm dropdown-toggle\" type=\"button\" id=\"dropdownMenuSizeButton3\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\r\r\n\t\t\t\t\t\t\t<i class=\"icon-options-vertical font-12\"></i> Seçilenlere Uygula\r\r\n\t\t\t\t\t\t</button>\r\r\n\t\t\t\t\t\t<div class=\"dropdown-menu p-0 min-width-full\" aria-labelledby=\"dropdownMenuSizeButton3\">\r\r\n\t\t\t\t\t\t\t<button class=\"dropdown-item p-2 cursor-pointer\" type=\"submit\" name=\"ozellik_deger_aktif\"><i class=\"icon-check\"></i> Seçilenleri Aktif Et</button>\r\r\n\t\t\t\t\t\t\t<button class=\"dropdown-item p-2 cursor-pointer\" type=\"submit\" name=\"ozellik_deger_pasif\"><i class=\"icon-close\"></i> Seçilenleri Pasif Et</button>\r\r\n\t\t\t\t\t\t\t<button class=\"dropdown-item p-2 cursor-pointer\" type=\"submit\" name=\"ozellik_deger_tumu\"><i class=\"icon-trash\"></i> Seçilenleri Sil</button>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t<a href=\"../_class/yonetim_islem.php?ozellik_degertumunusil=ok&kategori=";
echo $Sonuc["id"];
echo "\" title=\"Tüm Veriyi Sil\" class=\"btn btn-danger btn-sm mr-1 popconfirm\">\r\r\n\t\t\t\t\t\t<i class=\"ti-trash font-12\"></i> Tüm Veriyi Sil\r\r\n\t\t\t\t\t</a>\r\r\n\t\t\t\t</div>\r\r\n\t\t\t</div>\r\r\n\t\t</div>\r\r\n\t\t\r\r\n\t\t<div class=\"row\">\r\r\n\t\t\t<div class=\"col-12\">\r\r\n\t\t\t\t<div class=\"table-responsive\">\r\r\n\t\t\t\t\t<table id=\"order-listingg\" class=\"table table-bordered table-hover\">\r\r\n\t\t\t\t\t\t<thead class=\"headbg\">\r\r\n\t\t\t\t\t\t\t<tr>\r\r\n\t\t\t\t\t\t\t\t<th class=\"noshort\" style=\"width:20px;\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Tümünü Seç\">\r\r\n\t\t\t\t\t\t\t\t\t<input id=\"checkbox-4\" class=\"select-all checkbox-custom\" type=\"checkbox\" style=\"width:100px;\">\r\r\n\t\t\t\t\t\t\t\t\t<label for=\"checkbox-4\" class=\"checkbox-custom-label mb-0\"><span class=\"checktext\"></span></label>\r\r\n\t\t\t\t\t\t\t\t</th>\r\r\n\t\t\t\t\t\t\t\t<th style=\"width:30px;\">ID</th>\r\r\n\t\t\t\t\t\t\t\t<th>Başlık</th>\r\r\n\t\t\t\t\t\t\t\t<th>Kategori</th>\r\r\n\t\t\t\t\t\t\t\t<th style=\"width:70px;\">Durum</th>\r\r\n\t\t\t\t\t\t\t\t<th style=\"width:115px;\">İşlem</th>\r\r\n\t\t\t\t\t\t\t</tr>\r\r\n\t\t\t\t\t\t</thead>\r\r\n\t\t\t\t\t\t<tbody id=\"sortable\"></tbody>\r\r\n\t\t\t\t\t</table>\r\r\n\t\t\t\t</div>\r\r\n\t\t\t</div>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n\t</form>\r\r\n</div>\r\r\n\r\r\n<!-- Yeni Özellik Ekle !-->\r\r\n<div class=\"modal fade\" id=\"ozellik-degerleri-ekle\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"ModalLabel\" aria-hidden=\"true\">\r\r\n\t<div class=\"modal-dialog modal-dialog-centered\" role=\"document\">\r\r\n\t\t<div class=\"modal-content\">\r\r\n\t\t\t<div class=\"modal-header p-2 pl-2\">\r\r\n\t\t\t\t<h5 class=\"modal-title\" id=\"ModalLabel\">";
echo $Sonuc["adi"];
echo " Özellik Değeri Ekle</h5>\r\r\n\t\t\t</div>\r\r\n\t\t\t<form role=\"form\" action=\"../_class/yonetim_islem.php\" method=\"POST\">\r\r\n\t\t\t<div class=\"modal-body text-left\">\r\r\n\t\t\t\t<div class=\"form-group row mb-1\">\r\r\n\t\t\t\t\t<label class=\"col-md-3 col-form-label text-right pt-2\">Başlık</label>\r\r\n\t\t\t\t\t<div class=\"col-md-9\">\r\r\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"adi\">\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t</div>\r\r\n\t\t\t\t<div class=\"form-group row mb-1\">\r\r\n\t\t\t\t\t<div class=\"col-md-3\"></div>\r\r\n\t\t\t\t\t<div class=\"col-md-9\">\r\r\n\t\t\t\t\t\t<label class=\"switch\">\r\r\n\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"durum\" id=\"durum\" value=\"1\" checked>\r\r\n\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\r\n\t\t\t\t\t\t</label>\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t<label class=\"d-inline-block\" style=\"line-height: 34px;\" for=\"durum\">Durum</label>\t\t\t\t\t\t\r\r\n\t\t\t\t\t</div>\t\t\t\r\r\n\t\t\t\t</div>\t\t\t\r\r\n\t\t\t</div>\r\r\n\t\t\t<div class=\"modal-footer\">\r\r\n\t\t\t\t<input type=\"hidden\" class=\"form-control form-control-sm\" value=\"";
echo $Sonuc["id"];
echo "\" name=\"kategori\">\r\r\n\t\t\t\t<button type=\"submit\" name=\"ozellik_deger_ekle\" class=\"btn btn-primary btn-icon-text p-2\"><i class=\"fa fa-check\"></i> Kaydet</button>\r\r\n\t\t\t\t<button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-outline-default btn-icon-text p-2\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i> Kapat</button>\r\r\n\t\t\t</div>\r\r\n\t\t\t</form>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n</div>\r\r\n<script>\r\r\n\t\$(document).ready(function(){\r\r\n\t\tvar dataTable=\$('#order-listingg').DataTable({\r\r\n\t\t\t\"processing\": true,\r\r\n\t\t\t\"serverSide\":true,\r\r\n\t\t\t\"ajax\":{\r\r\n\t\t\t\turl:\"data/ozellik_degerleri.php?id=";
echo $Sonuc["id"];
echo "\",\r\r\n\t\t\t\ttype:\"post\"\r\r\n\t\t\t},\r\r\n\t\t\t\"order\": [[ 1, \"asc\" ]],\r\r\n\t\t\t\"aLengthMenu\": [\r\r\n\t\t\t\t[5, 10, 15, ";
echo tumu("ozellik", 4, "kategori", $Sonuc["id"]);
echo "],\r\r\n\t\t\t\t[5, 10, 15, \"Tümü\"]\r\r\n\t\t\t],\r\r\n\t\t\t\"columnDefs\": [\r\r\n\t\t\t\t{ \"orderable\": false, \"targets\": [0, 5] },\r\r\n\t\t\t\t{ \"targets\": [ 1 ],\"visible\": false },\r\r\n\t\t\t\t{  \"className\": \"secili\", targets: [1, 2, 3] },\r\r\n\t\t\t\t{  \"className\": \"secili text-center\", targets: [4] },\r\r\n\t\t\t\t{  \"className\": \"text-center\", targets: [5] }\r\r\n\t\t\t],\r\r\n\t\t\t\"iDisplayLength\": 10,\r\r\n\t\t\t\"language\": {\r\r\n\t\t\t\t\"url\":\"js/Turkish.json\"\r\r\n\t\t\t},\r\r\n\t\t\t\"fnCreatedRow\": function( nRow, aData, iDataIndex ) {\r\r\n\t\t\t\t\$(nRow).attr('id', 'item-'+aData[1]);\r\r\n\t\t\t},\r\r\n\t\t\t\"fnDrawCallback\": function( oSettings ) {\r\r\n\t\t\t\$(\".popconfirm\").popConfirm();\r\r\n\t\t    }\r\r\n\t\t});\r\r\n\t\t\$('#order-listingg').on('click', 'tbody tr td.secili', function(event) {\t\r\r\n\t\t\t\$(this).closest(\"tr\").find(\"td:eq(0)\").find(\"input[type=checkbox]\").trigger('click');\r\r\n\t\t\tif(\$(this).closest(\"tr\").find(\"input[type=checkbox]\").prop(\"checked\")){\r\r\n\t\t\t\t\$(this).closest(\"tr\").addClass('highlight');\r\r\n\t\t\t}else{\r\r\n\t\t\t\t\$(this).closest(\"tr\").removeClass('highlight');\r\r\n\t\t\t}\r\r\n\t\t});\r\r\n\t\t\$(\".select-all\").click(function () {\r\r\n\t\t\t\$(\"input:checkbox\").not(this).prop('checked', this.checked);\r\r\n\r\r\n\t\t\tif(this.checked){\r\r\n\t\t\t\t\$(\"input:checkbox\").not(this).closest(\"tr\").addClass('highlight');\r\r\n\t\t\t}else{\r\r\n\t\t\t\t\$(\"input:checkbox\").not(this).closest(\"tr\").removeClass('highlight');\r\r\n\t\t\t}\t\t\t\r\r\n\t\t});\r\r\n\t});\r\r\n</script>\r\r\n<style type=\"text/css\">\r\r\n.secili{\r\r\n\tcursor:move;\r\r\n}\r\r\n</style>\r\r\n<script src=\"vendors/js/jquery-ui.min.js\"></script>\r\r\n<script type=\"text/javascript\">\r\r\n\$(function(){\r\r\n\t\$(\"#sortable\").sortable({\r\r\n\t\trevert: true,\r\r\n\t\thandle: \".secili\",\r\r\n\t\tstop: function(event, ui){\r\r\n\t\t\tvar data = \$(this).sortable('serialize');\r\r\n\t\t\t\r\r\n\t\t\t\$.ajax({\r\r\n\t\t\t\ttype: \"POST\",\r\r\n\t\t\t\tdataType: \"json\",\r\r\n\t\t\t\tdata: data,\r\r\n\t\t\t\turl: \"../_class/yonetim_islem.php?ozellik_degersiralama=sira\",\r\r\n\t\t\t\tsuccess: function(msg){\r\r\n\t\t\t\t\tif(msg.islemMsj == \"Güncellendi\")\r\r\n\t\t\t\t\t{\r\r\n\t\t\t\t\t\t\$.toast({\r\r\n\t\t\t\t\t\t  heading: 'Başarılı!',\r\r\n\t\t\t\t\t\t  text: msg.islemMsj,\r\r\n\t\t\t\t\t\t  showHideTransition: 'slide',\r\r\n\t\t\t\t\t\t  icon: 'success',\r\r\n\t\t\t\t\t\t  loaderBg: '#fff',\r\r\n\t\t\t\t\t\t  position: 'top-right'\r\r\n\t\t\t\t\t\t})\r\r\n\t\t\t\t\t}\r\r\n\t\t\t\t\tif(msg.islemMsj == \"İşlem başarısız\")\r\r\n\t\t\t\t\t{\r\r\n\t\t\t\t\t\t\$.toast({\r\r\n\t\t\t\t\t\t  heading: 'Hata',\r\r\n\t\t\t\t\t\t  text: msg.islemMsj,\r\r\n\t\t\t\t\t\t  showHideTransition: 'slide',\r\r\n\t\t\t\t\t\t  icon: 'error',\r\r\n\t\t\t\t\t\t  loaderBg: '#fff',\r\r\n\t\t\t\t\t\t  position: 'top-right'\r\r\n\t\t\t\t\t\t})\r\r\n\t\t\t\t\t}\r\r\n\t\t\t\t}\t\t\t\t\r\r\n\t\t\t});\r\r\n\t\t}\r\r\n\t});\r\r\n\t\$(\"#sortable\").disableSelection();\r\r\n});\r\r\n</script>\r\r\n";
mesaj("ozellik_deger_ekle", 1, "yes", "Başarı ile eklenmiştir.");
mesaj("ozellik_deger_ekle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("ozellik_deger_guncelle", 1, "yes", "Başarı ile guncellenmiştir.");
mesaj("ozellik_deger_guncelle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("ozellik_degersil", 1, "yes", "Başarı ile silinmiştir.");
mesaj("ozellik_degersil", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("ozellik_deger_tumu", 1, "yes", "Seçilen kayıtlar başarıyla silinmiştir.");
mesaj("ozellik_deger_tumu", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("ozellik_degertumunusil", 1, "yes", "Tüm kayıtlar başarıyla silinmiştir.");
mesaj("ozellik_degertumunusil", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("ozellik_deger_aktif", 1, "yes", "Bilgileriniz başarıyla güncellendi.");
mesaj("ozellik_deger_aktif", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("ozellik_deger_pasif", 1, "yes", "Bilgileriniz başarıyla güncellendi.");
mesaj("ozellik_deger_pasif", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("secim", 3, "secimyok", "Hiç bir şey seçmediniz. Lütfen işlem yapmak istediğiniz eylemi ve ID leri seçin.");
echo "\r\n";


?>