@extends('layouts.admin')
@section('content')

  {{-- stampo box con errori relativi ai campi --}}
  @if ($errors->any())
    <div class="alert alert-danger" role="alert">
      <ul>
        @foreach ($errors->all() as $error)
          <li>
            {{ $error }}
          </li>
        @endforeach
      </ul>
    </div>
  @endif

  @if (session('error'))
    <div class="alert alert-danger" role="alert">
      {{ session('error') }}
    </div>
  @endif

  @if (session('success'))
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>
  @endif

  <!-- card tipi -->
  <div class="card my-4 mx-2">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <h2>Tecnologie</h2>
        </div>
        <div class="col">
          <div>
            <a class="btn btn-success m-3" href="{{ route('admin.technologies.create') }}">Aggiungi tecnologia</a>
          </div>
        </div>
      </div>


    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nome</th>
          <th scope="col">Azioni</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($technologies as $technology)
          <tr>
            <td>{{ $technology->id }}</td>
            <td>
              <form action="{{ route('admin.technologies.update', $technology) }}" method="POST"
                id="form-edit-{{ $technology->id }}">
                @csrf
                @method('PUT')
                <input type="text" value="{{ $technology->name }}" name="name">
              </form>
            </td>

            <td class="icons d-flex ">
              <a href="{{ route('admin.technologies.edit', $technology) }}" class="btn btn-warning me-3">
                <i class="fa-solid fa-pencil"></i>
              </a>

              <form action="{{ route('admin.technologies.destroy', $technology) }}" method="post"
                onsubmit="return confirm('Sei sicuro di voler eliminare la tecnologia?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                  <i class="fa-solid fa-trash-can"></i>
                </button>
              </form>

            </td>
          </tr>
        @endforeach

      </tbody>
    </table>
    {{-- <div class="paginator">
      {{ $type->links() }}

    </div> --}}

  </div>
  <script>
    function submitForm(id) {
      const form = document.getElementById(`form-edit-${id}`);
      form.submit();
    }
  </script>
@endsection
