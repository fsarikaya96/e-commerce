$(document).ready(function () {
    setTimeout(function () {
        $('.alert-success').fadeOut();
    },1500);
});

window.addEventListener('close-modal',event => {
    $('#addBrandModal').modal('hide');
    $('#updateBrandModal').modal('hide');
    $('#deleteBrandModal').modal('hide');
    $('#deleteModal').modal('hide');
});
