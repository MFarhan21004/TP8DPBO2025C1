<?php
include_once("DB.php");

// Models/Mahasiswa.class.php
class Mahasiswa extends DB 
{
    // Mengambil semua data mahasiswa
    function getMahasiswa()
    {
        $query = "SELECT * FROM mahasiswa ORDER BY nama ASC";
        return $this->execute($query);
    }

    // Mengambil data mahasiswa berdasarkan ID
    function getMahasiswaById($id)
    {
        $query = "SELECT * FROM mahasiswa WHERE id = '$id'";
        return $this->execute($query);
    }

    // Mengambil data mahasiswa berdasarkan NIM
    function getMahasiswaByNIM($nim)
    {
        $query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
        return $this->execute($query);
    }

    // Menambah data mahasiswa baru
    function addMahasiswa($data)
    {
        $nim = $data['nim'];
        $nama = $data['nama'];
        $jurusan = $data['jurusan'];
        $angkatan = $data['angkatan'];
        $email = $data['email'];
        $alamat = $data['alamat'];
        $telepon = $data['telepon'];

        $query = "INSERT INTO mahasiswa (nim, nama, jurusan, angkatan, email, alamat, telepon) 
                  VALUES ('$nim', '$nama', '$jurusan', '$angkatan', '$email', '$alamat', '$telepon')";
        
        return $this->execute($query);
    }

    // Update data mahasiswa
    function updateMahasiswa($data)
    {
        $id = $data['id'];
        $nim = $data['nim'];
        $nama = $data['nama'];
        $jurusan = $data['jurusan'];
        $angkatan = $data['angkatan'];
        $email = $data['email'];
        $alamat = $data['alamat'];
        $telepon = $data['telepon'];

        $query = "UPDATE mahasiswa 
                  SET nim = '$nim', nama = '$nama', jurusan = '$jurusan', 
                      angkatan = '$angkatan', email = '$email', alamat = '$alamat', telepon = '$telepon' 
                  WHERE id = '$id'";

        return $this->execute($query);
    }

    // Menghapus data mahasiswa
    function deleteMahasiswa($id)
    {
        $query = "DELETE FROM mahasiswa WHERE id = '$id'";
        return $this->execute($query);
    }


}

?>