@extends('layouts.app')

@section('content')
    <div class="mx-auto max-width-980 my-5 rounded-4 shadow-sm bg-chocolate-200">
        <div class="post-container overflow-hidden">
            <div class="header-post">

                @include('components.forms.back')

                <div class="header-name">
                    <h1 class="text-xl">{{ $elder_founder->firstname }} {{ $elder_founder->secondname }}</h1>
                </div>

                @auth
                    <form action="/admin/elder-founders/{{ $elder_founder->slug }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button onclick="return confirm('Вы действительно хотите удалить человека?')"
                                title="Удалить" class="mx-1 p-3 btn btn-outline-danger rounded-pill delete-icon text-base">
                        </button>
                    </form>

                    <form action="/admin/elder-founders/{{ $elder_founder->slug }}/edit" method="GET">
                        <button title="Редактировать" class="p-3 btn btn-outline-success rounded-pill edit-icon text-base"></button>
                    </form>
                @endauth
            </div>

            <img class="max-width-384 rounded-left no-select"
                 src="{{ asset('storage/' . $elder_founder->image) }}" alt="{{ $elder_founder->name }}" >

            <div class="biography pt-0 pb-5 px-5 py-5 text-base text-chocolate-400">
                <p> {!! $elder_founder->biography !!} </p>
            </div>

        </div>
    </div>
@endsection
