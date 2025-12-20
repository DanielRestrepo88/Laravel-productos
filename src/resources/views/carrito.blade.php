@include('partials.header', ['title' => 'Carrito de Compras', 'active' => 'carrito'])

@if(session('bienvenida'))
  <div class="alert mb-4" style="background-color: #d1f2eb; border: 1px solid #a3e4d7; color: #0e6655; padding: 15px; border-radius: 5px;">
    {{ session('bienvenida') }}
  </div>
@endif

<div class="card shadow-sm" style="border: 1px solid #dee2e6;">
  <div class="card-body">
    <h1 class="mb-4">Carrito de Compras</h1>

    @if($item->isEmpty())
      <div class="alert alert-info mb-0">No hay productos en el carrito.</div>
    @else
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="table-dark">
            <tr>
              <th>Imagen</th>
              <th>Producto</th>
              <th>SKU</th>
              <th class="text-end">Precio Unitario</th>
              <th class="text-center">Cantidad</th>
              <th class="text-end">Subtotal</th>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @php $total = 0; @endphp
            @foreach($item as $carritoItem)
              @php
                $subtotal = $carritoItem->product->precio * $carritoItem->cantidad;
                $total += $subtotal;
              @endphp
              <tr>
                <td>
                  <img src="{{ asset($carritoItem->product->imagen ?? 'imagenes/default.jpg') }}" alt="{{ $carritoItem->product->nombre }}" style="width:70px;height:70px;object-fit:cover;border-radius:10px;" onerror="this.onerror=null;this.src='{{ asset('imagenes/default.jpg') }}';">
                </td>
                <td>{{ $carritoItem->product->nombre }}</td>
                <td>{{ $carritoItem->product->sku }}</td>
                <td class="text-end">${{ number_format((float)$carritoItem->product->precio, 0, ',', '.') }}</td>
                <td class="text-center">{{ $carritoItem->cantidad }}</td>
                <td class="text-end">${{ number_format((float)$subtotal, 0, ',', '.') }}</td>
                <td class="text-center">
                  <form action="{{ route('carrito.destroy', $carritoItem->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este producto del carrito?');">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th colspan="6" class="text-end">Total:</th>
              <th class="text-end">${{ number_format((float)$total, 0, ',', '.') }}</th>
            </tr>
          </tfoot>
        </table>
      </div>
    @endif
  </div>
</div>

@include('partials.footer')

