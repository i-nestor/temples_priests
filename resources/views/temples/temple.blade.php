@extends('layouts.app')

@section('content')
<div class="mx-auto max-width-980 my-5 rounded-4 shadow-sm bg-chocolate-200">
    <div class="post-container overflow-hidden">
        <div class="post-header">

            @include('components.forms.back')

            <div class="post-name text-xl text-chocolate-400">
                {{ $temple->name }}
            </div>

            @auth
                <form action="/admin/temples/{{ $temple->slug }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button onclick="return confirm('Вы действительно хотите удалить {{ $temple->name }}?')"
                            title="Удалить" class="mx-1 p-3 btn btn-outline-danger rounded-pill delete-icon text-base">
                    </button>
                </form>

                <form action="/admin/temples/{{ $temple->slug }}/edit" method="GET">
                    <button title="Редактировать" class="p-3 btn btn-outline-success rounded-pill edit-icon text-base"></button>
                </form>
            @endauth

        </div>

        <img class="img-fluid no-select"
             src="{{ asset('storage/' . $temple->image) }}" alt="{{ $temple->name }}" >

        <div class="post-content text-base text-chocolate-400">
             <p> &nbsp; {!! $temple->description !!}</p>
        </div>

    </div>
</div>
@endsection
