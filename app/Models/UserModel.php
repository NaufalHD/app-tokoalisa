<?php

namespace App\Models;

use CodeIgniter\Model;

use function PHPUnit\Framework\isNull;

class UserModel extends Model
{
    protected $table = 'user';
    protected $useSoftDeletes = false;
    protected $useTimestamps = true;
    protected $primaryKey = 'user_id';

    // dibawah ini untuk mengijinkan jika field2 tersebut akan diisi manual oleh kita
    // protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'sampul'];

    protected $allowedFields = ['user_username', 'user_password', 'user_isadmin', 'user_nama', 'user_telp', 'user_alamat'];
    // protected $primaryKey = 'id';

    // settingn dibawah ngaruh ke verifikasi password bagian login nya, 
    // pas ngambil username/password di bagian if pada controller login
    // protected $returnType = "object";

    public function getUser($user_id = false)
    {
        if ($user_id == false) {
            return $this->findAll();
            // DIBAWAH INI ADALAH PENULISAN YanG BISA DISINGKAT DENGAN LANGSUNG DI CHAINING dengan $this
            // $builder = $this->table('komik');
            // $builder->like('judul', 'naruto');
            // return $builder;

            // return $this->orderBy('id', 'desc')->findAll();
        } else {
            // ini untuk melanjutkan proses penampilan detail komik yang dipilih
            // return $this->where(['slug' => $keyword])->first();

            return $this->where(['user_id' => $user_id])->first();
        }
    }

    public function fiturCari($keyword)
    {
        // $builder = $this->table('komik');
        // $builder->like('judul',$keyword);
        // return $builder;

        // return $this->table('komik')->like('judul', $keyword);
        // dd($keyword);
        // dd($keyword);
        // return $this->table('komik')->like('judul', $keyword)->orLike('penulis', $keyword)->orLike('penerbit', $keyword);
        // dd($this->table('komik')->like('judul', $keyword));
        // return ($this->table('komik')->like('judul', $keyword));
        // return $this->like('judul', $keyword);

        // dd($this->like('judul', $keyword));
        $keyword_to_lowercase = strtolower($keyword);

        if ($keyword_to_lowercase == "pegawai") {
            $keyword_isadmin = "0";
            d($keyword_isadmin);
            return $this->where('user_isadmin', $keyword_isadmin)->findAll();
        } elseif ($keyword_to_lowercase == "pemilik") {
            $keyword_isadmin = "1";
            d($keyword_isadmin);
            return $this->where('user_isowner', $keyword_isadmin)->findAll();
        } else {
            return $this->like('user_name', $keyword)->orWhere('user_id', $keyword)->findAll();
        }

        d($keyword);
    }
}
