<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
        /**
     * Tampilkan halaman laporan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('laporan.index');
    }
}
