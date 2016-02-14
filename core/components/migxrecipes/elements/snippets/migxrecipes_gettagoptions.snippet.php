<?php
$group = $modx->getOption('group',$scriptProperties,0);

$tags = $modx->runSnippet('migxLoopCollection', array(
    'packageName' => 'tagger',
    'classname' => 'TaggerTag',
    'where' => '{"group":"' . $group . '"}',
    'outputSeparator' => '||',
    'tpl' => '@CODE:[[+tag]]'));
return $tags;