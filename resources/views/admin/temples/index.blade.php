@extends('admin.layouts.app')

@section('admin-content')

    <div class="mx-auto max-width-980">
        <div class="my-4 items-right-2">
            <a href="/admin/temples/create"
               class="mx-1 px-4 btn btn-outline-success rounded-pill add-icon text-base bg-chocolate-200">&nbsp; Добавить</a>
        </div>

        <nav>
            <div class="input-group">
                <ul class="pagination no-select">
                    <?php $abc1 = array("А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж"); ?>

                    @foreach($abc1 as $value)
                        <li class="page-item" data-mdb-ripple-init>
                            <a class="page-link text-base" href="/admin/temples/?abc={{$value}}">{{$value}}</a>
                        </li>
                    @endforeach
                </ul>
                <ul class="pagination no-select">
                    <?php $abc2 = array("З", "И", "К", "Л", "М", "Н", "О", "П"); ?>

                    @foreach($abc2 as $value)
                        <li class="page-item" data-mdb-ripple-init>
                            <a class="page-link text-base" href="/admin/temples/?abc={{$value}}">{{$value}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="input-group">
                <ul class="pagination no-select">
                    <?php $abc3 = array("Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч"); ?>

                    @foreach($abc3 as $value)
                        <li class="page-item" data-mdb-ripple-init>
                            <a class="page-link text-base" href="/admin/temples/?abc={{$value}}">{{$value}}</a>
                        </li>
                    @endforeach
                </ul>
                <ul class="pagination no-select">
                    <?php $abc4 = array("Ш", "Щ", "Э", "Ю", "Я"); ?>

                    @foreach($abc4 as $value)
                        <li class="page-item" data-mdb-ripple-init>
                            <a class="page-link text-base" href="/admin/temples/?abc={{$value}}">{{$value}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>

        <div class="my-3">
            <form action="/admin/temples" class="input-group">
                <input type="search" name="search" id="search"
                       class="px-4 py-2 form-control rounded-start-5 border text-base text-chocolate-500"
                       placeholder="Поиск храма, монастыря" value="{{ request('search') }}" autofocus>
                <button class="btn btn-search-chocolate px-4 py-2 rounded-end-5 text-base" data-mdb-ripple-init>
                    Поиск
                </button>
            </form>
        </div>

        <div>
            <div class="">
                <div class="">
                    <div class="py-2">
                        @if(session('success'))
                            <div class="text-center bg-chocolate-200 shadow-sm rounded-5 px-4 py-2 border border-green-600 mb-5">
                                <span class="text-green-600 text-xl">&#9888; {{ session('success') }}</span>
                            </div>
                        @endif

                        @if($temples->count())
                            <div class="">
                                <table class="mx-auto rounded-4 border shadow-sm overflow-hidden">
                                    <thead>
                                    <tr class="">
                                        <th scope="col"
                                            class="text-base">
                                            &#10022;
                                        </th>
                                        <th scope="col"
                                            class="text-base">
                                            Название
                                        </th>
                                        <th scope="col"
                                            class="text-base">
                                            Создано
                                        </th>
                                        <th scope="col"
                                            class="text-base">
                                            Изменено
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-chocolate-400">
                                    @foreach($temples as $temple)
                                        <tr>
                                            <td class="text-xs">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="text-xs">
                                                <a href="/admin/temples/{{ $temple->slug }}"
                                                   class="no-line text-chocolate-400 hover:text-chocolate-700">
                                                    {{ $temple->name }}
                                                </a>
                                            </td>
                                            <td class="text-xs">
                                                {{ $temple->created_at->format('d.m.Y H:i') }}
                                            </td>
                                            <td class="text-xs">
                                                {{ $temple->updated_at->format('d.m.Y H:i') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="mt-4 mb-4 px-4 text-center rounded-5 shadow-sm bg-chocolate-200 border border-red-600 ">
                                <p class="my-2 text-xl text-red-600">
                                    &#9888; Храм или монастырь соответствующий запросу не найден
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="my-4 text-base no-select">
            {{ $temples->links('pagination::bootstrap-5') }}
        </div>
        <br />

    </div>

@endsection
