import {Controller} from '@hotwired/stimulus';
import Api from '@Api';
import Modal from '@Modal';
import Routing from '@Routing';
import HandleItems from "@HandleItems";

import {getPerson} from "@View/person/person_view";
import {getPayment} from "@View/payment/payment_view";

export default class extends Controller {

    // TARGETS
    static targets = ['people', 'payments']

    connect() {
        const container = this.element;
        const people = this.peopleTarget;
        const payments = this.paymentsTarget;

        const peopleData = people.querySelectorAll('[data-item-id]')
        const paymentsData = payments.querySelectorAll('[data-item-id]')

        HandleItems.handleItems(peopleData, this.peopleActions.bind(this))
        HandleItems.handleItems(paymentsData, this.paymentsActions.bind(this))
    }

    addDeceased(event) {
        const name = 'grave-modal-add-deceased'
        const modal = Modal.getModal(name)
    }

    addPayment(event) {
        const name = 'grave-modal-add-payment'
        const modal = Modal.getModal(name)
    }

    removeGrave({params}) {
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

    paymentsActions(button, id, action) {
        let callback, options;
        switch (action) {
            case 'payment-modal-remove':
                callback = this.removePayment
                button.addEventListener('click', () => {
                    Api.get(
                        'admin_api_payment_grave_get',
                        {id: id},
                        callback,
                        options
                    )
                })
                break
        }
    }

    peopleActions(button, id, action) {
        let callback, options;
        switch (action) {
            case 'person-modal-remove':
                callback = this.removePerson
                button.addEventListener('click', () => {
                    Api.get(
                        'admin_api_person_get',
                        {id: id},
                        callback,
                        options
                    )
                })
                break
        }
    }

    removePerson(item, params) {
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

    removePayment(item, params) {
        console.log(item)
        const name = 'payment-modal-remove'
        const content = getPayment(item)
        const modal = Modal.getModal(name, null, content)
        modal.querySelector('[data-payment-btn-remove]').addEventListener('click', () => {
            Api.remove(
                'admin_api_payment_grave_remove',
                {id: params.id},
                () => location.reload()
            )
        })
    }
}
