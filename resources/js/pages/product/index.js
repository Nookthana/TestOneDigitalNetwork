window.$ = require('jquery');
import axios from 'axios';

$(function () {
    
    $(document).on('click', '.click-card', function (event) {
        alert(
            'Product Name: ' + $(this).data('product-name') + '\n' +
            'Product SKU: ' + $(this).data('sku') + '\n' +
            'Product Price: ' + $(this).data('product-price')
        );
    }); 

    $(document).ready(function() {
        $('.unique-main-image-container').slick({
            dots: false,
            infinite: true,
            speed: 500,
            slideWidth: 450, 
            slideHeight: 281, 
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: true,
            prevArrow: $('.unique-prev-button'),
            nextArrow: $('.unique-next-button'),
        });
    
        $('.unique-mini-image-container').slick({
            dots: false,
            infinite: true,
            variableWidth: false,
            speed: 500,
            slideWidth: 68, 
            slideHeight: 46, 
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: false,
            arrows: false,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 4,
                    },
                },
            ],
        });
    
        $('.unique-product-mini-images img').each(function(index) {
            $(this).attr('data-index', index); 
        });
    
        $('.unique-product-mini-images img').click(function() {
            var index = $(this).data('index'); 
            $('.unique-main-image-container').slick('slickGoTo', index);
        });
    });
});