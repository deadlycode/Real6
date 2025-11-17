<?php


echo !defined("GUVENLIK") ? exit : NULL;
echo "\r\n";
oturumkontrol($url);
$ayar_dizi = $db->prepare("SELECT * FROM ayarlar WHERE id = ?");
$ayar_dizi->execute([1]);
if ($ayar_dizi->rowCount()) {
    $Sonuc = $ayar_dizi->fetch(PDO::FETCH_ASSOC);
    echo "\r\n<div class=\"page-header\">\r\r\n\t<div class=\"page-title mt-0 mb-0\">\r\r\n\t\t<h3>";
    echo $admindil["txt15_1"];
    echo "</h3>\r\r\n\t\t<div class=\"crumbs\">\r\r\n\t\t\t<ul id=\"breadcrumbs\" class=\"breadcrumb\">\r\r\n\t\t\t\t<li><a href=\"./\"><i class=\"icon-home menu-icon\"></i></a></li>\r\r\n\t\t\t\t<li><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt13"];
    echo "</a></li>\r\r\n\t\t\t\t<li class=\"active\"><a href=\"";
    echo $sayfalink;
    echo "\">";
    echo $admindil["txt15_1"];
    echo "</a></li>\r\r\n\t\t\t</ul>\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n</div>\r\r\n<div class=\"row\">\r\r\n\t<div class=\"col-12 grid-margin stretch-card\">\r\r\n\t\t<div class=\"card\">\r\r\n\t\t\t<div class=\"card-body\">\t\r\r\n\t\t\t\t<div class=\"row\">\r\r\n\t\t\t\t\t<div class=\"col-12\">\r\r\n\t\t\t\t\t";
    $dizin = "../language/admin_dil.php";
    require_once "../language/admin_dil.php";
    $yazan = "";
    if (0 < count($admindil)) {
        echo "\t\t\t\t\r\r\n\t\t\t\t\t\t<div class=\"table-responsive\">\r\r\n\t\t\t\t\t\t\t<table id=\"editable-form\" class=\"table table-bordered user-list\">\r\r\n\t\t\t\t\t\t\t\t<thead>\r\r\n\t\t\t\t\t\t\t\t\t<tr>\r\r\n\t\t\t\t\t\t\t\t\t\t<th style=\"width:250px;\">Key</th>\r\r\n\t\t\t\t\t\t\t\t\t\t<th>Açıklama</th>\r\r\n\t\t\t\t\t\t\t\t\t</tr>\r\r\n\t\t\t\t\t\t\t\t</thead>\r\r\n\t\t\t\t\t\t\t\t<tbody>\r\r\n\t\t\t\t\t\t\t\t\t";
        $i = 1;
        foreach ($admindil as $key => $d) {
            echo "\r\n\t\t\t\t\t\t\t\t\t<tr>\r\r\n\t\t\t\t\t\t\t\t\t\t<td class=\"uneditable\">";
            echo $key;
            echo "</td>\r\r\n\t\t\t\t\t\t\t\t\t\t<td><input type=\"text\" name=\"text\" id=\"text";
            echo $i++;
            echo "\" value=\"";
            echo $d;
            echo "\" onchange=\"saveData(event,'";
            echo $key;
            echo "')\"><span style=\"display:none\">";
            echo $d;
            echo "</span></td>\t\t\t\t\t\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t\t\t\t</tr>\r\r\n\t\t\t\t\t\t\t\t\t";
        }
        echo "\r\n\t\t\t\t\t\t\t\t</tbody>\r\r\n\t\t\t\t\t\t\t</table>\r\r\n\t\t\t\t\t\t</div>\t\t\r\r\n\t\t\t\t\t\t";
    } else {
        echo "\r\n\t\t\t\t\t\t<div class=\"alert alert-danger\">\r\r\n\t\t\t\t\t\t\t<strong>Kritik Hata!</strong> Dil dosyası bulunamadı veya içi boş acilen ";
        echo str_replace("/", "\\", $dizin);
        echo " yerini doldurun. Veya düzenleye basıp otomatik olarak ekleyebilirsiniz.\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t";
    }
    echo "\r\n\t\t\t\t\t</div>\r\r\n\t\t\t\t</div>\r\r\n\t\t\t</div>\t\t\t\t\t\t\t\t\t\t\t\t\r\r\n\t\t</div>\r\r\n\t</div>\r\r\n\r\r\n</div>\r\r\n<style>\r\r\n    table input{\r\r\n        font-size:14px;\r\r\n        padding:5px 0px;\r\r\n        display:block;\r\r\n        width:100%;\r\r\n\t\tcolor: #03a9f4;\r\r\n\t\tcursor:pointer;\r\r\n        border:none;\r\r\n        background: transparent;\r\r\n        text-decoration: underline;\r\r\n        text-decoration-color: #0088cc;\r\r\n        text-decoration-style: dashed;\r\r\n\r\r\n    }\r\r\n    table input:focus{\r\r\n        outline: none;\r\r\n        border-bottom: 1px dashed #0088cc;\r\r\n        text-decoration: none;\r\r\n    }\r\r\n\ttable tr {\r\r\n \t\tbox-shadow: none;\r\r\n\t}\r\r\n\t/* Absolute Center Spinner */\r\r\n    .loading {\r\r\n        position: fixed;\r\r\n        z-index: 999;\r\r\n        height: 2em;\r\r\n        width: 2em;\r\r\n        overflow: visible;\r\r\n        margin: auto;\r\r\n        top: 0;\r\r\n        left: 0;\r\r\n        bottom: 0;\r\r\n        right: 0;\r\r\n    }\r\r\n\r\r\n    /* Transparent Overlay */\r\r\n    .loading:before {\r\r\n        content: '';\r\r\n        display: block;\r\r\n        position: fixed;\r\r\n        top: 0;\r\r\n        left: 0;\r\r\n        width: 100%;\r\r\n        height: 100%;\r\r\n        background-color: rgba(0,0,0,0.3);\r\r\n    }\r\r\n\r\r\n    /* :not(:required) hides these rules from IE9 and below */\r\r\n    .loading:not(:required) {\r\r\n        /* hide \"loading...\" text */\r\r\n        font: 0/0 a;\r\r\n        color: transparent;\r\r\n        text-shadow: none;\r\r\n        background-color: transparent;\r\r\n        border: 0;\r\r\n    }\r\r\n\r\r\n    .loading:not(:required):after {\r\r\n        content: '';\r\r\n        display: block;\r\r\n        font-size: 10px;\r\r\n        width: 1em;\r\r\n        height: 1em;\r\r\n        margin-top: -0.5em;\r\r\n        -webkit-animation: spinner 1500ms infinite linear;\r\r\n        -moz-animation: spinner 1500ms infinite linear;\r\r\n        -ms-animation: spinner 1500ms infinite linear;\r\r\n        -o-animation: spinner 1500ms infinite linear;\r\r\n        animation: spinner 1500ms infinite linear;\r\r\n        border-radius: 0.5em;\r\r\n        -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;\r\r\n        box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;\r\r\n    }\r\r\n\r\r\n    /* Animation */\r\r\n\r\r\n    @-webkit-keyframes spinner {\r\r\n        0% {\r\r\n            -webkit-transform: rotate(0deg);\r\r\n            -moz-transform: rotate(0deg);\r\r\n            -ms-transform: rotate(0deg);\r\r\n            -o-transform: rotate(0deg);\r\r\n            transform: rotate(0deg);\r\r\n        }\r\r\n        100% {\r\r\n            -webkit-transform: rotate(360deg);\r\r\n            -moz-transform: rotate(360deg);\r\r\n            -ms-transform: rotate(360deg);\r\r\n            -o-transform: rotate(360deg);\r\r\n            transform: rotate(360deg);\r\r\n        }\r\r\n    }\r\r\n    @-moz-keyframes spinner {\r\r\n        0% {\r\r\n            -webkit-transform: rotate(0deg);\r\r\n            -moz-transform: rotate(0deg);\r\r\n            -ms-transform: rotate(0deg);\r\r\n            -o-transform: rotate(0deg);\r\r\n            transform: rotate(0deg);\r\r\n        }\r\r\n        100% {\r\r\n            -webkit-transform: rotate(360deg);\r\r\n            -moz-transform: rotate(360deg);\r\r\n            -ms-transform: rotate(360deg);\r\r\n            -o-transform: rotate(360deg);\r\r\n            transform: rotate(360deg);\r\r\n        }\r\r\n    }\r\r\n    @-o-keyframes spinner {\r\r\n        0% {\r\r\n            -webkit-transform: rotate(0deg);\r\r\n            -moz-transform: rotate(0deg);\r\r\n            -ms-transform: rotate(0deg);\r\r\n            -o-transform: rotate(0deg);\r\r\n            transform: rotate(0deg);\r\r\n        }\r\r\n        100% {\r\r\n            -webkit-transform: rotate(360deg);\r\r\n            -moz-transform: rotate(360deg);\r\r\n            -ms-transform: rotate(360deg);\r\r\n            -o-transform: rotate(360deg);\r\r\n            transform: rotate(360deg);\r\r\n        }\r\r\n    }\r\r\n    @keyframes spinner {\r\r\n        0% {\r\r\n            -webkit-transform: rotate(0deg);\r\r\n            -moz-transform: rotate(0deg);\r\r\n            -ms-transform: rotate(0deg);\r\r\n            -o-transform: rotate(0deg);\r\r\n            transform: rotate(0deg);\r\r\n        }\r\r\n        100% {\r\r\n            -webkit-transform: rotate(360deg);\r\r\n            -moz-transform: rotate(360deg);\r\r\n            -ms-transform: rotate(360deg);\r\r\n            -o-transform: rotate(360deg);\r\r\n            transform: rotate(360deg);\r\r\n        }\r\r\n    }\r\r\n</style>\r\r\n<div class=\"loader\" style=\"display: none\">\r\r\n    <div class=\"loading\">Lütfen Bekleyiniz</div>\r\r\n</div>\r\r\n<script>\r\r\n\$(function() {\r\r\n\$('#editable-form').DataTable({\r\r\n  \"aLengthMenu\": [\r\r\n\t[5, 10, 15, -1],\r\r\n\t[5, 10, 15, \"Tümü\"]\r\r\n  ],\r\r\n  \"iDisplayLength\": 20,\r\r\n  \"language\": {\r\r\n\t\t\"url\":\"js/Turkish.json\"\r\r\n\t}\r\r\n});\r\r\n\r\r\n\$('#order-listing').each(function() {\r\r\n\tvar datatable = \$(this);\r\r\n\tvar search_input = datatable.closest('.dataTables_wrapper').find('div[id\$=_filter] input');\r\r\n\tsearch_input.attr('placeholder', 'Search');\r\r\n\tsearch_input.removeClass('form-control-sm');\r\r\n\tvar length_sel = datatable.closest('.dataTables_wrapper').find('div[id\$=_length] select');\r\r\n\tlength_sel.removeClass('form-control-sm');\r\r\n});\r\r\n});\r\r\nfunction saveData(event,key){\r\r\n\tvar value = \$('#'+event.target.id).val();\r\r\n\t\$('.loader').show();\r\r\n\t\$.post(\"../_class/yonetim_islem.php\",{\r\r\n\t\tkey: key,\r\r\n\t\tvalue: value,\r\r\n\t\tadmindilchange:\"true\",\r\r\n\t\tdil_id:\"";
    echo $Sonuc["id"];
    echo "\"\r\r\n\t}, function(){\r\r\n\t\t\$('.loader').hide();\r\r\n\t\t";
    if ($_SESSION["rutbe"] == 0) {
        echo "\r\n\t\t\$.toast({\r\r\n\t\t  heading: 'Başarılı!',\r\r\n\t\t  text: 'Başarı ile guncellenmiştir.',\r\r\n\t\t  showHideTransition: 'slide',\r\r\n\t\t  icon: 'success',\r\r\n\t\t  loaderBg: '#fff',\r\r\n\t\t  position: 'top-right'\r\r\n\t\t})\r\r\n\t\t";
    } else {
        echo "\r\n\t\t\$.toast({\r\r\n\t\t  heading: 'Uyarı',\r\r\n\t\t  text: 'Demo hesapta işlem yapamassınız.!',\r\r\n\t\t  showHideTransition: 'slide',\r\r\n\t\t  icon: 'warning',\r\r\n\t\t  loaderBg: '#fff',\r\r\n\t\t  position: 'top-right'\r\r\n\t\t})\r\r\n\t\t";
    }
    echo "\r\n\t});\r\r\n}\r\r\n</script>\r\r\n";
    
} else {
    header("Location:" . $url . "/404" . $html . "");
    exit;
}

?>