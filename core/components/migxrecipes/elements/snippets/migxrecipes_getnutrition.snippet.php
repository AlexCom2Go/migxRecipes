<?php
$tpl_prefix = 'migxrecipes_';
$tpl = $tpl_prefix . 'nutritionTpl';
$tpl = $modx->getOption('tpl', $scriptProperties, $tpl);
$outputSeparator = $modx->getOption('outputSeparator', $scriptProperties, ', ');

$docid = is_object($modx->resource) ? $modx->resource->get('id') : 0;
$docid = $modx->getOption('docid', $scriptProperties, $docid);

$output = array();

if ($resource = $modx->getObject('modResource', $docid)) {
    
    $resource_properties = $resource->getProperties('migxrecipes');
    $recipe_fields = json_decode($modx->getOption('recipe', $resource_properties, ''), true);

    $modx->lexicon->load('migxrecipes:nutrition');
    //get the possible properties from lexicon
    $nutr_properties = explode(',', $modx->lexicon('migxrecipes.nutr_properties'));
    foreach ($nutr_properties as $property) {
        $prop['quantity'] = $modx->getOption('recipe_' . $property,$recipe_fields);  
        $prop['note'] = $modx->getOption('recipe_note_' . $property,$recipe_fields);       
        if (!empty($prop['quantity'])){
            $prop['property'] = $property;
            $prop['caption'] = $modx->lexicon('migxrecipes.' . $property . '_caption');
            $prop['unit'] = $modx->lexicon('migxrecipes.' . $property . '_unit');

            $output[] = $modx->getChunk($tpl,$prop);            
        }
    }
}

return implode($outputSeparator,$output);