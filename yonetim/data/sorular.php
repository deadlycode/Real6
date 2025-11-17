<?php


if (!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {
    require_once "../../_class/baglan.php";
    require_once "../../_class/fonksiyon.php";
    $request = $_REQUEST;
    $col = ["id", "sira", "adi", "durum", "islem"];
    $sql = "SELECT * FROM sorular WHERE dil = '" . $_SESSION["admin_dil"] . "'";
    $totalFilter = $db->query($sql)->rowCount();
    $sql = "SELECT * FROM sorular WHERE dil = '" . $_SESSION["admin_dil"] . "'";
    if (!empty($request["search"]["value"])) {
        $sql .= " AND (id LIKE '" . $request["search"]["value"] . "%' ";
        $sql .= " OR adi LIKE '" . $request["search"]["value"] . "%' )";
    }
    $totalData = $db->query($sql)->rowCount();
    $sql .= " ORDER BY " . $col[$request["order"][0]["column"]] . "   " . $request["order"][0]["dir"] . "  LIMIT " . $request["start"] . "  ," . $request["length"] . "  ";
    $query = $db->prepare($sql);
    $query->execute();
    $islem = $query->fetchALL(PDO::FETCH_ASSOC);
    $data = [];
    $say = $request["start"] + 1;
    foreach ($islem as $row) {
        if ($row["durum"] == 0) {
            $durum = "<div class=\"badge badge-outline-danger\">Pasif</div>";
        }
        if ($row["durum"] == 1) {
            $durum = "<div class=\"badge badge-outline-success\">Aktif</div>";
        }
        $subdata = [];
        $subdata[] = "<div class=\"form-check mb-0 mt-0\"><label class=\"form-check-label\"><input type=\"checkbox\" name=\"id[]\" value=\"" . $row["id"] . "\" class=\"form-check-input checkbox\"><i class=\"input-helper\"></i></label></div>";
        $subdata[] = $row["id"];
        $subdata[] = "<a href=\"soru-duzenle/" . $row["id"] . "" . $html . "\" class=\"renk_baslik\" title=\"Düzenle\">" . $row["adi"] . "</a>";
        $subdata[] = $durum;
        $subdata[] = "<a href=\"soru-duzenle/" . $row["id"] . "" . $html . "\" class=\"btn btn-inverse-primary btn-sm\"><i class=\"ti-pencil-alt\" title=\"Düzenle\"></i></a>\r\r\n\t\t\t\t\t<a href=\"../_class/yonetim_islem.php?sorusil=ok&id=" . $row["id"] . "\" class=\"btn btn-inverse-danger btn-sm popconfirm\" data-original-title=\"\" title=\"Sil\"><i class=\"ti-trash\"></i></a>";
        $data[] = $subdata;
    }
    $json_data = ["draw" => intval($request["draw"]), "recordsTotal" => intval($totalData), "recordsFiltered" => intval($totalFilter), "data" => $data];
    echo json_encode($json_data);
    echo "\r\n";
} else {
    exit("Erişim engellendi");
}

?>