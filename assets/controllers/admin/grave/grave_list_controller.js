import {Controller} from '@hotwired/stimulus';
import Api from '@Api';
import Routing from '@Routing';
import Modal from '@Modal';
import $ from 'jquery';

import {
    trans, UI_BUTTONS_DETAILS,
    UI_ADMIN_GRAVE_GRAVEYARD, UI_ADMIN_GRAVE_SECTOR, UI_ADMIN_GRAVE_ROW, UI_ADMIN_GRAVE_NUMBER,
    UI_ADMIN_GRAVE_PEOPLE, UI_ADMIN_GRAVE_WITHOUT_PEOPLE
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
                    Api.get(
                        'admin_api_get_grave',
                        {id: id},
                        callback,
                        {
                            id: id,
                        }
                    )
                })
            })
        })
    }

    details(item, params = null) {

        // TITLE
        const title = trans(UI_BUTTONS_DETAILS)

        // BUTTONS
        const buttons = `
            <button class="btn btn-info">
                <a href="${Routing.generate('admin_web_grave_show', {id: params.id})}">
                    ${trans(UI_BUTTONS_DETAILS)}
                </a>
            </button>
        `

        // CONTENT
        let people = `
            <div>
                <hr class="my-3">
                <p class="font-bold text-center">${trans(UI_ADMIN_GRAVE_WITHOUT_PEOPLE)}</p>
            </div>
        `
        if (item.people.length) {
            people = `
                <div>
                    <hr class="my-3">
                    <p class="font-bold">${trans(UI_ADMIN_GRAVE_PEOPLE)}</p>
                </div>
            `
        }
        const content = `

             <div class="grid gap-2 grid-cols-2 lg:grid-cols-4 text-center">
                <div>
                    <p class="mb-1 text-xs uppercase">${trans(UI_ADMIN_GRAVE_GRAVEYARD)}</p>
                    <p class="p-2 rounded-lg bg-neutral-800 dark:bg-white bg-opacity-20 dark:bg-opacity-10">${item.graveyard}</p>
                </div>
                <div>
                    <p class="mb-1 text-xs uppercase">${trans(UI_ADMIN_GRAVE_SECTOR)}</p>
                    <p class="p-2 rounded-lg bg-neutral-800 dark:bg-white bg-opacity-20 dark:bg-opacity-10">${item.sector}</p>
                </div>
                <div>
                    <p class="mb-1 text-xs uppercase">${trans(UI_ADMIN_GRAVE_ROW)}</p>
                    <p class="p-2 rounded-lg bg-neutral-800 dark:bg-white bg-opacity-20 dark:bg-opacity-10">${item.row}</p>
                </div>
                <div>
                    <p class="mb-1 text-xs uppercase">${trans(UI_ADMIN_GRAVE_NUMBER)}</p>
                    <p class="p-2 rounded-lg bg-neutral-800 dark:bg-white bg-opacity-20 dark:bg-opacity-10">${item.number}</p>
                </div>
            </div>
            ${people}
        `

        // SHOW MODAL
        const modal = Modal.getModal(
            title, content, buttons
        )
        document.querySelector('body').appendChild(modal);
        $(modal).fadeIn(250);
    }
}
