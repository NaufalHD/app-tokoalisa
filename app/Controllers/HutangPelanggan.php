<?php

namespace App\Controllers;

use App\Models\HutangPelangganModel;
use App\Models\PelangganModel;
use App\Models\TblpenjualanModel;

class HutangPelanggan extends BaseController
{
    protected $HutangPelangganModel;
    protected $PelangganModel;
    protected $TblpenjualanModel;

    public function __construct()
    {
        $this->HutangPelangganModel = new \App\Models\HutangPelangganModel();
        $this->PelangganModel = new \App\Models\PelangganModel();
        $this->TblpenjualanModel = new \App\Models\TblpenjualanModel();
    }


    public function index()
    {
        if (session()->has('logged_in')) {
            $data = [
                'title' => 'Hutang Pelanggan',
                // 'data_row' => $this->PelangganModel->get()->getResult(),
                'pelanggan' => $this->PelangganModel->get()->getResult(),

            ];

            return view('hutang_pelanggan/index', $data);
        } else {
            session()->setFlashdata('error', 'Harap login terlebih dahulu');
            return redirect()->to('login');
        }
    }

    public function index_old()
    {
        // d($this->request->getVar('keyword'));
        // getVar ini bisa ngambil GET bisa ngambil POST

        $keyword = $this->request->getVar('keyword');
        $input_date_begin = $this->request->getVar('input-date-begin');
        $input_date_end = $this->request->getVar('input-date-end');

        // $keyword = $this->request->getGet('keyword');
        if ($keyword) {
            // d("masuk if ");
            $pencarian = $this->HutangPelangganModel->fiturCari($keyword);
            // dd("masuk sini");
        } else if ($input_date_begin && $input_date_end) {
            $pencarian = $this->HutangPelangganModel->fiturCariWaktu($input_date_begin, $input_date_end);
        } else {
            $pencarian = $this->HutangPelangganModel->getHutang();
            // d("masuk else ");
        }

        $data = [
            'title' => 'Hutang Pelanggan',
            // 'komik' => $komik

            // dibawah ini untuk menampilkan tanpa pagination, manggil method findall di controller
            // komikmodel yang udah dibuat
            // methond findAll() itu ternyata sudah ada sendiri milik dari class Model, sehingga
            // gaperlu dibuat lagi di controller. tinggal pake
            // 'komik' => $this->komikModel->getKomik()

            // paginate() juga adalah method yang udah ada milik dari class model, sama kek findAll();
            // pager juga udah ada
            // dibawha ini untuk menampilkan dengan pagination dan pager yang ada di paling bawah untuk
            // ganti2 halaman

            // 'komik' => $this->komikModel->paginate(3), jumlah item per halaman adalah 3
            // 'komik' => $this->komikModel->paginate(3, asd), asd adalah nama tabelnya 

            // 'komik' => $this->komikModel->getKomik(),
            // dd($pencarian),
            'data_row' => $pencarian,
            // dd("masuk sini");

            // 'komik' => $this->komikModel->paginate(3, 'komik'),
            // 'pager' => $this->komikModel->pager
        ];

        // ---dibawah ini adalah connect ke tabel db tapi tanpa model
        // $db = \Config\Database::connect();
        // $komik = $db->query("SELECT * FROM komik");
        // foreach ($komik->getResultArray() as $row) {
        //     d($row);
        // }

        // ---dibawah ini adalah instansiasi kelas model, tapi gak dipake
        // $komikModel = new \App\Models\KomikModel();

        // $komikModel = new KomikModel();
        d($pencarian);

        return view('hutang_pelanggan/index', $data);
    }

    public function b()
    {
        // dd("sokses");
        $pelangganHutang = $this->PelangganModel->select("pelanggan_nama")->where("pelanggan_id", 48)->first();
        // $response['tempA'] = $pelangganHutang;
        // $response['tempA'] = $pelangganHutang->pelanggan_nama;
        $response['tempA'] = $pelangganHutang['pelanggan_nama'];
        $response['success'] = false;

        return $this->response->setJSON($response);
    }

