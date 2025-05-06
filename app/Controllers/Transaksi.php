<?php

namespace App\Controllers;

use App\Database\Migrations\TblPenjualanDetail;
use App\Models\PelangganModel;
use App\Models\StokBarangModel;
use App\Models\TblcartModel;
use App\Models\TblpenjualandetailModel;
use App\Models\TblpenjualanModel;
use App\Models\OmzetHarianModel;
use App\Models\HutangPelangganModel;
use Config\Pager;

class Transaksi extends BaseController
{
    protected $PelangganModel;
    protected $OmzetHarianModel;
    protected $HutangPelangganModel;
    protected $stokBarang;
    protected $validation;
    protected $cart;
    protected $penjualan;
    protected $penjualanDetail;
    protected $session;

    public function __construct()
    {
        // memanggil class model barang pada class transaksi
        $this->stokBarang = new StokBarangModel();
        $this->validation =  \Config\Services::validation();
        $this->cart = new TblcartModel();
        $this->penjualan = new TblpenjualanModel();
        $this->penjualanDetail = new TblpenjualandetailModel();
        $this->session = session();
        $this->PelangganModel = new PelangganModel();
        $this->OmzetHarianModel = new OmzetHarianModel();
        $this->HutangPelangganModel = new HutangPelangganModel();
    }

    public function index()
    {
        if (session()->has('logged_in')) {
            $data = [
                'title' => 'transaksi',
                //mendapatkan nomor invoice yang telah di generate otomatis di TblPenjualanModel
                'invoice' => $this->penjualan->invoice_no(),

                //mengambil seluruh data barang lalu mengirim ke index view transaksi

                // line dibawah ini adalalh dari masjul, yaitu dia akan langsung mengambil data
                // yang akan berbentuk OBJECT (tanpa harus set returntype='object' di modelnya)
                'item' => $this->stokBarang->get()->getResult(),

                // kl dibawah ini itu data nya bakal non-object krn di modelnya tidak di set return type object
                // 'item' => $this->stokBarang->getStokBarang(),


                'kasir' => $this->session->get('username') ? $this->session->get('username') : 'kasir',

                'data_pelanggan_row' =>  $this->PelangganModel->select()->get()->getResult()
            ];
            // if ($this->OmzetHarianModel->select()->where('omzet_id', 2)) {
            //     echo "slebew";
            // }
            return view('transaksi/index', $data);
        } else {
            session()->setFlashdata('error', 'Harap login terlebih dahulu');
            return redirect()->to('login');
        }
    }

    public function getCart()
    {
        $response = array();

        $bstock_id = $this->request->getPostGet('bstock_id');

        $data = $this->cart->select('qty')->where('bstock_id', $bstock_id)->first();

        $response['success'] = true;
        $response['data'] = $data ? $data->qty : 0;


        return $this->response->setJSON($response);
    }

    public function getCartData()
    {
        $response = $data['data'] = array();

        $result = $this->cart->select()->join('barang_stock', 'barang_stock.bstock_id = tbl_cart.bstock_id')->where('user_id', '0')->findAll();
        $no = 1;
        foreach ($result as $key => $value) {

            $ops =
                '<button 
                    id="update_cart" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modal-item-edit" 
                    data-id_cart="' . $value->id_cart . '" 
                    data-product="' . $value->bstock_nama_barang . '" 
                    data-harga="' . $value->harga . '" 
                    data-qty="' . $value->qty . '" 
                    data-stock="' . $value->bstock_ready_stock . '" 
                    data-diskon="' . $value->diskon . '" 
                    data-total="' . $value->total . '" 
                    class="btn btn-xs btn-primary">
                        <i class="fas fa-pencil-alt"></i> Ubah
                </button>';

            $ops .=
                '<button 
                    id="delete_cart" 
                    data-id_cart="' . $value->id_cart . '" 
                    class="btn btn-xs btn-danger">
                        <i class="fas fa-trash"></i> Hapus
                </button>';

            $data['data'][$key] = array(
                $no++,
                $value->bstock_custom_code,
                $value->bstock_nama_barang,
                $value->harga,
                $value->qty,
                $value->diskon,
                '<div id="total">' . $value->total . '</div>',
                // $value->user_id,

                $ops
            );
        }

        return $this->response->setJSON($data);
    }

