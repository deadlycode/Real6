<?php define("GUVENLIK",true);?>
<!DOCTYPE html>
<?php
if($moduller['alan17'] == "1"){
	if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off")
	{
		$redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: ' . $redirect);
		exit();
	}
}
?>
<?php
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
$protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
$url=$protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER['PHP_SELF']);
$sayfalink = $protocol.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$dilsay		= $db->query("SELECT * FROM  diller")->rowCount();
$dilyaz  	= $db->query("SELECT * FROM diller WHERE id = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
?>
<?php include('pages/sayac.php');?>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo url; ?>">

    <!-- Tasarım Sistemi Token'ları ve Stiller -->
    <title><?php echo $title;?></title>
    <meta name="description" content="<?php echo $description;?>" />
    <meta name="keywords" content="<?php echo $keywords;?>" />

    <!-- Sosyal Medya Meta Etiketleri -->
    <meta property="og:title" content="<?php echo $title;?>" />
    <meta property="og:description" content="<?php echo $description;?>" />
    <meta property="og:url" content="<?php echo $sayfalink;?>" />
    <meta property="og:image" content="<?php echo $url;?><?php echo $paylasim;?>" />
    <meta property="og:image:height" content="300" />
    <meta property="og:image:width" content="573" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo tema;?>/uploads/favicon/<?php echo fav;?>" type="image/x-icon">
    <link rel="icon" href="<?php echo tema;?>/uploads/favicon/<?php echo fav;?>" type="image/x-icon">

    <!-- Tailwind CSS ve Fontlar -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">

    <!-- Ionicons (Modern İkon Seti) -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
      // Tailwind CSS için anlık yapılandırma (Design Tokens)
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              'primary': {
                'DEFAULT': '#0A65F1', // Kurumsal Mavi (Ana Renk)
                'dark': '#0853C7'     // Hover ve Aktif durumlar için koyu ton
              },
              'secondary': '#F59E0B',   // Vurgu Rengi (Call-to-Action Butonlar)
              'neutral': {
                '100': '#F8F9FA', // Açık Gri Arka Plan
                '200': '#E9ECEF', // Border ve ayırıcılar
                '700': '#4A5568', // Gövde Metni
                '900': '#1A202C'  // Başlıklar
              }
            },
            fontFamily: {
              'sans': ['Inter', 'sans-serif'],      // Gövde metni için
              'display': ['Poppins', 'sans-serif'], // Başlıklar için
            },
            borderRadius: {
                'lg': '0.75rem', // 12px
                'xl': '1rem',   // 16px
            },
            boxShadow: {
                'soft': '0 4px 12px rgba(0, 0, 0, 0.08)', // Kartlar için yumuşak gölge
            }
          }
        }
      }
    </script>

    <!-- Gerekli JS Kütüphaneleri -->
    <script src="<?php echo tema;?>/assets/js/jquery.min.js"></script>

    <!-- Diğer Scriptler ve PHP Değişkenleri -->
    <?php echo dogrulama;?>
    <?php echo analytics;?>
    <?php echo canli_destek;?>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php
    if($moduller['alan16'] == "1"){
        $html = ".html";
    }
    else
    {
        $html = "";
    }
    ?>
