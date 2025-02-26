@extends('layouts.app')

@section('content')
    <div class="mt-5 mx-auto max-width-980">
            <div class="space-between no-select">
                <div class="flex">
                    <div class="py-2 text-2xl text-center text-chocolate-500">Панель управления</div>
                    <div class="my-3 px-4 text-green-300"><strong>{{ auth()->user()->name }}</strong></div>
                </div>

                <div class="my-auto">
                    <button type="button" title="Информация" onclick = "info();"
                            class="btn btn-info btn-outline-info rounded-pill text-base bg-chocolate-200">
                        <strong>i</strong>
                    </button>
                </div>
            </div>

            <div class="max-w-full mx-auto space-between no-select">
                <div class="tabs-container input-group rounded-5 border shadow-sm bg-chocolate-200">
                    <div class="my-1 py-2 m-auto">
                        <a href="/admin/temples" class="mx-left-2 px-4 py-2 rounded-5 text-xs no-select no-line text-chocolate-500
                        {{ Request::is('admin/temples') ||
                           Request::is('admin/temples/*') ?
                           'bg-chocolate-300 text-white hover:bg-chocolate-400':
                           'hover:bg-chocolate-400 hover:text-white' }}">
                            Храмы и монастыри
                        </a>
                    </div>
                    <div class="my-1 py-2 m-auto">
                        <a href="/admin/priests" class="mx-2 px-4 py-2 rounded-5 xs no-select no-line text-chocolate-500
                        {{ Request::is('admin/priests') ||
                           Request::is('admin/priests/*') ?
                           'bg-chocolate-300 text-white hover:bg-chocolate-400':
                           'hover:bg-chocolate-400 hover:text-white' }}">
                            Священнослужители
                        </a>
                    </div>
                    <div class="my-1 py-2 m-auto">
                        <a href="/admin/elder-founders" class="mx-right-2 px-4 py-2 rounded-5 xs no-select no-line text-chocolate-500
                        {{ Request::is('admin/elder-founders') ||
                           Request::is('admin/elder-founders/*') ?
                           'bg-chocolate-300 text-white hover:bg-chocolate-400':
                           'hover:bg-chocolate-400 hover:text-white' }}">
                            Церковные старосты и ктиторы
                        </a>
                    </div>
                </div>
            </div>

            <div class="mx-auto">
                @yield('admin-content')
            </div>

    </div>

<script>
    const info = () => { alert('ⓘ Информация о сайте:\n' +
                               '     • версия сайта 0.9.9.3 \n' +
                               '     • версия PHP {{ PHP_VERSION }}\n' +
                               '     • версия Laravel {{ Illuminate\Foundation\Application::VERSION }}\n' +
                               '     • версия Bootstrap 5.3.3'); }
</script>
<script>
    const previewImage = () => {
        let previewImage = document.getElementById('preview-image');
        let inputImage = document.getElementById('image');
        let btnImageLabel = document.getElementById('btn-image-label');
        let btnDeleteLabel = document.getElementById('btn-delete-label');

        let file = inputImage.files[0];
        let fileReader = new FileReader();

        if(file) {
            previewImage.style.display = 'block';
            fileReader.readAsDataURL(file);
            fileReader.onload = (event) => {
                previewImage.src = event.target.result;
            }
            // Меняем название кнопки "Выбрать" и отображаем кнопку "Удалить", если изображение загружено
            btnImageLabel.textContent = 'Заменить'
            btnDeleteLabel.style.display = 'block';
        }
    }
</script>
<script>
    const deleteImage = () => {
        document.getElementById('btn-delete').addEventListener('click', function (event) {
            let btnImageLabel = document.getElementById('btn-image-label');
            let btnDeleteLabel = document.getElementById('btn-delete-label');
            let previewImage = document.getElementById('preview-image');
            let inputImage = document.getElementById('image');

            previewImage.src = "";
            inputImage.value = "";
            previewImage.style.display = 'none';
            btnDeleteLabel.style.display = 'none';
            btnImageLabel.textContent = 'Выбрать'
        });
    }
</script>
<script>
    let btnImageLabel = document.getElementById('btn-image-label');
    let btnDeleteLabel = document.getElementById('btn-delete-label');
    let isImage  = document.getElementById('preview-image').naturalWidth > 0;

    if(isImage ) {
        // Меняем название кнопки "Выбрать" и отображаем кнопку "Удалить", если изображение присутствует
        btnImageLabel.textContent = 'Заменить'
        btnDeleteLabel.style.display = 'block';
    } else {
        btnImageLabel.textContent = 'Выбрать'
        btnDeleteLabel.style.display = 'none';
    }
</script>
@endsection
