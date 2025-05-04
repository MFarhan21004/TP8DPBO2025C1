<?php
include_once("Views/Template.class.php");

class MahasiswaView
{
    public function displayAllMahasiswa($dataMahasiswa, $dataEdit = null)
    {
        $judulHeader = null;
        $dataHeader = null;

        $judulHeader .= '<h2 class="text-center mb-4">Tabel Buku</h2>';
        $dataHeader .= "<tr>
        <th>No</th>
        <th>NIM</th>
        <th>Nama Mahasiswa</th>
        <th>Jurusan</th>
        <th>Angkatan</th>
        <th>Email</th>
        <th>Alamat</th>
        <th>Telepon</th>
        <th>Action</th>
      </tr>";

        $dataTabel = null;
        if (count($dataMahasiswa) > 0) {
            $no = 1;
            foreach ($dataMahasiswa as $mhs) {
                $dataTabel .= "<tr>
                        <td>{$no}</td>
                        <td>{$mhs['nim']}</td>
                        <td>{$mhs['nama']}</td>
                        <td>{$mhs['jurusan']}</td>
                        <td>{$mhs['angkatan']}</td>
                        <td>{$mhs['alamat']}</td>
                        <td>{$mhs['email']}</td>
                        <td>{$mhs['telepon']}</td>
                        <td>
                            <a href='?controller=mahasiswa&action=edit&id={$mhs['id']}'>Edit</a> |
                            <a href='?controller=mahasiswa&action=delete&id={$mhs['id']}' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a> 
                            
                        </td>
                    </tr>";
                $no++;
            }
        } else {
            $dataTabel = "<tr><td colspan='8'>Belum ada data mahasiswa.</td></tr>";
        }

        $tambahForm = "<form action='?controller=mahasiswa&action=tambah' method='POST'>
                    <div class='mb-3'>
                        <label for='nim' class='form-label'>NIM</label>
                        <input type='text' class='form-control' id='nim' name='nim' required>
                    </div>
                    <div class='mb-3'>
                        <label for='nama' class='form-label'>Nama Lengkap</label>
                        <input type='text' class='form-control' id='nama' name='nama' required>
                    </div>
                    <div class='mb-3'>
                        <label for='jurusan' class='form-label'>Jurusan</label>
                        <input type='text' class='form-control' id='jurusan' name='jurusan' required>
                    </div>
                    <div class='mb-3'>
                        <label for='angkatan' class='form-label'>Angkatan</label>
                        <input type='number' class='form-control' id='angkatan' name='angkatan' min='2000' max='2099' required>
                    </div>
                    <div class='mb-3'>
                        <label for='email' class='form-label'>Email</label>
                        <input type='email' class='form-control' id='email' name='email' required>
                    </div>
                    <div class='mb-3'>
                        <label for='alamat' class='form-label'>Alamat</label>
                        <textarea class='form-control' id='alamat' name='alamat' rows='3'></textarea>
                    </div>
                    <div class='mb-3'>
                        <label for='telepon' class='form-label'>Nomor Telepon</label>
                        <input type='text' class='form-control' id='telepon' name='telepon'>
                    </div>
                    <button type='submit' name='add' class='btn btn-success w-100'>Tambah Mahasiswa</button>
                </form>";

        $editForm = "";
        if ($dataEdit) {
            $editForm = "<form action='?controller=mahasiswa&action=update' method='POST'>
                            <input type='hidden' name='id' value='{$dataEdit['id']}'>
                            <div class='mb-3'>
                                <label for='nim' class='form-label'>NIM</label>
                                <input type='text' class='form-control' id='nim' name='nim' value='{$dataEdit['nim']}' required>
                            </div>
                            <div class='mb-3'>
                                <label for='nama' class='form-label'>Nama Lengkap</label>
                                <input type='text' class='form-control' id='nama' name='nama' value='{$dataEdit['nama']}' required>
                            </div>
                            <div class='mb-3'>
                                <label for='jurusan' class='form-label'>Jurusan</label>
                                <input type='text' class='form-control' id='jurusan' name='jurusan' value='{$dataEdit['jurusan']}' required>
                            </div>
                            <div class='mb-3'>
                                <label for='angkatan' class='form-label'>Angkatan</label>
                                <input type='number' class='form-control' id='angkatan' name='angkatan' value='{$dataEdit['angkatan']}' min='2000' max='2099' required>
                            </div>
                            <div class='mb-3'>
                                <label for='email' class='form-label'>Email</label>
                                <input type='email' class='form-control' id='email' name='email' value='{$dataEdit['email']}' required>
                            </div>
                            <div class='mb-3'>
                                <label for='alamat' class='form-label'>Alamat</label>
                                <textarea class='form-control' id='alamat' name='alamat' rows='3'>{$dataEdit['alamat']}</textarea>
                            </div>
                            <div class='mb-3'>
                                <label for='telepon' class='form-label'>Nomor Telepon</label>
                                <input type='text' class='form-control' id='telepon' name='telepon' value='{$dataEdit['telepon']}'>
                            </div>
                            <button type='submit' name='edit' class='btn btn-warning w-100'>Simpan Perubahan</button>
                        </form>";
        }

        $this->tpl = new Template("Templates/index.html");
        $this->tpl->replace("JUDUL", "Daftar Mahasiswa");
        $this->tpl->replace("NAMA_TABEL", $judulHeader);
        $this->tpl->replace("HEADER_TABEL", $dataHeader);
        $this->tpl->replace("DATA_TABEL", $dataTabel);
        $this->tpl->replace("NAMA_TAMBAH", "Tambah Mahasiswa");
        $this->tpl->replace("NAMA_EDIT", "Edit Mahasiswa");
        $this->tpl->replace("TAMBAH_FORM", $tambahForm);
        $this->tpl->replace("EDIT_FORM", $editForm);
        $this->tpl->write();
    }
}

?>