import {Controller} from '@hotwired/stimulus';
import Api from '@Api';
import Modal from '@Modal';
import HandleItems from "@HandleItems";
import $ from "jquery";

export default class extends Controller {

    // TARGETS
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
            case 'user-modal-remove':
                callback = this.remove
                break;
        }
        HandleItems.clickAction(button, id, 'admin_api_user_get', callback)
    }

    remove(item, params)
    {
        const name = 'user-modal-remove'

    }
}
