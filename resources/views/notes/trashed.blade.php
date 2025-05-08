@extends('layouts.app')

@section('content')

  @if (session('success'))
    <div class="alert alert-success">
    {{ session('success') }}
    </div>
  @endif
  @if (session('warning'))
    <div class="alert alert-warning">
    {{ session('warning') }}
    </div>
  @endif
  <table class="table">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Test</th>
      <th scope="col">Body</th>
      <th scope="col">Create</th>
      <th scope="col">updated</th>
      <th scope="col">Azioni</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($notes as $note)
    <tr>
      <th scope="row">{{$note->id}}</th>
      <td><a href="{{route('notes.show', $note->id)}}">{{$note->title}}</a></td>
      <td>{{$note->body}}</td>
      <td>{{$note->created_at}}</td>
      <td>{{$note->updated_at}}</td>
      <td>
        <div class="col-auto">
          <form action="{{ route('notes.restore', $note->id) }}" method="POST" style="display: inline;">
            @csrf
          @method('PUT')
            <button type="submit" class="btn btn-primary mb-3">Ripristina</button>
          </form>
        </div>
      </td>
    </tr>
    @endforeach
    </tbody>
  </table>
  {{ $notes->links() }}
@endsection