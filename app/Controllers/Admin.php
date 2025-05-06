<?php

namespace App\Controllers;

use App\Models\UserModel;

class Admin extends BaseController
{
    protected $UserModel;

    protected $validation;


    public function __construct()
    {
        $this->UserModel = new \App\Models\UserModel();
        $this->validation = \config\Services::validation();
    }

    public function index()
    {
        if (session()->has('logged_in')) {
            $data = [
                'title' => 'Admin',
            ];
            return view('admin/index', $data);
        } else {
            session()->setFlashdata('error', 'Harap login terlebih dahulu');
            return redirect()->to('login');
        }
    }

    public function getDataUser()
    {
        $response = $data['data'] = array();

        //mendapatkan data pelanggan di table user model
        //inisialisasi data tabel , mengambil data dari tabel user
        $result = $this->UserModel->select()->get()->getResult();
        $no = 1;
        foreach ($result as $key => $value) {

            // inisialisai aksi ubah data
            $ops =
                '<button 
                    id="update_user" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modal-edit-user"

                    data-user_id= "' . $value->user_id . '"

                    data-user_username_old= "' . $value->user_username . '"
                    data-user_password_old= "' . $value->user_password . '"
                    data-user_isadmin_old= "' . $value->user_isadmin . '"
                    data-user_nama_old= "' . $value->user_nama . '"
                    data-user_telp_old= "' . $value->user_telp . '"
                    data-user_alamat_old= "' . $value->user_alamat . '"
                    
                    class="btn btn-xs btn-primary">
                        <i class="fas fa-pencil-alt"></i> Ubah
                </button>';

            $ops .=
                '<button 
                    id="hapus_user"

                    data-user_id="' . $value->user_id . '" 
                    
                    class="btn btn-xs btn-danger">
                    <i class="fas fa-trash"></i> Hapus
                </button>';

            $data['data'][$key] = array(
                $no++, //ini buat kol nomor
                $value->user_username,
                $value->user_id,
                // $value->user_password,
                $value->user_nama,
                $value->user_telp,
                $value->user_alamat,
                $value->user_isadmin,

                // $value->diskon,
                // '<div id="total">' . $value->total . '</div>',
                // $value->user_id,

                $ops // buat kolom aksi
            );
        }

        return $this->response->setJSON($data);
    }

