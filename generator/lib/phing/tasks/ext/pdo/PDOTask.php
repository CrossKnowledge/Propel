<?php
// Phing 3.x compatibility shim: PDOTask moved to \Phing\Task\System\Pdo namespace
if (!class_exists('PDOTask', false)) {
    class_alias(\Phing\Task\System\Pdo\PDOTask::class, 'PDOTask');
}
