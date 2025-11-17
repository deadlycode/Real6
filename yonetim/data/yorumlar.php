<?php


if (!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {
    require_once "../../_class/baglan.php";
    require_once "../../_class/fonksiyon.php";
    $request = $_REQUEST;
    $col = ["id", "isim", "tarih", "durum", "islem"];
    $sql = "SELECT * FROM musteri_gorusleri";
    $totalFilter = $db->query($sql)->rowCount();
    $sql = "SELECT * FROM musteri_gorusleri WHERE 1=1";
    if (!empty($request["search"]["value"])) {
        $sql .= " AND (id LIKE '" . $request["search"]["value"] . "%' ";
        $sql .= " OR isim LIKE '" . $request["search"]["value"] . "%' )";
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
            $durum = "<div class=\"badge badge-outline-danger\">Onay Bekleyen</div>";
            $buton = "<a href=\"../_class/yonetim_islem.php?yorumonayla=ok&id=" . $row["id"] . "\" class=\"btn btn-inverse-success btn-sm\" title=\"Onayla\"><i class=\"ti-control-play\"></i></a>";
            $buton2 = "<a href=\"../_class/yonetim_islem.php?yorumonayla=ok&id=" . $row["id"] . "\" class=\"btn btn-success btn-icon-text p-2\" title=\"Onayla\">Yorumu Onayla</a>";
        }
        if ($row["durum"] == 1) {
            $durum = "<div class=\"badge badge-outline-success\">Onaylanan</div>";
            $buton = "<a href=\"../_class/yonetim_islem.php?yorumonaykaldir=ok&id=" . $row["id"] . "\" class=\"btn btn-inverse-warning btn-sm\" title=\"Onayı Kladır\"><i class=\"ti-control-pause\"></i></a>";
            $buton2 = "<a href=\"../_class/yonetim_islem.php?yorumonaykaldir=ok&id=" . $row["id"] . "\" class=\"btn btn-warning btn-icon-text p-2\" title=\"Onayı Kladır\">Onayı Kaldır</a>";
        }
        $subdata = [];
        $subdata[] = "<div class=\"form-check mb-0 mt-0\"><label class=\"form-check-label\"><input type=\"checkbox\" name=\"id[]\" value=\"" . $row["id"] . "\" class=\"form-check-input\"><i class=\"input-helper\"></i></label></div>";
        $subdata[] = $row["isim"];
        $subdata[] = tarih_panel($row["tarih"]);
        $subdata[] = $durum;
        $subdata[] = "<a href=\"\" data-role=\"update\" class=\"btn btn-inverse-primary btn-sm\" data-toggle=\"modal\" data-target=\"#mesaj-" . $row["id"] . "\" data-id=\"" . $row["id"] . "\" title=\"Yorumu Gör\"><i class=\"ti-eye\"></i></a>\r\r\n\t\t\t\t\t" . $buton . "\r\r\n\t\t\t\t\t<a href=\"../_class/yonetim_islem.php?yorumsil=ok&id=" . $row["id"] . "\" class=\"btn btn-inverse-danger btn-sm popconfirm\" title=\"Sil\"><i class=\"ti-trash\"></i></a>\r\r\n\t\t\t\t\t<div class=\"modal fade\" id=\"mesaj-" . $row["id"] . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"ModalLabel\" aria-hidden=\"true\">\r\r\n\t\t\t\t\t\t<div class=\"modal-dialog modal-dialog-centered\" role=\"document\">\r\r\n\t\t\t\t\t\t\t<div class=\"modal-content\">\r\r\n\t\t\t\t\t\t\t\t<div class=\"modal-header p-2 pl-2\">\r\r\n\t\t\t\t\t\t\t\t\t<h5 class=\"modal-title\" id=\"ModalLabel\"><strong>" . $row["isim"] . "</strong> kişinin yorumu</h5>\r\r\n\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\r\r\n\t\t\t\t\t\t\t\t\t\t<span aria-hidden=\"true\">&times;</span>\r\r\n\t\t\t\t\t\t\t\t\t</button>\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t<div class=\"modal-body text-left\">\r\r\n\t\t\t\t\t\t\t\t\t<p class=\"mb-3\">\r\r\n\t\t\t\t\t\t\t\t\t\tIP Adresi: <strong>" . $row["ip"] . "</strong> &nbsp; Tarih: <strong>" . tarih_panel($row["tarih"]) . "</strong>\r\r\n\t\t\t\t\t\t\t\t\t</p>\r\r\n\t\t\t\t\t\t\t\t\t<p class=\"mb-3\">\r\r\n\t\t\t\t\t\t\t\t\t\tMeslek: <strong>" . $row["meslek"] . "</strong>\r\r\n\t\t\t\t\t\t\t\t\t</p>\r\r\n\t\t\t\t\t\t\t\t\t<p class=\"mb-3\">\r\r\n\t\t\t\t\t\t\t\t\t\tŞehir: <strong>" . $row["sehir"] . "</strong>\r\r\n\t\t\t\t\t\t\t\t\t</p>\r\r\n\t\t\t\t\t\t\t\t\t<p>" . $row["yorum"] . "</p>\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t\t<div class=\"modal-footer\">\r\r\n\t\t\t\t\t\t\t\t\t" . $buton2 . "\r\r\n\t\t\t\t\t\t\t\t\t<a href=\"../_class/yonetim_islem.php?yorumsil=ok&id=" . $row["id"] . "\" class=\"btn btn-danger btn-icon-text p-2\" title=\"Sil\">Yorumu Sil</a>\r\r\n\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-light btn-icon-text p-2\" data-dismiss=\"modal\">Kapat</button>\r\r\n\t\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t\t</div>\r\r\n\t\t\t\t\t</div>";
        $data[] = $subdata;
    }
    $json_data = ["draw" => intval($request["draw"]), "recordsTotal" => intval($totalData), "recordsFiltered" => intval($totalFilter), "data" => $data];
    echo json_encode($json_data);
} else {
    exit("Erişim engellendi");
}

?>