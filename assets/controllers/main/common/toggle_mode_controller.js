import { Controller } from '@hotwired/stimulus';
import $ from 'jquery';
import Cookie from 'jquery.cookie';

export default class extends Controller {
    static targets = [ "toggleTheme" ]

    connect() {
        const body = document.querySelector('body');
        const toggleModeButton = this.toggleThemeTarget;

        toggleModeButton.addEventListener('click', (event) => {
            body.classList.toggle('dark');

            let className, toggleModeButtonClass;
            if (body.classList.contains('dark')) {
                className = 'dark';
                toggleModeButtonClass = 'fa-toggle-off';
                toggleModeButton.classList.remove('fa-toggle-on');
                toggleModeButton.classList.add('fa-toggle-off');
            } else {
                className = '';
                toggleModeButtonClass = 'fa-toggle-on';
                toggleModeButton.classList.remove('fa-toggle-off')
                toggleModeButton.classList.add('fa-toggle-on')
            }
            $.cookie('THEME_MODE', className, { path: '/' });
            $.cookie('THEME_MODE_TOGGLE', toggleModeButtonClass, { path: '/' });
        })
    }
}
