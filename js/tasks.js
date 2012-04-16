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

      var priorityElem = $('.priority', $this);
      var priority = priorityElem.text();
      if (priority == 'L') {
        priorityElem.css('color', '#edd400');
      } else if (priority == 'M') {
        priorityElem.css('color', '#f57900');
      } else if (priority == 'H') {
        priorityElem.css('color', '#cc0000');
      } else {
        priorityElem.css('color', 'black');
      }

    });
  };

})(jQuery);
