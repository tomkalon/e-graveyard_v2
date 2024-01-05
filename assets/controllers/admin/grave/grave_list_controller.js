import {Controller} from '@hotwired/stimulus';
import Api from '@Api';
import Routing from '@Routing';
import Modal from '@Modal';
import $ from 'jquery';

import {
    trans, UI_GRAVE_DETAILS, UI_GRAVE_ADD_DECEASED, UI_BUTTONS_REMOVE
} from '@Translator';

import {getGraveDetails} from "./components";

export default class extends Controller {

    // TARGETS
    static targets = ['pagination']

    connect()
    {
        const container = this.element;
        const pagination = this.paginationTarget;
        const items = pagination.querySelectorAll('[data-item-id]')

        this.handleItems(items)
    }

    handleItems(items)
    {

        // list table rows
        items.forEach((element) => {
            const id = element.getAttribute('data-item-id')
            const buttons = element.querySelectorAll('[data-modal-target]')

            // list row action buttons
            buttons.forEach((button) => {
                const action = button.getAttribute('data-modal-target')
                let callback, options;
                switch (action) {
                    case 'grave-modal-details':
                        callback = this.show
                        break;
                    case 'grave-modal-add-deceased':
                        callback = this.addDeceased
                        break;
                    case 'grave-modal-remove':
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

    show(item, params)
    {
        const name = 'grave-modal-details'
        const content = getGraveDetails(item.graveyard, item.sector, item.row, item.number, item.people)
        const modal = Modal.getModal(name, content)
        modal.querySelector('[data-grave-btn-details]').setAttribute('href', Routing.generate('admin_web_grave_show', {id: params.id}))
    }

    addDeceased(item, params)
    {
        const name = 'grave-modal-add-deceased'
        const modal = Modal.getModal(name)
    }

    remove(item, params)
    {
        const name = 'grave-modal-remove'
        const content = getGraveDetails(item.graveyard, item.sector, item.row, item.number, item.people)
        const modal = Modal.getModal(name, content)
        modal.querySelector('[data-grave-btn-remove]').addEventListener('click', () => {
            Api.remove(
                'admin_api_grave_remove',
                {id: params.id},
                () => location.reload()
            )
        })
    }
}
