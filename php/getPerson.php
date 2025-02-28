<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect(...);
    
if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
} else {
    $sql = "SELECT * FROM Persons WHERE fullName = \"{$_GET['fullName']}\"";
    $result = mysqli_query($link, $sql);
    $resArray1 = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $sql = "SELECT groupName FROM Groups WHERE fullName = \"{$_GET['fullName']}\"";
    $result = mysqli_query($link, $sql);
    $resArray2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $sql = "SELECT link, linkName FROM Links WHERE fullName = \"{$_GET['fullName']}\"";
    $result = mysqli_query($link, $sql);
    $resArray3 = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $sql = "SELECT media FROM Media WHERE fullName = \"{$_GET['fullName']}\"";
    $result = mysqli_query($link, $sql);
    $resArray4 = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $sql = "SELECT review FROM Comments WHERE fullName = \"{$_GET['fullName']}\"";
    $result = mysqli_query($link, $sql);
    $resArray5 = mysqli_fetch_all($result, MYSQLI_ASSOC);
    print(json_encode(array_merge($resArray1,$resArray2,$resArray3,$resArray4,$resArray5), JSON_UNESCAPED_UNICODE));  
    
    
}
?>
