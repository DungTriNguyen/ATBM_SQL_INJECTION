const checkboxes = document.querySelectorAll('.form-check-input');
const inputs = document.querySelectorAll('.form-control');

checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
        const target = document.querySelector(checkbox.dataset.target);
        if (checkbox.checked) {
            target.classList.remove('d-none');
        } else {
            target.classList.add('d-none');
        }
    });
});
$(document).ready(function() {
    $('#category').change(function() {
        const selectedCategory = $(this).val();
        if (selectedCategory === 'none'){
            $('#form-quan-ao').addClass('d-none');
            $('#form-tui-xach').addClass('d-none');
        }
        if (selectedCategory === 'quan-ao') {
            $('#form-quan-ao').removeClass('d-none');
            $('#form-tui-xach').addClass('d-none');
        } else if (selectedCategory === 'tui-xach') {
            $('#form-quan-ao').addClass('d-none');
            $('#form-tui-xach').removeClass('d-none');
        }
    });

    // Load hình ảnh
    $('#inputFileB , #inputFileC').change(function() {
        const files = $(this)[0].files;
        if (files.length > 0) {
            const imagePreview = $('#imagePreviewC, #imagePreviewB');
            imagePreview.empty();

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = $('<img>').attr('src', e.target.result).addClass('img-thumbnail');
                    imagePreview.append(img);
                };
                reader.readAsDataURL(file);
            }
        }
    });
});