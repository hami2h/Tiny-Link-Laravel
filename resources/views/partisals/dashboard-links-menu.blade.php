<a href="{{ route('links') }}">لینک ها</a>

@can('create', \App\Link::class)
    <a href="{{ route('create-link') }}">ثبت لینک</a>
@endcan
