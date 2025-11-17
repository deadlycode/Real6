<?php


echo !defined("GUVENLIK") ? exit : NULL;
echo "\r\n";
oturumkontrol($url);
if (strip_tags($_GET["id"])) {
    $Sorgu = $db->prepare("SELECT * FROM haberler WHERE id = ?");
    $Sorgu->execute([strip_tags($_GET["id"])]);
    if ($Sorgu->rowCount()) {
        $Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
        echo "\r\n<!-- partial -->\r\r\n<div class=\"page-header\">\r\r\n\t<div class=\"page-title mt-0 mb-0\">\r\r\n\t\t<h3>";
        echo $admindil["txt80_1"];
        echo "</h3>\r\r\n\t\t<div class=\"crumbs\">\r\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\r\n\t\t\t\t<li><a href=\"";
        echo $sayfalink;
        echo "\">";
        echo $admindil["txt77"];
        echo "</a></li>\r\r\n\t\t\t\t<li><a href=\"haber-listele";
        echo $html;
        echo "\">";
        echo $Sonuc["adi"];
        echo "</a></li>\r\r\n\t\t\t\t<li class=\"active\"><a href=\"";
        echo $sayfalink;
        echo "\">";
        echo $admindil["txt80_1"];
        echo "</a></li>\r\r\n\t\t\t</ul>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n</div>\r\r\n<div class=\"card\">\r\r\n\t<form action=\"../_class/yonetim_islem.php\" method=\"POST\" enctype=\"multipart/form-data\">\r\r\n\t\t<input type=\"hidden\" name=\"galeriid\" value=\"";
        echo $Sonuc["id"];
        echo "\" />\r\r\n\t\t<div class=\"card-body\">\r\r\n\t\t\t<div class=\"row mb-3\">\r\r\n\t\t\t\t<div class=\"col-lg-12\">\r\r\n\t\t\t\t\t<div class=\"btn-toolbar\" role=\"toolbar\">\t\t\t\t\t\r\r\n\t\t\t\t\t\t<a href=\"\" data-toggle=\"modal\" data-target=\"#foto_ekle\" data-backdrop=\"static\" data-keyboard=\"false\" class=\"btn btn-success btn-sm mr-1\">\r\r\n\t\t\t\t\t\t\t<i class=\"icon-plus font-12\"></i> Yeni Ekle\r\r\n\t\t\t\t\t\t</a>\r\r\n\t\t\t\t\t\t<button type=\"submit\" name=\"haberfoto_tumu\" class=\"btn btn-danger btn-sm mr-1\">\r\r\n\t\t\t\t\t\t\t<i class=\"icon-trash font-12\"></i> Seçilenleri Sil\r\r\n\t\t\t\t\t\t</button>\r\r\n\t\t\t\t\t\t<a href=\"javascript:void(0)\" id=\"sec\" class=\"btn btn-primary btn-sm mr-1\">\r\r\n\t\t\t\t\t\t\t<i class=\"icon-star font-12\"></i> Tümünü Seç\r\r\n\t\t\t\t\t\t</a>\r\r\n\t\t\t\t\t\t<a href=\"javascript:void(0)\" id=\"birak\" class=\"btn btn-warning btn-sm mr-1\">\r\r\n\t\t\t\t\t\t\t<i class=\"icon-close font-12\"></i> Hiçbirini Seçme\r\r\n\t\t\t\t\t\t</a>\r\r\n\t\t\t\t\t\t\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t</div>\r\r\n\t\t\t</div>\r\r\n\t\t\t\r\r\n\t\t\t<div class=\"row\">\r\r\n\t\t\t\t<div class=\"col-12\">\r\r\n\t\t\t\t\t<h4 class=\"card-title mt-3\">";
        echo $Sonuc["adi"];
        echo " Galerisi</h4>\r\r\n\t\t\t\t\t<div class=\"row portfolio-grid\">\r\r\n\t\t\t\t\t";
        $FOTOSorgu = $db->prepare("SELECT * FROM haberfoto WHERE resimid = ? ORDER BY id ASC");
        $FOTOSorgu->execute([$Sonuc["id"]]);
        $FOTOislem = $FOTOSorgu->fetchALL(PDO::FETCH_ASSOC);
        echo "\r\n\t\t\t\t\t";
        if ($FOTOSorgu->rowCount()) {
            echo "\r\n\t\t\t\t\t\t";
            foreach ($FOTOislem as $FOTOSonuc) {
                echo "\r\n\t\t\t\t\t\t<div class=\"col-xl-2 col-lg-2 col-md-2 col-sm-4 col-12\">\r\r\n\t\t\t\t\t\t\t<figure class=\"proje_resim_box\">\r\r\n\t\t\t\t\t\t\t\t<div class=\"proje_resim_select\">\r\r\n\t\t\t\t\t\t\t\t<div class=\"form-check form-check-flat form-check-primary m-0 p-0\">\r\r\n\t\t\t\t\t\t\t\t\t<label class=\"form-check-label ml-3\">\r\r\n\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"fotoid[]\" value=\"";
                echo $FOTOSonuc["id"];
                echo "\" class=\"form-check-input\"><i class=\"input-helper\"></i>\r\r\n\t\t\t\t\t\t\t\t\t</label>\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t<div class=\"proje_resim_del\">\t\r\r\n\t\t\t\t\t\t\t\t\t<a title=\"Görsel Güncelle\" data-toggle=\"modal\" data-target=\"#foto_duzenle_";
                echo $FOTOSonuc["id"];
                echo "\" data-backdrop=\"static\" data-keyboard=\"false\" href=\"#\" class=\"text-black\">\r\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"tablemain_contents_ic_div_edit\" style=\"margin:0px; padding:0px; border:0px;\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-edit\" aria-hidden=\"true\"></i>\r\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t</a>\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t<div class=\"proje_resim_delete\">\t\r\r\n\t\t\t\t\t\t\t\t\t<a class=\"popconfirm text-black\" title=\"Foto Sil\" href=\"../_class/yonetim_islem.php?haberfotosil=ok&id=";
                echo $FOTOSonuc["id"];
                echo "&galeriid=";
                echo $Sonuc["id"];
                echo "\">\r\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"tablemain_contents_ic_div_times\" style=\"margin:0px; padding:0px; border:0px;\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>\r\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t</a>\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t<img src=\"../";
                echo tema;
                echo "/uploads/haberler/fotogaleri/";
                echo $FOTOSonuc["resim"];
                echo "\" style=\"height:170px;\" alt=\"image\">\r\r\n\t\t\t\t\t\t\t</figure>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t<!-- Foto Güncelle -->\r\r\n\t\t\t\t\t\t<div class=\"modal fade\" id=\"foto_duzenle_";
                echo $FOTOSonuc["id"];
                echo "\" role=\"dialog\">\r\r\n\t\t\t\t\t\t\t<div class=\"modal-dialog modal-sm\">\r\r\n\r\r\n\t\t\t\t\t\t\t\t<!-- Modal content-->\r\r\n\t\t\t\t\t\t\t\t<div class=\"modal-content\">\r\r\n\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t\t\t\t<div class=\"modal-header pb-1 pt-2\" style=\"background:#38647A;\">\t\t\t\t\r\r\n\t\t\t\t\t\t\t\t\t\t<h5 class=\"modal-title d-inline-block text-white\">Görsel Güncelleme</h5>\r\r\n\t\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"close p-0 m-1\" data-dismiss=\"modal\"><i class=\"fa fa-times-circle\"></i></button>\r\r\n\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t\t\t\t<div class=\"modal-body\">                \r\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"container-fluid\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t<div class=\"row\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-12 col-sm-12 col-xs-12\">\t\t\t\t\t\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t<label>Resmi Değiştiriniz</label>\r\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"file\" name=\"resim\" class=\"file-upload-default\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"input-group col-xs-12\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control file-upload-info form-control-sm\" disabled=\"\" placeholder=\"Resim dosyası seçiniz\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-append\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<button class=\"file-upload-browse btn btn-primary btn-sm\" type=\"button\"><i class=\"icon-cloud-upload font-12\"></i> Dosya Seç</button>\r\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</span>\r\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t\t\t\t<div class=\"modal-footer\">\r\r\n\t\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"foto_id\" value=\"";
                echo $FOTOSonuc["id"];
                echo "\">\r\r\n\t\t\t\t\t\t\t\t\t\t<button name=\"haberfoto_guncelle\" class=\"button btn btn-primary p-2\"><i class=\"fa fa-plus-circle\"></i> Güncelle</button>\r\r\n\t\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"button btn btn-default p-2\" data-dismiss=\"modal\"><i class=\"fa fa-times-circle\"></i> Kapat</button>\t\t\t\t\r\r\n\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t";
            }
            echo "\r\n\t\t\t\t\t\t";
        } else {
            echo "\r\n\t\t\t\t\t\t<div class=\"col-md-12\">\r\r\n\t\t\t\t\t\t\t<div class=\"alert alert-secondary\" role=\"alert\">\r\r\n\t\t\t\t\t\t\t\tKayıt bulunamadı.\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t";
        }
        echo "\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t</div>\r\r\n\t\t\t</div>\r\r\n\t\t</div>\r\r\n\t\t<!-- Foto Güncelle -->\r\r\n\t\t<div class=\"modal fade\" id=\"foto_ekle\" role=\"dialog\">\r\r\n\t\t\t<div class=\"modal-dialog modal-sm\">\r\r\n\r\r\n\t\t\t\t<!-- Modal content-->\r\r\n\t\t\t\t<div class=\"modal-content\">\r\r\n\t\t\t\t\r\r\n\t\t\t\t\t<div class=\"modal-header pb-1 pt-2\" style=\"background:#38647A;\">\t\t\t\t\r\r\n\t\t\t\t\t\t<h5 class=\"modal-title d-inline-block text-white\">Galerinize Fotoğraf Ekleyin</h5>\r\r\n\t\t\t\t\t\t<button type=\"button\" class=\"close p-0 m-1\" data-dismiss=\"modal\"><i class=\"fa fa-times-circle\"></i></button>\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\r\r\n\t\t\t\t\t<div class=\"modal-body\">                \r\r\n\t\t\t\t\t\t<div class=\"container-fluid\">\r\r\n\t\t\t\t\t\t\t<div class=\"row\">\r\r\n\t\t\t\t\t\t\t\t<div class=\"col-md-12 col-sm-12 col-xs-12\">\r\r\n\t\t\t\t\t\t\t\t\t<div class=\"alert alert-warning\" role=\"alert\">\r\r\n\t\t\t\t\t\t\t\t\t\tToplu halde fotoğraf seçimi yapabilirsiniz. Fotoğraf seçimlerinizin ardından aşağıdaki kaydet tuşuna basınız.\r\r\n\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t<div class=\"col-md-12 col-sm-12 col-xs-12\">\t\t\t\t\t\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-group\">\r\r\n\t\t\t\t\t\t\t\t\t<label>Resim Seçiniz</label>\r\r\n\t\t\t\t\t\t\t\t\t\t<input type=\"file\" name=\"resimler[]\" multiple class=\"file-upload-default\">\r\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"input-group col-xs-12\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control file-upload-info form-control-sm\" disabled=\"\" placeholder=\"Resim dosyaları seçiniz\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t<span class=\"input-group-append\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t\t<button class=\"file-upload-browse btn btn-primary btn-sm\" type=\"button\"><i class=\"icon-cloud-upload font-12\"></i> Dosyaları Seç</button>\r\r\n\t\t\t\t\t\t\t\t\t\t\t</span>\r\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\r\r\n\t\t\t\t\t<div class=\"modal-footer\">\r\r\n\t\t\t\t\t\t<input type=\"hidden\" name=\"id\" value=\"";
        echo $Sonuc["id"];
        echo "\">\r\r\n\t\t\t\t\t\t<button name=\"haberfoto_ekle\" class=\"button btn btn-primary p-2\"><i class=\"fa fa-plus-circle\"></i> Kaydet</button>\r\r\n\t\t\t\t\t\t<button type=\"button\" class=\"button btn btn-default p-2\" data-dismiss=\"modal\"><i class=\"fa fa-times-circle\"></i> Kapat</button>\t\t\t\t\r\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\r\r\n\t\t\t\t</div>\r\r\n\r\r\n\t\t\t</div>\r\r\n\t\t</div>\r\r\n\t</form>\r\r\n</div>\r\r\n<script>\r\r\n\$(document).ready(function(){\r\r\n\t\$(\"#sec\").click(function(){\r\r\n\t\t\$(\"input:checkbox\").each(function(){\t\t\r\r\n\t\t\tthis.checked = true;\t\t\r\r\n\t\t});\r\r\n\t});\r\r\n\t\r\r\n\t\$(\"#birak\").click(function(){\r\r\n\t\t\$(\"input:checkbox\").each(function(){\t\t\r\r\n\t\t\tthis.checked = false;\t\t\r\r\n\t\t});\r\r\n\t});\r\r\n});\r\r\n</script>\r\r\n";
        mesaj("haberfoto_ekle", 1, "yes", "Başarı ile eklenmiştir.");
        mesaj("haberfoto_ekle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
        mesaj("haberfoto_guncelle", 1, "yes", "Başarı ile guncellenmiştir.");
        mesaj("haberfoto_guncelle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
        mesaj("haberfotosil", 1, "yes", "Başarı ile silinmiştir.");
        mesaj("haberfotosil", 2, "no", "Hata oluştu tekrar deneyiniz.!");
        mesaj("haberfoto_tumu", 1, "yes", "Seçilen kayıtlar başarıyla silinmiştir.");
        mesaj("haberfoto_tumu", 2, "no", "Hata oluştu tekrar deneyiniz.!");
        mesaj("secim", 3, "secimyok", "Hiç bir şey seçmediniz. Lütfen işlem yapmak istediğiniz eylemi ve ID leri seçin.");
        echo "\r\n";
        
    } else {
        header("Location:" . $url . "/404" . $html . "");
        exit;
    }
} else {
    header("Location:" . $url . "/404" . $html . "");
    exit;
}

?>