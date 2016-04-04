<?php
use \Core\Session;
use Util\Auth;

Session::init();
?>
<!doctype html>
<html>
<head>
    <title><?= (isset($this->title)) ? $this->title : 'MVC Kramm' ?></title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" type="image/x-icon" href="<?= URL ?>public/img/gameboy.ico"/>
    <link rel="stylesheet" href="<?= URL ?>public/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?= URL ?>public/css/default.css"/>
    <script src="<?= URL ?>public/js/jquery.min.js"></script>
    <script src="<?= URL ?>public/js/jquery-ui.min.js"></script>
    <script src="<?= URL ?>public/js/bootstrap.min.js"></script>

    <?php
    if ($this->title != 'Login') {
        echo '<script src="' . URL . 'public/js/store.min.js"></script>';
        echo '<script src="' . URL . 'public/js/jquery-idleTimeout.min.js"></script>';
        echo '<script src="' . URL . 'public/js/idleTimeout.js"></script>';
    }
    ?>

    <script src="<?= URL ?>public/js/custom.js"></script>

    <?php
    if (isset($this->css)) {
        foreach ($this->css as $cssfile) {
            echo ' <link rel="stylesheet" href="' . URL . 'view/' . $cssfile . '"/>';
        }
    }
    ?>

    <?php
    if (isset($this->js)) {
        foreach ($this->js as $jsfile) {
            echo '<script src="' . URL . 'view/' . $jsfile . '"></script>';
        }
    }
    ?>
</head>
<body>

<header id="header">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-collapse">
            <a class="navbar-brand" href="#">MVC</a>
            <ul class="nav navbar-nav">
                <li><a href="<?= URL ?>">
                        <button type="button" class="btn btn-primary">Index</button>
                    </a></li>
                <?php if (Session::get('loggedIn') == false) : ?>
                    <li><a href="<?= URL ?>help">
                            <button type="button" class="btn btn-info">
                                Help
                            </button>
                        </a></li>
                <?php endif; ?>

                <?php if (Session::get('loggedIn') == true) : ?>
                <li><a href="<?= URL ?>dashboard">
                        <button type="button" class="btn btn-warning">Dashboard</button>
                    </a></li>
                <li><a href="<?= URL ?>note">
                        <button type="button" class="btn btn-default">Notes</button>
                    </a></li>
                <li><a href="<?= URL ?>help">
                        <button type="button" class="btn btn-success">Help</button>
                    </a></li>
                <?php if (Session::get('role') == 'owner') : ?>
                    <li><a href="<?= URL ?>user">
                            <button type="button" class="btn btn-info">Users</button>
                        </a></li>
                <?php endif; ?>
                <li><a href="<?= URL ?>pizza" style="margin-top: 4px;" class="btn btn-default btn-link btn-lg"><span
                            class="glyphicon glyphicon-globe"></span> My Pizzas</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right" style="margin-right: 20px">
                <li><?= '<h4 style="margin-top:23px">Logged in as: <b>' . $_SESSION['username'] . '</b></h4>' ?></li>
                <li><a href="<?= URL ?>dashboard/logout">
                        <button type="button" class="btn btn-danger">Logout</button>
                    </a></li>
                <?php else : ?>
            </ul>
            <ul class="nav navbar-nav navbar-right" style="margin-right: 20px">
                <li><a href="<?= URL ?>login">
                        <button type="button" class="btn btn-success">Login</button>
                    </a></li>
                <?php endif; ?>
            </ul>

        </div>
    </nav>
</header>

<div class="container" style="height: 100%">
    <div class="jumbotron">