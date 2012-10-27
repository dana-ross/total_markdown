jQuery(function () {
  // remove the Visual tab
  jQuery("#content-tmce, #ed_toolbar").remove();

  // Override stock image upload/insert functionality
  window.send_to_editor = function (content) {
    console.log(content);
    var doc = jQuery(jQuery.parseXML(content));
    var link = doc.find('a');
    var image = doc.find('img');
    var link_title;

    var markdown = '';
    console.log(image.attr('src'));
    if (image.attr('src') !== undefined) {

      // Get some kind of title for this link

      if (image.attr('title') !== undefined && image.attr('title') !== '') {
        link_title = image.attr('title');
      } else if (image.attr('alt') !== undefined && image.attr('alt') !== '') {
        link_title = image.attr('alt');
      } else {
        link_title = image.attr('src');
      }

      markdown += '![' + image.attr('title') + ']';
      markdown += '(' + image.attr('src') + ')';

    }

    if (link.attr('href') !== undefined) {

      if (markdown === '') {
        link_title = link.text();
      }
      else {
        link_title = markdown;
      }

      markdown = '[' + link_title + ']';
      markdown += '(' + link.attr('href') + ')';
    }

    // From the stock send_to_editor
    // add our content to the editor and close the ThickBox
    document.getElementById(wpActiveEditor).value += markdown;
    try {
      tb_remove();
    } catch (d) {
      // Do nothing. Most likely something else closed the ThickBox
    }
  };

});