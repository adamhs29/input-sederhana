<?php
include 'koneksi.php';

// Fungsi untuk menambah data ke database
function tambahData($nik, $nama, $alamat,$gambar,$kon) {
    $sql = "INSERT INTO biodata (nik, nama, alamat, gambar) VALUES ('$nik', '$nama', '$alamat', '$gambar')";

    if ($kon->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . $kon->error;
    }
}

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $nik = $_POST["nik"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    
    // Handle upload gambar
    $targetDir = "gambar/";
    $gambar = $targetDir . basename($_FILES["gambar"]["name"]);
    move_uploaded_file($_FILES["gambar"]["tmp_name"], $gambar);

    // Panggil fungsi tambahData untuk menambahkan data ke database
    tambahData($nik, $nama, $alamat, $gambar, $kon);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Biodata</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h2>Form Input Biodata</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">

        <label for="nik">NIK:</label>
        <input type="text" name="nik" required><br>

        <label for="nama">Nama:</label>
        <input type="text" name="nama" required><br>

        <label for="alamat">Alamat:</label>
        <textarea name="alamat" required></textarea><br>

        <label for="gambar">Gambar:</label>
        <input type="file" name="gambar" accept="image/*" required><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
