<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php
$categorySeo = $_GET['id'];

function getCategoryID($catID){
    global $db;
    $categories = [];
    $subCat = [];
    $getCategories = $db->query("SELECT * FROM emlak_kategori WHERE ustid ='{$catID}'",PDO::FETCH_ASSOC);
    if(isset($getCategories)){
        foreach($getCategories as $getCategory){
            $subCat = getCategoryID($getCategory['id']);
            $categories[] = [
                'id'=>$getCategory['id'],
                'sub' =>$subCat,
            ];
            
        }
    }
    return $categories;
}

$checkCategory = $db->query("SELECT * FROM emlak_kategori WHERE seo='{$categorySeo}' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
if(!isset($checkCategory['adi'])){
    header('Location:../');
    die();
}
$catID = $checkCategory['id'];
$where = '';
$order = ' ORDER BY sira ASC ';
$categories = [];
$allCategories = getCategoryID($catID);
foreach($allCategories as $alcategoryID){
    $categories[] = $alcategoryID['id'];
    foreach($alcategoryID['sub'] as $subCatID){
        $categories[] = $subCatID['id'];
    }
}
$categories[] = $catID;
$where .= ' AND (';
foreach ($categories as $categoryID) {
    $where .= ' kategori = "' . $categoryID . '" OR';
}
$where = rtrim($where, 'OR');
$where .= ' )';
$_SESSION['where']=$where;

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
        $where .= ' AND adi LIKE "%' . $_POST['kelime'] . '%" ';
    }

     if(isset($_POST['max_price']) && !empty($_POST['max_price'])){
        $where .= 'AND fiyat <= "' . $_POST['max_price'] . '"';
    }
    
    if(isset($_POST['min_price']) && !empty($_POST['min_price'])){
        $where .= 'AND fiyat >= "' . $_POST['min_price'] . '"';
    }
    
    if (isset($_POST['order'])) {

        switch ($_POST['order']) {
            case 'fiyat_artan':
                $order = ' ORDER BY fiyat ASC ';
                break;
            case 'fiyat_azalan':
                $order = ' ORDER BY fiyat DESC ';
                break;
            case 'eklenen_yeni':
                $order = ' ORDER BY id DESC ';
                break;
            default:
                $order = ' ORDER BY sira ASC ';
                break;
        }
    }
    $_SESSION['filtre_uygula'] = $_POST;
    $_SESSION['where'] = $where;
    $_SESSION['order'] = $order;
}
$seciliIlID = $_SESSION['ilID'];
$seciliIlceID = $_SESSION['ilceID'];


