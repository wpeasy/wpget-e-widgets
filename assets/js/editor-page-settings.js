;($ =>{
    /******************************
     *
     * This updates body with a class if in the Elementor Editor, and The setting wpg_use_wireframe_styles changes.
     ******************************/

    const handleChange = newValue => {
        const applyClass = 'wpg_use_wireframe_styles';
        $body = $('body');
        if(newValue === 'yes'){
            $body.addClass(applyClass);
        }else{
            $body.removeClass(applyClass);
        }
    }

    $(window).on('elementor/frontend/init',  ()=> {
        elementor.settings.page.addChangeCallback( 'wpg_use_wireframe_styles', handleChange );
    });
})(jQuery)
