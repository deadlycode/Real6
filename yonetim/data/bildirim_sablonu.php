<?php


if (!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {
    require_once "../../_class/baglan.php";
    require_once "../../_class/fonksiyon.php";
    $request = $_REQUEST;
    $col = ["sablon_adi", "konu", "islem"];
    $sql = "SELECT * FROM bildirim_sablonu";
    $totalFilter = $db->query($sql)->rowCount();
    $sql = "SELECT * FROM bildirim_sablonu";
    if (!empty($request["search"]["value"])) {
        $sql .= " AND (id LIKE '" . $request["search"]["value"] . "%' ";
        $sql .= " OR sablon_adi LIKE '" . $request["search"]["value"] . "%' ";
        $sql .= " OR konu LIKE '" . $request["search"]["value"] . "%' )";
    }
    $totalData = $db->query($sql)->rowCount();
    $sql .= " ORDER BY " . $col[$request["order"][0]["column"]] . "   " . $request["order"][0]["dir"] . "  LIMIT " . $request["start"] . "  ," . $request["length"] . "  ";
    $query = $db->prepare($sql);
    $query->execute();
    $islem = $query->fetchALL(PDO::FETCH_ASSOC);
    $data = [];
    $say = $request["start"] + 1;
    foreach ($islem as $row) {
        if ($row["konu"] != "") {
            $konu = $row["konu"];
        } else {
            $konu = $row["konu2"];
        }
        $subdata = [];
        $subdata[] = $row["sablon_adi"];
        $subdata[] = $konu;
        $subdata[] = "<a href=\"sablon-duzenle/" . $row["id"] . "" . $html . "\" class=\"btn btn-inverse-primary btn-sm\" title=\"Düzenle\"><i class=\"ti-pencil-alt\"></i> Düzenle</a>";
        $data[] = $subdata;
    }
    $json_data = ["draw" => intval($request["draw"]), "recordsTotal" => intval($totalData), "recordsFiltered" => intval($totalFilter), "data" => $data];
    echo json_encode($json_data);
} else {
    exit("Erişim engellendi");
}

?>