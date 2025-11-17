<?php


if (!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {
    require_once "../../_class/baglan.php";
    require_once "../../_class/fonksiyon.php";
    $request = $_REQUEST;
    $col = ["id", "id", "adi", "kategori", "yeni", "anasayfa", "durum", "islem"];
    $sql = "SELECT * FROM emlaklar WHERE dil = '" . $_SESSION["admin_dil"] . "'";
    $totalFilter = $db->query($sql)->rowCount();
    $sql = "SELECT * FROM emlaklar WHERE dil = '" . $_SESSION["admin_dil"] . "'";
    if (!empty($request["search"]["value"])) {
        $sql .= " AND (id LIKE '" . $request["search"]["value"] . "%' ";
        $sql .= " OR adi LIKE '" . $request["search"]["value"] . "%' ";
        $sql .= " OR seo LIKE '" . $request["search"]["value"] . "%' )";
    }
    $totalData = $db->query($sql)->rowCount();
    $sql .= " ORDER BY " . $col[$request["order"][0]["column"]] . "   " . $request["order"][0]["dir"] . "  LIMIT " . $request["start"] . "  ," . $request["length"] . "  ";
    $query = $db->prepare($sql);
    $query->execute();
    $islem = $query->fetchALL(PDO::FETCH_ASSOC);
    $data = [];
    $say = $request["start"] + 1;
    foreach ($islem as $row) {
        $kategoriler = explode(",", $row["kategori"]);
        $kategori = "";
        $i = 0;
        $len = count($kategoriler);
        foreach ($kategoriler as $key) {
            $kategoriler = $db->query("SELECT * FROM emlak_kategori WHERE id = '" . $key . "'")->fetch(PDO::FETCH_ASSOC);
            $kategori .= "<a href='emlak-kategori-duzenle/" . $kategoriler["id"] . "" . $html . "' class='badge badge-outline-warning text-warning'>" . $kategoriler["adi"] . "</a> ";
            $i++;
        }
        if ($row["durum"] == 0) {
            $durum = "<div class=\"badge badge-outline-danger\">Pasif</div>";
        }
        if ($row["durum"] == 1) {
            $durum = "<div class=\"badge badge-outline-success\">Aktif</div>";
        }
        if ($row["anasayfa"] == 0) {
            $anasayfa = "<div class=\"badge badge-outline-danger\">Hayır</div>";
        }
        if ($row["anasayfa"] == 1) {
            $anasayfa = "<div class=\"badge badge-outline-success\">Evet</div>";
        }
        if ($row["yeni"] == 0) {
            $yeni = "<div class=\"badge badge-outline-danger\">Hayır</div>";
        }
        if ($row["yeni"] == 1) {
            $yeni = "<div class=\"badge badge-outline-success\">Evet</div>";
        }
        if ($row["kapak"] == "") {
            $resim = "href=\"javascript:void(0)\" class=\"btn btn-inverse-danger btn-sm\" title=\"Resim Yok\"";
        } else {
            $resim = "href=\"../" . tema . "/uploads/emlaklar/" . $row["kapak"] . "\" class=\"btn btn-inverse-success btn-sm\" title=\"Resmi Göster\"";
        }
        $subdata = [];
        $subdata[] = "<div class=\"form-check mb-0 mt-0\"><label class=\"form-check-label\"><input type=\"checkbox\" name=\"id[]\" value=\"" . $row["id"] . "\" class=\"form-check-input checkbox\"><i class=\"input-helper\"></i></label></div>";
        $subdata[] = $row["id"];
        $subdata[] = "<a href=\"emlak-duzenle/" . $row["id"] . "" . $html . "\" class=\"renk_baslik\" title=\"Düzenle\">" . $row["adi"] . "</a>";
        $subdata[] = $kategori;
        $subdata[] = $row["emlak_kodu"];
        $subdata[] = $anasayfa;
        $subdata[] = $durum;
        $subdata[] = "<a " . $resim . "><i class=\"ti-image\"></i></a>\r\n\t\t\t\t\t<a href=\"emlak-duzenle/" . $row["id"] . "" . $html . "\" class=\"btn btn-inverse-primary btn-sm\"><i class=\"ti-pencil-alt\" title=\"Düzenle\"></i></a>\r\n\t\t\t\t\t<a href=\"../_class/yonetim_islem.php?emlaksil=ok&id=" . $row["id"] . "\" class=\"btn btn-inverse-danger btn-sm popconfirm\" data-original-title=\"\" title=\"Sil\"><i class=\"ti-trash\"></i></a>";
        $data[] = $subdata;
    }
    $json_data = ["draw" => intval($request["draw"]), "recordsTotal" => intval($totalData), "recordsFiltered" => intval($totalFilter), "data" => $data];
    echo json_encode($json_data);
} else {
    exit("Erişim engellendi");
}

?>