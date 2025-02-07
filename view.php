<?php
session_start();
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>게시판</title>
</head>

<body>
    <?php
    $id = $_GET["id"];
    $views = query("UPDATE board SET board_views = board_views + 1 WHERE board_id = '$id'");
    $sql = query("SELECT * FROM board WHERE board_id = '$id'");
    $row = $sql->fetch_array();
    ?>
    <div class="view">
        <h2><?php echo $row['board_title']; ?></h2>
        <div>
            <p><b>작성자 </b>
                <?php
                $user_sql = query('SELECT user_name FROM user WHERE user_id =' . $row['user_id']);
                $user_data = $user_sql->fetch_array();
                $user_name = $user_data['user_name'];
                echo $user_name; ?> |
                <?php echo $row['board_date']; ?> | <b>조회수</b>
                <?php echo $row['board_views']; ?>
            </p>
        </div>
        <hr>
        <div>
            <?php echo nl2br($row['board_content']); ?>
        </div>
        <div>
            <ul>
                <li><button onclick="location.href='index.php'">목록</button></li>
                <?php
                if ($row['user_id'] == $_SESSION['id']) { ?>
                <li><button onclick="location.href='modify.php?id=<?php echo $row['board_id']; ?>'">수정</button></li>
                <li><button onclick="location.href='delete.php?id=<?php echo $row['board_id']; ?>'">삭제</button></li>
                <?php } ?>
            </ul>
        </div>
</body>

</html>