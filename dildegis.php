<?php


ob_start();
session_start();
session_regenerate_id();
require_once "_class/baglan.php";
require_once "_class/fonksiyon.php";
if (!file_exists("language/dil_" . (unset) $_GET["id"] . ".php")) {
    exit("{\"hata\" : true}");
}
$_SESSION["k_dil"] = (unset) $_GET["id"];
echo json_encode(["hata" => false]);

?>