$(document).ready(function () {
    $(document)
      .bind('keydown', 'alt+1', function () {
        window.location.href = '/mvc/';
    }).bind('keydown', 'alt+2', function () {
        window.location.href = '/mvc/dashboard';
    }).bind('keydown', 'alt+3', function () {
        window.location.href = '/mvc/note';
    }).bind('keydown', 'alt+4', function () {
        window.location.href = '/mvc/help';
    }).bind('keydown', 'alt+5', function () {
        window.location.href = '/mvc/user';
    }).bind('keydown', 'alt+p', function () {
        window.location.href = '/mvc/pizza';
    }).bind('keydown', 'alt+l', function () {
        $.fn.idleTimeout().logout();
    });
});