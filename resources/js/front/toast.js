/*
const toastElList = document.getElementById('toast');

const toastList = new bootstrap.Toast(toastElList);

toastList.show();
*/

document.addEventListener('DOMContentLoaded', () => {
    const toastEl = document.getElementById('toast');

    if (!toastEl) return;

    const toast = new bootstrap.Toast(toastEl);
    toast.show();
});
