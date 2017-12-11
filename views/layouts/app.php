<?php defined( 'APP_VERSION' ) or die(); ?>
<!doctype html>
<html lang="en">
<head>
    <title><?= isset($title) ? $title : '' ?> [C][u][e] Blocks </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no,user-scalable=no">
    <meta name="app-url" content="<?= Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' ) ?>">
    <meta name="current-route" content="<?= Config::getCurrentRoute() ?>">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <script src="//code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        div {
            margin-bottom: 10px;
            position: relative;
        }

        input[type="number"] {
            width: 100px;
        }

        input + span {
            padding-right: 30px;
        }

        input:invalid + span:after {
            position: absolute;
            content: '✖';
            padding-left: 5px;
            color: #8b0000;
        }

        input:valid + span:after {
            position: absolute;
            content: '✓';
            padding-left: 5px;
            color: #009000;
        }


    </style>
</head>
<body>

<div class="container">
    <!-- Image and text -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?= Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' ); ?>">
            PHP Entry Test
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 pull-right">
				<?php if ( isset( $_SESSION['user_name'] ) && isset( $_SESSION['password'] ) ): ?>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?= Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' ) ?>/admin/dashboard">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?= Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' ) ?>/adminLogout">Logout </a>
                    </li>

				<?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?= Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' ) ?>/admin">Admin
                            Login </a>
                    </li>
				<?php endif; ?>
            </ul>
        </div>
    </nav>

    <div style="padding: 15px;">
		<?= $content ?? '' ?>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
        crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
        crossorigin="anonymous"></script>
</body>
</html>