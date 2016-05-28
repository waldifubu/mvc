<?php
# View Index

namespace View;

echo "<h1>Hauptseite</h1>";
?>

<h4>
    <a href="<?= URL ?>index/details">Details ansehen</a>
</h4>

<style>
    .ui-dialog.ui-widget.ui-widget-content.ui-corner-all.ui-front.ui-dialog-buttons.ui-draggable.ui-resizable {
        background-color: #fff;
        text-align: center;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #4c3000;
    }
    .ui-dialog-buttonset button[type='button'] {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
    }

    .ui-dialog-buttonset button[type='button']:nth-child(2) {
        background-color: #f44336;
    }

    #idletimer_warning_dialog #countdownDisplay {
        font-weight: bolder;
        color: #b92c28;
        font-size: 20px;
    }
</style>