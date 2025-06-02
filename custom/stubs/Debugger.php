<?php
namespace Codernix\Debugger;

class Data {
    public static function dump(): void
    {
        $callEnv    = php_sapi_name();
        $args       = func_get_args();
        array_unshift($args, (strtolower($callEnv) == "cli" ? "%s" : "<pre>%s</pre>")."\n");

        for ($i = 1, $l = count($args); $i < $l; $i++) {
            $args[$i]   = var_export($args[$i], true);
            $args[$i]   = strtolower($callEnv) == "cli" ? $args[$i] : htmlspecialchars($args[$i]);
        }

        call_user_func_array('printf', $args);
    }
    public static function dumpRest(): void
    {
        $args       = func_get_args();
        array_unshift($args, "%s" . "\n");

        for ($i = 1, $l = count($args); $i < $l; $i++) {
            $args[$i]   = var_export($args[$i], true);
        }
        call_user_func_array('printf', $args);
    }
}
