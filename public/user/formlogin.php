<?php
session_start();
$conn = new mysqli("localhost", "root", "", "plazaNet");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password_id'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: ../afterlogin.html");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Form Login </title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;  
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }   
        input[type="text"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
        }
        input[type="submit"] {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background: #0056b3;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
<?php

?>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        <form method="post" action="">
            <label for="username">Nama Pengguna:</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
            <label for="password">Kata Sandi:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <input type="submit" value="Masuk">
        </form>
        <div class="footer">
            <p>Belum punya akun? <a href="formregister.php">Daftar di sini</a></p>
            <p> <a href="../index.html"> Back to Home </a></p>
        </div>
    </div>
</body>
</html>