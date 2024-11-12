<?php

namespace App\Http\Controllers;

use App\Model\provinsiModel;
use Illuminate\Http\Request;

class provinsiController extends Controller
{
    public function index()
    {
        $provinsi = provinsi::All();
        return view('provinsi', compact('provinsi'));
    }
}
