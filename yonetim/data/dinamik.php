<?php


require_once "../../_class/baglan.php";
require_once "../../_class/fonksiyon.php";
if ($_POST["ilid"]) {
    $id = $_POST["ilid"];
    $ilceid = $_POST["ilceid"];
    $dizi = [];
    $geridon = "<option value='0'>Seçiniz</option>";
    $query = $db->prepare("SELECT * FROM ilce WHERE il_id = ? ORDER BY ilce_adi ASC");
    $query->execute([$id]);
    $islem = $query->fetchALL(PDO::FETCH_ASSOC);
    foreach ($islem as $ILCESonuc) {
        $ilgetir = $db->query("SELECT * FROM il WHERE id = '" . $ILCESonuc["il_id"] . "'")->fetch(PDO::FETCH_ASSOC);
        $geridon .= "<option value=\"" . $ILCESonuc["id"] . "\" data-foo=\"" . $ILCESonuc["ilce_adi"] . "," . $ilgetir["il_adi"] . ",Türkiye\" " . ($ILCESonuc["id"] == $ilceid ? "selected" : "") . " >" . $ILCESonuc["ilce_adi"] . "</option>";
    }
    $dizi["basari"] = $geridon;
    echo json_encode($dizi);
} else {
    if ($_POST["ilceid"]) {
        $id = $_POST["ilceid"];
        $semtid = $_POST["semtid"];
        $dizi = [];
        $geridon = "<option value='0'>Seçiniz</option>";
        $query = $db->prepare("SELECT * FROM semt WHERE ilce_id = ? ORDER BY semt_adi ASC");
        $query->execute([$id]);
        $islem = $query->fetchALL(PDO::FETCH_ASSOC);
        foreach ($islem as $SEMTSonuc) {
            $ilgetir = $db->query("SELECT * FROM il WHERE id = '" . $SEMTSonuc["il_id"] . "'")->fetch(PDO::FETCH_ASSOC);
            $geridon .= "<option value=\"" . $SEMTSonuc["id"] . "\">" . $SEMTSonuc["semt_adi"] . "";
            $mahalleler = $db->prepare("SELECT * FROM mahalle WHERE semt_id = ? ORDER BY mahalle_adi ASC");
            $mahalleler->execute([$SEMTSonuc["id"]]);
            $mahalleIsle = $mahalleler->fetchALL(PDO::FETCH_ASSOC);
            foreach ($mahalleIsle as $k => $v) {
                $geridon .= "<option value=\"" . $v["id"] . "\" data-foo=\"" . $v["mahalle_adi"] . "," . $SEMTSonuc["semt_adi"] . "," . $ilgetir["il_adi"] . ",Türkiye\" " . ($v["id"] == $semtid ? "selected" : "") . " >" . $v["mahalle_adi"] . "</option>";
            }
            $geridon .= "</option>";
        }
        $dizi["basari"] = $geridon;
        echo json_encode($dizi);
    }
}

?>