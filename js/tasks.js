(function($) {

  $.fn.task = function() {
    return this.each(function() {
      var $this = $(this);

      $this.click(function() {
        $('.meta', $this).slideToggle('fast');
      });

      var statusElem = $('.status', $this);
      var status = statusElem.text();
      if (status == 'pending') {
        statusElem.css('color', 'blue');
      } else if (status == 'completed') {
        statusElem.css('color', 'green');
      } else {
        statusElem.css('color', 'black');
      }

    });
  };

})(jQuery);
