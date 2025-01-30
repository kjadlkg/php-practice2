<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "test2");

if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

function query($sql)
{
    global $mysqli;
    return $mysqli->query($sql);
}
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
</head>

<body>
    <div class="logunButton">
        <?php if (!isset($_SESSION["id"])) { ?>
        <a href="login.php">로그인</a>
        <a href="register.php">회원가입</a>
        <?php } else { ?>
        <a href="logout.php">로그아웃</a>
        <?php } ?>
    </div>

    <div class="index">
        <h1>자유 게시판</h1>
        <h4>자유롭게 글을 쓸 수 있는 게시판입니다.</h4>

        <button onclick="writePost()">글쓰기</button>

        <table>
            <tr>
                <th width="70">번호</th>
                <th width="500">제목</th>
                <th width="120">작성자</th>
                <th width="100">작성일</th>
                <th width="100">조회수</th>
            </tr>

            <?php
            $list_num = 10;
            $page_num = 10;
            $num = query('SELECT COUNT(*) AS total FROM board')->fetch_assoc()['total'];

            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $total_page = ceil($num / $list_num);
            $total_block = ceil($total_page / $page_num);
            $now_block = ceil($page / $page_num);
            $s_page = ($now_block * $page_num) - ($page_num - 1);
            if ($s_page <= 0)
                $s_page = 1;
            $e_page = $now_block * $page_num;
            if ($total_page < $e_page)
                $e_page = $total_page;

            $start = ($page - 1) * $list_num;
            $sql = query("SELECT * FROM board ORDER BY board_id DESC LIMIT $start, $list_num");

            while ($row = $sql->fetch_array()) {
                echo '<tr>';
                echo '<td>' . $row['board_id'] . '</td>';
                echo '<td><a href="view.php?id=' . $row['board_id'] . '">' . $row['board_title'] . '</a></td>';

                $user_sql = query("SELECT user_name FROM user WHERE user_id = " . $row['user_id']);
                $user_data = $user_sql->fetch_array();
                echo '<td>' . $user_data['user_name'] . '</td>';

                echo '<td>' . $row['board_date'] . '</td>';
                echo '<td>' . $row['board_views'] . '</td>';
                echo '</tr>';
            }
            ?>
        </table>

        <div class="page">
            <?php
            if ($page <= 1) {
                echo '<span class="fo_re"> 이전 </span>';
            } else {
                echo '<a href="index.php?page=' . ($page - 1) . '"> 이전 </a>';
            }

            for ($print_page = $s_page; $print_page <= $e_page; $print_page++) {
                if ($print_page == $page) {
                    echo '<strong>' . $print_page . '</strong>';
                } else {
                    echo '<a href="index.php?page=' . $print_page . '">' . $print_page . '</a>';
                }
            }

            if ($page >= $total_page) {
                echo '<span class="fo_re"> 다음 </span>';
            } else {
                echo '<a href="index.php?page=' . ($page + 1) . '"> 다음 </a>';
            }
            ?>
        </div>

        <h4 class="pagenum">총 <?= $num ?>개의 글이 있습니다</h4>
    </div>

    <script>
    function writePost() {
        <?php if (!isset($_SESSION['id'])) { ?>
        alert('로그인이 필요합니다.');
        location.href = 'login.php';
        <?php } else { ?>
        location.href = 'write.php';
        <?php } ?>
    }
    </script>
</body>

</html>