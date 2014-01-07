<h2>Report for <strong><?php echo $user->username; ?></strong></h2>

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
