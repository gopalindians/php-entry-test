<?php defined( 'APP_VERSION' ) or die(); ?>
<div class="row justify-content-md-center">
    <div class="col">
        <div class="alert alert-danger" role="alert">
			<?= $error['message'] ?? 'error' ?>
            If you are lost go to
            <a href="<?= $config['app']['APP_URL'] . $config['app']['APP_EXTRA_URL'] ?>"
               class="alert-link">Home</a>
        </div>
    </div>
</div>


