<?php
// Phing 3.x compatibility shims: global Phing 2.x class names aliased to their new namespaced equivalents
if (!class_exists('Task', false)) {
    class_alias(\Phing\Task::class, 'Task');
}
if (!class_exists('Project', false)) {
    class_alias(\Phing\Project::class, 'Project');
}
if (!class_exists('IOException', false)) {
    class_alias(\Phing\Io\IOException::class, 'IOException');
}
if (!class_exists('FileWriter', false)) {
    class_alias(\Phing\Io\FileWriter::class, 'FileWriter');
}
if (!class_exists('FileSystem', false)) {
    class_alias(\Phing\Io\FileSystem::class, 'FileSystem');
}
if (!class_exists('Mapper', false)) {
    class_alias(\Phing\Type\Mapper::class, 'Mapper');
}
if (!class_exists('Properties', false)) {
    class_alias(\Phing\Util\Properties::class, 'Properties');
}
