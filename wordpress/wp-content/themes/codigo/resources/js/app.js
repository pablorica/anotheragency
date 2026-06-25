//import Emitter from 'tiny-emitter';
//export var emitter = new Emitter();

import Alpine from 'alpinejs'

import collapse from '@alpinejs/collapse'
import focus from '@alpinejs/focus'
import intersect from '@alpinejs/intersect'
import persist from '@alpinejs/persist'
import menuCollapse from "./alpine/menuCollapse";

Alpine.plugin(collapse)
Alpine.plugin(focus)
Alpine.plugin(intersect)
Alpine.plugin(persist)

Alpine.data('menuCollapse', menuCollapse)

window.Alpine = Alpine
Alpine.start()

/**
 * Custom modules
 */
import tinyslider from "./modules/tinyslider";
import collaborators from "./modules/collaborators";
import accordion from "./modules/accordion";
import jobs from "./modules/jobs";
import salaries from "./modules/salaries";
import loadEffect from "./modules/loadEffect";

function domReady(callback) {
  if (document.readyState !== 'loading') {
    callback();
  } else {
    document.addEventListener('DOMContentLoaded', callback);
  }
}

/**
 * Custom Modules
 */
const CDG = {
  onreadyFunctions: function() {
    tinyslider();
    collaborators();
    accordion();



    window.addEventListener("resize", function(){
      //consoleHello('window has resized');
      if(window.innerWidth < 768){
        //consoleHello('narrow');
      }
      else{
        //consoleHello('wide');
      }
    });
  },

  onloadFunctions: function() {
    //consoleHello('CDG is loaded');
    jobs();
    salaries();

    if(document.body.classList.contains('page-template-template-home')){
      //consoleHello('home page');
      loadEffect();
    }
  }
};

domReady(async () => {
  //consoleHello('DOMContentLoaded')
  CDG.onreadyFunctions();
});


document.addEventListener('DOMContentLoaded', () => {
  CDG.onloadFunctions();
});