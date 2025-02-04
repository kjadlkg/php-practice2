<?php
include "db.php";

$id = $_GET['id'];
$sql = query("SELECT * FROM board WHERE board_id = $id");
$board = $sql->fetch_array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (empty($title) || empty($content)) {
        echo "빈칸을 채워주세요";
    } else {
        $modify = "UPDATE board SET board_title = '$title', board_content = '$content' WHERE board_id = id";
        query($modify);
        header("Location: view.php?id='$id'");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
</head>

<body>
    <div>
        <h1>글을 수정하세요</h1>
        <hr>
        <form method="POST" action="modify.php?id=<?php echo $board['board_id']; ?>">
            <table>
                <tr>
                    <th width="50">제목</th>
                    <td><input type="text" name="title" value="<?php echo $board['board_title']; ?>" required></td>
                </tr>
                <tr>
                    <th>내용</th>
                    <td><textarea name="content" rows="5" cols="40"
                            required><?php $board['board_content']; ?></textarea></td>
                </tr>
            </table>
            <input type="hidden" name="id" value="<?php echo $board['board_id']; ?>">
            <ul>
                <li><button onclick="location.href='view.php?id=<?php echo $board['board_id']; ?>'">취소</button></li>
                <li><input type="submit" value="수정"></li>
            </ul>
        </form>
    </div>
</body>

</html>