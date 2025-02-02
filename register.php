<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $pw = isset($_POST['pw']) ? $_POST['pw'] : null;

    if ($name == null || $pw == null || $email == null) {
        echo "<script> alert('이름, 비밀번호, 이메일을 입력해주세요.'); </script>";
        exit();
    }

    $stmt = $db->prepare("SELECT COUNT(user_id) FROM user WHERE user_email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($user_count);
    $stmt->fetch();
    $stmt->close();

    if ($user_count == 1) {
        echo "<script> alert('이미 존재하는 이메일입니다.'); location.href='register.php'; </script>";
        exit();
    }

    $bcrypt_pw = password_hash($pw, PASSWORD_DEFAULT);

    $sql = query("INSERT INTO user(user_name, user_email, user_pw) VALUES('$name', '$email', '$bcrypt_pw')");

    if ($sql) {
        echo "<script> alert('회원가입 완료되었습니다.'); location.href='index.php'; </script>";
    } else {
        echo "<script> alert('회원가입에 실패했습니다.); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
</head>

<body>
    <div>
        <h1>회원가입</h1>
        <form method="post" action="register.php">
            <table>
                <tr>
                    <td>이름</td>
                    <td><input type="text" name="name" required placeholder="이름" size="40"></td>
                </tr>
                <tr>
                    <td>이메일</td>
                    <td><input type="email" name="email" required placeholder="이메일" size="40"></td>
                </tr>
                <tr>
                    <td>비밀번호</td>
                    <td><input type="password" name="pw" required placeholder="비밀번호" size="40"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="회원가입"></td>
                </tr>
                <tr>
                    <td colspan="2">이미 회원이신가요? <a href="login.php">로그인</a></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>