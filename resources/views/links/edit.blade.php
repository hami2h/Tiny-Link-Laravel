@extends('main')


@section('content')
    <form action="{{ route('update-link', $link->id) }}" method="post">
        @csrf
        @method('put')

        <input type="text" name="url" value="{{ $link->url }}">
        <br>
        <br>
        <x-button class="ml-3">
            Edit Link
        </x-button>

    </form>
@endsection