    public function getSubTotal()
    {

        $response = array();

        $data = $this->cart->where('user_id', $this->session->get('user_id') ? $this->session->get('user_id') : '0')->findAll();

        $sub_total = 0;
        foreach ($data as $value) {
            $sub_total += $value->total;
        }

        $response['success'] = true;
        $response['data'] = $data ? $sub_total : 0;

        return $this->response->setJSON($response);
    }

    public function addCart()
    {

        $response = array();
        $fields['bstock_id'] = $this->request->getPost('bstock_id');
        $fields['harga'] = $this->request->getPost('harga');
        $fields['qty'] = $this->request->getPost('qty');
        $data = $this->cart->where('bstock_id', $fields['bstock_id'])->countAllResults();
        if ($data > 0) {
            if ($this->penjualan->update_cart_qty($fields)) {
                $response['success'] = true;
            } else {
                $response['success'] = false;
            }
        } else {
            $params = array(
                // 'cart_id' => $cart_no,
                'bstock_id' => $fields['bstock_id'],
                'harga' => $fields['harga'],
                'qty' => $fields['qty'],
                'total' => $fields['harga'] * $fields['qty'],
                'diskon' => 0,
                'user_id' => $this->session->get('user_id') ? $this->session->get('user_id') : '0'
            );
            if ($this->cart->insert($params)) {
                $response['success'] = true;
            } else {
                $response['success'] = false;
            }
        }

        return $this->response->setJSON($response);
    }

    public function cart_delete()
    {
        // dd("b");
        $response = array();

        $id = $this->request->getPost('id_cart');
        $user_id = $this->session->get('user_id') ? $this->session->get('user_id') : '0';
        if (!$id) {
            if ($this->cart->where('user_id', $user_id)->delete()) {
                $response['success'] = true;
            } else {
                $response['success'] = false;
            }
        } else {
            if (!$this->validation->check($id, 'required|numeric')) {

                throw new \CodeIgniter\Exceptions\PageNotFoundException();
            } else {
                if ($this->cart->where('id_cart', $id)->delete()) {
                    $response['success'] = true;
                } else {
                    $response['success'] = false;
                }
            }
        }
        return $this->response->setJSON($response);
    }

    public function edit_cart()
    {
        $response = array();

        $fields['id_cart'] = $this->request->getPost('id_cart');
        $fields['harga'] = $this->request->getPost('harga');
        $fields['qty'] = $this->request->getPost('qty');
        $fields['diskon'] = $this->request->getPost('diskon');
        $fields['total'] = $this->request->getPost('total');


        if ($this->cart->update($fields['id_cart'], $fields)) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }

