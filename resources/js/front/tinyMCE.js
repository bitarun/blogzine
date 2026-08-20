import tinymce from 'tinymce/tinymce';

// theme
import 'tinymce/themes/silver';

// icons
import 'tinymce/icons/default';

// plugins
import 'tinymce/models/dom/model';
import 'tinymce/plugins/link';
import 'tinymce/plugins/image';
import 'tinymce/plugins/code';
import 'tinymce/plugins/lists';
import 'tinymce/plugins/table';
import 'tinymce/skins/content/default/content';
import 'tinymce/skins/ui/oxide/content';
import 'tinymce/skins/ui/oxide/skin';

document.addEventListener('DOMContentLoaded', () => {
    if (!document.querySelector('.tinymce')) return;

    tinymce.init({
        selector: '.tinymce',
        height: 400,
        plugins: 'link image code lists table',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',

        license_key: 'gpl'
    });
});
