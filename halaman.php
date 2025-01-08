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

// Query untuk mengambil data absensi
$sql = "SELECT NIM, Nama, Jurusan, Waktu_Kehadiran FROM absensi";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Absensi Mahasiswa</title>
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
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
        }
        h1 {
            color: #8B0000;
            margin: 0;
            text-align: center;
        }
        .container {
            width: 90%;
            max-width: 800px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 0;
            text-align: center;
        }
        .table-container {
            max-height: 300px;
            overflow-y: auto;
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #8B0000;
            color: white;
        }
        td {
            background-color: #f9f9f9;
            color: #333;
        }
        .btn {
            padding: 10px 20px;
            color: white;
            background-color: #8B0000;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-bottom: 20px;
        }
        .btn:hover {
            background-color: #079145;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>ABSENSI MAHASISWA INFORMATIKA</h1>
        <a href="tambah_data.php" class="btn">Tambah Data Mahasiswa</a>

        <div class="table-container">
            <table>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Waktu Kehadiran</th>
                </tr>

                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["NIM"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Nama"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Jurusan"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Waktu_Kehadiran"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <?php
    // Menutup koneksi
    $conn->close();
    ?>
</body>
</html>
