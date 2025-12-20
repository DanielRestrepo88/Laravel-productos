@include('partials.header', ['title' => 'Iniciar sesión', 'active' => ''])

<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h1 class="h4 mb-3">Iniciar sesión</h1>
        <p class="text-body-secondary mb-4">
          Ingresa tu correo y contraseña para continuar.
        </p>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
          @csrf

          <div class="mb-3">
            <label class="form-label">Correo</label>
            <input
              type="email"
              name="email"
              class="form-control"
              value="{{ old('email') }}"
              required
              autofocus
            >
          </div>

          <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input
              type="password"
              name="password"
              class="form-control"
              required
            >
          </div>

          <button type="submit" class="btn btn-primary w-100">
            Entrar
          </button>

          <div class="text-center mt-3">
            <a href="{{ url('/Inicio') }}" class="text-decoration-none">
              Volver al inicio
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@include('partials.footer')
