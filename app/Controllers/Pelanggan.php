<?php

namespace App\Controllers;

use App\Models\PelangganModel;
use App\Models\OmzetHarianModel;

class Pelanggan extends BaseController
{
    protected $PelangganModel;
    protected $OmzetHarianModel;
    protected $validation;

    public function __construct()
    {
        $this->PelangganModel = new PelangganModel();
        $this->OmzetHarianModel = new OmzetHarianModel();
        $this->validation = \config\Services::validation();
        // $this->pelm = new PelangganModel();
    }


    // public function ceko()
    // {
    //     echo "PHP is BRO";
    // }

    public function index()
    {
        if (session()->has('logged_in')) {
            $data = [
                'title' => 'Pelanggan',
                // 'data_row' => $this->PelangganModel->get()->getResult(),]
            ];
            return view('pelanggan/index', $data);
        } else {
            session()->setFlashdata('error', 'Harap login terlebih dahulu');
            return redirect()->to('login');
        }

        // $this->ceko();

        // d($data['data_row']);
        // echo "PHP is fun";

        // if ($this->OmzetHarianModel->select()->where('omzet_id', 2)) {

        // if (1 == 1) {
        //     // if ($this->OmzetHarianModel->select()->where('omzet_id', 8)) {
        //     //     echo "omzet_id: 8 , is exists";

        //     //     // $new_omzet['omzet_date'] = '2003 - 01 - 01';
        //     //     // $new_omzet['omzet_date'] = 01 - 01 - 2005;

        //     //     // dibawah ini works
        //     //     $new_omzet['omzet_date'] = date("0202-01-01");
        //     //     $new_omzet['omzet_nominal'] = 0;

        //     //     // save functions is can be both INSERT and UPDATE. it will smartly determine 
        //     //     // whether its going to be an INSERT or an UPDATE, based on whether it finds an array key matching the primary key value. (Codeigniter documentation: using Codeigniter's model)
        //     //     $this->OmzetHarianModel->save($new_omzet);
        //     // } else {
        //     //     $new_omzet['omzet_id'] = 6;
        //     //     $new_omzet['omzet_date'] = date("1099-01-01");
        //     //     // $new_omzet['omzet_date'] = 1099 - 01 - 01;
        //     //     $new_omzet['omzet_nominal'] = 0;
        //     //     $this->OmzetHarianModel->save($new_omzet);
        //     // }

        // }

    }

    //buat function untuk ditampilkan ke dalam tabel
    public function getDataPelanggan()
    {
        $response = $data['data'] = array();

        //mendapatkan data pelanggan di table pelanggan model
        //inisialisasi data tabel , mengambil data dari tabel pelanggan
        $result = $this->PelangganModel->select()->get()->getResult();
        $no = 1;
        foreach ($result as $key => $value) {

            // inisialisai aksi ubah data
            $ops =
                '<button 
                    id="update_pelanggan" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modal-edit-pelanggan"

                    data-pelanggan_id= "' . $value->pelanggan_id . '"

                    data-pelanggan_nama_old= "' . $value->pelanggan_nama . '"
                    data-pelanggan_telp_old= "' . $value->pelanggan_telp . '"
                    data-pelanggan_alamat_old= "' . $value->pelanggan_alamat . '"
                    data-pelanggan_catatan_old= "' . $value->pelanggan_catatan . '"
                    
                    class="btn btn-xs btn-primary">
                        <i class="fas fa-pencil-alt"></i> Ubah
                </button>';

            $ops .=
                '<button 
                    id="hapus_pelanggan"

                    data-pelanggan_id="' . $value->pelanggan_id . '" 
                    
                    class="btn btn-xs btn-danger">
                    <i class="fas fa-trash"></i> Hapus
                </button>';

            $data['data'][$key] = array(
                $no++, //ini buat kol id
                $value->pelanggan_id, //buat pelanggan id
                $value->pelanggan_nama, //buat kolom nama
                $value->pelanggan_telp, // buat kolom telp
                $value->pelanggan_alamat, // buat kolom alamat
                $value->pelanggan_catatan, // buat catatan
                // $value->diskon,
                // '<div id="total">' . $value->total . '</div>',
                // $value->user_id,

                $ops // buat kolom aksi
            );
        }

        return $this->response->setJSON($data);
    }

