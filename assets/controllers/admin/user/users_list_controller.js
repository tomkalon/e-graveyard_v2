import {Controller} from '@hotwired/stimulus';
import Api from '@Api';
import Modal from '@Modal';
import HandleItems from "@HandleItems";

import { getUser} from "@View/user/user_view";
import $ from "jquery";

export default class extends Controller {
    static targets = ['pagination']

    connect()
    {
        const container = this.element;

        if (this.hasPaginationTarget) {
            const pagination = this.paginationTarget;
            const items = pagination.querySelectorAll('[data-item-id]')
            HandleItems.handleItems(items, this.userActions.bind(this))
        }
    }

    userActions(button, id, action)
    {
        let callback, options;
        switch (action) {
            case 'user-modal-permission':
                callback = this.changePermission
                break;
            case 'user-modal-reset-password':
                callback = this.resetPassword
                break;
            case 'user-modal-remove':
                callback = this.remove
                break;
        }
        HandleItems.clickAction(button, id, 'admin_api_user_get', callback)
    }

    changePermission(item, params)
    {
        const userFormID = document.querySelector('#change_role_id')
        userFormID.value = params.id
        const name = 'user-modal-permission'
        const content = getUser(item)
        const modal = Modal.getModal(name, content, null)
    }

    resetPassword(item, params)
    {
        const name = 'user-modal-reset-password'
        const content = getUser(item)
        const modal = Modal.getModal(name, null, content)
        modal.querySelector('[data-user-btn-reset-password]').addEventListener('click', () => {
            Api.put(
                'admin_api_user_reset_password',
                {id:  btoa(params.id)},
                () => location.reload()
            )
        })
    }

    remove(item, params)
    {
        const name = 'user-modal-remove'
        const content = getUser(item)
        const modal = Modal.getModal(name, null, content)
        modal.querySelector('[data-user-btn-remove]').addEventListener('click', () => {
            Api.remove(
                'admin_api_user_remove',
                {id: params.id},
                () => location.reload()
            )
        })
    }
}
