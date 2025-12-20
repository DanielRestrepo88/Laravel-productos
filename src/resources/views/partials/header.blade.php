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

    {{-- Logo --}}
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/Inicio') }}">
      <img src="{{ asset('imagenes/logo.jpg') }}" alt="Logo" width="40" height="40" class="me-2">
      <span class="fw-bold">Inventario</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

        {{-- Inicio --}}
        <li class="nav-item">
          <a class="nav-link {{ ($active ?? '') === 'inicio' ? 'active fw-bold' : '' }}"
             href="{{ url('/Inicio') }}">
            Inicio
          </a>
        </li>

        {{-- Productos --}}
        <li class="nav-item">
          <a class="nav-link {{ ($active ?? '') === 'productos' ? 'active fw-bold' : '' }}"
             href="{{ url('/Productos') }}">
            Productos
          </a>
        </li>

        {{-- AUTENTICACIÓN --}}
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fw-bold text-primary"
               href="#"
               role="button"
               data-bs-toggle="dropdown"
               aria-expanded="false">
              Hola, {{ auth()->user()->name }}
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="{{ route('carrito.index') }}">
                  🛒 Mi carrito
                </a>
              </li>

              <li><hr class="dropdown-divider"></li>

              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger">
                    🚪 Cerrar sesión
                  </button>
                </form>
              </li>
            </ul>
          </li>
        @endauth

        @guest
          <li class="nav-item">
            <a class="btn btn-outline-primary btn-sm" href="{{ route('login') }}">
              Iniciar sesión
            </a>
          </li>
        @endguest

      </ul>
    </div>
  </div>
</nav>

<main class="container py-4">
