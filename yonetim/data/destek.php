<?php


if (!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {
    require_once "../../_class/baglan.php";
    require_once "../../_class/fonksiyon.php";
    $request = $_REQUEST;
    $col = ["id", "uyeid", "baslik", "departman", "tarih", "durum", "islem"];
    $sql = "SELECT * FROM destek WHERE ustid = '0'";
    $totalFilter = $db->query($sql)->rowCount();
    $sql = "SELECT * FROM destek WHERE ustid = '0'";
    if (!empty($request["search"]["value"])) {
        $sql .= " AND (id LIKE '" . $request["search"]["value"] . "%' ";
        $sql .= " OR baslik LIKE '" . $request["search"]["value"] . "%' ";
        $sql .= " OR departman LIKE '" . $request["search"]["value"] . "%' ";
        $sql .= " OR durum LIKE '" . $request["search"]["value"] . "%' )";
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
            $durum = "<div class=\"badge badge-outline-danger\"><i class=\"mdi mdi-clock\"></i> Yanıt Bekliyor</div>";
        }
        if ($row["durum"] == 1) {
            $durum = "<div class=\"badge badge-outline-success\"><i class=\"mdi mdi-check-all\"></i> Yanıtlandı</div>";
        }
        if ($row["durum"] == 2) {
            $durum = "<div class=\"badge badge-outline-info\"><i class=\"mdi mdi-thumb-up\"></i> Çözümlendi</div>";
        }
        $uyecek = $db->query("SELECT * FROM uyeler WHERE id='" . $row["uyeid"] . "'")->fetch(PDO::FETCH_ASSOC);
        $subdata = [];
        $subdata[] = "<div class=\"form-check mb-0 mt-0\"><label class=\"form-check-label\"><input type=\"checkbox\" name=\"id[]\" value=\"" . $row["id"] . "\" class=\"form-check-input checkbox\"><i class=\"input-helper\"></i></label></div>";
        $subdata[] = "<a target=\"_blank\" class=\"renk_baslik\" href=\"uye-duzenle/" . $row["id"] . "" . $html . "\">" . $uyecek["adsoyad"] . "</a>";
        $subdata[] = "<a class=\"renk_baslik\" href=\"destek/" . $row["id"] . "" . $html . "\">" . $row["baslik"] . "</a></br>" . $row["hizmet"] . "";
        $subdata[] = $row["departman"];
        $subdata[] = tarihcevir($row["tarih"]);
        $subdata[] = $durum;
        $subdata[] = "<a href=\"destek/" . $row["id"] . "" . $html . "\" class=\"btn btn-inverse-primary btn-sm\"><i class=\"ti-eye\" title=\"Görüntüle\"></i></a>\r\r\n\t\t\t\t\t<a href=\"../_class/yonetim_islem.php?desteksil=ok&id=" . $row["id"] . "&url=destek-merkezi" . $html . "\" class=\"btn btn-inverse-danger btn-sm popconfirm\" title=\"Sil\"><i class=\"ti-trash\"></i></a>";
        $data[] = $subdata;
    }
    $json_data = ["draw" => intval($request["draw"]), "recordsTotal" => intval($totalData), "recordsFiltered" => intval($totalFilter), "data" => $data];
    echo json_encode($json_data);
} else {
    exit("Erişim engellendi");
}

?>