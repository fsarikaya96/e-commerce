$(document).ready(function () {
    setTimeout(function () {
        $('.alert').fadeOut();
    },1500);
});
window.addEventListener('close-modal',event => {
    $('#deleteModal').modal('hide');
});
window.addEventListener('close-modal',event => {
    $('#addBrandModal').modal('hide');
});