</head>
<body class="bg-neutral-100 font-sans text-neutral-700">
    <div id="main-wrapper" class="flex flex-col min-h-screen">

        <!-- ============================ Header Start ================================== -->
        <header class="sticky top-0 z-50 bg-white shadow-soft">
            <!-- Üst Bar (İletişim ve Sosyal Medya) -->
            <div class="bg-primary text-white py-2">
                <div class="container mx-auto px-4 flex justify-between items-center text-sm">
                    <div class="flex items-center space-x-6">
                        <a href="tel:<?php echo telefon;?>" class="flex items-center hover:text-gray-200">
                            <ion-icon name="call-outline" class="mr-2"></ion-icon>
                            <span><?php echo telefon;?></span>
                        </a>
                        <a href="mailto:<?php echo email;?>" class="flex items-center hover:text-gray-200">
                            <ion-icon name="mail-outline" class="mr-2"></ion-icon>
                            <span><?php echo email;?></span>
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <?php if(facebook){?> <a href="<?php echo facebook;?>" class="hover:text-gray-200"><ion-icon name="logo-facebook"></ion-icon></a> <?php }?>
                        <?php if(twitter){?> <a href="<?php echo twitter;?>" class="hover:text-gray-200"><ion-icon name="logo-twitter"></ion-icon></a> <?php }?>
                        <?php if(instagram){?> <a href="<?php echo instagram;?>" class="hover:text-gray-200"><ion-icon name="logo-instagram"></ion-icon></a> <?php }?>
                        <?php if(linkedin){?> <a href="<?php echo linkedin;?>" class="hover:text-gray-200"><ion-icon name="logo-linkedin"></ion-icon></a> <?php }?>
                        <?php if(youtube){?> <a href="<?php echo youtube;?>" class="hover:text-gray-200"><ion-icon name="logo-youtube"></ion-icon></a> <?php }?>
                    </div>
                </div>
            </div>

            <!-- Ana Navigasyon -->
            <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
                <!-- Logo -->
                <a href="./" class="flex-shrink-0">
                    <img src="<?php echo tema;?>/uploads/logo/<?php echo logo;?>" class="h-10" alt="Logo" />
                </a>

                <!-- Mobil Menü Butonu -->
                <button id="mobile-menu-button" class="md:hidden p-2 rounded-md text-neutral-900 hover:bg-neutral-100 focus:outline-none">
                    <ion-icon name="menu-outline" class="text-3xl"></ion-icon>
                </button>

                <!-- Desktop Menü -->
                <div id="desktop-menu" class="hidden md:flex md:items-center md:space-x-8">
                    <ul class="flex space-x-6 font-medium text-neutral-700">
                        <?php
                        $MENUSorgu = $db->prepare("SELECT * FROM menu WHERE menu_durum = ? AND menu_ust = ? AND dil = ? ORDER BY menu_sira ASC");
                        $MENUSorgu->execute(array("1","0",$_SESSION['k_dil']));
                        $MENUislem = $MENUSorgu->fetchALL(PDO::FETCH_ASSOC);
                        foreach ($MENUislem as $MENUSonuc) {
                            $href = $MENUSonuc['menu_url'] == "0" ? $MENUSonuc['link'] : $MENUSonuc['menu_url'].$html;
                            echo '<li><a href="'.$href.'" class="hover:text-primary transition-colors">'.$MENUSonuc['menu_isim'].'</a></li>';
                        }
                        ?>
                    </ul>
                    <div class="flex items-center space-x-4">
                        <a href="#" data-toggle="modal" data-target="#login" class="text-neutral-700 hover:text-primary transition-colors">Üye Girişi</a>
                        <a href="ilan-ekle<?php echo $html;?>" class="bg-secondary text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-opacity-90 transition-all">
                            İlan Ver
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Mobil Menü (Gizli) -->
            <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-neutral-200">
                <ul class="flex flex-col p-4 space-y-4">
                     <?php
                        foreach ($MENUislem as $MENUSonuc) {
                            $href = $MENUSonuc['menu_url'] == "0" ? $MENUSonuc['link'] : $MENUSonuc['menu_url'].$html;
                            echo '<li><a href="'.$href.'" class="block py-2 px-4 rounded-md hover:bg-neutral-100 hover:text-primary transition-colors">'.$MENUSonuc['menu_isim'].'</a></li>';
                        }
                        ?>
                </ul>
                <div class="border-t border-neutral-200 p-4 space-y-4">
                    <a href="#" data-toggle="modal" data-target="#login" class="block w-full text-center py-2.5 px-5 rounded-lg border border-primary text-primary hover:bg-primary hover:text-white transition-all">Üye Girişi</a>
                    <a href="ilan-ekle<?php echo $html;?>" class="block w-full text-center bg-secondary text-white py-2.5 px-5 rounded-lg font-semibold hover:bg-opacity-90 transition-all">
                        İlan Ver
                    </a>
                </div>
            </div>
        </header>
        <!-- ============================ Header End ================================== -->

        <!-- Sayfa İçeriği Başlangıcı -->
        <main class="flex-grow">
      <?php
        // Akıllı Yönlendirici (Router)
        $page_map = [
            'ilan-ekle' => 'ilan_ekle.php',
            'arama' => 'arama.php',
            'ilanlarim' => 'ilanlarim.php',
            $htc['anaurl'] => 'anasayfa.php',
            $htc['sayfaurl'] => 'sayfalar.php',
            $htc['emlakkategoriurl'] => 'emlak_kategori.php',
            $htc['ilanlarurl'] => 'ilanlar.php',
            $htc['ilandetayurl'] => 'ilan.php',
            $htc['projekategoriurl'] => 'proje_kategori.php',
            $htc['projelerurl'] => 'projeler.php',
            $htc['projedetayurl'] => 'proje_detay.php',
            $htc['ekibdetayurl'] => 'ekip.php',
            $htc['ekiburl'] => 'ekibimiz.php',
            $htc['haberurl'] => 'haberler.php',
            $htc['haberdetayurl'] => 'haber_detay.php',
            $htc['hizmeturl'] => 'hizmetler.php',
            $htc['hizmetdetayurl'] => 'hizmet_detay.php',
            $htc['refurl'] => 'referanslar.php',
            $htc['refdetayurl'] => 'referans.php',
            $htc['belgeurl'] => 'belgelerimiz.php',
            $htc['katalogurl'] => 'e_katalog.php',
            $htc['musteriurl'] => 'musteri_gorusleri.php',
            '404' => '404.php',
            $htc['sssurl'] => 'sss.php',
            $htc['ikurl'] => 'ik.php',
            $htc['iletisimurl'] => 'iletisim.php',
            $htc['hesapolustururl'] => 'hesap_olustur.php',
            $htc['girisyapurl'] => 'giris_yap.php',
            $htc['hesabimurl'] => 'hesabim.php',
            $htc['bankahesapurl'] => 'banka_hesaplari.php',
        ];

        $s = isset($_GET['sayfa']) ? $_GET['sayfa'] : $htc['anaurl'];
        $page_file = isset($page_map[$s]) ? $page_map[$s] : 'anasayfa.php';

        $kurumsal_page_path = __DIR__ . '/pages/' . $page_file;
        $genel_page_path = str_replace('kurumsal', 'genel', $kurumsal_page_path);

        if (file_exists($kurumsal_page_path)) {
            require_once($kurumsal_page_path);
        } elseif (file_exists($genel_page_path)) {
            require_once($genel_page_path);
        } else {
            // Fallback anasayfaya yönlendir
            require_once(__DIR__ . '/pages/anasayfa.php');
        }
      ?>
        </main>
        <!-- Sayfa İçeriği Bitişi -->

        <!-- ============================ Footer Start ================================== -->
        <footer class="bg-neutral-900 text-white">
            <div class="container mx-auto px-4 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                    <!-- Logo ve İletişim -->
                    <div class="col-span-1 md:col-span-1">
                        <img src="<?php echo tema;?>/uploads/logo/footer/<?php echo footerlogo;?>" class="h-12 mb-4" alt="<?php echo firma_adi;?>" />
                        <div class="space-y-3 text-neutral-300">
                            <p class="flex items-start">
                                <ion-icon name="location-outline" class="mt-1 mr-3 text-lg"></ion-icon>
                                <span><?php echo adres;?></span>
                            </p>
                            <p><a href="tel:<?php echo trim(telefon);?>" class="flex items-center hover:text-primary"><ion-icon name="call-outline" class="mr-3 text-lg"></ion-icon><span><?php echo telefon;?></span></a></p>
                            <p><a href="mailto:<?php echo email;?>" class="flex items-center hover:text-primary"><ion-icon name="mail-outline" class="mr-3 text-lg"></ion-icon><span><?php echo email;?></span></a></p>
                        </div>
                    </div>

                    <!-- Kurumsal Linkler -->
                    <div class="col-span-1">
                        <h4 class="text-lg font-display font-semibold mb-4">Kurumsal</h4>
                        <ul class="space-y-2 text-neutral-300">
                           <?php $FMENUSorgu = $db->prepare("SELECT * FROM footermenu WHERE menu_durum = ? AND menu_ust = ? AND dil = ? ORDER BY menu_sira ASC LIMIT 0,5");
                           $FMENUSorgu->execute(array("1","0",$_SESSION['k_dil']));
                           foreach ($FMENUSorgu->fetchALL(PDO::FETCH_ASSOC) as $FMENUSonuc) { ?>
                           <li><a href="<?php echo($FMENUSonuc['menu_url'] == "0" ? $FMENUSonuc['link'] : $FMENUSonuc['menu_url'].$html); ?>" class="hover:text-primary transition-colors"><?php echo $FMENUSonuc['menu_isim']; ?></a></li>
                           <?php } ?>
                        </ul>
                    </div>

                    <!-- Hizmetler Linkleri -->
                    <div class="col-span-1">
                        <h4 class="text-lg font-display font-semibold mb-4">Hizmetlerimiz</h4>
                        <ul class="space-y-2 text-neutral-300">
                           <?php $FMENUSorgu = $db->prepare("SELECT * FROM footermenu WHERE menu_durum = ? AND menu_ust = ? AND dil = ? ORDER BY menu_sira ASC LIMIT 5,5");
                           $FMENUSorgu->execute(array("1","0",$_SESSION['k_dil']));
                           foreach ($FMENUSorgu->fetchALL(PDO::FETCH_ASSOC) as $FMENUSonuc) { ?>
                           <li><a href="<?php echo($FMENUSonuc['menu_url'] == "0" ? $FMENUSonuc['link'] : $FMENUSonuc['menu_url'].$html); ?>" class="hover:text-primary transition-colors"><?php echo $FMENUSonuc['menu_isim']; ?></a></li>
                           <?php } ?>
                        </ul>
                    </div>

                    <!-- E-Bülten -->
                    <div class="col-span-1">
                        <h4 class="text-lg font-display font-semibold mb-4">E-Bülten</h4>
                        <p class="text-neutral-300 mb-4">Yeni ilanlardan ve kampanyalardan haberdar olun.</p>
                        <form method="post" action="_class/site_islem.php" class="flex">
                            <input type="email" name="email" class="w-full bg-neutral-800 border border-neutral-700 text-white rounded-l-lg px-4 py-2.5 focus:outline-none focus:border-primary" placeholder="E-posta adresiniz">
                            <button type="submit" name="ebultenbtn" class="bg-primary text-white px-5 py-2.5 rounded-r-lg font-semibold hover:bg-primary-dark transition-colors">Kayıt Ol</button>
                        </form>
                    </div>

                </div>
            </div>

            <!-- Alt Footer -->
            <div class="bg-neutral-900 border-t border-neutral-800 py-4">
                <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center text-sm text-neutral-400">
                    <p class="mb-4 md:mb-0"><?php echo copyright;?></p>
                    <div class="flex items-center space-x-5 text-xl">
                        <?php if(facebook){?> <a href="<?php echo facebook;?>" class="hover:text-primary"><ion-icon name="logo-facebook"></ion-icon></a> <?php }?>
                        <?php if(twitter){?> <a href="<?php echo twitter;?>" class="hover:text-primary"><ion-icon name="logo-twitter"></ion-icon></a> <?php }?>
                        <?php if(instagram){?> <a href="<?php echo instagram;?>" class="hover:text-primary"><ion-icon name="logo-instagram"></ion-icon></a> <?php }?>
                        <?php if(linkedin){?> <a href="<?php echo linkedin;?>" class="hover:text-primary"><ion-icon name="logo-linkedin"></ion-icon></a> <?php }?>
                        <?php if(youtube){?> <a href="<?php echo youtube;?>" class="hover:text-primary"><ion-icon name="logo-youtube"></ion-icon></a> <?php }?>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ============================ Footer End ================================== -->

        <!-- Modern Üye Girişi Modal -->
        <div id="login-modal" class="fixed inset-0 bg-black bg-opacity-50 z-[100] hidden items-center justify-center">
            <div class="bg-white rounded-xl shadow-soft w-full max-w-md p-8 m-4">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-display font-semibold text-neutral-900">Üye Girişi</h3>
                    <button onclick="toggleModal('login-modal')" class="text-neutral-500 hover:text-neutral-800">
                        <ion-icon name="close-outline" class="text-3xl"></ion-icon>
                    </button>
                </div>
                <form method="post" action="_class/site_islem.php" autocomplete="off" class="space-y-4">
                    <div>
                        <label for="login-email" class="block text-sm font-medium text-neutral-700 mb-1">E-posta</label>
                        <input type="email" id="login-email" name="email" class="w-full py-2.5 px-4 border border-neutral-200 rounded-lg focus:ring-2 focus:ring-primary" placeholder="ornek@mail.com" value="demo@demo.com">
                    </div>
                    <div>
                        <label for="login-sifre" class="block text-sm font-medium text-neutral-700 mb-1">Şifre</label>
                        <input type="password" id="login-sifre" name="sifre" class="w-full py-2.5 px-4 border border-neutral-200 rounded-lg focus:ring-2 focus:ring-primary" placeholder="*******" value="demo">
                    </div>
                    <button type="submit" name="giris" class="w-full bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-primary-dark transition-all text-lg">Giriş Yap</button>
                </form>
                <div class="text-center mt-6 text-sm">
                    <a href="#" onclick="event.preventDefault(); toggleModal('login-modal'); toggleModal('sifre-modal');" class="text-primary hover:underline">Şifremi Unuttum</a>
                    <span class="mx-2 text-neutral-300">|</span>
                    <a href="<?php echo $htc['hesapolustururl'];?><?php echo $html;?>" class="text-primary hover:underline">Hesap Oluştur</a>
                </div>
            </div>
        </div>

        <!-- Modern Şifremi Unuttum Modal -->
        <div id="sifre-modal" class="fixed inset-0 bg-black bg-opacity-50 z-[100] hidden items-center justify-center">
            <div class="bg-white rounded-xl shadow-soft w-full max-w-md p-8 m-4">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-display font-semibold text-neutral-900">Şifremi Unuttum</h3>
                    <button onclick="toggleModal('sifre-modal')" class="text-neutral-500 hover:text-neutral-800">
                        <ion-icon name="close-outline" class="text-3xl"></ion-icon>
                    </button>
                </div>
                <form method="post" action="_class/site_islem.php" autocomplete="off" class="space-y-4">
                    <div>
                        <label for="sifre-email" class="block text-sm font-medium text-neutral-700 mb-1">E-posta</label>
                        <input type="email" id="sifre-email" name="email" class="w-full py-2.5 px-4 border border-neutral-200 rounded-lg focus:ring-2 focus:ring-primary" placeholder="Kayıtlı e-posta adresiniz">
                    </div>
                    <button type="submit" name="sifre_hatirlat" class="w-full bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-primary-dark transition-all text-lg">Yeni Şifre Gönder</button>
                </form>
                 <div class="text-center mt-6 text-sm">
                    <a href="#" onclick="event.preventDefault(); toggleModal('sifre-modal'); toggleModal('login-modal');" class="text-primary hover:underline">Giriş Yap'a Geri Dön</a>
                </div>
            </div>
        </div>
        <script>
            // Mobil Menü Toggle Script'i
            document.getElementById('mobile-menu-button').addEventListener('click', function() {
                var menu = document.getElementById('mobile-menu');
                if (menu.classList.contains('hidden')) {
                    menu.classList.remove('hidden');
                } else {
                    menu.classList.add('hidden');
                }
            });

            // Modal Toggle Script'i
            function toggleModal(modalID) {
                const modal = document.getElementById(modalID);
                if (modal.classList.contains('hidden')) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                } else {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            }

            // data-target olan linklere event listener ekle
            document.querySelectorAll('[data-target]').forEach(trigger => {
                trigger.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetModal = this.getAttribute('data-target');
                    // Bootstrap'in # selector'ünü temizle
                    toggleModal(targetModal.substring(1));
                });
            });
        </script>



        <a id="back2Top" class="top-scroll" title="<?=@$dil['yaz17'];?>" href="#"><i class="ti-arrow-up"></i></a>


    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->


