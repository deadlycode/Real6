<?php


require_once "baglan.php";
require_once "fonksiyon.php";
require_once "class.upload.php";
require_once "class.phpmailer.php";
$logo = url . tema . "/uploads/logo/" . logo;
$domain_bilgi = url;
$bildirimkt = strtotime(tr_tarih("Y-m-d"));
$bildirimt = strtotime(tr_tarih("Y-m-d H:i:s"));
if ($moduller["alan20"] == "1") {
    $html = ".html";
} else {
    $html = "";
}
if (empty($_POST) && empty($_GET)) {
    header("Location:../" . yonetim . "/index" . $html . "");
    exit;
}
if (isset($_POST["emlak_ekle"])) {
    panelislemkontrol();
    if ($_SESSION["rutbe"] == 0) {
        $brut = $_POST["brut"];
        $net = $_POST["net"];
        $oda = $_POST["oda"];
        $video = $_POST["video"];
        $katsayisi = $_POST["katsayisi"];
        $bulundugukat = $_POST["bulundugukat"];
        $bina = $_POST["bina"];
        $isitma = $_POST["isitma"];
        $banyo = $_POST["banyo"];
        $balkon = $_POST["balkon"];
        $esya = $_POST["esya"];
        $kdrumu = $_POST["kdrumu"];
        $takas = $_POST["takas"];
        $krediu = $_POST["krediu"];
        $garama = $_POST["garama"];
        $imardurumu = $_POST["imardurumu"];
        $adano = $_POST["adano"];
        $parselno = $_POST["parselno"];
        $paftano = $_POST["paftano"];
        $kaks = $_POST["kaks"];
        $gabari = $_POST["gabari"];
        $tapudurumu = $_POST["tapudurumu"];
        $katkarsiligi = $_POST["katkarsiligi"];
        $aidat = $_POST["aidat"];
        $depozito = $_POST["depozito"];
        $pbirim = $_POST["pbirim"];
        $il = $_POST["il"];
        $ilce = $_POST["ilce"];
        $semt = $_POST["semt"];
        $latfield = $_POST["latfield"];
        $lngfield = $_POST["lngfield"];
        $zoom = $_POST["zoom"];
        $kategori = $_POST["kategori"];
        $danisman = $_POST["danisman"];
        $adi = $_POST["adi"];
        $emlak_kodu = $_POST["emlak_kodu"];
        $fiyat = $_POST["fiyat"];
        $emlakidbul = $db->query("SELECT * FROM emlaklar ORDER BY id desc LIMIT 1")->fetch();
        $idtopla = $emlakidbul["id"] + 1;
        $seo = seo($adi . "-" . $idtopla);
        $aciklama = $_POST["aciklama"];
        $description = $_POST["description"];
        $keywords = $_POST["keywords"];
        if ($_POST["durum"]) {
            $durum = 1;
        } else {
            $durum = 0;
        }
        if ($_POST["uye"]) {
            $uye = 1;
        } else {
            $uye = 0;
        }
        if ($_POST["anasayfa"]) {
            $anasayfa = 1;
        } else {
            $anasayfa = 0;
        }
        $tarih = date("Y-m-d H:i:s");
        $tarih = tr_tarih($tarih);
        $ozellikler = NULL;
        foreach ($_POST["ozellik"] as $k => $v) {
            $ozellik = explode("-", $v);
            if (isset($ozellikler[$ozellik[0]])) {
                $ozellikler[$ozellik[0]] .= "|" . $ozellik[1];
            } else {
                $ozellikler[$ozellik[0]] = $ozellik[1];
            }
        }
        if (is_array($ozellikler)) {
            $_ozellikler = NULL;
            foreach ($ozellikler as $k => $v) {
                if (is_null($_ozellikler)) {
                    $_ozellikler = $k . "-" . $v;
                } else {
                    $_ozellikler .= "," . $k . "-" . $v;
                }
            }
            $ozellikler = $_ozellikler;
        }
        $upload = new upload($_FILES["resim"]);
        if ($upload->uploaded) {
            $upload->file_auto_rename = true;
            $upload->image_watermark = "../" . tema . "/uploads/watermark/" . $ayar["watermark"] . "";
            $upload->image_watermark_no_zoom_out = true;
            $upload->process("../" . tema . "/uploads/emlaklar");
            $upload->file_auto_rename = true;
            $upload->image_resize = true;
            $upload->image_ratio_crop = true;
            $upload->image_watermark = "../" . tema . "/uploads/watermark/" . $ayar["watermark"] . "";
            $upload->image_watermark_no_zoom_out = true;
            $upload->image_x = 560;
            $upload->image_y = 320;
            $upload->process("../" . tema . "/uploads/emlaklar/kapak");
            if ($upload->processed) {
                $Kapak = "" . $upload->file_dst_name . "";
            }
        }
        $upload3 = new upload($_FILES["katalog"]);
        if ($upload3->uploaded) {
            $upload3->file_auto_rename = true;
            $upload3->process("../" . tema . "/uploads/emlaklar/katalog");
            if ($upload3->processed) {
                $Katalog = "" . $upload3->file_dst_name . "";
            }
        }
        $files = [];
        foreach ($_FILES["resimler"] as $k => $l) {
            foreach ($l as $i => $v) {
                if (!array_key_exists($i, $files)) {
                    $files[$i] = [];
                }
                $files[$i][$k] = $v;
            }
        }
        $Kapak = "" . $upload->file_dst_name . "";
        $Dokuman = "" . $upload2->file_dst_name . "";
        $Katalog = "" . $upload3->file_dst_name . "";
        $sorgu = $db->prepare("INSERT INTO emlaklar SET\t\t\t\r\n\t\t\t\tbrut \t= ?,\t\t\t\t\r\n\t\t\t\tuye \t= ?,\r\n\t\t\t\tnet \t= ?,\r\n\t\t\t\toda \t= ?,\r\n\t\t\t\tvideo \t= ?,\r\n\t\t\t\tkatsayisi \t= ?,\r\n\t\t\t\tbulundugukat \t= ?,\r\n\t\t\t\tbina \t= ?,\r\n\t\t\t\tisitma \t= ?,\r\n\t\t\t\tbanyo \t= ?,\r\n\t\t\t\tbalkon \t= ?,\r\n\t\t\t\tesya \t= ?,\r\n\t\t\t\tkdrumu \t= ?,\r\n\t\t\t\ttakas \t= ?,\r\n\t\t\t\tkrediu \t= ?,\r\n\t\t\t\tgarama \t= ?,\r\n\t\t\t\timardurumu \t= ?,\r\n\t\t\t\tadano \t= ?,\r\n\t\t\t\tparselno = ?,\r\n\t\t\t\tpaftano = ?,\r\n\t\t\t\tkaks \t= ?,\r\n\t\t\t\tgabari \t= ?,\r\n\t\t\t\ttapudurumu \t= ?,\r\n\t\t\t\tkatkarsiligi \t= ?,\r\n\t\t\t\taidat \t= ?,\r\n\t\t\t\tdepozito = ?,\r\n\t\t\t\tpbirim \t= ?,\r\n\t\t\t\til \t\t\t= ?,\r\n\t\t\t\tilce\t    = ?,\r\n\t\t\t\tsemt \t\t= ?,\r\n\t\t\t\tlatfield \t= ?,\r\n\t\t\t\tlngfield \t= ?,\r\n\t\t\t\tzoom \t\t= ?,\t\t\t\t\r\n\t\t\t\tkategori \t= ?,\r\n\t\t\t\tdanisman \t= ?,\r\n\t\t\t\tozellik \t= ?,\t\t\t\t\r\n\t\t\t\tadi \t\t= ?,\t\t\t\t\r\n\t\t\t\temlak_kodu \t= ?,\r\n\t\t\t\tfiyat \t\t= ?,\t\t\t\t\r\n\t\t\t\tseo \t\t= ?,\t\t\t\t\r\n\t\t\t\taciklama \t= ?,\r\n\t\t\t\tdescription\t= ?,\r\n\t\t\t\tkeywords\t= ?,\r\n\t\t\t\tkapak \t\t= ?,\t\t\t\r\n\t\t\t\tkatalog \t= ?,\r\n\t\t\t\tdurum \t\t= ?,\r\n\t\t\t\tanasayfa \t= ?,\t\t\t\r\n\t\t\t\tdil \t\t= ?,\r\n\t\t\t\ttarih \t\t= ?");
        $Ekle = $sorgu->execute([$brut, $uye, $net, $oda, $video, $katsayisi, $bulundugukat, $bina, $isitma, $banyo, $balkon, $esya, $kdrumu, $takas, $krediu, $garama, $imardurumu, $adano, $parselno, $paftano, $kaks, $gabari, $tapudurumu, $katkarsiligi, $aidat, $depozito, $pbirim, $il, $ilce, $semt, $latfield, $lngfield, $zoom, $kategori, $danisman, $ozellikler, $adi, $emlak_kodu, $fiyat, $seo, $aciklama, $description, $keywords, $Kapak, $Katalog, $durum, $anasayfa, $_SESSION["admin_dil"], $tarih]);
        if ($Ekle) {
            $last_id = $db->lastInsertId();
            foreach ($files as $file) {
                $yukle = new Upload($file);
                if ($yukle->uploaded) {
                    $yukle->file_auto_rename = true;
                    $yukle->image_watermark = "../" . tema . "/uploads/watermark/" . $ayar["watermark"] . "";
                    $yukle->image_watermark_no_zoom_out = true;
                    $yukle->process("../" . tema . "/uploads/emlaklar/diger");
                    $yukle->allowed = ["image/*"];
                    if ($yukle->processed) {
                        $DigerResim = "" . $yukle->file_dst_name . "";
                        $sorgu = $db->prepare("INSERT INTO emlakresim SET\r\n\t\t\t\t\t\t\tpid \t= ?,\r\n\t\t\t\t\t\t\tresim \t= ?\r\n\t\t\t\t\t\t\t");
                        $yap = $sorgu->execute([$last_id, $DigerResim]);
                    }
                }
            }
            if ($_POST["uye"] == "1") {
                bildirim("Emlak Ekledi", "icon-drawer", $last_id, $adi, "başlıklı ilan ekledi.");
                $_SESSION["emlak_ekle"] = "yes";
                header("Location:../" . yonetim . "/emlaklar" . $html . "");
                exit;
            }
            bildirim("Emlak Ekledi", "icon-drawer", $last_id, $adi, "başlıklı ilan ekledi.");
            $_SESSION["emlak_ekle"] = "yes";
            header("Location:../" . yonetim . "/emlaklar" . $html . "");
            exit;
        } else {
            if ($_POST["uye"] == "1") {
                $_SESSION["emlak_ekle"] = "no";
                header("Location:../" . yonetim . "/emlak-ekle" . $html . "");
                exit;
            }
            $_SESSION["emlak_ekle"] = "no";
            header("Location:../" . yonetim . "/emlak-ekle" . $html . "");
            exit;
        }
    } else {
        if ($_POST["uye"] == "1") {
            $_SESSION["demohesap"] = "no";
            header("Location:../" . yonetim . "/emlak-ekle" . $html . "");
            exit;
        }
        $_SESSION["demohesap"] = "no";
        header("Location:../" . yonetim . "/emlak-ekle" . $html . "");
        exit;
    }
} else {
    if (isset($_POST["emlak_guncelle"])) {
        panelislemkontrol();
        $d_id = $_POST["id"];
        if ($_SESSION["rutbe"] == 0) {
            $brut = $_POST["brut"];
            $net = $_POST["net"];
            $oda = $_POST["oda"];
            $video = $_POST["video"];
            $katsayisi = $_POST["katsayisi"];
            $bulundugukat = $_POST["bulundugukat"];
            $bina = $_POST["bina"];
            $isitma = $_POST["isitma"];
            $banyo = $_POST["banyo"];
            $balkon = $_POST["balkon"];
            $esya = $_POST["esya"];
            $kdrumu = $_POST["kdrumu"];
            $takas = $_POST["takas"];
            $krediu = $_POST["krediu"];
            $garama = $_POST["garama"];
            $imardurumu = $_POST["imardurumu"];
            $adano = $_POST["adano"];
            $parselno = $_POST["parselno"];
            $paftano = $_POST["paftano"];
            $kaks = $_POST["kaks"];
            $gabari = $_POST["gabari"];
            $tapudurumu = $_POST["tapudurumu"];
            $katkarsiligi = $_POST["katkarsiligi"];
            $aidat = $_POST["aidat"];
            $depozito = $_POST["depozito"];
            $pbirim = $_POST["pbirim"];
            $il = $_POST["il"];
            $ilce = $_POST["ilce"];
            $semt = $_POST["semt"];
            $latfield = $_POST["latfield"];
            $lngfield = $_POST["lngfield"];
            $zoom = $_POST["zoom"];
            $kategori = $_POST["kategori"];
            $danisman = $_POST["danisman"];
            $adi = $_POST["adi"];
            $emlak_kodu = $_POST["emlak_kodu"];
            $fiyat = $_POST["fiyat"];
            $seo = seo($adi . "-" . $d_id);
            $aciklama = $_POST["aciklama"];
            $description = $_POST["description"];
            $keywords = $_POST["keywords"];
            if ($_POST["durum"]) {
                $durum = 1;
            } else {
                $durum = 0;
            }
            if ($_POST["uye"]) {
                $uye = 1;
            } else {
                $uye = 0;
            }
            if ($_POST["anasayfa"]) {
                $anasayfa = 1;
            } else {
                $anasayfa = 0;
            }
            $tarih = date("Y-m-d H:i:s");
            $tarih = tr_tarih($tarih);
            $ozellik = implode(",", $_POST["ozellik"]);
            $ozellikler = NULL;
            foreach ($_POST["ozellik"] as $k => $v) {
                $ozellik = explode("-", $v);
                if (isset($ozellikler[$ozellik[0]])) {
                    $ozellikler[$ozellik[0]] .= "|" . $ozellik[1];
                } else {
                    $ozellikler[$ozellik[0]] = $ozellik[1];
                }
            }
            if (is_array($ozellikler)) {
                $_ozellikler = NULL;
                foreach ($ozellikler as $k => $v) {
                    if (is_null($_ozellikler)) {
                        $_ozellikler = $k . "-" . $v;
                    } else {
                        $_ozellikler .= "," . $k . "-" . $v;
                    }
                }
                $ozellikler = $_ozellikler;
            }
            $upload = new upload($_FILES["resim"]);
            if ($upload->uploaded) {
                $upload->file_auto_rename = true;
                $upload->image_watermark = "../" . tema . "/uploads/watermark/" . $ayar["watermark"] . "";
                $upload->image_watermark_no_zoom_out = true;
                $upload->process("../" . tema . "/uploads/emlaklar");
                $upload->file_auto_rename = true;
                $upload->image_resize = true;
                $upload->image_ratio_crop = true;
                $upload->image_watermark = "../" . tema . "/uploads/watermark/" . $ayar["watermark"] . "";
                $upload->image_watermark_no_zoom_out = true;
                $upload->image_x = 560;
                $upload->image_y = 320;
                $upload->process("../" . tema . "/uploads/emlaklar/kapak");
                if ($upload->processed) {
                    $Kapak = "" . $upload->file_dst_name . "";
                }
            }
            $upload3 = new upload($_FILES["katalog"]);
            if ($upload3->uploaded) {
                $upload3->file_auto_rename = true;
                $upload3->process("../" . tema . "/uploads/emlaklar/katalog");
                if ($upload3->processed) {
                    $Katalog = "" . $upload3->file_dst_name . "";
                }
            }
            $files = [];
            foreach ($_FILES["resimler"] as $k => $l) {
                foreach ($l as $i => $v) {
                    if (!array_key_exists($i, $files)) {
                        $files[$i] = [];
                    }
                    $files[$i][$k] = $v;
                }
            }
            if (isset($Kapak)) {
                $resim_bul = $db->query("SELECT * FROM emlaklar WHERE id = '" . $d_id . "'")->fetch(PDO::FETCH_ASSOC);
                unlink("../" . tema . "/uploads/emlaklar/" . $resim_bul["kapak"]);
                unlink("../" . tema . "/uploads/emlaklar/kapak/" . $resim_bul["kapak"]);
                $guncelle = $db->prepare("UPDATE emlaklar SET kapak = ? WHERE id = ?");
                $guncelle->execute([$Kapak, $d_id]);
                $Kapak = "" . $upload->file_dst_name . "";
            }
            if (isset($Katalog)) {
                $resim_bul = $db->query("SELECT * FROM emlaklar WHERE id = '" . $d_id . "'")->fetch(PDO::FETCH_ASSOC);
                unlink("../" . tema . "/uploads/emlaklar/katalog/" . $resim_bul["katalog"]);
                $guncelle = $db->prepare("UPDATE emlaklar SET katalog = ? WHERE id = ?");
                $guncelle->execute([$Katalog, $d_id]);
                $Katalog = "" . $upload3->file_dst_name . "";
            }
            $sorgu = $db->prepare("UPDATE emlaklar SET\t\t\t\t\r\n\t\t\t\tuye \t\t\t= ?,\r\n\t\t\t\tbrut \t\t\t= ?,\r\n\t\t\t\tnet \t\t\t= ?,\r\n\t\t\t\toda \t\t\t= ?,\r\n\t\t\t\tvideo \t\t\t= ?,\r\n\t\t\t\tkatsayisi \t\t= ?,\r\n\t\t\t\tbulundugukat \t= ?,\r\n\t\t\t\tbina \t\t\t= ?,\r\n\t\t\t\tisitma \t\t\t= ?,\r\n\t\t\t\tbanyo \t\t\t= ?,\r\n\t\t\t\tbalkon \t\t\t= ?,\r\n\t\t\t\tesya \t\t\t= ?,\r\n\t\t\t\tkdrumu \t\t\t= ?,\r\n\t\t\t\ttakas \t\t\t= ?,\r\n\t\t\t\tkrediu \t\t\t= ?,\r\n\t\t\t\tgarama \t\t\t= ?,\r\n\t\t\t\timardurumu \t\t= ?,\r\n\t\t\t\tadano \t\t\t= ?,\r\n\t\t\t\tparselno \t\t= ?,\r\n\t\t\t\tpaftano \t\t= ?,\r\n\t\t\t\tkaks \t\t\t= ?,\r\n\t\t\t\tgabari \t\t\t= ?,\r\n\t\t\t\ttapudurumu \t\t= ?,\r\n\t\t\t\tkatkarsiligi \t= ?,\r\n\t\t\t\taidat \t\t\t= ?,\r\n\t\t\t\tdepozito \t\t= ?,\r\n\t\t\t\tpbirim \t\t\t= ?,\r\n\t\t\t\til \t\t\t\t= ?,\r\n\t\t\t\tilce \t\t\t= ?,\r\n\t\t\t\tsemt \t\t\t= ?,\r\n\t\t\t\tlatfield \t\t= ?,\r\n\t\t\t\tlngfield \t\t= ?,\r\n\t\t\t\tzoom \t\t\t= ?,\t\t\t\r\n\t\t\t\tkategori \t\t= ?,\r\n\t\t\t\tdanisman \t\t= ?,\r\n\t\t\t\tozellik \t\t= ?,\t\t\t\r\n\t\t\t\tadi \t\t\t= ?,\t\t\t\r\n\t\t\t\temlak_kodu \t\t= ?,\r\n\t\t\t\tfiyat \t\t\t= ?,\t\t\t\r\n\t\t\t\tseo \t\t\t= ?,\t\t\t\r\n\t\t\t\taciklama \t\t= ?,\r\n\t\t\t\tdescription\t\t= ?,\r\n\t\t\t\tkeywords\t\t= ?,\r\n\t\t\t\tdurum \t\t\t= ?,\r\n\t\t\t\tanasayfa \t\t= ?,\t\t\t\r\n\t\t\t\ttarih \t\t\t= ?\r\n\t\t\t\tWHERE id \t\t= ?");
            $guncelle = $sorgu->execute([$uye, $brut, $net, $oda, $video, $katsayisi, $bulundugukat, $bina, $isitma, $banyo, $balkon, $esya, $kdrumu, $takas, $krediu, $garama, $imardurumu, $adano, $parselno, $paftano, $kaks, $gabari, $tapudurumu, $katkarsiligi, $aidat, $depozito, $pbirim, $il, $ilce, $semt, $latfield, $lngfield, $zoom, $kategori, $danisman, $ozellikler, $adi, $emlak_kodu, $fiyat, $seo, $aciklama, $description, $keywords, $durum, $anasayfa, $tarih, $d_id]);
            if ($guncelle) {
                $sonid = $_POST["id"];
                foreach ($files as $file) {
                    $yukle = new Upload($file);
                    if ($yukle->uploaded) {
                        $yukle->file_auto_rename = true;
                        $yukle->image_watermark = "../" . tema . "/uploads/watermark/" . $ayar["watermark"] . "";
                        $yukle->image_watermark_no_zoom_out = true;
                        $yukle->process("../" . tema . "/uploads/emlaklar/diger");
                        $yukle->allowed = ["image/*"];
                        if ($yukle->processed) {
                            $DigerResim = "" . $yukle->file_dst_name . "";
                            $sorgu = $db->prepare("INSERT INTO emlakresim SET\r\n\t\t\t\t\t\t\tpid \t= ?,\r\n\t\t\t\t\t\t\tresim \t= ?\r\n\t\t\t\t\t\t\t");
                            $yap = $sorgu->execute([$sonid, $DigerResim]);
                        }
                    }
                }
                if ($_POST["uye"] == "1") {
                    $last_id = $d_id;
                    bildirim("Emlak Güncellendi", "icon-drawer", $last_id, $adi, "başlıklı ilanı güncelledi.");
                    $_SESSION["emlak_guncelle"] = "yes";
                    header("Location:../" . yonetim . "/emlak-duzenle/" . $d_id . "" . $html . "");
                    exit;
                }
                $last_id = $d_id;
                bildirim("Emlak Güncellendi", "icon-drawer", $last_id, $adi, "başlıklı ilanı güncelledi.");
                $_SESSION["emlak_guncelle"] = "yes";
                header("Location:../" . yonetim . "/emlak-duzenle/" . $d_id . "" . $html . "");
                exit;
            } else {
                if ($_POST["uye"] == "1") {
                    $_SESSION["emlak_guncelle"] = "no";
                    header("Location:../" . yonetim . "/emlak-duzenle/" . $d_id . "" . $html . "");
                    exit;
                }
                $_SESSION["emlak_guncelle"] = "no";
                header("Location:../" . yonetim . "/emlak-duzenle/" . $d_id . "" . $html . "");
                exit;
            }
        } else {
            if ($_POST["uye"] == "1") {
                $_SESSION["demohesap"] = "no";
                header("Location:../" . yonetim . "/emlak-duzenle/" . $d_id . "" . $html . "");
                exit;
            }
            $_SESSION["demohesap"] = "no";
            header("Location:../" . yonetim . "/emlak-duzenle/" . $d_id . "" . $html . "");
            exit;
        }
    } else {
        if (isset($_POST["api_ayarlar"])) {
            panelislemkontrol();
            if ($_SESSION["rutbe"] == 0) {
                $google_analytics = $_POST["google_analytics"];
                $dogrulama_kodu = $_POST["dogrulama_kodu"];
                $google_maps = $_POST["google_maps"];
                $canli_destek = $_POST["canli_destek"];
                $whatsapp = $_POST["whatsapp"];
                $rcaptha = $_POST["rcaptha"];
                $sorgu = $db->prepare("UPDATE ayarlar SET\t\t\r\n google_analytics= ?,\t\t\t\r\n dogrulama_kodu \t= ?,\t\r\n google_maps\t\t= ?,\t\t\r\n whatsapp\t\t\t= ?,\t\t\r\n rcaptha\t\t\t= ?,\t\r\n canli_destek\t= ?\t\t\r\n WHERE id \t\t= ?");
                $guncelle = $sorgu->execute([$google_analytics, $dogrulama_kodu, $google_maps, $whatsapp, $rcaptha, $canli_destek, "1"]);
                if ($guncelle) {
                    $last_id = "1";
                    bildirim("Api Ayarları Güncellendi", "icon-settings", $last_id, "", "api ayarlarını güncelledi.");
                    $_SESSION["api_ayarlar"] = "yes";
                    header("Location:../" . yonetim . "/api-ayarlari" . $html . "");
                    exit;
                }
                $_SESSION["api_ayarlar"] = "no";
                header("Location:../" . yonetim . "/api-ayarlari" . $html . "");
                exit;
            }
            $_SESSION["demohesap"] = "no";
            header("Location:../" . yonetim . "/api-ayarlari" . $html . "");
            exit;
        }
        if (isset($_POST["modul_guncelle"])) {
            panelislemkontrol();
            $url = $_POST["url"];
            if ($_SESSION["rutbe"] == 0) {
                if ($_POST["alan1"]) {
                    $alan1 = 1;
                } else {
                    $alan1 = 0;
                }
                if ($_POST["alan2"]) {
                    $alan2 = 1;
                } else {
                    $alan2 = 0;
                }
                if ($_POST["alan3"]) {
                    $alan3 = 1;
                } else {
                    $alan3 = 0;
                }
                if ($_POST["alan4"]) {
                    $alan4 = 1;
                } else {
                    $alan4 = 0;
                }
                if ($_POST["alan5"]) {
                    $alan5 = 1;
                } else {
                    $alan5 = 0;
                }
                if ($_POST["alan6"]) {
                    $alan6 = 1;
                } else {
                    $alan6 = 0;
                }
                if ($_POST["alan7"]) {
                    $alan7 = 1;
                } else {
                    $alan7 = 0;
                }
                if ($_POST["alan8"]) {
                    $alan8 = 1;
                } else {
                    $alan8 = 0;
                }
                if ($_POST["alan9"]) {
                    $alan9 = 1;
                } else {
                    $alan9 = 0;
                }
                if ($_POST["alan10"]) {
                    $alan10 = 1;
                } else {
                    $alan10 = 0;
                }
                if ($_POST["alan11"]) {
                    $alan11 = 1;
                } else {
                    $alan11 = 0;
                }
                if ($_POST["alan12"]) {
                    $alan12 = 1;
                } else {
                    $alan12 = 0;
                }
                if ($_POST["alan13"]) {
                    $alan13 = 1;
                } else {
                    $alan13 = 0;
                }
                if ($_POST["alan14"]) {
                    $alan14 = 1;
                } else {
                    $alan14 = 0;
                }
                if ($_POST["alan15"]) {
                    $alan15 = 1;
                } else {
                    $alan15 = 0;
                }
                if ($_POST["alan16"]) {
                    $alan16 = 1;
                } else {
                    $alan16 = 0;
                }
                if ($_POST["alan17"]) {
                    $alan17 = 1;
                } else {
                    $alan17 = 0;
                }
                if ($_POST["alan18"]) {
                    $alan18 = 1;
                } else {
                    $alan18 = 0;
                }
                if ($_POST["alan19"]) {
                    $alan19 = 1;
                } else {
                    $alan19 = 0;
                }
                $alan20 = $_POST["alan20"];
                $alan21 = $_POST["alan21"];
                if ($_POST["alan22"]) {
                    $alan22 = 1;
                } else {
                    $alan22 = 0;
                }
                if ($_POST["alan23"]) {
                    $alan23 = 1;
                } else {
                    $alan23 = 0;
                }
                if ($_POST["alan24"]) {
                    $alan24 = 1;
                } else {
                    $alan24 = 0;
                }
                if ($_POST["alan25"]) {
                    $alan25 = 1;
                } else {
                    $alan25 = 0;
                }
                if ($_POST["zoom"]) {
                    $zoom = 1;
                } else {
                    $zoom = 0;
                }
                $sorgu = $db->prepare("UPDATE moduller SET\t\t\r\n\talan1\t= ?,\t\t\r\n\talan2\t= ?,\t\t\r\n\talan3\t= ?,\t\t\r\n\talan4\t= ?,\t\t\r\n\talan5\t= ?,\t\t\r\n\talan6\t= ?,\t\r\n\talan7\t= ?,\t\t\r\n\talan8\t= ?,\t\t\r\n\talan9\t= ?,\t\t\r\n\talan10\t= ?,\t\t\r\n\talan11\t= ?,\t\t\r\n\talan12\t= ?,\t\t\r\n\talan13\t= ?,\t\t\r\n\talan14\t= ?,\t\r\n\talan15\t= ?,\t\r\n\talan16\t= ?,\t\t\r\n\talan17\t= ?,\t\t\r\n\talan18\t= ?,\t\t\r\n\talan19\t= ?,\t\t\r\n\talan20\t= ?,\t\t\r\n\talan21\t= ?,\t\r\n\talan22\t= ?,\t\t\r\n\talan23\t= ?,\t\t\r\n\talan24\t= ?,\t\t\r\n\talan25\t= ?,\t\r\n\tzoom\t= ?\t\r\n\tWHERE id= ?");
                $guncelle = $sorgu->execute([$alan1, $alan2, $alan3, $alan4, $alan5, $alan6, $alan7, $alan8, $alan9, $alan10, $alan11, $alan12, $alan13, $alan14, $alan15, $alan16, $alan17, $alan18, $alan19, $alan20, $alan21, $alan22, $alan23, $alan24, $alan25, $zoom, "1"]);
                if ($guncelle) {
                    $last_id = "1";
                    bildirim("Modül Güncellendi", "icon-settings", $last_id, "", "modül ayarlarını güncelledi.");
                    $_SESSION["modul_guncelle"] = "yes";
                    header("Location:" . $url . "");
                    exit;
                }
                $_SESSION["modul_guncelle"] = "no";
                header("Location:" . $url . "");
                exit;
            }
            $_SESSION["demohesap"] = "no";
            header("Location:" . $url . "");
            exit;
        }
        ob_end_flush();
        echo "\r\n\r\n\r\n\r\n";
    }
}

?>