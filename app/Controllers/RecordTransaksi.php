<?php

namespace App\Controllers;

use App\Models\UserModel;

class RecordTransaksi extends BaseController
{
    protected $TblpenjualanModel;
    protected $TblpenjualandetailModel;
    protected $OmzetHarianModel;
    protected $StokBarangModel;

    protected $validation;


    public function __construct()
    {
        $this->TblpenjualanModel = new \App\Models\TblpenjualanModel();
        $this->TblpenjualandetailModel = new \App\Models\TblpenjualandetailModel();
        $this->OmzetHarianModel = new \App\Models\OmzetHarianModel();
        $this->StokBarangModel = new \App\Models\StokBarangModel();
        $this->validation = \config\Services::validation();
    }

    public function index()
    {
        if (session()->has('logged_in')) {
            $data = [
                'title' => 'Record Transaksi',
            ];
            return view('record_transaksi/index', $data);
        } else {
            session()->setFlashdata('error', 'Harap login terlebih dahulu');
            return redirect()->to('login');
        }
    }

    public function getDataTransaksi()
    {
        $response = $data['data'] = array();

        //mendapatkan data pelanggan di table user model
        //inisialisasi data tabel , mengambil data dari tabel user
        // $result = $this->TblpenjualanModel->select()->get()->getResult();
        $result = $this->TblpenjualanModel->select()->orderBy('tanggal', 'DESC')->get()->getResult();
        // $result_2 = $this->TblpenjualandetailModel->select()->get()->getResult();
        $no = 1;
        foreach ($result as $key => $value) {

            // dibawah ini utk mengirimkan isi tbl_transaksi_detail dari masing transaksi
            // $result_2 = $this->TblpenjualandetailModel->select()->where('transaksi_id', $value->transaksi_id)->get()->getResult();

            // inisialisai aksi detail
            // dibawah ini aslinya id=update_user
            // modal-edit-user
            $ops =
                '<button 
                    id="lihat_transaksi" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modal-lihat-transaksi"

                    data-transaksi_id= "' . $value->transaksi_id . '"

                    data-invoice= "' . $value->invoice . '"
                    data-nm_kostumer= "' . $value->nm_kostumer . '"
                    data-nm_kostumer_id= "' . $value->nm_kostumer_id . '"
                    data-is_hutang= "' . $value->is_hutang . '"
                    data-total_harga= "' . $value->total_harga . '"
                    data-diskon= "' . $value->diskon . '"
                    data-harga_final= "' . $value->harga_final . '"
                    data-tunai= "' . $value->tunai . '"
                    data-kembalian= "' . $value->kembalian . '"
                    data-catatan= "' . $value->catatan . '"
                    data-user_id= "' . $value->user_id . '"
                    data-tanggal= "' . $value->created_at . '"

                    data-
                    
                    class="btn btn-xs btn-primary">
                    <i class="fas fa-circle-info" ></i> Detail
                </button>';

            // print
            $ops .=
                '<button 
                    id="print_transaksi"

                    data-transaksi_id="' . $value->transaksi_id . '" 
                    
                    class="btn btn-xs btn-outline-dark">
                    <i class="fas fa-print"></i> Print
                </button>';

            $ops .=
                '<button 
                    id="hapus_transaksi"

                    data-transaksi_id="' . $value->transaksi_id . '" 
                    
                    class="btn btn-xs btn-danger">
                    <i class="fas fa-trash"></i> Hapus
                </button>';

            $data['data'][$key] = array(
                $no++, //ini buat kol nomor
                $value->invoice,
                $value->tanggal,
                // $value->user_password,
                $value->nm_kostumer,
                $value->total_harga,
                $value->diskon,
                $value->harga_final,
                $value->catatan,

                $ops // buat kolom aksi
            );
        }

        return $this->response->setJSON($data);
    }

