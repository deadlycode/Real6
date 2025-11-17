<?php


if (!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {
    require_once "../../_class/baglan.php";
    require_once "../../_class/fonksiyon.php";
    $request = $_REQUEST;
    $col = ["id", "sira", "adi", "durum", "islem"];
    $sql = "SELECT * FROM ozellik_kategori WHERE dil = '" . $_SESSION["admin_dil"] . "'";
    $totalFilter = $db->query($sql)->rowCount();
    $sql = "SELECT * FROM ozellik_kategori WHERE dil = '" . $_SESSION["admin_dil"] . "'";
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
        if ($row["durum"] == 0) {
            $durum = "<div class=\"badge badge-outline-danger\">Pasif</div>";
        }
        if ($row["durum"] == 1) {
            $durum = "<div class=\"badge badge-outline-success\">Aktif</div>";
        }
        $kategoriler = explode(",", $row["kategori"]);
        $secenekler = "";
        $KATEGORISorgu = $db->prepare("SELECT * FROM emlak_kategori WHERE durum = ? AND dil = ? ORDER BY id ASC");
        $KATEGORISorgu->execute(["1", $_SESSION["admin_dil"]]);
        $KATEGORIislem = $KATEGORISorgu->fetchALL(PDO::FETCH_ASSOC);
        foreach ($KATEGORIislem as $KATEGORISonuc) {
            $secenekler .= "<option value=\"" . $KATEGORISonuc["id"] . "\" " . (in_array($KATEGORISonuc["id"], $kategoriler) ? "selected" : "") . ">" . $KATEGORISonuc["adi"] . "</option>";
        }
        $subdata = [];
        $subdata[] = "<div class=\"form-check mb-0 mt-0\"><label class=\"form-check-label\"><input type=\"checkbox\" name=\"id[]\" value=\"" . $row["id"] . "\" class=\"form-check-input checkbox\"><i class=\"input-helper\"></i></label></div>";
        $subdata[] = $row["id"];
        $subdata[] = "<a href=\"ozellik/" . $row["id"] . "" . $html . "\"  class=\"renk_baslik\" title=\"Seçenekler\">" . $row["adi"] . "</a>";
        $subdata[] = $durum;
        $subdata[] = "<a href=\"ozellik/" . $row["id"] . "" . $html . "\" class=\"btn btn-inverse-info btn-sm\"><i class=\"fa fa-eye\" title=\"Düzenle\"></i> Seçenek Ekle</a>\r\n\t\t\t\t\t<a href=\"\" data-toggle=\"modal\" data-target=\"#ozellik-gruplari-" . $row["id"] . "\" data-id=\"" . $row["id"] . "\" data-backdrop=\"static\" data-keyboard=\"false\" class=\"btn btn-inverse-primary btn-sm\"><i class=\"ti-pencil-alt\" title=\"Düzenle\"></i></a>\r\n\t\t\t\t\t<a href=\"../_class/yonetim_islem.php?ozellik_grupsil=ok&id=" . $row["id"] . "\" class=\"btn btn-inverse-danger btn-sm popconfirm\" data-original-title=\"\" title=\"Sil\"><i class=\"ti-trash\"></i></a>\r\n\t\t\t\t\t<div class=\"modal fade\" id=\"ozellik-gruplari-" . $row["id"] . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"ModalLabel\" aria-hidden=\"true\">\r\n\t\t\t\t\t\t<div class=\"modal-dialog modal-dialog-centered\" role=\"document\" style=\"transform: translate(0, 0%);\">\r\n\t\t\t\t\t\t\t<div class=\"modal-content\">\r\n\t\t\t\t\t\t\t\t<div class=\"modal-header p-2 pl-2\">\r\n\t\t\t\t\t\t\t\t\t<h5 class=\"modal-title\" id=\"ModalLabel\">Özellik Grubu Düzenle</h5>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<form role=\"form\" action=\"../_class/yonetim_islem.php\" method=\"POST\">\r\n\t\t\t\t\t\t\t\t<div class=\"modal-body text-left\">\t\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-group row mb-1\">\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 col-form-label text-right pt-2\">Sıra</label>\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"sira\" value=\"" . $row["sira"] . "\">\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-group row mb-1\">\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 col-form-label text-right pt-2\">Başlık</label>\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"adi\" value=\"" . $row["adi"] . "\">\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-group row mb-1\">\r\n\t\t\t\t\t\t\t\t\t\t<label for=\"kategori\" class=\"col-md-3 col-form-label text-right pt-2\">Ürün Grubu</label>\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">\r\n\t\t\t\t\t\t\t\t\t\t\t<select class=\"multi-select\" name=\"kategori[]\" multiple=\"multiple\" multiple title=\"Kategoriler\" data-plugin=\"multiselect\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t " . $secenekler . "\r\n\t\t\t\t\t\t\t\t\t\t\t</select>\r\n\t\t\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-group row mb-1\">\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-3\"></div>\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">\r\n\t\t\t\t\t\t\t\t\t\t\t<label class=\"switch\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"durum\" id=\"durum\" value=\"1\" " . ($row["durum"] == "1" ? "checked" : "") . ">\r\n\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"slider\"></span>\r\n\t\t\t\t\t\t\t\t\t\t\t</label>\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t\t\t<label class=\"d-inline-block\" style=\"line-height: 34px;\" for=\"durum\">Durum</label>\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t\t\t</div>\t\t\t\r\n\t\t\t\t\t\t\t\t\t</div>\t\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t<div class=\"modal-footer\">\r\n\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"id\" value=\"" . $row["id"] . "\" />\r\n\t\t\t\t\t\t\t\t\t<button type=\"submit\" name=\"ozellik_grup_guncelle\" class=\"btn btn-success btn-icon-text p-2\"><i class=\"fa fa-check\"></i> Güncelle</button>\r\n\t\t\t\t\t\t\t\t\t<a href=\"../_class/yonetim_islem.php?ozellik_grupsil=ok&id=" . $row["id"] . "\" class=\"btn btn-danger btn-icon-text p-2 popconfirm\" title=\"Sil\"><i class=\"ti-trash\"></i> Sil</a>\r\n\t\t\t\t\t\t\t\t\t<button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-outline-default btn-icon-text p-2\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i> Kapat</button>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t\t</form>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t</div>\r\n\t\t\t\t\t</div>";
        $data[] = $subdata;
    }
    $json_data = ["draw" => intval($request["draw"]), "recordsTotal" => intval($totalData), "recordsFiltered" => intval($totalFilter), "data" => $data];
    echo json_encode($json_data);
} else {
    exit("Erişim engellendi");
}

?>