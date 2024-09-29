import {Controller} from '@hotwired/stimulus';
import Api from '@Api';
import Modal from '@Modal';
import HandleItems from "@HandleItems";
import {FilterSwitch} from "@FilterSwitch";

import {getPerson} from "@View/person/person_view";
import $ from "jquery";

export default class extends Controller {
    static targets = ['pagination', 'filterContainer', 'toggleFilter']

    connect() {
        if (this.hasPaginationTarget) {
            const pagination = this.paginationTarget;
            const items = pagination.querySelectorAll('[data-item-id]')
            HandleItems.handleItems(items, this.personActions.bind(this))
        }

        if (this.hasToggleFilterTarget && this.hasFilterContainerTarget) {
            FilterSwitch(this.toggleFilterTarget, this.filterContainerTarget, 'ADMIN_PEOPLE_LIST_TOGGLE_FILTER_STATUS')
        }
    }

    personActions(button, id, action) {
        let callback;
        switch (action) {
            case 'person-modal-remove':
                callback = this.remove
                break;
        }
        HandleItems.clickAction(button, id, 'admin_api_person_get', callback)
    }

    remove(item, params) {
        const name = 'person-modal-remove'
        const content = getPerson(item)
        const modal = Modal.getModal(name, null, content)
        modal.querySelector('[data-person-btn-remove]').addEventListener('click', () => {
            Api.remove('admin_api_person_remove', {id: params.id}, () => location.reload())
        })
    }
}
