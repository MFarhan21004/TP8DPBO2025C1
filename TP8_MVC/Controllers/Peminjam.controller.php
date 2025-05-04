<?php
include_once("Database/conf.php");
include_once('Models/Peminjam.class.php');
include_once('Models/Buku.class.php');
include_once('Models/Mahasiswa.class.php');
include_once('Views/Peminjam.views.php');

// controllers/PeminjamController.php
class PeminjamController {
    private $peminjamModel;
    private $bukuModel;
    private $mahasiswaModel;

    public function __construct() {
        $this->bukuModel = new Buku(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
        $this->mahasiswaModel = new Mahasiswa(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
        $this->peminjamModel = new Peminjam(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
    }

    public function index() {
        // Membuka koneksi model
        $this->peminjamModel->open();
        $this->bukuModel->open();
        $this->mahasiswaModel->open();

        // Mengambil data peminjam
        $this->peminjamModel->getPeminjam();
        $dataPeminjam = [];
        while ($row = $this->peminjamModel->getResult()) {
            $dataPeminjam[] = $row;
        }

        // Mengambil data buku
        $this->bukuModel->getBuku();
        $dataBuku = [];
        while ($row = $this->bukuModel->getResult()) {
            $dataBuku[] = $row;
        }

        // Mengambil data mahasiswa
        $this->mahasiswaModel->getMahasiswa();
        $dataMahasiswa = [];
        while ($row = $this->mahasiswaModel->getResult()) {
            $dataMahasiswa[] = $row;
        }

        // Menutup koneksi model
        $this->peminjamModel->close();
        $this->bukuModel->close();
        $this->mahasiswaModel->close();

        // Menampilkan data di view
        $view = new PeminjamView();
        $view->displayAllPeminjam($dataPeminjam, $dataBuku, $dataMahasiswa);
    }

    public function Add($data) {
        $this->peminjamModel->open();
        $this->peminjamModel->addPeminjam($data);
        $this->peminjamModel->close();

        $this->bukuModel->open();
        $this->bukuModel->updateStok($data['buku_id'], -1);
        $this->bukuModel->close();
    }

    public function edit($id) {
        $this->peminjamModel->open();
        $this->bukuModel->open();
        $this->mahasiswaModel->open();

        $this->peminjamModel->getPeminjam();
        $dataPeminjam = [];
        while ($row = $this->peminjamModel->getResult()) {
            $dataPeminjam[] = $row;
        }

        $dataEdit = $this->peminjamModel->getPeminjamById($id)->fetch_assoc();

        $bukuRes = $this->bukuModel->getBuku();
        $dataBuku = [];
        while ($row = $bukuRes->fetch_assoc()) {
            $dataBuku[] = $row;
        }

        $mhsRes = $this->mahasiswaModel->getMahasiswa();
        $dataMahasiswa = [];
        while ($row = $mhsRes->fetch_assoc()) {
            $dataMahasiswa[] = $row;
        }

        $this->peminjamModel->close();
        $this->bukuModel->close();
        $this->mahasiswaModel->close();

        $peminjamView = new PeminjamView();
        $peminjamView->displayAllPeminjam($dataPeminjam, $dataBuku, $dataMahasiswa, $dataEdit);
    }

    public function update($data) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->peminjamModel->open();
            $this->peminjamModel->updatePeminjam($data);
            $this->peminjamModel->close();

            header("Location: index.php");
            exit();
        }
    }

    public function delete($id) {
        $this->peminjamModel->open();
        $this->peminjamModel->getPeminjamById($id);
        $data = $this->peminjamModel->getResult();
        $this->peminjamModel->close();

        $this->peminjamModel->open();
        $this->peminjamModel->deletePeminjam($id);
        $this->peminjamModel->close();

        if ($data['status'] != 'returned') {
            $this->bukuModel->open();
            $this->bukuModel->updateStok($data['buku_id'], 1);
            $this->bukuModel->close();
        }

        header("Location: index.php?controller=peminjam");
    }
}
