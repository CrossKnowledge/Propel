<?php
// Phing 3.x compatibility shim: BuildException moved to \Phing\Exception namespace
if (!class_exists('BuildException', false)) {
    class_alias(\Phing\Exception\BuildException::class, 'BuildException');
}
