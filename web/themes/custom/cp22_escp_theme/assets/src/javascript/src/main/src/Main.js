import {$, T} from "../../common/drupal/drupal";
/**
 * Class exemple de gestion du footer
 */
class Main {

    /**
     * init
     */
    init(){
        // console.log('hello main');
        //
        // let form_search_input = document.querySelector('#edit-sort-by--3');
        // let form_search = document.querySelector('#views-exposed-form-global-search-page-1');
        //
        // form_search_input.addEventListener('change', function(){
        //   form_search.setAttribute("name", "name");
        //   console.log("hello");
        //   // document.formSaisie.submit();
        //
        // })
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

export let main = new Main();
