<?php

/**
 * migxRecipes
 *
 * Copyright 2016 by Bruno Perner <b.perner@gmx.de>
 *
 * This file is part of migxRecipes, for editing custom-tables in MODx Revolution CMP.
 *
 * migxRecipes is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * migxRecipes is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * migxRecipes; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA 
 *
 * @package migxRecipes
 */
/**
 * Update and Create-processor for migxRecipes
 *
 * @package migxRecipes
 * @subpackage processors
 */
//if (!$modx->hasPermission('quip.thread_view')) return $modx->error->failure($modx->lexicon('access_denied'));


if (empty($scriptProperties['object_id'])) {
    $updateerror = true;
    $errormsg = $modx->lexicon('quip.thread_err_ns');
    return;
}

$config = $modx->migx->customconfigs;

$includeTVList = $modx->getOption('includeTVList', $config, '');
$includeTVList = !empty($includeTVList) ? explode(',', $includeTVList) : array();
$includeTVs = $modx->getOption('includeTVs', $config, false);
$classname = 'modResource';
/*
function buildGroupsX($items, $innerTpl, $outerTpl) {
global $modx;

if (is_array($items)) {
$idx = 1;
$group_idx = 0;
$groups = array();
//first group
$group = array();
$group['group'] = array();
$group['items'] = array();
foreach ($items as $item) {
$type = isset($item['type']) ? $item['type'] : '';
if ($type == 'group') {
if ($group_idx > 0) {
$groups[] = $group;
}
$group_idx++;
$group = array();
$group['group'] = $item;
$group['items'] = array();
$idx = 1;
} else {
$group['items'][] = $item;
}
$item['_idx'] = $idx;
$idx++;
}
//last group
$groups[] = $group;

$group_output = array();
foreach ($groups as $group) {
$output = array();
foreach ($group['items'] as $item) {
$output[] = $modx->getChunk($innerTpl, $item);
}
$group = isset($group['group']) ? $group['group'] : array();
$group['output'] = implode("\n", $output);
$group_output[] = $modx->getChunk($outerTpl, $group);
}

}
return $group_output;
}
*/

//$saveTVs = false;
/*
if ($modx->lexicon) {
$modx->lexicon->load($packageName . ':default');
}
*/
if (isset($scriptProperties['data'])) {
    //$scriptProperties = array_merge($scriptProperties, $modx->fromJson($scriptProperties['data']));
    $data = $modx->fromJson($scriptProperties['data']);
}

$data['id'] = $modx->getOption('object_id', $scriptProperties, null);

$parent = $modx->getOption('resource_id', $scriptProperties, false);
$checkresponse = true;
$handleRecipe = false;

$task = $modx->getOption('task', $scriptProperties, '');

switch ($task) {
    case 'publish':
        $response = $modx->runProcessor('resource/publish', $data);
        break;
    case 'unpublish':
        $response = $modx->runProcessor('resource/unpublish', $data);
        break;
    case 'delete':
        $response = $modx->runProcessor('resource/delete', $data);
        break;
    case 'recall':
        $object = $modx->getObject($classname, $scriptProperties['object_id']);
        $object->set('deleted', '0');
        $object->save();
        $checkresponse = false;
        break;

    default:

        //$modx->migx->loadConfigs();
        //$tabs = $modx->migx->getTabs();
        $handleRecipe = true;

        $data['context_key'] = $modx->getOption('context_key', $data, $scriptProperties['wctx']);
        if ($includeTVs) {
            $c = $modx->newQuery('modTemplateVar');
            $collection = $modx->getCollection('modTemplateVar', $c);
            foreach ($collection as $tv) {
                $tvname = $tv->get('name');
                if (isset($data[$tvname])) {
                    $value = $data[$tvname];
                    $data['tv' . $tv->get('id')] = $value;
                    unset($data[$tvname]);
                }
            }

            $data['tvs'] = 1;
        }

        //handle tagger-tags
        foreach ($data as $key => $value) {
            if (substr($key,-4) != '_new' && substr($key, 0, 7) == 'tagger_') {
                $new_values = array();
                if (isset($data[$key.'_new'])){
                    $new_values = explode(',',$data[$key.'_new']);
                }
                $value = is_array($value) ? $value : explode(',',$value);
                $values = array();
                foreach ($value as $val){
                    if (!empty($val)){
                        $values[] = trim($val);
                    }
                }
                foreach ($new_values as $val){
                    if (!empty($val)){
                        $values[] = trim($val);
                    }
                }                
                $data[str_replace('_','-',$key)] = implode(',',$values);
                
            }
        }

        if ($scriptProperties['object_id'] == 'new') {
            //$object = $modx->newObject($classname);
            if (!empty($parent)) {
                $data['parent'] = $parent;
            }
            $response = $modx->runProcessor('resource/create', $data);
        } else {
            //$object = $modx->getObject($classname, $scriptProperties['object_id']);
            //if (empty($object)) return $modx->error->failure($modx->lexicon('quip.thread_err_nf'));
            $response = $modx->runProcessor('resource/update', $data);
        }
}

if ($checkresponse) {
    if ($response->isError()) {
        $updateerror = true;
        $errormsg = $response->getMessage();
        $handleRecipe = false;
    }
    $object = $response->getObject();
}

if ($handleRecipe && isset($object['id']) && $resource = $modx->getObject('modResource', $object['id'])) {

    $fields = array();
    foreach ($data as $key => $value) {
        if (substr($key, 0, 7) == 'recipe_') {
            $fields[$key] = $value;
        }
    }
    $properties = array();
    $properties['recipe'] = json_encode($fields);
    $resource->setProperties($properties, 'migxrecipes', true);
    $resource->save();

    $modx->runSnippet('migxrecipes_generateContent', array('docid' => $object['id']));

}

// clear cache for all contexts $collection = $modx->getCollection('modContext')
;
foreach ($collection as $context) {
    $contexts[] = $context->get('key');
}
$modx->cacheManager->refresh(array(
    'db' => array(),
    'auto_publish' => array('contexts' => $contexts),
    'context_settings' => array('contexts' => $contexts),
    'resource' => array('contexts' => $contexts),
    ));
