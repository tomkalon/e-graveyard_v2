import {Controller} from '@hotwired/stimulus';

import Api from '@Api';
import Routing from '@Routing';
import Modal from '@Modal';
import HandleItems from "@HandleItems";
import {FilterSwitch} from "@FilterSwitch";

import {getGraveDetails} from "@View/grave/grave_view";

export default class extends Controller {
    static targets = ['pagination', 'filterContainer', 'toggleFilter']

    connect()
    {
        const container = this.element;

        Modal.preLoadModal('grave-modal-add-deceased')

        if (this.hasPaginationTarget) {
            const pagination = this.paginationTarget
            const items = pagination.querySelectorAll('[data-item-id]')
            HandleItems.handleItems(items, this.paginationActions.bind(this))
        }

        if (this.hasToggleFilterTarget && this.hasFilterContainerTarget) {
            FilterSwitch(this.toggleFilterTarget, this.filterContainerTarget)
        }
    }

    paginationActions(button, id, action)
    {
        let callback, options;
        switch (action) {
            case 'grave-modal-details':
                callback = this.show.bind(this)
                break;
            case 'grave-modal-remove':
                callback = this.remove
                break;
        }
        HandleItems.clickAction(button, id, 'admin_api_grave_get', callback)
    }

    show(item, params)
    {
        const name = 'grave-modal-details'
        const content = getGraveDetails(item)
        const modal = Modal.getModal(name, content)
        modal.querySelector('[data-grave-btn-details]').setAttribute('href', Routing.generate('admin_web_grave_show', {id: params.id}))
        modal.querySelector('[data-grave-btn-add-deceased]').addEventListener('click', () => {
            Modal.closeDialog(modal, 100)
            setTimeout(() => {
                Api.get(
                    'admin_api_grave_get',
                    {id: params.id},
                    this.addDeceased
                )
            }, 100)
        })
    }

    addDeceased(item, params)
    {
        const name = 'grave-modal-add-deceased'
        const modal = Modal.getModal(name)
        const form = modal.querySelector('[data-form="add-deceased"]')
        const personGrave = form.querySelector('[data-select-person-grave]')
        personGrave.value = params.id
    }

    remove(item, params)
    {
        const name = 'grave-modal-remove'
        const content = getGraveDetails(item)
        const modal = Modal.getModal(name, null, content)
        modal.querySelector('[data-grave-btn-remove]').addEventListener('click', () => {
            Api.remove(
                'admin_api_grave_remove',
                {id: params.id},
                () => location.reload()
            )
        })
    }
}
