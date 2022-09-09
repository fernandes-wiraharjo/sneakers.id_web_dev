/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

function onCLose() {
    document.getElementById("myDropdown").classList.remove('show');
}

console.log('test');

function change(item_id) {
    // document.getElementsByClassName('tns-item').classList;
    var x = document.getElementById('image-initiator-item' + item_id);
    x.classList.toggle("tns-slide-active");
    x.removeAttribute('aria-hidden');
    x.removeAttribute('tab-index');

}