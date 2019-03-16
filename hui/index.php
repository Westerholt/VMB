
<?php
    $db = mysqli_connect('localhost', 'id8936075_maxim', '132435qwerty','id8936075_db');
?>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
</head>
 
<body>
    <h1>Здравствуйте</h1>
    <div class="parent">
        <div class="child">Дата заселения:</div>
        <div class="child">22.04.99</div>
    </div>
    <p>Дата заселения</p>
       <?php
            $query = "SELECT checkIn, checkOut FROM `users`;";
                $result = mysqli_query($db, $query);
                while($row = mysqli_fetch_assoc($result)) {
                      // Display your datas on the page
                }
          ?>
    <p>Дата выселения</p>

</body>
</html>