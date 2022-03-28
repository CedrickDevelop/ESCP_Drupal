import {$, T} from "../../common/drupal/drupal";
import Swiper, { Navigation, Autoplay } from 'swiper';
Swiper.use([Navigation, Autoplay]);
/**
 * Class exemple de gestion du footer
 */
class Homepage {

  /**
   * init
   */
  init(){


    // let form_search_input = document.querySelector('#edit-sort-by--3');
    // let form_search = document.querySelector('#views-exposed-form-global-search-page-1');
    //
    // form_search_input.addEventListener('change', function() {
    //   form_search.setAttribute("name", "name");
    // });
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

export let homepage = new Homepage();
