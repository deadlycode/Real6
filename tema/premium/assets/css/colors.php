<?php 
require_once('../../../../_class/baglan.php');
require_once('../../../../_class/fonksiyon.php');
Header('Content-type: text/css; charset:UTF-8');
?>
/*===============================================
	Header 
================================================ */
.red-skin .btn-theme-2, .red-skin .top-header, .red-skin .pricing-bottom .btn-pricing,
.green-skin .btn-theme-2, .green-skin .top-header, .green-skin .pricing-bottom .btn-pricing,
.blue-skin .btn-theme-2, .blue-skin .top-header, .blue-skin .pricing-bottom .btn-pricing,
.yellow-skin .btn-theme-2, .yellow-skin .top-header, .yellow-skin .pricing-bottom .btn-pricing,
.darkblue-skin .btn-theme-2, .darkblue-skin .top-header, .darkblue-skin .pricing-bottom .btn-pricing,
.oceangreen-skin .btn-theme-2, .oceangreen-skin .top-header, .oceangreen-skin .pricing-bottom .btn-pricing,
.purple-skin .btn-theme-2, .purple-skin .top-header, .purple-skin .pricing-bottom .btn-pricing,
.goodred-skin .btn-theme-2, .goodred-skin .top-header, .goodred-skin .pricing-bottom .btn-pricing,
.goodgreen-skin .btn-theme-2, .goodgreen-skin .top-header, .goodgreen-skin .pricing-bottom .btn-pricing,
.blue2-skin .btn-theme-2, .blue2-skin .top-header, .blue2-skin .pricing-bottom .btn-pricing{ 
	background-color:<?php echo renk1;?>;
	background:<?php echo renk1;?>;
	border-color:<?php echo renk1;?>;
}
.red-skin .hero-search h1, .green-skin .hero-search h1, .blue-skin .hero-search h1, .yellow-skin .hero-search h1, .darkblue-skin .hero-search h1,
.oceangreen-skin .hero-search h1,
.purple-skin .hero-search h1, .goodred-skin .hero-search h1, .goodgreen-skin .hero-search h1, .blue2-skin .hero-search h1{
	color:<?php echo renk1;?> !important;
}
/*-------------- Red Color Option --------------------*/
.red-skin .theme-bg,.red-skin .property-search-type label:hover, .red-skin .property-search-type label.active,
.red-skin li.login-attri.theme-log a,
.red-skin .range-slider .ui-slider .ui-slider-handle,
.red-skin .range-slider .ui-widget-header,
.red-skin .pricing-bottom .btn-pricing:hover, .red-skin .pricing-bottom .btn-pricing:focus
.red-skin .select2-container--default .select2-results__option--highlighted[aria-selected],
.red-skin .pagination li:first-child a,
.red-skin .btn.btn-theme,
.red-skin .btn.btn-theme:hover, .red-skin .btn.btn-theme:focus,
.red-skin .btn.search-btn,
.red-skin .btn-theme-2:hover, .red-skin .btn-theme-2:focus,
.red-skin .btn-outline-theme:hover, .red-skin .btn-outline-theme:focus,
.red-skin .btn.search-btn,
.red-skin .simple-search-wrap .pk-input-group .pk-subscribe-submit,
.red-skin .btn.search-btn-outline:hover, .red-skin .btn.search-btn-outline:focus,
.red-skin .property-listing.property-1 .listing-detail-btn .more-btn,
.red-skin .home-slider-desc .read-more,
.red-skin .nav-tabs .nav-item.show .nav-link, .red-skin .nav-tabs .nav-link.active,
.red-skin .checkbox-custom:checked + .checkbox-custom-label:before,
.red-skin .radio-custom:checked + .radio-custom-label:before,
.red-skin .btn.pop-login,
.red-skin .single-widgets.widget_search form button,
.red-skin .single-widgets.widget_tags ul li a:hover, .red-skin .single-widgets.widget_tags ul li a:focus,
.red-skin .pagination>.active>a, .red-skin .pagination>.active>a:focus, .red-skin .pagination>.active>a:hover, .red-skin .pagination>.active>span, .red-skin .pagination>.active>span:focus, .red-skin .pagination>.active>span:hover, .red-skin .pagination>li>a:focus, .red-skin .pagination>li>a:hover{
	background-color:<?php echo renk2;?>;
	background:<?php echo renk2;?>;
}
 
