(function ($) {
    $('#add_answer').on('click', () => {
        $('.answers').append('' +
            '<div class="row">' +
                '<div class="col-md-11">' +
                    '<input name="answers[]" type="text" class="form-control" id="answers">' +
                '</div>' +
                '<div class="col-md-1 text-right">' +
                    '<button type="button" id="remove_answer" class="btn btn-danger">' +
                        '<i class="glyphicon glyphicon-minus"></i>' +
                    '</button>' +
                '</div>' +
            '</div>');
    });
    $('.answers').on('click', '#remove_answer', (e) => {
        $(e.target).parents('.row').first().remove();
    });
    $('a[class*=delete-entry]').on('click', function (e) {
        let $this = $(this);
        e.preventDefault();
        let deleteEntry = confirm("Удалить опрос?");
        if(deleteEntry) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $this.data('token')
                }
            });
            $.ajax({
                type: 'POST',
                url: $this.attr('href'),
                data: {
                    _method: $this.data('method')
                },
                success: function () {
                    $this.parents('tr').hide(100);
                }
            });
        }
    });
    $('div[class*=choose-answer]').on('click', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $(this).data('token')
            }
        });
        $.ajax({
            type: 'POST',
            url: $(this).data('href'),
            success: function () {
                alert('1');
            }
        });
    });
})(jQuery);