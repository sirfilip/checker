<form class="form-signin" role="form" action="" method="post">
    <h2 class="form-signin-heading">Change Password</h2>
    <?php if($errors): ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <input class="form-control" placeholder="Password" required="" type="password" name="password" />
    <input class="form-control" placeholder="Confirm" required="" type="password" name="passconf" />
    <button class="btn btn-lg btn-primary btn-block" type="submit">Change Password</button>
</form>

