$(function() {
	$('#login').submit(function(ev) {
        ev.preventDefault();

		var url = $(this).attr('action');
		var data = $(this).serialize();

        $.post(url, data, function(out) {
            if (out.result == true) {
                $.growl.notice({ title: "Login", message: "Herzlich willkommen!" });

                setTimeout(function() {
                    $.growl({ title: "Login erfolgreich", message: "Weiterleitung..." });
                    window.location.href = store.get('lastpage');
                }, 2300);
            }

            if (out.result == false)  {
                $("#loginBox").effect("shake");
                $.growl.error({title: "Login", message: "Eingabe ungültig!"});
            }
        }, 'json');
	});

    /**
     * Check if Login name is given. If not, nothing happens
     */
	$('#formPass').keypress(function(e) {
        if(e.which == 13) {
            var check = $("#formLogin").val();
            if (check == '') {
                e.preventDefault();
                return false;
            }
        }
	});

});