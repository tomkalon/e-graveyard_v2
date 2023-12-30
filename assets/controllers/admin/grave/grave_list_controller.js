import {Controller} from '@hotwired/stimulus';
import Api from '@Api';
import Routing from '@Routing';
import Modal from '@Modal';
import $ from 'jquery';

const { getGraveInfo, getGravePeople } = require('./components')

import {
    trans, UI_BUTTONS_SHOW_MORE, UI_GRAVE_DETAILS, UI_GRAVE_ADD_PERSON
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
                    case 'modal-add-person':
                        callback = this.addPerson()
                        break;
                    case 'modal-remove':
                        break;
                }

                button.addEventListener('click', () => {
                    Api.get(
                        'admin_api_get_grave',
                        {id: id},
                        callback
                    )
                })
            })
        })
    }

    details(item, params) {
        // TITLE
        const title = trans(UI_GRAVE_DETAILS)

        // BUTTONS
        const buttons = `
            <button class="btn btn-success">
                <a href="${Routing.generate('admin_web_grave_show', {id: params.id})}">
                    ${trans(UI_BUTTONS_SHOW_MORE)}
                </a>
            </button>
        `
        // CONTENT
        const content = document.createElement('div')
        content.appendChild(getGraveInfo(item.graveyard, item.sector, item.row, item.number))
        content.appendChild(getGravePeople(item.people))

        // SHOW MODAL
        const modal = Modal.getModal(
            title, content, buttons
        )
        document.querySelector('body').appendChild(modal);
        $(modal).fadeIn(250);
    }

    addPerson(item, params) {
        // TITLE
        const title = trans(UI_GRAVE_ADD_PERSON)

        // BUTTONS

        // CONTENT

        // SHOW MODAL

    }
}