if(isset($_GET['s'])){
    if(isset($_SESSION['where'])){
        $where = $_SESSION['where'];
    }
    if(isset($_SESSION['order'])){
        $order = $_SESSION['order'];
    }
    if(isset($_SESSION['filtre_uygula'])){
        $post = $_SESSION['filtre_uygula'];
    }

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
$fiyatlarSorgu = $db->query("SELECT MAX(fiyat) as max_fiyat , MIN(fiyat) as min_fiyat FROM emlaklar ")->fetch(PDO::FETCH_ASSOC);
$alanlarSorgu = $db->query("SELECT MAX(net) as max_net , MIN(net) as min_net FROM emlaklar  ")->fetch(PDO::FETCH_ASSOC);

$OdaSorgu = $db->query("SELECT oda FROM emlaklar  GROUP BY oda ",PDO::FETCH_ASSOC);
$BinaSorgu = $db->query("SELECT bina FROM emlaklar  GROUP BY bina ",PDO::FETCH_ASSOC);
$KatSorgu = $db->query("SELECT katsayisi FROM emlaklar  GROUP BY katsayisi ",PDO::FETCH_ASSOC);
$BKatSorgu = $db->query("SELECT bulundugukat FROM emlaklar  GROUP BY bulundugukat ",PDO::FETCH_ASSOC);






?>

<!-- ============================ Page Title Start================================== -->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <h2 class="ipt-title"> <?=$checkCategory['adi'];?></h2>

            </div>
        </div>
    </div>
</div>
<!-- ============================ Page Title End ================================== -->

<!-- ============================ All Property ================================== -->
<section>

    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-md-12 list-layout">
                <div class="row">

                    <div class="col-lg-12 col-md-12">
                        <div class="filter-fl">
                            <h4> <span class="theme-cl"><?=$checkCategory['adi'];?></span> için <span class="theme-cl"> <?=$total;?></span> ilan bulundu</h4>

                        </div>
                    </div>
					<?php if($BSorgu->rowCount()){?>
                    <?php foreach($BSorgu as $BSonuc){
                        $ilanUrl = $htc['ilandetayurl'].'/'.$BSonuc['seo'].$html;
                        $ilanKategori = $db->query("SELECT * FROM emlak_kategori WHERE id='{$BSonuc['kategori']}' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                        $ilDetay = $db->query("SELECT * FROM il WHERE id='{$BSonuc['il']}' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                        $ilceDetay = $db->query("SELECT * FROM ilce WHERE id='{$BSonuc['ilce']}' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                        $semtDetay = $db->query("SELECT * FROM semt WHERE id='{$BSonuc['semt']}' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
						$danisman 	= $db->query("SELECT * FROM ekibimiz WHERE id = '{$BSonuc['danisman']}' ORDER BY id ASC LIMIT 1")->fetch();
                        ?>
                        <!-- Single Property Start -->
                        <div class="col-lg-12 col-md-12">
                            <div class="property-listing property-1">

                                <div class="listing-img-wrapper">
                                    <a href="<?=$ilanUrl;?>">
                                        <img src="<?php echo tema;?>/uploads/emlaklar/<?=$BSonuc['kapak'];?>" class="img-fluid mx-auto" alt="" />
                                    </a>
                                    <span class="property-type"><?=$ilanKategori['adi'];?></span>
                                </div>

                                <div class="listing-content">

                                    <div class="listing-detail-wrapper">
                                        <div class="listing-short-detail">
                                            <h4 class="listing-name"><a href="<?=$ilanUrl;?>"><?=$BSonuc['adi'];?></a></h4>
                                            <span class="listing-location"><i class="ti-location-pin"></i>
                                            <?=$semtDetay['semt_adi'];?> <?=$ilceDetay['ilce_adi'];?> / <?=$ilDetay['il_adi'];?>
                                            </span>
                                        </div>
										<?php if($danisman['id']){?>
                                        <div class="list-author">
                                            <a href="<?php echo $htc['ekibdetayurl']; ?>/<?php echo $danisman['seo']; ?><?php echo $html;?>"><img src="<?php echo tema;?>/uploads/ekibimiz/<?php echo $danisman['resim']?>" class="img-fluid img-circle avater-30" alt="<?php echo $danisman['adi']?>" title="<?php echo $danisman['adi']?>"></a>
                                        </div>
										<?php } ?>
                                    </div>

                                    <div class="listing-features-info">
                                        <ul>
                                            <li style="width:auto;flex:auto"><strong><?=@$dil['yaz20'];?>:</strong><?=$BSonuc['kdrumu'];?></li>
                                            <li style="width:auto;flex:auto"><strong><?=@$dil['yaz21'];?>:</strong><?=$BSonuc['takas'] ? $BSonuc['takas'] : '-';?></li>
                                            <li style="width:auto;flex:auto"><strong><?=@$dil['yaz22'];?>:</strong><?=$BSonuc['net'];?></li>
                                        </ul>
                                    </div>

                                    <div class="listing-footer-wrapper">
                                        <div class="listing-price">
                                            <h4 class="list-pr fiyatrenk"><?=para_format($BSonuc['fiyat']);?> <?=$BSonuc['pbirim'];?></h4>
                                        </div>
                                        <div class="listing-detail-btn">
                                            <a href="<?=$ilanUrl;?>" class="more-btn"><?=@$dil['yaz23'];?></a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- Single Property End -->
                    <?php } ?>
					<?php }else{?>	
					<div class="col-12">
						<div class="alert alert-warning text-left w-100" role="alert">
							<p><strong><?=@$dil['txt104'];?></strong></p>
							<?=@$dil['txt105'];?></br>
							<?=@$dil['txt106'];?>
						</div>
					</div>
					<?php }?>


                </div>

                <!-- Pagination -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <ul class="pagination p-center">
                            <?php if($limitayar['limit_emlakkategori'] < $total && $limitayar['limit_emlakkategori'] > 0){
                                $showing = 3;
                                if($page > 1){?>
                                    <?php $previous = $page - 1;?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo $htc['emlakkategoriurl'];?>/<?=$categorySeo;?>?s=<?php echo $previous;?>" aria-label="Previous">
                                            <span class="ti-arrow-left"></span>
                                            <span class="sr-only"><?=@$dil['yaz24'];?></span>
                                        </a>
                                    </li>
                                <?php }
                                for($i= $page - $showing; $i < $page + $showing + 1; $i++){
                                    if($i > 0 and $i <= $page_count){
                                        if($i == $page){?>
                                            <li class="page-item active"><a class="page-link" href="#"><?php echo $i; ?></a></li>
                                        <?php }else{?>
                                            <li class="page-item"><a class="page-link" href="<?php echo $htc['emlakkategoriurl'];?>/<?=$categorySeo;?>?s=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                        <?php }}}if($page != $page_count){?>
                                    <?php  $next = $page +1;?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo $htc['emlakkategoriurl'];?>/<?=$categorySeo;?>?s=<?php echo $next; ?>" aria-label="Next">
                                            <span class="ti-arrow-right"></span>
                                            <span class="sr-only"><?=@$dil['yaz24'];?></span>
                                        </a>
                                    </li>
                                <?php }} ?>
                        </ul>
                    </div>
                </div>

            </div>

            <!-- property Sidebar -->
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="page-sidebar">

                    <!-- Find New Property -->
                    <div class="sidebar-widgets">

                        <h4><?=@$dil['yaz25'];?></h4>



                        <form method="POST" action="">
                            <div class="form-group">
                                     <input type="hidden" id="ilceid" value="<?php if(isset($seciliIlceID)){ echo $seciliIlceID; } ?>">
                                    
                                <div class="input-with-icon">
                                    <select id="il" class="form-control" name="il">
                                        <option value="">Tüm İller</option>
                                        <?php $iller = $db->query("SELECT * FROM il ORDER BY id ASC",PDO::FETCH_ASSOC); foreach($iller as $il){ ?>
                                         <option value="<?=$il['id'];?>" <?php if(isset($seciliIlID) && isset($seciliIlID) && $seciliIlID == $il['id']){ echo 'selected';}?> ><?=$il['il_adi'];?></option>
                                        <?php } ?>
                                    </select>
                                    <i class="ti-briefcase"></i>
                                </div>
                            </div>




                            <div class="form-group">
                                <div class="input-with-icon">
                                    <select id="ilce" class="form-control" name="ilce">
                                        <option value="0"><?=@$dil['yaz288'];?></option>
                                    </select>
                                    <i class="ti-briefcase"></i>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-with-icon">
                                    <select id="order" class="form-control" name="order">
                                        <option value=""><?=@$dil['yaz26'];?></option>
                                        <option <?php if($post['order'] == 'fiyat_artan' ){ echo 'selected'; } ?> value="fiyat_artan"><?=@$dil['yaz27'];?></option>
                                        <option <?php if($post['order'] == 'fiyat_azalan' ){ echo 'selected'; } ?> value="fiyat_azalan"><?=@$dil['yaz28'];?></option>
                                        <option <?php if($post['order'] == 'eklenen_yeni' ){ echo 'selected'; } ?> value="eklenen_yeni"><?=@$dil['yaz29'];?></option>
                                    </select>
                                    <i class="ti-briefcase"></i>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-with-icon">
                                    <input type="text" class="form-control" placeholder="<?=@$dil['yaz69'];?>" name="kelime" value="<?php if(isset($post['filtre_uygula'])){ echo $post['kelime']; }?>">
                                    <i class="ti-search"></i>
                                </div>
                            </div>

                            <div class="form-group kenarlik">
                                <label class="labelbaslik"><?=@$dil['yaz30'];?></label>
                                <ul class="no-ul-list">
                                    <?php foreach($KatSorgu as $KatSonuc){ ?>
                                        <li>
                                            <input id="katsayisi-<?=$KatSonuc['katsayisi'];?>" class="checkbox-custom" name="katsayisi[]" value="<?=$KatSonuc['katsayisi'];?>" type="checkbox" <?php if(isset($post['filtre_uygula']) && isset($post['katsayisi']) && in_array($KatSonuc['katsayisi'],$post['katsayisi']) ){ echo 'checked';} ?>>
                                            <label for="katsayisi-<?=$KatSonuc['katsayisi'];?>" class="checkbox-custom-label"><?=$KatSonuc['katsayisi'];?></label>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>

                            <div class="form-group kenarlik">
                                <label class="labelbaslik"><?=@$dil['yaz31'];?></label>
                                <ul class="no-ul-list">
                                    <?php foreach($OdaSorgu as $OdaSonuc){ ?>
                                        <li>
                                            <input id="oda-<?=$OdaSonuc['oda'];?>" class="checkbox-custom" name="oda[]" value="<?=$OdaSonuc['oda'];?>" type="checkbox" <?php if(isset($post['filtre_uygula']) && isset($post['oda']) && in_array($OdaSonuc['oda'],$post['oda']) ){ echo 'checked';} ?>>
                                            <label for="oda-<?=$OdaSonuc['oda'];?>" class="checkbox-custom-label"><?=$OdaSonuc['oda'];?></label>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>

                            <div class="form-group kenarlik">
                                <label class="labelbaslik"><?=@$dil['yaz32'];?></label>
                                <ul class="no-ul-list">
                                    <?php foreach($BinaSorgu as $BinaSonuc){ ?>
                                        <li>
                                            <input id="bina-<?=$BinaSonuc['bina'];?>" class="checkbox-custom" name="bina[]" value="<?=$BinaSonuc['bina'];?>" type="checkbox" <?php if(isset($post['filtre_uygula']) && isset($post['bina']) && in_array($BinaSonuc['bina'],$post['bina']) ){ echo 'checked';} ?>>
                                            <label for="bina-<?=$BinaSonuc['bina'];?>" class="checkbox-custom-label"><?=$BinaSonuc['bina'];?></label>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>

                            <div class="form-group kenarlik">
                                <label class="labelbaslik"><?=@$dil['yaz33'];?></label>
                                <ul class="no-ul-list">
                                    <?php foreach($BKatSorgu as $BKatSonuc){ ?>
                                        <li>
                                            <input id="bulundugukat-<?=$BKatSonuc['bulundugukat'];?>" class="checkbox-custom" name="bulundugukat[]" value="<?=$BKatSonuc['bulundugukat'];?>" type="checkbox" <?php if(isset($post['filtre_uygula']) && isset($post['bulundugukat']) && in_array($BKatSonuc['bulundugukat'],$post['bulundugukat']) ){ echo 'checked';} ?>>
                                            <label for="bulundugukat-<?=$BKatSonuc['bulundugukat'];?>" class="checkbox-custom-label"><?=$BKatSonuc['bulundugukat'];?></label>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            
                            
                            <div class="form-group kenarlik">
                                <label class="labelbaslik"><?=@$dil['yaz34'];?></label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label id="min_price">Min.Fiyat</label>
                                        <input type="number" step="0.01" class="form-control" name="min_price" id="min_price" value="<?php if(isset($_POST['min_price'])){ echo $_POST['min_price']; }?>">
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label id="max_price">Max.Fiyat</label>
                                        <input type="number" step="0.01" class="form-control" name="max_price" id="max_price" value="<?php if(isset($_POST['max_price'])){ echo $_POST['max_price']; }?>">
                                    </div>
                                </div>
                            </div>





                            <div class="ameneties-features">
                                <button class="btn btn-theme full-width" type="submit" name="filtre_uygula"><?=@$dil['yaz35'];?></button>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- Sidebar End -->

            </div>
        </div>
    </div>
</section>
