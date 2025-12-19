@include('partials.header', ['title' => 'Inicio', 'active' => 'inicio'])

<h1 class="mb-2">Bienvenidos UNISARC 4.6.3</h1>
<h2 class="mb-4 text-body-secondary">Este es su sistema de inventario</h2>

<div class="row">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow-sm">
      <img src="{{ asset('imagenes/productos.jpg') }}" class="card-img-top" alt="Productos">
      <div class="card-body">
        <h5 class="card-title">{{ $tipoProducto }}</h5>
        <p class="card-text">{{ $descripcion }}</p>
        <a href="{{ url('/Productos') }}" class="btn btn-primary">Ver productos</a>
      </div>
    </div>
  </div>
</div>

@include('partials.footer')
