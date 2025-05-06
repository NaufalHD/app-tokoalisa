<?php

namespace App\Controllers;

// use App\Models\UserModel;

class BarangKategori extends BaseController
{
    protected $BarangKategoriModel;
    protected $validation;


    public function __construct()
    {
        $this->BarangKategoriModel = new \App\Models\BarangKategoriModel();
        $this->validation = \config\Services::validation();
    }


    public function index()
    {
        if (session()->has('logged_in')) {
            $data = [
                'title' => 'Kategori Stok Barang',
                'barang_kategori' => $this->BarangKategoriModel->get()->getResult(),
            ];
            return view('barang_kategori/index', $data);
        } else {
            session()->setFlashdata('error', 'Harap login terlebih dahulu');
            return redirect()->to('login');
        }
    }

    public function getDataBarangKategori()
    {
        $response = $data['data'] = array();

        //inisialisasi data tabel , mengambil data dari tabel barang_kategori
        $result = $this->BarangKategoriModel->select()->get()->getResult();
        $no = 1;
        foreach ($result as $key => $value) {

            // inisialisai aksi ubah data
            $ops =
                '<button 
                    id="update_barang_kategori" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modal-edit-barang-kategori"

                    data-bkategori_id= "' . $value->bkategori_id . '"

                    data-bkategori_nama_old= "' . $value->bkategori_nama . '"
                    
                    class="btn btn-xs btn-primary">
                        <i class="fas fa-pencil-alt"></i> Ubah
                </button>';

            $ops .=
                '<button 
                    id="hapus_barang_kategori"

                    data-bkategori_id="' . $value->bkategori_id . '" 
                    
                    class="btn btn-xs btn-danger">
                    <i class="fas fa-trash"></i> Hapus
                </button>';

            $data['data'][$key] = array(
                $no++, //ini buat kol nomor
                $value->bkategori_nama,

                $ops // buat kolom aksi
            );
        }

        return $this->response->setJSON($data);
    }

    public function save()
    {
        $response = array();

        $fields['bkategori_nama'] = $this->request->getPost('bkategori_nama');

        $this->validation->setRules([
            'bkategori_nama' =>
            [
                'rules' => 'required|is_unique[barang_kategori.bkategori_nama]|max_length[20]',
                'errors' => [
                    'required' => 'Nama kategori harus diisi',
                    'is_unique' => 'Nama kategori sudah terdaftar',
                    'max_length' => 'Nama kategori maksimal 20 karakter',
                ]
            ],
        ]);

        if ($this->validation->run($fields) == false) {
            $response['success'] = false;
            $response['messages'] = $this->validation->getErrors();
        } else {
            if ($this->BarangKategoriModel->insert($fields)) {
                $response['success'] = true;
                $response['messages'] = lang("App.insert-success");
            } else {
                $response['success'] = false;
                $response['messages'] = lang("App.insert-error");
            }
        }

        return $this->response->setJSON($response);
    }

    // dibawah ini semua proses langsung di function edit. Kalau versiku dimulai dri funciton edit dulu, baru dilanjut ke function update buat update database nya
    public function edit()
    {
        $response = array();

        $fields['bkategori_id'] = $this->request->getPost('bkategori_id');
        $fields['bkategori_nama'] = $this->request->getPost('bkategori_nama');
        $temp = $this->request->getPost('bkategori_id');

        $namaKategoriLama = $this->BarangKategoriModel->where('bkategori_id', $temp)->first();

        if ($namaKategoriLama['bkategori_nama'] == $fields['bkategori_nama']) {
            $rule_namaKategori = 'required';
        } else {
            // $rule_username = 'required';
            $rule_namaKategori = 'required|is_unique[barang_kategori.bkategori_nama]|max_length[20]';
        }

        $this->validation->setRules([
            'bkategori_nama' =>
            [
                // 'rules' => 'required|is_unique[user.user_username]|max_length[20]',
                'rules' => $rule_namaKategori,
                'errors' => [
                    'required' => 'Nama kategori harus diisi',
                    'is_unique' => 'Nama kategori sudah terdaftar',
                    'max_length' => 'Nama kategori maksimal 20 karakter',
                ]
            ],
        ]);

        if ($this->validation->run($fields) == false) {
            $response['success'] = false;
            $response['messages'] = $this->validation->getErrors();
        } else {
            if ($this->BarangKategoriModel->update($fields['bkategori_id'], $fields)) {
                $response['success'] = true;
                $response['messages'] = lang("App.insert-success");
            } else {
                $response['success'] = false;
                $response['messages'] = lang("App.insert-error");
            }
        }

        return $this->response->setJSON($response);
    }

    public function delete()
    {
        $response = array();

        $bkategori_id = $this->request->getPost('bkategori_id');

        if ($this->BarangKategoriModel->where('bkategori_id', $bkategori_id)->delete()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }

        return $this->response->setJSON($response);
    }
}
