<?php


echo !defined("GUVENLIK") ? exit : NULL;
oturumkontrol($url);
$bugun = date("d");
$ay = date("m");
$yil = date("Y");
$onlineSuresi = time() - 60;
$ip = ip();
$online = $db->query("SELECT * FROM hit WHERE simdi > '" . $onlineSuresi . "'")->rowCount();
$bugunx = $db->query("SELECT SUM(sayac) FROM hit WHERE gun='" . $bugun . "' AND ay='" . $ay . "' AND yil='" . $yil . "' ORDER BY id DESC")->fetch();
$bugun_cogul = $bugunx["SUM(sayac)"];
$dunx = $db->query("SELECT SUM(sayac) FROM hit WHERE gun='" . ($bugun - 1) . "' AND ay='" . $ay . "' AND yil='" . $yil . "' ORDER BY id DESC")->fetch();
$dun_cogul = $dunx["SUM(sayac)"];
$ayx = $db->query("SELECT SUM(sayac) FROM hit WHERE ay='" . $ay . "' AND yil='" . $yil . "' ORDER BY id DESC")->fetch();
$buay_cogul = $ayx["SUM(sayac)"];
$toplamx = $db->query("SELECT SUM(sayac) FROM hit ORDER BY id DESC")->fetch();
$toplam_cogul = $toplamx["SUM(sayac)"];
$bugun_tekil = $db->query("SELECT * FROM hit WHERE gun='" . $bugun . "' AND ay='" . $ay . "' AND yil='" . $yil . "'")->rowCount();
$dun_tekil = $db->query("SELECT * FROM hit WHERE gun='" . ($bugun - 1) . "' AND ay='" . $ay . "' AND yil='" . $yil . "'")->rowCount();
$buay_tekil = $db->query("SELECT * FROM hit WHERE  ay='" . $ay . "' AND yil='" . $yil . "'")->rowCount();
$toplam_tekil = $db->query("SELECT * FROM hit")->rowCount();
echo " \r\n<div class=\"page-header\">\r\n\t<div class=\"page-title mt-0 mb-0\">\r\n\t\t<h3>Yönetim Paneli</h3>\r\n\t\t<div class=\"crumbs\">\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\n\t\t\t\t<li><a href=\"index.html\"><i class=\"icon-home menu-icon\"></i></a></li>\r\n\t\t\t\t<li class=\"active\"><a href=\"";
echo $sayfalink;
echo "\">Yönetim Paneli</a></li>\r\n\t\t\t</ul>\r\n\t\t</div>\r\n\t</div>\r\n\t<div class=\"col col-auto mt-5 d-inline-block float-right\">\r\n\t\t<a class=\"float-right text-white popconfirm badge badge-danger ml-1\" title=\"Sıfırla\" href=\"../_class/yonetim_islem.php?sifirla=ok\"><big>Sıfırla</big></a> \r\n\t\t<label class=\"badge badge-secondary m-t-10\">Toplam Tekil : <big><b>";
echo $toplam_tekil;
echo "</b></big></label> \r\n\t\t<label class=\"badge badge-dark m-t-10\">Toplam Gösterim : <big><b>";
echo $toplam_cogul;
echo "</b></big></label>\r\n\t</div>\r\n</div>\r\n<div class=\"row\">\r\n\t<div class=\"col-lg-12\">\t\r\n\t\t<div class=\"accordion accordion-multi-colored\" id=\"accordion-1\" role=\"tablist\">\r\n\t\t\t<div class=\"card\">\r\n\t\t\t\t<div class=\"card-header p-3\" role=\"tab\" id=\"heading-1\">\r\n\t\t\t\t\t<h6 class=\"mb-0\">\r\n\t\t\t\t\t\t<a class=\"\" data-toggle=\"collapse\" href=\"#collapse-1\" aria-expanded=\"true\" aria-controls=\"collapse-1\">\r\n\t\t\t\t\t\t\t\"Yönetim Paneli\" hakkında yardımcı açıklamalar...\r\n\t\t\t\t\t\t</a>\r\n\t\t\t\t\t</h6>\r\n\t\t\t\t</div>\r\n\t\t\t\t<div id=\"collapse-1\" class=\"collapse\" role=\"tabpanel\" aria-labelledby=\"heading-1\" data-parent=\"#accordion-1\" style=\"\">\r\n\t\t\t\t\t<div class=\"card-body p-3\">\r\n\t\t\t\t\t\t<p>- Yönetim paneli giriş yolunu <b>Site Yönetimi / Genel Ayarlar -> Yönetim Paneli Girişi Link Adresi</b> alanından  değişirebilirsiniz.<br> Yönetim paneli yolunu değiştirmeniz site güvenliği açısından önemlidir.</p>\r\n\t\t\t\t\t\t<p>- Şifre Olarak: <b>123,1234, 123456, 1, admin, user, demo</b> gibi basit düzeyde şifreleri sistem kabul etmemektedir. Şifreniz bu şifrelerden herhangi birisine sahipse panelde hiç bir işlem yapamazsınız.!</p>\r\n\t\t\t\t\t\t<p>- <b>Not:</b> Yönetim panel giriş linkini Site Yönetimi -> Genel Ayarlar kısmından değiştiriniz.!</p>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n<div class=\"row\">\r\n    <div class=\"col-12\">\r\n        <div class=\"row\">\r\n            <div class=\"col-12 col-sm-6 col-md-3 grid-margin stretch-card\">\r\n                <div class=\"card\">\r\n                    <div class=\"card-body\">\r\n                        <h4 class=\"card-title\">Online<span class=\"float-right text-success\">";
echo $online;
echo " Kişi</span></h4>\r\n                        <div class=\"d-flex justify-content-between\">\r\n                            <p class=\"text-muted\">Tekil Ziyaretçi</p>\r\n                            <p class=\"text-muted\">";
echo $online;
echo "</p>\r\n                        </div>\r\n                        <div class=\"progress progress-md\">\r\n                            <div class=\"progress-bar bg-success\" style=\"width:";
echo $online;
echo "%;\" role=\"progressbar\" aria-valuenow=\"";
echo $online;
echo "\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div class=\"col-12 col-sm-6 col-md-3 grid-margin stretch-card\">\r\n                <div class=\"card\">\r\n                    <div class=\"card-body\">\r\n                        <h4 class=\"card-title\">Bugün<span class=\"float-right text-info\">";
echo $bugun_tekil;
echo " Kişi</span></h4>\r\n                        <div class=\"d-flex justify-content-between\">\r\n                            <p class=\"text-muted\">Gösterim</p>\r\n                            <p class=\"text-muted\">";
echo intval($bugun_cogul);
echo "</p>\r\n                        </div>\r\n                        <div class=\"progress progress-md\">\r\n                            <div class=\"progress-bar bg-info\" style=\"width:";
echo intval($bugun_cogul);
echo "%;\" role=\"progressbar\" aria-valuenow=\"";
echo intval($bugun_cogul);
echo "\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div class=\"col-12 col-sm-6 col-md-3 grid-margin stretch-card\">\r\n                <div class=\"card\">\r\n                    <div class=\"card-body\">\r\n                        <h4 class=\"card-title\">Dün<span class=\"float-right text-danger\">";
echo $dun_tekil;
echo " Kişi</span></h4>\r\n                        <div class=\"d-flex justify-content-between\">\r\n                            <p class=\"text-muted\">Gösterim</p>\r\n                            <p class=\"text-muted\">";
echo intval($dun_cogul);
echo "</p>\r\n                        </div>\r\n                        <div class=\"progress progress-md\">\r\n                            <div class=\"progress-bar bg-danger\" style=\"width:";
echo intval($dun_cogul);
echo "%;\" role=\"progressbar\" aria-valuenow=\"";
echo intval($dun_cogul);
echo "\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div class=\"col-12 col-sm-6 col-md-3 grid-margin stretch-card\">\r\n                <div class=\"card\">\r\n                    <div class=\"card-body\">\r\n                        <h4 class=\"card-title\">Bu Ay<span class=\"float-right text-warning\">";
echo $buay_tekil;
echo " Kişi</span></h4>\r\n                        <div class=\"d-flex justify-content-between\">\r\n                            <p class=\"text-muted\">Gösterim</p>\r\n                            <p class=\"text-muted\">";
echo intval($buay_cogul);
echo "</p>\r\n                        </div>\r\n                        <div class=\"progress progress-md\">\r\n                            <div class=\"progress-bar bg-warning\" style=\"width:";
echo intval($buay_cogul);
echo "%;\" role=\"progressbar\" aria-valuenow=\"";
echo intval($buay_cogul);
echo "\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n<div class=\"row mb-4\">\r\n\r\n\t<div class=\"col-md-7 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card\">\r\n\t\t<div class=\"card\">\r\n\t\t\t<div class=\"card-body p-3\">\r\n\t\t\t\t<h4 class=\"card-title anatitle\">BUGÜN SON İŞLEMLER <a style=\"margin-top: -5px;\" class=\"float-right text-white popconfirm badge badge-danger\" title=\"Tüm Bildirimi Sil\" href=\"../_class/yonetim_islem.php?bildirimtumunusil=ok\">Tümünü Sil</a></h4>\t\t\t\t\r\n\t\t\t\t<div class=\"scroll\">\r\n\t\t\t\t<div class=\"table-responsive\">\r\n\t\t\t\t\t<div class=\"d-flex flex-column\">\r\n\t\t\t\t\t";
$biltarih = tr_tarih("Y-m-d");
$bilbuguntarih = strtotime($biltarih);
$BILDIRIMSorgu = $db->prepare("SELECT * FROM bildirimler WHERE ktarih = ? ORDER BY id DESC");
$BILDIRIMSorgu->execute([$bilbuguntarih]);
$BILDIRIMislem = $BILDIRIMSorgu->fetchALL(PDO::FETCH_ASSOC);
echo "\t\t\t\t\t\t";
if ($BILDIRIMSorgu->rowCount() != "0") {
    echo "\t\t\t\t\t\t";
    foreach ($BILDIRIMislem as $BILDIRIMSonuc) {
        echo "\t\t\t\t\t\t<div class=\"d-flex mb-1\" style=\"border-bottom: 1px solid #f2f6f9;\">\r\n\t\t\t\t\t\t\t<div class=\"d-flex align-items-center justify-content-center mr-2\">\r\n\t\t\t\t\t\t\t\t<i class=\"";
        echo $BILDIRIMSonuc["icon"];
        echo " social-icon-outline\"></i>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t<div class=\"d-flex flex-column ml-1\">\r\n\t\t\t\t\t\t\t\t<h6 class=\"font-weight-normal mt-2 islem_baslik\">";
        echo $BILDIRIMSonuc["bildirim"];
        echo "</h6>\r\n\t\t\t\t\t\t\t\t<p class=\"text-muted islem_tarih\">";
        echo tarihcevir($BILDIRIMSonuc["tarih"]);
        echo "</p>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t<div class=\"d-flex align-items-center justify-content-center ml-auto\">\r\n\t\t\t\t\t\t\t\t<a href=\"../_class/yonetim_islem.php?bildirimsil=ok&id=";
        echo $BILDIRIMSonuc["id"];
        echo "\" class=\"popconfirm\" title=\"Bildirim Sil\"><i class=\"mdi mdi-trash-can-outline text-black mr-2 icon-hover-red\"></i></a>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t";
    }
    echo "\t\t\t\t\t\t";
} else {
    echo "\t\r\n\t\t\t\t\t\t\t<div class=\"alert alert-secondary\" role=\"alert\">\r\n\t\t\t\t\t\t\tGösterilecek kayıt bulunamadı.\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t";
}
echo "\t\t\t\t\t</div>\r\n\r\n\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n\t\r\n\t<div class=\"col-md-5 stretch-card\">\r\n\t\t<div class=\"card\">\r\n\t\t\t<div class=\"card-body p-3\">\r\n\t\t\t\t<h4 class=\"card-title anatitle\"> YAKLAŞAN İŞLER</h4>\r\n\t\t\t\t<div class=\"scroll\">\r\n\t\t\t\t";
$bugun = date("Y-m-d H:i:s");
$cevir = strtotime("-1 day", strtotime($bugun));
$besgun = strtotime("+5 day", strtotime($bugun));
$nottarih = date("Y-m-d H:i:s", $cevir);
$besguntrh = date("Y-m-d H:i:s", $besgun);
$Sorgu = $db->prepare("SELECT * FROM not_defteri WHERE (date(baslangic) > ?) AND (date(baslangic) < ?) ORDER BY (date(baslangic)) ASC");
$Sorgu->execute([$nottarih, $besguntrh]);
$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);
echo "\t\t\t\t";
if ($Sorgu->rowCount() != "0") {
    echo "\t\t\t\t<ul class=\"icon-line-list\">\t\t\t\t\r\n\t\t\t\t\t";
    foreach ($islem as $Sonuc) {
        echo "\t\t\t\t\t<style>\r\n\t\t\t\t\t.icon-line-list li#renk";
        echo $Sonuc["id"];
        echo "::before {\r\n\t\t\t\t\t  background: ";
        echo $Sonuc["renk"];
        echo ";\r\n\t\t\t\t\t}\r\n\t\t\t\t\t</style>\r\n\t\t\t\t\t<li id=\"renk";
        echo $Sonuc["id"];
        echo "\">\r\n\t\t\t\t\t\t<p class=\"text-muted pt-2 pl-1\">";
        echo tarih_panel($Sonuc["baslangic"]);
        echo "</p>\r\n\t\t\t\t\t\t<h6 class=\"font-weight-normal mt-0 mb-1 pl-1\">";
        echo $Sonuc["baslik"];
        echo "</h6>\r\n\t\t\t\t\t\t<p class=\"text-muted mb-4 mt-0 pl-1\">";
        echo $Sonuc["ekleyen"];
        echo "</p>\r\n\t\t\t\t\t</li>\r\n\t\t\t\t\t";
    }
    echo "\t\t\t\t\r\n\t\t\t\t</ul>\r\n\t\t\t\t";
} else {
    echo "\t\r\n\t\t\t\t\t<div class=\"alert alert-secondary\" role=\"alert\">\r\n                    Gösterilecek kayıt bulunamadı.\r\n                    </div>\r\n\t\t\t\t";
}
echo "\t\t\t\t</div>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n\r\n<div class=\"row\">\r\n\t<div class=\"col-md-12 grid-margin grid-margin-lg-0 grid-margin-md-0 stretch-card\">\r\n\t\t<div class=\"card\">\r\n\t\t\t<div class=\"card-body p-3\">\r\n\t\t\t\t<h4 class=\"card-title anatitle\">GÜNCELLEMELER</h4>\r\n\t\t\t\t<div class=\"scroll\">\r\n\t\t\t\t<div class=\"table-responsive\">\r\n\t\t\t\t\t<div class=\"d-flex flex-column\">\r\n\t\t\t\t\t\t<iframe width=\"100%\" height=\"500\" src=\"https://www.web-ofisi.com/guncelleme/emlakv4/guncelleme.html\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n<!-- main-panel ends -->\r\n";
mesaj("bildirimsil", 1, "yes", "Başarı ile silinmiştir.");
mesaj("bildirimsil", 2, "no", "Hata oluştu tekrar deneyiniz.!");
mesaj("bildirimtumunusil", 1, "yes", "Başarı ile silinmiştir.");
mesaj("bildirimtumunusil", 2, "no", "Hata oluştu tekrar deneyiniz.!");

?>