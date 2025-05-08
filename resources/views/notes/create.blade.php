@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Note') }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('notes.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Title</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="title">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Body</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                    name="body"></textarea>
                            </div>

                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-3">Crea</button>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Immagine</label>
                                <input type="file" class="form-control" id="exampleFormControlInput1" name="image">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection