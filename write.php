<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (empty($title) || empty($content)) {
        echo "제목과 내용을 입력해주세요.";
    } else {
        $user_id = $_SESSION['id'];
        $sql = "INSERT INTO board (board_title, board_content, user_id) VALUES ('$title', '$content', '$user_id')";
        query($sql);
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기</title>
</head>

<body>
    <div>
        <h1>글을 작성하세요</h1>
        <hr>
        <form method="POST" action="write.php">
            <table>
                <tr>
                    <th>제목</th>
                    <td><input type="text" name="title" placeholder="제목을 입력하세요" required></td>
                </tr>
                <tr>
                    <th>내용</th>
                    <td><textarea name="content" rows="5" cols="40" placeholder="내용을 입력하세요" required></textarea></td>
                </tr>
            </table>
            <ul>
                <li><button onclick="location.href='index.php'">취소</button></li>
                <li><input type="submit" value="작성"></li>
            </ul>
        </form>
    </div>
</body>

</html>