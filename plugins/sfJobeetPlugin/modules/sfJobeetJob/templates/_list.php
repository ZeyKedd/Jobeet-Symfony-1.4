<table class="jobs">

<!-- Quitar al hacer test  -->

  <tr class="even">
    <td class="location" style="text-align: center;">
      Location
    </td>
    <td class="location" style="text-align: center;">
      Position
    </td>
    <td class="location" style="text-align: center;">
      Company
    </td>
  </tr>

  <?php foreach ($jobs as $i => $job): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
      <td class="location">
        <?php echo $job->getLocation() ?>
      </td>
      <td class="position">
        <?php echo link_to($job->getPosition(), 'job_show_user', $job) ?>
      </td>
      <td class="company">
        <?php echo $job->getCompany() ?>
      </td>
    </tr>
  <?php endforeach; ?>
</table>