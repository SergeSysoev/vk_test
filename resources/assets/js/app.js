(function ($) {
    $('#add_answer').on('click', () => {
        $('.answers').append('' +
            '<div class="row">' +
                '<div class="col-md-11">' +
                    '<input name="answers[]" type="text" class="form-control" id="answers">' +
                '</div>' +
                '<div class="col-md-1 text-right">' +
                    '<button type="button" id="remove_answer" class="btn btn-danger">' +
            '           <i class="glyphicon glyphicon-minus"></i>' +
            '       </button>' +
                '</div>' +
            '</div>');
    });
    $('.answers').on('click', '#remove_answer', (e) => {
        $(e.target).parents('.row').first().remove();
    });
})(jQuery);