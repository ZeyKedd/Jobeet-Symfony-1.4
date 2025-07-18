<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <title>Jobeet Admin Interface</title>
  <link rel="shortcut icon" href="/favicon.ico" />
  <?php use_stylesheet('admin.css') ?>
  <?php include_javascripts() ?>
  <?php include_stylesheets() ?>
</head>

<body>
  <div id="container">
    <div id="header">
      <h1>
        <a href="<?php echo url_for('homepage') ?>">
          <img src="/legacy/images/logo.jpg" alt="Jobeet Job Board" />
        </a>
      </h1>
    </div>

    <!-- <?php #if (!$sf_user->isAuthenticated()): ?>
      <div id="menu">
        <ul>
          <li><?php #echo link_to('Login', 'sf_guard_signin') ?></li>
        </ul>
      </div>
    <?php #else : ?> -->
      <div id="menu">
        <ul>
          <li><?php echo link_to('Jobs', 'jobeet_job') ?></li>
          <li><?php echo link_to('Categories', 'jobeet_category') ?></li>
          <li><?php echo link_to('Users', 'sf_guard_user') ?></li>
          <li>
            <a href="<?php echo url_for('jobeet_affiliate') ?>">
              Affiliates - <strong><?php echo Doctrine_Core::getTable('JobeetAffiliate')->countToBeActivated() ?></strong>
            </a>
          </li>
          <li><?php echo link_to('Logout', 'sf_guard_signout') ?></li>
        </ul>
      </div>

      <div id="content">
        <?php echo $sf_content ?>
      </div>
    <?php #endif ?>

    <div id="footer">
      <img src="/legacy/images/jobeet-mini.png" />
      powered by <a href="/">
        <img src="/legacy/images/symfony.gif" alt="symfony framework" /></a>
    </div>
  </div>
</body>

</html>