<?php
site_mesaj("giris_yap",2,"no",@$dil['txt57'],@$dil['txt225'],@$dil['txt56']);
site_mesaj("giris_yap",3,"bos",@$dil['txt59'],@$dil['txt128'],@$dil['txt56']);
site_mesaj("musteri_kontol",3,"pasif",@$dil['txt59'],@$dil['txt226'],@$dil['txt56']);
site_mesaj("musteri_kontol",3,"engel",@$dil['txt59'],@$dil['txt227'],@$dil['txt56']);
site_mesaj("sifre_hatirlat",1,"yes",@$dil['txt45'],@$dil['txt228'],@$dil['txt56']);
site_mesaj("sifre_hatirlat",2,"no",@$dil['txt57'],@$dil['txt229'],@$dil['txt56']);
site_mesaj("mesajbtn",1,"yes",@$dil['txt45'],@$dil['txt55'],@$dil['txt56']);
site_mesaj("mesajbtn",2,"no",@$dil['txt57'],@$dil['txt58'],@$dil['txt56']);
site_mesaj("mesajbtn",3,"bos",@$dil['txt59'],@$dil['txt60'],@$dil['txt56']);
site_mesaj("ebultenbtn",1,"yes",@$dil['txt45'],@$dil['txt55'],@$dil['txt56']);
site_mesaj("ebultenbtn",2,"no",@$dil['txt57'],@$dil['txt58'],@$dil['txt56']);
site_mesaj("ebultenbtn",3,"bos",@$dil['txt59'],@$dil['txt60'],@$dil['txt56']);

