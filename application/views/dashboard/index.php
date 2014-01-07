<a href="<?php echo site_url('dashboard/change_password'); ?>" 
   class="pull-right btn btn-primary">Change Password</a>

<?php if ($checkin_in_progress): ?>
    <p>
        Elapsed time: <strong><?php echo $checkin_in_progress->elapsed_time(); ?></strong>
    </p>
    <form class="form-inline" role="form" 
          action="<?php echo site_url('dashboard/checkout'); ?>" method="post">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Description" 
                   required="true" name="description" />
        </div>
        <button type="submit" class="btn btn-default">Checkout</button>
    </form>
<?php else: ?>
    <a href="<?php echo site_url('dashboard/checkin'); ?>" 
       class="btn btn-primary">Checkin</a>
<?php endif; ?>


<table class="table">
    <thead>
        <tr>
            <th>Arrive Time</th>
            <th>Departure Time</th>
            <th>Duration</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($checkout_history as $checkout):  ?>
        <tr>
            <td><?php echo $checkout->checkedin_at; ?></td>
            <td><?php echo $checkout->checkedout_at; ?></td>
            <td><?php echo $checkout->duration(); ?></td>
            <td><?php echo $checkout->description(); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="pagination">
    <?php echo $pagination; ?>
</div>