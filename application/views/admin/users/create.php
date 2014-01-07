<form class="form-signin" role="form" action="" method="post">
    <h2 class="form-signin-heading">Create User</h2>
    <?php if($errors): ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <input class="form-control" placeholder="Username" required="" autofocus="" type="text" name="username" />
    <input class="form-control" placeholder="Email" required="" autofocus="" type="text" name="email" />
    <input class="form-control" placeholder="Password" required="" type="password" name="password" />
    <input class="form-control" placeholder="Confirm" required="" type="password" name="passconf" />
    <button class="btn btn-lg btn-primary btn-block" type="submit">Create User</button>
</form>
