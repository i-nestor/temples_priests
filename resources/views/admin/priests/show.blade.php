@extends('admin.layouts.app')

@section('admin-content')
    <div class="mx-auto max-width-980 my-5 rounded-4 shadow-sm bg-chocolate-200">
        <div class="post-container overflow-hidden">
            <div class="header-post">

                <form action="/admin/priests" method="GET">
                    <button title="Назад"
                            class="p-3 m-auto btn btn-outline-chocolate rounded-pill back-icon text-base">
                    </button>
                </form>

                <?php $lastWeek = Illuminate\Support\Carbon::now()->copy()->subWeek(); ?>
                @if($priest->updated_at >= $lastWeek)
                    <div class="header-name text-xl text-green-300">{{ $priest->firstname }} {{ $priest->secondname }}</div>
                @else
                    <div class="header-name text-xl text-chocolate-400">{{ $priest->firstname }} {{ $priest->secondname }}</div>
                @endif

                <form action="/admin/priests/{{ $priest->slug }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button onclick="return confirm('Вы действительно хотите удалить {{ $priest->name }}?')"
                            title="Удалить" class="mx-1 p-3 btn btn-outline-danger rounded-pill delete-icon text-base">
                    </button>
                </form>

{{--                <a href="/admin/priests/{{ $priest->slug }}/edit"--}}
{{--                   title="Редактировать" class="p-3 btn btn-outline-success rounded-pill edit-icon text-xs">--}}
{{--                </a>--}}

                <form action="/admin/priests/{{ $priest->slug }}/edit" method="GET">
                    <button title="Редактировать" class="p-3 btn btn-outline-success rounded-pill edit-icon text-base"></button>
                </form>
            </div>

            <img class="max-width-384 rounded-left no-select"
                 src="{{ asset('storage/' . $priest->image) }}" alt="{{ $priest->name }}" >

            <div class="biography pt-0 pb-5 px-5 py-5 text-base text-chocolate-400">
                <p> {!! $priest->biography !!} </p>
            </div>

        </div>

    </div>
@endsection
