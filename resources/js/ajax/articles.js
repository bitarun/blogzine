import { showToast } from './showToast.js';
$(document).ready(function () {

    $('.article-status-icon').change(function () {

        let articleID = $(this).data('id');
        let articleStatus = $(this).is(':checked') ? 'published' : 'pending';

        $.ajax({
            url: '/dashboard/article/' + articleID + '/status',
            type: 'PUT',
            data: {
                status: articleStatus,
            },
            success: function (response) {
                showToast(response);
            },
            error: function (error) {
                showToast(error);
            }
        });
    });

    $('.delete-article-icon').on('click', function (event) {

        event.preventDefault();
        let articleID = $(this).data('id');
        let deleteIcon = $(this);

        $.ajax({
            url: '/dashboard/article/' + articleID,
            type: 'DELETE',
            beforeSend: function () {
                deleteIcon.find('.bi-trash').remove();
                deleteIcon.find('.spinner-border').removeClass('d-none');
            },
            success: function (response) {
                showToast(response);
                deleteIcon.closest('tr').remove();
            },
            error: function (error) {
                showToast(error);
            },
        });
    });
});
