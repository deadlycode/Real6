<?php


if (!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {
    require_once "../../_class/baglan.php";
    require_once "../../_class/fonksiyon.php";
    $request = $_REQUEST;
    $col = ["id", "emlak", "danisman", "adsoyad", "telefon", "email", "mesaj", "islem"];
    $sql = "SELECT * FROM emlak_mesajlar";
    $totalFilter = $db->query($sql)->rowCount();
    if (!empty($request["search"]["value"])) {
        $sql .= " AND (id LIKE '" . $request["search"]["value"] . "%' ";
        $sql .= " OR adsoyad LIKE '" . $request["search"]["value"] . "%' )";
    }
    $totalData = $db->query($sql)->rowCount();
    $sql .= " ORDER BY id   " . $request["order"][0]["dir"] . "  LIMIT " . $request["start"] . "  ," . $request["length"] . "  ";
    $query = $db->prepare($sql);
    $query->execute();
    $islem = $query->fetchALL(PDO::FETCH_ASSOC);
    $data = [];
    $say = $request["start"] + 1;
    foreach ($islem as $row) {
        $danismanID = $row["danisman_id"];
        $ilanDetay = $db->query("SELECT * FROM emlaklar WHERE id='" . $row["emlak_id"] . "' AND danisman='" . $danismanID . "'")->fetch(PDO::FETCH_ASSOC);
        $danismanDetay = $db->query("SELECT * FROM ekibimiz WHERE id = '" . $danismanID . "' ORDER BY id ASC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        $subdata = [];
        $subdata[] = $row["id"];
        $subdata[] = $row["id"];
        $subdata[] = $ilanDetay["adi"];
        $subdata[] = $danismanDetay["adi"];
        $subdata[] = $row["adsoyad"];
        $subdata[] = $row["telefon"];
        $subdata[] = $row["email"];
        $subdata[] = $row["mesaj"];
        $subdata[] = "<a href=\"../_class/yonetim_islem.php?emlakmesajsil=ok&id=" . $row["id"] . "\" class=\"btn btn-inverse-danger btn-sm popconfirm\" data-original-title=\"\" title=\"Sil\"><i class=\"ti-trash\"></i></a>";
        $data[] = $subdata;
    }
    $json_data = ["draw" => intval($request["draw"]), "recordsTotal" => intval($totalData), "recordsFiltered" => intval($totalFilter), "data" => $data];
    echo json_encode($json_data);
    echo "\r\n";
} else {
    exit("Erişim engellendi");
}

?>