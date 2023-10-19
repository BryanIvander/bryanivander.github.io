<!DOCTYPE html>
<html>
<head>
    <title>Buat Cerita Baru</title>
</head>
<body>
    <h1>Buat Cerita Baru</h1>
    <a href="home.php">Kembali ke Halaman Home</a>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $judul = $_POST["judul"];
        $paragraf = $_POST["paragraf"];

        // Untuk menyimpan cerita baru ke database
        include 'classCerita.php'; 

        $cerita = new classCerita(); 
        $idcerita = $cerita->createCerita($_SESSION['idpengguna'], $judul, $paragraf);

        if ($idcerita) {
            echo "Cerita berhasil dibuat! <a href='lihat_cerita.php?id=$idcerita'>Lihat Cerita</a>";
        } else {
            echo "Gagal membuat cerita.";
        }
    }
    ?>

    <form method="POST" action="">
        <label for="judul">Judul Cerita:</label>
        <input type="text" name="judul" id="judul" required><br>

        <label for="paragraf">Paragraf Awal:</label>
        <textarea name="paragraf" id="paragraf" rows="4" required></textarea><br>

        <input type="submit" value="Buat Cerita">
    </form>
</body>
</html>