    public function save()
    {
        $response = array();

        $fields['user_username'] = $this->request->getPost('user_username');
        $fields['user_password'] = $this->request->getPost('user_password');
        $fields['user_isadmin'] = $this->request->getPost('user_isadmin');
        $fields['user_nama'] = $this->request->getPost('user_nama');
        $fields['user_alamat'] = $this->request->getPost('user_alamat');
        $fields['user_telp'] = $this->request->getPost('user_telp');

        // dibawah ini cara jika library validationnya dipanggil di sini
        // $validation = \config\Services::validation();

        // $validation->setRules([
        //     'username' => [
        //         'label'  => 'Rules.username',
        //         'rules'  => 'required|is_unique[users.username]',
        //         'errors' => [
        //             'required' => 'Rules.username.required',
        //         ],
        //     ],
        //     'password' => [
        //         'label'  => 'Rules.password',
        //         'rules'  => 'required|min_length[10]',
        //         'errors' => [
        //             'min_length' => 'Rules.password.min_length',
        //         ],
        //     ],
        // ]);


        // dibawah  ini cara jika library validationnya sudah di inisialisai di constructor (dipanggil lewat instance??? gatau deh nama e apa WKWKW belum tau)
        $this->validation->setRules([
            'user_username' =>
            [
                'rules' => 'required|is_unique[user.user_username]|max_length[20]',
                'errors' => [
                    // 'required' => '{field} harus diisi.',
                    // 'is_unique' => '{field} sudah terdaftar',
                    // 'max_length' => '{field} maksimal 20 karakter',

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
            if ($this->UserModel->insert($fields)) {
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
        $usernameLama = $this->UserModel->where('user_id', $temp)->first();
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
            if ($this->UserModel->update($fields['user_id'], $fields)) {
                $response['success'] = true;
                $response['messages'] = lang("App.insert-success");
            } else {
                $response['success'] = false;
                $response['messages'] = lang("App.insert-error");
            }
        }
        return $this->response->setJSON($response);
    }

    public function save_work_without_validation()
    {
        $response = array();

        $fields['user_username'] = $this->request->getPost('user_username');
        $fields['user_password'] = $this->request->getPost('user_password');
        $fields['user_isadmin'] = $this->request->getPost('user_isadmin');
        $fields['user_nama'] = $this->request->getPost('user_nama');
        $fields['user_alamat'] = $this->request->getPost('user_alamat');
        $fields['user_telp'] = $this->request->getPost('user_telp');

        // d($fields['pelanggan_nama']);
        if ($this->UserModel->insert($fields)) {
            // dd("sokses");
            $response['success'] = true;
            // session()->setFlashdata('pesan', 'Data Pelanggan Baru Berhasil Ditambahkan');
        } else {
            $response['success'] = false;
        }

        return $this->response->setJSON($response);
    }

    public function delete()
    {
        // dd("del func");
        $response = array();

        $user_id = $this->request->getPost('user_id');
        // $this->PelangganModel->where('pelanggan_id', $pelanggan_id)->delete();
        // $temp = $this->PelangganModel->where('pelanggan_id', $pelanggan_id)->get;

        // session()->setFlashdata('pelanggan_nama', $temp('pelanggan_nama'));

        if ($this->UserModel->where('user_id', $user_id)->delete()) {
            // session()->setFlashdata('pesan', 'Data Pelanggan Berhasil Dihapus');
            // return redirect()->to('pelanggan');
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }

        return $this->response->setJSON($response);
    }

    public function index_old()
    {
        // d($this->request->getVar('keyword'));
        // getVar ini bisa ngambil GET bisa ngambil POST

        $keyword = $this->request->getVar('keyword');

        // $keyword = $this->request->getGet('keyword');
        if ($keyword) {
            //     dd("masuk sini");
            $pencarian = $this->UserModel->fiturCari($keyword);
            // dd("masuk sini");
        } else {
            $pencarian = $this->UserModel->getUser();
        }

        $data = [
            'title' => 'Admin',
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

        return view('admin/index', $data);
    }



    public function create_old()
    {
        // session();
        $data = [
            'title' => 'Tambah User',
            'validation' => \config\Services::validation()
        ];
        return view('admin/create', $data);
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
                'username' =>
                [
                    'rules' => 'required|is_unique[user.user_name]|max_length[20]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'is_unique' => '{field} sudah terdaftar',
                        'max_length' => '{field} maksimal 20 karakter',
                    ]
                ],
                'password' =>
                [
                    'rules' => 'required|max_length[10]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'max_length' => '{field} maksimal 10 karakter',
                    ]
                ],

            ]
        )) {
            $validation = \config\Services::validation();
            // dd($validation);
            // return redirect()->to('/komik/create');

            return redirect()->to('admin/create')->withInput()->with('validation', $validation);

            // diatas ini, input dari withInput() akan kesimpan di session, maka session 
            // harus dinyalakan biar berfungsi
        };

        $this->UserModel->save([
            'user_name' => $this->request->getVar('username'),
            'user_password' => $this->request->getVar('password'),
            'user_isowner' => $this->request->getVar('user_isowner'),
        ]);


        // dibawah ini untuk menggunakan flashdata, yaitu sebuah data yang hanya muncul sekali aja. 
        // jadi klo halaman di refresh, hilang data nya. pake session

        session()->setFlashdata('pesan', 'User Berhasil Ditambahkan');
        return redirect()->to('admin');
    }


    public function delete_old($id)
    {
        // method delete ini udah bawaan dari model kalo pake CI, sama seperti save
        // dd($slug);

        // public function delete($slug)
        // $this->komikModel->where('slug', $slug)->delete();
        // cara diatas ini bisa  dipake kalau misal nyari data yg mau dihapus itu gapake primary key
        // (disini dia pake kolom slug buat nyari datanya)


        // $this->UserModel->delete($id);
        // $this->UserModel->delete(['user_id' => $id]);
        $this->UserModel->where('user_id', $id)->delete();
        // cara diatas ini HANYA bisa dipake kalo pencarian data yang mau dihapus menggunakan primary key
        // kalo misal menggunakan $this->komikModel->delete($slug); gaakan bisa, udah tak coba sendiri.
        // sumber nya ada di dokumentasi codeigniter

        session()->setFlashdata('pesan', 'User Berhasil Dihapus');
        return redirect()->to('admin');
    }

