@extends('admin.layouts.app')

@section('admin-content')
    <div class="mx-auto max-width-980 my-5 p-4 rounded-4 shadow-sm bg-chocolate-200">
        <h1 class="text-3xl mb-4 text-green-600">Добавление храма (монастыря)</h1>
        <div class="min-h-full">
            <div class="max-w-full">
                <form action="/admin/temples" method="POST"
                      onsubmit="return validateForm()" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="max-w-lg">
                        <div class="mb-2 text-base text-chocolate-600">Фото</div>
                        <div class="image-group">
                            <img id="preview-image" src="" alt="" class="rounded-2 img-fluid border overflow-hidden display-none">
                            <input id="btn-delete" name="btn-delete" type="button" class="display-none" onclick = "deleteImage();">
                            <input id="image" name="image" type="file" accept="image/*" class="display-none" onchange = "previewImage();">

                            <div class="input-group">
                                <label for="btn-delete" id="btn-delete-label"
                                       class="m-2 px-4 btn btn-outline-danger rounded-pill cancel-icon text-base display-none">
                                    &nbsp;Удалить
                                </label>
                                <label for="image" id="btn-image-label"
                                       class="m-2 px-left-5 px-right-4 btn btn-outline-info rounded-pill upload-icon text-base">
                                    Выбрать
                                </label>
                            </div>

                        </div>
                        @error('image')
                            <small class="my-2 text-base text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="">
                        <div class="mb-2">
                            <label for="name" class="mb-2 text-base text-chocolate-600">
                                Название
                            </label>
                            <input id="name" name="name" type="text" autocomplete="name"
                                   class="container-fluid px-4 py-2 block rounded-pill
                                          text-base border text-chocolate-500 border-chocolate-300 bg-chocolate-100"
                                   value="{{ old('name') }}" autofocus>
                            @error('name')
                                <small class="my-2 block text-base text-red-600">{{ $message }} </small>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="shortname" class="mb-2 text-base text-chocolate-600">
                                Короткое название
                            </label>
                            <input id="shortname" name="shortname" type="text" autocomplete="shortname"
                                   class="container-fluid px-4 py-2 block rounded-pill
                                          text-base border text-chocolate-500 border-chocolate-300 bg-chocolate-100"
                                   placeholder="Необходимо для поиска по каталогу"
                                   value="{{ old('shortname') }}" autofocus>
                            @error('shortname')
                                <small class="my-2 block text-base text-red-600">{{ $message }} </small>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="slug" class="mb-2 text-base text-chocolate-600">Слаг</label>
                            <input id="slug" name="slug" type="text" readonly autocomplete="slug"
                                   class="container-fluid px-4 py-2 block rounded-pill
                                          text-base border text-chocolate-500 border-chocolate-300 bg-chocolate-disabled"
                                   placeholder="Автоматическое создание слаг после того, как Вы заполните поле с названием"
                                   value="{{ old('slug')}}">
                            @error('slug')
                                <small class="my-2 block text-red-600 ">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="">
                        <label for="description" class="mt-4 mb-2 block text-base text-chocolate-600">
                            Описание
                        </label>
                        <textarea id="description" type="hidden" name="description"
                                  value="{{ old('description') }}">
                        </textarea>

                        @error('description')
                            <small class="my-2 text-base block text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="my-4 input-group items-right-2">
                        <a href="/admin/temples"
                           class="m-1 px-4 btn btn-outline-danger rounded-pill cancel-icon text-base">&nbsp; Отмена</a>
                        <button type="submit" class="m-1 px-4 btn btn-outline-success rounded-pill add-icon text-base">&nbsp; Добавить</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script> // Для автоматического заплнения slug
        const name = document.getElementById('name');
        const slug = document.getElementById('slug');

        name.addEventListener('change', async function () {
            const res = await fetch(`/admin/temples/slug?${
                new URLSearchParams({name: this.value}).toString()}`);
            const data = await res.json();
            slug.value = data.slug;
        });
    </script>

    <script>
        function validateForm() {
            const name = document.getElementById('name').value;
            const shortname = document.getElementById('shortname').value;
            const description = document.getElementById('description').value;

            if (name && shortname && description) {
                return true; // Форма отправляется
            } else {
                alert('Пожалуйста, заполните все поля!');
                return false; // Форма не отправляется
            }
        }
    </script>

@endsection
