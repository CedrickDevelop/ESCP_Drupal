import {$, T} from "../../common/drupal/drupal";

/**
 * Class exemple de gestion du footer
 */
class VideoRemote {

  /**
   * init
   */
  init(){

    console.log("chargement de la video");

    let btn_paragraph_media_video = document.querySelector('.videoWrapper');
    let paragraph_media_image_video = document.querySelector('.videoWrapper-image-video');
    let paragraph_media_video = document.querySelector('.videoWrapper-video');

    btn_paragraph_media_video.addEventListener("click", function() {
      paragraph_media_image_video.classList.add('video-close')
      paragraph_media_video.classList.add('video-open')
      paragraph_media_video.classList.remove('videoWrapper-video')

    })
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

export let videoRemote = new VideoRemote();
