import {Controller} from '@hotwired/stimulus';
import $ from 'jquery';
import Routing from '@Routing'

export default class extends Controller {
    static targets = [""]

    connect() {
        const container = this.element;

        let items = container.querySelectorAll('[data-href-target]')
        items.forEach(item => {
            const id = item.getAttribute('data-href-target')
            $(item).parent('tr').on('click', () => {
                const hrefTarget = item.dataset.hrefTarget;
                window.location.href = Routing.generate('main_web_frontpage_show', {id: hrefTarget})
            });
        });
    }
}
