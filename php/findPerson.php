<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = mysqli_connect(...);
if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
} else {
    //print("id, fullName, generalInfo");
    $sql = "SELECT fullName, generalInfo FROM Persons WHERE fullName like '%{$_GET['search']}%' or fullName in
    (SELECT fullName FROM Groups WHERE groupName like '%{$_GET['search']}%');";
    $result = mysqli_query($link, $sql);
    $resArray = mysqli_fetch_all($result, MYSQLI_ASSOC);
    print(json_encode($resArray, JSON_UNESCAPED_UNICODE));
    //while ($row = mysqli_fetch_array($result)) {
    //    for($i = 0; $i < count($row); ++$i) {
    //        print($row[$i].",");
    //    }
    //    print(";");
    //}   
    
    
}
?>