    public function range_getDataTransaksi()
    {
        $response = $data['data'] = array();

        $fields['start_date'] = $this->request->getPost('start_date');
        $fields['end_date'] = $this->request->getPost('end_date');

        //mendapatkan data pelanggan di table user model
        //inisialisasi data tabel , mengambil data dari tabel user
        // $result = $this->OmzetHarianModel->select()->get()->getResult();
        $result = $this->TblpenjualanModel->where('tanggal >=', $fields['start_date'])->where('tanggal <=', $fields['end_date'])->orderBy('tanggal', 'DESC')->get()->getResult();
        $no = 1;
        foreach ($result as $key => $value) {

            // inisialisai aksi detail
            // dibawah ini aslinya id=update_user
            // modal-edit-user
            $ops =
                '<button 
                    id="lihat_transaksi" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modal-lihat-transaksi"

                    data-transaksi_id= "' . $value->transaksi_id . '"

                    data-invoice= "' . $value->invoice . '"
                    data-nm_kostumer= "' . $value->nm_kostumer . '"
                    data-nm_kostumer_id= "' . $value->nm_kostumer_id . '"
                    data-is_hutang= "' . $value->is_hutang . '"
                    data-total_harga= "' . $value->total_harga . '"
                    data-diskon= "' . $value->diskon . '"
                    data-harga_final= "' . $value->harga_final . '"
                    data-tunai= "' . $value->tunai . '"
                    data-kembalian= "' . $value->kembalian . '"
                    data-catatan= "' . $value->catatan . '"
                    data-user_id= "' . $value->user_id . '"
                    data-tanggal= "' . $value->created_at . '"
                    
                    class="btn btn-xs btn-primary">
                    <i class="fas fa-circle-info" ></i> Detail
                </button>';

            // print
            $ops .=
                '<button 
                    id="print_transaksi"

                    data-transaksi_id="' . $value->transaksi_id . '" 
                    
                    class="btn btn-xs btn-outline-dark">
                    <i class="fas fa-print"></i> Print
                </button>';

            $ops .=
                '<button 
                    id="hapus_transaksi"

                    data-transaksi_id="' . $value->transaksi_id . '" 
                    
                    class="btn btn-xs btn-danger">
                    <i class="fas fa-trash"></i> Hapus
                </button>';

            $data['data'][$key] = array(
                $no++, //ini buat kol nomor
                $value->invoice,
                $value->tanggal,
                // $value->user_password,
                $value->nm_kostumer,
                $value->total_harga,
                $value->diskon,
                $value->harga_final,
                $value->catatan,

                $ops // buat kolom aksi
            );
        }
        return $this->response->setJSON($data);
    }

    public function getDetailDataTransaksi()
    {
        $transaksi_id = $this->request->getPost('transaksi_id');

        $result = $this->TblpenjualandetailModel->where('transaksi_id', $transaksi_id)->get()->getResult();
        return $this->response->setJSON($result);
        // $this->SupplierContactModel->where('supp_id', $temp)
    }

