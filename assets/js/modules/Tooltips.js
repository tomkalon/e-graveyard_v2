import $ from "jquery";
import tippy from 'tippy.js';
import 'tippy.js/animations/scale.css';
import 'tippy.js/themes/material.css';

const gemmaTooltips = () => {
    const tooltips = document.querySelectorAll('[gemma-tooltip]')
    tooltips.forEach((element) => {
        let label = element.getAttribute('gemma-tooltip-label')
        let direction = element.getAttribute('gemma-tooltip')

        tippy(element, {
            content: label,
            animation: 'scale',
            theme: 'material',
            placement: direction
        })
    })
}

export {gemmaTooltips}
