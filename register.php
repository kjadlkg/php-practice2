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