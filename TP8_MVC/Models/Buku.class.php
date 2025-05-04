<?php
include_once("DB.php");

// Models/Buku.class.php
class Buku extends DB 
{
    // Mengambil semua data buku
    function getBuku()
    {
        $query = "SELECT * FROM buku ORDER BY judul ASC";
        return $this->execute($query);
    }

    // Mengambil data buku berdasarkan ID
    function getBukuById($id)
    {
        $query = "SELECT * FROM buku WHERE id = '$id'";
        return $this->execute($query);
    }

    // Menambah data buku baru
    function addBuku($data)
    {
        $judul = $data['judul'];
        $pengarang = $data['pengarang'];
        $penerbit = $data['penerbit'];
        $tahun_terbit = $data['tahun_terbit'];
        $jumlah_halaman = $data['jumlah_halaman'];
        $stok = $data['stok'];

        $query = "INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit, jumlah_halaman, stok) 
                  VALUES ('$judul', '$pengarang', '$penerbit', '$tahun_terbit', '$jumlah_halaman', '$stok')";
        
        return $this->execute($query);
    }

    // Update data buku
    function updateBuku($data)
    {
        $id = $data['id'];
        $judul = $data['judul'];
        $pengarang = $data['pengarang'];
        $penerbit = $data['penerbit'];
        $tahun_terbit = $data['tahun_terbit'];
        $jumlah_halaman = $data['jumlah_halaman'];
        $stok = $data['stok'];

        $query = "UPDATE buku 
                  SET judul = '$judul', pengarang = '$pengarang', penerbit = '$penerbit', 
                      tahun_terbit = '$tahun_terbit', jumlah_halaman = '$jumlah_halaman', stok = '$stok' 
                  WHERE id = '$id'";

        return $this->execute($query);
    }

    // Menghapus data buku
    function deleteBuku($id)
    {
        $query = "DELETE FROM buku WHERE id = '$id'";
        return $this->execute($query);
    }

    // Update stok buku (untuk peminjaman/pengembalian)
    function updateStok($id, $jumlah)
    {
        $query = "UPDATE buku SET stok = stok + ($jumlah) WHERE id = '$id'";
        return $this->execute($query);
    }

}

?>