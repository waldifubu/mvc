$(function () {
    $.get('dashboard/xhrGetListings', function (o) {
        for (var i = 0; i < o.length; i++) {
            $('#listInserts').append('<div><a class="del" rel="' + o[i].dataid + '" href="#"><span class="glyphicon glyphicon-trash red"></a> ' + o[i].text + ' </div>');
        }

        $('#listInserts').delegate('a.del', 'click', function () {
            var id = $(this).attr('rel');
            var delItem = $('[rel=' + id + ']');

            delItem.parent().remove();

            $.post('dashboard/xhrDeleteListing', {'id': id}, function (o) {

            }, 'json');

            return false;
        });
    }, 'json');

    $('#randomInsert').submit(function () {
        var url = $(this).attr('action');
        var data = $(this).serialize();

        $.post(url, data, function (o) {
            $('#listInserts').append('<div><a class="del" rel="' + o.id + '" href="#"><span class="glyphicon glyphicon-trash red"></a> ' + o.text + '</div>');
        }, 'json');
        return false;
    });

    $('#textbox').keypress(function (e) {
        if (e.which == 13) {
            $('#randomInsert').submit();
            e.preventDefault();
        }
    });

});