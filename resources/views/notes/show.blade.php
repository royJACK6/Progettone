@extends('layouts.app')

@section('content')

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Test</th>
        <th scope="col">Body</th>
        <th scope="col">User</th>
        <th scope="col">Create</th>
        <th scope="col">updated</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>{{$note->id}}</th>
        <td>{{$note->title}}</td>
        <td>{{$note->body}}</td>
        <td>{{$note->user->name}}</td>
        <td>{{$note->created_at}}</td>
        <td>{{$note->updated_at}}</td>
      </tr>
    </tbody>
  </table>
  <div class="d-flex justify-content-between mt-4">
    <a href="{{ route('notes.index') }}" class="btn btn-primary">Indietro</a>
    <div>
        <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-secondary me-2">Modifica</a>
        
        <!-- Bottone Delete separato -->
        <form action="{{ route('notes.destroy', $note->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Sei sicuro di voler eliminare questa nota?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Elimina</button>
  @endsection