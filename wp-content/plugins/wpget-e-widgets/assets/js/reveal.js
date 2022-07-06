/*@see https://developers.elementor.com/add-javascript-to-elementor-widgets/
Note. Docs are incorrect.
The Class definition needs to be inside the handler for 'elementor/frontend/init' or
elementorModules.frontend.handlers.Base does not exist yet.
 */
;((w, $) => {
    $(w).on('elementor/frontend/init', () => {
        class RevealButtonHandler extends elementorModules.frontend.handlers.Base {
            constructor(props) {
                super(props);
                this.collapseClass = 'collapsed';
            }

            getDefaultSettings() {
                return {
                    selectors: {
                        button: '.wpg_button_reveal__button .elementor-button',
                        content: '.wpg_button_reveal__content',
                    },
                };
            }

            getDefaultElements() {
                const selectors = this.getSettings('selectors');
                return {
                    $button: this.$element.find(selectors.button),
                    $content: this.$element.find(selectors.content),
                };
            }

            bindEvents() {
                this.elements.$button.on('click', (e) => {
                    this.handleButtonClick(e)
                });
            }

            handleButtonClick(e) {
                e.preventDefault();
                const {$content }  = this.elements;
                const $element = this.$element;

                //Set height and transition to none
                $content.css('height', '').css('transition', 'none');
                //Get starting calculated height
                const startHeight = window.getComputedStyle($content[0]).height;
                //Toggle collapse class to force layout calculation
                $element.toggleClass(this.collapseClass);
                const height = window.getComputedStyle($content[0]).height;
                // Set the start height to begin the transition
                $content.css('height', startHeight);

                requestAnimationFrame(()=>{
                    $content.css('transition', '');
                    requestAnimationFrame(() => {
                        $content.css('height', height);
                    })
                })

                // Clear the saved height values after the transition
                $content.on('transitionend', () => {
                    $content.css('height', height);
                    $content.off('transitionend');
                });
            }
        }

        const addHandler = ($element) => {
            elementorFrontend.elementsHandler.addHandler(RevealButtonHandler, {
                $element,
            });
        };

        elementorFrontend.hooks.addAction('frontend/element_ready/button_reveal.default', addHandler);
    });
})(window, jQuery)