<?php


require_once "../../_class/baglan.php";
require_once "../../_class/fonksiyon.php";
$id = $_POST["id"];
$ozellik = $_POST["ozellik"];
$dil = $_POST["dil"];
$OZKATSorgu = $db->prepare("SELECT * FROM ozellik_kategori WHERE durum = ? AND dil = ? AND find_in_set(?,kategori) ORDER BY sira ASC");
$OZKATSorgu->execute(["1", $dil, $id]);
$OZKATislem = $OZKATSorgu->fetchALL(PDO::FETCH_ASSOC);
$ozellikler = [];
foreach (explode(",", $ozellik) as $k => $v) {
    $id = explode("-", $v);
    $ozellikler[] = ["id" => $id[0], "value" => explode("|", $id[1])];
}
foreach ($OZKATislem as $OZKATSonuc) {
    echo "\t\r\n\t<div class=\"card mb-4 bg-light\">\r\n\t\t<div class=\"card-header\">";
    echo $OZKATSonuc["adi"];
    echo "</div>\r\n\t\t<div class=\"card-body p-2\">\r\n\t\t\t<div class=\"row\">\r\n\t\t\t";
    $OZSorgu = $db->prepare("SELECT * FROM ozellik WHERE durum = ? AND dil = ? AND kategori = ? ORDER BY id DESC");
    $OZSorgu->execute(["1", $dil, $OZKATSonuc["id"]]);
    $OZislem = $OZSorgu->fetchALL(PDO::FETCH_ASSOC);
    echo "\t\t\t\t";
    $ozdahiller = explode(",", $ozellik);
    echo "\t\t\t\t";
    foreach ($OZislem as $OZSonuc) {
        $ozellikK = array_search($OZSonuc["kategori"], array_column($ozellikler, "id"));
        $ozellikID = $varyantK !== false ? array_search($OZSonuc["id"], $ozellikler[$ozellikK]["value"]) : false;
        echo "\t\t\t\t<div class=\"col-lg-4\">\r\n\t\t\t\t\t<div class=\"form-check mx-sm-2\">\r\n\t\t\t\t\t\t<label class=\"form-check-label\">\r\n\t\t\t\t\t\t<input name=\"ozellik[]\" type=\"checkbox\" class=\"form-check-input \" value=\"";
        echo $OZSonuc["kategori"];
        echo "-";
        echo $OZSonuc["id"];
        echo "\" ";
        if ($ozellikID !== false) {
            echo "checked";
        }
        echo ">\r\n\t\t\t\t\t\t";
        echo $OZSonuc["adi"];
        echo "\t\t\t\t\t\t<i class=\"input-helper\"></i>\r\n\t\t\t\t\t\t</label>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div><!-- /.col-lg-6 -->\r\n\t\t\t\t";
    }
    echo "\t\t\t\t\t\t\t\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n\t";
}

?>