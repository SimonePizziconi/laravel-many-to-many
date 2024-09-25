@extends('layouts.app')

@section('content')
    <div class="p-3">
        <h1>Benvenuto {{ Auth::user()->name }}</h1>
        <p>Nel tuo DB ci sono {{ $n_project }} progetti</p>
    </div>
@endsection
