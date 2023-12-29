import {Controller} from '@hotwired/stimulus';
import $ from 'jquery';
import Api from '@Api';
import Modal from '@Modal';

import {
    trans, UI_BUTTONS_DETAILS
} from '@Translator';


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
                    Api.get('admin_api_get_grave', {id:id}, callback)
                })
            })
        })
    }

    details(item) {
        const modal = Modal.create(
            'modal', trans(UI_BUTTONS_DETAILS), 'test', 'buttons'
        )

        console.log(modal)

        // const modal = document.querySelector('#modal-details')
        // const modalTitle = modal.querySelector('#modal-details-title')
        // const modalBody = modal.querySelector('#modal-details-body')
        // const modalButtons = modal.querySelector('#modal-details-buttons')
        // const modalClose = modal.querySelector('[data-te-modal-dismiss]')
        //
        //
        //
        // modalTitle.innerHTML = trans(UI_BUTTONS_DETAILS)
        // modalBody.innerHTML = `${item['graveyard']} - ${item['sector']} / ${item['row']} / ${item['number']}`
    }
}
