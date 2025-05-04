<?php

class PeminjamView
{
    public function displayAllPeminjam($dataPeminjam, $dataBuku, $dataMahasiswa, $dataEdit = null)
    {
        $judulHeader = null;
        $dataHeader = null;

        $judulHeader .= '<h2 class="text-center mb-4">Tabel Peminjaman Buku</h2>';
       
        $dataHeader .= "<tr>
        <th>No</th>
        <th>Nama Mahasiswa</th>
        <th>ID Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
        <th>Action</th>
        </tr>";
        
        $dataTabel = null;
        if (count($dataPeminjam) > 0) {
            $no = 1;
            foreach ($dataPeminjam as $pinjam) {
                $dataTabel .= "<tr>
                        <td>{$no}</td>
                        <td>{$pinjam['nama_mahasiswa']}</td>
                        <td>{$pinjam['judul_buku']}</td>
                        <td>{$pinjam['tanggal_pinjam']}</td>
                        <td>{$pinjam['tanggal_kembali']}</td>
                        <td>{$pinjam['status']}</td>
                        <td>
                            <a href='?action=edit&id={$pinjam['id']}'>Edit</a> |
                            <a href='?action=delete&id={$pinjam['id']}' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>
                        </td>
                    </tr>";
                $no++;
            }
        } else {
            $dataTabel = "<tr><td colspan='7'>Belum ada data peminjaman.</td></tr>";
        }

        $optionMHS = "";
        foreach ($dataMahasiswa as $d) {
            $optionMHS .= "<option value='" . $d['id'] . "'>" . $d['nama'] . "</option>";
        }

        $optionBuku = "";
        foreach ($dataBuku as $d) {
            $optionBuku .= "<option value='" . $d['id'] . "'>" . $d['judul'] . "</option>";
        }

        $tambahForm = "<form action='?action=tambah' method='POST'>
                    <div class='mb-3'>
                        <label for='nama_mhs' class='form-label'>Nama Mahasiswa</label>
                        <select id='nama_mhs' name='nama_mhs' class='form-select' required>
                            <option selected>Pilih Mahasiswa</option>
                            {$optionMHS}
                        </select>
                    </div>
                    <div class='mb-3'>
                        <label for='id_buku' class='form-label'>Nama Buku</label>
                        <select id='id_buku' name='id_buku' class='form-select' required>
                            <option selected>Pilih Buku</option>
                            {$optionBuku}
                        </select>
                    </div>
                    <div class='mb-3'>
                        <label for='tanggal_pinjam' class='form-label'>Tanggal Pinjam</label>
                        <input type='date' class='form-control' id='tanggal_pinjam' name='tanggal_pinjam' required>
                    </div>
                    <div class='mb-3'>
                        <label for='tanggal_kembali' class='form-label'>Tanggal Kembali</label>
                        <input type='date' class='form-control' id='tanggal_kembali' name='tanggal_kembali' required>
                    </div>
                    <div class='mb-3'>
                        <label for='status' class='form-label'>Status</label>
                        <select id='status' name='status' class='form-select' required>
                            <option value='Dipinjam'>Dipinjam</option>
                            <option value='Dikembalikan'>Dikembalikan</option>
                            <option value='Terlambat'>Terlambat</option>
                            <option value='Tersedia'>Tersedia</option>
                        </select>
                    </div>
                    <button type='submit' name='add' class='btn btn-success w-100'>Tambah Peminjaman</button>
                </form>";

        $editForm = "";
        if ($dataEdit) {
            $editForm = "<form action='?action=update' method='POST'>
                            <input type='hidden' name='id_peminjaman' value='{$dataEdit['id']}'>
                            <div class='mb-3'>
                                <label for='nama_mhs' class='form-label'>Nama Mahasiswa</label>
                                <select id='nama_mhs' name='nama_mhs' class='form-select' required>
                                    <option selected value='{$dataEdit['mahasiswa_id']}'>{$dataEdit['nama_mahasiswa']}</option>
                                    {$optionMHS}
                                </select>
                            </div>
                            <div class='mb-3'>
                                <label for='id_buku' class='form-label'>Nama Buku</label>
                                <select id='id_buku' name='id_buku' class='form-select' required>
                                    <option selected value='{$dataEdit['buku_id']}'>{$dataEdit['judul_buku']}</option>
                                    {$optionBuku}
                                </select>
                            </div>
                            <div class='mb-3'>
                                <label for='tanggal_pinjam' class='form-label'>Tanggal Pinjam</label>
                                <input type='date' class='form-control' id='tanggal_pinjam' name='tanggal_pinjam' value='{$dataEdit['tanggal_pinjam']}' required>
                            </div>
                            <div class='mb-3'>
                                <label for='tanggal_kembali' class='form-label'>Tanggal Kembali</label>
                                <input type='date' class='form-control' id='tanggal_kembali' name='tanggal_kembali' value='{$dataEdit['tanggal_kembali']}' required>
                            </div>
                            <div class='mb-3'>
                                <label for='status' class='form-label'>Status</label>
                                <select id='status' name='status' class='form-select' required>
                                    <option selected value='{$dataEdit['status']}'>{$dataEdit['status']}</option>
                                    <option value='Dipinjam'>Dipinjam</option>
                                    <option value='Dikembalikan'>Dikembalikan</option>
                                    <option value='Terlambat'>Terlambat</option>
                                    <option value='Tersedia'>Tersedia</option>
                                </select>
                            </div>
                            <button type='submit' name='edit' class='btn btn-warning w-100'>Simpan Perubahan</button>
                        </form>";
        }

        $this->tpl = new Template("Templates/index.html");
        $this->tpl->replace("JUDUL", "Daftar Peminjaman");
        $this->tpl->replace("NAMA_TABEL", $judulHeader);
        $this->tpl->replace("HEADER_TABEL", $dataHeader);
        $this->tpl->replace("DATA_TABEL", $dataTabel);
        $this->tpl->replace("OPTION_MAHASISWA", $optionMHS);
        $this->tpl->replace("OPTION_BUKU", $optionBuku);
        $this->tpl->replace("NAMA_TAMBAH", "Tambah Peminjaman");
        $this->tpl->replace("NAMA_EDIT", "Edit Peminjaman");
        $this->tpl->replace("TAMBAH_FORM", $tambahForm);
        $this->tpl->replace("EDIT_FORM", $editForm);
        $this->tpl->write();
    }
}

?>
