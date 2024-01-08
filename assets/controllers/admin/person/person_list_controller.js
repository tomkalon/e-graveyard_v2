import {Controller} from '@hotwired/stimulus';
import Api from '@Api';
import Routing from '@Routing';
import Modal from '@Modal';

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
        const modal = Modal.getModal(name)
        console.log(item)

    }
}
