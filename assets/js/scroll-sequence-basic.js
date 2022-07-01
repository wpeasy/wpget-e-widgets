;(w => {
    function ScrollSequence(containerID, scrollBehaviour = {behavior: "smooth", block: "center"}, loop = '', preloadFrames = 10) {
        this.myContainerID = containerID;
        this.myScrollBehaviour = scrollBehaviour;
        this.methods = {};
        this.preloadFrames = preloadFrames;
        this.loop =loop;
        this.scrollDirection = 'forward';

        this.methods.init = () => {
            this.targetSection = document.getElementById(this.myContainerID);
            this.imageItems = this.targetSection.querySelectorAll('.image_item');
            this.imageCount = this.imageItems.length;
            this.currentImage = 0;
            _init();
        }

        const _updateItem = i => {
            this.currentImage = i;
            _reset_image_styles();
            _preload();
            /* Show only the current image */
            const img = this.imageItems[i];
            //Set styles
            img.style.zIndex = 99;
            img.style.position = 'relative';
            img.style.top = '0';
            img.style.left = '0';

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
        }

        const _reset_image_styles = () => {
            this.imageItems.forEach((el, i) => {

                el.style.position = 'absolute';
                el.style.top = '-10000px';

                el.style.zIndex = '1';
            })
        }

        const _init = () => {
            //Set scroll container to overflow hidden
            this.targetSection.style.overflow = "hidden";

            //Parse src to data-src . Done here so Elementor preview shows images
            this.imageItems.forEach( el => {
                el.setAttribute('data-src', el.src);
                el.src = '';
            });

            //Set positioning of all elements
            _updateItem(0);

            /*@todo look at chrome mouse event target lagging */

            /*
            Listen for mouse wheel
             */
            this.targetSection.addEventListener('wheel', (e) => {
                let newItemIndex;
                if (e.deltaY > 0) {
                    newItemIndex = this.currentImage + 1;
                    this.scrollDirection = 'forward';
                } else {
                    newItemIndex = this.currentImage - 1;
                    this.scrollDirection = 'backward';
                }
                if(this.loop === 'yes'){
                    if(newItemIndex < 0){ newItemIndex = this.imageCount -1}
                    if(newItemIndex === this.imageCount){ newItemIndex = 0}
                }

                if (newItemIndex > -1 && newItemIndex < this.imageCount) {
                    e.preventDefault();
                    if (this.myScrollBehaviour !== false) {
                        this.targetSection.scrollIntoView(this.myScrollBehaviour)
                    }
                    _updateItem(newItemIndex);
                }
            })
        }
    }

    if (w.wpe === undefined) {
        w.wpe = {};
    }
    w.wpe.ScrollSequence = ScrollSequence;
    const event = new Event('wpe/ScrollSequence/load');
    w.dispatchEvent(event);

})(window);
