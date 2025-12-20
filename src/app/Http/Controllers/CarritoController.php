<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\CarritoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function index()
    {
        $item = CarritoItem::where('user_id', Auth::user()->id)
            ->with('product')
            ->get();

        return view('carrito', compact('item'));
    }

    public function agregar(Producto $producto)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $item = CarritoItem::where('user_id', Auth::id())
            ->where('producto_id', $producto->id)
            ->first();

        if ($item) {
            $item->cantidad += 1;
            $item->save();
        } else {
            CarritoItem::create([
                'user_id' => Auth::id(),
                'producto_id' => $producto->id,
                'cantidad' => 1,
            ]);
        }

        return redirect()->route('carrito.index')
            ->with('success', 'Producto agregado al carrito.');
    }

    public function destroy(CarritoItem $carritoItem)
    {
        if ($carritoItem->user_id !== Auth::id()) {
            return redirect()->route('carrito.index')
                ->with('error', 'No tienes permiso para eliminar este item.');
        }

        $carritoItem->delete();

        return redirect()->route('carrito.index')
            ->with('success', 'Producto eliminado del carrito.');
    }
}