    public function edit_old($user_id)
    {
        // SESSION DIBAWAH INI HARUS NYALA UNTUK MENGAMBIL VALIDATION  DAN DATAUSERDIEDIT!!!!
        // HABIS 4 JAM CUMA KARENA BINGUNG SESSION DIBAWAH INI MATI, jadinya gabisa akses datauserdiedit
        // FAKKK

        // BASE CONTROLLER DIMASUKKIN DI BASE CONTROLLER BIAR JALAN DARI AWALLL!!!!!!

        // session();
        $data = [
            'title' => 'Edit User',
            'validation' => \config\Services::validation(),
            'dataUserDiedit' => $this->UserModel->getUser($user_id)
        ];
        return view('admin/edit', $data);
    }

    // public function update()

    // dibawah ini bisa
    // harusnya gapake parameter $id itu bisa kok, tapi masalahnya kan nanti 
    // semua value2 kalo diedit bakal berubah
    public function update_old($user_id)
    {
        // session();
        // cek judul
        $usernameLama = $this->UserModel->whereIn('user_id', [$user_id])->first();
        // $usernameLama = $this->UserModel->getUser($this->request->getVar('username'));
        $passwordLama = $this->UserModel->getUser($this->request->getVar('password'));
        $userisownerLama = $this->UserModel->getUser($this->request->getVar('user_isowner'));

        // dd($this->request->getVar('slug'));
        // dd($this->request->getVar('username'));
        // dd($usernameLama);
        // dd($usernameLama['user_name']);
        if ($usernameLama['user_name'] == $this->request->getVar('username')) {
            $rule_username = 'required';
        }
        // else if(strlen($this->request->getVar('username')) > 20){

        // } 
        else {
            $rule_username = 'required|is_unique[user.user_name]|max_length[20]';
        }



        // ini diambil dari method save

        // validasi input
        if (!$this->validate(
            [

                // 'judul' => 'required|is_unique[komik.judul]'
                'username' =>
                [
                    // 'rules' => 'required|is_unique[user.user_name]|max_length[20]',
                    'rules' => $rule_username,
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'is_unique' => '{field} sudah terdaftar',
                        'max_length' => '{field} maksimal 20 karakter',
                    ]
                ],
                'password' =>
                [
                    'rules' => 'required|max_length[10]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'max_length' => '{field} maksimal 10 karakter',
                    ]
                ],
            ]
        )) {
            $validation = \config\Services::validation();
            // return redirect()->to('/admin/edit/' . $this->request->getVar('username'))->withInput()->with('validation', $validation);
            return redirect()->to('/admin/edit/' . $user_id)->withInput()->with('validation', $validation);
            // return redirect()->to('/admin/edit/')->withInput()->with('validation', $validation);
        };

        // dibawah ini bisa
        // $slug = url_title($this->request->getVar('judul'), '-', true);

        $dataUpdate = [
            'user_name' => $this->request->getVar('username'),
            'user_password' => $this->request->getVar('password'),
            'user_isowner' => $this->request->getVar('user_isowner'),
        ];

        // $this->komikModel->whereIn('slug', $slug)->set($dataUpdate)->update();
        // $this->komikModel->whereIn('id', [$id])->set($dataUpdate)->update();
        // $this->komikModel->whereIn('slug', [$slug])->set($dataUpdate)->update();
        // $this->komikModel->whereIn('id', [$beta])->set($dataUpdate)->update();

        // dibawah ini bisa, ini nyari sendiri gak ngikutin dari video hehe
        $this->UserModel->whereIn('user_id', [$user_id])->set($dataUpdate)->update();




        session()->setFlashdata('pesan', 'Data User Berhasil diubah');

        return redirect()->to('admin/');
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
