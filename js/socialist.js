function getInput(){
  $.post(BASE_URL + "streams_core/public_ajax/field/socialist/get_field", {}, function(res) {
    // inject the new component
    $("#parameters").append(res);
  }).then(function() {
    // add the click event to the last item
    $('.socialist_button').last().click(socialistClick);
  });
}

function socialistClick(e) {
  e.stopPropagation();
  e.preventDefault();
  getInput();
  return false;
}

$(document).ready(function(){
  $('.socialist_button').unbind('click').click(socialistClick);
});