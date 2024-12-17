<?php
$servername = "localhost"; // Ganti jika server berbeda
$username = "root"; // Ganti dengan username MySQL Anda
$password = ""; // Ganti dengan password MySQL Anda
$dbname = "login_db"; // Nama database yang telah Anda buat

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari request
$email = $_POST['email'];
$password = $_POST['password'];

// Validasi email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

// Hash password sebelum menyimpan
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Siapkan statement
$stmt = $conn->prepare("INSERT INTO `data login` (email, password) VALUES (?, ?)");
$stmt->bind_param("ss", $email, $hashed_password);

// Eksekusi statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error; // Debugging
}

$stmt->close();
$conn->close();
?>