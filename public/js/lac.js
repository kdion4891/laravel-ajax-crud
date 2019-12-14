$.extend(true, $.fn.dataTable.defaults, {
    autoWidth: false,
    responsive: true,
    stateDuration: 0,
    stateSave: true,
    stateSaveParams: function (settings, data) {
        data.search.search = '';
        data.start = 0;
    },
    stateLoadCallback: function (settings, callback) {
        return JSON.parse(localStorage.getItem($(this).attr('id')));
    },
    stateSaveCallback: function (settings, data) {
        localStorage.setItem($(this).attr('id'), JSON.stringify(data));
    }
});

$(document).ready(function () {
    $(document).on('click', '[data-show-modal]', function () {
        show_modal($(this).data('show-modal'));
    });

    $(document).on('shown.bs.modal', '[data-ajax-modal]', function () {
        $(this).find('script').each(function () {
            eval($(this).text());
        });
    });

    $(document).on('hidden.bs.modal', '[data-ajax-modal]', function () {
        $(this).remove();
    });

    $(document).on('input', '.custom-file-input', function (event) {
        $(this).next('.custom-file-label').html(event.target.files[0].name);
    });

    $(document).on('submit', '[data-ajax-form]', function (event) {
        event.preventDefault();

        let form = $(this);
        let submit = $(this).find(':submit');

        if (form.data('ajax-form') !== 'submitted') {
            form.attr('data-ajax-form', 'submitted');
            submit.attr('data-original-html', submit.html());
            submit.css('width', submit.css('width'));
            submit.html('<i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: new FormData(form[0]),
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.hasOwnProperty('redirect')) $(location).attr('href', response.redirect);
                    if (response.hasOwnProperty('reload_page')) location.reload();
                    if (response.hasOwnProperty('reload_datatables')) $($.fn.dataTable.tables()).DataTable().ajax.reload(null, false);
                    if (response.hasOwnProperty('show_alert')) show_alert(response.show_alert[0], response.show_alert[1]);
                    if (response.hasOwnProperty('show_modal')) show_modal(response.show_modal);
                    if (response.hasOwnProperty('dismiss_modal')) form.closest('[data-ajax-modal]').modal('toggle');
                    if (response.hasOwnProperty('jquery')) $(response.jquery.selector)[response.jquery.method](response.jquery.content);
                },
                error: function (response) {
                    $('[data-error-input]').removeClass('is-invalid');
                    $('[data-error-feedback]').html('').removeClass('d-block');

                    if (response.responseJSON.hasOwnProperty('errors')) {
                        $.each(response.responseJSON.errors, function (key, value) {
                            $('[data-error-input="' + key + '"]').addClass('is-invalid');
                            $('[data-error-feedback="' + key + '"]').html(value[0]).addClass('d-block');
                        });
                    }
                },
                complete: function () {
                    form.attr('data-ajax-form', '');
                    submit.html(submit.data('original-html'));
                    submit.removeAttr('data-original-html');
                }
            });
        }
    });

    $(document).on('click', '[data-confirm]', function (event) {
        if (!confirm($(this).data('confirm'))) {
            event.preventDefault();
        }
    });

    $(document).on('click', '[data-checkbox-all]', function () {
        $('[data-checkbox-id]').prop('checked', this.checked).trigger('change');
    });

    $(document).on('change', '[data-checkbox-id]', function () {
        let row = $(this).closest('tr');
        this.checked ? row.addClass('checked') : row.removeClass('checked');

        let ids = $('[data-checkbox-id]:checked').map(function() { return this.value }).get().join(',');
        $('[data-checkbox-ids]').val(ids);
    });
});

function show_alert(alert_class, alert_message) {
    let alert_container = $('.alert-container');
    let alert = alert_container.find('.alert');

    alert.addClass('bg-' + alert_class);
    alert.html(alert_message);

    alert_container.fadeIn('fast', function () {
        $(this).delay(3000).fadeOut('fast', function () {
            alert.removeClass('bg-' + alert_class);
            alert.html('');
        });
    });
}

function show_modal(url) {
    $.get(url, function (data) {
        $(data).modal('show');
    });
}
