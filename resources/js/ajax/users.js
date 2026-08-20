import {showToast} from './showToast.js';

$(document).ready(function () {

    $('#registerUserForm').on('submit', function (event) {

        let form = $(this);

        event.preventDefault();

        $.ajax({
            url: '/dashboard/users/register/',
            type: 'POST',
            data: form.serialize(),
            success: function (response) {
                showToast(response);
                form[0].reset();
                $('#createUserModal').modal('hide');
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (field, message) {

                        let input = form.find(`[name="${field}"]`);
                        input.after(`<div class="invalid-feedback">${message[0]}</div>`);
                    });
                }
            },
        });
    });

    $(document).on('click', '.edit-user-btn', function () {
        let userID = $(this).data('id');

        $.get('/dashboard/user/' + userID + '/edit', function (data) {

            $('#edit_user_id').val(data.id);
            $('#edit_name').val(data.name);
            $('#edit_email').val(data.email);
            $('#edit_role').val(data.role);

            new bootstrap.Modal(document.getElementById('editUserModal')).show();
        });
    });


    $('#editUserForm').on('submit', function (e) {
        e.preventDefault();

        let id = $('#edit_user_id').val();

        $.ajax({
            url: '/dashboard/user/' + id,
            method: 'PUT',
            data: {

                name: $('#edit_name').val(),
                email: $('#edit_email').val(),
                role: $('#edit_role').val(),
            },
            success: function (response) {
                location.reload();
            },
            error: function (xhr) {
                $('.is-invalid').removeClass('is-invalid');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        $('#edit_' + key)
                            .addClass('is-invalid')
                            .next('.invalid-feedback')
                            .text(value[0]);
                    });
                }
            }
        });
    });

    $('.user-delete-icon').on('click', function (e) {

        let deleteIcon = $(this);
        let userID = deleteIcon.data('id');

        $.ajax({
            url: '/dashboard/user/' + userID,
            method: 'DELETE',
            success: function (response) {
                showToast(response);
                deleteIcon.closest('tr').remove();
            },
            errors: function (xhr) {
            },
        });

    });

});
