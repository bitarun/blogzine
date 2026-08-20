$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content'),
    }
});

import './ajax/load-more.js';
import './ajax/showToast.js';
import './ajax/articles.js';
import './ajax/users.js';
import './ajax/profile.js';
