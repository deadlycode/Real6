<?php


if (!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {
    require_once "../../_class/baglan.php";
    require_once "../../_class/fonksiyon.php";
    $request = $_REQUEST;
    $col = ["id", "isim", "telefon", "email", "tarih", "durum", "islem"];
    $sql = "SELECT * FROM teklif_formu";
    $totalFilter = $db->query($sql)->rowCount();
    $sql = "SELECT * FROM teklif_formu WHERE 1=1";
    if (!empty($request["search"]["value"])) {
        $sql .= " AND (id LIKE '" . $request["search"]["value"] . "%' ";
        $sql .= " OR isim LIKE '" . $request["search"]["value"] . "%' ";
        $sql .= " OR telefon LIKE '" . $request["search"]["value"] . "%' ";
        $sql .= " OR email LIKE '" . $request["search"]["value"] . "%' ";
        $sql .= " OR tarih LIKE '" . $request["search"]["value"] . "%' )";
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
            $durum = "<div class=\"badge badge-outline-danger\">Okunmadı</div>";
        }
        if ($row["durum"] == 1) {
            $durum = "<div class=\"badge badge-outline-success\">Okundu</div>";
        }
        $subdata = [];
        $subdata[] = "<div class=\"form-check mb-0 mt-0\"><label class=\"form-check-label\"><input type=\"checkbox\" name=\"id[]\" value=\"" . $row["id"] . "\" class=\"form-check-input\"><i class=\"input-helper\"></i></label></div>";
        $subdata[] = $row["isim"];
        $subdata[] = $row["telefon"];
        $subdata[] = $row["email"];
        $subdata[] = tarih_panel($row["tarih"]);
        $subdata[] = $durum;
        $subdata[] = "<a href=\"\" data-role=\"update\" class=\"btn btn-inverse-primary btn-sm\" data-toggle=\"modal\" data-target=\"#mesaj-" . $row["id"] . "\" data-id=\"" . $row["id"] . "\" title=\"Mesajı Oku\"><i class=\"ti-eye\"></i></a>\r\r\n\t\t\t\t\t<a href=\"../_class/yonetim_islem.php?teklifsil=ok&id=" . $row["id"] . "\" class=\"btn btn-inverse-danger btn-sm popconfirm\" title=\"Sil\"><i class=\"ti-trash\"></i></a>\r\r\n\t\t\t\t\t<div class=\"modal fade\" id=\"mesaj-" . $row["id"] . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"ModalLabel\" aria-hidden=\"true\">\r\r\n\t\t\t\t\t\t<div class=\"modal-dialog modal-sm\" role=\"document\">\r\r\n\t\t\t\t\t\t\t<div class=\"modal-content\">\r\r\n\t\t\t\t\t\t\t\t<div class=\"modal-header p-2 pl-2\">\r\r\n\t\t\t\t\t\t\t\t\t<h5 class=\"modal-title\" id=\"ModalLabel\">Teklif Formu Detayı</h5>\r\r\n\t\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t<div class=\"modal-body text-left\">\r\r\n\t\t\t\t\t\t\t\t\t<p class=\"mb-3 text-right\">\r\r\n\t\t\t\t\t\t\t\t\t\tIP Adresi: <strong>" . $row["ip"] . "</strong>\r\r\n\t\t\t\t\t\t\t\t\t</p>\r\r\n\t\t\t\t\t\t\t\t\t<p class=\"mb-3 text-right\">\r\r\n\t\t\t\t\t\t\t\t\t\tGönderim Tarihi: <strong>" . tarih_panel($row["tarih"]) . "</strong>\r\r\n\t\t\t\t\t\t\t\t\t</p>\r\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-group row row mb-1\">\r\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 col-form-label text-right pt-2 mt-1\">Adı Soyadı</label>\r\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" value=\"" . $row["isim"] . "\" disabled>\r\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-group row row mb-1\">\r\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 col-form-label text-right pt-2 mt-1\">E-Posta</label>\r\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" value=\"" . $row["email"] . "\" disabled>\r\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-group row row mb-1\">\r\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 col-form-label text-right pt-2 mt-1\">Telefon</label>\r\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" value=\"" . $row["telefon"] . "\" disabled>\r\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-group row mb-1\">\r\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 col-form-label text-right pt-2 mt-1\">Açıklama</label>\r\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t<textarea class=\"form-control form-control-sm\" name=\"adres\" disabled>" . $row["mesaj"] . "</textarea>\r\r\n\t\t\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t<div class=\"modal-footer\">\r\r\n\t\t\t\t\t\t\t\t\t<a href=\"../_class/yonetim_islem.php?teklifsil=ok&id=" . $row["id"] . "\" class=\"btn btn-outline-danger btn-icon-text p-1 popconfirm\" title=\"Sil\"><i class=\"ti-trash\"></i> Sil</a>\r\r\n\t\t\t\t\t\t\t\t\t<button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-outline-default btn-icon-text p-1\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i> Kapat</button>\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>";
        $data[] = $subdata;
    }
    $json_data = ["draw" => intval($request["draw"]), "recordsTotal" => intval($totalData), "recordsFiltered" => intval($totalFilter), "data" => $data];
    echo json_encode($json_data);
} else {
    exit("Erişim engellendi");
}

?>