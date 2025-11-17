<?php
// Tema renk ayarlarını dinamik olarak yükle
require_once '../../../../_class/baglan.php';

// Aktif temayı al
$tema_sorgu = $db->query("SELECT t.* FROM tema_ayarlari t 
                          INNER JOIN ayarlar a ON a.site_tema = t.tema_klasor 
                          WHERE a.id = 1");
$tema = $tema_sorgu->fetch(PDO::FETCH_ASSOC);

// Eğer tema bulunamazsa varsayılan renkleri kullan
if (!$tema) {
    $tema = [
        'renk1' => '#252c41',
        'renk2' => '#4073ac',
        'renk3' => '#252c41',
        'renk4' => '#1b2132',
        'buton_renk' => '#4073ac',
        'link_renk' => '#4073ac',
        'baslik_renk' => '#252c41'
    ];
}

// CSS header
header('Content-Type: text/css; charset=UTF-8');
header('Cache-Control: must-revalidate');

// CSS çıktısı
?>
/* Dinamik Tema Renkleri */
/* Bu dosya otomatik olarak oluşturulmuştur */

:root {
    --tema-renk1: <?php echo $tema['renk1']; ?>;
    --tema-renk2: <?php echo $tema['renk2']; ?>;
    --tema-renk3: <?php echo $tema['renk3']; ?>;
    --tema-renk4: <?php echo $tema['renk4']; ?>;
    --tema-buton: <?php echo $tema['buton_renk']; ?>;
    --tema-link: <?php echo $tema['link_renk']; ?>;
    --tema-baslik: <?php echo $tema['baslik_renk']; ?>;
}

/* Ana Renk Uygulamaları */
.btn-theme, .btn-primary, .btn-theme-2 {
    background-color: <?php echo $tema['buton_renk']; ?> !important;
    border-color: <?php echo $tema['buton_renk']; ?> !important;
}

.btn-theme:hover, .btn-primary:hover, .btn-theme-2:hover {
    background-color: <?php echo $tema['renk2']; ?> !important;
    border-color: <?php echo $tema['renk2']; ?> !important;
}

/* Header ve Navigation */
.top-header, .header-style-2 {
    background-color: <?php echo $tema['renk1']; ?> !important;
}

.nav-menu > li:hover > a,
.nav-menu > .focus > a {
    color: <?php echo $tema['link_renk']; ?> !important;
}

/* Footer */
footer.dark-footer,
.skin-dark-footer .footer-bottom {
    background: <?php echo $tema['renk3']; ?> !important;
}

/* Linkler */
a {
    color: <?php echo $tema['link_renk']; ?>;
}

a:hover {
    color: <?php echo $tema['renk2']; ?>;
}

/* Başlıklar */
h1, h2, h3, h4, h5, h6,
.hero-search h1 {
    color: <?php echo $tema['baslik_renk']; ?> !important;
}

/* Fiyat ve Önemli Bilgiler */
.listing-card-info-price,
.price-box {
    color: <?php echo $tema['renk2']; ?> !important;
}

/* İkonlar */
.cn-info-icon i {
    color: <?php echo $tema['renk2']; ?>;
}

/* Butonlar */
.hsb_btn1, .hsb_btn2 {
    background: <?php echo $tema['buton_renk']; ?> !important;
}

.hsb_btn1:hover, .hsb_btn2:hover {
    background: <?php echo $tema['renk2']; ?> !important;
}

/* Pagination */
.pagination > .active > a,
.pagination > .active > a:focus,
.pagination > .active > a:hover,
.pagination > .active > span,
.pagination > .active > span:focus,
.pagination > .active > span:hover {
    background-color: <?php echo $tema['renk2']; ?> !important;
    border-color: <?php echo $tema['renk2']; ?> !important;
}

.pagination > li > a:focus,
.pagination > li > a:hover {
    background-color: <?php echo $tema['renk2']; ?> !important;
}

/* Tags */
.single-widgets.widget_tags ul li a:hover,
.single-widgets.widget_tags ul li a:focus {
    background-color: <?php echo $tema['renk2']; ?> !important;
    border-color: <?php echo $tema['renk2']; ?> !important;
}

/* Form Elements */
.form-control:focus {
    border-color: <?php echo $tema['renk2']; ?>;
}

/* Badges */
.badge-primary {
    background-color: <?php echo $tema['renk2']; ?> !important;
}

/* Progress Bars */
.progress-bar {
    background-color: <?php echo $tema['renk2']; ?> !important;
}

/* Alerts */
.alert-primary {
    background-color: <?php echo $tema['renk1']; ?>;
    border-color: <?php echo $tema['renk2']; ?>;
}

/* Cards */
.card-header {
    background-color: <?php echo $tema['renk1']; ?>;
    color: #fff;
}

/* Dropdown */
.dropdown-menu .dropdown-item:hover {
    background-color: <?php echo $tema['renk2']; ?>;
    color: #fff;
}

/* Tabs */
.nav-tabs .nav-link.active {
    border-color: <?php echo $tema['renk2']; ?>;
    color: <?php echo $tema['renk2']; ?>;
}

/* Slider */
.slider-overlay {
    background: linear-gradient(to right, <?php echo $tema['renk1']; ?>cc, <?php echo $tema['renk2']; ?>cc);
}

/* Search Box */
.main-search-box {
    border-color: <?php echo $tema['renk2']; ?>;
}

/* Property Cards */
.property-listing .property-footer {
    border-top-color: <?php echo $tema['renk2']; ?>;
}

/* Cookie Consent */
.cc-window {
    background: <?php echo $tema['renk2']; ?> !important;
}

/* Scrollbar */
::-webkit-scrollbar-thumb {
    background: <?php echo $tema['renk2']; ?>;
}

/* Selection */
::selection {
    background: <?php echo $tema['renk2']; ?>;
    color: #fff;
}

::-moz-selection {
    background: <?php echo $tema['renk2']; ?>;
    color: #fff;
}

/* Loading Spinner */
.spinner-border {
    border-color: <?php echo $tema['renk2']; ?>;
    border-right-color: transparent;
}

/* Custom Checkbox */
.custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
    background-color: <?php echo $tema['renk2']; ?>;
    border-color: <?php echo $tema['renk2']; ?>;
}

/* Custom Radio */
.custom-radio .custom-control-input:checked ~ .custom-control-label::before {
    background-color: <?php echo $tema['renk2']; ?>;
    border-color: <?php echo $tema['renk2']; ?>;
}

/* Tooltips */
.tooltip-inner {
    background-color: <?php echo $tema['renk1']; ?>;
}

/* Popovers */
.popover-header {
    background-color: <?php echo $tema['renk1']; ?>;
}

/* Modal */
.modal-header {
    background-color: <?php echo $tema['renk1']; ?>;
    color: #fff;
}

/* Breadcrumb */
.breadcrumb-item.active {
    color: <?php echo $tema['renk2']; ?>;
}

/* List Group */
.list-group-item.active {
    background-color: <?php echo $tema['renk2']; ?>;
    border-color: <?php echo $tema['renk2']; ?>;
}
