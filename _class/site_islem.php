<?php


require_once "baglan.php";
require_once "fonksiyon.php";
require_once "class.upload.php";
require_once "class.phpmailer.php";
$logo = url . tema . "/uploads/logo/" . logo;
$domain_bilgi = url;
if ($moduller["alan20"] == "1") {
    $html = ".html";
} else {
    $html = "";
}
if (isset($_POST["giris"])) {
    $email = nl2br(strip_tags($_POST["email"], "<b><p><i>"));
    $sifre = $_POST["sifre"];
    $son_giris = tr_tarih("Y-m-d H:i:s");
    $ip = ip();
    $_SESSION["girisbilgi"] = ["email" => $email];
    if (empty($sifre) || empty($email)) {
        $_SESSION["giris_yap"] = "bos";
        header("Location:../" . $htc["anasayfaurl"] . $html . "");
    } else {
        $varmi = $db->prepare("SELECT * FROM uyeler WHERE BINARY email = ? AND sifre = ?");
        $varmi->execute([$email, $sifre]);
        if ($varmi->rowCount()) {
            $UyuSonuc = $varmi->fetch(PDO::FETCH_ASSOC);
            if ($UyuSonuc["durum"] == 0) {
                $_SESSION["musteri_kontol"] = "pasif";
                header("Location:../" . $htc["anasayfaurl"] . $html . "");
                exit;
            }
            if ($UyuSonuc["durum"] == 2) {
                $_SESSION["musteri_kontol"] = "engel";
                header("Location:../" . $htc["anasayfaurl"] . $html . "");
                exit;
            }
            $_SESSION["site_uyeid"] = $UyuSonuc["id"];
            $_SESSION["site_adsoyad"] = $UyuSonuc["adsoyad"];
            $_SESSION["site_email"] = $UyuSonuc["email"];
            $_SESSION["site_sifre"] = $UyuSonuc["sifre"];
            if (isset($_POST["beni_hatirla"])) {
                setcookie("site_email", $UyuSonuc["email"], strtotime("+1 day"), "/", NULL, NULL, true);
                setcookie("site_sifre", $UyuSonuc["sifre"], strtotime("+1 day"), "/", NULL, NULL, true);
            } else {
                setcookie("site_email", $UyuSonuc["kadi"], strtotime("-1 day"), "/", NULL, NULL, true);
                setcookie("site_sifre", $UyuSonuc["sifre"], strtotime("-1 day"), "/", NULL, NULL, true);
            }
            $sorgu = $db->prepare("UPDATE uyeler SET\r\n\t\t\t\t\tson_giris \t= ?,\r\n\t\t\t\t\tip \t\t\t= ?\r\n\t\t\t\t\tWHERE id \t= ?");
            $guncelle = $sorgu->execute([$son_giris, $ip, $UyuSonuc["id"]]);
            $_SESSION["giris_yap"] = "yes";
            if (isset($_SESSION["devam"])) {
                header("Location:../" . $htc["odemeurl"] . $html . "");
            } else {
                header("Location:../" . $htc["hesabimurl"] . $html . "");
            }
        } else {
            $_SESSION["giris_yap"] = "no";
            header("Location:../" . $htc["anasayfaurl"] . $html . "");
        }
    }
}
if ($_GET["katalogsil"] == "ok") {
    $resimid = $_GET["sid"];
    if ($ayar["demo"] == 0) {
        $resim_bul = $db->query("SELECT * FROM emlaklar WHERE id = '" . $resimid . "'")->fetch(PDO::FETCH_ASSOC);
        unlink("../" . tema . "/uploads/emlaklar/katalog/" . $resim_bul["katalog"]);
        $sorgu = $db->prepare("UPDATE emlaklar SET\r\n\t\t\t\t\tkatalog\t= ?\r\n\t\t\t\t\tWHERE id = ?");
        $guncelle = $sorgu->execute(["", $resimid]);
        if ($guncelle) {
            $_SESSION["katalogsil"] = "yes";
            header("Location:../ilan-ekle/" . $_GET["id"] . "" . $html . "");
        } else {
            $_SESSION["katalogsil"] = "no";
            header("Location:../ilan-ekle/" . $_GET["id"] . "" . $html . "");
        }
    } else {
        $_SESSION["demohesap"] = "no";
        header("Location:../ilan-ekle/" . $_GET["id"] . "" . $html . "");
    }
}
if ($_GET["emlakresimsil"] == "ok") {
    $resimid = $_GET["sid"];
    if ($ayar["demo"] == 0) {
        $resim_bul = $db->query("SELECT * FROM emlaklar WHERE id = '" . $resimid . "'")->fetch(PDO::FETCH_ASSOC);
        unlink("../" . tema . "/uploads/emlaklar/" . $resim_bul["kapak"]);
        unlink("../" . tema . "/uploads/emlaklar/kapak/" . $resim_bul["kapak"]);
        $sorgu = $db->prepare("UPDATE emlaklar SET\r\n\t\t\t\t\tkapak\t= ?\r\n\t\t\t\t\tWHERE id = ?");
        $guncelle = $sorgu->execute(["", $resimid]);
        if ($guncelle) {
            $last_id = $resim_bul["id"];
            sitebildirim("Emlak Kapak Resmi Silindi", "icon-trash", $last_id, $resim_bul["adi"], "başlıklı ilanın kapak resmini ilan sahibi sildi.");
            $_SESSION["emlakresimsil"] = "yes";
            header("Location:../ilan-ekle/" . $_GET["id"] . "" . $html . "");
            exit;
        }
        $_SESSION["emlakresimsil"] = "no";
        header("Location:../ilan-ekle/" . $_GET["id"] . "" . $html . "");
        exit;
    }
    $_SESSION["demohesap"] = "no";
    header("Location:../ilan-ekle/" . $_GET["id"] . "" . $html . "");
    exit;
}
if ($_GET["emlaktopluresimsil"] == "ok") {
    $resimid = $_GET["sid"];
    if ($ayar["demo"] == 0) {
        $resim_bul = $db->query("SELECT * FROM emlakresim WHERE id = '" . $resimid . "'")->fetch(PDO::FETCH_ASSOC);
        unlink("../" . tema . "/uploads/emlaklar/diger/" . $resim_bul["resim"]);
        $TSorgu = $db->prepare("DELETE FROM emlakresim WHERE id = :id");
        $TSil = $TSorgu->execute(["id" => $resimid]);
        if ($TSil) {
            $_SESSION["emlaktopluresimsil"] = "yes";
            header("Location:../ilan-ekle/" . $_GET["id"] . "" . $html . "");
            exit;
        }
        $_SESSION["emlaktopluresimsil"] = "no";
        header("Location:../ilan-ekle/" . $_GET["id"] . "" . $html . "");
        exit;
    }
    $_SESSION["demohesap"] = "no";
    header("Location:../ilan-ekle/" . $_GET["id"] . "" . $html . "");
    exit;
}
if ($_GET["emlaksil"] == "ok") {
    if ($ayar["demo"] == 0) {
        $TSorgu = $db->prepare("DELETE FROM emlaklar WHERE id = ? and ekleyen = ?");
        $TSil = $TSorgu->execute([$_GET["id"], $_SESSION["site_uyeid"]]);
        if ($TSorgu->rowCount()) {
            if ($TSil) {
                $resim_bul = $db->query("SELECT * FROM emlaklar WHERE id = '" . $_GET["id"] . "'")->fetch(PDO::FETCH_ASSOC);
                unlink("../" . tema . "/uploads/emlaklar/" . $resim_bul["kapak"]);
                unlink("../" . tema . "/uploads/emlaklar/kapak/" . $resim_bul["kapak"]);
                unlink("../" . tema . "/uploads/emlaklar/katalog/" . $resim_bul["katalog"]);
                $TopluSorgu = $db->prepare("SELECT * FROM emlakresim WHERE pid = ?");
                $TopluSorgu->execute([$_GET["id"]]);
                $Topluislem = $TopluSorgu->fetchALL(PDO::FETCH_ASSOC);
                foreach ($Topluislem as $TopluSonuc) {
                    $TSorgu = $db->prepare("DELETE FROM emlakresim WHERE id = :id");
                    $TSorgu->execute(["id" => $TopluSonuc["id"]]);
                    unlink("../" . tema . "/uploads/emlaklar/diger/" . $TopluSonuc["resim"]);
                }
                $last_id = $_GET["id"];
                sitebildirim("" . $_SESSION["site_adsoyad"] . "", "icon-drawer", $last_id, $_GET["adi"], "başlıklı ilanı sildi.");
                header("Location:../ilanlarim" . $html . "");
                exit;
            } else {
                header("Location:../ilanlarim" . $html . "");
                exit;
            }
        } else {
            echo "<meta http-equiv=\"refresh\" content=\"0; url=404\".\$html.\"\">";
            exit;
        }
    } else {
        $_SESSION["demohesap"] = "no";
        header("Location:../ilanlarim" . $html . "");
        exit;
    }
} else {
    if (isset($_POST["sifre_hatirlat"])) {
        $email = nl2br(strip_tags($_POST["email"], "<b><p><i>"));
        if ($ayar["demo"] == 0) {
            if (0 < strlen($_POST["kontrol"])) {
                header("Location:../" . $htc["girisyapurl"] . $html . "");
                exit;
            }
            $kontrol = $db->prepare("SELECT * FROM uyeler WHERE email = ?");
            $kontrol->execute([$email]);
            if ($kontrol->rowCount()) {
                $Row = $kontrol->fetch(PDO::FETCH_ASSOC);
                $sifreuret = kod();
                $sablon = $db->query("SELECT * FROM bildirim_sablonu WHERE id = '3'")->fetch(PDO::FETCH_ASSOC);
                $gelendegisken = explode(",", $sablon["degiskenler"]);
                $panel_url = url . $htc["hesabimurl"] . $html;
                $gidendegisken = [$Row["adsoyad"], $Row["email"], $sifreuret, $panel_url, $logo, $domain_bilgi];
                $sorgu = $db->prepare("UPDATE uyeler SET\r\n\t\t\t\t\tsifre \t= ?\r\n\t\t\t\t\tWHERE email = ?");
                $Guncelle = $sorgu->execute([$sifreuret, $email]);
                if ($Guncelle) {
                    if ($sablon["sbildirim"] == "1") {
                        $uyesmssablon = $sablon["icerik3"];
                        smsgonder($gelendegisken, $gidendegisken, $uyesmssablon, $Row["telefon"], $uyesmssablon);
                    }
                    if ($sablon["ubildirim"] == "1") {
                        $uyekonu = turkce($sablon["konu"]);
                        $uyesablon = $sablon["icerik"];
                        mailgonder($gelendegisken, $gidendegisken, $uyesablon, $Row["email"], " " . $uyekonu . "", $uyesablon);
                    }
                    if ($sablon["abildirim"] == "1") {
                        $adminkonu = turkce($sablon["konu2"]);
                        $adminsablon = $sablon["icerik2"];
                        mailgonder($gelendegisken, $gidendegisken, $adminsablon, m_kime, " " . $adminkonu . "", $adminsablon);
                    }
                    $_SESSION["sifre_hatirlat"] = "yes";
                    header("Location:../" . $htc["girisyapurl"] . $html . "");
                } else {
                    $_SESSION["sifre_hatirlat"] = "no";
                    header("Location:../" . $htc["girisyapurl"] . $html . "");
                }
            } else {
                $_SESSION["sifre_hatirlat"] = "no";
                header("Location:../" . $htc["girisyapurl"] . $html . "");
            }
        } else {
            $_SESSION["sitedemo"] = "no";
            header("Location:../" . $htc["girisyapurl"] . $html . "");
        }
    }
    if (isset($_POST["uyelik"])) {
        if (isset($_POST["g-recaptcha-response"])) {
            $captcha = $_POST["g-recaptcha-response"];
        }
        if (!$captcha) {
            $_SESSION["uyelik"] = "bos";
            header("Location:../" . $htc["hesapolustururl"] . $html . "");
            exit;
        }
        $kontrol = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $ayar["rcaptha"] . "&response=" . $captcha . "&remoteip=" . $_SERVER["REMOTE_ADDR"]);
        if (!($kontrol . success)) {
            $_SESSION["uyelik"] = "bos";
            header("Location:../" . $htc["hesapolustururl"] . $html . "");
        } else {
            $adsoyad = nl2br(strip_tags($_POST["adsoyad"], "<b><p><i>"));
            $email = nl2br(strip_tags($_POST["email"], "<b><p><i>"));
            $telefon = nl2br(strip_tags($_POST["telefon"], "<b><p><i>"));
            $tc = nl2br(strip_tags($_POST["tc"], "<b><p><i>"));
            $gorev = nl2br(strip_tags($_POST["gorev"], "<b><p><i>"));
            if ($_POST["email_bildirim"]) {
                $email_bildirim = 1;
            } else {
                $email_bildirim = 0;
            }
            if ($_POST["sms_bildirim"]) {
                $sms_bildirim = 1;
            } else {
                $sms_bildirim = 0;
            }
            $adres = $_POST["adres"];
            $sifre = $_POST["parola"];
            $sifret = $_POST["parola_tekrar"];
            $tarih = tr_tarih("Y-m-d H:i:s");
            $ip = ip();
            if ($ayar["demo"] == 0) {
                $upload = new upload($_FILES["resim"]);
                if ($upload->uploaded) {
                    $upload->file_auto_rename = true;
                    $upload->process("../" . tema . "/uploads/uyeler");
                    if ($upload->processed) {
                        $resim = "" . $upload->file_dst_name . "";
                    }
                }
                $resim = "" . $upload->file_dst_name . "";
                $Dosyaurl = url . tema . "/uploads/uyeler/" . $resim;
                $upload = new upload($_FILES["profil"]);
                if ($upload->uploaded) {
                    $upload->file_auto_rename = true;
                    $upload->process("../" . tema . "/uploads/uyeler");
                    if ($upload->processed) {
                        $profil = "" . $upload->file_dst_name . "";
                    }
                }
                $profil = "" . $upload->file_dst_name . "";
                $Dosyaurl = url . tema . "/uploads/uyeler/" . $profil;
                $sablon = $db->query("SELECT * FROM bildirim_sablonu WHERE id = '2'")->fetch(PDO::FETCH_ASSOC);
                $gelendegisken = explode(",", $sablon["degiskenler"]);
                $panel_url = url . $htc["hesabimurl"] . $html;
                $gidendegisken = [$adsoyad, $email, $sifre, $panel_url, $logo, $domain_bilgi];
                $_SESSION["uyebilgi"] = ["hesap" => $hesap, "adsoyad" => $adsoyad, "email" => $email, "telefon" => $telefon, "tc" => $tc, "email_bildirim" => $_POST["email_bildirim"], "sms_bildirim" => $_POST["sms_bildirim"], "sozlesme" => $_POST["sozlesme"], "gorev" => $_POST["gorev"], "adres" => $adres];
                if (empty($email) || empty($sifre) || empty($sifret)) {
                    $_SESSION["uyelik"] = "bos";
                    header("Location:../" . $htc["hesapolustururl"] . $html . "");
                } else {
                    if ($sifre != $sifret) {
                        $_SESSION["uyelik"] = "sifre";
                        header("Location:../" . $htc["hesapolustururl"] . $html . "");
                    } else {
                        if (!$_POST["sozlesme"]) {
                            $_SESSION["uyelik"] = "sozlesme";
                            header("Location:../" . $htc["hesapolustururl"] . $html . "");
                        } else {
                            $varmi = $db->prepare("SELECT * FROM uyeler WHERE email = ?");
                            $varmi->execute([$email]);
                            if (!$varmi->rowCount()) {
                                $sorgu = $db->prepare("INSERT INTO uyeler SET\r\n\t\t\t\t\tadsoyad\t\t\t= :adsoyad,\r\n\t\t\t\t\temail \t\t\t= :email,\r\n\t\t\t\t\tsifre\t\t\t= :sifre,\r\n\t\t\t\t\ttelefon\t\t\t= :telefon,\t\t\t\t\t\r\n\t\t\t\t\ttc\t\t\t\t= :tc,\r\n\t\t\t\t\tadres\t\t\t= :adres,\r\n\t\t\t\t\tresim\t\t\t= :resim,\r\n\t\t\t\t\tprofil\t\t\t= :profil,\r\n\t\t\t\t\tgorev\t\t\t= :gorev,\r\n\t\t\t\t\tson_giris\t\t= :son_giris,\r\n\t\t\t\t\temail_bildirim\t= :email_bildirim,\r\n\t\t\t\t\tsms_bildirim\t= :sms_bildirim,\r\n\t\t\t\t\tip\t\t\t\t= :ip,\r\n\t\t\t\t\ttarih \t\t\t= :tarih");
                                $Ekle = $sorgu->execute(["adsoyad" => $adsoyad, "email" => $email, "sifre" => $sifre, "telefon" => $telefon, "tc" => $tc, "adres" => $adres, "resim" => $resim, "profil" => $profil, "gorev" => $gorev, "son_giris" => $tarih, "email_bildirim" => $email_bildirim, "sms_bildirim" => $sms_bildirim, "ip" => $ip, "tarih" => $tarih]);
                                if ($Ekle) {
                                    $last_id = $db->lastInsertId();
                                    sitebildirim("Yeni üyelik.", "fa fa-user", $last_id, $adsoyad, "sisteme üye oldu");
                                    if ($sablon["sbildirim"] == "1") {
                                        $uyesmssablon = $sablon["icerik3"];
                                        smsgonder($gelendegisken, $gidendegisken, $uyesmssablon, $telefon, $uyesmssablon);
                                    }
                                    if ($sablon["ysbildirim"] == "1") {
                                        $adminsmssablon = $sablon["icerik4"];
                                        smsgonder($gelendegisken, $gidendegisken, $adminsmssablon, sms_kime, $adminsmssablon);
                                    }
                                    if ($sablon["ubildirim"] == "1") {
                                        $uyekonu = turkce($sablon["konu"]);
                                        $uyesablon = $sablon["icerik"];
                                        mailgonder($gelendegisken, $gidendegisken, $uyesablon, $email, " " . $uyekonu . "", $uyesablon);
                                    }
                                    if ($sablon["abildirim"] == "1") {
                                        $adminkonu = turkce($sablon["konu2"]);
                                        $adminsablon = $sablon["icerik2"];
                                        mailgonder($gelendegisken, $gidendegisken, $adminsablon, m_kime, " " . $adminkonu . "", $adminsablon);
                                    }
                                    $UyeSorgu = $db->prepare("SELECT * FROM uyeler WHERE email = ? AND sifre = ?");
                                    $UyeSorgu->execute([$email, $sifre]);
                                    $UyuSonuc = $UyeSorgu->fetch(PDO::FETCH_ASSOC);
                                    $_SESSION["site_uyeid"] = $UyuSonuc["id"];
                                    $_SESSION["site_adsoyad"] = $UyuSonuc["adsoyad"];
                                    $_SESSION["site_email"] = $UyuSonuc["email"];
                                    $_SESSION["site_sifre"] = $UyuSonuc["sifre"];
                                    $_SESSION["uyelik"] = "yes";
                                    unset($_SESSION["uyebilgi"]);
                                    header("Location:../" . $htc["hesabimurl"] . $html . "");
                                } else {
                                    $_SESSION["uyelik"] = "no";
                                    header("Location:../" . $htc["hesapolustururl"] . $html . "");
                                }
                            } else {
                                $_SESSION["uyelik"] = "kayitli";
                                header("Location:../" . $htc["hesapolustururl"] . $html . "");
                            }
                        }
                    }
                }
            } else {
                $_SESSION["sitedemo"] = "no";
                header("Location:../" . $htc["hesapolustururl"] . $html . "");
            }
        }
    }
    if ($_GET["giris-kontrol"] == "ok") {
        if (isset($_SESSION["site_email"])) {
            header("Location:../" . $htc["odemeurl"] . $html . "");
        } else {
            if ($moduller["alan18"] == "0") {
                header("Location:../" . $htc["odemeurl"] . $html . "");
            } else {
                $_SESSION["devam"] = true;
                header("Location:../" . $htc["girisyapurl"] . $html . "");
            }
        }
    }
    if (isset($_POST["mesajbtn"])) {
        $iletisimurl = nl2br(strip_tags($_POST["iletisimurl"], "<b><p><i>"));
        if (isset($_POST["g-recaptcha-response"])) {
            $captcha = $_POST["g-recaptcha-response"];
        }
        if (!$captcha) {
            $_SESSION["mesajbtn"] = "bos";
            header("Location:" . $iletisimurl . "");
            exit;
        }
        $kontrol = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $ayar["rcaptha"] . "&response=" . $captcha . "&remoteip=" . $_SERVER["REMOTE_ADDR"]);
        if (!($kontrol . success)) {
            $_SESSION["mesajbtn"] = "bos";
            header("Location:" . $iletisimurl . "");
        } else {
            $isim = nl2br(strip_tags($_POST["isim"], "<b><p><i>"));
            $email = nl2br(strip_tags($_POST["email"], "<b><p><i>"));
            $konu = nl2br(strip_tags($_POST["konu"], "<b><p><i>"));
            $telefon = nl2br(strip_tags($_POST["telefon"], "<b><p><i>"));
            $mesaj = nl2br(strip_tags($_POST["mesaj"], "<b><p><i>"));
            $iletisimurl = nl2br(strip_tags($_POST["iletisimurl"], "<b><p><i>"));
            $tarih = tr_tarih("Y-m-d H:i:s");
            $bgntarih = tr_tarih("Y-m-d");
            $buguntarih = strtotime($bgntarih);
            $ip = ip();
            if ($ayar["demo"] == 0) {
                if (0 < strlen($_POST["kontrol"])) {
                    header("Location:" . $iletisimurl . "");
                    exit;
                }
                $sablon = $db->query("SELECT * FROM bildirim_sablonu WHERE id = '1'")->fetch(PDO::FETCH_ASSOC);
                $gelendegisken = explode(",", $sablon["degiskenler"]);
                $yenitarih = tarih($tarih);
                $gidendegisken = [$isim, $konu, $email, $telefon, $mesaj, $yenitarih, $ip, $logo, $domain_bilgi];
                if (empty($isim) || empty($email) || empty($mesaj)) {
                    $_SESSION["mesajbtn"] = "bos";
                    header("Location:" . $iletisimurl . "");
                } else {
                    $sorgu = $db->prepare("INSERT INTO mesajlar SET\r\n\t\t\t\tisim\t\t= :isim,\r\n\t\t\t\temail \t\t= :email,\r\n\t\t\t\tkonu \t\t= :konu,\r\n\t\t\t\ttelefon \t= :telefon,\r\n\t\t\t\tmesaj\t\t= :mesaj,\r\n\t\t\t\tip\t\t\t= :ip,\r\n\t\t\t\ttarih\t\t= :tarih,\r\n\t\t\t\tbuguntarih \t= :buguntarih");
                    $Ekle = $sorgu->execute(["isim" => $isim, "email" => $email, "konu" => $konu, "telefon" => $telefon, "mesaj" => $mesaj, "ip" => $ip, "tarih" => $tarih, "buguntarih" => $buguntarih]);
                    if ($Ekle) {
                        $last_id = $db->lastInsertId();
                        sitebildirim("Yeni Mesaj", "icon-envelope-open", $last_id, $isim, "mesaj gönderdi.");
                        if ($sablon["sbildirim"] == "1") {
                            $uyesmssablon = $sablon["icerik3"];
                            smsgonder($gelendegisken, $gidendegisken, $uyesmssablon, $telefon, $uyesmssablon);
                        }
                        if ($sablon["ysbildirim"] == "1") {
                            $adminsmssablon = $sablon["icerik4"];
                            smsgonder($gelendegisken, $gidendegisken, $adminsmssablon, sms_kime, $adminsmssablon);
                        }
                        if ($sablon["ubildirim"] == "1") {
                            $uyekonu = turkce($sablon["konu"]);
                            $uyesablon = $sablon["icerik"];
                            mailgonder($gelendegisken, $gidendegisken, $uyesablon, $email, " " . $uyekonu . "", $uyesablon);
                        }
                        if ($sablon["abildirim"] == "1") {
                            $adminkonu = turkce($sablon["konu2"]);
                            $adminsablon = $sablon["icerik2"];
                            mailgonder($gelendegisken, $gidendegisken, $adminsablon, m_kime, " " . $adminkonu . "", $adminsablon);
                        }
                        $_SESSION["mesajbtn"] = "yes";
                        header("Location:" . $iletisimurl . "");
                    } else {
                        $_SESSION["mesajbtn"] = "no";
                        header("Location:" . $iletisimurl . "");
                    }
                }
            } else {
                $_SESSION["sitedemo"] = "no";
                header("Location:" . $iletisimurl . "");
            }
        }
    }
    if (isset($_POST["ikbtn"])) {
        if (isset($_POST["g-recaptcha-response"])) {
            $captcha = $_POST["g-recaptcha-response"];
        }
        if (!$captcha) {
            $_SESSION["ikbtn"] = "no";
            header("Location:../" . $htc["ikurl"] . $html . "");
            exit;
        }
        $kontrol = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $ayar["rcaptha"] . "&response=" . $captcha . "&remoteip=" . $_SERVER["REMOTE_ADDR"]);
        if (!($kontrol . success)) {
            $_SESSION["ikbtn"] = "no";
            header("Location:../" . $htc["ikurl"] . $html . "");
        } else {
            $isim = nl2br(strip_tags($_POST["isim"], "<b><p><i>"));
            $email = nl2br(strip_tags($_POST["email"], "<b><p><i>"));
            $telefon = nl2br(strip_tags($_POST["telefon"], "<b><p><i>"));
            $mesaj = nl2br(strip_tags($_POST["mesaj"], "<b><p><i>"));
            $tc = nl2br(strip_tags($_POST["tc"], "<b><p><i>"));
            $durum = "0";
            $ip = ip();
            $tarih = tr_tarih("Y-m-d H:i:s");
            if ($ayar["demo"] == 0) {
                if (0 < strlen($_POST["kontrol"])) {
                    header("Location:../" . $htc["ikurl"] . $html . "");
                    exit;
                }
                $upload = new upload($_FILES["cv_dosya"]);
                if ($upload->uploaded) {
                    $upload->file_auto_rename = true;
                    $upload->process("../" . tema . "/uploads/ik");
                    if ($upload->processed) {
                        $Dosya = "" . $upload->file_dst_name . "";
                    }
                }
                $Dosya = "" . $upload->file_dst_name . "";
                $cv = url . tema . "/uploads/ik/" . $Dosya;
                $sablon = $db->query("SELECT * FROM bildirim_sablonu WHERE id = '12'")->fetch(PDO::FETCH_ASSOC);
                $gelendegisken = explode(",", $sablon["degiskenler"]);
                $yenitarih = tarih($tarih);
                $gidendegisken = [$isim, $email, $telefon, $ip, $yenitarih, $logo, $domain_bilgi, $mesaj, $tc, $cv];
                if (empty($isim) || empty($email) || empty($telefon)) {
                    $_SESSION["ikbtn"] = "bos";
                    header("Location:../" . $htc["ikurl"] . $html . "");
                } else {
                    $sorgu = $db->prepare("INSERT INTO ik SET\r\n\t\t\t\tisim\t\t= :isim,\r\n\t\t\t\temail \t\t= :email,\r\n\t\t\t\tdurum \t\t= :durum,\r\n\t\t\t\ttelefon \t= :telefon,\r\n\t\t\t\tmesaj \t\t= :mesaj,\r\n\t\t\t\ttc \t\t\t= :tc,\r\n\t\t\t\tcv_dosya\t= :cv_dosya,\r\n\t\t\t\tip\t\t\t= :ip,\r\n\t\t\t\ttarih\t \t= :tarih");
                    $Ekle = $sorgu->execute(["isim" => $isim, "email" => $email, "durum" => $durum, "telefon" => $telefon, "mesaj" => $mesaj, "tc" => $tc, "cv_dosya" => $cv, "ip" => $ip, "tarih" => $tarih]);
                    if ($Ekle) {
                        $last_id = $db->lastInsertId();
                        sitebildirim("Yeni İnsan Kaynakları", "icon-envelope-open", $last_id, $isim, "İ.K. Başvuru");
                        if ($sablon["sbildirim"] == "1") {
                            $uyesmssablon = $sablon["icerik3"];
                            smsgonder($gelendegisken, $gidendegisken, $uyesmssablon, $telefon, $uyesmssablon);
                        }
                        if ($sablon["ysbildirim"] == "1") {
                            $adminsmssablon = $sablon["icerik4"];
                            smsgonder($gelendegisken, $gidendegisken, $adminsmssablon, sms_kime, $adminsmssablon);
                        }
                        if ($sablon["ubildirim"] == "1") {
                            $uyekonu = turkce($sablon["konu"]);
                            $uyesablon = $sablon["icerik"];
                            mailgonder($gelendegisken, $gidendegisken, $uyesablon, $email, " " . $uyekonu . "", $uyesablon);
                        }
                        if ($sablon["abildirim"] == "1") {
                            $adminkonu = turkce($sablon["konu2"]);
                            $adminsablon = $sablon["icerik2"];
                            mailgonder($gelendegisken, $gidendegisken, $adminsablon, m_kime, " " . $adminkonu . "", $adminsablon);
                        }
                        $_SESSION["ikbtn"] = "yes";
                        header("Location:../" . $htc["ikurl"] . $html . "");
                    } else {
                        $_SESSION["ikbtn"] = "no";
                        header("Location:../" . $htc["ikurl"] . $html . "");
                    }
                }
            } else {
                $_SESSION["sitedemo"] = "no";
                header("Location:../" . $htc["ikurl"] . $html . "");
            }
        }
    }
    if (isset($_POST["ebultenbtn"])) {
        $email = nl2br(strip_tags($_POST["email"], "<b><p><i>"));
        $donus_url = nl2br(strip_tags($_POST["donus_url"], "<b><p><i>"));
        $tarih = tr_tarih("Y-m-d H:i:s");
        $ip = ip();
        if ($ayar["demo"] == 0) {
            if (0 < strlen($_POST["kontrol"])) {
                header("Location:" . $donus_url . "");
                exit;
            }
            $sablon = $db->query("SELECT * FROM bildirim_sablonu WHERE id = '16'")->fetch(PDO::FETCH_ASSOC);
            $gelendegisken = explode(",", $sablon["degiskenler"]);
            $yenitarih = tarih($tarih);
            $gidendegisken = [$email, $yenitarih, $ip, $logo, $domain_bilgi];
            if (empty($email)) {
                $_SESSION["ebultenbtn"] = "bos";
                header("Location:" . $donus_url . "");
            } else {
                $sorgu = $db->prepare("INSERT INTO ebulten SET\r\n\t\t\t\temail \t\t= :email,\r\n\t\t\t\tip\t\t\t= :ip,\r\n\t\t\t\ttarih\t\t= :tarih");
                $Ekle = $sorgu->execute(["email" => $email, "ip" => $ip, "tarih" => $tarih]);
                if ($Ekle) {
                    $last_id = $db->lastInsertId();
                    sitebildirim("Yeni E-Bülten Kaydı", "icon-envelope-open", $last_id, $isim, "e-bülten kaydı gönderdi.");
                    if ($sablon["ysbildirim"] == "1") {
                        $adminsmssablon = $sablon["icerik4"];
                        smsgonder($gelendegisken, $gidendegisken, $adminsmssablon, sms_kime, $adminsmssablon);
                    }
                    if ($sablon["ubildirim"] == "1") {
                        $uyekonu = turkce($sablon["konu"]);
                        $uyesablon = $sablon["icerik"];
                        mailgonder($gelendegisken, $gidendegisken, $uyesablon, $email, " " . $uyekonu . "", $uyesablon);
                    }
                    if ($sablon["abildirim"] == "1") {
                        $adminkonu = turkce($sablon["konu2"]);
                        $adminsablon = $sablon["icerik2"];
                        mailgonder($gelendegisken, $gidendegisken, $adminsablon, m_kime, " " . $adminkonu . "", $adminsablon);
                    }
                    $_SESSION["ebultenbtn"] = "yes";
                    header("Location:" . $donus_url . "");
                } else {
                    $_SESSION["ebultenbtn"] = "no";
                    header("Location:" . $donus_url . "");
                }
            }
        } else {
            $_SESSION["sitedemo"] = "no";
            header("Location:" . $donus_url . "");
        }
    }
    if (isset($_POST["panel_bilgi_guncelle"])) {
        if ($ayar["demo"] == 0) {
            $adsoyad = nl2br(strip_tags($_POST["adsoyad"], "<b><p><i>"));
            $email = nl2br(strip_tags($_POST["email"], "<b><p><i>"));
            $telefon = nl2br(strip_tags($_POST["telefon"], "<b><p><i>"));
            $il = nl2br(strip_tags($_POST["il"], "<b><p><i>"));
            $ilce = nl2br(strip_tags($_POST["ilce"], "<b><p><i>"));
            $gorev = nl2br(strip_tags($_POST["gorev"], "<b><p><i>"));
            $adres = $_POST["adres"];
            $sifre = $_POST["sifre"];
            $sifret = $_POST["sifret"];
            $email_bildirim = $_POST["email_bildirim"];
            $sms_bildirim = $_POST["sms_bildirim"];
            $id = $_SESSION["site_uyeid"];
            $upload = new upload($_FILES["profil"]);
            if ($upload->uploaded) {
                $upload->file_auto_rename = true;
                $upload->process("../" . tema . "/uploads/uyeler");
                if ($upload->processed) {
                    $profil = "" . $upload->file_dst_name . "";
                }
            }
            $upload = new upload($_FILES["resim"]);
            if ($upload->uploaded) {
                $upload->file_auto_rename = true;
                $upload->process("../" . tema . "/uploads/uyeler");
                if ($upload->processed) {
                    $Resim = "" . $upload->file_dst_name . "";
                }
            }
            if (isset($Resim)) {
                $resim_bul = $db->query("SELECT * FROM uyeler WHERE id = '" . $id . "'")->fetch(PDO::FETCH_ASSOC);
                unlink("../" . tema . "/uploads/uyeler/" . $resim_bul["resim"]);
                $guncelle = $db->prepare("UPDATE uyeler SET resim = ? WHERE id = ?");
                $guncelle->execute([$Resim, $id]);
                $Resim = "" . $upload->file_dst_name . "";
            }
            if (isset($profil)) {
                $resim_bul = $db->query("SELECT * FROM uyeler WHERE id = '" . $id . "'")->fetch(PDO::FETCH_ASSOC);
                unlink("../" . tema . "/uploads/uyeler/" . $resim_bul["profil"]);
                $guncelle = $db->prepare("UPDATE uyeler SET profil = ? WHERE id = ?");
                $guncelle->execute([$profil, $id]);
                $profil = "" . $upload->file_dst_name . "";
            }
            if (empty($adsoyad) || empty($email) || empty($telefon)) {
                $_SESSION["panel_bilgi_guncelle"] = "bos";
                header("Location:../" . $htc["hesabimurl"] . $html . "");
            } else {
                if ($_POST["sifre"] != "") {
                    if ($sifre != $sifret) {
                        $_SESSION["panel_bilgi_guncelle"] = "sifre";
                        header("Location:../" . $htc["hesabimurl"] . $html . "");
                    } else {
                        $Sorgu = $db->prepare("UPDATE uyeler SET\r\n\t\t\t\t\t\tgorev \t\t\t= ?,\r\n\t\t\t\t\t\tadsoyad \t\t= ?,\r\n\t\t\t\t\t\til \t\t\t\t= ?,\r\n\t\t\t\t\t\tilce \t\t\t= ?,\r\n\t\t\t\t\t\tadres \t\t\t= ?,\t\r\n\t\t\t\t\t\tsifre \t\t\t= ?,\r\n\t\t\t\t\t\temail \t\t\t= ?,\r\n\t\t\t\t\t\temail_bildirim \t= ?,\r\n\t\t\t\t\t\tsms_bildirim \t= ?,\r\n\t\t\t\t\t\ttelefon \t\t= ?\r\n\t\t\t\t\t\tWHERE id \t\t= ?");
                        $guncelle = $Sorgu->execute([$gorev, $adsoyad, $il, $ilce, $adres, $sifre, $email, $email_bildirim, $sms_bildirim, $telefon, $_SESSION["site_uyeid"]]);
                        if ($guncelle) {
                            $_SESSION["panel_bilgi_guncelle"] = "yes";
                            header("Location:../" . $htc["hesabimurl"] . $html . "");
                        } else {
                            $_SESSION["panel_bilgi_guncelle"] = "no";
                            header("Location:../" . $htc["hesabimurl"] . $html . "");
                        }
                    }
                } else {
                    $Sorgu = $db->prepare("UPDATE uyeler SET\r\n\t\t\t\tgorev \t\t\t= ?,\r\n\t\t\t\tadsoyad \t\t= ?,\r\n\t\t\t\til \t\t\t\t= ?,\r\n\t\t\t\tilce \t\t\t= ?,\r\n\t\t\t\tadres \t\t\t= ?,\t\t\t\t\r\n\t\t\t\temail \t\t\t= ?,\r\n\t\t\t\temail_bildirim \t= ?,\r\n\t\t\t\tsms_bildirim \t= ?,\r\n\t\t\t\ttelefon \t\t= ?\r\n\t\t\t\tWHERE id \t\t= ?");
                    $guncelle = $Sorgu->execute([$gorev, $adsoyad, $il, $ilce, $adres, $email, $email_bildirim, $sms_bildirim, $telefon, $_SESSION["site_uyeid"]]);
                    if ($guncelle) {
                        $_SESSION["panel_bilgi_guncelle"] = "yes";
                        header("Location:../" . $htc["hesabimurl"] . $html . "");
                    } else {
                        $_SESSION["panel_bilgi_guncelle"] = "no";
                        header("Location:../" . $htc["hesabimurl"] . $html . "");
                    }
                }
            }
        } else {
            $_SESSION["sitedemo"] = "no";
            header("Location:../" . $htc["hesabimurl"] . $html . "");
        }
    }
    if (isset($_POST["yorumbtn"])) {
        $yorumurl = nl2br(strip_tags($_POST["yorumurl"], "<b><p><i>"));
        if (isset($_POST["g-recaptcha-response"])) {
            $captcha = $_POST["g-recaptcha-response"];
        }
        if (!$captcha) {
            $_SESSION["yorumbtn"] = "bos";
            header("Location:" . $yorumurl . "");
            exit;
        }
        $kontrol = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $ayar["rcaptha"] . "&response=" . $captcha . "&remoteip=" . $_SERVER["REMOTE_ADDR"]);
        if (!($kontrol . success)) {
            $_SESSION["yorumbtn"] = "bos";
            header("Location:" . $yorumurl . "");
        } else {
            $isim = nl2br(strip_tags($_POST["isim"], "<b><p><i>"));
            $meslek = nl2br(strip_tags($_POST["meslek"], "<b><p><i>"));
            $sehir = nl2br(strip_tags($_POST["sehir"], "<b><p><i>"));
            $yorum = nl2br(strip_tags($_POST["yorum"], "<b><p><i>"));
            $yorumurl = nl2br(strip_tags($_POST["yorumurl"], "<b><p><i>"));
            $ip = ip();
            $tarih = tr_tarih(date("Y-m-d H:i:s"));
            if ($ayar["demo"] == 0) {
                if (0 < strlen($_POST["kontrol"])) {
                    header("Location:" . $yorumurl . "");
                    exit;
                }
                $sablon = $db->query("SELECT * FROM bildirim_sablonu WHERE id = '9'")->fetch(PDO::FETCH_ASSOC);
                $gelendegisken = explode(",", $sablon["degiskenler"]);
                $yenitarih = tarih($tarih);
                $gidendegisken = [$isim, $yenitarih, $ip, $yorum, $logo, $domain_bilgi];
                if (empty($isim) || empty($yorum)) {
                    $_SESSION["yorumbtn"] = "bos";
                    header("Location:" . $yorumurl . "");
                    exit;
                }
                $sorgu = $db->prepare("INSERT INTO musteri_gorusleri SET\r\n\t\t\t\t\tisim\t= :isim,\r\n\t\t\t\t\tmeslek \t= :meslek,\r\n\t\t\t\t\tyorum \t= :yorum,\r\n\t\t\t\t\tsehir \t= :sehir,\r\n\t\t\t\t\tip \t\t= :ip,\r\n\t\t\t\t\ttarih \t= :tarih");
                $Ekle = $sorgu->execute(["isim" => $isim, "meslek" => $meslek, "yorum" => $yorum, "sehir" => $sehir, "ip" => $ip, "tarih" => $tarih]);
                if ($Ekle) {
                    $last_id = $db->lastInsertId();
                    sitebildirim("Yeni Müşteri Görüşü", "icon-bubbles", $last_id, $isim, "müşteri görüşü gönderdi.");
                    if ($sablon["ysbildirim"] == "1") {
                        $adminsmssablon = $sablon["icerik4"];
                        smsgonder($gelendegisken, $gidendegisken, $adminsmssablon, sms_kime, $adminsmssablon);
                    }
                    if ($sablon["abildirim"] == "1") {
                        $adminkonu = turkce($sablon["konu2"]);
                        $adminsablon = $sablon["icerik2"];
                        mailgonder($gelendegisken, $gidendegisken, $adminsablon, m_kime, " " . $adminkonu . "", $adminsablon);
                    }
                    $_SESSION["yorumbtn"] = "yes";
                    header("Location:" . $yorumurl . "");
                    exit;
                }
                $_SESSION["yorumbtn"] = "no";
                header("Location:" . $yorumurl . "");
                exit;
            }
            $_SESSION["sitedemo"] = "no";
            header("Location:" . $yorumurl . "");
            exit;
        }
    }
    if ($_GET["cikis"] == "ok") {
        unset($_SESSION["site_uyeid"]);
        unset($_SESSION["site_email"]);
        unset($_SESSION["site_sifre"]);
        unset($_SESSION["site_adsoyad"]);
        unset($_SESSION["devam"]);
        unset($_SESSION["giristoken"]);
        header("Location:../" . $htc["anaurl"] . $html . "");
    }
}

?>