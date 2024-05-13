<?php
$_GET['order'] = isset($order) ? $_GET['order'] : null;
?>
<html>
<head>
    <meta charset="utf-8">
    <title>classscore</title>
    <style>
        .input-wrap {
            width: 960px;
            margin: 0 auto;
        }
        h1 { text-align: center; }
        th, td { text-align: center; }
        table {
            border: 1px solid #000;
            margin: 0 auto;
        }
        td, th {
            border: 1px solid #ccc;
        }
        a { text-decoration: none; }
    </style>
    <style>
        .form-container {
            width: 100%;
            text-align: right;
        }
        .form-group {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="input-wrap">
        <form method="POST"> <!-- method 속성 추가 -->
            <label for="customerName">고객성명</label>
            <input type="text" id="customerName" name="customerName">
            <div class="form-container">
                <input type="submit" value="제출">
            </div>
            <table>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>구분</th>
                        <th colspan="2">어린이</th>
                        <th colspan="2">어른</th>
                        <th>비고</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                        <td>1</td>
                        <td>입장권</td>
                        <td>7,000</td>
                        <td>
                        <select name="child1">
                        <option value="0" selected>0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
</select>
</p>
                        <td>10,000</td>
                        <td>
                        <select name="adult1">
                        <option value="0" selected>0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
</select>
</p>
                        <td>입장</td>

                    </tr>
                    <tr>
                        <td>2</td>
                        <td>BIG3</td>
                        <td>12,000</td>
                        <td>
                        <select name="child2">
                        <option value="0" selected>0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
</select>
</p>
                        <td>16,000</td>
                        <td>
                        <select name="adult2">
                        <option value="0" selected>0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
</select>
</p>
                        <td>입장+놀이3종</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>자유이용권</td>
                        <td>21,000</td>
                        <td>
                        <select name="child3">
                        <option value="0" selected>0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
</select>
</p>
                        <td>26,000</td>
                        <td>
                        <select name="adult3">
                        <option value="0" selected>0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
</select>
</p>
                        <td>입장+놀이자유</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>연간이용권</td>
                        <td>70,000</td>
                        <td>
                        <select name="child4">
                        <option value="0" selected>0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
</select>
</p>
                        <td>90,000</td>
                        <td>
                        <select name="adult4">
                        <option value="0" selected>0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
</select>
</p>
                        <td>입장+놀이자유</td>

                    </tr>
                    
                </tbody>
            </table>
        </form>
        <?php echo date("h:i:sa"); ?>
    </div>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $link = mysqli_connect("localhost", "root", "", "amusmentpark"); // 데이터베이스 연결 정보 수정
    if (!$link) {
        die("데이터베이스 연결 실패: " . mysqli_connect_error());
    }

    $totalPrice = 0;
    
    $pass_ch = $_POST['child1'] + $_POST['child2'] + $_POST['child3'] + $_POST['child4'];
    $pass_ad = $_POST['adult1'] + $_POST['adult2'] + $_POST['adult3'] + $_POST['adult4'];
    // 각각의 가격을 계산합니다.
    $c1 = $_POST['child1'];
    $c2 = $_POST['child2'];
    $c3 = $_POST['child3'];
    $c4 = $_POST['child4'];
    $a1 = $_POST['adult1'];
    $a2 = $_POST['adult2'];
    $a3 = $_POST['adult3'];
    $a4 = $_POST['adult4'];
    $totalPrice += ($c1 * 7000) + ($a1 * 10000) + ($c2 * 12000) + ($a2 * 16000) + ($c3 * 21000) + ($a3 * 26000) + ($c4 * 70000) + ($a4 * 90000);

    $customerName = $_POST['customerName'];

    
    $sql = "INSERT INTO users (name, child1, child2, child3, child4, adult1, adult2, adult3, adult4, total)
            VALUES ('$customerName', '{$_POST['child1']}', '{$_POST['child2']}', '{$_POST['child3']}', '{$_POST['child4']}', '{$_POST['adult1']}', '{$_POST['adult2']}', '{$_POST['adult3']}', '{$_POST['adult4']}', '$totalPrice')"; 

    if (mysqli_query($link, $sql)) {
        echo "고객님 이름: $customerName<br>";
        echo "고객님, 감사합니다!<br>";
        echo "입장권 어린이: $pass_ch 장<br>"; // 수정
        echo "입장권 어른: $pass_ad 장<br>"; // 수정
        echo "합계금액: $totalPrice 원";
    } else {
        echo "쿼리 실행 오류: " . mysqli_error($link);
    }

    mysqli_close($link);
}
?>

</body>
</html>
