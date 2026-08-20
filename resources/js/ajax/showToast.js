export function showToast(response) {
    let toastContent = `<div class="toast text-bg-${response['type']} mb-3" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body d-flex justify-content-between">
                    ${response['message']}
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>`;

    $('#toastContainer').append(toastContent);
    let toastEL = $('#toastContainer .toast').last()[0];
    let toast = new bootstrap.Toast(toastEL);
    toast.show();
}
