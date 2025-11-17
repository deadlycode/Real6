<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php
// --- MEVCUT PHP FİLTRELEME MANTIĞI OLDUĞU GİBİ KORUNUYOR --- //
$where = '';
function getCategoryID($catID){
    global $db;
    $categories = [];
    $getCategories = $db->query("SELECT * FROM emlak_kategori WHERE ustid ='{$catID}'",PDO::FETCH_ASSOC);
    if(isset($getCategories)){
        foreach($getCategories as $getCategory){
         $categories[] = $getCategory['id'];
        }
    }
    return $categories;
}
if(isset($_POST['kategori']) && !empty($_POST['kategori'])){
    $getCategory = $db->query("SELECT * FROM emlak_kategori WHERE id ='{$catID}'")->fetch(PDO::FETCH_ASSOC);
    $categories = [];
    $catID = $_POST['kategori'];
    $categories = getCategoryID($catID);
    $categories[] = $catID;
    $where .= ' AND (';
    foreach ($categories as $categoryID) {
        $where .= ' kategori = "' . $categoryID . '" OR';
    }
    $where = rtrim($where, 'OR');
    $where .= ' )';
}
$order = ' ORDER BY sira ASC ';
if (isset($_POST['filtre_uygula'])) {
    $post = $_POST['filtre_uygula'];
    if (isset($_POST['katsayisi'])) {
        $where .= ' AND ( ';
        foreach ($_POST['katsayisi'] as $katSayisi) {
            $where .= ' katsayisi = "' . $katSayisi . '" OR';
        }
        $where = rtrim($where, 'OR');
        $where .= ' ) ';
    }
    if(isset($_POST['il']) && !empty($_POST['il'])){
        $where .= ' AND il = "'.$_POST['il'].'" ';
    }
    $_SESSION['ilID'] = $_POST['il'];
    if(isset($_POST['ilce']) && !empty($_POST['ilce'])){
        $where .= ' AND ilce = "'.$_POST['ilce'].'" ';
    }
    $_SESSION['ilceID'] = $_POST['ilce'];
    if (isset($_POST['oda'])) {
        $where .= ' AND ( ';
        foreach ($_POST['oda'] as $odaSayisi) {
            $where .= ' oda LIKE "%' . $odaSayisi . '%" OR';
        }
        $where = rtrim($where, 'OR');
        $where .= ' ) ';
    }
    if (isset($_POST['bina'])) {
        $where .= ' AND ( ';
        foreach ($_POST['bina'] as $binaYasi) {
            $where .= ' bina LIKE "%' . $binaYasi . '%" OR';
        }
        $where = rtrim($where, 'OR');
        $where .= ' ) ';
    }
    if (isset($_POST['bulundugukat'])) {
        $where .= ' AND ( ';
        foreach ($_POST['bulundugukat'] as $bulunduguKat) {
            $where .= ' bulundugukat LIKE "%' . $bulunduguKat . '%" OR';
        }
        $where = rtrim($where, 'OR');
        $where .= ' ) ';
    }
    if (isset($_POST['kelime'])) {
        $where .= ' AND (adi LIKE "%' . $_POST['kelime'] . '%" OR emlak_kodu = "'.$_POST['kelime'].'" ) ';
    }
    if(isset($_POST['max_price']) && !empty($_POST['max_price'])){
        $where .= 'AND fiyat <= "' . $_POST['max_price'] . '"';
    }
    if(isset($_POST['min_price']) && !empty($_POST['min_price'])){
        $where .= 'AND fiyat >= "' . $_POST['min_price'] . '"';
    }
    if (isset($_POST['order'])) {
        switch ($_POST['order']) {
            case 'fiyat_artan': $order = ' ORDER BY fiyat ASC '; break;
            case 'fiyat_azalan': $order = ' ORDER BY fiyat DESC '; break;
            case 'eklenen_yeni': $order = ' ORDER BY id DESC '; break;
            default: $order = ' ORDER BY sira ASC '; break;
        }
    }
    $_SESSION['filtre_uygula'] = $_POST;
    $_SESSION['where'] = $where;
    $_SESSION['order'] = $order;
}
$seciliIlID = $_SESSION['ilID'];
$seciliIlceID = $_SESSION['ilceID'];
if(isset($_GET['s'])){
    if(isset($_SESSION['where'])){ $where = $_SESSION['where']; }
    if(isset($_SESSION['order'])){ $order = $_SESSION['order']; }
    if(isset($_SESSION['filtre_uygula'])){ $post = $_SESSION['filtre_uygula']; }
}
$page = @intval($_GET['s']);
if(!$page) $page = 1;
$ttsorgu = $db->prepare("SELECT COUNT(*) FROM emlaklar WHERE durum = ? AND dil = ? $where");
$ttsorgu->execute(array("1",$_SESSION['k_dil']));
$total = $ttsorgu->fetchColumn();
$limit= $limitayar['limit_emlakkategori'];
$page_count = ceil($total/$limit);
if($page > $page_count) $page = 1;
$show = $page * $limit - $limit;
$BSorgu = $db->prepare("SELECT * FROM emlaklar WHERE durum = ? AND dil = ? $where $order LIMIT $show,$limit");
$BSorgu->execute(array("1",$_SESSION['k_dil']));
$OdaSorgu = $db->query("SELECT oda FROM emlaklar GROUP BY oda ",PDO::FETCH_ASSOC);
$BinaSorgu = $db->query("SELECT bina FROM emlaklar GROUP BY bina ",PDO::FETCH_ASSOC);
$KatSorgu = $db->query("SELECT katsayisi FROM emlaklar GROUP BY katsayisi ",PDO::FETCH_ASSOC);
$BKatSorgu = $db->query("SELECT bulundugukat FROM emlaklar GROUP BY bulundugukat ",PDO::FETCH_ASSOC);
// --- PHP FİLTRELEME MANTIĞI SONU --- //
?>

