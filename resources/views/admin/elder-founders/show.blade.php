@extends('admin.layouts.app')

@section('admin-content')
    <div class="mx-auto max-width-980 my-5 rounded-4 shadow-sm bg-chocolate-200">
        <div class="post-container overflow-hidden">
            <div class="header-post">

                <form action="/admin/elder-founders" method="GET">
                    <button title="Назад"
                            class="p-3 m-auto btn btn-outline-chocolate rounded-pill back-icon text-base">
                    </button>
                </form>

                <?php $lastWeek = Illuminate\Support\Carbon::now()->copy()->subWeek(); ?>
                @if($elder_founder->updated_at >= $lastWeek)
                    <div class="header-name text-xl text-green-300">{{ $elder_founder->firstname }} {{ $elder_founder->secondname }}</div>
                @else
                    <div class="header-name text-xl text-chocolate-400">{{ $elder_founder->firstname }} {{ $elder_founder->secondname }}</div>
                @endif

                <form action="/admin/elder-founders/{{ $elder_founder->slug }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button onclick="return confirm('Вы действительно хотите удалить {{ $elder_founder->name }}?')"
                            title="Удалить" class="mx-1 p-3 btn btn-outline-danger rounded-pill delete-icon text-base">
                    </button>
                </form>

                <form action="/admin/elder-founders/{{ $elder_founder->slug }}/edit" method="GET">
                    <button title="Редактировать" class="p-3 btn btn-outline-success rounded-pill edit-icon text-base"></button>
                </form>
            </div>

            <img class="max-width-384 rounded-left no-select" src="{{ asset('storage/' . $elder_founder->image) }}" alt="" >

            <div class="biography pt-0 pb-5 px-5 py-5 text-base text-chocolate-400">
                <p> {!! $elder_founder->biography !!} </p>
            </div>

        </div>

    </div>
@endsection

