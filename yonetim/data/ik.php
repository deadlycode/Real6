<?php


if (!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {
    require_once "../../_class/baglan.php";
    require_once "../../_class/fonksiyon.php";
    $request = $_REQUEST;
    $col = ["id", "isim", "telefon", "email", "tarih", "durum", "islem"];
    $sql = "SELECT * FROM ik";
    $totalFilter = $db->query($sql)->rowCount();
    $sql = "SELECT * FROM ik WHERE 1=1";
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
        if ($row["cv_dosya"]) {
            $cv = "<div class=\"form-group row ik\">\r\r\n\t\t\t\t<label class=\"col-md-3 col-form-label p-1\">CV Dosyası</label>\r\r\n\t\t\t\t<div class=\"col-md-9 pt-1\">\r\r\n\t\t\t\t\t<a target=\"_blank\" href=\"" . $row["cv_dosya"] . "\">İndirmek için tıklayın.</a>\r\r\n\t\t\t\t</div>\r\r\n\t\t\t</div>";
        }
        $subdata = [];
        $subdata[] = "<div class=\"form-check mb-0 mt-0\"><label class=\"form-check-label\"><input type=\"checkbox\" name=\"id[]\" value=\"" . $row["id"] . "\" class=\"form-check-input\"><i class=\"input-helper\"></i></label></div>";
        $subdata[] = $row["isim"];
        $subdata[] = $row["telefon"];
        $subdata[] = $row["email"];
        $subdata[] = tarih_panel($row["tarih"]);
        $subdata[] = $durum;
        $subdata[] = "<a href=\"\" data-role=\"update\" class=\"btn btn-inverse-primary btn-sm\" data-toggle=\"modal\" data-target=\"#mesaj-" . $row["id"] . "\" data-id=\"" . $row["id"] . "\" title=\"Mesajı Oku\"><i class=\"ti-eye\"></i></a>\r\r\n\t\t\t\t\t<a href=\"../_class/yonetim_islem.php?iksil=ok&id=" . $row["id"] . "\" class=\"btn btn-inverse-danger btn-sm popconfirm\" title=\"Sil\"><i class=\"ti-trash\"></i></a>\r\r\n\t\t\t\t\t<div class=\"modal fade\" id=\"mesaj-" . $row["id"] . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"ModalLabel\" aria-hidden=\"true\">\r\r\n\t\t\t\t\t\t<div class=\"modal-dialog modal-dialog-centered\" role=\"document\">\r\r\n\t\t\t\t\t\t\t<div class=\"modal-content\">\r\r\n\t\t\t\t\t\t\t\t<div class=\"modal-header p-2 pl-2\">\r\r\n\t\t\t\t\t\t\t\t\t<h5 class=\"modal-title\" id=\"ModalLabel\">" . $row["isim"] . " kişinin iş başvuru formu</h5>\r\r\n\t\t\t\t\t\t\t\t\t<p class=\"pt-2 pb-0 mb-0 text-right\">\r\r\n\t\t\t\t\t\t\t\t\t\tIP Adresi: <strong>" . $row["ip"] . "</strong>\r\r\n\t\t\t\t\t\t\t\t\t</p>\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t<div class=\"modal-body text-left\">\r\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-group row ik\">\r\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 col-form-label p-1\">Başvuru Tarihi</label>\r\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9 pt-1\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t" . tarih_panel($row["tarih"]) . "\r\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-group row ik\">\r\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 col-form-label p-1\">Adı Soyadı</label>\r\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9 pt-1\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t" . $row["isim"] . "\r\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\r\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-group row ik\">\r\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 col-form-label p-1\">Cep Telefonu</label>\r\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9 pt-1\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t" . $row["telefon"] . "\r\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-group row ik\">\r\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 col-form-label p-1\">E-Posta</label>\r\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9 pt-1\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t" . $row["email"] . "\r\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t<div class=\"form-group row ik\">\r\r\n\t\t\t\t\t\t\t\t\t\t<label class=\"col-md-3 col-form-label p-1\">T.C.</label>\r\r\n\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-9 pt-1\">\r\r\n\t\t\t\t\t\t\t\t\t\t\t" . $row["tc"] . "\r\r\n\t\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t\t" . $cv . "\t\t\t\t\t\t\t\t\t\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t<div class=\"modal-footer\">\r\r\n\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-light\" data-dismiss=\"modal\">Kapat</button>\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>";
        $data[] = $subdata;
    }
    $json_data = ["draw" => intval($request["draw"]), "recordsTotal" => intval($totalData), "recordsFiltered" => intval($totalFilter), "data" => $data];
    echo json_encode($json_data);
} else {
    exit("Erişim engellendi");
}

?>