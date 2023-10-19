<?php
class Cerita {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

   //tambahkan cerita
    public function createCerita($idpengguna, $judul, $paragraf) {
       
        $query = "INSERT INTO cerita (idpengguna, judul) VALUES (?, ?)";
        $nextStep = $this->db->prepare($query);
        $nextStep->bind_param("ss", $idpengguna, $judul);

        if ($nextStep->execute()) {
            $idcerita = $nextStep->insert_id;
            
           
            $this->addParagraf($idcerita, $paragraf);
            
            return $idcerita;
        } else {
            return false; /
        }
    }
	//tambahkan paragraf
    public function addParagraf($idcerita, $paragraf) {
     
        $query = "INSERT INTO paragraf (idcerita, isi_paragraf) VALUES (?, ?)";
        $nextStep = $this->db->prepare($query);
        $nextStep->bind_param("ss", $idcerita, $paragraf);

        return $nextStep->execute();
    }
//Mencari cerita dengan Judul
    public function searchCeritaByTitle($search) {
        $search = "%" . $search . "%";
        $query = "SELECT * FROM cerita WHERE judul LIKE ?";
        $nextStep = $this->db->prepare($query);
        $nextStep->bind_param("s", $search);
        $nextStep->execute();
        $result = $nextStep->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return null;
        }
    }
//Display... Kurasa...
    public function getPaginatedCerita($offset, $limit) {
        $query = "SELECT * FROM cerita LIMIT ?, ?";
        $nextStep = $this->db->prepare($query);
        $nextStep->bind_param("ii", $offset, $limit);
        $nextStep->execute();
        $result = $nextStep->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return null;
        }
    }
	 public function getCeritaById($idcerita) {
        $query = "SELECT * FROM cerita WHERE idcerita = ?";
        $nextStep = $this->db->prepare($query);
        $nextStep->bind_param("i", $idcerita);
        $nextStep->execute();
        $result = $nextStep->get_result();
        return $result->fetch_assoc();
    }

    public function getParagrafByCeritaId($idcerita) {
        $query = "SELECT isi_paragraf FROM paragraf WHERE idcerita = ?";
        $nextStep = $this->db->prepare($query);
        $nextStep->bind_param("i", $idcerita);
        $nextStep->execute();
        $result = $nextStep->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addParagrafToCerita($idcerita, $paragraf) {
        $query = "INSERT INTO paragraf (idcerita, isi_paragraf) VALUES (?, ?)";
        $nextStep = $this->db->prepare($query);
        $nextStep->bind_param("is", $idcerita, $paragraf);
        $nextStep->execute();
    }
}
?>
