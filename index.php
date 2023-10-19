<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Selamat Datang di Website Cerita</h1>
    <h2>Login</h2>
<?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
require 'classUser.php';

//Menggunakan Database username dan password untuk menuju ke Password menggunakan Function authenticateUser
$users = new classUser();
if ($users->authenticateUser($username, $password)) {
//Kemudian jika matching dengan apa yang ada di Database maka langsung Home	
            header("Location: home.php");
            exit();
        } else {
            echo "Login gagal. Coba lagi.";
        }
    }
?>
<form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>




