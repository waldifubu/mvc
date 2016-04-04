$(document).ready(function () {
    $(document).idleTimeout({
        idleTimeLimit: 300,       // 'No activity' time limit in seconds. 1200 = 20 Minutes
        redirectUrl: '/mvc/dashboard/logout',    // redirect to this url on timeout logout. Set to "redirectUrl: false" to disable redirect

        // optional custom callback to perform before logout
        customCallback: false,     // set to false for no customCallback
        // customCallback:    function () {    // define optional custom js function
        // perform custom action before logout
        // },

        // configure which activity events to detect
        // http://www.quirksmode.org/dom/events/
        // https://developer.mozilla.org/en-US/docs/Web/Reference/Events
        activityEvents: 'click keypress scroll wheel mousewheel mousemove', // separate each event with a space

        // warning dialog box configuration
        enableDialog: true,        // set to false for logout without warning dialog
        dialogDisplayLimit: 15,   // time to display the warning dialog before logout (and optional callback) in seconds. 180 = 3 Minutes
        dialogTitle: 'Timeout',
        dialogText: 'Achtung: Aufgrund von Inaktivität steht ein LOGOUT bevor',

        // server-side session keep-alive timer
        sessionKeepAliveTimer: false // Ping the server at this interval in seconds. 600 = 10 Minutes
        // sessionKeepAliveTimer: false // Set to false to disable pings
    });

});
