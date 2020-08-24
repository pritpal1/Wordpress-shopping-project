function cc_init_countdown (ajax = 0 ) {

jQuery(document).ready(function() {

  function countdown(ccfwoo_seconds) {

    check_cart = ccfwoo_php_vars.ccfwoo_check_cart;
    ccfwoo_seconds = parseInt(localStorage.getItem('ccfwoo_seconds')) || ccfwoo_seconds;
    // If the cart countdown isn't there, create it and set to off

    if (!localStorage.getItem('ccfwoo_counter_switch')) {
      localStorage.setItem('ccfwoo_counter_switch', 'off');
    }

    function turn_on_count() {
      // Runs the run on localStorage
      var ccfwoo_counter_switch = localStorage.getItem('ccfwoo_counter_switch');

      if (ccfwoo_counter_switch == 'off' && ccfwoo_seconds >= 0) {

        localStorage.setItem('ccfwoo_counter_switch', 'on');

      }
    }

    // if user has a created a cart start the countdown
    if (check_cart > 0 || ajax > 0) {
      localStorage.setItem('ccfwoo_cart_validator', 'valid');
      turn_on_count();

    } else {
      localStorage.removeItem("ccfwoo_set_date");
      localStorage.setItem('ccfwoo_cart_validator', 'invalid');
      localStorage.setItem('ccfwoo_counter_switch', 'off'); // Makes sure the timer is off
    }

    function tick() {

      var duriation = 60 * ccfwoo_php_vars.ccfwoo_minutes;

      ccfwoo_seconds--;
      localStorage.setItem('ccfwoo_seconds', ccfwoo_seconds)

      var current_minutes = parseInt(ccfwoo_seconds / 60 / 60);
      var current_minutes = parseInt(ccfwoo_seconds / 60);
      var current_ccfwoo_seconds = ccfwoo_seconds % 60;
      // adds counter text only if ID exists
      if (document.getElementById("cc-countdown-timer")) {
        var counter = document.getElementById("cc-countdown-timer");
        counter.innerHTML = ccfwoo_php_vars.ccfwoo_before_text + " " + current_minutes +  " " + ccfwoo_php_vars.ccfwoo_inbetween_countdown +   " " + (current_ccfwoo_seconds < 10 ? "0" : "") + current_ccfwoo_seconds + " " + ccfwoo_php_vars.ccfwoo_after_text;
      }

      var ccfwoo_counter_switch = localStorage.getItem('ccfwoo_counter_switch');
      var ccfwoo_cart_validator = localStorage.getItem('ccfwoo_cart_validator');

      if (ccfwoo_cart_validator == 'invalid') {
        localStorage.setItem('ccfwoo_counter_switch', 'on');
      }

      // Starts the timer when it's turned on and at 0
      if (ccfwoo_counter_switch == 'on' && ccfwoo_seconds > 0 && ccfwoo_cart_validator == 'valid') {

        setTimeout(tick, 1000);

      } else {

        clearTimeout(tick);

        localStorage.setItem('ccfwoo_counter_switch', 'off');
        localStorage.setItem('ccfwoo_seconds', '0'); // Makes sure the timer is off
        localStorage.removeItem("ccfwoo_set_date");

        if (document.getElementById("cc-countdown-timer")) {
          counter.innerHTML = ccfwoo_php_vars.ccfwoo_expired_text;
        }

        // Banner message if selected
        if ((ccfwoo_php_vars.ccfwoo_enable_banner_message == 'yes') && (ccfwoo_php_vars.ccfwoo_countdown_style == 'site-banner' || ccfwoo_php_vars.ccfwoo_countdown_style == 'shortcode')) {
            if (document.getElementById("cc-countdown-timer")) {
          counter.innerHTML = ccfwoo_php_vars.ccfwoo_banner_message;

          }
        }
      }
      // checks if the time is off OR at 0 or less
      if (ccfwoo_cart_validator == 'valid' && ccfwoo_counter_switch == 'on' && ccfwoo_seconds <= 0) {

        clearTimeout(tick);

        if (document.getElementById("cc-countdown-timer")) {
        counter.innerHTML = ccfwoo_php_vars.ccfwoo_expired_text;
        }

        if (ccfwoo_cart_validator == 'valid' && ccfwoo_seconds <= 0) {
          // Redirect to cart
          if (typeof ccfwoo_pro_functions == "function") {

            var self = this;

            ccfwoo_pro_functions();
            this.restart_count = function() {

              find_duriation();
              //localStorage.setItem('ccfwoo_seconds', ccfwoo_php_vars.ccfwoo_minutes * 60);
              localStorage.setItem('ccfwoo_counter_switch', 'on');

                ccfwoo_seconds = parseInt(localStorage.getItem('ccfwoo_seconds')) || ccfwoo_seconds;

                      setTimeout(tick, 1000); // restart tick countdown
                }

          }

        } // END IF  if ccfwoo_cart_validator == 'valid' && ccfwoo_seconds <= 0)

      }

    }
    tick();
  }

  find_duriation();

  final_count = localStorage.getItem('ccfwoo_seconds');

  countdown(final_count);

  });
}
jQuery(document).ready(cc_init_countdown);

cc_init_countdown(); // Start everything





// Find the Duration
function find_duriation() {

  var duriation = 60 * ccfwoo_php_vars.ccfwoo_minutes;


  if (document.getElementById("cc-countdown-timer")) {
    // Work out our duration in seconds

    var now = new Date();

    localStorage.setItem('ccfwoo_now_date', now);


if (!localStorage.getItem('ccfwoo_set_date')) {

      var expire = new Date();
      expire.setSeconds(expire.getSeconds() + duriation);


      localStorage.setItem('ccfwoo_set_date', expire);
    }

  var expire = new Date(localStorage.getItem('ccfwoo_set_date'));


    final = (+expire - +now) / 1000;
    localStorage.setItem('ccfwoo_seconds', final);


  }
}