site_mesaj("yorumbtn",1,"yes",@$dil['txt45'],@$dil['txt55'],@$dil['txt56']);
site_mesaj("yorumbtn",2,"no",@$dil['txt57'],@$dil['txt58'],@$dil['txt56']);
site_mesaj("yorumbtn",3,"bos",@$dil['txt59'],@$dil['txt60'],@$dil['txt56']);

site_mesaj("sitedemo",3,"no",@$dil['txt57'],@$dil['txt61'],@$dil['txt56']);
?>


    <!-- ============================================================== -->
    <!-- Temel JS Dosyaları -->
    <!-- ============================================================== -->
    <script src="<?php echo tema;?>/assets/js/slick.js"></script>
    <script src="<?php echo tema;?>/assets/js/custom.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->


	<?php
	error_reporting(0);
	$sayfa=isset($_GET['sayfa']) ? addslashes($_GET['sayfa']) : "";
	if($sayfa=="ilan-ekle"){?>
	<link rel="stylesheet" href="../../<?php echo $ayar['yonetim'];?>/vendors/iconfonts/mdi/font/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="../../<?php echo $ayar['yonetim'];?>/vendors/css/vendor.bundle.addons.css">
	<!-- inject:css -->
	<link rel="stylesheet" href="<?php echo tema;?>/assets/css/style.css">
	<!-- plugins:js -->
	<script src="../../<?php echo $ayar['yonetim'];?>/vendors/js/vendor.bundle.base.js"></script>
	<script src="../../<?php echo $ayar['yonetim'];?>/vendors/js/vendor.bundle.addons.js"></script>
	<!-- endinject -->
	<script src="//cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>
	<link href="../../<?php echo $ayar['yonetim'];?>/vendors/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
	<script src="../../<?php echo $ayar['yonetim'];?>/vendors/datetimepicker/jquery.datetimepicker.js"></script>
	<!-- End custom js for this page-->
	<script src="../../<?php echo $ayar['yonetim'];?>/js/file-upload.js"></script>
	<script src="../../<?php echo $ayar['yonetim'];?>/js/select2.js"></script>
	<script src="../../<?php echo $ayar['yonetim'];?>/js/form-addons.js"></script>

		<script type="text/javascript">

		$(document).ready(function(e) {
			$('#secenek').bind('change', secenekGetir);
		});
		function secenekGetir()
		{
			var id		=$(this).val();
			var ozellik	=$("#ozellik").val();
			var dil		=$("#dil").val();
			$.ajax({
				type: 'post',
				url: '../../<?php echo $ayar['yonetim'];?>/data/secenek.php',
				data:{"id":id,"ozellik":ozellik,"dil":dil},
				success: function(result)
				{
					$('#secyaz').html(result);
				}
			});
		}

		$('#secenek').ready(function(){
			var id 		= $("#secenek").val();
			var ozellik	= $("#ozellik").val();
			var dil		= $("#dil").val();
			if(id != 0)
			{
			 $.ajax({
				type: 'post',
				url: '../../<?php echo $ayar['yonetim'];?>/data/secenek.php',
				data:{"id":id,"ozellik":ozellik,"dil":dil},
				success: function(result)
				{
					$('#secyaz').html(result);
				}
				});
			}
			else
			{
				$("#secyaz").html('Kategori Seçiniz.');
			}
		});
		</script>
		<script>
			$(document).ready(function(e) {
				$('#il').bind('change', ilceleriGetir);
				$('#ilce').bind('change', semtleriGetir);
			});

			function ilceleriGetir() {
				var ilid = $(this).val();
				var ilceid=$("#ilceid").val();
				$.ajax({
					type: "post",
					url: "../../<?php echo $ayar['yonetim'];?>/dinamik.php",
					data: {
						"ilid": ilid,
						"ilceid": ilceid
					},
					dataType: "json",
					success: function(fur) {
						$("#ilce").html(fur.basari);
					}
				});
			}

			function semtleriGetir() {
				var ilceid = $("#ilce").val();
				var semtid = $("#semtid").val();
				$.ajax({
					type: "post",
					url: "../../<?php echo $ayar['yonetim'];?>/dinamik.php",
					data: {
						"ilceid": ilceid,
						"semtid": semtid
					},
					dataType: "json",
					success: function(fur) {
						$("#semt").html(fur.basari);
					}
				});
			}

			$('#il').ready(function() {
				var ilid = $("#il").val();
				var ilceid=$("#ilceid").val();
				var semtid=$("#semtid").val();
				if (ilid != 0) {
					$.ajax({
						type: "post",
						url: "../../<?php echo $ayar['yonetim'];?>/dinamik.php",
						data: {
							"ilid": ilid,
							"ilceid": ilceid,
							"semtid": semtid
						},
						dataType: "json",
						success: function(fur) {
							$("#ilce").html(fur.basari);
							setTimeout(function() { semtleriGetir(); }, 500);
						}
					});
				} else {
				    console.log('aa');
					$("#ilce").html('<option value="0">Önce İl Seçiniz</option>');
				}
			});
		</script>
			<script>
			$('#datetimepicker_mask').datetimepicker({
				mask:'9999/19/39 29:59',
			});
			$('#datetimepicker').datetimepicker();
			$('#datetimepicker').datetimepicker({value:'2015/04/15 05:06'});
			$('#datetimepicker1').datetimepicker({
				datepicker:false,
				format:'H:i',
				step:5
			});
			$('.date-timepicker2').datetimepicker({
				timepicker:false,
				format:'d/m/Y',
				formatDate:'d/m/Y'
			});
			$('#datetimepicker3').datetimepicker({
				inline:true
			});
			$('.date-timepicker').datetimepicker();
			$('#open').click(function(){
				$('#datetimepicker4').datetimepicker('show');
			});
			$('#close').click(function(){
				$('#datetimepicker4').datetimepicker('hide');
			});
			</script>
	<?php }else{?>
	<?php }?>
