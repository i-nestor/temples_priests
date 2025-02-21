    <script src="{{ asset('resources/tinymce/tinymce.min.js') }}"></script>

    <script>
        tinymce.init({
            selector: 'textarea#description',
            plugins: 'table lists charmap link autolink image media textcolor searchreplace print fullscreen autoresize wordcount',
            skin: 'chocolate',
            toolbar_mode: 'floating',
            menubar: false,
            toolbar1: 'undo redo | print searchreplace | charmap link table image media | fullscreen',
            toolbar2: 'bold italic underline | forecolor backcolor removeformat | numlist bullist blockquote',
            contextmenu: 'bold italic underline | forecolor backcolor | link',
            'custom_undo_redo_levels': 12,
            language: 'ru'
        });
    </script>
