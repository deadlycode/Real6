<?php


if (isset($_GET["sayfa"])) {
    $s = $_GET["sayfa"];
    switch ($s) {
        case "" . $htc["anaurl"] . "":
            $title = baslik;
            $description = site_desc;
            $keywords = site_keyw;
            $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            break;
        case "" . $htc["sayfaurl"] . "":
            $TITLESorgu = $db->prepare("SELECT * FROM sayfalar WHERE seo = ? ORDER BY id ASC");
            $TITLESorgu->execute([$_GET["id"]]);
            $TITLESonuc = $TITLESorgu->fetch(PDO::FETCH_ASSOC);
            $title = "" . ilkbuyuk($TITLESonuc["adi"]) . "";
            $keywords = "" . $TITLESonuc["keywords"] . "";
            $description = "" . $TITLESonuc["description"] . "";
            if ($TITLESonuc["resim"] != "") {
                $paylasim = "" . tema . "/uploads/sayfalar/" . $TITLESonuc["resim"] . "";
            } else {
                $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            }
            break;
        case "" . $htc["emlakkategoriurl"] . "":
            $TITLESorgu = $db->prepare("SELECT * FROM emlak_kategori WHERE seo = ? ORDER BY sira ASC");
            $TITLESorgu->execute([$_GET["id"]]);
            if ($TITLESorgu->rowCount()) {
                $TITLESonuc = $TITLESorgu->fetch(PDO::FETCH_ASSOC);
                $title = "" . ilkbuyuk($TITLESonuc["adi"]) . "";
                $keywords = "" . $TITLESonuc["keywords"] . "";
                $description = "" . $TITLESonuc["description"] . "";
                if ($TITLESonuc["kapak"] != "") {
                    $paylasim = "" . tema . "/uploads/kategoriler/kapak/" . $TITLESonuc["kapak"] . "";
                } else {
                    $paylasim = "" . tema . "/uploads/logo/" . logo . "";
                }
            } else {
                $title = $dil["yaz269"];
                $description = site_desc;
                $keywords = site_keyw;
                $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            }
            break;
        case "" . $htc["ilandetayurl"] . "":
            $TITLESorgu = $db->prepare("SELECT * FROM emlaklar WHERE seo = ? ORDER BY sira ASC");
            $TITLESorgu->execute([$_GET["id"]]);
            $TITLESonuc = $TITLESorgu->fetch(PDO::FETCH_ASSOC);
            $title = "" . ilkbuyuk($TITLESonuc["adi"]) . "";
            $keywords = "" . $TITLESonuc["keywords"] . "";
            $description = "" . $TITLESonuc["description"] . "";
            if ($TITLESonuc["kapak"] != "") {
                $paylasim = "" . tema . "/uploads/urunler/" . $TITLESonuc["kapak"] . "";
            } else {
                $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            }
            break;
        case "" . $htc["projekategoriurl"] . "":
            $TITLESorgu = $db->prepare("SELECT * FROM proje_kategori WHERE seo = ? ORDER BY sira ASC");
            $TITLESorgu->execute([$_GET["id"]]);
            $TITLESonuc = $TITLESorgu->fetch(PDO::FETCH_ASSOC);
            $title = "" . ilkbuyuk($TITLESonuc["adi"]) . "";
            $keywords = "" . $TITLESonuc["keywords"] . "";
            $description = "" . $TITLESonuc["description"] . "";
            if ($TITLESonuc["kapak"] != "") {
                $paylasim = "" . tema . "/uploads/proje_kategoriler/kapak/" . $TITLESonuc["kapak"] . "";
            } else {
                $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            }
            break;
        case "" . $htc["projelerurl"] . "":
            $title = $dil["yaz270"];
            $description = site_desc;
            $keywords = site_keyw;
            $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            break;
        case "" . $htc["projedetayurl"] . "":
            $TITLESorgu = $db->prepare("SELECT * FROM projeler WHERE seo = ? ORDER BY sira ASC");
            $TITLESorgu->execute([$_GET["id"]]);
            $TITLESonuc = $TITLESorgu->fetch(PDO::FETCH_ASSOC);
            $title = "" . ilkbuyuk($TITLESonuc["adi"]) . "";
            $keywords = "" . $TITLESonuc["keywords"] . "";
            $description = "" . $TITLESonuc["description"] . "";
            if ($TITLESonuc["kapak"] != "") {
                $paylasim = "" . tema . "/uploads/projeler/" . $TITLESonuc["kapak"] . "";
            } else {
                $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            }
            break;
        case "" . $htc["ekiburl"] . "":
            $title = $dil["yaz270"];
            $description = site_desc;
            $keywords = site_keyw;
            $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            break;
        case "" . $htc["ekibdetayurl"] . "":
            $TITLESorgu = $db->prepare("SELECT * FROM ekibimiz WHERE seo = ? ORDER BY sira ASC");
            $TITLESorgu->execute([$_GET["id"]]);
            $TITLESonuc = $TITLESorgu->fetch(PDO::FETCH_ASSOC);
            $title = "" . ilkbuyuk($TITLESonuc["adi"]) . "";
            $keywords = "" . $TITLESonuc["keywords"] . "";
            $description = "" . $TITLESonuc["description"] . "";
            if ($TITLESonuc["resim"] != "") {
                $paylasim = "" . tema . "/uploads/ekibimiz/" . $TITLESonuc["resim"] . "";
            } else {
                $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            }
            break;
        case "" . $htc["haberurl"] . "":
            $title = $dil["yaz271"];
            $description = site_desc;
            $keywords = site_keyw;
            $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            break;
        case "" . $htc["haberdetayurl"] . "":
            $TITLESorgu = $db->prepare("SELECT * FROM haberler WHERE seo = ? ORDER BY sira ASC");
            $TITLESorgu->execute([$_GET["id"]]);
            $TITLESonuc = $TITLESorgu->fetch(PDO::FETCH_ASSOC);
            $title = "" . ilkbuyuk($TITLESonuc["adi"]) . "";
            $keywords = "" . $TITLESonuc["keywords"] . "";
            $description = "" . $TITLESonuc["description"] . "";
            if ($TITLESonuc["resim"] != "") {
                $paylasim = "" . tema . "/uploads/haberler/" . $TITLESonuc["resim"] . "";
            } else {
                $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            }
            break;
        case "" . $htc["hizmeturl"] . "":
            $title = $dil["yaz272"];
            $description = site_desc;
            $keywords = site_keyw;
            $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            break;
        case "" . $htc["hizmetdetayurl"] . "":
            $TITLESorgu = $db->prepare("SELECT * FROM hizmetler WHERE seo = ? ORDER BY sira ASC");
            $TITLESorgu->execute([$_GET["id"]]);
            $TITLESonuc = $TITLESorgu->fetch(PDO::FETCH_ASSOC);
            $title = "" . ilkbuyuk($TITLESonuc["adi"]) . "";
            $keywords = "" . $TITLESonuc["keywords"] . "";
            $description = "" . $TITLESonuc["description"] . "";
            if ($TITLESonuc["resim"] != "") {
                $paylasim = "" . tema . "/uploads/hizmetler/" . $TITLESonuc["resim"] . "";
            } else {
                $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            }
            break;
        case "" . $htc["refurl"] . "":
            $title = $dil["yaz273"];
            $description = site_desc;
            $keywords = site_keyw;
            $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            break;
        case "" . $htc["refdetayurl"] . "":
            $TITLESorgu = $db->prepare("SELECT * FROM referanslar WHERE seo = ? ORDER BY sira ASC");
            $TITLESorgu->execute([$_GET["id"]]);
            $TITLESonuc = $TITLESorgu->fetch(PDO::FETCH_ASSOC);
            $title = "" . ilkbuyuk($TITLESonuc["adi"]) . "";
            $keywords = "" . $TITLESonuc["keywords"] . "";
            $description = "" . $TITLESonuc["description"] . "";
            if ($TITLESonuc["resim"] != "") {
                $paylasim = "" . tema . "/uploads/referanslar/" . $TITLESonuc["resim"] . "";
            } else {
                $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            }
            break;
        case "" . $htc["belgeurl"] . "":
            $title = $dil["yaz274"];
            $description = site_desc;
            $keywords = site_keyw;
            $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            break;
        case "" . $htc["katalogurl"] . "":
            $title = $dil["yaz275"];
            $description = site_desc;
            $keywords = site_keyw;
            $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            break;
        case "" . $htc["musteriurl"] . "":
            $title = $dil["yaz276"];
            $description = site_desc;
            $keywords = site_keyw;
            $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            break;
        case "" . $htc["sssurl"] . "":
            $title = $dil["yaz277"];
            $description = site_desc;
            $keywords = site_keyw;
            $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            break;
        case "" . $htc["iletisimurl"] . "":
            $title = $dil["yaz279"];
            $description = site_desc;
            $keywords = site_keyw;
            $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            break;
        case "" . $htc["ikurl"] . "":
            $title = $dil["yaz280"];
            $description = site_desc;
            $keywords = site_keyw;
            $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            break;
        case "" . $htc["bankahesapurl"] . "":
            $title = $dil["yaz281"];
            $description = site_desc;
            $keywords = site_keyw;
            $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            break;
        case "" . $htc["hesapolustururl"] . "":
            $title = $dil["yaz285"];
            $description = site_desc;
            $keywords = site_keyw;
            $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            break;
        case "" . $htc["girisyapurl"] . "":
            $title = $dil["yaz284"];
            $description = site_desc;
            $keywords = site_keyw;
            $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            break;
        case "" . $htc["hesabimurl"] . "":
            $title = $dil["yaz283"];
            $description = site_desc;
            $keywords = site_keyw;
            $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            break;
        case "404":
            $title = $dil["yaz282"];
            $description = site_desc;
            $keywords = site_keyw;
            $paylasim = "" . tema . "/uploads/logo/" . logo . "";
            $s404 = "s404_footer";
            break;
        default:
            $title = baslik;
            $description = site_desc;
            $keywords = site_keyw;
            $paylasim = "" . tema . "/uploads/logo/" . logo . "";
    }
} else {
    $title = baslik;
    $description = site_desc;
    $keywords = site_keyw;
    $paylasim = "" . tema . "/uploads/logo/" . logo . "";
}


?>