import Swiper from 'swiper';

document.addEventListener('DOMContentLoaded', () => {

    const slidesCount = document.querySelectorAll('.swiper-slide').length;
    if (document.querySelector('.swiper')) {
        new Swiper('.swiper', {
            slidesOffsetAfter: 2.2,
            slidesOffsetBefore: 2.2,
            slidesPerView: 1.3,
            spaceBetween: 20,
            loop: false,
            breakpoints: {
                768: {
                    slidesPerView: 2.3,
                }
            }
        });
    }

    if (document.querySelector('.swiper-cats')) {
        new Swiper('.swiper-cats', {
            slidesOffsetAfter: 0,
            slidesOffsetBefore: 0,
            slidesPerView: 2.3,
            spaceBetween: 10,
            loop: true,
            breakpoints: {
                768: {
                    slidesPerView: 6,
                }
            }
        });
    }

});
