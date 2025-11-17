<?php


if (!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {
    require_once "../../_class/baglan.php";
    require_once "../../_class/fonksiyon.php";
    function getChilds($parentId, $ust_adi, $dil, $db, $data)
    {
        $sql = "SELECT * FROM emlak_kategori WHERE dil = '" . $dil . "' AND ustid=" . $parentId;
        $query = $db->prepare($sql);
        $query->execute();
        $islem = $query->fetchALL(PDO::FETCH_ASSOC);
        foreach ($islem as $row) {
            $durum = "";
            $adi = $row["adi"];
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
            if ($row["kapak"] == "") {
                $resim = "href=\"javascript:void(0)\" class=\"btn btn-inverse-danger btn-sm\" title=\"Resim Yok\"";
            } else {
                $resim = "href=\"../" . tema . "/uploads/kategoriler/" . $row["kapak"] . "\" class=\"btn btn-inverse-success btn-sm\" title=\"Resmi Göster\"";
            }
            $subdata = [];
            $subdata[] = "<div class=\"form-check mb-0 mt-0\"><label class=\"form-check-label\"><input type=\"checkbox\" name=\"id[]\" value=\"" . $row["id"] . "\" class=\"form-check-input checkbox\"><i class=\"input-helper\"></i></label></div>";
            $subdata[] = $row["id"];
            $subdata[] = "<a href=\"emlak-kategori-duzenle/" . $row["id"] . "" . $html . "\" title=\"Düzenle\"><span class=\"text-info\">" . $ust_adi . " /</span> <span class=\"text-warning\">" . $adi . "</span></a>";
            $subdata[] = $row["seo"];
            $subdata[] = $anasayfa;
            $subdata[] = $durum;
            $subdata[] = "<a " . $resim . "><i class=\"ti-image\"></i></a><a href=\"emlak-kategori-duzenle/" . $row["id"] . "" . $html . "\" class=\"btn btn-inverse-primary btn-sm\"><i class=\"ti-pencil-alt\" title=\"Düzenle\"></i></a><a href=\"../_class/yonetim_islem.php?emlakkatsil=ok&id=" . $row["id"] . "\" class=\"btn btn-inverse-danger btn-sm popconfirm\" data-original-title=\"\" title=\"Sil\"><i class=\"ti-trash\"></i></a>";
            $data[] = $subdata;
            $data = getChilds($row["id"], $ust_adi . "/" . $adi, $dil, $db, $data);
        }
        return $data;
    }
    $request = $_REQUEST;
    $col = ["id", "sira", "ustid", "adi", "seo", "durum", "islem"];
    $sql = "SELECT * FROM emlak_kategori WHERE dil = '" . $_SESSION["admin_dil"] . "'";
    $totalData = $db->query($sql)->rowCount();
    if (!empty($request["search"]["value"])) {
        $sql .= " AND (id LIKE '" . $request["search"]["value"] . "%' ";
        $sql .= " OR adi LIKE '" . $request["search"]["value"] . "%' ";
        $sql .= " OR seo LIKE '" . $request["search"]["value"] . "%' ";
        $sql .= " OR tarih LIKE '" . $request["search"]["value"] . "%' )";
    } else {
        $sql .= " AND ustid=0";
    }
    $sql .= " ORDER BY " . $col[$request["order"][0]["column"]] . "   " . $request["order"][0]["dir"];
    $query = $db->prepare($sql);
    $query->execute();
    $islem = $query->fetchALL(PDO::FETCH_ASSOC);
    $data = [];
    $say = $request["start"] + 1;
    foreach ($islem as $row) {
        $adi = $row["adi"];
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
        if ($row["kapak"] == "") {
            $resim = "href=\"javascript:void(0)\" class=\"btn btn-inverse-danger btn-sm\" title=\"Resim Yok\"";
        } else {
            $resim = "href=\"../" . tema . "/uploads/kategoriler/" . $row["kapak"] . "\" class=\"btn btn-inverse-success btn-sm\" title=\"Resmi Göster\"";
        }
        $subdata = [];
        $subdata[] = "<div class=\"form-check mb-0 mt-0\"><label class=\"form-check-label\"><input type=\"checkbox\" name=\"id[]\" value=\"" . $row["id"] . "\" class=\"form-check-input checkbox\"><i class=\"input-helper\"></i></label></div>";
        $subdata[] = $row["id"];
        $subdata[] = "<a href=\"emlak-kategori-duzenle/" . $row["id"] . "" . $html . "\" class=\"text-warning\" title=\"Düzenle\">" . $adi . "</a>";
        $subdata[] = $row["seo"];
        $subdata[] = $anasayfa;
        $subdata[] = $durum;
        $subdata[] = "<a " . $resim . "><i class=\"ti-image\"></i></a><a href=\"emlak-kategori-duzenle/" . $row["id"] . "" . $html . "\" class=\"btn btn-inverse-primary btn-sm\"><i class=\"ti-pencil-alt\" title=\"Düzenle\"></i></a>\r\n\t\t\t\t\t<a href=\"../_class/yonetim_islem.php?emlakkatsil=ok&id=" . $row["id"] . "\" class=\"btn btn-inverse-danger btn-sm popconfirm\" data-original-title=\"\" title=\"Sil\"><i class=\"ti-trash\"></i></a>";
        $data[] = $subdata;
        $data = getChilds($row["id"], $adi, $_SESSION["admin_dil"], $db, $data);
    }
    if (0 < $request["length"]) {
        $totalFilter = count($data);
        $data = array_slice($data, $request["start"], $request["length"]);
    }
    $json_data = ["draw" => intval($request["draw"]), "recordsTotal" => intval($totalData), "recordsFiltered" => intval($totalFilter), "data" => $data];
    echo json_encode($json_data);
} else {
    exit("Erişim engellendi");
}

?>