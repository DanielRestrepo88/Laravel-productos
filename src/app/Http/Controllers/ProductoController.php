<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // GET /productos
    public function index()
    {
        // En Laravel tu campo 'estado' es boolean (true/false)
        // Listamos todo y paginamos 10
        
        $productos = Producto::orderBy('id', 'asc')->paginate(10);

        return view('productos.index', compact('productos'));
    }

    // GET /productos/{producto}
    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    // GET /productos/{producto}/edit
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    // PUT/PATCH /productos/{producto}
    public function update(Request $request, Producto $producto)
    {
        // Validación 
        $validated = $request->validate([
            'sku'         => ['required', 'string', 'min:3', 'max:50', 'unique:productos,sku,' . $producto->id],
            'nombre'      => ['required', 'string', 'min:3', 'max:150'],
            'descripcion' => ['nullable', 'string', 'min:5'],
            'stock'       => ['required', 'integer', 'min:0'],
            'precio'      => ['required', 'numeric', 'min:0'],
            'estado'      => ['required', 'boolean'],
        ]);

        $producto->update($validated);

        return redirect()->route('productos.show', $producto->id)
            ->with('success', 'Producto actualizado correctamente.');
    }

    // DELETE /productos/{producto}
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}
