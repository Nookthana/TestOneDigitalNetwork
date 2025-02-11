
window.$ = window.jQuery = require('jquery');   
window.Popper = require('@popperjs/core');             
require('bootstrap');   
require('slick-carousel');
import 'jquery-form';


window.translate = function translate(key) {
    const keys = key.split('.');
    let translation = window.translations;

    for (const k of keys) {
        if (translation[k]) {
            translation = translation[k];
        } else {
            return key; 
        }
    }

    return translation;
};

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body' 
    });
});


