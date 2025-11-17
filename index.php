<?php


require_once "_class/baglan.php";
require_once "_class/fonksiyon.php";
require_once "_class/class.upload.php";
if (!file_exists("language/dil_" . $_SESSION["k_dil"] . ".php")) {
    exit("Mevcut dilin dosyası bulunamadı!");
}
require_once "language/dil_" . $_SESSION["k_dil"] . ".php";
require_once "_class/seo.php";
$kbul = $db->query("SELECT * FROM kullanici WHERE durum = '1' ORDER BY id ASC LIMIT 1")->fetch();
if (durum == 0) {
    require tema . "/index.php";
} else {
    if ($_SESSION["Yonetim_Id"] == $kbul["id"]) {
        require tema . "/index.php";
    } else {
        require tema . "/bakimda.php";
    }
}
if ($htc["durum"] != 0) {
    $sorgu = $db->prepare("UPDATE sabit_url SET\r\n\t\t\tdurum\t= ?\r\n\t\t\tWHERE id = ?");
    $guncelle = $sorgu->execute([0, 1]);
    $db = NULL;
    $dt = fopen(".htaccess", "r+");
    fwrite($dt, "RewriteEngine on\r\nErrorDocument 404 /404.html");
    fwrite($dt, "\r\nRewriteRule ^([a-zA-Z0-9\\-_]+).html\$ index.php?sayfa=\$1 [L,QSA]\r\nRewriteRule ^([a-zA-Z0-9\\-_]+)(/?)\$ index.php?sayfa=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["sayfaurl"] . "/(.*).html\$ index.php?sayfa=" . $htc["sayfaurl"] . "&id=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["sayfaurl"] . "/(.*?)\$ index.php?sayfa=" . $htc["sayfaurl"] . "&id=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["ekibdetayurl"] . "/(.*).html\$ index.php?sayfa=" . $htc["ekibdetayurl"] . "&id=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["ekibdetayurl"] . "/(.*?)\$ index.php?sayfa=" . $htc["ekibdetayurl"] . "&id=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["haberdetayurl"] . "/(.*).html\$ index.php?sayfa=" . $htc["haberdetayurl"] . "&id=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["haberdetayurl"] . "/(.*?)\$ index.php?sayfa=" . $htc["haberdetayurl"] . "&id=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["refdetayurl"] . "/(.*).html\$ index.php?sayfa=" . $htc["refdetayurl"] . "&id=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["refdetayurl"] . "/(.*?)\$ index.php?sayfa=" . $htc["refdetayurl"] . "&id=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["refurl"] . "/(.*).html\$ index.php?sayfa=" . $htc["refurl"] . "&s=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["refurl"] . "/(.*?)\$ index.php?sayfa=" . $htc["refurl"] . "&s=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["belgeurl"] . "/(.*).html\$ index.php?sayfa=" . $htc["belgeurl"] . "&s=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["belgeurl"] . "/(.*?)\$ index.php?sayfa=" . $htc["belgeurl"] . "&s=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["katalogurl"] . "/(.*).html\$ index.php?sayfa=" . $htc["katalogurl"] . "&s=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["katalogurl"] . "/(.*?)\$ index.php?sayfa=" . $htc["katalogurl"] . "&s=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["ekiburl"] . "/(.*).html\$ index.php?sayfa=" . $htc["ekiburl"] . "&s=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["ekiburl"] . "/(.*?)\$ index.php?sayfa=" . $htc["ekiburl"] . "&s=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["hizmeturl"] . "/(.*).html\$ index.php?sayfa=" . $htc["hizmeturl"] . "&s=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["hizmeturl"] . "/(.*?)\$ index.php?sayfa=" . $htc["hizmeturl"] . "&s=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["hizmetdetayurl"] . "/(.*).html\$ index.php?sayfa=" . $htc["hizmetdetayurl"] . "&id=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["hizmetdetayurl"] . "/(.*?)\$ index.php?sayfa=" . $htc["hizmetdetayurl"] . "&id=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["musteriurl"] . "/(.*).html\$ index.php?sayfa=" . $htc["musteriurl"] . "&s=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["musteriurl"] . "/(.*?)\$ index.php?sayfa=" . $htc["musteriurl"] . "&s=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["haberurl"] . "/(.*).html\$ index.php?sayfa=" . $htc["haberurl"] . "&s=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["haberurl"] . "/(.*?)\$ index.php?sayfa=" . $htc["haberurl"] . "&s=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["ilandetayurl"] . "/(.*).html\$ index.php?sayfa=" . $htc["ilandetayurl"] . "&id=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["ilandetayurl"] . "/(.*?)\$ index.php?sayfa=" . $htc["ilandetayurl"] . "&id=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["ilanlarurl"] . "/(.*).html\$ index.php?sayfa=" . $htc["ilanlarurl"] . "&s=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["ilanlarurl"] . "/(.*?)\$ index.php?sayfa=" . $htc["ilanlarurl"] . "&s=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["emlakkategoriurl"] . "/(.*).html\$ index.php?sayfa=" . $htc["emlakkategoriurl"] . "&id=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["emlakkategoriurl"] . "/(.*?)\$ index.php?sayfa=" . $htc["emlakkategoriurl"] . "&id=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["emlakkategoriurl"] . "-(.*)/(.*).html\$ index.php?sayfa=" . $htc["emlakkategoriurl"] . "&id=\$1&s=\$2 [L,QSA]\r\nRewriteRule ^" . $htc["emlakkategoriurl"] . "-(.*?)/(.*?)\$ index.php?sayfa=" . $htc["emlakkategoriurl"] . "&id=\$1&s=\$2 [L,QSA]\r\nRewriteRule ^" . $htc["projedetayurl"] . "/(.*).html\$ index.php?sayfa=" . $htc["projedetayurl"] . "&id=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["projedetayurl"] . "/(.*?)\$ index.php?sayfa=" . $htc["projedetayurl"] . "&id=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["projekategoriurl"] . "/(.*).html\$ index.php?sayfa=" . $htc["projekategoriurl"] . "&id=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["projekategoriurl"] . "/(.*?)\$ index.php?sayfa=" . $htc["projekategoriurl"] . "&id=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["projekategoriurl"] . "-(.*)/(.*).html\$ index.php?sayfa=" . $htc["projekategoriurl"] . "&id=\$1&s=\$2 [L,QSA]\r\nRewriteRule ^" . $htc["projekategoriurl"] . "-(.*?)/(.*?)\$ index.php?sayfa=" . $htc["projekategoriurl"] . "&id=\$1&s=\$2 [L,QSA]\r\nRewriteRule ^" . $htc["projelerurl"] . "/(.*).html\$ index.php?sayfa=" . $htc["projelerurl"] . "&s=\$1 [L,QSA]\r\nRewriteRule ^" . $htc["projelerurl"] . "/(.*?)\$ index.php?sayfa=" . $htc["projelerurl"] . "&s=\$1 [L,QSA]\r\nRewriteRule ^sitemap.xml\$ sitemap.php [NC,L]\r\n");
    fclose($dt);
}
echo "\r\n";

?>