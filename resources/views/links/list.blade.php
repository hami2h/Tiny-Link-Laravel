@extends('main')


@section('content')

    <table class="table" border="collapse" id="links-table">
        <thead>
            <tr>
                <td>#</td>
                @unless(Auth::user()->type == 'user')
                    <td>User</td>
                @endunless
                <td>Links</td>
                <td>Slug</td>
                <td>Status</td>
                <td>Operator</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($links as $link)
                <tr>
                    <td>{{ $link->id }}</td>
                    @unless(Auth::user()->type == 'user')
                        <td>{{ $link->user_id }}</td>
                    @endunless
                    <td>{{ $link->url }}</td>
                    <td>{{ $link->slug }}</td>
                    @php
                        if ($link->active == 0) {
                            echo "<td style='background:rgb(255, 116, 116)'>";
                        } else {
                            echo "<td style='background:rgb(131, 245, 131)'>";
                        }

                        echo $link->active == 0 ? 'Disable' : 'Active';
                        echo '</td>';
                    @endphp
                    <td>
                        @can('edit', $link)

                            <a href="{{ route('edit-link', $link->id) }}">Edit</a>
                        @endcan

                        @can('remove', $link)

                            <a href="{{ route('remove-link', $link->id) }}">Remove</a>
                        @endcan


                        @can('changeState', $link)
                            <a href="{{ route('cs-link', $link->id) }}">Change State</a>
                        @endcan

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
