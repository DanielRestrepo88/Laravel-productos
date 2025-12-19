<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'Inventario UNISARC' }}</title>

  <!-- Bootstrap CSS (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/Inicio') }}">
      <img src="{{ asset('imagenes/logo.jpg') }}" alt="Logo" width="40" height="40" class="me-2">
      <span class="fw-bold">Inventario</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link {{ ($active ?? '') === 'inicio' ? 'active fw-bold' : '' }}" href="{{ url('/Inicio') }}">
            Inicio
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($active ?? '') === 'productos' ? 'active fw-bold' : '' }}" href="{{ url('/Productos') }}">
            Productos
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main class="container py-4">
