<?php

$this->modx->lexicon->load('migxrecipes:nutrition');

$nutr_properties = explode(',', $this->modx->lexicon('migxrecipes.nutr_properties'));

$tabs = $this->modx->getOption('tabs', $this->customconfigs, array());
$fields = array();
$i = 1;
foreach ($nutr_properties as $property) {
    $caption = $this->modx->lexicon('migxrecipes.' . $property . '_caption');
    $unit = $this->modx->lexicon('migxrecipes.' . $property . '_unit');
    $unit = !empty($unit) ? ' (' . $unit . ')' : '';

    $field['field'] = 'recipe_' . $property;
    $field['caption'] = $caption . $unit;
    $field['description'] = $this->modx->lexicon('migxrecipes.' . $property . '_desc');
    $field['MIGXlayoutid'] = $i;
    $field['MIGXcolumnid'] = 1;
    $field['MIGXcolumnwidth'] = 'calc(50% - 10px);';
    $field['MIGXcolumnminwidth'] = '300px';
    $fields[] = $field;
    
    $field['field'] = 'recipe_note_' . $property;
    $field['caption'] = $caption . ' note';
    $field['description'] = 'note for ' . $property;
    $field['MIGXlayoutid'] = $i;
    $field['MIGXcolumnid'] = 2;
    $field['MIGXcolumnwidth'] = 'calc(50% - 10px);';
    $field['MIGXcolumnminwidth'] = '300px';    
    $fields[] = $field;
    $i++;    
}

$field['field'] = 'recipe_nutrition_text';
$field['caption'] = 'Nutrition Text';
$field['description'] = '';
$field['inputTVtype'] = 'textarea';
$fields[] = $field;

$tabs[] = array('caption' => $this->modx->lexicon('migxrecipes.nutrition'), 'fields' => $fields);

$this->customconfigs['tabs'] = $tabs;
