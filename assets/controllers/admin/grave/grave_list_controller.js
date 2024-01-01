import {Controller} from '@hotwired/stimulus';
import Api from '@Api';
import Routing from '@Routing';
import Modal from '@Modal';
import $ from 'jquery';

import {
    trans,
    UI_BUTTONS_SHOW_MORE,
    UI_BUTTONS_REMOVE,
    UI_GRAVE_DETAILS,
    UI_GRAVE_ADD_DECEASED,
    UI_GRAVE_REMOVE
} from '@Translator';

import {getGraveDetails, getGraveQuestionRemove} from "./components";


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
                let callback, options;
                switch (action) {
                    case 'modal-details':
                        callback = this.show
                        break;
                    case 'modal-remove':
                        callback = this.remove
                        break;
                }

                button.addEventListener('click', () => {
                    Api.get(
                        'admin_api_grave_get',
                        {id: id},
                        callback
                    )
                })
            })
        })
    }

    show(item, params) {
        const title = trans(UI_GRAVE_DETAILS)
        const buttons = `
            <button class="btn btn-success">
                <i class="fa fa-user-plus" aria-hidden="true"></i>
                ${trans(UI_GRAVE_ADD_DECEASED)}
            </button>
            <a href="${Routing.generate('admin_web_grave_show', {id: params.id})}">
                <button class="btn btn-info">
                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                    ${trans(UI_GRAVE_DETAILS)}
                </button>
            </a>
        `
        const content = getGraveDetails(
            item.graveyard,
            item.sector,
            item.row,
            item.number,
            item.people
        )

        Modal.getModal(
            title, content, buttons
        )
    }

    remove(item, params) {
        const title = trans(UI_GRAVE_REMOVE)

        const buttons = document.createElement('div')
        buttons.innerHTML = `
            <button class="btn btn-danger" data-grave-remove>
                <i class="fa fa-trash" aria-hidden="true"></i>
                ${trans(UI_BUTTONS_REMOVE)}
            </button>
        `
        buttons.querySelector('[data-grave-remove]').addEventListener('click', (event) => {
            console.log(event.target)
            Api.remove(
                'admin_api_grave_remove',
                {id:params.id},
                (data, params) => {
                    location.reload()
                }
            )
        })

        const content = getGraveDetails(
            item.graveyard,
            item.sector,
            item.row,
            item.number,
            item.people
        )

        content.insertBefore(getGraveQuestionRemove(), content.firstChild)

        Modal.getModal(
            title, content, buttons
        )
    }

    domParser (data) {
        const div = document.createElement('div')
        div.innerHTML = data
        return div
    }
}
