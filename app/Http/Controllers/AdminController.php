<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Dashboard admin
    }

    // Kategori
    public function index()
    {
        // List kategori/destinasi/booking/review/user (tergantung resource)
    }
    public function create()
    {
        // Form tambah data
    }
    public function store(Request $request)
    {
        // Simpan data baru
    }
    public function edit($id)
    {
        // Form edit data
    }
    public function update(Request $request, $id)
    {
        // Update data
    }
    public function destroy($id)
    {
        // Hapus data
    }
    public function show($id)
    {
        // Detail data (khusus booking)
    }
}
