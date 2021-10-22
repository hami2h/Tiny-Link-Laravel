@extends('main')


@section('content')
    <form action="{{ route('store-link') }}" method="post">
        @csrf
        <input type="text" name="url">
        <br>
        <br>
        <x-button class="ml-3">
            Submit Link
        </x-button>

    </form>
@endsection
