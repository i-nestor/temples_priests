@extends('layouts.app')

@section('content')
<div class="mx-auto max-width-980 my-5 rounded-4 shadow-sm bg-chocolate-200">
    <div class="post-container overflow-hidden">
        <div class="post-header">

            @include('components.forms.back')

            <div class="post-name text-xl text-chocolate-400">
                {{ $priest->firstname }} {{ $priest->secondname }}
            </div>

            @auth
                <form action="/admin/priests/{{ $priest->slug }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button onclick="return confirm('Вы действительно хотите удалить {{ $priest->firstname }} {{ $priest->secondname }}?')"
                            title="Удалить" class="mx-1 p-3 btn btn-outline-danger rounded-pill delete-icon text-base">
                    </button>
                </form>

                <form action="/admin/priests/{{ $priest->slug }}/edit" method="GET">
                    <button title="Редактировать" class="p-3 btn btn-outline-success rounded-pill edit-icon text-base"></button>
                </form>
            @endauth
        </div>

        <img class="max-width-360 rounded-left no-select"
             src="{{ asset('storage/' . $priest->image) }}" alt="{{ $priest->name }}" >

        <div class="post-content text-base text-chocolate-400">
            <p> {!! $priest->biography !!} </p>
        </div>

    </div>
</div>
@endsection
