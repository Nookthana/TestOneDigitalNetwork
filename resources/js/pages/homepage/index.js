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
});