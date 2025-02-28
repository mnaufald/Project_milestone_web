<?php
session_start();
$conn = new mysqli("localhost", "root", "", "plazaNet");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cek apakah data telah dikirim
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    // Pastikan tidak ada input kosong sebelum memasukkan ke database
    if (!empty($name) && !empty($email) && !empty($message)) {
        $sql = "INSERT INTO message (name, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            $success = "Pesan Anda telah dikirim!";
        } else {
            $error = "Gagal mengirim pesan, coba lagi.";
        }
    } else {
        $error = "Semua kolom harus diisi!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Plazanet </title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .container2 {
            max-width: 1200px;
            margin: auto;
            background: #fff;
            padding: 70px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .contact-info {
            margin-bottom: 20px;
        }
        .contact-info p {
            margin: 5px 0;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input, textarea {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
    
</head>

<body>
    <header>
        <h1> Plazanet.id </h1>

        <nav>
            <a href="../index.html"> Home </a>
            <!-- <a href=""> Category </a> -->
            <a href=""> Cart </a>
            <a href="../user/formlogin.php"> Login </a>
        </nav>
    </header>

    <div class="container2">
        <h1>Kontak Kami</h1>
        <p>Jika Anda memiliki pertanyaan, saran, atau keluhan, jangan ragu untuk menghubungi kami. Kami di sini untuk membantu Anda!</p>
    
        <div class="contact-info">
            <h2>Informasi Kontak</h2>
            <p><strong>Email:</strong> support@plazanet.com</p>
            <p><strong>Telepon:</strong> (021) 1234 5678</p>
            <p><strong>Alamat:</strong> Jl. Pandawa No. 123, Jakarta, Indonesia</p>
        </div>
    
        <h2>Kirim Pesan</h2>
        <?php 
        if (isset($success)) echo "<p style='color: green;'>$success</p>"; 
        if (isset($error)) echo "<p style='color: red;'>$error</p>"; 
        ?>
        <form action="contactus.php" method="post">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" required>
    
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
    
            <label for="message">Pesan:</label>
            <textarea id="message" name="message" rows="5" required></textarea>
    
            <button type="submit">Kirim Pesan</button>
        </form>
    </div>

    <footer>
        <div class="column footerleft">
            <ul>
                <p><b> More info </b></p>
                <li> <a href="contactus.php"> Contact us </a> </li>
                <li> <a href="../aboutus.html"> About us </a> </li> 
            </ul>    
        </div>

        <div class="column footerright">
            <ul>
                <p><b> Follow us </b></p>
                <li> <a href="https://www.instagram.com"> Instagram </a> </li>
                <li> <a href="https://www.youtube.com"> Youtube </a> </li>
                <li> <a href="https://x.com"> Twitter </a> </li> 
            </ul>
        </div>
        <p class="pt-9 "> Copyright &copy; 2025 Plazanet.com</p>
    </footer>

</body>
</html>