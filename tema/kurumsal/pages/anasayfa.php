<!-- ============================ Hero Alanı Başlangıç ================================== -->
<div class="relative bg-neutral-900">
    <?php
    // Arka plan için ilk slider görselini alıyoruz
    $Sorgu = $db->prepare("SELECT * FROM slider WHERE durum = ? AND dil = ? ORDER BY sira ASC LIMIT 1");
    $Sorgu->execute(array("1",$_SESSION['k_dil']));
    $ilkSlider = $Sorgu->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo tema;?>/uploads/slider/<?php echo $ilkSlider['resim']?>');"></div>
    <div class="absolute inset-0 bg-black opacity-60"></div>

    <div class="relative container mx-auto px-4 py-24 md:py-32 text-center text-white">
        <h1 class="text-4xl md:text-6xl font-display font-bold mb-4 drop-shadow-lg"><?=@$dil['yaz36'];?></h1>
        <p class="text-lg md:text-xl max-w-3xl mx-auto mb-8 drop-shadow-md"><?=@$dil['yaz37'];?></p>

        <!-- Arama Formu -->
        <div class="bg-white p-6 rounded-xl shadow-soft max-w-4xl mx-auto">
            <form method="POST" action="arama" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div class="col-span-1 md:col-span-2 text-left">
                    <label for="kelime" class="block text-sm font-medium text-neutral-700 mb-1">Ne Arıyorsunuz?</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <ion-icon name="search-outline" class="text-neutral-400"></ion-icon>
                        </div>
                        <input type="text" id="kelime" name="kelime" class="w-full pl-10 pr-4 py-2.5 border border-neutral-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="<?=@$dil['yaz38'];?>">
                    </div>
                </div>
                <div class="col-span-1 text-left">
                     <label for="kategori" class="block text-sm font-medium text-neutral-700 mb-1">Emlak Tipi</label>
                    <select id="kategori" name="kategori" class="w-full py-2.5 px-4 border border-neutral-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Tümü</option>
                        <?php
                        $KatSorgu = $db->prepare("SELECT * FROM emlak_kategori WHERE durum = ? AND dil = ? and ustid = ? ORDER BY sira ASC");
                        $KatSorgu->execute(array("1",$_SESSION['k_dil'],"0"));
                        foreach ($KatSorgu->fetchALL(PDO::FETCH_ASSOC) as $KatSonuc) {
                            echo '<option value="'.$KatSonuc['id'].'">'.$KatSonuc['adi'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-span-1">
                    <button type="submit" name="filtre_uygula" class="w-full bg-primary text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-primary-dark transition-all flex items-center justify-center">
                        <span class="mr-2">Ara</span>
                        <ion-icon name="arrow-forward-outline"></ion-icon>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ============================ Hero Alanı Bitiş ================================== -->


<!-- ============================ Güven Unsurları Başlangıç ================================== -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
            <!-- Madde 1 -->
            <div class="flex flex-col items-center">
                <div class="bg-primary-light text-primary bg-blue-100 rounded-full p-4 mb-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-display font-semibold text-neutral-900 mb-2">Geniş Portföy</h3>
                <p class="text-neutral-700">Her bütçeye ve ihtiyaca uygun, yüzlerce güncel ilanı bir arada sunuyoruz.</p>
            </div>
            <!-- Madde 2 -->
            <div class="flex flex-col items-center">
                <div class="bg-primary-light text-primary bg-blue-100 rounded-full p-4 mb-4">
                     <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-display font-semibold text-neutral-900 mb-2">Uzman Kadro</h3>
                <p class="text-neutral-700">Alanında deneyimli ve profesyonel danışmanlarımızla doğru kararlar verin.</p>
            </div>
            <!-- Madde 3 -->
            <div class="flex flex-col items-center">
                <div class="bg-primary-light text-primary bg-blue-100 rounded-full p-4 mb-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-xl font-display font-semibold text-neutral-900 mb-2">Hızlı Sonuç</h3>
                <p class="text-neutral-700">Teknolojik altyapımız ve etkili pazarlama stratejilerimizle hızlıca sonuca ulaşın.</p>
            </div>
        </div>
    </div>
</section>
<!-- ============================ Güven Unsurları Bitiş ================================== -->


<!-- ============================ Öne Çıkan İlanlar Başlangıç ================================== -->
<section class="py-16 bg-neutral-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-neutral-900"><?=@$dil['yaz40'];?></h2>
            <p class="text-lg text-neutral-700 mt-2"><?=@$dil['yaz41'];?></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $Sorgu = $db->prepare("SELECT * FROM emlaklar WHERE durum = ? AND dil = ? and anasayfa = ? ORDER BY sira ASC limit 6");
            $Sorgu->execute(array("1",$_SESSION['k_dil'],"1"));
            foreach ($Sorgu->fetchALL(PDO::FETCH_ASSOC) as $Sonuc) {
                $kategori = $db->query("SELECT * FROM emlak_kategori WHERE id = '{$Sonuc['kategori']}'")->fetch();
                $il = $db->query("SELECT * FROM il WHERE id = '{$Sonuc['il']}'")->fetch();
                $ilce = $db->query("SELECT * FROM ilce WHERE id = '{$Sonuc['ilce']}'")->fetch();
            ?>
            <!-- İlan Kartı -->
            <div class="bg-white rounded-xl shadow-soft overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                <div class="relative">
                    <a href="<?php echo $htc['ilandetayurl']?>/<?php echo $Sonuc['seo']?><?php echo $html?>">
                        <img src="<?php echo tema;?>/uploads/emlaklar/kapak/<?php echo $Sonuc['kapak']?>" class="w-full h-56 object-cover" alt="<?php echo $Sonuc['adi']?>">
                    </a>
                    <div class="absolute top-4 left-4 bg-primary text-white text-xs font-semibold px-3 py-1 rounded-full"><?php echo $kategori['adi']?></div>
                    <div class="absolute bottom-4 right-4">
                        <button class="bg-white p-2 rounded-full shadow-md text-neutral-700 hover:text-red-500 transition-colors">
                            <ion-icon name="heart-outline" class="text-xl"></ion-icon>
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-display font-semibold text-neutral-900 mb-2 truncate">
                        <a href="<?php echo $htc['ilandetayurl']?>/<?php echo $Sonuc['seo']?><?php echo $html?>" class="hover:text-primary"><?php echo $Sonuc['adi']?></a>
                    </h3>
                    <p class="text-neutral-700 flex items-center mb-4">
                        <ion-icon name="location-outline" class="mr-2 text-lg"></ion-icon>
                        <span><?php echo $il['il_adi']?> / <?php echo $ilce['ilce_adi']?></span>
                    </p>
                    <div class="flex justify-between items-center border-t border-neutral-200 pt-4">
                        <p class="text-2xl font-display font-bold text-primary"><?php echo para_format($Sonuc['fiyat'])?> <?php echo $Sonuc['pbirim']?></p>
                        <a href="<?php echo $htc['ilandetayurl']?>/<?php echo $Sonuc['seo']?><?php echo $html?>" class="text-primary font-semibold hover:underline">Detaylar</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

        <div class="text-center mt-12">
            <a href="<?php echo $htc['ilanlarurl'];?><?php echo $html;?>" class="bg-secondary text-white px-8 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all text-lg">
                Tüm İlanları Gör
            </a>
        </div>
    </div>
</section>
<!-- ============================ Öne Çıkan İlanlar Bitiş ================================== -->


<!-- ============================ Müşteri Yorumları Başlangıç ================================== -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-neutral-900"><?=@$dil['yaz47'];?></h2>
            <p class="text-lg text-neutral-700 mt-2"><?=@$dil['yaz48'];?></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $YorumSorgu = $db->prepare("SELECT * FROM musteri_gorusleri WHERE durum = ? ORDER BY id DESC LIMIT 3");
            $YorumSorgu->execute(array("1"));
            foreach ($YorumSorgu->fetchALL(PDO::FETCH_ASSOC) as $YorumSonuc) {
            ?>
            <!-- Yorum Kartı -->
            <div class="bg-neutral-100 p-8 rounded-xl">
                <p class="text-neutral-700 mb-6">"<?php echo $YorumSonuc['yorum']; ?>"</p>
                <div class="flex items-center">
                    <img src="<?php echo tema;?>/assets/img/unnamed.png" class="w-12 h-12 rounded-full mr-4" alt="<?php echo $YorumSonuc['adsoyad']; ?>">
                    <div>
                        <p class="font-display font-semibold text-neutral-900"><?php echo $YorumSonuc['adsoyad']; ?></p>
                        <p class="text-sm text-neutral-700"><?php echo $YorumSonuc['gorev']; ?></p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- ============================ Müşteri Yorumları Bitiş ================================== -->

<!-- ============================ Blog Başlangıç ================================== -->
<section class="py-16 bg-neutral-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-neutral-900">Emlak Dünyasından Haberler</h2>
            <p class="text-lg text-neutral-700 mt-2">Sektördeki son gelişmeler ve faydalı ipuçları.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
             <?php
             $HaberSorgu = $db->prepare("SELECT * FROM haberler WHERE durum = ? AND anasayfa = ? AND dil = ? ORDER BY id DESC LIMIT 3");
             $HaberSorgu->execute(array("1","1",$_SESSION['k_dil']));
             foreach ($HaberSorgu->fetchALL(PDO::FETCH_ASSOC) as $HaberSonuc) {
             ?>
            <!-- Blog Kartı -->
            <div class="bg-white rounded-xl shadow-soft overflow-hidden">
                <a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $HaberSonuc['seo']; ?><?php echo $html;?>">
                    <img src="<?php echo tema;?>/uploads/haberler/<?php echo $HaberSonuc['resim']; ?>" class="w-full h-56 object-cover" alt="<?php echo $HaberSonuc['adi']; ?>">
                </a>
                <div class="p-6">
                    <p class="text-sm text-neutral-700 mb-2"><?php echo tarih2($HaberSonuc['tarih']);?></p>
                    <h3 class="text-xl font-display font-semibold text-neutral-900 mb-4">
                        <a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $HaberSonuc['seo']; ?><?php echo $html;?>" class="hover:text-primary"><?php echo $HaberSonuc['adi']; ?></a>
                    </h3>
                    <a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $HaberSonuc['seo']; ?><?php echo $html;?>" class="font-semibold text-primary hover:underline">Devamını Oku</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- ============================ Blog Bitiş ================================== -->
