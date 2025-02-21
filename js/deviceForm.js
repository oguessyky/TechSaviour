document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview_deviceForm');
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });

    imagePreview.addEventListener('click', function() {
        const modal = document.createElement('div');
        modal.classList.add('modal-deviceForm');
        const modalContent = document.createElement('img');
        modalContent.classList.add('modal-content-deviceForm');
        modalContent.src = this.src;
        const closeBtn = document.createElement('span');
        closeBtn.classList.add('close-deviceForm');
        closeBtn.innerHTML = '×';
        closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });
        modal.appendChild(modalContent);
        modal.appendChild(closeBtn);
        document.body.appendChild(modal);
        modal.style.display = 'flex';
    });
});