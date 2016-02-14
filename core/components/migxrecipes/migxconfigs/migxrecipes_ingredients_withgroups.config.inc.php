<?php

//$gridactionbuttons['add_formtab']['text'] = "'[[%migx.add_formtab]]'";
$gridactionbuttons['add_ing']['text'] = "'Add Ingredient'";
$gridactionbuttons['add_ing']['handler'] = 'this.addIng';
$gridactionbuttons['add_ing']['scope'] = 'this';
$gridactionbuttons['add_ing']['standalone'] = '1';
$gridactionbuttons['add_ing']['active'] = 1;
$gridfunctions['this.addIng'] = "
addIng: function(btn,e) {
        var s=this.getStore();
        this.loadWin(btn,e,s.getCount(),'a',Ext.util.JSON.encode({'type':'ingredient'}));   
	}
";

$gridactionbuttons['add_group']['text'] = "'Add Grouping'";
$gridactionbuttons['add_group']['handler'] = 'this.addGroup';
$gridactionbuttons['add_group']['scope'] = 'this';
$gridactionbuttons['add_group']['standalone'] = '1';
$gridactionbuttons['add_group']['active'] = 1;
$gridfunctions['this.addGroup'] = "
addGroup: function(btn,e) {
        var s=this.getStore();
        this.loadWin(btn,e,s.getCount(),'a',Ext.util.JSON.encode({'type':'group'}));   
	}
";