// Load the video js
import {video} from "./src/Video";

(function (Drupal) { // closure
  'use strict';

  // Video
  Drupal.behaviors.video = video;
}(Drupal));