.red-skin a.link:hover, .red-skin a.link:focus, .red-skin a:hover, a:focus,
.red-skin .theme-cl,
.red-skin .btn.btn-theme-light,
.red-skin .bl-continue,
.red-skin .header-dark-transparent.header-fixed .attributes li.submit-attri a,
.red-skin nav .menu li a.active,
.red-skin nav .menu li.dropdown.open > a,
.red-skin nav .menu .mg-menu li a i, .red-skin nav .menu li a:hover,
.red-skin .recommended .pr-value,
.red-skin .btn-outline-theme,
.red-skin .btn.search-btn-outline,
.red-skin .dw-proprty-info li,
.red-skin .ps-trep .ps-type,
.red-skin .d-navigation ul li.active a,
.red-skin span.mod-close,
.red-skin .blog-page .blog-details blockquote .icon,
.red-skin .single-post-pagination .post-pagination-center-grid a,
.red-skin .blog-page .blog-details .comment-area .all-comments article .comment-details .comment-meta .comment-left-meta .comment-date,
.red-skin .cn-info-icon i, .red-skin .client-info h5,
.red-skin .listing-card-info-price{
	color:<?php echo renk2;?>;
}

.red-skin .pagination>.active>a, .red-skin .pagination>.active>a:focus, .red-skin .pagination>.active>a:hover, .red-skin .pagination>.active>span, .red-skin .pagination>.active>span:focus, .red-skin .pagination>.active>span:hover, .red-skin .pagination>li>a:focus, .red-skin .pagination>li>a:hover,
.red-skin .pagination li:first-child a,
.red-skin .range-slider .ui-slider .ui-slider-handle,
.red-skin .attributes li.submit-attri.theme-log a,
.red-skin .header-dark-transparent.header-fixed .attributes li.submit-attri a,
.red-skin .btn.btn-theme,
.red-skin .btn-theme-2:hover, .red-skin .btn-theme-2:focus,
.red-skin .btn.btn-theme:hover, .red-skin .btn.btn-theme:focus,
.red-skin .btn-outline-theme:hover, .red-skin .btn-outline-theme:focus,
.red-skin .btn-outline-theme,
.red-skin .simple-search-wrap .pk-input-group .pk-subscribe-submit,
.red-skin .btn.search-btn-outline,
.red-skin .btn.search-btn-outline:hover, .red-skin .btn.search-btn-outline:focus,
.red-skin .property-listing.property-1 .listing-detail-btn .more-btn,
.red-skin .nav-tabs .nav-item.show .nav-link, .red-skin .nav-tabs .nav-link.active,
.red-skin .btn.pop-login,
.red-skin .single-widgets.widget_tags ul li a:hover, .red-skin .single-widgets.widget_tags ul li a:focus{
	border-color:<?php echo renk2;?>;
}

.red-skin li.login-attri.theme-log a {
    box-shadow:0 8px 5px rgba(240, 44, 45, 0.2);
	-webkit-box-shadow:0 8px 5px rgba(240, 44, 45, 0.2);
}

footer.dark-footer {
    background: <?php echo renk3;?> !important;
}

.skin-dark-footer .footer-bottom {
     background: <?php echo renk3;?> !important;  
}

.skin-dark-footer .footer-bottom {
     background: <?php echo renk4;?> !important;   
}

.nav-menu>.active>a,
.nav-menu>.focus>a,
.nav-menu>li:hover>a {
    color: <?php echo renk2;?> !important;
}


.nav-dropdown>.focus>a,
.nav-dropdown>li:hover>a {
    color: <?php echo renk2;?> !important;
}
.hsb_btn1{
	background: <?php echo renk2;?> !important;
}
.hsb_btn2{
	background: <?php echo renk2;?> !important;
}
