@extends('layouts.template')

@section('title', 'Genres')

@section('main')
    <h1>Genres</h1>
    @include('shared.alert')
    <p>
        <a href="/admin/genres/create" class="btn btn-outline-success">
            <i class="fas fa-plus-circle mr-1"></i>Create new genre
        </a>
    </p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Genre</th>
                <th>Records for this genre</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($genres as $genre)
                <tr>
                    <td>{{ $genre->id }}</td>
                    <td>{{ $genre->name }}</td>
                    <td>{{ $genre->records_count }}</td>
                    <td>
                        <form action="/admin/genres/{{ $genre->id }}" method="post">
                            @method('delete')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="/admin/genres/{{ $genre->id }}/edit" class="btn btn-outline-success"
                                   data-toggle="tooltip"
                                   title="Edit {{ $genre->name }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-outline-danger deleteGenre"
                                        data-toggle="tooltip"
                                        data-records="{{ $genre->records_count }}"
                                        data-genre="{{ $genre->name }}"
                                        title="Delete {{ $genre->name }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('script_after')
    <script>
        $('.deleteGenre').click(function () {
            const records = $(this).data('records');
            const genre = $(this).data('genre');
            let msg = `Delete ${genre}?`;
            if (records > 0) {
                msg += `\nThe ${records} ${genre} records will also be deleted!`
            }
            if (confirm(msg)) {
                $(this).closest('form').submit();
            }
        })
    </script>
@endsection
