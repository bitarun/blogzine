import Cropper from 'cropperjs';

const input = document.getElementById('avatarInput');
const editBtn = document.getElementById('editAvatarBtn');
const modal = new bootstrap.Modal(document.getElementById('avatarModal'));
const cropperImage = document.getElementById('cropperImage');
const preview = document.getElementById('avatarPreview');
let cropper;

// کلیک روی مداد
editBtn.addEventListener('click', () => input.click());

// انتخاب فایل
input.addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = () => {
        cropperImage.src = reader.result;
        modal.show();

        setTimeout(() => {
            cropper = new Cropper(cropperImage, {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 1,   // 👈 خیلی مهم
                responsive: true,
                background: false,
                zoomable: true,
                movable: true,
            });
        }, 300);
    };
    reader.readAsDataURL(file);
});

// تأیید کراپ
document.getElementById('saveAvatar').addEventListener('click', () => {
    const canvas = cropper.getCroppedCanvas({
        width: 300,
        height: 300,
    });

    canvas.toBlob((blob) => {
        const file = new File([blob], 'avatar.jpg', { type: 'image/jpeg' });

        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);

        input.files = dataTransfer.files;

        preview.src = URL.createObjectURL(blob);

        cropper.destroy();
        modal.hide();
    }, 'image/jpeg');
});
