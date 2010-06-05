<html>
<head>
  <title><?php print core::getConf('core', 'title') ?> <?php packages::call('themePageHeaderTitle'); ?></title>
  <link rel='stylesheet' type='text/css' href='packages/theme_simple/theme/style.css' />
  <?php packages::call('themePageHeader'); ?>
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
        <?php packages::call('themePageMenuTop'); ?>
    </div>
    <div class='content'>