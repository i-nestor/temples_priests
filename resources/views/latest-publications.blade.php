@extends('layouts.app')

@section('content')
    <div class="my-5 mx-auto max-width-980">
    <div class="my-4 text-2xl text-chocolate-500">Последние публикации</div>

    @if($temples->isEmpty() && $priests->isEmpty() && $elder_founders->isEmpty())
        <p>Нет публикаций за последний месяц</p>
    @else
        <div class="mt-4 mb-3 text-xl text-chocolate-500">Храмы и монастыри</div>
        <table class="mx-auto rounded-4 border shadow-sm overflow-hidden">
            <tbody class="">
            @foreach($temples as $temple)
                <tr class="text-base no-select">
                    <td class="py-2 px-4">
                        <a href="/temples/{{ $temple->slug }}"
                           class="no-line text-chocolate-400 hover:text-chocolate-700">
                            {{ $temple->name }}
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4 mb-3 text-xl text-chocolate-500">Священнослужители</div>
        <table class="mx-auto rounded-4 border shadow-sm overflow-hidden">
            <tbody class="">
            @foreach($priests as $priest)
                <tr class="text-base no-select">
                    <td class="py-2 px-4">
                        <a href="/priests/{{ $priest->slug }}"
                           class="no-line text-chocolate-400 hover:text-chocolate-700">
                            {{ $priest->firstname }} {{ $priest->secondname }}
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4 mb-3 text-xl text-chocolate-500">Церковные старосты и ктиторы</div>
        <table class="mx-auto rounded-4 border shadow-sm overflow-hidden">
            <tbody class="">
            @foreach($elder_founders as $elder_founder)
                <tr class="text-base no-select">
                    <td class="py-2 px-4">
                        <a href="/priests/{{ $elder_founder->slug }}"
                           class="no-line text-chocolate-400 hover:text-chocolate-700">
                            {{ $elder_founder->firstname }} {{ $elder_founder->secondname }}
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endif
    </div>
@endsection
