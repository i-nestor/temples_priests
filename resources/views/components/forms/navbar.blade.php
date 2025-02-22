<nav class="navbar navbar-expand-lg fixed-top bg-chocolate-600">
    <div class="container-fluid contain">

        <button class="navbar-toggler bg-chocolate-300 text-chocolate-200" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="d-lg-flex col-lg-2 justify-content-lg-start mx-auto">
            <a href="/" class="px-4 mx-lg-auto main-logo navbar-brand font-handwritten
                               text-l text-chocolate-300 hover:text-chocolate-200">
                &nbsp; Исторический архив <br /> Борисоглебской епархии
            </a>
        </div>

        <div class="collapse navbar-collapse d-lg-flex" id="navbarCollapse">
            <ul class="navbar-nav col-lg-9 justify-content-lg-center font-handwritten text-xl">
                <li class="px-2 nav-item menuitem">
                     <a class="nav-link" href="/temples">Храмы и монастыри</a>
                </li>
                <li class="px-2 nav-item menuitem">
                     <a class="nav-link" href="/priests">Священнослужители</a>
                </li>
                <li class="px-2 nav-item menuitem">
                     <a class="nav-link" href="/elder-founders">Церковные старосты и ктиторы</a>
                </li>
                <li class="px-2 nav-item menuitem">
                    <a class="nav-link" href="/latest-publications">Последние публикации</a>
                </li>
            </ul>

            @auth
            <div class="d-lg-flex col-lg-3 justify-content-lg-end">
                    <div class="mx-auto flex">
                        <div class="px-2 flex text-xs">
                            <div class="px-2 py-1 nav-item menuitem">
                                <a class="nav-link" href="/admin/temples">Панель управления</a>
                            </div>
                        </div>
                        <form action="/logout" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="mt-1 py-1 px-3 btn btn-outline-exit rounded-pill text-s">
                                Выход
                            </button>
                        </form>
                    </div>
            </div>
            @endauth

        </div>
    </div>
</nav>
