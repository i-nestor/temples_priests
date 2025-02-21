@extends('layouts.app')

@section('content')
    <div class="my-5 mx-auto max-width-980">
        <div class="my-4 text-2xl text-chocolate-500">Церковные старосты и ктиторы</div>
        <nav>
            <div class="input-group">
                <ul class="pagination no-select">
                    <?php $abc1 = array("А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж"); ?>

                    @foreach($abc1 as $value)
                        <li class="page-item" data-mdb-ripple-init>
                            <a class="page-link text-base" href="/elder-founders/?abc={{$value}}">{{$value}}</a>
                        </li>
                    @endforeach
                </ul>
                <ul class="pagination no-select">
                    <?php $abc2 = array("З", "И", "К", "Л", "М", "Н", "О", "П"); ?>

                    @foreach($abc2 as $value)
                        <li class="page-item" data-mdb-ripple-init>
                            <a class="page-link text-base" href="/elder-founders/?abc={{$value}}">{{$value}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="input-group">
                <ul class="pagination no-select">
                    <?php $abc3 = array("Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч"); ?>

                    @foreach($abc3 as $value)
                        <li class="page-item" data-mdb-ripple-init>
                            <a class="page-link text-base" href="/elder-founders/?abc={{$value}}">{{$value}}</a>
                        </li>
                    @endforeach
                </ul>
                <ul class="pagination no-select">
                    <?php $abc4 = array("Ш", "Щ", "Э", "Ю", "Я"); ?>

                    @foreach($abc4 as $value)
                        <li class="page-item" data-mdb-ripple-init>
                            <a class="page-link text-base" href="/elder-founders/?abc={{$value}}">{{$value}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>

        <div class="my-3">
            <form action="/elder-founders" class="input-group">
                <input type="search" name="search" id="search"
                       class="px-4 py-2 form-control rounded-start-5 border text-base text-chocolate-500"
                       placeholder="Поиск старосты, ктитора" value="{{ request('search') }}" autofocus/>
                <button class="btn btn-search-chocolate px-4 py-2 rounded-end-5 text-base" data-mdb-ripple-init>
                    Поиск
                </button>
            </form>
        </div>

        <div class="my-4">
            @if($elder_founders->count())
                <div class="">
                    <table class="mx-auto rounded-4 border shadow-sm overflow-hidden">
                        <tbody class="">
                        @foreach($elder_founders as $elder_founder)
                            <tr class="text-base no-select">
                                <td class="py-2 px-4">
                                    <a href="/elder-founders/{{ $elder_founder->slug }}"
                                       class="no-line text-chocolate-400 hover:text-chocolate-700">
                                        {{ $elder_founder->firstname }} {{ $elder_founder->secondname }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            @else
                <div class="mt-4 mb-4 px-4 text-center rounded-5 shadow-sm bg-chocolate-200 border border-red-600 ">
                    <p class="my-2 text-xl text-red-600">
                        &#9888; Человек соответствующий запросу не найден
                    </p>
                </div>
            @endif

            <div class="my-4 text-base no-select">
                {{ $elder_founders->links('pagination::bootstrap-5') }}
            </div>
            <br />

        </div>
    </div>
@endsection

