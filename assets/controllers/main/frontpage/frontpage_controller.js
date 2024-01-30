import {Controller} from '@hotwired/stimulus';
import $ from 'jquery';

export default class extends Controller {
    static targets = [""]

    connect() {
        $('[data-goto-deceased-search-form]').on('click', function (event) {
            let target = $('#deceased_search_form');
            if (target.length) {
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 70
                }, 10);
            }
        });
    }

}