    public function getDataHutangPelanggan()
    {
        $response = $data['data'] = array();

        //mendapatkan data pelanggan di table pelanggan model
        //inisialisasi data tabel , mengambil data dari tabel pelanggan
        $pelanggan = $this->PelangganModel->select()->get()->getResult();
        // $result = $this->HutangPelangganModel->select()->orderBy('created_at', 'DESC')->get()->getResult();
        $result = $this->HutangPelangganModel->select()->orderBy('created_at', 'ASC')->get()->getResult();
        $no = 1;
        foreach ($result as $key => $value) {

            // $pelangganHutang = $this->PelangganModel->select("pelanggan_nama")->where("pelanggan_id", 48)->first();
            // $response['tempA'] = $pelangganHutang['pelanggan_nama'];

            $hutang_idpelanggan = $value->hutang_idpelanggan;
            $pelanggan_hutang = $this->PelangganModel->select("pelanggan_nama")->where("pelanggan_id", $hutang_idpelanggan)->first();

            // $nama_pelanggan_hutang = $pelanggan_hutang['pelanggan_nama'];

            // inisialisai aksi ubah data
            $ops =
                '<button 
                    id="update_hutang_pelanggan" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modal-edit-hutang-pelanggan"

                    data-hutang_id= "' . $value->hutang_id . '"
                    data-hutang_id_edit= "' . $value->hutang_id . '"
                    data-hutang_date_edit= "' . $value->hutang_date . '"
                    data-hutang_nominal_edit= "' . $value->hutang_nominal . '"
                    data-hutang_catatan_edit= "' . $value->hutang_catatan . '"
                    data-hutang_nama_pelanggan_edit= "' . $pelanggan_hutang['pelanggan_nama'] . '"
                    data-hutang_idpelanggan_edit= "' . $value->hutang_idpelanggan . '"
                    data-hutang_transaksi_id_edit= "' . $value->hutang_transaksi_id . '"
                    
                    class="btn btn-xs btn-primary">
                        <i class="fas fa-pencil-alt"></i> Ubah
                </button>';

            $ops .=
                '<button 
                    id="hapus_hutang_pelanggan"

                    data-hutang_id= "' . $value->hutang_id . '"
                    
                    class="btn btn-xs btn-danger">
                    <i class="fas fa-trash"></i> Hapus
                </button>';

            $data['data'][$key] = array(
                // $no++,
                $value->hutang_id,
                $value->hutang_date,
                $value->hutang_transaksi_id,
                $value->hutang_nominal,

                $value->hutang_islunas,

                $value->hutang_idpelanggan,
                $pelanggan_hutang['pelanggan_nama'],
                $value->hutang_catatan,

                $ops // buat kolom aksi
            );
        }

        return $this->response->setJSON($data);
    }

    public function create()
    {
        // session();
        $data = [
            'title' => 'Tambah Hutang Pelanggan',
            'validation' => \config\Services::validation()
        ];
        return view('hutang_pelanggan/create', $data);
    }

    // ini kalau misal mau dipake aja sih, jadi bisa bikin hutang tanpa transaksi
    public function save()
    {
        $response = array();

        $fields['hutang_date'] = $this->request->getPost('hutang_date');
        $fields['hutang_nominal'] = $this->request->getPost('hutang_nominal');
        $fields['hutang_catatan'] = $this->request->getPost('hutang_catatan');
        $fields['hutang_islunas'] = $this->request->getPost('hutang_islunas');
        $fields['hutang_idpelanggan'] = $this->request->getPost('hutang_idpelanggan');
        $fields['hutang_transaksi_id'] = $this->request->getPost('hutang_transaksi_id');

        if ($this->HutangPelangganModel->insert($fields)) {
            // dd("sokses");
            $response['success'] = true;
            // session()->setFlashdata('pesan', 'Data Pelanggan Baru Berhasil Ditambahkan');
        } else {
            $response['success'] = false;
        }

        return $this->response->setJSON($response);
    }

