<?php require_once('_class/baglan.php'); 
require_once('_class/fonksiyon.php');require_once('_class/class.upload.php');if(!file_exists('language/dil_'.$_SESSION['k_dil'].".php")) die("Mevcut dilin dosyası bulunamadı!");
require_once('language/dil_'.$_SESSION['k_dil'].".php");
require_once('_class/seo.php'); header("Content-Type:text/xml; Charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
';
?>
<?php $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
$protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
$url=$protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER['PHP_SELF']); 
?>
<?php
if($moduller['alan20'] == "1"){
	$html = ".html";
}
else
{
	$html = "";
}	 
?>
<url>
  <loc><?=$url;?></loc>
</url>

<url>
  <loc><?=$url;?><?php echo(altklasor == "1" ? '/' : '');?><?php echo $htc['belgeurl'];?><?php echo $html;?></loc>
</url>

<url>
  <loc><?=$url;?><?php echo(altklasor == "1" ? '/' : '');?><?php echo $htc['sssurl'];?><?php echo $html;?></loc>
</url>

<url>
  <loc><?=$url;?><?php echo(altklasor == "1" ? '/' : '');?><?php echo $htc['ekiburl'];?><?php echo $html;?></loc>
</url>

<url>
  <loc><?=$url;?><?php echo(altklasor == "1" ? '/' : '');?><?php echo $htc['musteriurl'];?><?php echo $html;?></loc>
</url>

<url>
  <loc><?=$url;?><?php echo(altklasor == "1" ? '/' : '');?><?php echo $htc['ikurl'];?><?php echo $html;?></loc>
</url>


<url>
  <loc><?=$url;?><?php echo(altklasor == "1" ? '/' : '');?><?php echo $htc['projelerurl'];?><?php echo $html;?></loc>
</url>

<url>
  <loc><?=$url;?><?php echo(altklasor == "1" ? '/' : '');?><?php echo $htc['hizmeturl'];?><?php echo $html;?></loc>
</url>

<url>
  <loc><?=$url;?><?php echo(altklasor == "1" ? '/' : '');?><?php echo $htc['haberurl'];?><?php echo $html;?></loc>
</url>

<url>
  <loc><?=$url;?><?php echo(altklasor == "1" ? '/' : '');?><?php echo $htc['iletisimurl'];?><?php echo $html;?></loc>
</url>


<?php $cek=$db->query("SELECT * FROM sayfalar WHERE durum=1 ORDER BY id DESC");
while($veri=$cek->fetch(PDO::FETCH_OBJ)){?>
<url>
<loc><?=$url;?><?php echo(altklasor == "1" ? '/' : '');?><?php echo $htc['sayfaurl'];?>/<? echo $veri->seo; ?><?php echo $html;?></loc>
</url>
<?
echo "\n";
}

// Ürünler
$cek=$db->query("SELECT * FROM emlaklar WHERE durum=1 ORDER BY id desc");
while($veri=$cek->fetch(PDO::FETCH_OBJ)){?>
<url>
<loc><?=$url;?><?php echo(altklasor == "1" ? '/' : '');?><?php echo $htc['ilandetayurl'];?>/<? echo $veri->seo; ?><?php echo $html;?></loc>
</url>
<?
echo "\n";
}

// Ürün Kategori
$cek=$db->query("SELECT * FROM emlak_kategori WHERE durum=1 ORDER BY sira ASC");
while($veri=$cek->fetch(PDO::FETCH_OBJ)){?>
<url>
<loc><?=$url;?><?php echo(altklasor == "1" ? '/' : '');?><?php echo $htc['emlakkategoriurl'];?>/<? echo $veri->seo; ?><?php echo $html;?></loc>
</url>
<?
echo "\n";
}

// Projeler
$cek=$db->query("SELECT * FROM projeler WHERE durum=1 ORDER BY sira ASC");
while($veri=$cek->fetch(PDO::FETCH_OBJ)){?>
<url>
<loc><?=$url;?><?php echo(altklasor == "1" ? '/' : '');?><?php echo $htc['projedetayurl'];?>/<? echo $veri->seo; ?><?php echo $html;?></loc>
</url>
<?
echo "\n";
}

// Projeler Kategori
$cek=$db->query("SELECT * FROM proje_kategori WHERE durum=1 ORDER BY sira ASC");
while($veri=$cek->fetch(PDO::FETCH_OBJ)){?>
<url>
<loc><?=$url;?><?php echo(altklasor == "1" ? '/' : '');?><?php echo $htc['projekategoriurl'];?>/<? echo $veri->seo; ?><?php echo $html;?></loc>
</url>
<?
echo "\n";
}

// Haberler
$cek=$db->query("SELECT * FROM haberler WHERE durum=1 ORDER BY sira ASC");
while($veri=$cek->fetch(PDO::FETCH_OBJ)){?>
<url>
<loc><?=$url;?><?php echo(altklasor == "1" ? '/' : '');?><?php echo $htc['haberdetayurl'];?>/<? echo $veri->seo; ?><?php echo $html;?></loc>
</url>
<?
echo "\n";
}

// Hizmetler
$cek=$db->query("SELECT * FROM hizmetler WHERE durum=1 ORDER BY sira ASC");
while($veri=$cek->fetch(PDO::FETCH_OBJ)){?>
<url>
<loc><?=$url;?><?php echo(altklasor == "1" ? '/' : '');?><?php echo $htc['hizmetdetayurl'];?>/<? echo $veri->seo; ?><?php echo $html;?></loc>
</url>
<?
echo "\n";
}



?>
</urlset>