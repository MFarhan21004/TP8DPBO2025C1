<?php
include_once("Database/conf.php");
include_once('Models/Buku.class.php');
include_once('Views/Buku.views.php');

// Controllers/Buku.controller.php
class BukuController {
    private $bukuModel;

    public function __construct() {
        $this->bukuModel = new Buku(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
    }

    public function index() {
        // Membuka koneksi model
        $this->bukuModel->open();
    
        // Mengambil data buku
        $this->bukuModel->getBuku();
        $dataBuku = [];
        while ($row = $this->bukuModel->getResult()) {
            $dataBuku[] = $row;  // Menambahkan data buku ke dalam array
        }
    
        // Menutup koneksi model
        $this->bukuModel->close();
    
        // Menampilkan data di view
        $view = new BukuView();
        $view->displayAllBuku($dataBuku);
    }
    
    public function Add($data) {
        $this->bukuModel->open();
        $result = $this->bukuModel->addBuku($data);
        $this->bukuModel->close();
        
        return $result;
    }
    
    public function edit($id) {
        $this->bukuModel->open();
        
        // Mengambil semua data buku untuk ditampilkan di tabel
        $this->bukuModel->getBuku();
        $dataBuku = [];
        while ($row = $this->bukuModel->getResult()) {
            $dataBuku[] = $row;
        }
        
        // Mengambil data buku yang akan diedit
        $result = $this->bukuModel->getBukuById($id);
        $dataEdit = $result->fetch_assoc();
        
        $this->bukuModel->close();
        
        // Menampilkan form edit dengan data yang sudah diambil
        $view = new BukuView();
        $view->displayAllBuku($dataBuku, $dataEdit);
    }

    public function update($data) {
        $this->bukuModel->open();
        $result = $this->bukuModel->updateBuku($data);
        $this->bukuModel->close();
        
        return $result;
    }

    public function delete($id) {
        $this->bukuModel->open();
        $result = $this->bukuModel->deleteBuku($id);
        $this->bukuModel->close();
        
        return $result;
    }
    
}

?>