<?php
$value = $modx->getOption('value',$scriptProperties,'');

$tempParams = $modx->fromJson($modx->getOption('tempParams',$_REQUEST,''));
$type = $modx->getOption('type',$tempParams,$type);
if (empty($type)){
    $tempParams = $modx->fromJson($modx->getOption('record_json',$_REQUEST,''));
    $type = $modx->getOption('type',$tempParams,$type);    
}

if ($type != $value){
    return '1';
    
}

return '';