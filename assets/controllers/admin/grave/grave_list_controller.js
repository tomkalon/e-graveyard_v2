import {Controller} from '@hotwired/stimulus';
import $ from 'jquery';
import Api from '@Api';
import Modal from '@Modal';

import {
    trans, UI_BUTTONS_DETAILS
} from '@Translator';
import modal from "@Modal";


export default class extends Controller {

    // TARGETS
    static targets = ['pagination']

    connect() {
        const container = this.element;
        const pagination = this.paginationTarget;
        const items = pagination.querySelectorAll('[data-item-id]')

        this.handleItems(items)
    }

    handleItems(items) {

        // list table rows
        items.forEach((element) => {
            const id = element.getAttribute('data-item-id')
            const buttons = element.querySelectorAll('[data-modal-target]')


            // list row action buttons
            buttons.forEach((button) => {

                const action = button.getAttribute('data-modal-target')
                let callback;

                switch (action) {
                    case 'modal-details':
                        callback = this.details
                        break;
                    case 'modal-edit':
                        break;
                    case 'modal-remove':
                        break;
                }

                button.addEventListener('click', () => {
                    this.clearModals()
                    Api.get('admin_api_get_grave', {id:id}, callback)
                })
            })
        })
    }

    details(item) {
        const title = trans(UI_BUTTONS_DETAILS)
        const modal = Modal.getModal(
            title, 'test', 'buttons'
        )

        const body = document.querySelector('body')
        body.appendChild(modal);
    }

    clearModals() {
        document.querySelectorAll('#js-modal-box').forEach((element) => {
            element.remove()
        })
    }
}
