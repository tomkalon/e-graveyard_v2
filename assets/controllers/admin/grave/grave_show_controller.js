import {Controller} from '@hotwired/stimulus';
import Api from '@Api';
import Modal from '@Modal';
import Routing from '@Routing';

import {getPerson} from "@View/person/person_view";

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

    addPayment(event)
    {
        const name = 'grave-modal-add-payment'
        const modal = Modal.getModal(name)
    }

    removeGrave({params})
    {
        const name = 'grave-modal-remove'
        const modal = Modal.getModal(name)
        modal.querySelector('[data-grave-btn-remove]').addEventListener('click', () => {
            Api.remove(
                'admin_api_grave_remove',
                {id: params.id},
                () => location.replace(Routing.generate('admin_web_grave_index'))
            )
        })
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
                        callback = this.removePerson
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

    removePerson(item, params)
    {
        const name = 'person-modal-remove'
        const content = getPerson(item)
        const modal = Modal.getModal(name, null, content)
        modal.querySelector('[data-person-btn-remove]').addEventListener('click', () => {
            Api.remove(
                'admin_api_person_remove',
                {id: params.id},
                () => location.reload()
            )
        })
    }
}
