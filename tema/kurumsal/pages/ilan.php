<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php
// --- MEVCUT PHP VERİ ÇEKME MANTIĞI KORUNUYOR --- //
if(strip_tags(isset($_GET['id']))){
	$Sorgu = $db->prepare("SELECT * FROM emlaklar WHERE seo = ? AND durum = ? AND dil = ?");
	$Sorgu->execute(array($_GET['id'],"1",$_SESSION['k_dil']));
	if($Sorgu->rowCount()){
		$Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
	} else {
		header("Location:".$url."404".$html); exit();
	}
} else {
    header("Location:".$url."404".$html); exit();
}
$kategori = $db->query("SELECT * FROM emlak_kategori WHERE id = '{$Sonuc['kategori']}'")->fetch(PDO::FETCH_ASSOC);
$il = $db->query("SELECT * FROM il WHERE id = '{$Sonuc['il']}'")->fetch();
$ilce = $db->query("SELECT * FROM ilce WHERE id = '{$Sonuc['ilce']}'")->fetch();
$danisman = $db->query("SELECT * FROM ekibimiz WHERE id = '{$Sonuc['danisman']}'")->fetch();
$resimler = $db->prepare("SELECT * FROM emlakresim WHERE pid = ? ORDER BY sira ASC");
$resimler->execute(array($Sonuc['id']));
$digerResimler = $resimler->fetchAll(PDO::FETCH_ASSOC);
$haberid = $Sonuc['id'];
if(!@$_COOKIE["hit".$haberid]){
    $db->prepare("UPDATE emlaklar SET emlak_hit = emlak_hit + 1 WHERE id = ?")->execute(array($haberid));
    setcookie("hit".$haberid,"_",time()+60);
}
// --- PHP VERİ ÇEKME MANTIĞI SONU --- //
?>

<!-- ============================ Sayfa Başlığı ve Breadcrumb Başlangıç ================================== -->
<div class="bg-white py-6 shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl md:text-3xl font-display font-bold text-neutral-900"><?php echo $Sonuc['adi']; ?></h1>
                <div class="text-sm text-neutral-700 mt-1">
                    <a href="<?php echo $htc['anaurl'];?><?php echo $html;?>" class="hover:text-primary">Anasayfa</a>
                    <span class="mx-2">/</span>
                    <a href="<?php echo $htc['emlakkategoriurl'];?>/<?php echo $kategori['seo'];?><?php echo $html;?>" class="hover:text-primary"><?php echo $kategori['adi'];?></a>
                    <span class="mx-2">/</span>
                    <span><?php echo $Sonuc['adi']; ?></span>
                </div>
            </div>
            <div class="hidden md:block">
                 <p class="text-2xl md:text-3xl font-display font-bold text-primary"><?php echo para_format($Sonuc['fiyat']); ?> <?php echo $Sonuc['pbirim']; ?></p>
            </div>
        </div>
    </div>
</div>
<!-- ============================ Sayfa Başlığı ve Breadcrumb Bitiş ================================== -->