    public function save_old()
    {
        // dd($this->request->getVar('user_isowner'));
        // dd($this->request->getVar());

        // dd($this->request->getVar('judul'));
        // bisa mengambil request apapun entah itu POST atau GET
        // getPost() apabila ingin mengambil POST, dst

        // validasi input

        if (!$this->validate(
            [
                // 'judul' => 'required|is_unique[komik.judul]'
                'input_hutang_date' =>
                [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ],
                'hutang_nama' =>
                [
                    'rules' => 'required|max_length[255]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'max_length' => '{field} maksimal 255 karakter',
                    ]
                ],
                'hutang_alamat' =>
                [
                    'rules' => 'required|max_length[255]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'max_length' => '{field} maksimal 255 karakter',
                    ]
                ],
                'hutang_nominal' =>
                [
                    'rules' => 'required|max_length[20]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'max_length' => '{field} maksimal 20 karakter',
                    ]
                ],

            ]
        )) {
            $validation = \config\Services::validation();
            // dd($validation);
            // return redirect()->to('/komik/create');

            return redirect()->to('hutang_pelanggan/create')->withInput()->with('validation', $validation);

            // diatas ini, input dari withInput() akan kesimpan di session, maka session 
            // harus dinyalakan biar berfungsi
        };

        $this->HutangPelangganModel->save([
            'hutang_date' => $this->request->getVar('input_hutang_date'),
            'hutang_nominal' => (($this->request->getVar('hutang_nominal')) * 1000),
            'hutang_nama' => $this->request->getVar('hutang_nama'),
            'hutang_alamat' => $this->request->getVar('hutang_alamat'),
            'hutang_telp' => $this->request->getVar('hutang_telp'),
            'hutang_catatan' => $this->request->getVar('hutang_catatan'),
            'hutang_islunas' => $this->request->getVar('hutang_islunas'),
        ]);


        // dibawah ini untuk menggunakan flashdata, yaitu sebuah data yang hanya muncul sekali aja. 
        // jadi klo halaman di refresh, hilang data nya. pake session

        session()->setFlashdata('pesan', 'Hutang Pelanggan Berhasil Ditambahkan');
        return redirect()->to('hutang_pelanggan');
    }

    public function delete()
    {
        $response = array();

        $hutang_id = $this->request->getPost('hutang_id');

        if ($this->HutangPelangganModel->where('hutang_id', $hutang_id)->delete()) {
            // session()->setFlashdata('pesan', 'Data Pelanggan Berhasil Dihapus');
            // return redirect()->to('pelanggan');
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }

        return $this->response->setJSON($response);
    }

    public function delete_old($hutang_id)
    {
        // method delete ini udah bawaan dari model kalo pake CI, sama seperti save
        // dd($slug);

        // public function delete($slug)
        // $this->komikModel->where('slug', $slug)->delete();
        // cara diatas ini bisa  dipake kalau misal nyari data yg mau dihapus itu gapake primary key
        // (disini dia pake kolom slug buat nyari datanya)


        // $this->UserModel->delete($id);
        // $this->UserModel->delete(['user_id' => $id]);
        $this->HutangPelangganModel->where('hutang_id', $hutang_id)->delete();
        // cara diatas ini HANYA bisa dipake kalo pencarian data yang mau dihapus menggunakan primary key
        // kalo misal menggunakan $this->komikModel->delete($slug); gaakan bisa, udah tak coba sendiri.
        // sumber nya ada di dokumentasi codeigniter

        session()->setFlashdata('pesan', 'Hutang Pelanggan Berhasil Dihapus');
        return redirect()->to('hutang_pelanggan');
    }

    // dibawah ini semua proses langsung di function edit. Kalau versiku dimulai dri funciton edit dulu, baru dilanjut ke function update buat update database nya
    public function edit()
    {
        $response = array();

        $fields['hutang_id'] = $this->request->getPost('hutang_id');
        // $fields['hutang_date'] = $this->request->getPost('hutang_date');
        $fields['hutang_nominal'] = $this->request->getPost('hutang_nominal');
        $fields['hutang_catatan'] = $this->request->getPost('hutang_catatan');
        // $fields['hutang_islunas'] = $this->request->getPost('hutang_islunas');
        $fields['hutang_date'] = $this->request->getPost('hutang_date');
        // $fields['hutang_nominal'] = 0;

        // update data is_hutang di tabel transaksi
        if ($fields['hutang_nominal'] == 0) {
            $transaksi_id = $this->request->getPost('hutang_transaksi_id');

            // value == 1, berarti lunas
            $fields['hutang_islunas'] = 1;
            // $k = $fields['hutang_id'];
            // $this->HutangPelangganModel->where('hutang_id', $k)->set('hutang_catatan', 'LUNAS')->update();
            $this->TblpenjualanModel->where('transaksi_id', $transaksi_id)->set('is_hutang', 2)->update();
        }

        // $pelangganHutang = $this->PelangganModel->select("pelanggan_nama")->where("pelanggan_id", 48)->first();
        // $response['tempA'] = $pelangganHutang['pelanggan_nama'];

        if ($this->HutangPelangganModel->update($fields['hutang_id'], $fields)) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }

        return $this->response->setJSON($response);
    }

    public function edit_old($hutang_id)
    {
        // SESSION DIBAWAH INI HARUS NYALA UNTUK MENGAMBIL VALIDATION  DAN DATAUSERDIEDIT!!!!
        // HABIS 4 JAM CUMA KARENA BINGUNG SESSION DIBAWAH INI MATI, jadinya gabisa akses datauserdiedit
        // FAKKK

        // BASE CONTROLLER DIMASUKKIN DI BASE CONTROLLER BIAR JALAN DARI AWALLL!!!!!!

        // session();
        $data = [
            'title' => 'Edit Hutang Pelanggan',
            'validation' => \config\Services::validation(),
            'dataHutangPelangganDiedit' => $this->HutangPelangganModel->getHutang($hutang_id)
        ];
        return view('hutang_pelanggan/edit', $data);
    }

    // public function update()

    // dibawah ini bisa
    // harusnya gapake parameter $id itu bisa kok, tapi masalahnya kan nanti 
    // semua value2 kalo diedit bakal berubah
    public function update($hutang_id)
    {
        // session();
        // cek judul
        // $usernameLama = $this->UserModel->getUser($this->request->getVar('username'));

        // dd($this->request->getVar('slug'));
        // dd($this->request->getVar('username'));
        // dd($usernameLama);
        // dd($usernameLama['user_name']);


        // ini diambil dari method save

        // validasi input
        if (!$this->validate(
            [
                // 'judul' => 'required|is_unique[komik.judul]'
                'input_hutang_date' =>
                [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                    ]
                ],
                'hutang_nama' =>
                [
                    'rules' => 'required|max_length[255]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'max_length' => '{field} maksimal 255 karakter',
                    ]
                ],
                'hutang_alamat' =>
                [
                    'rules' => 'required|max_length[255]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'max_length' => '{field} maksimal 255 karakter',
                    ]
                ],
                'hutang_nominal' =>
                [
                    'rules' => 'required|max_length[20]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'max_length' => '{field} maksimal 20 karakter',
                    ]
                ],

            ]
        )) {
            $validation = \config\Services::validation();
            // dd($validation);
            // dd($rule_username);
            // dd("apakah masuk sini?");
            // return redirect()->to('/admin/edit/' . $this->request->getVar('username'))->withInput()->with('validation', $validation);
            return redirect()->to('/hutang_pelanggan/edit/' . $hutang_id)->withInput()->with('validation', $validation);


            // return redirect()->to('/admin/edit/')->withInput()->with('validation', $validation);
        };



        // dibawah ini bisa
        // $slug = url_title($this->request->getVar('judul'), '-', true);

        $dataUpdate = [
            'hutang_date' => $this->request->getVar('input_hutang_date'),
            'hutang_nominal' => (($this->request->getVar('hutang_nominal')) * 1000),
            'hutang_nama' => $this->request->getVar('hutang_nama'),
            'hutang_alamat' => $this->request->getVar('hutang_alamat'),
            'hutang_telp' => $this->request->getVar('hutang_telp'),
            'hutang_catatan' => $this->request->getVar('hutang_catatan'),
            'hutang_islunas' => $this->request->getVar('hutang_islunas'),
        ];

        // $this->komikModel->whereIn('slug', $slug)->set($dataUpdate)->update();
        // $this->komikModel->whereIn('id', [$id])->set($dataUpdate)->update();
        // $this->komikModel->whereIn('slug', [$slug])->set($dataUpdate)->update();
        // $this->komikModel->whereIn('id', [$beta])->set($dataUpdate)->update();

        // dibawah ini bisa, ini nyari sendiri gak ngikutin dari video hehe
        $this->HutangPelangganModel->whereIn('hutang_id', [$hutang_id])->set($dataUpdate)->update();




        session()->setFlashdata('pesan', 'Data Hutang Pelanggan Berhasil diubah');

        return redirect()->to('hutang_pelanggan/');
    }

    public function bayar_hutang_total()
    {
        $response = array();

        $pelanggan_id = $this->request->getPostGet('pelanggan_id');
        $this->HutangPelangganModel->where(['hutang_idpelanggan' => $pelanggan_id, 'hutang_islunas' => 0])->set(['hutang_islunas' => 1, 'hutang_nominal' => 0])->update();
        $this->TblpenjualanModel->where('nm_kostumer_id', $pelanggan_id)->set('is_hutang', 2)->update();

        $response['success'] = true;


        return $this->response->setJSON($response);
    }

    public function sum_nominal_hutang_total_bayar()
    {
        $response = array();

        $pelanggan_id = $this->request->getPostGet('pelanggan_id');

        $temp_variable_1 = $this->HutangPelangganModel->select('hutang_nominal')->where(['hutang_idpelanggan' => $pelanggan_id, 'hutang_islunas' => 0])->findAll();
        $sum_total = 0;
        foreach ($temp_variable_1 as $data) {
            $sum_total += $data['hutang_nominal'];
        }

        $response['success'] = true;
        $response['data'] = $sum_total;
        // $response['data'] = 77;
        // $response['data'] = $temp_variable_1[0]['hutang_nominal'];

        return $this->response->setJSON($response);
    }

    // public function pencarian()
    // {
    //     // dd($this->komikModel->whereIn('judul', [$keyword])->findAll());
    //     // dd($this->request->getVar('keyword'));

    //     $keyword = $this->request->getVar('keyword');

    //     // code bawah ini bisa, jika keyword yang dimasukkan adalah SLUG yang ADA didalam tabel tsb
    //     // karena kode ini akan manggil method detail dengan inputan dari $keyword sebagai $slug sesuai pada 
    //     // method detail($slug)
    //     // return $this->detail($keyword);

    //     // dibawah ini bisa, menghasilkan array 1 row sesuai pencarian. mahookkk
    //     // wherein ini mencari yang tulisannya sesuai. 
    //     // data "diskotik bersama" dicari "diskotik" = ga ketemu 
    //     // data "diskotik bersama" dicari "diskotik bersama" = ketemu 
    //     // data "diskotik bersama" dicari "DISKOTIK BeRSama" = ketemu 
    //     // return $this->komikModel->whereIn('judul', [$keyword])->findAll();

    //     // dibawah ini bisa
    //     // $bersama = url_title($this->request->getVar('keyword'), '-', true);
    //     // return $this->detail($bersama);
    //     // dd($this->komikModel->whereIn('judul', [$keyword])->findAll());


    //     // kalo pake query builder, HRUS DIKASIH TAU dulu tabel nya apa (dari vid galih sandhika)
    //     // builder ini ada di model

    //     dd($this->komikModel->fiturCari($keyword));
    //     // dd($this->komikModel->like('judul', $keyword));
    //     // $builder = $this->komikModel->table('komik')->like('judul', $keyword);
    //     // dd($builder);
    //     // return $this->komikModel->like('judul', $keyword);
    //     // return $this->detail();
    // }
}
