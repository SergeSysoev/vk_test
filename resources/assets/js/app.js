(function ($) {

    let filters = {};

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
        }
    });
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
    $(document).on('click', 'div[class*=choose-answer]', function() {
        let self = $(this);
        $.ajax({
            type: 'POST',
            url: $(this).data('href'),
            success: function (result) {
                $('.answer-'+self.data('id')).addClass('chosen');
                Object.keys(result).forEach(function(key) {
                    $('.answer-'+key).find('b').text(result[key]['percentage']+'%');
                    if(result[key]['count'] > 0) {
                        $('.answer-'+key).find('.count').text('('+result[key]['count']+')');
                        $('.answer-'+key).find('.percentage').css('width', result[key]['percentage']+'%').show();
                    }
                    self.parents('.poll').addClass('answered');
                });
            }
        });
    });
    $('.cancel-vote').on('click', function() {
        let self = $(this);
        $.ajax({
            type: 'POST',
            data: {
                _method: 'DELETE'
            },
            url: $(this).data('href'),
            success: function () {
                self.parents('.poll').removeClass('answered')
                    .find('.answer').removeClass('chosen').addClass('choose-answer')
                    .find('.percentage').css('width', '0')
                    .parents('.answer').find('.count').text('');
            }
        });
    });
    $(document).on("click", ".open-statsModal", function () {
        $.ajax({
            type: 'GET',
            url: $(this).data('href'),
            success: function (result) {
                $('#modal-wrapper').html(result);
                $('#statsModal').modal('show');
                $('#pills-home-tab').tab('show');
                filters = {};
            }
        });
    });
    $(document).on('change', '#country', function () {
        $('#city').html('<option value="0">Город</option>').prop('disabled', true);
        $.ajax({
            type: 'GET',
            url: $(this).data('href-cities'),
            data: {
                countryId: $(this).val()
            },
            success: function (result) {
                $('#city').html('<option value="0">Город</option>').prop('disabled', false);
                Object.keys(result).forEach(function(key) {
                    $('#city').append('<option value="'+result[key]['id']+'">'+result[key]['title']+'</option>');
                });
            }
        });
    });
    $(document).on('change', '.filter', function () {
        if($(this).val() == 0) {
            delete filters[$(this).prop('name')];
        } else {
            filters[$(this).prop('name')] = $(this).val();
        }
        $.ajax({
            type: 'GET',
            url: $(this).data('href'),
            data: {filters: filters},
            success: function (result) {
                $('#pills-home').html(result);
            }
        });
    });
})(jQuery);