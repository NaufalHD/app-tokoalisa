<?php

namespace App\Controllers;

// use App\Models\UserModel;

class BarangSatuan extends BaseController
{
    protected $BarangSatuanModel;
    protected $validation;


    public function __construct()
    {
        $this->BarangSatuanModel = new \App\Models\BarangSatuanModel();
        $this->validation = \config\Services::validation();
    }

    public function index()
    {
        if (session()->has('logged_in')) {

            $data = [
                'title' => 'Satuan Stok Barang',
                'barang_satuan' => $this->BarangSatuanModel->get()->getResult(),
            ];
            return view('barang_satuan/index', $data);
        } else {
            session()->setFlashdata('error', 'Harap login terlebih dahulu');
            return redirect()->to('login');
        }
    }

    public function getDataBarangSatuan()
    {
        $response = $data['data'] = array();

        //inisialisasi data tabel , mengambil data dari tabel barang_kategori
        $result = $this->BarangSatuanModel->select()->get()->getResult();
        $no = 1;
        foreach ($result as $key => $value) {

            // inisialisai aksi ubah data
            $ops =
                '<button 
                    id="update_barang_satuan" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modal-edit-barang-satuan"

                    data-bsatuan_id= "' . $value->bsatuan_id . '"

                    data-bsatuan_nama_old= "' . $value->bsatuan_nama . '"
                    
                    class="btn btn-xs btn-primary">
                        <i class="fas fa-pencil-alt"></i> Ubah
                </button>';

            $ops .=
                '<button 
                    id="hapus_barang_satuan"

                    data-bsatuan_id="' . $value->bsatuan_id . '" 
                    
                    class="btn btn-xs btn-danger">
                    <i class="fas fa-trash"></i> Hapus
                </button>';

            $data['data'][$key] = array(
                $no++, //ini buat kol nomor
                $value->bsatuan_nama,

                $ops // buat kolom aksi
            );
        }

        return $this->response->setJSON($data);
    }

    public function save()
    {
        $response = array();

        $fields['bsatuan_nama'] = $this->request->getPost('bsatuan_nama');

        $this->validation->setRules([
            'bsatuan_nama' =>
            [
                'rules' => 'required|is_unique[barang_satuan.bsatuan_nama]|max_length[20]',
                'errors' => [
                    'required' => 'Nama satuan harus diisi',
                    'is_unique' => 'Nama satuan sudah terdaftar',
                    'max_length' => 'Nama satuan maksimal 20 karakter',
                ]
            ],
        ]);

        if ($this->validation->run($fields) == false) {
            $response['success'] = false;
            $response['messages'] = $this->validation->getErrors();
        } else {
            if ($this->BarangSatuanModel->insert($fields)) {
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

        $fields['bsatuan_id'] = $this->request->getPost('bsatuan_id');
        $fields['bsatuan_nama'] = $this->request->getPost('bsatuan_nama');
        $temp = $this->request->getPost('bsatuan_id');

        $namaSatuanLama = $this->BarangSatuanModel->where('bsatuan_id', $temp)->first();

        if ($namaSatuanLama['bsatuan_nama'] == $fields['bsatuan_nama']) {
            $rule_namaSatuan = 'required';
        } else {
            // $rule_username = 'required';
            $rule_namaSatuan = 'required|is_unique[barang_satuan.bsatuan_nama]|max_length[20]';
        }

        $this->validation->setRules([
            'bsatuan_nama' =>
            [
                // 'rules' => 'required|is_unique[user.user_username]|max_length[20]',
                'rules' => $rule_namaSatuan,
                'errors' => [
                    'required' => 'Nama satuan harus diisi',
                    'is_unique' => 'Nama satuan sudah terdaftar',
                    'max_length' => 'Nama satuan maksimal 20 karakter',
                ]
            ],
        ]);

        if ($this->validation->run($fields) == false) {
            $response['success'] = false;
            $response['messages'] = $this->validation->getErrors();
        } else {
            if ($this->BarangSatuanModel->update($fields['bsatuan_id'], $fields)) {
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

        $bsatuan_id = $this->request->getPost('bsatuan_id');

        if ($this->BarangSatuanModel->where('bsatuan_id', $bsatuan_id)->delete()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }

        return $this->response->setJSON($response);
    }
}
