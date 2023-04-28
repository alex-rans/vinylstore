let VinylShop = (function () {

    function hello() {
        console.log('The Vinyl Shop JavaScript works! 🙂');
    }

    /**
     * Show a Noty toast.
     * @param {object} obj
     * @param {string} [obj.type='success'] - background color ('success' | 'error '| 'info' | 'warning')
     * @param {string} [obj.text='...'] - text message
     */
    function toast(obj) {
        let toastObj = obj || {};   // if no object specified, create a new empty object
        new Noty({
            layout: 'topRight',
            timeout: 3000,
            modal: false,
            type: toastObj.type || 'success',   // if no type specified, use 'success'
            text: toastObj.text || '...',       // if no text specified, use '...'
        }).show();
    }

    return {
        hello: hello,    // publicly available as: VinylShop.hello()
        toast: toast,   // publicly available as: VinylShop.toast()
    };
})();

export default VinylShop;
