function getInput(){
  // hide the last item
  $('.socialist_button').last().hide();
  $.post(BASE_URL + "streams_core/public_ajax/field/socialist/get_field", {}, function(res) {
    // inject the new component
    $("#parameters").append(res);
  }).then(function() {
    // add the click event to the new last item
    $('.socialist_button').last().show().click(socialistClick);
  });
}

function socialistClick(e) {
  e.stopPropagation();
  e.preventDefault();
  getInput();
  return false;
}

$(document).ready(function(){
  // hide all buttons but the last one
  $('.socialist_button').hide();
  $('.socialist_button').last().show().unbind('click').click(socialistClick);
});