document.addEventListener('DOMContentLoaded', ready);
function ready() {
  // burger menu
  burgerMenu();
  roomTypeSelect();
  
}
function burgerMenu() {
  $('#menu-btn').click(() => {
    $(this).addClass('is-active');
    $('#menu').toggleClass('flex');
    $('#menu').toggleClass('hidden');
});
}
