<?php


echo !defined("GUVENLIK") ? exit : NULL;
echo "\r\n";
oturumkontrol($url);
echo "\r\n<div class=\"page-header\">\r\r\n\t<div class=\"page-title mt-0 mb-0\">\r\r\n\t\t<h3>";
echo $admindil["txt27"];
echo "</h3>\r\r\n\t\t<div class=\"crumbs\">\r\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\r\n\t\t\t\t<li><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt26"];
echo "</a></li>\r\r\n\t\t\t\t<li class=\"active\"><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt27"];
echo "</a></li>\r\r\n\t\t\t</ul>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n</div>\r\r\n<div class=\"card\">\r\r\n\t<form action=\"../_class/yonetim_islem.php\" method=\"POST\">\r\r\n\t<div class=\"card-body\">\r\r\n\t\t<div class=\"row mb-3\">\r\r\n\t\t\t<div class=\"col-lg-12\">\r\r\n\t\t\t\t<div class=\"btn-toolbar\" role=\"toolbar\">\t\t\t\t\t\r\r\n\t\t\t\t\t<a href=\"rehber-ekle.html\" class=\"btn btn-primary btn-sm mr-1\">\r\r\n\t\t\t\t\t\t<i class=\"icon-plus font-12\"></i> ";
echo $admindil["txt28"];
echo "\r\n\t\t\t\t\t</a>\r\r\n\t\t\t\t\t<div class=\"dropdown\">\r\r\n\t\t\t\t\t\t<button class=\"btn btn-primary btn-sm dropdown-toggle\" type=\"button\" id=\"dropdownMenuSizeButton3\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\r\r\n\t\t\t\t\t\t\t<i class=\"icon-options-vertical font-12\"></i> Seçilenlere Uygula\r\r\n\t\t\t\t\t\t</button>\r\r\n\t\t\t\t\t\t<div class=\"dropdown-menu p-0 min-width-full\" aria-labelledby=\"dropdownMenuSizeButton3\">\r\r\n\t\t\t\t\t\t\t<button class=\"dropdown-item p-2 cursor-pointer\" type=\"submit\" name=\"rehber_aktif\"><i class=\"icon-check\"></i> Seçilenleri Aktif Et</button>\r\r\n\t\t\t\t\t\t\t<button class=\"dropdown-item p-2 cursor-pointer\" type=\"submit\" name=\"rehber_pasif\"><i class=\"icon-close\"></i> Seçilenleri Pasif Et</button>\r\r\n\t\t\t\t\t\t\t<button class=\"dropdown-item p-2 cursor-pointer\" type=\"submit\" name=\"rehber_tumu\"><i class=\"icon-trash\"></i> Seçilenleri Sil</button>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t</div>\r\r\n\t\t\t</div>\r\r\n\t\t</div>\r\r\n\t\t\r\r\n\t\t<div class=\"row\">\r\r\n\t\t\t<div class=\"col-12\">\r\r\n\t\t\t\t<div class=\"table-responsive\">\r\r\n\t\t\t\t\t<table id=\"order-listingg\" class=\"table table-bordered table-hover\">\r\r\n\t\t\t\t\t\t<thead class=\"headbg\">\r\r\n\t\t\t\t\t\t\t<tr>\r\r\n\t\t\t\t\t\t\t\t<th class=\"noshort\" style=\"width:20px;\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Tümünü Seç\">\r\r\n\t\t\t\t\t\t\t\t\t<input id=\"checkbox-4\" class=\"select-all checkbox-custom\" type=\"checkbox\" style=\"width:100px;\">\r\r\n\t\t\t\t\t\t\t\t\t<label for=\"checkbox-4\" class=\"checkbox-custom-label mb-0\"><span class=\"checktext\"></span></label>\r\r\n\t\t\t\t\t\t\t\t</th>\r\r\n\t\t\t\t\t\t\t\t<th style=\"width:30px;\">Sıra</th>\r\r\n\t\t\t\t\t\t\t\t<th>Adı Soyadı</th>\r\r\n\t\t\t\t\t\t\t\t<th>E-Posta</th>\r\r\n\t\t\t\t\t\t\t\t<th>Telefon</th>\r\r\n\t\t\t\t\t\t\t\t<th>Oluşturma Tarihi</th>\r\r\n\t\t\t\t\t\t\t\t<th style=\"width:70px;\" class=\"text-center\">Durum</th>\r\r\n\t\t\t\t\t\t\t\t<th style=\"width:90px;\" class=\"text-center\">İşlem</th>\r\r\n\t\t\t\t\t\t\t</tr>\r\r\n\t\t\t\t\t\t</thead>\r\r\n\t\t\t\t\t\t<tbody></tbody>\r\r\n\t\t\t\t\t</table>\r\r\n\t\t\t\t</div>\r\r\n\t\t\t</div>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n\t</form>\r\r\n</div>\r\r\n<!-- content-wrapper ends -->\r\r\n<script>\r\r\n\$(document).ready(function(){\r\r\n\tvar dataTable=\$('#order-listingg').DataTable({\r\r\n\t\t\"processing\": true,\r\r\n\t\t\"serverSide\":true,\r\r\n\t\t\"ajax\":{\r\r\n\t\t\turl:\"data/rehberim.php\",\r\r\n\t\t\ttype:\"post\"\r\r\n\t\t},\r\r\n\t\t\"aLengthMenu\": [\r\r\n\t\t\t[5, 10, 15, ";
echo tumu("rehber", 2);
echo "],\r\r\n\t\t\t[5, 10, 15, \"Tümü\"]\r\r\n\t\t],\r\r\n\t\t\"columnDefs\": [\r\r\n\t\t\t{ \"orderable\": false, \"targets\": [0, 7] },\r\r\n\t\t\t{  \"className\": \"secili\", targets: [1, 2, 3, 4, 5] },\r\r\n\t\t\t{  \"className\": \"secili text-center\", targets: [6] },\r\r\n\t\t\t{  \"className\": \"text-center\", targets: [7] }\r\r\n\t\t],\r\r\n\t\t\"iDisplayLength\": 10,\r\r\n\t\t\"language\": {\r\r\n\t\t\t\"url\":\"js/Turkish.json\"\r\r\n\t\t},\r\r\n\t\t\"fnDrawCallback\": function( oSettings ) {\r\r\n\t\t\$(\".popconfirm\").popConfirm();\r\r\n\t\t}\r\r\n\t});\r\r\n\t\$('#order-listingg').on('click', 'tbody tr td.secili', function(event) {\t\r\r\n\t\t\$(this).closest(\"tr\").find(\"td:eq(0)\").find(\"input[type=checkbox]\").trigger('click');\r\r\n\t\tif(\$(this).closest(\"tr\").find(\"input[type=checkbox]\").prop(\"checked\")){\r\r\n\t\t\t\$(this).closest(\"tr\").addClass('highlight');\r\r\n\t\t}else{\r\r\n\t\t\t\$(this).closest(\"tr\").removeClass('highlight');\r\r\n\t\t}\r\r\n\t});\r\r\n\t\$(\".select-all\").click(function () {\r\r\n\t\t\$(\"input:checkbox\").not(this).prop('checked', this.checked);\r\r\n\r\r\n\t\tif(this.checked){\r\r\n\t\t\t\$(\"input:checkbox\").not(this).closest(\"tr\").addClass('highlight');\r\r\n\t\t}else{\r\r\n\t\t\t\$(\"input:checkbox\").not(this).closest(\"tr\").removeClass('highlight');\r\r\n\t\t}\t\t\t\r\r\n\t});\r\r\n});\r\r\n</script>\r\r\n";
mesaj("rehber_ekle", 1, "yes", "Başarı ile eklenmiştir.");
mesaj("rehbersil", 1, "yes", "Başarı ile silinmiştir.");
mesaj("rehbersil", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("rehber_tumu", 1, "yes", "Seçilen kayıtlar başarıyla silinmiştir.");
mesaj("rehber_tumu", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("rehber_aktif", 1, "yes", "Bilgileriniz başarıyla güncellendi.");
mesaj("rehber_aktif", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("rehber_pasif", 1, "yes", "Bilgileriniz başarıyla güncellendi.");
mesaj("rehber_pasif", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("secim", 3, "secimyok", "Hiç bir şey seçmediniz. Lütfen işlem yapmak istediğiniz eylemi ve ID leri seçin.");
echo "\r\n";


?>