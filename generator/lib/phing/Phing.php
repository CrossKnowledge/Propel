<?php
// Phing 3.x compatibility shim: Phing class moved to \Phing namespace
if (!class_exists('Phing', false)) {
    class_alias(\Phing\Phing::class, 'Phing');
}
