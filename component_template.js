class ClassNameComponent {
    constructor($element) {
        this.$element = $element;
        this.setData();
        this.setDependencies();
        this.init();
    }

    init() {
        this.bindEvents();
        this.$element.data('instance', this)
    }

    setDependencies() {
    }

    setData() {
    }

    bindEvents() {
    }
}

function initializePostComponents() {
    $('.component_name').each(function() {
        var $element = $(this);
        if (!$element.data('initialized')) {
            new ClassNameComponent($element);
            $element.data('initialized', true); // Mark as initialized
        }
    });
}

// Initialize components on DOMContentLoaded
$(document).ready(initializePostComponents);