<script>
	$(document).on('click', '.dildegis', function () {
		var dilID = $(this).data("id");
		$.ajax({
			url: 'dildegis.php',
			dataType: 'JSON',
			data: {id: dilID},
		})
		.done(function(msg) {
			if(msg.hata){
				alert("<?=@$dil['txt39'];?>");
			}else{
				window.location = "<?php echo $htc['anaurl'];?><?php echo $html;?>";
			}
		})
		.fail(function(err) {
			console.log(err);
		});
	});



	function oturum_kapat(){
		swal({
		  title: '<?=@$dil['txt41'];?>',
		  text: '<?=@$dil['txt42'];?>',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: '<?=@$dil['txt43'];?>',
		  confirmButtonText: '<?=@$dil['txt44'];?>'
		}).then((result) => {
		  if (result.value) {
			swal({
			  title: '<?=@$dil['txt45'];?>',
			  text: '<?=@$dil['txt46'];?>',
			  type: "success",
			  icon: 'success',
			  timer: 5000
			}).then(function() {
			  window.location.href = '_class/site_islem.php?cikis=ok';
			});
		  }
		});
	}


	</script>
<script>
	$(function() {
		$('.chosen-select').chosen();
		$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
	});
	$(document).ready(function(e) {
		$('#il').bind('change', ilceleriGetir);
	});
	function ilceleriGetir(){
		var id=$(this).val();
		var ilceid=$("#ilceid").val();
		  $.ajax({
			  type:"post",
			  url:"<?php echo tema;?>/ajax/iller.php",
			  data:{"id":id,"ilceid":ilceid},
			  dataType:"json",
			  success:function(fur){
				  $("#ilce").html(fur.basari);
                  $("#ilce").trigger("chosen:updated");
			  }
		  });
	}
	$('#il').ready(function(){
		var id = $("#il").val();
		var ilceid=$("#ilceid").val();
		if(id != 0){
		$.ajax({
			type:"post",
			url:"<?php echo tema;?>/ajax/iller.php",
			data:{"id":id,"ilceid":ilceid},
			dataType:"json",
			success:function(fur){
				$("#ilce").html(fur.basari);
                $("#ilce").trigger("chosen:updated");
			}
		  });
		}else{
			$("#ilce").html('<option value="0">Önce İl Seçiniz</option>');
		}
	});
	</script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.4/cookieconsent.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.4/cookieconsent.min.js"></script>
    <script>
        window.addEventListener("load", function() {
            window.cookieconsent.initialise({
                "palette": {
                    "popup": {
                        "background": "<?=@$ayar['renk2'];?>"
                    },
                    "button": {
                        "background": "#fff",
                        "text": "#000000"
                    }
                },
                "theme": "classic",
                "content": {
                    "message": "<?=@$dil['yaz290'];?>",
                    "dismiss": "<?=@$dil['yaz291'];?>",
                    "link": "<?=@$dil['yaz292'];?>",
                    "href":"<?=@$dil['yaz293'];?>"
                }
            })
        });
    </script>
<script>
	$(window).bind('load', function() {
  $('img').each(function() {
    if( (typeof this.naturalWidth != "undefined" && this.naturalWidth == 0)
    ||  this.readyState == 'uninitialized'                                  ) {
        $(this).attr('src', '<?php echo tema;?>/uploads/logo/<?php echo logo;?>');
    }
  });
});

	</script>

</body>
</html>