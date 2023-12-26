import { Controller } from '@hotwired/stimulus';
import $ from 'jquery';

export default class extends Controller {
    static targets = [ "closeBtn" ]

    connect() {
        const notification = this.element;
        const closeBtn = this.closeBtnTarget;

        // close notification handler
        closeNotification(closeBtn, notification);

        setTimeout(() => {
            $(notification).fadeOut(1000);
        }, 10000);
    }
}

function closeNotification (closeBtn, notification) {
    $(closeBtn).click(() => {
        $(notification).fadeOut(500);
    })
}
