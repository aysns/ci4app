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

    return view('komik/index', $data);
  }

  public function detail($slug)
  {
    $data = [
      'title' => 'Detail Komik',
      'komik' => $this->komikModel->getKomik($slug)
    ];

    //jika komik tidak ada di tabel
    if (empty($data['komik'])) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('judul komik ' . $slug . ' tidak ditemukan.');
    }


    return view('komik/detail', $data);
  }

  public function create()
  {
    $data = [
      'title' => 'Form Tambah Data Komik',
      'validation' => \Config\Services::validation()
    ];
    return view('komik/create', $data);
  }

  public function save()
  {
    //validasi input
    if (!$this->validate([
      'judul' => [
        'rules' => 'required|is_unique[komik.judul]',
        'errors' => [
          'required' => '{field} komik harus diisi.',
          'is_unique' => '{field} komik sudah terdaftar'
        ]
      ],
      'penulis' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nama {field} komik harus diisi.',
        ]
      ],
      'penerbit' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nama {field} komik harus diisi.',
        ]
      ],
      'sampul' => [
        'rules' => 'uploaded[sampul]|max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'uploaded' => '{field} tidak boleh kosong.',
          'max_size' => 'ukuran {field} tidak lebih dari 1mb',
          'is_image' => 'yang anda pilih bukan gambar',
          'mime_in' => 'format gambar harus JPG/JPEG/PNG',
        ]
      ]
    ])) {
      //tangkap pesan kesalahan ke variabel validation
      // $validation = \Config\Services::validation();

      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
    //ambil gambar 
    $fileSampul = $this->request->getFile('sampul'); 

    //generate nama sampul random
    $namaSampul = $fileSampul->getRandomName();

    //pindahkan file ke folder img
    $fileSampul->move('img',$namaSampul);

    //ambil nama file sampul
    //$namaSampul = $fileSampul->getName();

    $slug = url_title($this->request->getVar('judul'), '-', true);
    $this->komikModel->save([
      'judul' => $this->request->getVar('judul'),
      'slug' => $slug,
      'penulis' => $this->request->getVar('penulis'),
      'penerbit' => $this->request->getVar('penerbit'),
      'sampul' => $namaSampul
    ]);

    //buat flashdata
    session()->setFlashdata('pesan', 'Data Berhasil ditambahkan.');

    //balikin ke halaman daftar komik
    return redirect()->to('/komik');
  }

  public function delete($id)
  {
    $this->komikModel->delete($id);
    session()->setFlashdata('pesan', 'Data Berhasil dihapus.');
    return redirect()->to('/komik');
  }

  public function edit($slug)
  {
    $data = [
      'title' => 'Form Ubah Data Komik',
      'validation' => \Config\Services::validation(),
      'komik' => $this->komikModel->getKomik($slug)
    ];
    return view('komik/edit', $data);
  }

  public function update($id)
  {
    //cek judul
    $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
    if ($komikLama['judul'] == $this->request->getVar('judul')) {
      $rule_judul = 'required';
    } else {
      $rule_judul = 'required|is_unique[komik.judul]';
    }

    //validasi input
    if (!$this->validate([
      'judul' => [
        'rules' => $rule_judul,
        'errors' => [
          'required' => '{field} komik harus diisi.',
          'is_unique' => '{field} komik sudah terdaftar'
        ]
      ],
      'penulis' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nama {field} komik harus diisi.',
        ]
      ],
      'penerbit' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nama {field} komik harus diisi.',
        ]
      ]
    ])) {
      //tangkap pesan kesalahan ke variabel validation
      // $validation = \Config\Services::validation();

      return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput()->with('errors', $this->validator->getErrors());
    }

    $slug = url_title($this->request->getVar('judul'), '-', true);
    $this->komikModel->save([
      'id' => $id,
      'judul' => $this->request->getVar('judul'),
      'slug' => $slug,
      'penulis' => $this->request->getVar('penulis'),
      'penerbit' => $this->request->getVar('penerbit'),
      'sampul' => $this->request->getVar('sampul')
    ]);

    //buat flashdata
    session()->setFlashdata('pesan', 'Data Berhasil diubah.');

    //balikin ke halaman daftar komik
    return redirect()->to('/komik');
  }
}
