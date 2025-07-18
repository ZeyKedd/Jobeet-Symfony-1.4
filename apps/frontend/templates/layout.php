<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">


<head>
  <title><?php include_slot('title') ?></title>
  <link rel="shortcut icon" href="/web/favicon.ico" />
  <link rel="alternate" type="application/atom+xml" title="Latest Jobs"
    href="<?php echo url_for('job', array('sf_format' => 'atom'), true) ?>" />
  <?php include_stylesheets() ?>
  <?php use_javascript('jquery-1.3.2.min.js') ?>
  <?php use_javascript('search.js') ?>
  <?php include_javascripts() ?>

</head>

<body>
  <div id="container">
    <div id="header">
      <div class="content">
        <h1><a href="<?php echo url_for('@homepage') ?>">
            <img src="/legacy/images/logo.jpg" alt="Jobeet Job Board" />
          </a></h1>

        <div id="sub_header">
          <div class="post">
            <div>
              <a href="<?php echo url_for('@job_new') ?>">Post a Job</a>
            </div>
          </div>

          <div class="search">
            <h2>Ask for a job</h2>
            <form action="<?php echo url_for('job_search') ?>" method="get">
              <input type="text" name="query" value="<?php echo $sf_request->getParameter('query') ?>" id="search_keywords" />
              <input type="submit" value="search" />
              <img id="loader" src="/images/loader.gif" style="vertical-align: middle; display: none" />
              <div class="help">
                Enter some keywords (city, country, position, ...)
              </div>
            </form>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div id="content">

      <!-- Definir los flashes en el layout -->
      <?php if ($sf_user->hasFlash('notice')): ?>
        <div class="flash_notice">
          <?php echo $sf_user->getFlash('notice') ?>
        </div>
      <?php endif; ?>

      <?php if ($sf_user->hasFlash('error')): ?>
        <div class="flash_error">
          <?php echo $sf_user->getFlash('error') ?>
        </div>
      <?php endif; ?>

      <div class="content">

        <div class="job_history">
          <h2 style="text-align: center;"> Recent viewed jobs:</h2>
          <ul>
            <?php foreach ($sf_user->getJobHistory() as $job): ?>
              <li>
                <?php echo link_to($job->getPosition() . ' - ' . $job->getCompany(), 'job_show_user', $job) ?>
              </li>
            <?php endforeach ?>
          </ul>
        </div>

        <?php echo $sf_content ?>
      </div>
    </div>

    <div id="footer">
      <div class="content">
        <span class="symfony">
          <img src="/legacy/images/jobeet-mini.png" />
          powered by <a href="/">
            <img src="/legacy/images/symfony.gif" alt="symfony framework" />
          </a>
        </span>
        <ul>
          <li>
            <a href=""> <?php echo __('About Jobeet') ?></a>
          </li>
          <li class="feed">
            <?php echo link_to(__('Full Feed'), 'job', array('sf_format' => 'atom')) ?>
          </li>
          <li>
            <a href=""><?php echo link_to(__('Jobeet API'), 'affiliate_login') ?></a>
          </li>
          <li class="last">
            <?php echo link_to(__('Become an affiliate'), 'affiliate_new') ?>
          </li>
        </ul>
        <?php include_component('sfJobeetLanguage', 'language') ?>
      </div>
    </div>
  </div>
</body>

</html>

<style>
  .job_history ul
{
  display: flex;
  align-items: center;
  justify-content: center;
  width: 760px;
  margin: 0 auto;
  padding: 10px;
}

.job_history li{
  text-align: center;
  display: contents;
}
.job_history li::before
{
  color: #104961;
  content: '|';
}

.job_history a{
  text-decoration: none;
}
</style>