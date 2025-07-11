<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function destinations()
    {
        // Tampilkan daftar destinasi
    }

    public function destinationDetail($id)
    {
        // Tampilkan detail destinasi
    }

    public function booking(Request $request)
    {
        // Proses booking destinasi
    }

    public function reviews($destination_id)
    {
        // Tampilkan review destinasi
    }
}
