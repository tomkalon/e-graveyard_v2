import './bootstrap.js';

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import './styles/nav.scss';
import './styles/input.scss';

// tailwind plugin
import 'tw-elements'

// icons
import 'fontawesome-4.7'

// prevents the form from being resubmitted
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