    public function getForInputGroup_Pelanggan()
    {
        $result = $this->PelangganModel->select()->get()->getResult();

        return $result;
    }

    public function save()
    {
        // // session();
        // $data = [
        //     'title' => 'Tambah Pelanggan Baru',
        //     'validation' => \config\Services::validation()
        // ];
        // return view('pelanggan/create', $data);


        $response = array();

        $fields['pelanggan_nama'] = $this->request->getPost('pelanggan_nama');
        $fields['pelanggan_telp'] = $this->request->getPost('pelanggan_telp');
        $fields['pelanggan_alamat'] = $this->request->getPost('pelanggan_alamat');
        $fields['pelanggan_catatan'] = $this->request->getPost('pelanggan_catatan');

        $this->validation->setRules([
            'pelanggan_nama' =>
            [
                'rules' => 'required|is_unique[pelanggan.pelanggan_nama]|max_length[255]',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'is_unique' => 'Nama sudah terdaftar',
                    'max_length' => 'Nama maksimal 255 karakter',
                ]
            ],
            'pelanggan_alamat' =>
            [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Alamat harus diisi',
                    'max_length' => 'Alamat maksimal 255 karakter',
                ]
            ],
            'pelanggan_telp' =>
            [
                'rules' => 'max_length[15]',
                'errors' => [
                    'max_length' => 'Nomor telp maksimal 15 karakter',
                ]
            ],
            'pelanggan_catatan' =>
            [
                'rules' => 'max_length[255]',
                'errors' => [
                    'max_length' => 'Catatan maksimal 255 karakter',
                ]
            ],
        ]);

        if ($this->validation->run($fields) == false) {
            $response['success'] = false;
            $response['messages'] = $this->validation->getErrors();
        } else {
            if ($this->PelangganModel->insert($fields)) {
                // dd("sokses");
                $response['success'] = true;
                $response['messages'] = lang("App.insert-success");
            } else {
                $response['success'] = false;
                $response['messages'] = lang("App.insert-error");
            }
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
                'input_omzet_date' =>
                [
                    'rules' => 'required|is_unique[omzet_harian.omzet_date]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'is_unique' => '{field} sudah terdaftar',
                    ]
                ],
                'omzet_catatan' =>
                [
                    'rules' => 'max_length[255]',
                    'errors' => [
                        'max_length' => '{field} maksimal 255 karakter',
                    ]
                ],
                'omzet_nominal' =>
                [
                    'rules' => 'required|max_length[20]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'max_length' => '{field} maksimal 20 karakter',
                    ]
                ],

            ]
        )) {
            $validation = \config\Services::validation();
            // dd($validation);
            // return redirect()->to('/komik/create');

            return redirect()->to('omzet_harian/create')->withInput()->with('validation', $validation);

            // diatas ini, input dari withInput() akan kesimpan di session, maka session 
            // harus dinyalakan biar berfungsi
        };
        $this->PelangganModel->save([
            'pelanggan_nama' => $this->request->getVar('input_omzet_date'),
            'omzet_nominal' => (($this->request->getVar('omzet_nominal')) * 1000),
            'omzet_catatan' => $this->request->getVar('omzet_catatan'),
        ]);


        // dibawah ini untuk menggunakan flashdata, yaitu sebuah data yang hanya muncul sekali aja. 
        // jadi klo halaman di refresh, hilang data nya. pake session

        session()->setFlashdata('pesan', 'Omzet Harian Berhasil Ditambahkan');
        return redirect()->to('omzet_harian');
    }

    public function delete()
    {
        // dd("del func");
        $response = array();

        $pelanggan_id = $this->request->getPost('pelanggan_id');
        // $this->PelangganModel->where('pelanggan_id', $pelanggan_id)->delete();
        // $temp = $this->PelangganModel->where('pelanggan_id', $pelanggan_id)->get;

        // session()->setFlashdata('pelanggan_nama', $temp('pelanggan_nama'));

        if ($this->PelangganModel->where('pelanggan_id', $pelanggan_id)->delete()) {
            // session()->setFlashdata('pesan', 'Data Pelanggan Berhasil Dihapus');
            // return redirect()->to('pelanggan');
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }

        return $this->response->setJSON($response);
    }

    public function delete_old($pelanggan_id)
    {
        // method delete ini udah bawaan dari model kalo pake CI, sama seperti save
        // dd($slug);

        // public function delete($slug)
        // $this->komikModel->where('slug', $slug)->delete();
        // cara diatas ini bisa  dipake kalau misal nyari data yg mau dihapus itu gapake primary key
        // (disini dia pake kolom slug buat nyari datanya)


        // $this->UserModel->delete($id);
        // $this->UserModel->delete(['user_id' => $id]);
        // $this->PelangganModel->where('pelanggan_id', $pelanggan_id)->delete();

        // cara diatas ini HANYA bisa dipake kalo pencarian data yang mau dihapus menggunakan primary key
        // kalo misal menggunakan $this->komikModel->delete($slug); gaakan bisa, udah tak coba sendiri.
        // sumber nya ada di dokumentasi codeigniter

        $this->PelangganModel->where('pelanggan_id', $pelanggan_id)->delete();
        session()->setFlashdata('pesan', 'Data Pelanggan Berhasil Dihapus');
        return redirect()->to('pelanggan');

        // if (confirm('Apakah anda yakin?')) 



        // $response = array();

        // if ($this->PelangganModel->where('pelanggan_id', $pelanggan_id)->delete()) {
        // dd("sokses");
        // $response['success'] = true;
        // } else {
        // $response['success'] = false;
        // }

        // return $this->response->setJSON($response);
    }

    // dibawah ini semua proses langsung di function edit. Kalau versiku dimulai dri funciton edit dulu, baru dilanjut ke function update buat update database nya
    public function edit()
    {
        $response = array();

        $fields['pelanggan_id'] = $this->request->getPost('pelanggan_id');
        $fields['pelanggan_nama'] = $this->request->getPost('pelanggan_nama');
        $fields['pelanggan_telp'] = $this->request->getPost('pelanggan_telp');
        $fields['pelanggan_alamat'] = $this->request->getPost('pelanggan_alamat');
        $fields['pelanggan_catatan'] = $this->request->getPost('pelanggan_catatan');

        // $dataUpdate = [
        //     'pelanggan_nama' =>  $this->request->getPost('pelanggan_nama'),
        //     'pelanggan_telp' =>  $this->request->getPost('pelanggan_telp'),
        //     'pelanggan_alamat' =>  $this->request->getPost('pelanggan_nama'),
        //     'pelanggan_catatan' =>  $this->request->getPost('pelanggan_catatan'),
        // ];

        // $dataUpdate = [
        //     'pelanggan_nama' =>  $fields['pelanggan_nama'],
        //     'pelanggan_telp' =>  $fields['pelanggan_telp'],
        //     'pelanggan_alamat' =>  $fields['pelanggan_alamat'],
        //     'pelanggan_catatan' =>  $fields['pelanggan_catatan'],
        // ];
        $temp = $this->request->getPost('pelanggan_id');
        $namaLama = $this->PelangganModel->where('pelanggan_id', $temp)->first();
        // $response['tempA'] = $usernameLama['user_username'];
        // $response['tempB'] = $fields['user_username'];
        // $response['tempC'] = $temp;


        if ($namaLama['pelanggan_nama'] == $fields['pelanggan_nama']) {
            $rule_nama = 'required';
        } else {
            // $rule_username = 'required';
            $rule_nama = 'required|is_unique[pelanggan.pelanggan_nama]|max_length[255]';
        }

        $this->validation->setRules([
            'pelanggan_nama' =>
            [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'is_unique' => 'Nama sudah terdaftar',
                    'max_length' => 'Nama maksimal 255 karakter',
                ]
            ],
            'pelanggan_telp' =>
            [
                'rules' => 'max_length[15]',
                'errors' => [
                    'max_length' => 'Nomor telp maksimal 15 karakter',
                ]
            ],
            'pelanggan_alamat' =>
            [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Alamat harus diisi',
                    'max_length' => 'Alamat maksimal 255 karakter',
                ]
            ],
            'pelanggan_catatan' =>
            [
                'rules' => 'max_length[255]',
                'errors' => [
                    'max_length' => 'Catatan maksimal 255 karakter',
                ]
            ],

        ]);


        if ($this->validation->run($fields) == false) {
            $response['success'] = false;
            $response['messages'] = $this->validation->getErrors();
        } else {
            if ($this->PelangganModel->update($fields['pelanggan_id'], $fields)) {
                // if ($this->PelangganModel->set($dataUpdate)->where('pelanggan_id', $fields['pelanggan_id'])->update()) {
                $response['messages'] = lang("App.insert-success");
            } else {
                $response['success'] = false;
                $response['messages'] = lang("App.insert-error");
            }
        }

        return $this->response->setJSON($response);
    }

    public function edit_old($omzet_id)
    {
        // SESSION DIBAWAH INI HARUS NYALA UNTUK MENGAMBIL VALIDATION  DAN DATAUSERDIEDIT!!!!
        // HABIS 4 JAM CUMA KARENA BINGUNG SESSION DIBAWAH INI MATI, jadinya gabisa akses datauserdiedit
        // FAKKK

        // BASE CONTROLLER DIMASUKKIN DI BASE CONTROLLER BIAR JALAN DARI AWALLL!!!!!!

        // session();
        $data = [
            'title' => 'Edit Omzet Harian',
            'validation' => \config\Services::validation(),
            'dataOmzetHarianDiedit' => $this->OmzetHarianModel->getOmzet($omzet_id)
        ];
        return view('omzet_harian/edit', $data);
    }

    // public function update()

    // dibawah ini bisa
    // harusnya gapake parameter $id itu bisa kok, tapi masalahnya kan nanti 
    // semua value2 kalo diedit bakal berubah
    public function update_old($omzet_id)
    {
        // session();
        // cek judul
        $omzetLama = $this->OmzetHarianModel->whereIn('omzet_id', [$omzet_id])->first();
        // $usernameLama = $this->UserModel->getUser($this->request->getVar('username'));

        // dd($this->request->getVar('slug'));
        // dd($this->request->getVar('username'));
        // dd($usernameLama);
        // dd($usernameLama['user_name']);
        if ($omzetLama['omzet_date'] == $this->request->getVar('input_omzet_date')) {
            // dd("masuk if");
            $rule_omzet_date = 'required';
        }
        // else if(strlen($this->request->getVar('username')) > 20){

        // } 
        else {
            // dd("masuk else");
            $rule_omzet_date = 'required|is_unique[omzet_harian.omzet_date]';
        }



        // ini diambil dari method save

        // validasi input
        if (!$this->validate(
            [
                // 'judul' => 'required|is_unique[komik.judul]'
                'input_omzet_date' =>
                [
                    'rules' => $rule_omzet_date,
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'is_unique' => '{field} sudah terdaftar',
                    ]
                ],
                'omzet_catatan' =>
                [
                    'rules' => 'max_length[255]',
                    'errors' => [
                        'max_length' => '{field} maksimal 255 karakter',
                    ]
                ],
                'omzet_nominal' =>
                [
                    'rules' => 'required|max_length[20]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
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
            return redirect()->to('/omzet_harian/edit/' . $omzet_id)->withInput()->with('validation', $validation);


            // return redirect()->to('/admin/edit/')->withInput()->with('validation', $validation);
        };



        // dibawah ini bisa
        // $slug = url_title($this->request->getVar('judul'), '-', true);

        $dataUpdate = [
            'omzet_date' => $this->request->getVar('input_omzet_date'),
            'omzet_nominal' => (($this->request->getVar('omzet_nominal')) * 1000),
            'omzet_catatan' => $this->request->getVar('omzet_catatan'),
        ];

        // $this->komikModel->whereIn('slug', $slug)->set($dataUpdate)->update();
        // $this->komikModel->whereIn('id', [$id])->set($dataUpdate)->update();
        // $this->komikModel->whereIn('slug', [$slug])->set($dataUpdate)->update();
        // $this->komikModel->whereIn('id', [$beta])->set($dataUpdate)->update();

        // dibawah ini bisa, ini nyari sendiri gak ngikutin dari video hehe
        $this->OmzetHarianModel->whereIn('omzet_id', [$omzet_id])->set($dataUpdate)->update();




        session()->setFlashdata('pesan', 'Data Omzet Berhasil diubah');

        return redirect()->to('omzet_harian/');
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
