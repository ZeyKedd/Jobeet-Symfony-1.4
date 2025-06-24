<?php use_stylesheet('job.css') ?>
<?php use_helper('Text') ?>
<?php slot('title', sprintf('%s is looking for a %s', $job->getCompany(), $job->getPosition())) ?>

<div id="job">

  <!-- Barra Admin -->
  <?php if ($sf_request->getParameter('token') == $job->getToken()): ?>
    <?php include_partial('sfJobeetJob/admin', array('job' => $job)) ?>
  <?php endif ?>

  <h1><?php echo $job->getCompany() ?></h1>
  <h2><?php echo $job->getLocation() ?></h2>
  <h3>
    <?php echo $job->getPosition() ?>
    <small> - <?php echo $job->getType() ?></small>
  </h3>


  <?php if ($job->getLogo()): ?>
    <div class="logo">
      <a href="<?php echo $job->getUrl() ?>" target="_blank">
        <img src="/uploads/jobs/<?php echo $job->getLogo() ?>" alt="<?php echo $job->getCompany() ?> logo" />
      </a>
    </div>
  <?php endif; ?>

  <div class="description">
    <?php echo simple_format_text($job->getDescription()) ?>
  </div>

  <h4>Como aplicar?</h4>

  <p class="how_to_apply"><?php echo $job->getHowToApply() ?></p>

  <div class="meta">
    <small>publicado el <?php echo $job->getDateTimeObject('created_at')->format('m/d/Y') ?></small>
  </div>

  <div style="padding: 20px 0">
    <a href="<?php echo url_for('job_edit', $job) ?>">
      Edit
    </a>
  </div>
</div>