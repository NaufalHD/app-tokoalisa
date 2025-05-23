<?php

namespace App\Models;

use CodeIgniter\Model;

use function PHPUnit\Framework\isNull;

class OmzetHarianModel extends Model
{
    protected $table = 'omzet_harian';
    protected $useSoftDeletes = false;
    protected $useTimestamps = true;
    protected $primaryKey = 'omzet_id';



    // protected $returnType = "object";

    // dibawah ini untuk mengijinkan jika field2 tersebut akan diisi manual oleh kita
    // protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'sampul'];
    protected $allowedFields =
    [
        'omzet_date',
        'omzet_nominal',
        'omzet_catatan',
    ];
    // protected $primaryKey = 'id';



    public function getOmzet($omzet_id = false)
    {

        if ($omzet_id == false) {
            return $this->findAll();
            // DIBAWAH INI ADALAH PENULISAN YanG BISA DISINGKAT DENGAN LANGSUNG DI CHAINING dengan $this
            // $builder = $this->table('komik');
            // $builder->like('judul', 'naruto');
            // return $builder;

            // return $this->orderBy('id', 'desc')->findAll();
        } else {
            // ini untuk melanjutkan proses penampilan detail komik yang dipilih
            // return $this->where(['slug' => $keyword])->first();

            return $this->where(['omzet_id' => $omzet_id])->first();
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

        // dd($this->like('omzet_catatan', $keyword)->findAll());

        // return $this->Like('omzet_nominal', $keyword)->orLike('omzet_catatan', $keyword)->findAll();

        // d($this->where('omzet_nominal', intval($keyword) * 1000)->findAll());
        // d(intval($keyword) * 1000);

        $keyword_to_int = intval($keyword);
        // variabel diatas ini nanti dikali 1000 karena data tersimpan di database nya adalah dikali 1000 juga
        // dengan tujuan biar bisa menyimpan satuan yang lebih kecil dari seribu rupiah

        return $this->like('omzet_catatan', $keyword)->orWhere('omzet_nominal', ($keyword_to_int * 1000))->orWhere('omzet_id', $keyword)->findAll();
        // return $this->like('omzet_catatan', $keyword)->findAll();
    }

    public function fiturCariWaktu($input_date_begin, $input_date_end)
    {

        // dd($input_date_begin);
        d("ini didalem fcwaktu");
        // kode dibawah WORKS!!!!
        return $this->where("omzet_date >=", $input_date_begin)->where("omzet_date <=", $input_date_end)->findAll();
    }
}
