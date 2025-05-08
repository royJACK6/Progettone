@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Note') }}</div>

                <div class="card-body">
                        <form method="POST" action="{{ route('notes.update', $note->id) }}">
                            @csrf
                            @method('PUT')
                        
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $note->title }}" required>
                            </div>
                        
                            <div class="mb-3">
                                <label for="body" class="form-label">Body</label>
                                <textarea class="form-control" id="body" name="body" rows="3" required>{{ $note->body }}</textarea>
                            </div>
                        
                            <button type="submit" class="btn btn-primary">Nota Modificata</button>
                        </form>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


