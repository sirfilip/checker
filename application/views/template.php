<!doctype html>
<html lang="en">
<head>
    <title><?php echo $template_title ?></title>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
    <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>" />
    <link rel="stylesheet" href="<?php echo base_url("assets/css/form.css"); ?>" />
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo site_url('/'); ?>">
                <?php echo $this->auth->current_user()->is_admin() ? "Checker Admin" : "Checker Dashboard" ?>
            </a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo site_url('signout'); ?>">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <?php foreach(array('danger', 'success') as $alert): ?>
            <?php if($this->session->flashdata($alert)): ?>
                <div class="alert alert-<?php echo $alert; ?>">
                    <?php echo $this->session->flashdata($alert); ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php echo $template_content ?>
    </div>
</body>
</html>
