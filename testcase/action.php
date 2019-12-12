<?php
/**
 * module-testcase:/unit/webpack/action.php
 *
 * @creation  2019-03-22
 * @version   1.0
 * @package   module-testcase
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
/* @var $app     \OP\UNIT\App     */
/* @var $webpack \OP\UNIT\WebPack */
/* @var $args     array           */
$webpack = $app->Unit('WebPack');
$webpack->Auto('testcase.js');
$webpack->Auto('testcase.js');
