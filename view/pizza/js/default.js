$(function () {
    $('#newPizzaUp').click(function () {
        $('#pizzaForm').css('display', 'block');
        $("html, body").animate({scrollTop: $(document).height()}, 1000);
    });

    $('#newPizza').click(function () {
        $('#pizzaForm').toggle();
        $("html, body").animate({scrollTop: $(document).height()}, 10);
    });

    $('.delete').click(function () {
        return confirm("Pizza wirklich loeschen?");
    });

    $(".dblclick").dblclick(function () {
        var $this = $(this);
        $this.editable("pizza/changeValues", {
            id: "ID als Bez.",
            name: "value",
            submitdata: {column: $(this).attr('data-type'), id: $(this).closest('tr').attr("data-uid")},
            indicator: "<img src='public/img/indicator.gif'>",
            tooltip: "Doppelklicken um zu bearbeiten...",
            submit: "OK",
            onblur: "cancel",
            style: "inherit",
            width: "30px"
        });
    });
    //alert($(this).closest('tr').prop('id'));
    //EQ: alert($(this).parents('tr').attr("id"));

    $('.button-file').click(function () {
        $('#file-input').attr('data-target', $(this).attr('data-target'));
        $('#file-input').trigger('click');
    });

    $("#file-input").on("change", function () {
        var file_data = $(this).prop("files")[0];
        var form_data = new FormData();
        form_data.append("file", file_data);
        form_data.append('id', $(this).data("target"));
        $.ajax({
            url: 'pizza/changePic',
            data: form_data,
            type: 'POST',
            processData: false,
            contentType: false,
            success: function (response) {
                $.growl.notice({title: "Bild getauscht", message: "Erfolgreich hochgeladen."});
            },
            error: function (req, status, err) {
                $.growl.error({title: "Probleme", message: "Fehler beim Upload"});
            }
        });
        previewImage(this);
    });

    // include "go up arrow" on page
    $('#goup').goup();
});

function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var preview = $("#" + $(input).data("target"));

        reader.onload = function (e) {
            preview.attr('src', e.target.result);
            preview.attr('height', 200);
        };

        reader.readAsDataURL(input.files[0]);
    }
}