;((w,$)=> {
    function ScrollSequence(
        containerID,
        scrollBehaviour = {behavior: "smooth", block: "center"},
        loop = '',
        preloadFrames = 10
    ) {
        this.myContainerID = containerID; /* ID of the container to attach wheel and touch events to */
        this.myScrollBehaviour = scrollBehaviour; /* Object to use as a property for element.scrollIntoView(obj) */
        this.methods = {}; /* Object to place public methods in */
        this.preloadFrames = preloadFrames; /* Number of frames to preload for smooth stepping */
        this.loop = loop; /* If "yes" loops past end frames */
        this.scrollDirection = 'forward'; /* Not currently used */

        /*@todo move to a function property */
        this.touchDebounceTimeMs = 10; /* Debounce ms for Touch move event */
        this.touchDebounceLastTrigger = 0;

        /* Public Methods */
        this.methods.init = () => {
            if(undefined === this.myContainerID || '' === this.myContainerID){
                console.error("Error: WPGet_Mouse_Wheel ContainerID not provided");
                return false;
            }
            this.targetSection = document.getElementById(this.myContainerID);
            if(null === this.targetSection){
                console.error("Error: WPGet_Mouse_Wheel ContainerID is not valid");
                return false;
            }
            this.imageItems = this.targetSection.querySelectorAll('.image_item');
            this.imageCount = this.imageItems.length;
            this.currentImage = 0;
            _init();
        }

        /*
        Private methods
         */
        const _updateItem = () => {
            _resetImageStyles();
            _preload();
            /* Show only the current image */
            const img = this.imageItems[this.currentImage];
            //Set styles
            img.classList.add('active');

        }

        const _preload = ()=>{
            for( let i = 0; i < this.preloadFrames; i++){
                let nextIndex;
                /* Allow for preloading direction to allow for backward scroll on loop */
                if(this.scrollDirection === 'forward'){
                   nextIndex = this.currentImage + i;
                }else{
                    nextIndex = this.currentImage - i;
                }
                if(nextIndex < this.imageCount && nextIndex >= 0){
                    const img = this.imageItems[nextIndex];
                    img.src = img.getAttribute('data-src');
                }
            }
            //preload las image as well, in case the user scolls backwards
            const lastImg = this.imageItems[this.imageCount -1];
            lastImg.src = lastImg.getAttribute('data-src');
        }

        const _resetImageStyles = () => {
            this.imageItems.forEach((el) => {
                el.classList.remove('active');
            })
        }

        const _handleMouseScroll = e => {
            let newItemIndex;
            if (e.deltaY > 0) {
                newItemIndex = this.currentImage + 1;
                this.scrollDirection = 'forward';
            } else {
                newItemIndex = this.currentImage - 1;
                this.scrollDirection = 'backward';
            }
            const next = _shouldLoop(newItemIndex);
            if(false !== next){
                this.currentImage = next;
                e.preventDefault();
                _advanceFrame();
            }
        }

        const _handleTouchMove = e => {
            /*
            If elapsed ms is less than this.touchDebounceTimeMs, just return.
             */
            const currentMs = Date.now() ;
            const elapsed = currentMs - this.touchDebounceLastTrigger;
            if(elapsed < this.touchDebounceTimeMs){
                if(this.touchActive) { e.preventDefault() }
                return true;
            }

            /*
            Otherwise, time is debounced.
             */
            this.touchDebounceLastTrigger = currentMs;
            let newItemIndex;
            const {clientY} = e.changedTouches[0];
            if(undefined === this.lastTouchY) { this.lastTouchY = clientY}
            const delta = this.lastTouchY - clientY;
            this.lastTouchY = clientY;

            if(delta > 0){
                newItemIndex = this.currentImage - 1;
                this.scrollDirection = 'backward';
            }else{
                newItemIndex = this.currentImage + 1;
                this.scrollDirection = 'forward';
            }

            const next = _shouldLoop(newItemIndex);
            if(false !== next){
                this.currentImage = next;
                e.preventDefault();
                console.info('frame: ' + next)
                _advanceFrame();
            }
        }

        const _shouldLoop = i => {
            if(this.loop === 'yes'){
                if(i < 0){
                    i = this.imageCount -1;
                }
                if(i === this.imageCount){
                    i = 0;
                }
            }else{
                if(i < 0 || i > this.imageCount -1){
                    return false;
                }
            }
            return i;
        }

        const _advanceFrame = () => {
            if (this.myScrollBehaviour !== false) {
                this.targetSection.scrollIntoView(this.myScrollBehaviour)
            }
            const evt = new CustomEvent('wpg/WPGet_Mouse_Wheel/frame', {detail: {id: this.myContainerID, frame: this.currentImage}});
            w.dispatchEvent(evt);
            _updateItem();
        }

        const _init = () => {
            //Set scroll container to overflow hidden
            this.targetSection.style.overflow = "hidden";

            //Parse src to data-src . Done here so Elementor preview shows images
            //We want to jus show images in teh Elementor Editor
            //Want to only load the "preloadFrames" number of images in the frontend
            this.imageItems.forEach( el => {
                el.setAttribute('data-src', el.src);
                el.src = '';
            });

            //Set the first frame as active
            _updateItem(0);

            /*
            Listen for mouse wheel
             */
            this.targetSection.addEventListener('wheel', _handleMouseScroll );
            this.targetSection.addEventListener('touchmove', _handleTouchMove );
            this.targetSection.addEventListener('touchstart', e => {
                this.touchActive = true;
            } );
            this.targetSection.addEventListener('touchend', e => {
                this.touchActive = false;
            } );
        }
    }

    /*
    Note: none of this script runs in the editor
     */

    if (w.wpg === undefined) {
        w.wpg = {};
    }
    w.wpg.ScrollSequence = ScrollSequence;
    const event = new Event('wpg/ScrollSequence/load');
    w.dispatchEvent(event);

    /* w.addEventListener('wpg/ScrollSequence/frame' , (e)=> { console.log(e)}); */

})(window, jQuery);


