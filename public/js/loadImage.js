document.getElementById('file-input').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const previewImage = document.getElementById('preview-image');
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';

            // Скрываем кнопку, если изображение загружено
            const fileLabel = document.getElementById('file-label');
            fileLabel.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
});
