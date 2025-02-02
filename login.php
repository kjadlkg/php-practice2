<?php
require_once("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $pw = isset($_POST['pw']) ? $_POST['pw'] : null;

    if ($email == null || $pw == null) {
        echo "<script> alert('이메일 또는 비밀번호를 입력해주세요.'); </script>";
        exit();
    }

    $stmt = $db->prepare("SELECT user_id, user_pw FROM user WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id, $user_pw);
    $stmt->fetch();
    $stmt->close();

    $is_match_pw = password_verify($pw, $user_pw);

    if ($is_match_pw) {
        session_start();
        $_SESSION["id"] = $user_id;
        echo "<script> alert('로그인 되었습니다.'); location.href='index.php'; </script>";
    } else {
        echo "<script> alert('이메일 또는 비밀번호가 일치하지 않습니다.'); location.href='login.php'; </script>";

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
</head>

<body>
    <div>
        <h1>로그인</h1>
        <form method="POST" action="login.php">
            <table>
                <tr>
                    <td>이메일</td>
                    <td><input type="email" name="email" required placeholder="이메일" size="40"></td>
                </tr>
                <tr>
                    <td>비밀번호</td>
                    <td><input type="password" name="pw" required placeholder="비밀번호" size="40"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="로그인"></td>
                </tr>
                <tr>
                    <td colspan="2">아직 회원이 아니신가요? <a href="register.php">회원가입</a></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>