    public function delete()
    {
        $response = array();

        $transaksi_id = $this->request->getPost('transaksi_id');
        $temp_variable_1 = $this->TblpenjualanModel->getTransaksiTanggal($transaksi_id);
        $temp_variable_2 = $this->TblpenjualanModel->getHargaFinal($transaksi_id);
        $transaksi_tanggal = $temp_variable_1->tanggal;
        $harga_final = $temp_variable_2->harga_final;

        if ($this->TblpenjualanModel->where('transaksi_id', $transaksi_id)->delete()) {
            // below is replication of trigger transaksi_delete (deleting detail transaksi, substracting omzet) DAN stok_return (kembalikan stok jika ada transaksi di delete)
            $query = $this->TblpenjualandetailModel->getBstockQty($transaksi_id);

            foreach ($query as $row) {
                // $bstock_id = $row['bstock_id'];
                // $qty = $row['qty'];
                $bstock_id = $row->bstock_id;
                $qty = $row->qty;

                // Use $bstock_id and $qty as needed

                $temp_variable_3 = $this->StokBarangModel->select('bstock_ready_stock')->where('bstock_id', $bstock_id)->first();
                $old_stock_qty = $temp_variable_3['bstock_ready_stock'];
                $new_stock_qty = (int)$old_stock_qty + (int)$qty;
                $this->StokBarangModel->where('bstock_id', $bstock_id)->set('bstock_ready_stock', $new_stock_qty)->update();
            }

            // dibawah ini working
            // $response['tempA'] = $this->StokBarangModel->select("bstock_ready_stock")->where("bstock_id", 1)->first();


            // $response['success'] = false;

            // $response['messages'] = lang("App.insert-success");
            // $response['messages'] = $query[0];
            // $response['tempA'] = $query[0];
            // $response['tempA'] = $results;
            // $response['tempA'] = $stock_return[0];
            // $response['tempA'] = $stock_return->qty;

            // ==============================
            $this->TblpenjualandetailModel->where('transaksi_id', $transaksi_id)->delete();

            $omzet_nominal_old = $this->OmzetHarianModel->select("omzet_nominal")->where("omzet_date", $transaksi_tanggal)->first();
            $temp_variable_2 = $omzet_nominal_old["omzet_nominal"];
            $new_omzet = $temp_variable_2 - $harga_final;
            $this->OmzetHarianModel->where("omzet_date", $transaksi_tanggal)->set("omzet_nominal", $new_omzet)->update();
            // end trigger

            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
        return $this->response->setJSON($response);
    }


    // dibawah ini semua proses langsung di function edit. Kalau versiku dimulai dri funciton edit dulu, baru dilanjut ke function update buat update database nya
    public function edit_nganggur()
    {
        $response = array();

        $fields['user_id'] = $this->request->getPost('user_id');
        $fields['user_username'] = $this->request->getPost('user_username');
        $fields['user_password'] = $this->request->getPost('user_password');
        $fields['user_isadmin'] = $this->request->getPost('user_isadmin');
        $fields['user_nama'] = $this->request->getPost('user_nama');
        $fields['user_alamat'] = $this->request->getPost('user_alamat');
        $fields['user_telp'] = $this->request->getPost('user_telp');

        // $temp = $fields['user_id'];
        $temp = $this->request->getPost('user_id');


        // $usernameLama = $this->UserModel->whereIn('user_id', $fields['user_id'])->first();
        $usernameLama = $this->TblpenjualanModel->where('user_id', $temp)->first();
        // $response['tempA'] = $usernameLama['user_username'];
        // $response['tempB'] = $fields['user_username'];
        // $response['tempC'] = $temp;


        if ($usernameLama['user_username'] == $fields['user_username']) {
            $rule_username = 'required';
        } else {
            // $rule_username = 'required';
            $rule_username = 'required|is_unique[user.user_username]|max_length[20]';
        }

        $this->validation->setRules([
            'user_username' =>
            [
                // 'rules' => 'required|is_unique[user.user_username]|max_length[20]',
                'rules' => $rule_username,
                'errors' => [
                    'required' => 'Username harus diisi',
                    'is_unique' => 'Username sudah terdaftar',
                    'max_length' => 'Username maksimal 20 karakter',
                ]
            ],
            'user_password' =>
            [
                'rules' => 'required|max_length[10]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'max_length' => 'Password maksimal 10 karakter',
                ]
            ],
            'user_nama' =>
            [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Nama User harus diisi',
                    'max_length' => 'Nama User maksimal 255 karakter',
                ]
            ],
            'user_alamat' =>
            [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Alamat harus diisi',
                    'max_length' => 'Alamat maksimal 255 karakter',
                ]
            ],
            'user_telp' =>
            [
                'rules' => 'required|max_length[15]',
                'errors' => [
                    'required' => 'Nomor telepon harus diisi',
                    'max_length' => 'Nomor telepon maksimal 15 karakter',
                ]
            ],
        ]);

        if ($this->validation->run($fields) == false) {
            $response['success'] = false;
            $response['messages'] = $this->validation->getErrors();
        } else {
            if ($this->TblpenjualanModel->update($fields['user_id'], $fields)) {
                $response['success'] = true;
                $response['messages'] = lang("App.insert-success");
            } else {
                $response['success'] = false;
                $response['messages'] = lang("App.insert-error");
            }
        }
        return $this->response->setJSON($response);
    }
}
