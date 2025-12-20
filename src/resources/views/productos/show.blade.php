@include('partials.header', ['title' => 'Detalle Producto', 'active' => 'productos'])

<a href="{{ route('productos.index') }}" class="btn btn-link mb-3">&larr; Volver a Productos</a>

<div class="card shadow-sm">
  <img
    src="{{ asset($producto->imagen ?? 'imagenes/default.jpg') }}"
    class="card-img-top"
    alt="{{ $producto->nombre }}"
    style="max-height: 420px; object-fit: cover;"
    onerror="this.onerror=null;this.src='{{ asset('imagenes/default.jpg') }}';"
  >

  <div class="card-body">
    <h3 class="card-title mb-2">{{ $producto->nombre }}</h3>
    <p class="text-body-secondary mb-3">SKU: {{ $producto->sku }}</p>

    <p class="card-text">{{ $producto->descripcion }}</p>

    <div class="row mt-4 g-3">
      <div class="col-md-4">
        <div class="p-3 border rounded">
          <strong>Stock:</strong> {{ $producto->stock }}
        </div>
      </div>

      <div class="col-md-4">
        <div class="p-3 border rounded text-md-end">
          <strong>Precio:</strong> ${{ number_format((float)$producto->precio, 0, ',', '.') }}
        </div>
      </div>

      <div class="col-md-4">
        <div class="p-3 border rounded text-md-end">
          <strong>Estado:</strong>
          {!! $producto->estado ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-secondary">Inactivo</span>' !!}
        </div>
      </div>
    </div>

    <div class="d-flex gap-2 mt-4">
      <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-outline-warning">Editar</a>
      <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
        @csrf
        <button type="submit" class="btn btn-outline-danger">Eliminar</button>
      </form>
    </div>
  </div>
</div>

@include('partials.footer')
