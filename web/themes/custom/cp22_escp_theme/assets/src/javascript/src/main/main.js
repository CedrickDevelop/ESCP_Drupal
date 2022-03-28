import {footer} from "./src/Footer";
import {header} from "./src/Header";
import {homepage} from "./src/Homepage";
import {main} from "./src/Main";
import {searchpage} from "./src/Searchpage";
import {videoRemote} from "./src/VideoRemote";

(function (Drupal) { // closure
    'use strict';
    Drupal.behaviors.footer = footer;
    Drupal.behaviors.header = header;
    Drupal.behaviors.homepage = homepage;
    Drupal.behaviors.main = main;
    Drupal.behaviors.searchpage = searchpage;
    Drupal.behaviors.videoRemote = videoRemote;
}(Drupal));
