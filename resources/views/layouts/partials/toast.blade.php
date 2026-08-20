@php
    $toast = session('toast');
@endphp

<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="toast"
         class="toast align-items-center text-bg-{{ $toast['type'] }} border-0"
         role="alert"
         aria-live="assertive"
         aria-atomic="true">

        <div class="d-flex">
            <div class="toast-body">
                {{ $toast['message'] }}
            </div>
            <button type="button"
                    class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast">
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastEl = document.getElementById('toast');

        if (toastEl) {
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
    });

</script>
