<?php
/**
 * This file starts the core and calls a lot of hooks
 *
 * @package core
 * @author  Martin Lantzsch
 * @mail    martin@linux-doku.de
 * @licence GPL
 */

// needed core files
require('packages/core/init.php');

// first hook to include new global files
packages::call('indexInclude');

// now call actions
packages::call('indexActions');

// load theme
packages::call('theme');

packages::call('indexEnd')
?>
