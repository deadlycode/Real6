<?php


if (isset($_GET["islem"]) == "duzenle") {
    $durum = "duzenle";
    $Sorgu = $db->prepare("SELECT * FROM uyeler WHERE id = ?");
    $Sorgu->execute([$_GET["id"]]);
    if ($Sorgu->rowCount()) {
        $Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
        $islemler = strip_tags($_GET["islemler"]);
        switch ($islemler) {
            case "bilgiler":
                $bilgiler = "active";
                $ariaselected_1 = "true";
                $ariaselected_2 = "false";
                $ariaselected_3 = "false";
                $bilgileractive = "show active";
                break;
            default:
                $bilgiler = "active";
                $ariaselected_1 = "true";
                $ariaselected_2 = "false";
                $ariaselected_3 = "false";
                $bilgileractive = "show active";
        }
    } else {
        header("Location:" . $url . "/404" . $html . "");
    }
    echo "<div class=\"page-header\">\r\n\t<div class=\"page-title mt-0 mb-0\">\r\n\t\t<h3>";
    echo $admindil["txt146"];
    echo "</h3>\r\n\t\t<div class=\"crumbs\">\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\n\t\t\t\t<li><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt26"];
    echo "</a></li>\r\n\t\t\t\t<li class=\"active\"><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt146"];
    echo "</a></li>\r\n\t\t\t</ul>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n<div class=\"row\">\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\n\t\t<div class=\"card\">\r\n\t\t\t<div class=\"card-body\">\t\t\t\r\n\t\t\t\r\n\t\t\t\t<ul class=\"nav nav-pills nav-pills-success\" id=\"pills-tab\" role=\"tablist\">\r\n\t\t\t\t\t<li class=\"nav-item\">\r\n\t\t\t\t\t\t<a class=\"nav-link ";
    echo $bilgiler;
    echo "\" id=\"bilgiler-tab\" data-toggle=\"pill\" href=\"#bilgiler\" role=\"tab\" aria-controls=\"bilgiler\" ";
    echo $ariaselected_1;
    echo ">Müşteri Bilgileri</a>\r\n\t\t\t\t\t</li>\r\n\t\t\t\t\r\n\t\t\t\t\r\n\t\t\t\t</ul>\r\n\t\t\t\t<div class=\"tab-content p-3\" id=\"pills-tabContent\">\r\n\t\t\t\t\t<div class=\"tab-pane fade ";
    echo $bilgileractive;
    echo "\" id=\"bilgiler\" role=\"tabpanel\" aria-labelledby=\"bilgiler-tab\">\r\n\t\t\t\t\t\r\n\t\t\t\t\t\t<div class=\"accordion accordion-multi-colored\" id=\"accordion-1\" role=\"tablist\">\r\n\t\t\t\t\t\t\t<div class=\"card\">\r\n\t\t\t\t\t\t\t\t<div class=\"card-header p-3\" role=\"tab\" id=\"heading-1\">\r\n\t\t\t\t\t\t\t\t\t<h6 class=\"mb-0\">\r\n\t\t\t\t\t\t\t\t\t\t<a class=\"collapsed\" data-toggle=\"collapse\" href=\"#collapse-1\" aria-expanded=\"false\" aria-controls=\"collapse-1\">\r\n\t\t\t\t\t\t\t\t\t\t\t\"Müşteri Bilgileri\" hakkında yardımcı açıklamalar...\r\n\t\t\t\t\t\t\t\t\t\t</a>\r\n\t\t\t\t\t\t\t\t\t</h6>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<div id=\"collapse-1\" class=\"collapse\" role=\"tabpanel\" aria-labelledby=\"heading-1\" data-parent=\"#accordion-1\">\r\n\t\t\t\t\t\t\t\t\t<div class=\"card-body p-3\">\r\n\t\t\t\t\t\t\t\t\t\t<p>Sistemde kayıtlı müşterinizin tüm hesap detaylarını bu bölümden inceleyebilir ve düzenleme yapabilirsiniz. Yasaklamak istediğiniz müşterinin hesap durumunu \"pasif\" yada \"engelli\" konuma getirerek mevcut kayıtlı bilgileri ve hesap detaylarını silmeden, sisteme giriş yapmasını engelleyebilirsiniz.</p>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t</div>\t\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t\t<form class=\"forms-sample\" method=\"post\" action=\"../_class/yonetim_islem.php\" enctype=\"multipart/form-data\" autocomplete=\"off\">\r\n\t\t\t\t\t\t<input id=\"d_id\" name=\"d_id\" type=\"hidden\" value=\"";
    echo $Sonuc["id"];
    echo "\">\r\n\t\t\t\t\t\t<input id=\"ilceid\" name=\"ilceid\" type=\"hidden\" value=\"";
    echo $Sonuc["ilce"];
    echo "\">\r\n\t\t\t\t\t\t\t\r\n                            <div class=\"form-group row mb-0\">\r\n                                <div class=\"col-lg-3 text-right\">\r\n                                    <label class=\"col-form-label font-weight-bold\" for=\"adsoyad\">Adı Soyadı</label>\r\n                                </div>\r\n                                <div class=\"col-lg-9\">\r\n                                    <input type=\"text\" class=\"form-control form-control-sm text-capitalize\" name=\"adsoyad\" id=\"adsoyad\" value=\"";
    echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["adsoyad"] : "";
    echo "\" />\r\n                                </div>\r\n                            </div>\r\n\t\t\t\t\t\t\t<div class=\"form-group row mb-0\">\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\n\t\t\t\t\t\t\t\t\t<label class=\"col-form-label font-weight-bold\" for=\"email\">E-Posta</label>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-9\">\r\n\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"email\" id=\"email\" value=\"";
    echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["email"] : "";
    echo "\" data-inputmask=\"'alias': 'email'\" />\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t<div class=\"form-group row mb-0\">\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\n\t\t\t\t\t\t\t\t\t<label class=\"col-form-label font-weight-bold\" for=\"telefon\">GSM</label>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-9\">\r\n\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"telefon\" id=\"telefon\" value=\"";
    echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["telefon"] : "";
    echo "\" />\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t<div class=\"form-group row mb-0\">\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\n\t\t\t\t\t\t\t\t\t<label class=\"col-form-label font-weight-bold\" for=\"il\">İl</label>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-9\">\r\n\t\t\t\t\t\t\t\t\t<select name=\"il\" id=\"il\" class=\"form-control\" onchange=\"findAddress();return false\">\r\n\t\t\t\t\t\t\t\t\t";
    $ILSorgu = $db->prepare("SELECT * FROM il ORDER BY id ASC");
    $ILSorgu->execute();
    $ILislem = $ILSorgu->fetchALL(PDO::FETCH_ASSOC);
    echo "\t\t\t\t\t\t\t\t\t";
    foreach ($ILislem as $ILSonuc) {
        echo "\t\t\t\t\t\t\t\t\t\t<option value=\"";
        echo $ILSonuc["id"];
        echo "\" data-foo=\"";
        echo $ILSonuc["il_adi"];
        echo "\" ";
        echo $Sonuc["il"] == $ILSonuc["id"] ? "selected" : "";
        echo ">";
        echo $ILSonuc["il_adi"];
        echo "</option>\r\n\t\t\t\t\t\t\t\t\t";
    }
    echo "\t\r\n\t\t\t\t\t\t\t\t</select>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t<div class=\"form-group row mb-0\">\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\n\t\t\t\t\t\t\t\t\t<label class=\"col-form-label font-weight-bold\" for=\"ilce\">İlçe</label>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-9\">\r\n\t\t\t\t\t\t\t\t\t<select class=\"form-control\" name=\"ilce\" id=\"ilce\" onchange=\"findAddress2();return false\">\r\n\t\t\t\t\t\t\t\t<option>İlçe Seçiniz</option>\r\n\t\t\t\t\t\t\t\t</select>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\r\n\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t<div class=\"form-group row mb-0\">\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\n\t\t\t\t\t\t\t\t\t<label class=\"col-form-label font-weight-bold\" for=\"adres\">Adres</label>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-9 mb-3\">\r\n\t\t\t\t\t\t\t\t\t<textarea name=\"adres\" class=\"form-control p-2\" rows=\"4\">";
    echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["adres"] : "";
    echo "</textarea>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t<div class=\"form-group row mb-0 kurumsal\">\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\n\t\t\t\t\t\t\t\t\t<label class=\"col-form-label font-weight-bold\" for=\"gorev\">Görevi</label>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-9\">\r\n\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"gorev\" id=\"gorev\" value=\"";
    echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["gorev"] : "";
    echo "\" />\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t<div class=\"form-group row mb-0\">\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\n\t\t\t\t\t\t\t\t\t<label class=\"col-form-label font-weight-bold\" for=\"telefon\">GSM</label>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-9\">\r\n\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"telefon\" id=\"telefon\" value=\"";
    echo isset($_GET["islem"]) == "duzenle" ? $Sonuc["telefon"] : "";
    echo "\" />\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t<div class=\"form-group row mb-0\">\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\n\t\t\t\t\t\t\t\t\t<label class=\"col-form-label font-weight-bold\" for=\"durum\">Giriş İzni</label>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-9\">\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-primary d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"durum\" id=\"durum\" value=\"1\" class=\"form-check-input\" ";
    if ($Sonuc["durum"] == "1") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\tDurumu\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"input-helper\"></i>\r\n\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\r\n\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t<div class=\"form-group row mb-0\">\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\n\t\t\t\t\t\t\t\t\t<label class=\"col-form-label font-weight-bold\" for=\"email_bildirim\">Bildirim İzinleri</label>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-9\">\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-primary d-inline-block mr-2\">\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"email_bildirim\" id=\"email_bildirim\" value=\"1\" class=\"form-check-input\" ";
    if ($Sonuc["email_bildirim"] == "1") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\tE-Posta Bildirim\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"input-helper\"></i>\r\n\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-check form-check-primary d-inline-block\">\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"sms_bildirim\" id=\"sms_bildirim\" value=\"1\" class=\"form-check-input\" ";
    if ($Sonuc["sms_bildirim"] == "1") {
        echo " checked ";
    }
    echo ">\r\n\t\t\t\t\t\t\t\t\t\t\tSMS Bildirim\r\n\t\t\t\t\t\t\t\t\t\t\t<i class=\"input-helper\"></i>\r\n\t\t\t\t\t\t\t\t\t\t</label>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t<div class=\"form-group row mb-0\">\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\n\t\t\t\t\t\t\t\t\t<label class=\"col-form-label font-weight-bold pb-0\">Hesap Açılış Tarihi</label>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-9\">\r\n\t\t\t\t\t\t\t\t\t<p style=\"margin-top:13px;\">";
    echo isset($_GET["islem"]) == "duzenle" ? tarih_panel($Sonuc["tarih"]) : "";
    echo "</p>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t<div class=\"form-group row mb-3\">\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\n\t\t\t\t\t\t\t\t\t<label class=\"col-form-label font-weight-bold pb-0\">Son Giriş Tarihi</label>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-9\">\r\n\t\t\t\t\t\t\t\t\t<p style=\"margin-top:13px;\">";
    echo isset($_GET["islem"]) == "duzenle" ? tarih_panel($Sonuc["son_giris"]) : "";
    echo "</p>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t<div class=\"form-group row mb-0\">\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\n\t\t\t\t\t\t\t\t\t<label class=\"col-form-label font-weight-bold\" for=\"sifre\">Yeni Parola Belirle</label>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-9\">\r\n\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"sifre\" id=\"sifre\" placeholder=\"Değiştirmek istemiyorsanız boş bırakınız.\" />\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t\t<div class=\"form-group row mb-0\" style=\"\">\r\n\t\t\t\t\t\t<div class=\"col-lg-9\">\r\n\t\t\t\t\t\t";
    if (isset($_GET["islem"]) == "duzenle") {
        echo "\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t";
        if ($Sonuc["profil"]) {
            echo "\t\t\t\t\t\t<div class=\"form-group row col-md-2\">\r\n\t\t\t\t\t\t\t<div id=\"lightgallery\" class=\"row lightGallery\">\r\n\t\t\t\t\t\t\t\t<a href=\"../";
            echo tema;
            echo "/uploads/uyeler/";
            echo $Sonuc["profil"];
            echo "\"><img src=\"../";
            echo tema;
            echo "/uploads/uyeler/";
            echo $Sonuc["profil"];
            echo "\" class=\"img-responsive img-thumbnail\" style=\"margin-bottom:2px;width:100%;\"></a>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t<a style=\"width: 100%;\" class=\"btn btn-danger btn-sm popconfirm\" title=\"Resim Sil\" href=\"../_class/yonetim_islem.php?musteriprofilsil=ok&sid=";
            echo $Sonuc["id"];
            echo "\"><i class=\"fas fa-trash\"></i> Resim Sil</a>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t";
        }
        echo "\t\t\t\t\t\t\t\r\n\t\t\t\t\t";
    }
    echo "\t\t\t\t\t<div class=\"form-group row col-md-3\">\r\n\t\t\t\t\t<label>Profil Resmi</label>\r\n\t\t\t\t\t\t<input type=\"file\" name=\"profil\" class=\"file-upload-default\">\r\n\t\t\t\t\t\t<div class=\"input-group col-xs-12\">\r\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control file-upload-info form-control-sm\" disabled=\"\" placeholder=\"Resim dosyası seçiniz\">\r\n\t\t\t\t\t\t\t<span class=\"input-group-append\">\r\n\t\t\t\t\t\t\t\t<button class=\"file-upload-browse btn btn-primary btn-sm\" type=\"button\"><i class=\"icon-cloud-upload font-12\"></i> Dosya Seç</button>\r\n\t\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t\r\n\t\t\t\t\t<div class=\"form-group row mb-0\" style=\"\">\r\n\t\t\t\t\t\t<div class=\"col-lg-9\">\r\n\t\t\t\t\t\t";
    if (isset($_GET["islem"]) == "duzenle") {
        echo "\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t";
        if ($Sonuc["resim"]) {
            echo "\t\t\t\t\t\t<div class=\"form-group row col-md-2\">\r\n\t\t\t\t\t\t\t<div id=\"lightgallery\" class=\"row lightGallery\">\r\n\t\t\t\t\t\t\t\t<a href=\"../";
            echo tema;
            echo "/uploads/uyeler/";
            echo $Sonuc["resim"];
            echo "\"><img src=\"../";
            echo tema;
            echo "/uploads/uyeler/";
            echo $Sonuc["resim"];
            echo "\" class=\"img-responsive img-thumbnail\" style=\"margin-bottom:2px;width:100%;\"></a>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t<a style=\"width: 100%;\" class=\"btn btn-danger btn-sm popconfirm\" title=\"Resim Sil\" href=\"../_class/yonetim_islem.php?musteribelgesil=ok&sid=";
            echo $Sonuc["id"];
            echo "\"><i class=\"fas fa-trash\"></i> Resim Sil</a>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t";
        }
        echo "\t\t\t\t\t\t\t\r\n\t\t\t\t\t";
    }
    echo "\t\t\t\t\t<div class=\"form-group row col-md-3\">\r\n\t\t\t\t\t<label>Emlak Yetki belgesi</label>\r\n\t\t\t\t\t\t<input type=\"file\" name=\"resim\" class=\"file-upload-default\">\r\n\t\t\t\t\t\t<div class=\"input-group col-xs-12\">\r\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control file-upload-info form-control-sm\" disabled=\"\" placeholder=\"Resim dosyası seçiniz\">\r\n\t\t\t\t\t\t\t<span class=\"input-group-append\">\r\n\t\t\t\t\t\t\t\t<button class=\"file-upload-browse btn btn-primary btn-sm\" type=\"button\"><i class=\"icon-cloud-upload font-12\"></i> Dosya Seç</button>\r\n\t\t\t\t\t\t\t</span>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t<div class=\"form-group row\">\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-3 text-right\">\r\n\t\t\t\t\t\t\t\t\t<label class=\"col-form-label\"></label>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<div class=\"col-lg-9\">\r\n\t\t\t\t\t\t\t\t\t<button type=\"submit\" name=\"musteri_guncelle\" class=\"btn btn-success btn-icon-text btn-sm\">\r\n\t\t\t\t\t\t\t\t\t\t<i class=\"mdi mdi-reload  btn-icon-prepend\"></i>                                                    \r\n\t\t\t\t\t\t\t\t\t\tGÜNCELLE\r\n\t\t\t\t\t\t\t\t\t</button>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\t\t\t\t\t\r\n\t\t\t\t\t\t</form>\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t</div>\r\n\t\t\t\t\t\r\n\t\t\t\t\t\r\n\r\n\t\t\t\t</div>\r\n\t\t\t\t\t\t\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n\r\n</div>\r\n<script>\r\n\t\$(document).ready(function(e) {\r\n\t\t\$('#il').bind('change', ilceleriGetir);\r\n\t\t\$('#ilce').bind('change', semtleriGetir);\r\n\t});\r\n\r\n\tfunction ilceleriGetir() {\r\n\t\tvar ilid = \$(this).val();\r\n\t\tvar ilceid=\$(\"#ilceid\").val();\r\n\t\t\$.ajax({\r\n\t\t\ttype: \"post\",\r\n\t\t\turl: \"dinamik.php\",\r\n\t\t\tdata: {\r\n\t\t\t\t\"ilid\": ilid,\r\n\t\t\t\t\"ilceid\": ilceid\r\n\t\t\t},\r\n\t\t\tdataType: \"json\",\r\n\t\t\tsuccess: function(fur) {\r\n\t\t\t\t\$(\"#ilce\").html(fur.basari);\r\n\t\t\t}\r\n\t\t});\r\n\t}\r\n\r\n\tfunction semtleriGetir() {\r\n\t\tvar ilceid = \$(\"#ilce\").val();\r\n\t\tvar semtid = \$(\"#semtid\").val();\r\n\t\t\$.ajax({\r\n\t\t\ttype: \"post\",\r\n\t\t\turl: \"dinamik.php\",\r\n\t\t\tdata: {\r\n\t\t\t\t\"ilceid\": ilceid,\r\n\t\t\t\t\"semtid\": semtid\r\n\t\t\t},\r\n\t\t\tdataType: \"json\",\r\n\t\t\tsuccess: function(fur) {\r\n\t\t\t\t\$(\"#semt\").html(fur.basari);\r\n\t\t\t}\r\n\t\t});\r\n\t}\r\n\r\n\t\$('#il').ready(function() {\r\n\t\tvar ilid = \$(\"#il\").val();\r\n\t\tvar ilceid=\$(\"#ilceid\").val();\r\n\t\tvar semtid=\$(\"#semtid\").val();\r\n\t\tif (ilid != 0) {\r\n\t\t\t\$.ajax({\r\n\t\t\t\ttype: \"post\",\r\n\t\t\t\turl: \"dinamik.php\",\r\n\t\t\t\tdata: {\r\n\t\t\t\t\t\"ilid\": ilid,\r\n\t\t\t\t\t\"ilceid\": ilceid,\r\n\t\t\t\t\t\"semtid\": semtid\r\n\t\t\t\t},\r\n\t\t\t\tdataType: \"json\",\r\n\t\t\t\tsuccess: function(fur) {\r\n\t\t\t\t\t\$(\"#ilce\").html(fur.basari);\r\n\t\t\t\t\tsetTimeout(function() { semtleriGetir(); }, 500);\r\n\t\t\t\t}\r\n\t\t\t});\r\n\t\t} else {\r\n\t\t\t\$(\"#ilce\").html('<option value=\"0\">İlçe Seçiniz</option>');\r\n\t\t}\r\n\t});\r\n</script>\r\n<script>\r\n\$(document).ready(function(e) {\r\n\t\$('input[name=utipi]').bind('change', utipi);\r\n});\r\nfunction utipi(){\r\n\tvar secilen = \$(this).val();\r\n\tif (secilen == 0) {\r\n\t\t\$(\".kurumsal\").slideUp(500);\r\n\t\t\$(\".bireysel\").slideDown(500);\r\n\t} else {\r\n\t\t\$(\".kurumsal\").slideDown(500);\r\n\t\t\$(\".bireysel\").slideUp(500);\r\n\t}\r\n}\r\n\$('input[name=utipi]').ready(function(){\r\n\tvar secilen = \$(\"input[name=utipi]:checked\").val();\r\n\tif (secilen == 0) {\r\n\t\t\$(\".kurumsal\").slideUp(0);\r\n\t\t\$(\".bireysel\").slideDown(500);\r\n\t} else {\r\n\t\t\$(\".kurumsal\").slideDown(0);\r\n\t\t\$(\".bireysel\").slideUp(500);\r\n\t}\r\n});\r\nfunction tumunu_gizle() {\r\n    \$(\".kurumsal\").slideUp(500);\r\n}\r\n</script>\t\r\n";
    mesaj("musteri_guncelle", 1, "yes", "Başarı ile guncellenmiştir.");
    mesaj("musteri_guncelle", 2, "no", "Hata oluştu tekrar deneyiniz.!");
    mesaj("resimsil", 1, "yes", "Başarı ile silinmiştir.");
    mesaj("resimsil", 2, "no", "Hata oluştu tekrar deneyiniz.!");
    mesaj("secim", 3, "secimyok", "Hiç bir şey seçmediniz. Lütfen işlem yapmak istediğiniz eylemi ve ID leri seçin.");
    echo "\t\r\n";
    
} else {
    exit;
}

?>