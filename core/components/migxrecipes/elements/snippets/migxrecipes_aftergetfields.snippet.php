<?php
$object = &$modx->getOption('object', $scriptProperties, null);
$properties = $modx->getOption('scriptProperties', $scriptProperties, array());
$record = $object->get('record_fields');

$configs = $modx->getOption('configs', $properties, '');

$resource_id = $object->get('id');
$taggergroups = $modx->getOption('migxrecipes.taggergroups');
if (!empty($taggergroups)){
    $taggergroups = explode(',',$taggergroups);
    foreach ($taggergroups as $group_id){
        $tags = $modx->runSnippet('migxLoopCollection',array(
            'packageName'=>'tagger',
            'classname'=>'TaggerTagResource',
            'joins'=>'[{"alias":"Tag"}]',
            'where'=>'{"Tag.group":"'.$group_id.'","resource":"'.$resource_id.'"}',
            'outputSeparator'=>'||',
            'tpl'=>'@CODE:[[+Tag_tag]]'
        ));

 
        $record['tagger_' . $group_id] = $tags;
    }
}

$resource_properties = $object->getProperties('migxrecipes');
$recipe_fields = json_decode($modx->getOption('recipe',$resource_properties,''),true);
if (is_array($recipe_fields)){
    $record = array_merge($record,$recipe_fields);
}

$object->set('record_fields', $record);
return '';