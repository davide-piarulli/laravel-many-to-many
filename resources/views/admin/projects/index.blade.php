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

  <!-- card progetti -->
  <div class="card my-4 mx-2">
    <div class="card-header d-flex">

      <div class="col align-content-center h-100 py-3">
        <h2>Progetti</h2>
      </div>

      {{-- Searchbar --}}
      <div class="col align-content-center h-100 py-3">
        <form action="{{ route('admin.projects.index') }}" method="GET" role="search">
          <div class="input-group w-100">
            <input type="search" name="toSearch" class="form-control" placeholder="Cerca progetto...">
            <button type="submit" class="input-group-text">Cerca</button>
          </div>
        </form>
      </div>
      {{-- /Searchbar --}}

      {{-- aggiungi nuovo progetto --}}
      <div class="col d-flex align-content-center justify-content-center h-100 py-3">
        <p>Nuovo Progetto</p>
        <button class="dp-btn btn-primary" type="button" data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
          <i class="fa-solid fa-plus"></i>
        </button>

        <!-- offcanvas aggiunta nuovo progetto -->
        <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
          aria-labelledby="offcanvasWithBothOptionsLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Inserisci un nuovo progetto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">



            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="title" class="form-label">Titolo Progetto (*)</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                      name="title" value="{{ old('title') }}">
                    @error('title')
                      <small class="text-danger">
                        {{ $message }}
                      </small>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="link" class="form-label">Link (*)</label>
                    <input type="text" class="form-control @error('link') is-invalid @enderror" id="link"
                      name="link" value="{{ old('link') }}">
                    @error('link')
                      <small class="text-danger">
                        {{ $message }}
                      </small>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">

                    <label for="type" class="form-label">Tipo</label>
                    <select name="type_id" class="form-select w-50" aria-label="Default select example">

                      <option value="">Seleziona un tipo</option>
                      @foreach ($types as $type)
                        <option value="{{ $type->id }}" @if (old('type_id') == $type->id) selected @endif>
                          {{ $type->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">

                    <label class="form-label">Tecnologia: </label>
                    <div class="btn-group btn-group-sm" role="group">
                      @foreach ($technologies as $technology)
                        <input name="technologies[]" type="checkbox" class="btn-check"
                          id="technology_{{ $technology->id }}" autocomplete="off" value="{{ $technology->id }}">
                        <label class="btn btn-outline-primary"
                          for="technology_{{ $technology->id }}">{{ $technology->name }}</label>
                      @endforeach

                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="img" class="form-label">Immagine</label>
                    <input class="form-control" id="thumb" type="file" name="img" value="{{ old('img') }}"
                      onchange="showImage(event)" placeholder="immagine mancante">
                    <img class="thumb img-thumbnail w-25 my-2" onerror="this.src='/img/noimg.jpg'" id="thumb"
                      {{-- src="{{ asset('storage/' . $project->img) }}" --}}
                      >
                    @error('img')
                      <small class="text-danger">
                        {{ $message }}
                      </small>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="5" value="">{{ old('description') }}</textarea>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Aggiungi</button>
              <button type="reset" class="btn btn-warning">Svuota</button>
            </form>
          </div>
        </div>
        <!-- /offcanvas aggiunta nuovo progetto -->

      </div>
      {{-- /aggiungi nuovo progetto --}}

    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nome Progetto</th>
          <th scope="col">Link</th>
          <th scope="col">Tipo</th>
          <th scope="col">Tecnologia</th>
          <th scope="col">Descrizione</th>
          <th scope="col">Azioni</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($projects as $project)
          <tr>
            <form action="{{ route('admin.projects.update', $project) }}" method="POST"
              id="form-edit-{{ $project->id }}">
              @csrf
              @method('PUT')
              <th>{{ $project->title }}</th>
              <td>{{ $project->link }}</td>
              <td>
                {{ $project->type->name }}
              </td>

              <td>
                @forelse ($project->technologies as $technology)
                  <span class="badge text-bg-primary">{{ $technology->name }}</span>
                @empty
                  <span>Nessuna tecnologia</span>
                @endforelse
              </td>

              <td>{{ $project->description }}</td>
            </form>

            {{-- Actions Show, Edit e Delete --}}
            <td class="icons d-flex ">

              <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-success me-3">
                <i class="fa-solid fa-eye"></i>
              </a>

              <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning me-3">
                <i class="fa-solid fa-pencil"></i>
              </a>

              <form action="{{ route('admin.projects.destroy', $project) }}" method="post"
                onsubmit="return confirm('Sei sicuro di voler eliminare il progetto?')">
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
    <div class="paginator">
      {{ $projects->links() }}
    </div>

  </div>
  <script>
    function showImage(event) {
      const thumb = document.getElementById('thumb');
      thumb.src = URL.createObjectURL(event.target.files[0]);
    }
  </script>
@endsection
