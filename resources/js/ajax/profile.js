import {showToast} from './showToast.js';

$(document).ready(function () {

    /**
     * Clear validation errors from a form
     */
    function clearFormErrors(form) {
        form.find('.invalid-feedback').remove();
        form.find('.is-invalid').removeClass('is-invalid');
    }

    /**
     * Render validation errors (Laravel 422)
     */
    function renderFormErrors(form, errors) {
        $.each(errors, function (field, messages) {

            let input = form.find(`[name="${field}"]`);
            if (!input.length) return;

            input.addClass('is-invalid');

            let group = input.closest('.input-group');
            let feedback = `<div class="invalid-feedback d-block">${messages[0]}</div>`;

            group.length
                ? group.after(feedback)
                : input.after(feedback);
        });
    }

    /**
     * Generic AJAX form handler
     */
    function handleFormSubmit({
                                  formSelector,
                                  on,
                                  url,
                                  method = 'POST',
                                  useFormData = false,
                                  onSuccess = () => {
                                  }
                              }) {
        $(formSelector).on(on, function (e) {

            e.preventDefault();
            let form = $(this);

            clearFormErrors(form);

            let ajaxOptions = {
                url,
                method,
                success: function (response) {
                    onSuccess(response, form);
                    showToast(response);
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        renderFormErrors(form, xhr.responseJSON.errors);
                    }
                }
            };

            if (useFormData) {
                let data = new FormData(this);
                if (method.toUpperCase() !== 'POST') {
                    data.append('_method', method);
                    ajaxOptions.method = 'POST';
                }

                ajaxOptions.data = data;
                ajaxOptions.processData = false;
                ajaxOptions.contentType = false;
            } else {
                ajaxOptions.data = method === 'PUT'
                    ? form.serialize() + '&_method=PUT'
                    : form.serialize();
            }

            $.ajax(ajaxOptions);
        });
    }

    /* ------------------------------------------------------------------
     | Personal profile form
     * ------------------------------------------------------------------ */

    handleFormSubmit({
        formSelector: '#updatePersonalProfileForm',
        on: 'submit',
        url: '/profile/personal',
        method: 'PUT',
        useFormData: true,
        onSuccess: function (response) {
            if (response.avatarFileExists === true) {
                $('#avatarRemoveWrapper').removeClass('d-none');
                $('#main-avatar').attr(
                    /*Since the new avatar file has the same name as the old one,
                      we append '?v=' + Date.now() to the src to bust the browser cache
                      and force it to load the newly uploaded image.*/
                    'src', '/uploads/images/avatars/' + response.avatarSrc + '?v=' + Date.now()
                );
            }
        }
    });

    /* ------------------------------------------------------------------
     | Social links form
     * ------------------------------------------------------------------ */

    handleFormSubmit({
        formSelector: '#updateSocialProfileForm',
        on: 'submit',
        url: '/profile/social-links',
        method: 'PUT'
    });

    handleFormSubmit({
        formSelector: '#updatePasswordProfileForm',
        on: 'submit',
        url: '/profile/password',
        method: 'PUT',
        userFormData: false,
        onSuccess: function (response) {
            window.location.href = response.redirect;
        }
    });

    handleFormSubmit({
        formSelector: '#avatarRemoveButton',
        on: 'click',
        url: '/profile/avatar',
        method: 'DELETE',
        userFormData: false,
        onSuccess: function (response) {

            let preview = $('#avatarPreview');

            $('#avatarInput').val('');
            preview.attr('src', '/uploads/images/avatars/avatar.png');
            $('#updatePersonalProfileForm')[0].reset();


            $('#main-avatar').attr(
                'src', '/uploads/images/avatars/avatar.png'
            );
            preview.attr(
                'src', '/uploads/images/avatars/avatar.png'
            );

            $('#avatarRemoveWrapper').addClass('d-none');
        },
    });

    $('#availabilityCheck').on('change', function () {

        let isChecked = $(this).is(':checked') ? 1 : 0;

        $.ajax({

            url: '/profile/availability',
            method: 'PUT',
            data: {availability: isChecked},
            success: function (response) {
                showToast(response);
            },
        });
    });

});


/*
import {showToast} from './showToast.js';

$(document).ready(function () {

    $('#updatePersonalProfileForm').on('submit', function (e) {

        e.preventDefault();
        let form = $(this);

        form.find('.invalid-feedback').remove();
        form.find('.is-invalid').removeClass('is-invalid');

        const data = new FormData(this);
        data.append('_method', 'PUT');

        $.ajax({
            url: '/profile/personal',
            method: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function (response) {
                /!* Since the new avatar file has the same name as the old one,
                we append '?v=' + Date.now() to the src to bust the browser cache
                and force it to load the newly uploaded image. *!/

                $('#main-avatar').attr('src', '/uploads/images/avatars/' + response.avatarSrc + '?v=' + Date.now());
                showToast(response);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (field, message) {

                        let input = form.find(`[name=${field}]`);
                        input.addClass('is-invalid');
                        input.after(`<div class="invalid-feedback">${message[0]}</div>`);
                    })
                }
            }
        });
    });

    $('#updateSocialProfileForm').on('submit', function (e) {

        e.preventDefault();
        let form = $(this);

        form.find('.invalid-feedback').remove();
        form.find('.is-invalid').removeClass('is-invalid');

        $.ajax({
            url: '/profile/social-links',
            method: 'PUT',
            data: form.serialize(),
            success: function (response) {
                showToast(response);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (field, message) {
                        let input = form.find(`[name=${field}]`);
                        input.addClass('is-invalid');
                        input.after(`<div class="invalid-feedback">${message[0]}</div>`);
                    })
                }
            }
        });
    });
});
*/
