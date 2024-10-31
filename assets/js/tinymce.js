var nictitate_lite_ii_toolkit_element;

tinymce.PluginManager.add('nictitate_lite_ii_toolkit_button', function(editor) {
  editor.addButton('nictitate_lite_ii_toolkit_button', {
    title: nictitate_lite_ii_toolkit_variables.translate.nictitate_lite_ii_toolkit_elements,
    image: nictitate_lite_ii_toolkit_variables.resource.icon,
    onclick: function(event) {
      var $box;
      event.preventDefault();
      $box = jQuery('#nictitate-lite-ii-toolkit-elements');
      if ($box.length) {
        jQuery.featherlight($box, {
          closeOnClick: false
        });
      }
    }
  });
});

jQuery(window).load(function() {
  nictitate_lite_ii_toolkit_element.toggle();
});

nictitate_lite_ii_toolkit_element = {
  insert: function(button) {
    var code;
    code = button.next().html();
    tinymce.execCommand('mceInsertContent', false, code);
    jQuery.featherlight.current().close();
  },
  toggle: function() {
    jQuery('body').on('click', '.nictitate-lite-ii-toolkit-title', function(event) {
      var content;
      content = jQuery(this).next();
      if (content.is(':hidden')) {
        content.slideDown();
        jQuery(this).find('.nictitate-lite-ii-toolkit-caret').text('-');
      } else {
        content.slideUp();
        jQuery(this).find('.nictitate-lite-ii-toolkit-caret').text('+');
      }
    });
  }
};

