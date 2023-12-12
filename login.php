<?php
// if already log in redirect to dashboard
if (isset($_SESSION['email'])) {
    header('Location: dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="login_proccess.php" method="post">
        <input type="text" name="email" id="email">
        <input type="password" name="password" id="password">
        <input type="submit" name="submit" value="login">
    </form>
</body>
</html>