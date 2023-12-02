import { startStimulusApp } from '@symfony/stimulus-bridge';
import Dropdown from 'stimulus-dropdown';

// Registers Stimulus controllers from controllers.json and in the controllers/ directory
export const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.[jt]sx?$/
));
// register any custom, 3rd party controllers here
app.register('dropdown', Dropdown);
// app.register('some_controller_name', SomeImportedController);
