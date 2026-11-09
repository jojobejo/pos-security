$(function () {
    $('form[data-confirm-title]').on('submit', function (event) {
        event.preventDefault();
        var form = this;
        var options = $(form).data();
        if (!window.Swal) {
            if (window.confirm(options.confirmTitle + '\n' + options.confirmText)) {
                form.submit();
            }
            return;
        }

        Swal.fire({
            titleText: options.confirmTitle,
            text: options.confirmText,
            icon: options.danger ? 'warning' : 'question',
            showCancelButton: true,
            confirmButtonText: options.confirmButton,
            cancelButtonText: 'Batal',
            confirmButtonColor: options.danger ? '#b22835' : '#0056b3',
            focusCancel: true
        }).then(function (result) {
            if (result.isConfirmed || result.value === true) {
                form.submit();
            }
        });
    });
});
