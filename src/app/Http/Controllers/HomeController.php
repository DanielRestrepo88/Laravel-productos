<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function inicio()
    {
        $data = [
            'tipoProducto' => 'Snacks y Bebidas',
            'descripcion'  => 'Encuentra productos para tu día a día: snacks, bebidas y combos con excelente precio.',
        ];

        return view('inicio', $data);
    }
}
