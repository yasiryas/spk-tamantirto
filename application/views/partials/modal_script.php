<script>
$(function () {
  $('[data-form-open]').on('click', function () {
    const button = $(this);
    const modal = $(button.data('form-open'));
    const form = modal.find('form');

    form[0].reset();
    form.attr('action', button.data('form-action'));
    modal.find('.modal-title').text(button.data('title'));

    Object.entries(button.data('fields') || {}).forEach(function (entry) {
      const input = modal.find('[name="' + entry[0] + '"]');
      if (input.is(':checkbox')) {
        input.prop('checked', Boolean(entry[1]));
      } else {
        input.val(entry[1]);
      }
    });

    modal.modal('show');
  });

  $('[data-confirm-open]').on('click', function () {
    const button = $(this);
    const modal = $(button.data('confirm-open'));
    const form = modal.find('form');

    form[0].reset();
    form.attr('action', button.data('form-action'));
    form.find('[data-dynamic-field]').remove();

    Object.entries(button.data('fields') || {}).forEach(function (entry) {
      $('<input>').attr({
        type: 'hidden',
        name: entry[0],
        'data-dynamic-field': '1'
      }).val(entry[1]).appendTo(form);
    });

    modal.find('.modal-text').text(button.data('message'));
    modal.find('.modal-title').text(button.data('title'));
    modal.modal('show');
  });
});
</script>
