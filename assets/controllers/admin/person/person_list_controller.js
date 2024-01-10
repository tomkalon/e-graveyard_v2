import {Controller} from '@hotwired/stimulus';
import Api from '@Api';
import Modal from '@Modal';
import HandleItems from "@HandleItems";

import { getPerson} from "@View/person/person_view";

export default class extends Controller {

    // TARGETS
    static targets = ['pagination']

    connect()
    {
        const container = this.element;
        const pagination = this.paginationTarget;
        const items = pagination.querySelectorAll('[data-item-id]')

        HandleItems.handleItems(items, this.personActions.bind(this))
    }

    personActions(button, id, action) {
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
