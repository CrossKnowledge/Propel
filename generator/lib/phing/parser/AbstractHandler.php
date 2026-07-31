<?php
// Phing 3.x compatibility shim: AbstractHandler moved to \Phing\Parser namespace
if (!class_exists('AbstractHandler', false)) {
    class_alias(\Phing\Parser\AbstractHandler::class, 'AbstractHandler');
}