        return $this->response->setJSON($response);
    }

    public function prosesPembayaran()
    {
        $response = array();

        $user_id = $this->session->get('user_id') ? $this->session->get('user_id') : '0';

        $fields['transaksi_id'] = $this->request->getPost('transaksi_id');
        $fields['invoice'] = $this->penjualan->invoice_no();
        $fields['nm_kostumer'] = $this->request->getPost('nm_kostumer');
        $fields['nm_kostumer_id'] = $this->request->getPost('nm_kostumer_id');
        $fields['total_harga'] = $this->request->getPost('total_harga');
        $fields['diskon'] = $this->request->getPost('diskon');
        $fields['harga_final'] = $this->request->getPost('harga_final');
        $fields['tunai'] = $this->request->getPost('tunai');
        $fields['kembalian'] = $this->request->getPost('kembalian');
        $temp = $this->request->getPost('ajukan_hutang');
        $temp ? $fields['is_hutang'] = 1 : $fields['is_hutang'] = 0;
        // is_hutang == 0, langsung lunas
        // is_hutang == 1, hutang, belum lunas
        // is_hutang == 2, hutang, sudah lunas

        // $response['tempA'] = $temp;
        // $response['tempB'] = $fields['is_hutang'];

        $fields['catatan'] = $this->request->getPost('catatan');
        $fields['user_id'] = $user_id;
        $fields['tanggal'] = $this->request->getPost('date');
        $fields['created_at'] = date('Y-m-d H:i:s');

        // $isPelangganHutang = $fields['is_hutang'] == 1 ? true : false;
        // $fields['is_hutang'] == 1 ? $b = true : $b = false;


        // dibawah ini untuk:
        // 1. mengisi "nm_kostumer" dan "nm_kostumer_id" apabila ada pelanggan hutang baru yang mendaftarkan data diri pelanggan melalui halaman transaksi
        // 2. mendaftarkan data pada tabel hutang pelanggan baik utk pelanggan baru (sesuai keterangan no.1) ataupun pelanggan lama (pelanggan yang sudah terdaftar sebelumnya)
        if ($fields['is_hutang'] == 1) {
            if ($fields['nm_kostumer_id'] == 0) {
                $pelanggan_terbaru = $this->PelangganModel->orderBy('created_at', 'DESC')
                    ->limit(1)
                    ->get()
                    ->getRow();
                $fields['nm_kostumer_id'] = $pelanggan_terbaru->pelanggan_id;
                $fields['nm_kostumer'] = $pelanggan_terbaru->pelanggan_nama;

                if ($this->penjualan->insert($fields)) {
                    $transaksi_id = $this->penjualan->insertID();
                    $carts = $this->cart->where('user_id', $user_id)->findAll();

                    // dibawah ini utk mengambil row transaksi terbaru yang baru ditambahkan di halaman transaksi
                    $transaksi_terbaru = $this->penjualan->orderBy('created_at', 'DESC')
                        ->limit(1)
                        ->get()
                        ->getRow();

                    $fields_hutang_baru['hutang_idpelanggan'] = $pelanggan_terbaru->pelanggan_id;
                    $fields_hutang_baru['hutang_date'] = $fields['tanggal'];
                    $fields_hutang_baru['hutang_nominal'] = ($fields['kembalian'] * -1);
                    $fields_hutang_baru['hutang_islunas'] = 0;
                    $fields_hutang_baru['hutang_transaksi_id'] = $transaksi_terbaru->transaksi_id;


                    // kode dibawah buat nge cek ada gak data yang dicari. kalau gaada jumlahnya = 0
                    // $tempA = $this->OmzetHarianModel->select()->where('omzet_date', date("0002-01-01"))->countAllResults();
                    $transaksi_tanggal = date($fields['tanggal']);
                    $omzet_already_exists = $this->OmzetHarianModel->select()->where('omzet_date', $transaksi_tanggal)->countAllResults();

                    // utk nambah omzet
                    if ($omzet_already_exists > 0) {
                        $omzet_nominal_old = $this->OmzetHarianModel->select("omzet_nominal")->where("omzet_date", $transaksi_tanggal)->first();
                        $tempB = $omzet_nominal_old["omzet_nominal"];
                        $new_omzet = $tempB + $fields['harga_final'];

                        $this->OmzetHarianModel->where("omzet_date", $transaksi_tanggal)->set("omzet_nominal", $new_omzet)->update();
                    } else {
                        // $response['tempA'] = "Ini masuk else";
                        $new_omzet['omzet_date'] = $fields['tanggal'];
                        $new_omzet['omzet_nominal'] = $fields['harga_final'];
                        $this->OmzetHarianModel->insert($new_omzet);
                    }

                    $row = [];
                    foreach ($carts as $cart) {
                        array_push($row, array(
                            'transaksi_id' => $transaksi_id,
                            'bstock_id' => $cart->bstock_id,
                            'harga' => $cart->harga,
                            'diskon' => $cart->diskon,
                            'qty' => $cart->qty,
                            'total' => ($cart->harga - $cart->diskon) * $cart->qty
                        ));

                        // below is replicate of trigger "stok_min" (Pengurangan stok dari pembelian)
                        $temp_variable_1 = $this->stokBarang->select("bstock_ready_stock")->where("bstock_id", $cart->bstock_id)->first();
                        $old_stock_qty = $temp_variable_1["bstock_ready_stock"];
                        $subtracted_stock_qty = $old_stock_qty - $cart->qty;
                        $this->stokBarang->where('bstock_id', $cart->bstock_id)->set('bstock_ready_stock', $subtracted_stock_qty)->update();
                        // end trigger
                    }

                    if ($this->penjualanDetail->insertBatch($row)) {
                        $this->cart->where('user_id', $user_id)->delete();
                        $response['success'] = true;
                        $response['transaksi_id'] = $transaksi_id;
                    } else {
                        $response['success'] = false;
                    }


                    // dibawah ini kode utk mendaftarkann data ke tabel hutang pelanggan
                    if ($this->HutangPelangganModel->insert($fields_hutang_baru)) {
                        $response['success'] = true;
                    } else {
                        $response['success'] = false;
                    }
                    // $response['tempB'] = $fields_hutang_baru['hutang_nominal'];
                    // $response['tempB'] = $pelanggan_terbaru->pelanggan_nama;
                    // $response['tempB'] = $pelanggan_terbaru;
                } else {
                    $response['success'] = false;
                }
            } else {
                // pelanggan lama (telah terdaftar sebelumnya) yang mengajukan hutang baru

                if ($this->penjualan->insert($fields)) {
                    // line dibawah ini insertID letaknya harus dibawah penjualan->insert($fields)
                    // penjelasan ada di komentar panjang dibawah
                    $transaksi_id = $this->penjualan->insertID();
                    $carts = $this->cart->where('user_id', $user_id)->findAll();

                    $transaksi_terbaru = $this->penjualan->orderBy('created_at', 'DESC')
                        ->limit(1)
                        ->get()
                        ->getRow();

                    $fields_hutang_baru['hutang_idpelanggan'] = $fields['nm_kostumer_id'];
                    $fields_hutang_baru['hutang_date'] = $fields['tanggal'];
                    $fields_hutang_baru['hutang_nominal'] = ($fields['kembalian'] * -1);
                    $fields_hutang_baru['hutang_islunas'] = 0;
                    $fields_hutang_baru['hutang_transaksi_id'] = $transaksi_terbaru->transaksi_id;

                    // $transaksi_id = $this->penjualan->insertID();
                    // $carts = $this->cart->where('user_id', $user_id)->findAll();

                    //In the first code snippet you provided, the line 
                    // $transaksi_id = $this->penjualan->insertID(); 
                    // is placed after the retrieval of $transaksi_terbaru (seperti penulisan diatas ini, $transaksi_id diletakkan setelah proses $transaksi_terbaru). This means that the value of $transaksi_id is retrieved before the latest transaction ($transaksi_terbaru) is fetched from the database. As a result, $transaksi_id will not have the correct value because it's obtained before the insertion of the new transaction record.

                    // In the second code snippet, the line $transaksi_id = $this->penjualan->insertID(); is placed immediately after the insertion operation $this->penjualan->insert($fields). This ensures that $transaksi_id is assigned the correct ID of the newly inserted transaction because it's obtained right after the insertion operation.

                    // kode dibawah buat nge cek ada gak data yang dicari. kalau gaada jumlahnya = 0
                    // $tempA = $this->OmzetHarianModel->select()->where('omzet_date', date("0002-01-01"))->countAllResults();
                    $transaksi_tanggal = date($fields['tanggal']);
                    $omzet_already_exists = $this->OmzetHarianModel->select()->where('omzet_date', $transaksi_tanggal)->countAllResults();

                    // utk nambah omzet
                    if ($omzet_already_exists > 0) {
                        $omzet_nominal_old = $this->OmzetHarianModel->select("omzet_nominal")->where("omzet_date", $transaksi_tanggal)->first();
                        $tempB = $omzet_nominal_old["omzet_nominal"];
                        $new_omzet = $tempB + $fields['harga_final'];

                        $this->OmzetHarianModel->where("omzet_date", $transaksi_tanggal)->set("omzet_nominal", $new_omzet)->update();
                    } else {
                        // $response['tempA'] = "Ini masuk else";
                        $new_omzet['omzet_date'] = $fields['tanggal'];
                        $new_omzet['omzet_nominal'] = $fields['harga_final'];
                        $this->OmzetHarianModel->insert($new_omzet);
                    }

                    $row = [];
                    foreach ($carts as $cart) {
                        array_push($row, array(
                            'transaksi_id' => $transaksi_id,
                            'bstock_id' => $cart->bstock_id,
                            'harga' => $cart->harga,
                            'diskon' => $cart->diskon,
                            'qty' => $cart->qty,
                            'total' => ($cart->harga - $cart->diskon) * $cart->qty
                        ));

                        // below is replicate of trigger "stok_min" (Pengurangan stok dari pembelian)
                        $temp_variable_1 = $this->stokBarang->select("bstock_ready_stock")->where("bstock_id", $cart->bstock_id)->first();
                        $old_stock_qty = $temp_variable_1["bstock_ready_stock"];
                        $subtracted_stock_qty = $old_stock_qty - $cart->qty;
                        $this->stokBarang->where('bstock_id', $cart->bstock_id)->set('bstock_ready_stock', $subtracted_stock_qty)->update();
                        // end trigger
                    }

                    if ($this->penjualanDetail->insertBatch($row)) {
                        $this->cart->where('user_id', $user_id)->delete();
                        $response['success'] = true;
                        $response['transaksi_id'] = $transaksi_id;
                    } else {
                        $response['success'] = false;
                    }

                    // dibawah ini kode utk mendaftarkann data ke tabel hutang pelanggan
                    if ($this->HutangPelangganModel->insert($fields_hutang_baru)) {
                        $response['success'] = true;
                    } else {
                        $response['success'] = false;
                    }
                } else {
                    $response['success'] = false;
                }
            }
            return $this->response->setJSON($response);
        } else {
            if ($this->penjualan->insert($fields)) {
                $transaksi_id = $this->penjualan->insertID();
                $carts = $this->cart->where('user_id', $user_id)->findAll();

                // kode dibawah buat nge cek ada gak data yang dicari. kalau gaada jumlahnya = 0
                // $tempA = $this->OmzetHarianModel->select()->where('omzet_date', date("0002-01-01"))->countAllResults();
                $transaksi_tanggal = date($fields['tanggal']);
                $omzet_already_exists = $this->OmzetHarianModel->select()->where('omzet_date', $transaksi_tanggal)->countAllResults();
                // $response['tempA'] = "Ini masuk if";
                // $response['tempB'] = $tempA;

                // utk nambah omzet
                if ($omzet_already_exists > 0) {
                    // ini adalah kalau omzet di tgl tsb udah ada. Hanya menambah nominal omzet yang sudah ada pada tgl tersebut. tidak ada aksi tambah row omzet baru
                    // $response['tempA'] = "Ini masuk if";
                    // $response['tempB'] = $tempA;

                    // $tempB["omzet_nominal"] += 
                    // $this->OmzetHarianModel->where("omzet_date", $fields['tanggal'])->set("omzet_nominal", ("omzet_nominal" + $fields['harga_final']), false);

                    // dibawah ini SQL nya works, dicek langsung pake query di mysql
                    // SELECT omzet_id, omzet_nominal FROM `omzet_harian` WHERE omzet_date = date('2003-01-01')

                    // $query = $this->OmzetHarianModel->getWhere(['omzet_date' => $fields['tanggal']]);

                    // $k = date('2003-01-01');
                    // $k = date('Y-m-d', strtotime('2003-01-01'));
                    // $k = '2003-01-01';
                    // $k = '2022-12-03';
                    // $k = '2023-05-05';
                    // $omzet_nominal = $this->OmzetHarianModel->select("omzet_nominal")->where("omzet_date", $k)->find();
                    // $omzet_nominal = $this->OmzetHarianModel->select("omzet_nominal")->where("omzet_id", 23)->find();
                    // $p = [23, 8, 2];
                    // $omzet_nominal = $this->OmzetHarianModel->select("omzet_nominal")->whereIn("omzet_id", $p)->find();
                    // $mencari = $omzet_nominal->omzet_nominal;

                    // alhamdulillah dibawah ini works mengambil nominalnya saja!!
                    // $omzet_nominal_old = $this->OmzetHarianModel->select("omzet_nominal")->where("omzet_date", $k)->first();

                    $omzet_nominal_old = $this->OmzetHarianModel->select("omzet_nominal")->where("omzet_date", $transaksi_tanggal)->first();
                    $tempB = $omzet_nominal_old["omzet_nominal"];
                    $new_omzet = $tempB + $fields['harga_final'];
                    // $new_omzet['omzet_nominal'] = $tempB + $fields['harga_final'];
                    // $response['tempA'] = ("Ini masuk if: " + "$omzet_nominal");
                    // $response['tempA'] = $tempC;
                    // $response['tempA'] = $fields['tanggal'];
                    // $response['tempA'] = $omzet_nominal_old;
                    // $response['tempA'] = $mencari;
                    $this->OmzetHarianModel->where("omzet_date", $transaksi_tanggal)->set("omzet_nominal", $new_omzet)->update();
                    //tambah omzet already exists: AMAN
                } else {
                    // $response['tempA'] = "Ini masuk else";
                    $new_omzet['omzet_date'] = $fields['tanggal'];
                    $new_omzet['omzet_nominal'] = $fields['harga_final'];
                    $this->OmzetHarianModel->insert($new_omzet);
                    //tambah omzet new: AMAN
                }

                $row = [];
                foreach ($carts as $cart) {
                    array_push($row, array(
                        'transaksi_id' => $transaksi_id,
                        'bstock_id' => $cart->bstock_id,
                        'harga' => $cart->harga,
                        'diskon' => $cart->diskon,
                        'qty' => $cart->qty,
                        'total' => ($cart->harga - $cart->diskon) * $cart->qty
                    ));

                    // below is replicate of trigger "stok_min" (Pengurangan stok dari pembelian)
                    $temp_variable_1 = $this->stokBarang->select("bstock_ready_stock")->where("bstock_id", $cart->bstock_id)->first();
                    $old_stock_qty = $temp_variable_1["bstock_ready_stock"];
                    $subtracted_stock_qty = $old_stock_qty - $cart->qty;
                    $this->stokBarang->where('bstock_id', $cart->bstock_id)->set('bstock_ready_stock', $subtracted_stock_qty)->update();
                    // end trigger
                }

                if ($this->penjualanDetail->insertBatch($row)) {
                    $this->cart->where('user_id', $user_id)->delete();
                    $response['success'] = true;
                    $response['transaksi_id'] = $transaksi_id;
                } else {
                    $response['success'] = false;
                }
            } else {
                $response['success'] = false;
            }
            return $this->response->setJSON($response);
        }
    }

    public function cetak($id)
    {

        // $id = $this->request->getPostGet('id');
        $penjualan = $this->penjualan->select('tbl_transaksi.*,u.user_username')->join('user u', 'tbl_transaksi.user_id = u.user_id')->where('transaksi_id', $id)->first();

        $transaksi_detail = $this->penjualanDetail->select('*')->join('barang_stock sb', 'tbl_transaksi_detail.bstock_id = sb.bstock_id')->where('transaksi_id', $id)->findAll();



        $data = array(
            'penjualan' =>  $penjualan,
            'transaksi_detail' => $transaksi_detail,
        );
        return view('transaksi/receipt_print', $data);
    }

    public function cetak_no_print($id)
    {

        // $id = $this->request->getPostGet('id');
        $penjualan = $this->penjualan->select('tbl_transaksi.*,u.user_username')->join('user u', 'tbl_transaksi.user_id = u.user_id')->where('transaksi_id', $id)->first();

        $transaksi_detail = $this->penjualanDetail->select('*')->join('barang_stock sb', 'tbl_transaksi_detail.bstock_id = sb.bstock_id')->where('transaksi_id', $id)->findAll();



        $data = array(
            'penjualan' =>  $penjualan,
            'transaksi_detail' => $transaksi_detail,
        );
        return view('transaksi/receipt_no_print', $data);
    }
}
