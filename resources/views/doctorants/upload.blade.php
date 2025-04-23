@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Importer des Doctorants</h1>

        <form action="{{ route('doctorants.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Choisir un fichier Excel :</label>
                <input type="file" name="file" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Importer</button>
        </form>
    </div>
@endsection
