<?php
// Phing 3.x compatibility shim: Reader moved to \Phing\Io namespace
if (!class_exists('Reader', false)) {
    class_alias(\Phing\Io\Reader::class, 'Reader');
}
