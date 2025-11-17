<?php


if (!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {
    require_once "../../_class/baglan.php";
    require_once "../../_class/fonksiyon.php";
    $request = $_REQUEST;
    $col = ["id", "id", "adi", "kategori", "durum", "islem"];
    $sql = "SELECT * FROM ozellik WHERE kategori = '" . $request["id"] . "' AND dil = '" . $_SESSION["admin_dil"] . "'";
    $totalFilter = $db->query($sql)->rowCount();
    $sql = "SELECT * FROM ozellik WHERE kategori = '" . $request["id"] . "' AND dil = '" . $_SESSION["admin_dil"] . "'";
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
        $kategori = $db->query("SELECT * FROM ozellik_kategori WHERE id = '" . $row["kategori"] . "'")->fetch(PDO::FETCH_ASSOC);
        if ($row["durum"] == 0) {
            $durum = "<div class=\"badge badge-outline-danger\">Pasif</div>";
        }
        if ($row["durum"] == 1) {
            $durum = "<div class=\"badge badge-outline-success\">Aktif</div>";
        }
        $subdata = [];
        $subdata[] = "<div class=\"form-check mb-0 mt-0\"><label class=\"form-check-label\"><input type=\"checkbox\" name=\"id[]\" value=\"" . $row["id"] . "\" class=\"form-check-input checkbox\"><i class=\"input-helper\"></i></label></div>";
        $subdata[] = $row["id"];
        $subdata[] = "<a href=\"\" data-toggle=\"modal\" data-target=\"#ozellik-degerleri-" . $row["id"] . "\" data-id=\"" . $row["id"] . "\" data-backdrop=\"static\" data-keyboard=\"false\" class=\"renk_baslik\" title=\"Düzenle\">" . $row["adi"] . "</a>";
        $subdata[] = $kategori["adi"];
        $subdata[] = $durum;
        $subdata[] = "<a href=\"\" data-toggle=\"modal\" data-target=\"#ozellik-degerleri-" . $row["id"] . "\" data-id=\"" . $row["id"] . "\" data-backdrop=\"static\" data-keyboard=\"false\" class=\"btn btn-inverse-primary btn-sm\"><i class=\"ti-pencil-alt\" title=\"Düzenle\"></i></a>\r\r\n\t\t\t\t\t<a href=\"../_class/yonetim_islem.php?ozellik_degersil=ok&id=" . $row["id"] . "&kategori=" . $kategori["id"] . "\" class=\"btn btn-inverse-danger btn-sm popconfirm\" data-original-title=\"\" title=\"Sil\"><i class=\"ti-trash\"></i></a>\r\r\n\t\t\t\t\t<div class=\"modal fade\" id=\"ozellik-degerleri-" . $row["id"] . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"ModalLabel\" aria-hidden=\"true\">\r\r\n\t\t\t\t\t\t<div class=\"modal-dialog modal-dialog-centered\" role=\"document\" style=\"transform: translate(0, 0%);\">\r\r\n\t\t\t\t\t\t\t<div class=\"modal-content\">\r\r\n\t\t\t\t\t\t\t\t<div class=\"modal-header p-2 pl-2\">\r\r\n\t\t\t\t\t\t\t\t\t<h5 class=\"modal-title\" id=\"ModalLabel\">" . $kategori["adi"] . " Özellik Değeri Düzenle</h5>\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t<form role=\"form\" action=\"../_class/yonetim_islem.php\" method=\"POST\">\r\r\n\t\t\t\t\t\t\t\t<div class=\"modal-body text-left\">\t\r\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-group row mb-1\">\r\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 col-form-label text-right pt-2\">Başlık</label>\r\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"adi\" value=\"" . $row["adi"] . "\">\r\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-group row mb-1\">\r\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-3\"></div>\r\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t<label class=\"switch\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"durum\" id=\"durum\" value=\"1\" " . ($row["durum"] == "1" ? "checked" : "") . ">\r\r\n\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\r\n\t\t\t\t\t\t\t\t\t\t\t</label>\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t\t\t\t\t\t<label class=\"d-inline-block\" style=\"line-height: 34px;\" for=\"durum\">Durum</label>\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t\t\t\t\t</div>\t\t\t\r\r\n\t\t\t\t\t\t\t\t\t</div>\t\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t<div class=\"modal-footer\">\r\r\n\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"id\" value=\"" . $row["id"] . "\" />\r\r\n\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"kategori\" value=\"" . $kategori["id"] . "\" />\r\r\n\t\t\t\t\t\t\t\t\t<button type=\"submit\" name=\"ozellik_deger_guncelle\" class=\"btn btn-success btn-icon-text p-2\"><i class=\"fa fa-check\"></i> Güncelle</button>\r\r\n\t\t\t\t\t\t\t\t\t<a href=\"../_class/yonetim_islem.php?ozellik_degersil=ok&id=" . $row["id"] . "&kategori=" . $kategori["id"] . "\" class=\"btn btn-danger btn-icon-text p-2 popconfirm\" title=\"Sil\"><i class=\"ti-trash\"></i> Sil</a>\r\r\n\t\t\t\t\t\t\t\t\t<button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-outline-default btn-icon-text p-2\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i> Kapat</button>\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t</form>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>";
        $data[] = $subdata;
    }
    $json_data = ["draw" => intval($request["draw"]), "recordsTotal" => intval($totalData), "recordsFiltered" => intval($totalFilter), "data" => $data];
    echo json_encode($json_data);
    echo "\r\n";
} else {
    exit("Erişim engellendi");
}

?>