<!-- ============================ İlan Detay Alanı Başlangıç ================================== -->
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">

            <!-- Ana İçerik (Sol Taraf) -->
            <div class="w-full lg:w-2/3">
                <!-- Resim Galerisi -->
                <div>
                    <img id="main-image" src="<?php echo tema;?>/uploads/emlaklar/<?php echo $Sonuc['kapak']; ?>" alt="<?php echo $Sonuc['adi']; ?>" class="w-full h-[500px] object-cover rounded-xl shadow-md mb-4">
                    <div class="grid grid-cols-5 gap-3">
                        <img src="<?php echo tema;?>/uploads/emlaklar/<?php echo $Sonuc['kapak']; ?>" class="thumbnail-image cursor-pointer rounded-lg h-28 w-full object-cover border-2 border-primary" onclick="changeImage('<?php echo tema;?>/uploads/emlaklar/<?php echo $Sonuc['kapak']; ?>', this)">
                        <?php foreach ($digerResimler as $resim) { ?>
                        <img src="<?php echo tema;?>/uploads/emlaklar/diger/<?php echo $resim['resim']; ?>" class="thumbnail-image cursor-pointer rounded-lg h-28 w-full object-cover border-2 border-transparent hover:border-primary" onclick="changeImage('<?php echo tema;?>/uploads/emlaklar/diger/<?php echo $resim['resim']; ?>', this)">
                        <?php } ?>
                    </div>
                </div>

                <!-- Temel Bilgiler -->
                <div class="bg-white p-6 rounded-xl shadow-soft mt-8">
                     <p class="text-neutral-700 flex items-center mb-4 text-lg">
                        <ion-icon name="location-outline" class="mr-2 text-xl"></ion-icon>
                        <span><?php echo $il['il_adi']?> / <?php echo $ilce['ilce_adi']?></span>
                    </p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center border-t border-b border-neutral-200 py-6">
                        <div><p class="text-2xl font-bold text-primary"><?php echo $Sonuc['net']; ?></p><p class="text-sm text-neutral-700">Net m²</p></div>
                        <div><p class="text-2xl font-bold text-primary"><?php echo $Sonuc['oda']; ?></p><p class="text-sm text-neutral-700">Oda Sayısı</p></div>
                        <div><p class="text-2xl font-bold text-primary"><?php echo $Sonuc['banyo']; ?></p><p class="text-sm text-neutral-700">Banyo</p></div>
                        <div><p class="text-2xl font-bold text-primary"><?php echo $Sonuc['bina']; ?></p><p class="text-sm text-neutral-700">Bina Yaşı</p></div>
                    </div>
                </div>

                <!-- Açıklama -->
                <div class="bg-white p-6 rounded-xl shadow-soft mt-8">
                    <h3 class="text-2xl font-display font-semibold mb-4 text-neutral-900">İlan Açıklaması</h3>
                    <div class="prose max-w-none text-neutral-700">
                        <?php echo $Sonuc['aciklama']; ?>
                    </div>
                </div>

                <!-- Özellikler -->
                <div class="bg-white p-6 rounded-xl shadow-soft mt-8">
                    <h3 class="text-2xl font-display font-semibold mb-6 text-neutral-900">Genel Özellikler</h3>
                    <?php
                        $dahiller = explode(",", $Sonuc['ozellik']);
                        $OZKATSorgu = $db->query("SELECT * FROM ozellik_kategori ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($OZKATSorgu as $OZKATSonuc) {
                            $ozelliklerHTML = '';
                            $OZELLIKSorgu = $db->prepare("SELECT * FROM ozellik WHERE kategori = ? ORDER BY id ASC");
                            $OZELLIKSorgu->execute(array($OZKATSonuc['id']));
                            foreach ($OZELLIKSorgu->fetchAll(PDO::FETCH_ASSOC) as $OZELLIKSonuc) {
                                if (in_array($OZKATSonuc['id'].'-'.$OZELLIKSonuc['id'], $dahiller)) {
                                    $ozelliklerHTML .= '<li class="flex items-center"><ion-icon name="checkmark-circle-outline" class="text-green-500 mr-2 text-lg"></ion-icon>'.$OZELLIKSonuc['adi'].'</li>';
                                }
                            }
                            if (!empty($ozelliklerHTML)) {
                                echo '<div class="mb-6"><h4 class="font-semibold text-lg text-neutral-800 mb-3 pb-2 border-b">'.$OZKATSonuc['adi'].'</h4>';
                                echo '<ul class="grid grid-cols-1 md:grid-cols-3 gap-x-6 gap-y-3 text-neutral-700">'.$ozelliklerHTML.'</ul></div>';
                            }
                        }
                    ?>
                </div>

                <!-- Harita ve Video -->
                <?php if($Sonuc['latfield'] || $Sonuc['video']){ ?>
                <div class="bg-white rounded-xl shadow-soft mt-8">
                    <div class="border-b border-gray-200">
                        <nav id="detay-tabs" class="flex -mb-px">
                          <?php if($Sonuc['latfield']){ ?><a href="#konum" class="tab-link active-tab whitespace-nowrap py-4 px-6 border-b-2 font-medium text-lg">Konum</a><?php } ?>
                          <?php if($Sonuc['video']){ ?><a href="#video" class="tab-link whitespace-nowrap py-4 px-6 border-b-2 font-medium text-lg">Video</a><?php } ?>
                        </nav>
                    </div>
                    <div class="p-6">
                        <?php if($Sonuc['latfield']){ ?>
                        <div id="konum" class="tab-content">
                            <div id="map" style="height: 400px; width: 100%;" class="rounded-lg"></div>
                        </div>
                        <?php } ?>
                        <?php if($Sonuc['video']){ ?>
                        <div id="video" class="tab-content hidden">
                            <div class="aspect-w-16 aspect-h-9">
                                <iframe src="https://www.youtube.com/embed/<?php echo $Sonuc['video']; ?>" frameborder="0" allowfullscreen class="rounded-lg"></iframe>
                            </div>
                        </div>
                         <?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>

            <!-- Kenar Çubuğu (Sağ Taraf) -->
            <div class="w-full lg:w-1/3">
                <div class="sticky top-28 space-y-6">
                    <div class="bg-white p-6 rounded-xl shadow-soft">
                         <p class="text-3xl font-display font-bold text-primary mb-4 block md:hidden"><?php echo para_format($Sonuc['fiyat']); ?> <?php echo $Sonuc['pbirim']; ?></p>
                        <?php if($danisman['id']){?>
                        <div class="flex items-center mb-6 pb-6 border-b">
                            <img src="<?php echo tema;?>/uploads/ekibimiz/<?php echo $danisman['resim']?>" alt="<?php echo $danisman['adi'];?>" class="w-20 h-20 rounded-full mr-4 object-cover">
                            <div>
                                <h4 class="text-xl font-display font-semibold text-neutral-900"><?php echo $danisman['adi'];?></h4>
                                <p class="text-neutral-700">Emlak Danışmanı</p>
                                <a href="tel:<?php echo $danisman['telefon']?>" class="text-primary font-semibold mt-1 inline-block hover:underline"><?php echo $danisman['telefon']?></a>
                            </div>
                        </div>
                        <h4 class="text-xl font-display font-semibold mb-4 text-neutral-900">Bu İlan İçin Mesaj Gönderin</h4>
                        <form method="POST" id="danismana_ulas" onsubmit="return danismanMesaj()" class="space-y-4">
                            <input type="hidden" name="emlak_id" value="<?=$Sonuc['id'];?>">
                            <input type="hidden" name="danisman_id" value="<?=$danisman['id'];?>">
                            <input type="hidden" name="type" value="danismana_ulas">

                            <input type="text" name="adsoyad" placeholder="<?=@$dil['yaz82'];?>" class="w-full py-2.5 px-4 border border-neutral-200 rounded-lg focus:ring-2 focus:ring-primary">
                            <input type="email" name="email" placeholder="<?=@$dil['yaz83'];?>" class="w-full py-2.5 px-4 border border-neutral-200 rounded-lg focus:ring-2 focus:ring-primary">
                            <input type="tel" name="telefon" placeholder="<?=@$dil['yaz85'];?>" class="w-full py-2.5 px-4 border border-neutral-200 rounded-lg focus:ring-2 focus:ring-primary">
                            <textarea name="mesaj" placeholder="<?=@$dil['yaz103'];?>" rows="4" class="w-full py-2.5 px-4 border border-neutral-200 rounded-lg focus:ring-2 focus:ring-primary"></textarea>
                            <button type="submit" class="w-full bg-secondary text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all text-lg">Mesaj Gönder</button>
                        </form>
                        <?php } else { ?>
                            <p class="text-center text-neutral-700">Bu ilan için bir danışman atanmamış.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- ============================ İlan Detay Alanı Bitiş ================================== -->

<script>
// --- Resim Galerisi için JS --- //
function changeImage(src, element) {
    document.getElementById('main-image').src = src;
    // Aktif border stilini yönet
    var thumbnails = document.getElementsByClassName('thumbnail-image');
    for (var i = 0; i < thumbnails.length; i++) {
        thumbnails[i].classList.remove('border-primary');
        thumbnails[i].classList.add('border-transparent');
    }
    element.classList.remove('border-transparent');
    element.classList.add('border-primary');
}

// --- Danışman Mesaj Formu için JS --- //
function danismanMesaj(){
    var formData = $('#danismana_ulas').serialize();
    $.ajax({
        type: "post",
        url: "/<?=tema;?>/ajax/ajax.php",
        data: formData,
        success: function(data) {
            var response = JSON.parse(data);
            alert(response.msg); // Gelen mesajı alert olarak göster
            if(response.status == true){
                $('#danismana_ulas')[0].reset(); // Başarılıysa formu sıfırla
            }
        }
    });
    return false; // Formun sayfa yenilemesini engelle
}

// --- Tablar için JS --- //
document.addEventListener('DOMContentLoaded', (event) => {
    const tabs = document.querySelectorAll('.tab-link');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', (e) => {
            e.preventDefault();

            // Diğer tabları pasif yap
            tabs.forEach(item => item.classList.remove('active-tab'));
            // Tıklananı aktif yap
            tab.classList.add('active-tab');

            // İlgili içeriği göster
            const targetId = tab.getAttribute('href').substring(1);
            contents.forEach(content => {
                if (content.id === targetId) {
                    content.classList.remove('hidden');
                } else {
                    content.classList.add('hidden');
                }
            });
        });
    });
});
</script>

<?php if($Sonuc['latfield']){ ?>
<!-- Harita için JS -->
<!-- ÖNEMLİ: Haritanın çalışması için "YOUR_API_KEY" yazan yere kendi Yandex Maps API anahtarınızı eklemelisiniz. -->
<script src="https://api-maps.yandex.ru/2.1/?lang=tr_TR&amp;apikey=YOUR_API_KEY"></script>
<script>
    ymaps.ready(init);
    function init(){
        var myMap = new ymaps.Map("map", {
            center: [<?php echo $Sonuc['latfield'];?>, <?php echo $Sonuc['lngfield']; ?>],
            zoom: <?php echo $Sonuc['zoom'];?>
        });
        var myPlacemark = new ymaps.Placemark([<?php echo $Sonuc['latfield']; ?>, <?php echo $Sonuc['lngfield']; ?>], {
            hintContent: '<?php echo addslashes($Sonuc['adi']); ?>',
            balloonContent: '<?php echo addslashes($Sonuc['adi']); ?>'
        });
        myMap.geoObjects.add(myPlacemark);
    }
</script>
<?php } ?>
