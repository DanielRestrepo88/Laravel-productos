@include('partials.header', ['title' => 'Productos', 'active' => 'productos'])

<h1 class="mb-4">Productos</h1>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
  <table class="table table-striped table-hover align-middle">
    <thead class="table-dark">
      <tr>
        <th style="width: 90px;">Imagen</th>
        <th>SKU</th>
        <th>Nombre del producto</th>
        <th class="text-end">Stock</th>
        <th class="text-end">Precio</th>
        <th class="text-end">Estado</th>
        <th class="text-center">Acción</th>
      </tr>
    </thead>

    <tbody>
      @forelse($productos as $p)
        <tr>
          <td>
            <img
              src="{{ asset($p->imagen ?? 'imagenes/default.jpg') }}"
              alt="{{ $p->nombre }}"
              style="width:70px;height:70px;object-fit:cover;border-radius:10px;"
              onerror="this.onerror=null;this.src='{{ asset('imagenes/default.jpg') }}';"
            >
          </td>

          <td>{{ $p->sku }}</td>
          <td>{{ $p->nombre }}</td>
          <td class="text-end">{{ $p->stock }}</td>
          <td class="text-end">${{ number_format((float)$p->precio, 0, ',', '.') }}</td>

          <td class="text-end">
            {!! $p->estado ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-secondary">Inactivo</span>' !!}
          </td>

          <td class="text-center">
            <div class="d-flex justify-content-center gap-1 flex-wrap">
              <a href="{{ url('/Productos/' . $p->id) }}" class="btn btn-sm btn-outline-primary">Ver</a>

              <a href="{{ url('/Productos/' . $p->id . '/edit') }}" class="btn btn-sm btn-outline-warning">Editar</a>

              <form
                action="{{ url('/Productos/' . $p->id . '/delete') }}"
                method="POST"
                onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');"
              >
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="7" class="text-center text-body-secondary py-4">
            No hay productos para mostrar.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

{{-- ✅ PAGINACIÓN Bootstrap (sin "Showing..." y sin "Previous/Next" raros) --}}
@if ($productos instanceof \Illuminate\Pagination\AbstractPaginator && $productos->hasPages())
  <nav class="mt-3 d-flex justify-content-center" aria-label="Paginación de productos">
    <ul class="pagination mb-0">

      {{-- Previous --}}
      <li class="page-item {{ $productos->onFirstPage() ? 'disabled' : '' }}">
        <a class="page-link" href="{{ $productos->previousPageUrl() ?? '#' }}" tabindex="-1" aria-disabled="{{ $productos->onFirstPage() ? 'true' : 'false' }}">
          &laquo; Anterior
        </a>
      </li>

      {{-- Números (solo alrededor de la página actual) --}}
      @php
        $current = $productos->currentPage();
        $last = $productos->lastPage();
        $start = max(1, $current - 1);
        $end = min($last, $current + 1);
      @endphp

      @if($start > 1)
        <li class="page-item">
          <a class="page-link" href="{{ $productos->url(1) }}">1</a>
        </li>
        @if($start > 2)
          <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif
      @endif

      @for ($i = $start; $i <= $end; $i++)
        <li class="page-item {{ $i === $current ? 'active' : '' }}">
          <a class="page-link" href="{{ $productos->url($i) }}">{{ $i }}</a>
        </li>
      @endfor

      @if($end < $last)
        @if($end < $last - 1)
          <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif
        <li class="page-item">
          <a class="page-link" href="{{ $productos->url($last) }}">{{ $last }}</a>
        </li>
      @endif

      {{-- Next --}}
      <li class="page-item {{ $productos->hasMorePages() ? '' : 'disabled' }}">
        <a class="page-link" href="{{ $productos->nextPageUrl() ?? '#' }}">
          Siguiente &raquo;
        </a>
      </li>

    </ul>
  </nav>
@endif

@include('partials.footer')
