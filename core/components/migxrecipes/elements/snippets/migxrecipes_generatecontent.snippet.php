<?php
$docid = is_object($modx->resource) ? $modx->resource->get('id') : 0;
$docid = $modx->getOption('docid', $scriptProperties, $docid);

if ($resource = $modx->getObject('modResource', $docid)) {
    $record = $resource->toArray();
    $resource_properties = $resource->getProperties('migxrecipes');
    $recipe_fields = json_decode($modx->getOption('recipe', $resource_properties, ''), true);
    if (is_array($recipe_fields)) {
        $record = array_merge($record, $recipe_fields);
    }



    //incgredients
    $tpl_prefix = $modx->getOption('migxrecipes.tpl_prefix', null, 'migxrecipes_');
    //$items = json_decode($modx->getOption('recipe_ingredients', $data, ''), true);
    $items = json_decode($modx->getOption('recipe_ingredients_groups', $record, ''), true);
    $group_output = buildGroups($items, $tpl_prefix . 'ingredientTpl', $tpl_prefix . 'ingredientsGroupTpl', 'ingredients');
    $record['recipe_ingredients'] = implode("\n", $group_output);
    
    $items = json_decode($modx->getOption('recipe_instructions_groups', $record, ''), true);
    $group_output = buildGroups($items, $tpl_prefix . 'instructionTpl', $tpl_prefix . 'instructionsGroupTpl', 'instructions');
    $record['recipe_instructions'] = implode("\n", $group_output);    

    $content = $modx->getChunk($tpl_prefix . 'contentTpl', $record);
    
    if (is_object($modx->resource) && $modx->resource->get('id') == $docid){
        //we are at the resource itself
        $modx->resource->setContent($content);
        $modx->resource->save();
    }else{
        $resource->set('content', $content);
        $resource->save();        
    }
    

}


function buildGroups($groups, $innerTpl, $outerTpl, $itemsfield = 'items') {
    global $modx;
    $group_output = array();
    if (is_array($groups)) {

        $group_idx = 1;
        foreach ($groups as $group) {
            $output = array();
            $idx = 1;
            if (isset($group[$itemsfield])) {
                $items = json_decode($group[$itemsfield], true);
                if (is_array($items)) {
                    foreach ($items as $item) {
                        $item['_idx'] = $idx;
                        $output[] = $modx->getChunk($innerTpl, $item);
                        $idx++;
                    }
                }
            }
            $group['_idx'] = $group_idx;
            $group['output'] = implode("\n", $output);
            $group_output[] = $modx->getChunk($outerTpl, $group);
            $group_idx++;
        }

    }
    return $group_output;
}