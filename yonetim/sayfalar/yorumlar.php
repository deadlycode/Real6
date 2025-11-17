<?php


echo !defined("GUVENLIK") ? exit : NULL;
echo "\r\n";
oturumkontrol($url);
echo "\r\n<div class=\"page-header\">\r\r\n\t<div class=\"page-title mt-0 mb-0\">\r\r\n\t\t<h3>";
echo $admindil["txt117"];
echo "</h3>\r\r\n\t\t<div class=\"crumbs\">\r\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\r\n\t\t\t\t<li class=\"active\"><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt117"];
echo "</a></li>\r\r\n\t\t\t</ul>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n</div>\r\r\n<div class=\"card\">\r\r\n\t<form action=\"../_class/yonetim_islem.php\" method=\"POST\">\r\r\n\t<div class=\"card-body\">\r\r\n\t\t<div class=\"row mb-3\">\r\r\n\t\t\t<div class=\"col-lg-12\">\r\r\n\t\t\t\t<div class=\"btn-toolbar\" role=\"toolbar\">\t\t\t\t\t\r\r\n\t\t\t\t\t<div class=\"dropdown\">\r\r\n\t\t\t\t\t\t<button class=\"btn btn-primary btn-sm dropdown-toggle\" type=\"button\" id=\"dropdownMenuSizeButton3\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\r\r\n\t\t\t\t\t\t\t<i class=\"icon-options-vertical font-12\"></i> Seçilenlere Uygula\r\r\n\t\t\t\t\t\t</button>\r\r\n\t\t\t\t\t\t<div class=\"dropdown-menu p-0 min-width-full\" aria-labelledby=\"dropdownMenuSizeButton3\">\r\r\n\t\t\t\t\t\t\t<button class=\"dropdown-item p-2 cursor-pointer\" type=\"submit\" name=\"yorum_onayli\"><i class=\"ti-control-play\"></i> Onaylanan</button>\r\r\n\t\t\t\t\t\t\t<button class=\"dropdown-item p-2 cursor-pointer\" type=\"submit\" name=\"yorum_onaysiz\"><i class=\"ti-control-pause\"></i> Onay Bekleyen</button>\r\r\n\t\t\t\t\t\t\t<button class=\"dropdown-item p-2 cursor-pointer\" type=\"submit\" name=\"yorum_tumu\"><i class=\"icon-trash\"></i> Seçilenleri Sil</button>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t</div>\r\r\n\t\t\t</div>\r\r\n\t\t</div>\t\t\r\r\n\t\t<div class=\"row\">\r\r\n\t\t\t<div class=\"col-12\">\r\r\n\t\t\t\t<div class=\"table-responsive\">\r\r\n\t\t\t\t\t<table id=\"order-listingg\" class=\"table table-bordered table-hover\">\r\r\n\t\t\t\t\t\t<thead class=\"headbg\">\r\r\n\t\t\t\t\t\t\t<tr>\r\r\n\t\t\t\t\t\t\t\t<th class=\"noshort\" style=\"width:20px;\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Tümünü Seç\">\r\r\n\t\t\t\t\t\t\t\t\t<input id=\"checkbox-4\" class=\"select-all checkbox-custom\" type=\"checkbox\" style=\"width:100px;\">\r\r\n\t\t\t\t\t\t\t\t\t<label for=\"checkbox-4\" class=\"checkbox-custom-label mb-0\"><span class=\"checktext\"></span></label>\r\r\n\t\t\t\t\t\t\t\t</th>\r\r\n\t\t\t\t\t\t\t\t<th>Gönderen</th>\r\r\n\t\t\t\t\t\t\t\t<th>Tarih</th>\r\r\n\t\t\t\t\t\t\t\t<th style=\"width:70px;\">Durumu</th>\r\r\n\t\t\t\t\t\t\t\t<th style=\"width:115px;\">İşlem</th>\r\r\n\t\t\t\t\t\t\t</tr>\r\r\n\t\t\t\t\t\t</thead>\r\r\n\t\t\t\t\t\t<tbody></tbody>\r\r\n\t\t\t\t\t</table>\r\r\n\t\t\t\t</div>\r\r\n\t\t\t</div>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n\t</form>\r\r\n</div>\r\r\n<!-- content-wrapper ends -->\r\r\n\r\r\n\r\r\n<script>\r\r\n\$(document).ready(function(){\r\r\n\tvar dataTable=\$('#order-listingg').DataTable({\r\r\n\t\t\"processing\": true,\r\r\n\t\t\"serverSide\":true,\r\r\n\t\t\"ajax\":{\r\r\n\t\t\turl:\"data/yorumlar.php\",\r\r\n\t\t\ttype:\"post\"\r\r\n\t\t},\r\r\n\t\t\"order\": [\r\r\n\t\t\t[ 0, \"desc\" ]\r\r\n\t\t],\r\r\n\t\t\"aLengthMenu\": [\r\r\n\t\t\t[5, 10, 15, ";
echo tumu("musteri_gorusleri", 2);
echo "],\r\r\n\t\t\t[5, 10, 15, \"Tümü\"]\r\r\n\t\t],\r\r\n\t\t\"columnDefs\": [\r\r\n\t\t\t{ \"orderable\": false, \"targets\": [0, 4] },\r\r\n\t\t\t{  \"className\": \"secili\", targets: [1, 2, 3] },\r\r\n\t\t\t{  \"className\": \"text-center\", targets: [4] }\r\r\n\t\t],\r\r\n\t\t\"iDisplayLength\": 10,\r\r\n\t\t\"language\": {\r\r\n\t\t\t\"url\":\"js/Turkish.json\"\r\r\n\t\t},\r\r\n\t\t\"fnDrawCallback\": function( oSettings ) {\r\r\n\t\t\$(\".popconfirm\").popConfirm();\r\r\n\t\t}\r\r\n\t});\r\r\n\t\$('#order-listingg').on('click', 'tbody tr td.secili', function(event) {\t\r\r\n\t\t\$(this).closest(\"tr\").find(\"td:eq(0)\").find(\"input[type=checkbox]\").trigger('click');\r\r\n\t\tif(\$(this).closest(\"tr\").find(\"input[type=checkbox]\").prop(\"checked\")){\r\r\n\t\t\t\$(this).closest(\"tr\").addClass('highlight');\r\r\n\t\t}else{\r\r\n\t\t\t\$(this).closest(\"tr\").removeClass('highlight');\r\r\n\t\t}\r\r\n\t});\r\r\n\t\$(\".select-all\").click(function () {\r\r\n\t\t\$(\"input:checkbox\").not(this).prop('checked', this.checked);\r\r\n\r\r\n\t\tif(this.checked){\r\r\n\t\t\t\$(\"input:checkbox\").not(this).closest(\"tr\").addClass('highlight');\r\r\n\t\t}else{\r\r\n\t\t\t\$(\"input:checkbox\").not(this).closest(\"tr\").removeClass('highlight');\r\r\n\t\t}\t\t\t\r\r\n\t});\r\r\n});\r\r\n</script>\r\r\n";
mesaj("yorumsil", 1, "yes", "Başarı ile silinmiştir.");
mesaj("yorumsil", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("yorum_tumu", 1, "yes", "Seçilen kayıtlar başarıyla silinmiştir.");
mesaj("yorum_tumu", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("yorum_onayli", 1, "yes", "Seçili yorumlar onaylanmıştır.");
mesaj("yorum_onayli", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("yorum_onaysiz", 1, "yes", "Seçili yorumların onayı kaldırılmıştır.");
mesaj("yorum_onaysiz", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("yorumonaykaldir", 1, "yes", "Yorumun onayı kaldırılmıştır.");
mesaj("yorumonaykaldir", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("yorumonayla", 1, "yes", "Yorum onaylanmıştır.");
mesaj("yorumonayla", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("secim", 3, "secimyok", "Hiç bir şey seçmediniz. Lütfen işlem yapmak istediğiniz eylemi ve ID leri seçin.");
echo "\r\n";

echo "\t";

?>