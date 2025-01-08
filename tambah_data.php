<?php
// Konfigurasi koneksi database
$host = 'localhost';
$user = 'root';
$password = ''; // Ganti dengan password database Anda
$dbname = 'absensi_mahasiswa';

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menangani pengiriman data dari form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = $conn->real_escape_string($_POST['nim']);
    $nama = $conn->real_escape_string($_POST['nama']);
    $jurusan = $conn->real_escape_string($_POST['jurusan']);
    $waktu_kehadiran = $conn->real_escape_string($_POST['waktu_kehadiran']);

    $sql = "INSERT INTO absensi (NIM, Nama, Jurusan, Waktu_Kehadiran) VALUES ('$nim', '$nama', '$jurusan', '$waktu_kehadiran')";

    if ($conn->query($sql) === TRUE) {
        header("Location: halaman.php");
        exit();
    } else {
        $error_message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://i.ytimg.com/vi/1uCocVkVcRo/maxresdefault.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
        }
        h1 {
            text-align: center;
            color: #8B0000;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="datetime-local"] {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            margin-top: 20px;
            padding: 10px;
            background-color: #8B0000;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #079145;
        }
        .message {
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Tambah Data Mahasiswa</h1>
        <?php if (isset($error_message)) echo "<p class='message error'>$error_message</p>"; ?>
        <form method="POST">
            <label for="nim">NIM:</label>
            <input type="text" id="nim" name="nim" required>

            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="jurusan">Jurusan:</label>
            <input type="text" id="jurusan" name="jurusan" required>

            <label for="waktu_kehadiran">Waktu Kehadiran:</label>
            <input type="datetime-local" id="waktu_kehadiran" name="waktu_kehadiran" required>

            <button type="submit">Tambah Data</button>
        </form>
    </div>

    <?php
    // Menutup koneksi
    $conn->close();
    ?>
</body>
</html>
