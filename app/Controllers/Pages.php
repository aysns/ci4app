<?php

namespace App\Controllers;

use Stringable;

class Pages extends BaseController
{
  public function index(): String
  {
    $data = [
      'title' => 'Home | Web Programming'
    ];
    return view('pages/home', $data);
  }

  public function about(): String
  {
    $data = [
      'title' => 'About Me'
    ];
    return view('pages/about', $data);
  }

  public function contact(): String
  {
    $data = [
      'title' => 'Contact',
      'alamat' => [
        [
          'tipe' => 'rumah',
          'alamat' => 'Jl. xyz No 789',
          'kota' => 'Lhokseumawe'
        ],
        [
          'tipe' => 'kantor',
          'alamat' => 'Jl. abc No 123',
          'kota' => 'Aceh Tamiang'
        ]
      ]
    ];
    return view('pages/contact', $data);
  }
}
