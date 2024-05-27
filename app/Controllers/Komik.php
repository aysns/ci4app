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
    $data = [
      'title' => "Daftar Komik"
    ];

    // //cara konek db tanpa model
    // $db = \Config\Database::connect();
    // //ambil semua data komik
    // $komik = $db->query("SELECT * FROM komik");
    // foreach($komik->getResultArray() as $row){
    //   d($row);
    // }

    // $komikModel = new KomikModel();
    $komik =$this->komikModel->findAll();
    dd($komik);

    return view('komik/index',$data);
  }
}