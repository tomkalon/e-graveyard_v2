import {Controller} from '@hotwired/stimulus';
import Api from '@Api';
import Modal from '@Modal';
import Routing from '@Routing';
import HandleItems from "@HandleItems";
import {createGallery} from "@ImageGallery";
import $ from 'jquery'

import {getPerson} from "@View/person/person_view";
import {getPayment} from "@View/payment/payment_view";

export default class extends Controller {
    static targets = ['people', 'payments', 'gallery']
    static values = {
        id: String,
        imagesPath: String,
        thumbsPath: String,
    }
    connect()
    {
        Modal.preLoadModal('grave-modal-add-deceased')

        if (this.hasGalleryTarget) {
            const gallery = this.galleryTarget
            createGallery(gallery, this.idValue, this.imagesPathValue, this.thumbsPathValue)
        }

        if (this.hasPaymentsTarget) {
            const payments = this.paymentsTarget
            const paymentsData = payments.querySelectorAll('[data-item-id]')
            HandleItems.handleItems(paymentsData, this.paymentsActions.bind(this))
        }

        if (this.hasPeopleTarget) {
            const people = this.peopleTarget
            const peopleData = people.querySelectorAll('[data-item-id]')
            HandleItems.handleItems(peopleData, this.peopleActions.bind(this))
        }
    }

    addDeceased(event)
    {
        Modal.getModal('grave-modal-add-deceased')
    }

    addPayment(event)
    {
        Modal.getModal('grave-modal-add-payment')
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

    paymentsActions(button, id, action)
    {
        let callback;
        switch (action) {
            case 'payment-modal-remove':
                callback = this.removePayment
                break
        }
        HandleItems.clickAction(button, id, 'admin_api_payment_grave_get', callback)
    }

    peopleActions(button, id, action)
    {
        let callback;
        switch (action) {
            case 'person-modal-remove':
                callback = this.removePerson
                break
        }
        HandleItems.clickAction(button, id, 'admin_api_person_get', callback)
    }

    removePerson(item, params)
    {
        const content = getPerson(item)
        const modal = Modal.getModal('person-modal-remove', null, content)
        modal.querySelector('[data-person-btn-remove]').addEventListener('click', () => {
            Api.remove(
                'admin_api_person_remove',
                {id: params.id},
                () => location.reload()
            )
        })
    }

    removePayment(item, params)
    {
        const content = getPayment(item)
        const modal = Modal.getModal('payment-modal-remove', null, content)
        modal.querySelector('[data-payment-btn-remove]').addEventListener('click', () => {
            Api.remove(
                'admin_api_payment_grave_remove',
                {id: params.id},
                () => location.reload()
            )
        })
    }
}
