<?php

class BukuView
{
    public function displayAllBuku($dataBuku, $dataEdit = null)
    {

        $judulHeader = null;
        $dataHeader = null;

        $judulHeader .= '<h2 class="text-center mb-4">Tabel Buku</h2>';
        
        $dataHeader .= "<tr>
        <th>No</th>
        <th>Judul</th>
        <th>Pengarang</th>
        <th>Penerbit</th>   
        <th>Tahun Terbit</th>
        <th>Jumlah Halaman</th>
        <th>Stok</th>
        <th>Action</th>
        </tr>";

        $dataTabel = null;
        if (count($dataBuku) > 0) {
            $no = 1;
            foreach ($dataBuku as $buku) {
                $dataTabel .= "<tr>
                        <td>{$no}</td>
                        <td>{$buku['judul']}</td>
                        <td>{$buku['pengarang']}</td>
                        <td>{$buku['penerbit']}</td>
                        <td>{$buku['tahun_terbit']}</td>
                        <td>{$buku['jumlah_halaman']}</td>
                        <td>{$buku['stok']}</td>
                        <td>
                            <a href='?controller=buku&action=edit&id={$buku['id']}'>Edit</a> |
                            <a href='?controller=buku&action=delete&id={$buku['id']}' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>
                        </td>
                    </tr>";
                $no++;
            }
        } else {
            $dataTabel = "<tr><td colspan='8'>Belum ada data buku.</td></tr>";
        }

        $tambahForm = "<form action='?controller=buku&action=tambah' method='POST'>
                    <div class='mb-3'>
                        <label for='judul' class='form-label'>Judul Buku</label>
                        <input type='text' class='form-control' id='judul' name='judul' required>
                    </div>
                    <div class='mb-3'>
                        <label for='pengarang' class='form-label'>Pengarang</label>
                        <input type='text' class='form-control' id='pengarang' name='pengarang' required>
                    </div>
                    <div class='mb-3'>
                        <label for='penerbit' class='form-label'>Penerbit</label>
                        <input type='text' class='form-control' id='penerbit' name='penerbit' required>
                    </div>
                    <div class='mb-3'>
                        <label for='tahun_terbit' class='form-label'>Tahun Terbit</label>
                        <input type='number' class='form-control' id='tahun_terbit' name='tahun_terbit' min='1900' max='2099' required>
                    </div>
                    <div class='mb-3'>
                        <label for='jumlah_halaman' class='form-label'>Jumlah Halaman</label>
                        <input type='number' class='form-control' id='jumlah_halaman' name='jumlah_halaman' min='1' required>
                    </div>
                    <div class='mb-3'>
                        <label for='stok' class='form-label'>Stok</label>
                        <input type='number' class='form-control' id='stok' name='stok' min='0' required>
                    </div>
                    <button type='submit' name='add' class='btn btn-success w-100'>Tambah Buku</button>
                </form>";

        $editForm = "";
        if ($dataEdit) {
            $editForm = "<form action='?controller=buku&action=update' method='POST'>
                            <input type='hidden' name='id' value='{$dataEdit['id']}'>
                            <div class='mb-3'>
                                <label for='judul' class='form-label'>Judul Buku</label>
                                <input type='text' class='form-control' id='judul' name='judul' value='{$dataEdit['judul']}' required>
                            </div>
                            <div class='mb-3'>
                                <label for='pengarang' class='form-label'>Pengarang</label>
                                <input type='text' class='form-control' id='pengarang' name='pengarang' value='{$dataEdit['pengarang']}' required>
                            </div>
                            <div class='mb-3'>
                                <label for='penerbit' class='form-label'>Penerbit</label>
                                <input type='text' class='form-control' id='penerbit' name='penerbit' value='{$dataEdit['penerbit']}' required>
                            </div>
                            <div class='mb-3'>
                                <label for='tahun_terbit' class='form-label'>Tahun Terbit</label>
                                <input type='number' class='form-control' id='tahun_terbit' name='tahun_terbit' value='{$dataEdit['tahun_terbit']}' min='1900' max='2099' required>
                            </div>
                            <div class='mb-3'>
                                <label for='jumlah_halaman' class='form-label'>Jumlah Halaman</label>
                                <input type='number' class='form-control' id='jumlah_halaman' name='jumlah_halaman' value='{$dataEdit['jumlah_halaman']}' min='1' required>
                            </div>
                            <div class='mb-3'>
                                <label for='stok' class='form-label'>Stok</label>
                                <input type='number' class='form-control' id='stok' name='stok' value='{$dataEdit['stok']}' min='0' required>
                            </div>
                            <button type='submit' name='edit' class='btn btn-warning w-100'>Simpan Perubahan</button>
                        </form>";
        }

        $this->tpl = new Template("Templates/index.html");
        $this->tpl->replace("JUDUL", "Daftar Buku");
        $this->tpl->replace("NAMA_TABEL", $judulHeader);
        $this->tpl->replace("HEADER_TABEL", $dataHeader);
        $this->tpl->replace("DATA_TABEL", $dataTabel);
        $this->tpl->replace("NAMA_TAMBAH", "Tambah Buku");
        $this->tpl->replace("NAMA_EDIT", "Edit Buku");
        $this->tpl->replace("TAMBAH_FORM", $tambahForm);
        $this->tpl->replace("EDIT_FORM", $editForm);
        $this->tpl->write();
    }
}

?>