<?php
session_start();
$conn = new mysqli("localhost", "root", "", "plazaNet");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password untuk keamanan
    $password_hashed = password_hash($password, PASSWORD_BCRYPT);

    // Cek apakah email sudah digunakan
    $sql_check = "SELECT * FROM users WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $error = "Email sudah terdaftar, silakan gunakan email lain!";
    } else {
        // Insert data ke database
        $sql = "INSERT INTO users (username, email, password_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password_hashed);

        if ($stmt->execute()) {
            header("Location: formlogin.php"); // Redirect ke halaman login
            exit();
        } else {
            $error = "Pendaftaran gagal, coba lagi!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Form Register </title>
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
        .register-container {
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
        input[type="text"], input[type="email"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus {
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
    <div class="register-container">
        <h2>Pendaftaran</h2>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        <form method="post" action="">
            <label for="username">Nama Pengguna:</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <label for="password">Kata Sandi:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <input type="submit" value="Daftar">
        </form>
        <div class="footer">
            <p>Sudah punya akun? <a href="formlogin.php">Masuk di sini</a></p>
            <p> <a href="../index.html"> Back to Home </a></p>
        </div>
    </div>
</body>
</html>