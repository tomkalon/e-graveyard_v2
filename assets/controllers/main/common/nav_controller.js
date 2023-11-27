import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = [ "toggleTheme" ]

    connect() {
        const body = document.querySelector('body');
        const toggleModeButton = this.toggleThemeTarget;

        toggleModeButton.addEventListener('click', (event) => {
            body.classList.toggle('dark');

            let className;
            if (body.classList.contains('dark')) {
                className = 'dark';
                toggleModeButton.classList.remove('fa-toggle-on');
                toggleModeButton.classList.add('fa-toggle-off');
            } else {
                className = undefined;
                toggleModeButton.classList.remove('fa-toggle-off')
                toggleModeButton.classList.add('fa-toggle-on')
            }
            localStorage.setItem('themeMode', className);
        })
    }

    toggleTheme() {

    }
}
