<!DOCTYPE html>
<html>
<head>
    <title>Lihat Cerita</title>
</head>
<body>
    <a href="home.php">Kembali ke Halaman Home</a>

    <?php
    include 'classCerita.php';
    $cerita = new classCerita($db); 

    if (isset($_GET['id'])) {
        $idcerita = $_GET['id'];

        $ceritaData = $cerita->getCeritaById($idcerita);

        if ($ceritaData) {
            echo "<h1>" . $ceritaData['judul'] . "</h1>";
            echo "<p>" . $ceritaData['isi_paragraf'] . "</p>";

            //Daftar Paragraf ditampilkan menggunakan snip ini
            $paragrafData = $cerita->getParagrafByCeritaId($idcerita);
            if ($paragrafData) {
                foreach ($paragrafData as $paragraf) {
                    echo "<p>" . $paragraf['isi_paragraf'] . "</p>";
                }
            }

            //  Menambahkan paragraf baru menggunakan snip ini
            echo "<h2>Tambah Paragraf Baru</h2>";
            echo "<form method='POST' action=''>";
            echo "<input type='hidden' name='idcerita' value='$idcerita'>";
            echo "<label for='paragraf'>Paragraf Baru:</label>";
            echo "<textarea name='paragraf' id='paragraf' rows='4' required></textarea><br>";
            echo "<input type='submit' value='Tambah Paragraf'>";
            echo "</form>";
        } else {
            echo "Cerita tidak ditemukan.";
        }

      
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $paragraf = $_POST["paragraf"];
            $idcerita = $_POST["idcerita"];

            $cerita->addParagrafToCerita($idcerita, $paragraf);

            
        }
    } else {
        echo "ID cerita tidak diberikan.";
    }
    ?>
</body>
</html>
