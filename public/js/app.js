$('#disable').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget);
    let id = button.data('id');
    let modal = $(this);
    modal.find('.modal-body #id').val(id);
});

$('#enable').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget);
    let id = button.data('id');
    let modal = $(this);
    modal.find('.modal-body #id').val(id);
});

$('#hour').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget);
    let id = button.data('user_id');
    let op = button.data('operation');
    let modal = $(this);
    modal.find('.modal-body #user_id').val(id);
    modal.find('.modal-body #user_id').val(id);
    modal.find('.modal-body #operation').val(op);
});


window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(1000, function(){
      $(this).remove();
  });
}, 8000);
