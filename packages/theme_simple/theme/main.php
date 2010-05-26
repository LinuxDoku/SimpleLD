<html>
<head>
  <title><?php print core::getConf('core', 'title') ?> <?php packages::call('pageHeaderTitle'); ?></title>
  <link rel='stylesheet' type='text/css' href='packages/theme_simple/theme/style.css' />
  <?php packages::call('pageHeader'); ?>
</head>
<body>
  <div class='wrapper'>
    <div class='header'>
      <b><?php print core::getConf('core', 'title') ?></b>
    </div>
    <div class='menu'>
        <ul>
        <?php print $top ?>
        </ul>
        <?php packages::call('pageMenuTop'); ?>
    </div>
    <div class='content'>
        <?php packages::call('pageContent'); ?>
    </div>
  </div>
  <div class='footer'> <?php packages::call('pageFooter') ?> </div>
</body>
