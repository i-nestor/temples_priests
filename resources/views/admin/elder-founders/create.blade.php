@extends('admin.layouts.app')

@section('admin-content')
    <div class="mx-auto max-width-980 my-5 p-4 rounded-4 shadow-sm bg-chocolate-200">
        <h1 class="text-3xl mb-4 text-green-600">Добавление старосты/ктитора</h1>
        <div class="min-h-full">
            <div class="">
                <form action="/admin/elder-founders" method="POST"
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
                            <label for="firstname" class="mb-2 text-base text-chocolate-600">
                                Имя
                            </label>
                            <input id="firstname" name="firstname" type="text" autocomplete="firstname"
                                   class="container-fluid px-4 py-2 block rounded-pill
                                          text-base border text-chocolate-500 border-chocolate-300 bg-chocolate-100"
                                   value="{{ old('firstname') }}" autofocus>
                            @error('firstname')
                            <small class="my-2 block text-base text-red-600">{{ $message }} </small>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="secondname" class="mb-2 text-base text-chocolate-600">
                                Фамилия
                            </label>
                            <input id="secondname" name="secondname" type="text" autocomplete="secondname"
                                   class="container-fluid px-4 py-2 block rounded-pill
                                          text-base border text-chocolate-500 border-chocolate-300 bg-chocolate-100"
                                   value="{{ old('secondname') }}" autofocus>
                            @error('secondname')
                            <small class="my-2 block text-base text-red-600">{{ $message }} </small>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="slug" class="mb-2 text-base text-chocolate-600">Слаг</label>
                            <input id="slug" name="slug" type="text" readonly autocomplete="slug"
                                   class="container-fluid px-4 py-2 block rounded-pill
                                          text-base border text-chocolate-500 border-chocolate-300 bg-chocolate-disabled"
                                   placeholder="Автоматическое создание слаг после того, как Вы заполните поле с фамилией"
                                   value="{{ old('slug')}}">
                            @error('slug')
                            <small class="my-2 block text-red-600 ">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="">
                        <label for="description" class="mt-4 mb-2 block text-base text-chocolate-600">
                            Биография
                        </label>
                        <textarea id="description" type="hidden" name="biography"
                                  value="{{ old('biography') }}">
                        </textarea>

                        @error('biography')
                        <small class="my-2 text-base block text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="my-4 input-group items-right-2">
                        <a href="/admin/elder-founders"
                           class="m-1 px-4 btn btn-outline-danger rounded-pill cancel-icon text-base">&nbsp; Отмена</a>
                        <button type="submit" class="m-1 px-4 btn btn-outline-success rounded-pill add-icon text-base">&nbsp; Добавить</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script> {{-- Для автоматического заплнения slug --}}
        const name = document.getElementById('secondname');
        const slug = document.getElementById('slug');

        name.addEventListener('change', async function () {
            const res = await fetch(`/admin/elder-founders/slug?${
                new URLSearchParams({secondname: this.value}).toString()}`);
            const data = await res.json();
            slug.value = data.slug;
        });
    </script>

    <script>
        function validateForm() {
            const name = document.getElementById('firstname').value;
            const shortname = document.getElementById('secondname').value;
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
