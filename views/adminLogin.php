<?php defined( 'APP_VERSION' ) or die(); ?>
<div class="row justify-content-md-center">
    <div class="col-md-6">

		<?php flash( 'warning' ) ?>

		<?php if ( isset( $result ) ): ?>
			<?php foreach ( $result as $key => $item ): ?>
                <div class="alert alert-danger">
					<?= $item ?>
                </div>
			<?php endforeach; ?>
		<?php endif; ?>

        <form action="//<?= $_SERVER['HTTP_HOST'] . '/' . Config::get( 'app.APP_EXTRA_URL' ) ?>handleAdminLogin"
              method="POST">
            <div class="form-row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="first_name"
                               placeholder="User name" autocomplete="off" name="user_name" required>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="password" class="form-control" id="last_name" required
                               placeholder="Password" autocomplete="off" name="password">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>