<?php


echo !defined("GUVENLIK") ? exit : NULL;
echo "\r\n";
oturumkontrol($url);
echo "\r\n<div class=\"page-header\">\r\r\n\t<div class=\"page-title mt-0 mb-0\">\r\r\n\t\t<h3>";
echo $admindil["txt32"];
echo "</h3>\r\r\n\t\t<div class=\"crumbs\">\r\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\r\n\t\t\t\t<li><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt26"];
echo "</a></li>\r\r\n\t\t\t\t<li class=\"active\"><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt32"];
echo "</a></li>\r\r\n\t\t\t</ul>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n</div>\r\r\n<div class=\"card\">\r\r\n\t<form action=\"../_class/yonetim_islem.php\" method=\"POST\">\r\r\n\t<div class=\"card-body\">\r\r\n\t\t\r\r\n\t\t<div class=\"row\">\r\r\n\t\t\t<div class=\"col-12\">\r\r\n\t\t\t\t<div class=\"table-responsive\">\r\r\n\t\t\t\t\t<table id=\"order-listingg\" class=\"table table-bordered table-hover\">\r\r\n\t\t\t\t\t\t<thead class=\"headbg\">\r\r\n\t\t\t\t\t\t\t<tr>\r\r\n\t\t\t\t\t\t\t\t<th>Bildirim</th>\r\r\n\t\t\t\t\t\t\t\t<th>Konu</th>\r\r\n\t\t\t\t\t\t\t\t<th style=\"width:115px;\">İşlem</th>\r\r\n\t\t\t\t\t\t\t</tr>\r\r\n\t\t\t\t\t\t</thead>\r\r\n\t\t\t\t\t\t<tbody></tbody>\r\r\n\t\t\t\t\t</table>\r\r\n\t\t\t\t</div>\r\r\n\t\t\t</div>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n\t</form>\r\r\n</div>\r\r\n<!-- content-wrapper ends -->\r\r\n<script>\r\r\n\$(document).ready(function(){\r\r\n\tvar dataTable=\$('#order-listingg').DataTable({\r\r\n\t\t\"processing\": true,\r\r\n\t\t\"serverSide\":true,\r\r\n\t\t\"ajax\":{\r\r\n\t\t\turl:\"data/bildirim_sablonu.php\",\r\r\n\t\t\ttype:\"post\"\r\r\n\t\t},\r\r\n\t\t\"aLengthMenu\": [\r\r\n\t\t\t[5, 10, 15, -1],\r\r\n\t\t\t[5, 10, 15, \"Tümü\"]\r\r\n\t\t],\r\r\n\t\t\"columnDefs\": [\r\r\n\t\t\t{ \"orderable\": false, \"targets\": [0, 2] },\r\r\n\t\t\t{  \"className\": \"text-center\", targets: [2] }\r\r\n\t\t],\r\r\n\t\t\"iDisplayLength\": 10,\r\r\n\t\t\"language\": {\r\r\n\t\t\t\"url\":\"js/Turkish.json\"\r\r\n\t\t},\r\r\n\t\t\"fnDrawCallback\": function( oSettings ) {\r\r\n\t\t\$(\".popconfirm\").popConfirm();\r\r\n\t\t}\r\r\n\t});\r\r\n\tjQuery(\".select-all\").click(function () {\r\r\n\t\tjQuery(\"input:checkbox\").not(this).prop('checked', this.checked);\r\r\n\t});\r\r\n});\r\r\n</script>\r\r\n";


?>