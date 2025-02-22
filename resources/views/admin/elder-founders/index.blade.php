@extends('admin.layouts.app')

@section('admin-content')
    <div class="mx-auto max-width-980">

        <div class="my-2 items-right-2">
            <a href="/admin/elder-founders/create"
               class="px-4 btn btn-outline-success rounded-pill add-icon text-base bg-chocolate-200">&nbsp; Добавить</a>
        </div>

        <nav>
            <div class="input-group">
                <ul class="pagination no-select">
                    <?php $abc1 = array("А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж"); ?>

                    @foreach($abc1 as $value)
                        <li class="page-item" data-mdb-ripple-init>
                            <a class="page-link text-base" href="/admin/elder-founders/?abc={{$value}}">{{$value}}</a>
                        </li>
                    @endforeach
                </ul>
                <ul class="pagination no-select">
                    <?php $abc2 = array("З", "И", "К", "Л", "М", "Н", "О", "П"); ?>

                    @foreach($abc2 as $value)
                        <li class="page-item" data-mdb-ripple-init>
                            <a class="page-link text-base" href="/admin/elder-founders/?abc={{$value}}">{{$value}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="input-group">
                <ul class="pagination no-select">
                    <?php $abc3 = array("Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч"); ?>

                    @foreach($abc3 as $value)
                        <li class="page-item" data-mdb-ripple-init>
                            <a class="page-link text-base" href="/admin/elder-founders/?abc={{$value}}">{{$value}}</a>
                        </li>
                    @endforeach
                </ul>
                <ul class="pagination no-select">
                    <?php $abc4 = array("Ш", "Щ", "Э", "Ю", "Я"); ?>

                    @foreach($abc4 as $value)
                        <li class="page-item" data-mdb-ripple-init>
                            <a class="page-link text-base" href="/admin/elder-founders/?abc={{$value}}">{{$value}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>

        <div class="my-3">
            <form action="/admin/elder-founders" class="input-group">
                <input type="search" name="search" id="search"
                       class="px-4 py-2 form-control rounded-start-5 border text-base text-chocolate-500"
                       placeholder="Поиск старосты, ктитора" value="{{ request('search') }}" autofocus>
                <button class="btn btn-search-chocolate px-4 py-2 rounded-end-5 text-base" data-mdb-ripple-init>
                    Поиск
                </button>
            </form>
        </div>

            <div class="">
                <div class="">
                    <div class="py-2">
                        @if(session('success'))
                            <div class="px-4 py-2 text-center bg-chocolate-200 rounded-5 border shadow-sm mb-5">
                                <span class="text-green-300 text-xl">&#9888; {{ session('success') }}</span>
                            </div>
                        @endif

                        <?php $lastWeek = Illuminate\Support\Carbon::now()->copy()->subWeek(); ?>
                        @if($elder_founders->count())
                            <div class="">
                                <table class="mx-auto rounded-4 border shadow-sm overflow-hidden">
                                    <thead>
                                    <tr class="no-select">
                                        <th class="th-start text-base">
                                            &#10022;
                                        </th>
                                        <th class="th text-base">
                                            Название
                                        </th>
                                        <th class="th-end text-base">
                                            Изменено
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-chocolate-400">
                                    @foreach($elder_founders as $elder_founder)
                                        @if($elder_founder->updated_at >= $lastWeek)
                                            <tr class="text-green-300 hover:text-green-400">
                                        @else
                                            <tr class="text-chocolate-400 hover:text-chocolate-700">
                                        @endif
                                                <td class="td-start text-xs">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="td text-xs">
                                                    @if($elder_founder->updated_at >= $lastWeek)
                                                        <a href="/admin/elder-founders/{{ $elder_founder->slug }}"
                                                           class="text-green-300 hover:text-green-400 no-line">
                                                            {{ $elder_founder->firstname }} {{ $elder_founder->secondname }}
                                                        </a>
                                                    @else
                                                        <a href="/admin/elder-founders/{{ $elder_founder->slug }}"
                                                           class="text-chocolate-400 hover:text-chocolate-600 no-line">
                                                            {{ $elder_founder->firstname }} {{ $elder_founder->secondname }}
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="td-end text-xs">
                                                    {{ $elder_founder->updated_at->format('d.m.Y H:i') }}
                                                </td>
                                            </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="mt-4 mb-4 px-4 text-center rounded-5 shadow-sm bg-chocolate-200 border">
                                <p class="my-2 text-xl text-red-600">
                                    &#9888; Человек соответствующий запросу не найден
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        <div class="my-4 text-base no-select">
            {{ $elder_founders->links('pagination::bootstrap-5') }}
        </div>
        <br />
    </div>

@endsection
