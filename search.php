<?php
$dbhost = 'localhost:8889';  // mysql伺服器主機地址
$dbuser = 'root';            // mysql使用者名稱
$dbpass = 'root';
$database = 'db_73';         // mysql使用者名稱密碼
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $database);


if ($conn->connect_error) {
    die("連接失敗" . $conn->connect_error);
}
mysqli_query($conn, "SET NAMES 'UTF-8'");





// 表頭
echo "
<table>
    <tr>
        <th>ID</th>
        <th>姓名</th>
        <th>性別</th>
        <th>生日</th>
        <th>住址</th>
        <th>縣市</th>
        <th>地區</th>
        <th>郵遞區號</th>
        <th>電話</th>
    </tr>

";


if (isset($_GET['s'])) {
    $s = mysqli_real_escape_string($conn , $_GET['s']);
    $sql =  "SELECT * FROM info WHERE name LIKE '%" . $s . "%' OR phone LIKE '%" . $s . "%'";
    $result = $conn->query($sql);
    // 搜尋錯誤訊息
    if(!$result) {
          echo ("錯誤 : " . mysqli_error($conn));
          exit();
    }
    //查無資料
    if (mysqli_num_rows($result) <= 0) {
        echo "<tr><td colspan='9'>查無資料</td></tr>";
    }
    //查到資料時
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['sex'] . "</td>";
        echo "<td>" . $row['birthday'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "<td>" . $row['city'] . "</td>";
        echo "<td>" . $row['location'] . "</td>";
        echo "<td>" . $row['zone'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "</tr>";
    }
} else {
    // 如果沒有文字顯示的資料
    $sql = "SELECT * FROM info";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo ("錯誤：" . mysqli_error($conn));
        exit();
    }

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['sex'] . "</td>";
        echo "<td>" . $row['birthday'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "<td>" . $row['city'] . "</td>";
        echo "<td>" . $row['location'] . "</td>";
        echo "<td>" . $row['zone'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "</tr>";
    }
}

echo "</table>";
$conn->close();
?>

