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
          <h2>Tipi</h2>
        </div>
        <div class="col">
          <div>
            <a class="btn btn-success m-3" href="{{ route('admin.types.create') }}">Aggiungi tipo</a>
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

        @foreach ($types as $type)
          <tr>
            <td>{{ $type->id }}</td>
            <td>
              <form action="{{ route('admin.types.update', $type) }}" method="POST" id="form-edit-{{ $type->id }}">
                @csrf
                @method('PUT')
                <input type="text" value="{{ $type->name }}" name="name">
              </form>
            </td>

            <td class="icons d-flex ">
              <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-warning">
                <i class="fa-solid fa-pencil"></i>
              </a>

              <form action="{{ route('admin.types.destroy', $type) }}" method="post"
                onsubmit="return confirm('Sei sicuro di voler eliminare il tipo?')">
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
