<?php
/**
 * @author : Abou-Bakr Seddik Ouahabi <aboubakr.ouahabi@innowise.com>
 *
 * Purpose: this is a dummy Namespace to bypass Phing's Failure for loading the right platform to generate the tasks.
 */
// Shim for legacy Phing include_once('platform/Platform.php')
namespace CK\Generator\Lib\Platform;

use CK\Generator\Lib\Platform\MysqlPlatform;

if (!class_exists('Platform')) {
    class_alias(MysqlPlatform::class, 'Platform');
}
