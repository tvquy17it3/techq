@extends('layouts.lw')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div style="text-align: center">
            <button wire:click="increment">+</button>
            @foreach ($posts as $post)
                <h1>{{$post->body}}</h1>
            @endforeach
            <button wire:click="decrement">-</button>
        </div>
    </div>
</div>
@endsection