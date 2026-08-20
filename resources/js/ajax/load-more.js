document.addEventListener("DOMContentLoaded", () => {

    let offset = 6;
        let loading = false;
        let finished = false;
        let articleContainer = $('#article-container');

        function loadMore() {

            if (loading || finished) return;
            loading = true;
            $('#loading').removeClass('d-none');

            $.ajax({

                url: '/archive/' + categoryEnName + '/load',
                method: 'GET',
                data: {offset: offset},
                success: function (response) {

                    if (response.data.length > 0) {

                        let $newItems = $();

                        response.data.forEach(function (article) {

                            let row = `<div class="col-sm-6 col-lg-4 grid-item covid-category">
                        <div class="card mb-4">
                            <!-- Card img -->
                            <div class="card-fold position-relative">
                                <img class="card-img" src="${article.thumbnails}" alt="Card image">
                            </div>
                            <div class="card-body px-0 pt-3">
                                <h4 class="card-title">${article.title}<a href="#" class="btn-link text-reset"></a></h4>
                                <p class="card-text">${article.description}</p>
                                <!-- Card info -->
                                <ul class="nav nav-divider align-items-center text-uppercase small">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link text-reset btn-link">${article.author.name}</a>
                                    </li>
                                    <li class="nav-item">${article.created_at}</li>
                                </ul>
                            </div>
                            </div>
                        </div>`;

                            $newItems = $newItems.add($(row));

                        });

                        articleContainer.append($newItems);
                        articleContainer.isotope('appended', $newItems);
                        articleContainer.isotope('layout');

                        offset += response.data.length;

                        loading = false;

                    } else {
                        finished = true;
                        $('#loading').addClass('d-none');
                    }
                },
                error: function (xhr) {
                    $('#loading').addClass('d-none');
                    loading = false;
                }
            });
        }

        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 500) {

                console.log(categoryEnName);

                loadMore();
            }
        });

});
