$('select').each(function () {
    var options = {
        useDimmer: true,
        useSearch: true,
        labels: {
            search: '...'
        }
    };
    $.each($(this).data(), function (key, value) {
        options[key] = value;
    });
    $(this).selectator(options);
});

$(document).on('click touchstart', '[data-confirm]:not(.disabled):not([disabled])', function(evt)
{
    evt.preventDefault();
    var text = $(this).attr('data-confirm');
    var source = $(this);

    bootbox.confirm({
        message: text,
        callback: function(result) {
            if(result)
            {
                if(source.is('[type="submit"]'))
                {
                    $(document).off('click touchstart', '[data-confirm]:not(.disabled):not([disabled])');
                    source.click();
                }
                else if(source.is('a'))
                {
                    $(location).attr('href', source.attr('href'));
                }
            }
        }
    });
});

$('a[data-toggle="modal"]').on('click', function(e) {
    var target_modal = $(e.currentTarget).data('target');
    var remote_content = $(e.currentTarget).attr('href');

    if(remote_content.indexOf('#') === 0) return;

    var modal = $(target_modal);
    var modalContent = $(target_modal + ' .modal-content');

    modal.off('show.bs.modal');
    modal.on('show.bs.modal', function () {
        modalContent.load(remote_content);
    }).modal();

    return false;
});

$(function () {
  if($('#notify').length)
    {
    $('#notify').slideDown(500);
    setTimeout(function() {
      $('#notify').slideUp(500);
    }, 5000);
  }
});
