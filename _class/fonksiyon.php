<?php


require_once "baglan.php";

function ip()
{
    if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    } else {
        if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }
    }
    return $ip;
}
function getBrowser()
{
    $u_agent = $_SERVER["HTTP_USER_AGENT"];
    $bname = "Bilinmiyor";
    $platform = "Bilinmiyor";
    $version = "";
    if (preg_match("/linux/i", $u_agent)) {
        $platform = "linux";
    } else {
        if (preg_match("/macintosh|mac os x/i", $u_agent)) {
            $platform = "mac";
        } else {
            if (preg_match("/windows|win32/i", $u_agent)) {
                $platform = "windows";
            }
        }
    }
    if (preg_match("/MSIE/i", $u_agent) && !preg_match("/Opera/i", $u_agent)) {
        $bname = "Internet Explorer";
        $ub = "MSIE";
    } else {
        if (preg_match("/Firefox/i", $u_agent)) {
            $bname = "Mozilla Firefox";
            $ub = "Firefox";
        } else {
            if (preg_match("/Chrome/i", $u_agent)) {
                $bname = "Google Chrome";
                $ub = "Chrome";
            } else {
                if (preg_match("/Safari/i", $u_agent)) {
                    $bname = "Apple Safari";
                    $ub = "Safari";
                } else {
                    if (preg_match("/Opera/i", $u_agent)) {
                        $bname = "Opera";
                        $ub = "Opera";
                    } else {
                        if (preg_match("/Netscape/i", $u_agent)) {
                            $bname = "Netscape";
                            $ub = "Netscape";
                        }
                    }
                }
            }
        }
    }
    $known = ["Version", $ub, "other"];
    $pattern = "#(?<browser>" . join("|", $known) . ")[/ ]+(?<version>[0-9.|a-zA-Z.]*)#";
    if (!preg_match_all($pattern, $u_agent, $matches)) {
    }
    $i = count($matches["browser"]);
    if ($i != 1) {
        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version = $matches["version"][0];
        } else {
            $version = $matches["version"][1];
        }
    } else {
        $version = $matches["version"][0];
    }
    if ($version == NULL || $version == "") {
        $version = "?";
    }
    return ["userAgent" => $u_agent, "name" => $bname, "version" => $version, "platform" => $platform, "pattern" => $pattern];
}
function icon($s)
{
    $tr = ["<i class=\"", "\"></i>"];
    $en = ["", ""];
    $s = str_replace($tr, $en, $s);
    return $s;
}
function seo($str, $options = [])
{
    $str = mb_convert_encoding((string) $str, "UTF-8", mb_list_encodings());
    $defaults = ["delimiter" => "-", "limit" => NULL, "lowercase" => true, "transliterate" => true];
    $options = array_merge($defaults, $options);
    $dmr = $defaults["delimiter"];
    $char_map = [""];
    if ($options["transliterate"]) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }
    $str = preg_replace("/[^\\p{L}\\p{Nd}]+/u", $options["delimiter"], $str);
    $str = preg_replace("/(" . preg_quote($options["delimiter"], "/") . "){2,}/", "\$1", $str);
    $str = mb_substr($str, 0, $options["limit"] ? $options["limit"] : mb_strlen($str, "UTF-8"), "UTF-8");
    $str = trim($str, $options["delimiter"]);
    return $options["lowercase"] ? mb_strtolower($str, "UTF-8") : $str;
}
function turkce($s)
{
    $tr = ["ş", "Ş", "ı", "İ", "ğ", "Ğ", "ü", "Ü", "ö", "Ö", "ç", "Ç"];
    $en = ["s", "S", "i", "I", "g", "G", "u", "U", "o", "O", "c", "C"];
    $s = str_replace($tr, $en, $s);
    return $s;
}
function kisa($metin, $uzunluk = 50)
{
    if ($uzunluk < strlen($metin)) {
        $metin = mb_substr($metin, 0, $uzunluk) . "...";
        $metin_son = strrchr($metin, " ");
        $metin = str_replace($metin_son, " ...", $metin);
    }
    return strip_tags($metin);
}
function kisa2($metin, $uzunluk = 50)
{
    if ($uzunluk < strlen($metin)) {
        $metin = substr($metin, 0, $uzunluk) . "...";
        $metin_son = strrchr($metin, " ");
        $metin = str_replace($metin_son, " ...", $metin);
    }
    return strip_tags($metin);
}
function tarih_panel($par)
{
    $explode = explode(" ", $par);
    $explode2 = explode("-", $explode[0]);
    $zaman = substr($explode[1], 0, 5);
    if ($explode2[1] == "01") {
        $ay = "Ocak";
    } else {
        if ($explode2[1] == "02") {
            $ay = "Şubat";
        } else {
            if ($explode2[1] == "03") {
                $ay = "Mart";
            } else {
                if ($explode2[1] == "04") {
                    $ay = "Nisan";
                } else {
                    if ($explode2[1] == "05") {
                        $ay = "Mayıs";
                    } else {
                        if ($explode2[1] == "06") {
                            $ay = "Haziran";
                        } else {
                            if ($explode2[1] == "07") {
                                $ay = "Temmuz";
                            } else {
                                if ($explode2[1] == "08") {
                                    $ay = "Ağustos";
                                } else {
                                    if ($explode2[1] == "09") {
                                        $ay = "Eylül";
                                    } else {
                                        if ($explode2[1] == "10") {
                                            $ay = "Ekim";
                                        } else {
                                            if ($explode2[1] == "11") {
                                                $ay = "Kasım";
                                            } else {
                                                if ($explode2[1] == "12") {
                                                    $ay = "Aralık";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    return $explode2[2] . " " . $ay . " " . $explode2[0] . ", " . $zaman;
}
function tarih($par)
{
    global $dil;
    $explode = explode(" ", $par);
    $explode2 = explode("-", $explode[0]);
    $zaman = substr($explode[1], 0, 5);
    if ($explode2[1] == "01") {
        $ay = $dil["txt197"];
    } else {
        if ($explode2[1] == "02") {
            $ay = $dil["txt198"];
        } else {
            if ($explode2[1] == "03") {
                $ay = $dil["txt199"];
            } else {
                if ($explode2[1] == "04") {
                    $ay = $dil["txt200"];
                } else {
                    if ($explode2[1] == "05") {
                        $ay = $dil["txt201"];
                    } else {
                        if ($explode2[1] == "06") {
                            $ay = $dil["txt202"];
                        } else {
                            if ($explode2[1] == "07") {
                                $ay = $dil["txt203"];
                            } else {
                                if ($explode2[1] == "08") {
                                    $ay = $dil["txt204"];
                                } else {
                                    if ($explode2[1] == "09") {
                                        $ay = $dil["txt205"];
                                    } else {
                                        if ($explode2[1] == "10") {
                                            $ay = $dil["txt206"];
                                        } else {
                                            if ($explode2[1] == "11") {
                                                $ay = $dil["txt207"];
                                            } else {
                                                if ($explode2[1] == "12") {
                                                    $ay = $dil["txt208"];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    return $explode2[2] . " " . $ay . " " . $explode2[0] . ", " . $zaman;
}
function tarih2($par)
{
    global $dil;
    $explode = explode(" ", $par);
    $explode2 = explode("-", $explode[0]);
    $zaman = substr($explode[1], 0, 5);
    if ($explode2[1] == "01") {
        $ay = $dil["txt197"];
    } else {
        if ($explode2[1] == "02") {
            $ay = $dil["txt198"];
        } else {
            if ($explode2[1] == "03") {
                $ay = $dil["txt199"];
            } else {
                if ($explode2[1] == "04") {
                    $ay = $dil["txt200"];
                } else {
                    if ($explode2[1] == "05") {
                        $ay = $dil["txt201"];
                    } else {
                        if ($explode2[1] == "06") {
                            $ay = $dil["txt202"];
                        } else {
                            if ($explode2[1] == "07") {
                                $ay = $dil["txt203"];
                            } else {
                                if ($explode2[1] == "08") {
                                    $ay = $dil["txt204"];
                                } else {
                                    if ($explode2[1] == "09") {
                                        $ay = $dil["txt205"];
                                    } else {
                                        if ($explode2[1] == "10") {
                                            $ay = $dil["txt206"];
                                        } else {
                                            if ($explode2[1] == "11") {
                                                $ay = $dil["txt207"];
                                            } else {
                                                if ($explode2[1] == "12") {
                                                    $ay = $dil["txt208"];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    return $explode2[0] . " " . $ay . " " . $explode2[2] . ", " . $zaman;
}
function tarih_ay($par)
{
    global $dil;
    $explode = explode(" ", $par);
    $explode2 = explode("-", $explode[0]);
    if ($explode2[1] == "01") {
        $ay = $dil["txt209"];
    } else {
        if ($explode2[1] == "02") {
            $ay = $dil["txt210"];
        } else {
            if ($explode2[1] == "03") {
                $ay = $dil["txt211"];
            } else {
                if ($explode2[1] == "04") {
                    $ay = $dil["txt212"];
                } else {
                    if ($explode2[1] == "05") {
                        $ay = $dil["txt213"];
                    } else {
                        if ($explode2[1] == "06") {
                            $ay = $dil["txt214"];
                        } else {
                            if ($explode2[1] == "07") {
                                $ay = $dil["txt215"];
                            } else {
                                if ($explode2[1] == "08") {
                                    $ay = $dil["txt216"];
                                } else {
                                    if ($explode2[1] == "09") {
                                        $ay = $dil["txt217"];
                                    } else {
                                        if ($explode2[1] == "10") {
                                            $ay = $dil["txt218"];
                                        } else {
                                            if ($explode2[1] == "11") {
                                                $ay = $dil["txt219"];
                                            } else {
                                                if ($explode2[1] == "12") {
                                                    $ay = $dil["txt210"];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    return $ay;
}
function ay_yil($par)
{
    global $dil;
    $explode = explode("/", $par);
    if ($explode[1] == "01") {
        $ay = $dil["txt197"];
    } else {
        if ($explode[1] == "02") {
            $ay = $dil["txt198"];
        } else {
            if ($explode[1] == "03") {
                $ay = $dil["txt199"];
            } else {
                if ($explode[1] == "04") {
                    $ay = $dil["txt200"];
                } else {
                    if ($explode[1] == "05") {
                        $ay = $dil["txt201"];
                    } else {
                        if ($explode[1] == "06") {
                            $ay = $dil["txt202"];
                        } else {
                            if ($explode[1] == "07") {
                                $ay = $dil["txt203"];
                            } else {
                                if ($explode[1] == "08") {
                                    $ay = $dil["txt204"];
                                } else {
                                    if ($explode[1] == "09") {
                                        $ay = $dil["txt205"];
                                    } else {
                                        if ($explode[1] == "10") {
                                            $ay = $dil["txt206"];
                                        } else {
                                            if ($explode[1] == "11") {
                                                $ay = $dil["txt207"];
                                            } else {
                                                if ($explode[1] == "12") {
                                                    $ay = $dil["txt208"];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    return $ay . " " . $explode[2];
}
function ay_yil_panel($par)
{
    $explode = explode("/", $par);
    if ($explode[1] == "01") {
        $ay = "Ocak";
    } else {
        if ($explode[1] == "02") {
            $ay = "Şubat";
        } else {
            if ($explode[1] == "03") {
                $ay = "Mart";
            } else {
                if ($explode[1] == "04") {
                    $ay = "Nisan";
                } else {
                    if ($explode[1] == "05") {
                        $ay = "Mayıs";
                    } else {
                        if ($explode[1] == "06") {
                            $ay = "Haziran";
                        } else {
                            if ($explode[1] == "07") {
                                $ay = "Temmuz";
                            } else {
                                if ($explode[1] == "08") {
                                    $ay = "Ağustos";
                                } else {
                                    if ($explode[1] == "09") {
                                        $ay = "Eylül";
                                    } else {
                                        if ($explode[1] == "10") {
                                            $ay = "Ekim";
                                        } else {
                                            if ($explode[1] == "11") {
                                                $ay = "Kasım";
                                            } else {
                                                if ($explode[1] == "12") {
                                                    $ay = "Aralık";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    return $ay . " " . $explode[2];
}
function tarih_yil($par)
{
    $explode = explode(" ", $par);
    $explode2 = explode("-", $explode[0]);
    return $explode2[0];
}
function tarih_gun($par)
{
    $explode = explode(" ", $par);
    $explode2 = explode("-", $explode[0]);
    return $explode2[2];
}
function bot($a)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $a);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $isle = curl_exec($ch);
    curl_close($ch);
    return $isle;
}
function tr_tarih($tarih = "Y-m-d H:i:s")
{
    $zaman = new DateTime(date($tarih));
    $zaman->setTimeZone(new DateTimeZone("Europe/Istanbul"));
    return $zaman->format($tarih);
}
function tarihcevir($unixtime)
{
    return tarih_panel($time = date("Y-m-d H:i:s", $unixtime));
}
function unixtarih($unixtime)
{
    return date("d-m-Y H:i", $unixtime);
}
function tirnak($par)
{
    return str_replace(["'", "\""], ["&#39;", "&quot;"], $par);
}
function ilkbuyuk($str)
{
    $m_uzunluk = mb_strlen($str, "UTF-8");
    $ilkharf = mb_substr($str, 0, 1, "UTF-8");
    $kalan = mb_substr($str, 1, $m_uzunluk - 1, "UTF-8");
    $ilkharf = mb_strtoupper($ilkharf, "UTF-8");
    $kalan = mb_strtolower($kalan, "UTF-8");
    return $ilkharf . $kalan;
}
function buyuk($str)
{
    return mb_strtoupper($str, "UTF-8");
}
function kucuk($str)
{
    $str = strtr($str, "ĞŞIÖÜÇİ", "ğşıöüçi");
    return mb_strtolower($str, "UTF-8");
}
function tumu($str, $secenek = 1)
{
    global $db;
    if ($secenek == 1) {
        $tumu = $db->query("SELECT * FROM " . $str . " WHERE dil = '" . $_SESSION["admin_dil"] . "'")->rowCount();
    } else {
        if ($secenek == 2) {
            $tumu = $db->query("SELECT * FROM " . $str . " ")->rowCount();
        } else {
            if ($secenek == 3) {
                $tumu = $db->query("SELECT * FROM " . $str . " WHERE durum = '0'")->rowCount();
            }
        }
    }
    return $tumu;
}
function mesaj($deger1, $secenek = 1, $deger2, $mesaj)
{
    if ($secenek == 1 && $_SESSION[$deger1] == $deger2) {
        echo "\r\n\t\t\t<script>\r\n\t\t\t\t\$.toast({\r\n\t\t\t\t  heading: 'Başarılı!',\r\n\t\t\t\t  text: '" . $mesaj . "',\r\n\t\t\t\t  showHideTransition: 'slide',\r\n\t\t\t\t  icon: 'success',\r\n\t\t\t\t  loaderBg: '#fff',\r\n\t\t\t\t  position: 'top-right'\r\n\t\t\t\t})\r\n\t\t\t</script>";
        unset($_SESSION[$deger1]);
    }
    if ($secenek == 2 && $_SESSION[$deger1] == $deger2) {
        echo "\r\n\t\t\t<script>\r\n\t\t\t\t\$.toast({\r\n\t\t\t\t  heading: 'Hata!',\r\n\t\t\t\t  text: '" . $mesaj . "',\r\n\t\t\t\t  showHideTransition: 'slide',\r\n\t\t\t\t  icon: 'error',\r\n\t\t\t\t  loaderBg: '#fff',\r\n\t\t\t\t  position: 'top-right'\r\n\t\t\t\t})\r\n\t\t\t</script>";
        unset($_SESSION[$deger1]);
    }
    if ($secenek == 3 && $_SESSION[$deger1] == $deger2) {
        echo "\r\n\t\t\t<script>\r\n\t\t\t\t\$.toast({\r\n\t\t\t\t  heading: 'Uyarı!',\r\n\t\t\t\t  text: '" . $mesaj . "',\r\n\t\t\t\t  showHideTransition: 'slide',\r\n\t\t\t\t  icon: 'warning',\r\n\t\t\t\t  loaderBg: '#fff',\r\n\t\t\t\t  position: 'top-right'\r\n\t\t\t\t})\r\n\t\t\t</script>";
        unset($_SESSION[$deger1]);
    }
}
function site_mesaj($deger1, $secenek = 1, $deger2, $title, $mesaj, $tamam)
{
    if ($secenek == 1 && $_SESSION[$deger1] == $deger2) {
        echo "\r\n\t\t\t<script>\r\n\t\t\tswal({\r\n\t\t\t\ttype: 'success',\r\n\t\t\t\ttitle: '" . $title . "',\r\n\t\t\t\ttext: '" . $mesaj . "',\r\n\t\t\t\tconfirmButtonText: '" . $tamam . "',\r\n\t\t\t\ttimer: 5000\r\n\t\t\t})\r\n\t\t\t</script>";
        unset($_SESSION[$deger1]);
    }
    if ($secenek == 2 && $_SESSION[$deger1] == $deger2) {
        echo "\r\n\t\t\t<script>\r\n\t\t\tswal({\r\n\t\t\t\ttype: 'error',\r\n\t\t\t\ttitle: '" . $title . "',\r\n\t\t\t\ttext: '" . $mesaj . "',\r\n\t\t\t\tconfirmButtonText: '" . $tamam . "',\r\n\t\t\t\ttimer: 5000\r\n\t\t\t})\r\n\t\t\t</script>";
        unset($_SESSION[$deger1]);
    }
    if ($secenek == 3 && $_SESSION[$deger1] == $deger2) {
        echo "\r\n\t\t\t<script>\r\n\t\t\tswal({\r\n\t\t\t\ttype: 'warning',\r\n\t\t\t\ttitle: '" . $title . "',\r\n\t\t\t\ttext: '" . $mesaj . "',\r\n\t\t\t\tconfirmButtonText: '" . $tamam . "',\r\n\t\t\t\ttimer: 5000\r\n\t\t\t})\r\n\t\t\t</script>";
        unset($_SESSION[$deger1]);
    }
}
function kod($uzunluk = 8, $buyuk_harf = 1, $kucuk_harf = 1, $sayi_kullan = 1, $ozel_karakter = "")
{
    $buyukler = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $kucukler = "abcdefghijklmnopqrstuvwxyz";
    $sayilar = "0123456789";
    if ($buyuk_harf) {
        $seed_length += 26;
        $seed .= $buyukler;
    }
    if ($kucuk_harf) {
        $seed_length += 26;
        $seed .= $kucukler;
    }
    if ($sayi_kullan) {
        $seed_length += 10;
        $seed .= $sayilar;
    }
    if ($ozel_karakter) {
        $seed_length += strlen($ozel_karakter);
        $seed .= $ozel_karakter;
    }
    for ($x = 1; $x <= $uzunluk; $x++) {
        $sifre .= $seed[rand(0, $seed_length - 1)];
    }
    return $sifre;
}
function oturumgiris()
{
    if (isset($_SESSION["Yonetim_Id"]) || isset($_SESSION["Yonetim_Kadi"]) || isset($_SESSION["Yonetim_Sifre"]) || isset($_SESSION["rutbe"])) {
        header("Location:./");
        exit;
    }
}
function oturumkontrol($url)
{
    global $db;
    $oturumkontrol = $db->prepare("SELECT * FROM kullanici WHERE BINARY id = ? AND kadi = ? AND sifre = ? AND rutbe = ?");
    $oturumkontrol->execute([$_SESSION["Yonetim_Id"], $_SESSION["Yonetim_Kadi"], $_SESSION["Yonetim_Sifre"], $_SESSION["rutbe"]]);
    if (!$oturumkontrol->rowCount()) {
        unset($_SESSION["Yonetim_Id"]);
        unset($_SESSION["Yonetim_Kadi"]);
        unset($_SESSION["Yonetim_Sifre"]);
        unset($_SESSION["rutbe"]);
        unset($_SESSION["guvenlik"]);
        header("Location:" . $url . "/giris" . $html . "");
        exit;
    }
}
function bildirim($baslik, $ikon, $last_id, $menu_isim, $msj)
{
    global $db;
    $BSorgu = $db->prepare("INSERT INTO bildirimler SET\r\n\t\tbaslik\t\t= :baslik,\r\n\t\ticon\t\t= :icon,\r\n\t\tbid\t\t\t= :bid,\r\n\t\tbildirim\t= :bildirim,\r\n\t\tktarih\t\t= :ktarih,\r\n\t\ttarih \t\t= :tarih");
    $BEkle = $BSorgu->execute(["baslik" => $baslik, "icon" => $ikon, "bid" => $last_id, "bildirim" => "Yönetici <strong>" . $menu_isim . "</strong> " . $msj, "ktarih" => strtotime(tr_tarih("Y-m-d")), "tarih" => strtotime(tr_tarih("Y-m-d H:i:s"))]);
}
function sitebildirim($baslik, $ikon, $last_id, $menu_isim, $msj)
{
    global $db;
    $BSorgu = $db->prepare("INSERT INTO bildirimler SET\r\n\t\tbaslik\t\t= :baslik,\r\n\t\ticon\t\t= :icon,\r\n\t\tbid\t\t\t= :bid,\r\n\t\tbildirim\t= :bildirim,\r\n\t\tktarih\t\t= :ktarih,\r\n\t\ttarih \t\t= :tarih");
    $BEkle = $BSorgu->execute(["baslik" => $baslik, "icon" => $ikon, "bid" => $last_id, "bildirim" => "<strong>" . $menu_isim . "</strong> " . $msj, "ktarih" => strtotime(tr_tarih("Y-m-d")), "tarih" => strtotime(tr_tarih("Y-m-d H:i:s"))]);
}
function panelislemkontrol($deger = "")
{
    if (empty($_SESSION["Yonetim_Id"]) || empty($_SESSION["Yonetim_Kadi"]) || empty($_SESSION["Yonetim_Sifre"])) {
        header("Location:../" . yonetim . "/");
        exit;
    }
}

?>