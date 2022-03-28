import {$, T} from "../../common/drupal/drupal";

/**
 * Class exemple de gestion du footer
 */
class Searchpage {

  /**
   * init
   */
  init(){

    // let form_search = document.querySelector("#edit-sort-by--3");
    // let btn_form_search = document.querySelector("#edit-submit-global-search--3");
    //
    // form_search.addEventListener('change', function(){
    //   btn_form_search.submit();
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

export let searchpage = new Searchpage();
