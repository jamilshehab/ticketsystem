
const fileInput = document.getElementById('image');
const previewContainer = document.getElementById('preview-container');

fileInput.addEventListener('change', function(event) {
    const files = event.target.files;

    // Clear any existing previews
    previewContainer.innerHTML = '';

    Array.from(files).forEach(file => {
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'mt-4 w-20 h-20 rounded object-cover';
                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(file);
        }
    });
});