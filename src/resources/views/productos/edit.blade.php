@include('partials.header', ['title' => 'Editar Producto', 'active' => 'productos'])

<a href="{{ url('/Productos/' . $producto->id) }}" class="btn btn-link mb-3">&larr; Volver al detalle</a>

<h1 class="mb-4">Editar producto</h1>

@if($errors->any())
  <div class="alert alert-danger">
    <strong>Revisa los campos:</strong>
    <ul class="mb-0">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="row g-3">
  <div class="col-md-4">
    <div class="card shadow-sm">
      <img
        id="imgPreview"
        src="{{ asset(old('imagen', $producto->imagen) ?: 'imagenes/default.jpg') }}"
        alt="{{ $producto->nombre }}"
        style="width:100%; height:260px; object-fit:cover;"
        onerror="this.onerror=null;this.src='{{ asset('imagenes/default.jpg') }}';"
      >
      <div class="card-body small text-body-secondary">
        Si la ruta no existe, se mostrará <code>public/imagenes/default.jpg</code>.
      </div>
    </div>
  </div>

  <div class="col-md-8">
    <form action="{{ url('/Productos/' . $producto->id . '/update') }}" method="POST" class="card p-4 shadow-sm">
      @csrf

      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label">SKU</label>
          <input type="text" name="sku" class="form-control" value="{{ old('sku', $producto->sku) }}" required>
        </div>

        <div class="col-md-8">
          <label class="form-label">Nombre</label>
          <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $producto->nombre) }}" required>
        </div>

        <div class="col-12">
          <label class="form-label">Descripción</label>
          <textarea name="descripcion" class="form-control" rows="4">{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>

        <div class="col-12">
          <label class="form-label">Imagen (ruta en <code>public/</code>)</label>
          <input
            id="imagenInput"
            type="text"
            name="imagen"
            class="form-control"
            value="{{ old('imagen', $producto->imagen) }}"
            placeholder="imagenes/productos/agua.png"
          >
          <div class="form-text">
            Ejemplo: <code>imagenes/agua.png</code>
          </div>
        </div>

        <div class="col-md-3">
          <label class="form-label">Stock</label>
          <input type="number" name="stock" class="form-control" value="{{ old('stock', $producto->stock) }}" min="0" required>
        </div>

        <div class="col-md-3">
          <label class="form-label">Precio</label>
          <input type="number" step="0.01" name="precio" class="form-control" value="{{ old('precio', $producto->precio) }}" min="0" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Estado</label>
          <select name="estado" class="form-select" required>
            <option value="1" {{ (int)old('estado', $producto->estado) === 1 ? 'selected' : '' }}>Activo</option>
            <option value="0" {{ (int)old('estado', $producto->estado) === 0 ? 'selected' : '' }}>Inactivo</option>
          </select>
        </div>
      </div>

      <div class="d-flex gap-2 mt-4">
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <a href="{{ url('/Productos') }}" class="btn btn-outline-secondary">Cancelar</a>
      </div>
    </form>
  </div>
</div>

<script>
  (function () {
    const input = document.getElementById('imagenInput');
    const preview = document.getElementById('imgPreview');

    if (!input || !preview) return;

    input.addEventListener('input', function () {
      const val = (input.value || '').trim();

      // Armamos una URL relativa a la raíz del sitio: / + ruta
      // Si está vacío, usamos la default
      preview.src = val ? ('/' + val.replace(/^\/+/, '')) : '/imagenes/default.jpg';
    });
  })();
</script>

@include('partials.footer')
