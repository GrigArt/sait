<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect(...);
if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
} else {
    $sql = "SELECT * FROM Persons";
    $result = mysqli_query($link, $sql);
    $resArray = mysqli_fetch_all($result, MYSQLI_ASSOC);
    print(json_encode($resArray, JSON_UNESCAPED_UNICODE));   
}
?>
