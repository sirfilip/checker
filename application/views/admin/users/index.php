<a href="<?php echo site_url('admin/users/create'); ?>" class="btn btn-primary" role="button">Create User</a>
<table class="table">
    <thead>
        <tr>
            <th>User</th>
            <th>Role</th>
            <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
        <tr>
            <td><?php echo $user->username; ?></td>
            <td><?php echo $user->is_admin() ? 'Admin' : 'User' ?></td>
            <td>
                <?php if (! $user->is_admin()): ?>
                <a href="<?php echo site_url("admin/checkins/{$user->id}"); ?>">Checkins</a> |
                <a href="<?php echo site_url("admin/users/delete/{$user->id}"); ?>">Delete</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
</table>
