<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect(...);
    
if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
} else {
    $ip = $_POST["ip"];
    $fn = $_POST['fullName'];
    $gin = $_POST['generalInfo'];
    $inf = $_POST['info'];
    $sql = "SELECT * FROM TrustIps WHERE ip = \"{$ip}\"";
    $row = mysqli_fetch_assoc(mysqli_query($link, $sql));
//    if ($row['ip'] == null) {
//        $sql = "INSERT INTO TrustIps (ip) VALUES (\"{$ip}\")";
//        mysqli_query($link, $sql);
//    }
    if ($_POST['key'] != null) {
        $sql = "SELECT trustKey, uses FROM TrustKeys WHERE trustKey = \"{$_POST['key']}\"";
        $result = mysqli_query($link, $sql);
        $res = mysqli_fetch_row($result)[1];
        if ($res == null ||$res <= 0) {
            print("Недостоверный ключ");
        } else {
            $sql = "UPDATE TrustIps SET rating = (\"{$row['rating']}\"+1) WHERE ip = \"{$ip}\"";
            mysqli_query($link, $sql);
            $sql = "INSERT INTO Persons(fullName, generalInfo, info, ip) VALUES (\"{$fn}\", \"{$gin}\", \"{$inf}\", \"{$ip}\");";
            mysqli_query($link, $sql);
            $uses = $res-1;
            $sql = "UPDATE TrustKeys SET uses = \"{$uses}\" WHERE trustKey = \"{$_POST['key']}\"";
            mysqli_query($link, $sql);
        }
    } else {
        if ($row['rating'] > 10) {
            $sql = "INSERT INTO Persons(fullName, generalInfo, info, ip) VALUES (\"{$fn}\", \"{$gin}\", \"{$inf}\", \"{$ip}\");";
            mysqli_query($link, $sql);
        } else if ($row['lastActivity'] && time() - date_timestamp_get(new DateTime($row['lastActivity'])) > 600 & $row['rating'] >= 0) {
            $sql = "INSERT INTO Persons(fullName, generalInfo, info, ip) VALUES (\"{$fn}\", \"{$gin}\", \"{$inf}\", \"{$ip}\");";
            mysqli_query($link, $sql);
        } else if ($row['rating'] < 0) {
            print("Вам бы почистить карму...");
        } else {
            print("Пока мы вам не доверяем");
        }
    }
}


?>
