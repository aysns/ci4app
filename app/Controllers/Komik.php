<?php

namespace App\Controllers;
use \App\Models\KomikModel;

class Komik extends BaseController
{
  protected $komikModel;
  public function __construct()
  {
    $this->komikModel = new KomikModel();
  }

  public function index()
  {
    // $komik =$this->komikModel->findAll();

    $data = [
      'title' => "Daftar Komik",
      'komik' => $this->komikModel->getKomik()
    ];

    // //cara konek db tanpa model
    // $db = \Config\Database::connect();
    // //ambil semua data komik
    // $komik = $db->query("SELECT * FROM komik");
    // foreach($komik->getResultArray() as $row){
    //   d($row);
    // }

    // $komikModel = new KomikModel();

    return view('komik/index',$data);
  }

  public function detail($slug)
  {
    $data = [
      'title' => 'Detail Komik',
      'komik' => $this->komikModel->getKomik($slug)
    ];

    //jika komik tidak ada di tabel
    if(empty($data['komik'])) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('judul komik ' . $slug . ' tidak ditemukan.');
    }


    return view('komik/detail',$data);
  }

  public function create()
  {
    $data = [
      'title' => 'Form Tambah Data Komik',
    ];
    return view('komik/create', $data);
  }

  public function save()
  {
   dd($this->request->getVar());
  }
}