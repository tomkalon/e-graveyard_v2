import { Controller } from '@hotwired/stimulus';
import Api from '../../../bundles/Api.js'

export default class extends Controller {
    static targets = [ "toggleTheme" ]

    connect() {
        this.toggleThemeTarget.addEventListener('click', (event) => {
            Api.put('main_api_common_toggle_theme');
        })
    }

    toggleTheme() {

    }
}
