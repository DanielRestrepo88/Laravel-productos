<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::orderBy('id', 'asc')->paginate(10);
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sku'         => ['required', 'string', 'min:3', 'max:50', 'unique:productos,sku'],
            'nombre'      => ['required', 'string', 'min:3', 'max:150'],
            'descripcion' => ['nullable', 'string'],
            'imagen'      => ['nullable', 'string', 'max:255'],
            'stock'       => ['required', 'integer', 'min:0'],
            'precio'      => ['required', 'numeric', 'min:0'],
            'estado'      => ['required'],
        ]);

        $validated['estado'] = (bool) $request->input('estado');

        Producto::create($validated);

        return redirect()->route('productos.index')
            ->with('success', 'Se creó correctamente el producto.');
    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'sku'         => ['required', 'string', 'min:3', 'max:50', 'unique:productos,sku,' . $producto->id],
            'nombre'      => ['required', 'string', 'min:3', 'max:150'],
            'descripcion' => ['nullable', 'string'],
            'imagen'      => ['nullable', 'string', 'max:255'],
            'stock'       => ['required', 'integer', 'min:0'],
            'precio'      => ['required', 'numeric', 'min:0'],
            'estado'      => ['required'],
        ]);

        $validated['estado'] = (bool) $request->input('estado');

        $producto->update($validated);

        return redirect()->route('productos.show', $producto->id)
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }

    public function storeApi(Request $request)
    {
        $validated = $request->validate([
            'sku'         => ['required', 'string', 'min:3', 'max:50', 'unique:productos,sku'],
            'nombre'      => ['required', 'string', 'min:3', 'max:150'],
            'descripcion' => ['nullable', 'string'],
            'imagen'      => ['nullable', 'string', 'max:255'],
            'stock'       => ['required', 'integer', 'min:0'],
            'precio'      => ['required', 'numeric', 'min:0'],
            'estado'      => ['required'],
        ]);

        $validated['estado'] = (bool) $request->input('estado');

        $producto = Producto::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Producto creado correctamente',
            'data' => $producto
        ], 201);
    }
}
