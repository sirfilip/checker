<form class="form-signin" role="form" action="" method="post">
    <h2 class="form-signin-heading">Please sign in</h2>
    <?php if($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <input class="form-control" placeholder="Username" required="" autofocus="" type="text" name="username" />
    <input class="form-control" placeholder="Password" required="" type="password" name="password" />
    <label class="checkbox">
      <input value="1" type="checkbox" name="remember_me"/> Remember me
    </label>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