<!-- ============================ Sayfa Başlığı Başlangıç ================================== -->
<div class="bg-primary py-8 shadow-md">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-display font-bold text-white"><?=@$dil['yaz18'];?></h2>
    </div>
</div>
<!-- ============================ Sayfa Başlığı Bitiş ================================== -->


<!-- ============================ Tüm İlanlar Bölümü Başlangıç ================================== -->
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">

            <!-- Filtreleme Kenar Çubuğu -->
            <div class="w-full lg:w-1/4">
                <div class="p-6 bg-white rounded-xl shadow-soft sticky top-28">
                    <h4 class="text-xl font-display font-semibold mb-4 text-neutral-900"><?=@$dil['yaz25'];?></h4>

                    <form method="POST" action="" class="space-y-6">
                        <!-- Konum Filtreleri -->
                        <div>
                            <label for="il" class="block text-sm font-medium text-neutral-700 mb-1">İl</label>
                            <input type="hidden" id="ilceid" value="<?php if(isset($seciliIlceID)){ echo $seciliIlceID; } ?>">
                            <select id="il" name="il" class="w-full py-2.5 px-4 border border-neutral-200 rounded-lg focus:ring-2 focus:ring-primary">
                                <option value="">Tüm İller</option>
                                <?php $iller = $db->query("SELECT * FROM il ORDER BY id ASC",PDO::FETCH_ASSOC); foreach($iller as $il){ ?>
                                    <option value="<?=$il['id'];?>" <?php if(isset($seciliIlID) && $seciliIlID == $il['id']){ echo 'selected';}?> ><?=$il['il_adi'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div>
                            <label for="ilce" class="block text-sm font-medium text-neutral-700 mb-1">İlçe</label>
                            <select id="ilce" name="ilce" class="w-full py-2.5 px-4 border border-neutral-200 rounded-lg focus:ring-2 focus:ring-primary">
                                <option value="0"><?=@$dil['yaz288'];?></option>
                            </select>
                        </div>

                        <!-- Kelime Arama -->
                        <div>
                            <label for="kelime" class="block text-sm font-medium text-neutral-700 mb-1">Anahtar Kelime</label>
                            <input type="text" name="kelime" id="kelime" class="w-full py-2.5 px-4 border border-neutral-200 rounded-lg focus:ring-2 focus:ring-primary" placeholder="İlan kodu veya başlık" value="<?php if(isset($post['kelime'])){ echo $post['kelime']; }?>">
                        </div>

                        <!-- Fiyat Aralığı -->
                        <div>
                            <label class="block text-sm font-medium text-neutral-700 mb-1"><?=@$dil['yaz34'];?></label>
                            <div class="flex space-x-2">
                                <input type="number" name="min_price" class="w-1/2 py-2.5 px-4 border border-neutral-200 rounded-lg" placeholder="Min" value="<?php if(isset($_POST['min_price'])){ echo $_POST['min_price']; }?>">
                                <input type="number" name="max_price" class="w-1/2 py-2.5 px-4 border border-neutral-200 rounded-lg" placeholder="Max" value="<?php if(isset($_POST['max_price'])){ echo $_POST['max_price']; }?>">
                            </div>
                        </div>

                        <!-- Oda Sayısı -->
                        <div class="pt-4 border-t border-neutral-200">
                             <label class="block text-sm font-medium text-neutral-700 mb-2"><?=@$dil['yaz31'];?></label>
                             <div class="grid grid-cols-2 gap-2">
                                <?php foreach($OdaSorgu as $OdaSonuc){ ?>
                                <div class="flex items-center">
                                    <input id="oda-<?=$OdaSonuc['oda'];?>" name="oda[]" value="<?=$OdaSonuc['oda'];?>" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary" <?php if(isset($post['oda']) && in_array($OdaSonuc['oda'],$post['oda']) ){ echo 'checked';} ?>>
                                    <label for="oda-<?=$OdaSonuc['oda'];?>" class="ml-2 text-sm text-neutral-700"><?=$OdaSonuc['oda'];?></label>
                                </div>
                                <?php } ?>
                             </div>
                        </div>

                        <!-- Buton -->
                        <div class="pt-4">
                            <button class="w-full bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-primary-dark transition-all flex items-center justify-center" type="submit" name="filtre_uygula">
                                <span><?=@$dil['yaz35'];?></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- İlan Listesi -->
            <div class="w-full lg:w-3/4">
                <div class="flex justify-between items-center mb-6">
                    <p class="text-neutral-700">Toplam <span class="font-bold text-primary"><?=$total;?></span> adet ilan bulundu.</p>
                    <form method="POST" action="">
                        <select name="order" class="py-2.5 px-4 border border-neutral-200 rounded-lg focus:ring-2 focus:ring-primary" onchange="this.form.submit()">
                            <option value=""><?=@$dil['yaz26'];?></option>
                            <option <?php if($post['order'] == 'fiyat_artan' ){ echo 'selected'; } ?> value="fiyat_artan"><?=@$dil['yaz27'];?></option>
                            <option <?php if($post['order'] == 'fiyat_azalan' ){ echo 'selected'; } ?> value="fiyat_azalan"><?=@$dil['yaz28'];?></option>
                            <option <?php if($post['order'] == 'eklenen_yeni' ){ echo 'selected'; } ?> value="eklenen_yeni"><?=@$dil['yaz29'];?></option>
                        </select>
                         <button type="submit" name="filtre_uygula" class="hidden"></button> <!-- Formun select değiştiğinde gönderilmesi için -->
                    </form>
                </div>

                <div class="space-y-6">
                <?php foreach($BSorgu as $BSonuc){
                    $ilanUrl = $htc['ilandetayurl'].'/'.$BSonuc['seo'].$html;
                    $ilanKategori = $db->query("SELECT * FROM emlak_kategori WHERE id='{$BSonuc['kategori']}'")->fetch(PDO::FETCH_ASSOC);
                    $ilDetay = $db->query("SELECT * FROM il WHERE id='{$BSonuc['il']}'")->fetch(PDO::FETCH_ASSOC);
                    $ilceDetay = $db->query("SELECT * FROM ilce WHERE id='{$BSonuc['ilce']}'")->fetch(PDO::FETCH_ASSOC);
                ?>
                    <!-- İlan Kartı (Liste Görünümü) -->
                    <div class="bg-white rounded-xl shadow-soft overflow-hidden flex flex-col md:flex-row">
                        <div class="w-full md:w-1/3">
                            <a href="<?=$ilanUrl;?>">
                                <img src="<?php echo tema;?>/uploads/emlaklar/kapak/<?php echo $BSonuc['kapak']?>" class="w-full h-full object-cover" alt="<?=$BSonuc['adi'];?>">
                            </a>
                        </div>
                        <div class="w-full md:w-2/3 p-6 flex flex-col justify-between">
                            <div>
                                <span class="text-xs font-semibold px-3 py-1 bg-primary text-white rounded-full mb-2 inline-block"><?=$ilanKategori['adi'];?></span>
                                <h3 class="text-xl font-display font-semibold text-neutral-900 mb-2">
                                    <a href="<?=$ilanUrl;?>" class="hover:text-primary"><? echo $BSonuc['adi'];?></a>
                                </h3>
                                <p class="text-neutral-700 flex items-center mb-4">
                                    <ion-icon name="location-outline" class="mr-2"></ion-icon>
                                    <span><?=$ilceDetay['ilce_adi'];?> / <?=$ilDetay['il_adi'];?></span>
                                </p>
                                <div class="flex space-x-4 text-sm text-neutral-700">
                                    <span><strong>Oda:</strong> <?=$BSonuc['oda'];?></span>
                                    <span><strong>m²:</strong> <?=$BSonuc['net'];?></span>
                                    <span><strong>Bina Yaşı:</strong> <?=$BSonuc['bina'];?></span>
                                </div>
                            </div>
                            <div class="flex justify-between items-end mt-4 pt-4 border-t border-neutral-200">
                                <p class="text-2xl font-display font-bold text-primary"><?=para_format($BSonuc['fiyat']);?> <?=$BSonuc['pbirim'];?></p>
                                <a href="<?=$ilanUrl;?>" class="bg-secondary text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-opacity-90 transition-all text-sm">Detayları Gör</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>

                <!-- Sayfalama -->
                <div class="mt-12 flex justify-center">
                    <nav class="flex items-center space-x-2">
                        <?php if($limitayar['limit_emlakkategori'] < $total && $limitayar['limit_emlakkategori'] > 0){
                            $showing = 2; // Gösterilecek sayfa sayısı (sağ ve sol)
                            if($page > 1){
                                $previous = $page - 1;
                                echo '<a href="arama?s='.$previous.'" class="px-4 py-2 rounded-lg text-neutral-700 bg-white hover:bg-primary hover:text-white transition-colors"><ion-icon name="chevron-back-outline"></ion-icon></a>';
                            }
                            for($i = $page - $showing; $i < $page + $showing + 1; $i++){
                                if($i > 0 and $i <= $page_count){
                                    if($i == $page){
                                        echo '<span class="px-4 py-2 rounded-lg text-white bg-primary">'.$i.'</span>';
                                    } else {
                                        echo '<a href="arama?s='.$i.'" class="px-4 py-2 rounded-lg text-neutral-700 bg-white hover:bg-primary hover:text-white transition-colors">'.$i.'</a>';
                                    }
                                }
                            }
                            if($page != $page_count){
                                $next = $page + 1;
                                echo '<a href="arama?s='.$next.'" class="px-4 py-2 rounded-lg text-neutral-700 bg-white hover:bg-primary hover:text-white transition-colors"><ion-icon name="chevron-forward-outline"></ion-icon></a>';
                            }
                        } ?>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- ============================ Tüm İlanlar Bölümü Bitiş ================================== -->
