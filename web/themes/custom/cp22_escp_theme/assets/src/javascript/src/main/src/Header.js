import {$, T} from "../../common/drupal/drupal";

/**
 * Class de gestion du header mobile
 */
class Header {

    /**
     * init
     */
    init(){
      let btn_search_header = document.querySelector(".BottomHeader-buttonSearch");
      let select_form_search = document.querySelector("#block-global-search");
      let div_form_search = document.querySelector(".BottomHeader-search");
      let submit_button_search = document.querySelector("#edit-submit-global-search");

      btn_search_header.addEventListener("click", function () {
        // Activate the page of search
        div_form_search.style.display = "block";

        //************** Disable the scroll ***************

        // Define the key and change prevent defaut action from screen
        let keys = {37: 1, 38: 1, 39: 1, 40: 1};
        function preventDefault(e) {
          e.preventDefault();
        }
        function preventDefaultForScrollKeys(e) {
          if (keys[e.keyCode]) {
            preventDefault(e);
            return false;
          }
        }
        // Change the activatioon of the keys
        let supportsPassive = false;
        try {
          window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
            get: function () { supportsPassive = true; }
          }));
        } catch(e) {}

        let wheelOpt = supportsPassive ? { passive: false } : false;
        let wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';

        // On each move disable the actions
        window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
        window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
        window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
        window.addEventListener('keydown', preventDefaultForScrollKeys, false);

      });

    }



    /**
     * Attach.
     * @param context
     */
    attach(context) {
        if (T.contextIsRoot(context)) {
            this.init();
        }
    }
}

export let header = new Header();
