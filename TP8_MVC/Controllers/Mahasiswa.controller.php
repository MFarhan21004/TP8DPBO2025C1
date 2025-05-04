<?php
include_once("Database/conf.php");
include_once('Models/Mahasiswa.class.php');
include_once('Views/Mahasiswa.views.php');

// Controllers/Mahasiswa.controller.php
class MahasiswaController {
    private $mahasiswaModel;

    public function __construct() {
        $this->mahasiswaModel = new Mahasiswa(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
    }

    public function index() {
        // Membuka koneksi model
        $this->mahasiswaModel->open();
    
        // Mengambil data mahasiswa
        $this->mahasiswaModel->getMahasiswa();
        $dataMahasiswa = [];
        while ($row = $this->mahasiswaModel->getResult()) {
            $dataMahasiswa[] = $row;  // Menambahkan data mahasiswa ke dalam array
        }
    
        // Menutup koneksi model
        $this->mahasiswaModel->close();
    
        // Menampilkan data di view
        $view = new MahasiswaView();
        $view->displayAllMahasiswa($dataMahasiswa);
    }
    
    public function Add($data) {
        $this->mahasiswaModel->open();
        $result = $this->mahasiswaModel->addMahasiswa($data);
        $this->mahasiswaModel->close();
        
        return $result;
    }
    
    public function edit($id) {
        $this->mahasiswaModel->open();
        
        // Mengambil semua data mahasiswa untuk ditampilkan di tabel
        $this->mahasiswaModel->getMahasiswa();
        $dataMahasiswa = [];
        while ($row = $this->mahasiswaModel->getResult()) {
            $dataMahasiswa[] = $row;
        }
        
        // Mengambil data mahasiswa yang akan diedit
        $result = $this->mahasiswaModel->getMahasiswaById($id);
        $dataEdit = $result->fetch_assoc();
        
        $this->mahasiswaModel->close();
        
        // Menampilkan form edit dengan data yang sudah diambil
        $view = new MahasiswaView();
        $view->displayAllMahasiswa($dataMahasiswa, $dataEdit);
    }

    public function update($data) {
        $this->mahasiswaModel->open();
        $result = $this->mahasiswaModel->updateMahasiswa($data);
        $this->mahasiswaModel->close();
        
        return $result;
    }

    public function delete($id) {
        $this->mahasiswaModel->open();
        $result = $this->mahasiswaModel->deleteMahasiswa($id);
        $this->mahasiswaModel->close();
        
        return $result;
    }
    
    
}

?>