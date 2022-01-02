<?php

require_once "config/class.crud.php";
require_once "header.php";

$userstamp = ["user_id" => 166];
$user = $set->tablelist("user", ["*"], $userstamp);
while ($getuser = $user->fetch(PDO::FETCH_ASSOC)) {
    echo '<span style="background:#d4d8dd;margin:0 5 px;padding:0 3px">' . $getuser["user_name"] . '</span> ' . htmlspecialchars($dosyaekgetir["gelisme_detay"]);
}

include "footer.php";