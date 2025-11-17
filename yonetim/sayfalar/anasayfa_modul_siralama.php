<?php


echo !defined("GUVENLIK") ? exit : NULL;
oturumkontrol($url);
echo "<div class=\"page-header\">\r\n\t<div class=\"page-title mt-0 mb-0\">\r\n\t\t<h3>";
echo $admindil["txt159"];
echo "</h3>\r\n\t\t<div class=\"crumbs\">\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\n\t\t\t\t<li><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt2"];
echo "</a></li>\r\n\t\t\t\t<li class=\"active\"><a href=\"";
echo $sayfalink;
echo "\">";
echo $admindil["txt159"];
echo "</a></li>\r\n\t\t\t</ul>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n<div class=\"row\">\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\n\t\t<div class=\"card\">\r\n\t\t\t<div class=\"card-body\">\r\n\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\">\r\n\t\t\t\t<input id=\"id\" name=\"id\" type=\"hidden\" value=\"";
echo $Sonuc["id"];
echo "\">\r\n\t\t\t\t\t<div class=\"row\">\r\n\r\n\t\t\t\t\t\t<div class=\"col-md-12 grid-margin grid-margin-md-0 stretch-card\">\r\n\t\t\t\t\t\t\t<div class=\"card\">\r\n\t\t\t\t\t\t\t\t<div class=\"card-body\" id=\"sortable\">\r\n\t\t\t\t\t\t\t\t\t<h4 class=\"card-title\">";
echo $admindil["txt159"];
echo "</h4>\r\n\t\t\t\t\t\t\t\t\t";
$SiralamaSorgu = $db->prepare("SELECT * FROM siralama ORDER BY sira ASC");
$SiralamaSorgu->execute();
$Siralamaislem = $SiralamaSorgu->fetchALL(PDO::FETCH_ASSOC);
echo "\t\t\t\t\t\t\t\t\t";
foreach ($Siralamaislem as $Siralamakey => $SiralamaSonuc) {
    echo " \r\n\t\t\t\t\t\t\t\t\t<div class=\"card rounded border mb-2\" id=\"item-";
    echo $SiralamaSonuc["id"];
    echo "\">\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"card-body p-3 secili\">\r\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"media\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"mdi mdi-file-outline icon-sm align-self-center mr-3\"></i>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"media-body\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<h6 class=\"mb-1\">";
    echo $SiralamaSonuc["isim"];
    echo "</h6>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<p class=\"mb-0 text-muted\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
    echo $SiralamaSonuc["kisa"];
    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t</p>\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t</div> \r\n\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t";
}
echo "\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</form>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n<style type=\"text/css\">\r\n.secili{\r\n\tcursor:move;\r\n}\r\n</style>\r\n<script src=\"vendors/js/jquery-ui.min.js\"></script>\r\n<script type=\"text/javascript\">\r\n\$(function(){\r\n\t\$(\"#sortable\").sortable({\r\n\t\trevert: true,\r\n\t\thandle: \".secili\",\r\n\t\tstop: function(event, ui){\r\n\t\t\tvar data = \$(this).sortable('serialize');\r\n\t\t\t\r\n\t\t\t\$.ajax({\r\n\t\t\t\ttype: \"POST\",\r\n\t\t\t\tdataType: \"json\",\r\n\t\t\t\tdata: data,\r\n\t\t\t\turl: \"../_class/yonetim_islem.php?modulsiralama=sira\",\r\n\t\t\t\tsuccess: function(msg){\r\n\t\t\t\t\tif(msg.islemMsj == \"Güncellendi\")\r\n\t\t\t\t\t{\r\n\t\t\t\t\t\t\$.toast({\r\n\t\t\t\t\t\t  heading: 'Başarılı!',\r\n\t\t\t\t\t\t  text: msg.islemMsj,\r\n\t\t\t\t\t\t  showHideTransition: 'slide',\r\n\t\t\t\t\t\t  icon: 'success',\r\n\t\t\t\t\t\t  loaderBg: '#fff',\r\n\t\t\t\t\t\t  position: 'top-right'\r\n\t\t\t\t\t\t})\r\n\t\t\t\t\t}\r\n\t\t\t\t\tif(msg.islemMsj == \"İşlem başarısız\")\r\n\t\t\t\t\t{\r\n\t\t\t\t\t\t\$.toast({\r\n\t\t\t\t\t\t  heading: 'Hata',\r\n\t\t\t\t\t\t  text: msg.islemMsj,\r\n\t\t\t\t\t\t  showHideTransition: 'slide',\r\n\t\t\t\t\t\t  icon: 'error',\r\n\t\t\t\t\t\t  loaderBg: '#fff',\r\n\t\t\t\t\t\t  position: 'top-right'\r\n\t\t\t\t\t\t})\r\n\t\t\t\t\t}\r\n\t\t\t\t\tif(msg.islemMsj == \"Demo hesapta işlem yapamassınız.!\")\r\n\t\t\t\t\t{\r\n\t\t\t\t\t\t\$.toast({\r\n\t\t\t\t\t\t  heading: 'Hata',\r\n\t\t\t\t\t\t  text: msg.islemMsj,\r\n\t\t\t\t\t\t  showHideTransition: 'slide',\r\n\t\t\t\t\t\t  icon: 'warning',\r\n\t\t\t\t\t\t  loaderBg: '#fff',\r\n\t\t\t\t\t\t  position: 'top-right'\r\n\t\t\t\t\t\t})\r\n\t\t\t\t\t}\r\n\t\t\t\t}\t\t\t\t\r\n\t\t\t});\r\n\t\t}\r\n\t});\r\n\t\$(\"#sortable\").disableSelection();\r\n});\r\n</script>\r\n";


?>