<!DOCTYPE html>
<html>
<head>
    <title>Halaman Home</title>
</head>
<body>
    <h1>Selamat datang di Halaman Home</h1>
    <a href="buat_cerita.php">Buat Cerita Baru</a>
    <h2>Daftar Cerita</h2>

  
    <form method="GET" action="">
        <label for="search">Cari Judul Cerita:</label>
        <input type="text" name="search" id="search">
        <input type="submit" value="Cari">
    </form>

    <?php
	//Class Cerita adalah keharusan
    include 'classCerita.php';
    $cerita = new classCerita(); 

    if (isset($_GET["search"])) {
        $search = $_GET["search"];
        
        $result = $cerita->searchCeritaByTitle($search);

        if ($result) {
            echo "<h3>Hasil Pencarian:</h3>";
            echo "<ul>";
            foreach ($result as $row) {
                echo "<li><a href='lihat_cerita.php?id=" . $row['idcerita'] . "'>" . $row['judul'] . "</a></li>";
            }
            echo "</ul>";
        } else {
            echo "Tidak ditemukan hasil pencarian.";
        }
    }

   
    $limit = 5; 
    $page = isset($_GET['page']) ? $_GET['page'] : 1; 
    $offset = ($page - 1) * $limit;
    $result = $cerita->getPaginatedCerita($offset, $limit);

    if ($result) {
        echo "<ul>";
        foreach ($result as $row) {
            echo "<li><a href='lihat_cerita.php?id=" . $row['idcerita'] . "'>" . $row['judul'] . "</a></li>";
        }
        echo "</ul>";
    } else {
        echo "Tidak ada cerita yang ditampilkan pada halaman ini.";
    }

   

    ?>
</body>
</html>