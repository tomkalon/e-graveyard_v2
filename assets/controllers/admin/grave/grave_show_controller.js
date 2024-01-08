import {Controller} from '@hotwired/stimulus';
import Api from '@Api';
import Modal from '@Modal';

import {getPerson} from "./components";

export default class extends Controller {

    // TARGETS
    static targets = ['people']

    connect()
    {
        const container = this.element;
        const people = this.peopleTarget;
        const items = people.querySelectorAll('[data-item-id]')

        this.handleItems(items)
    }

    addDeceased(event)
    {
        const name = 'grave-modal-add-deceased'
        const modal = Modal.getModal(name)
    }

    handleItems(items)
    {
        // list table actions cells
        items.forEach((element) => {
            const id = element.getAttribute('data-item-id')
            const buttons = element.querySelectorAll('[data-modal-target]')

            // list table action buttons
            buttons.forEach((button) => {
                const action = button.getAttribute('data-modal-target')
                let callback, options;
                switch (action) {
                    case 'person-modal-remove':
                        callback = this.remove
                        break;
                }

                button.addEventListener('click', () => {
                    Api.get(
                        'admin_api_person_get',
                        {id: id},
                        callback,
                        options
                    )
                })
            })
        })
    }

    remove(item, params)
    {
        const name = 'person-modal-remove'
        const content = getPerson(item)
        const modal = Modal.getModal(name, content)
        modal.querySelector('[data-person-btn-remove]').addEventListener('click', () => {
            Api.remove(
                'admin_api_person_remove',
                {id: params.id},
                () => location.reload()
            )
        })
    }
}
