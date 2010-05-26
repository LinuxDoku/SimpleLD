<?php
/**
 * This file starts the core and calls a lot of hooks
 *
 * @package core
 * @author  Martin Lantzsch
 * @mail    martin@linux-doku.de
 * @licence GPL
 */

// at first start the session
session_start();

// needed core files
require('packages/core/init.php');

// first hook to include new global files
packages::call('indexInclude');

// to boot your package
packages::call('systemInit');

// now call actions
packages::call('indexActions');
packages::call('indexAfterActions');

// load theme
packages::call('theme');

// last hook, e.g. for counters
packages::call('indexEnd')
?>
