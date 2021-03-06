{
  "id":6,
  "name":"migxrecipes_ingredients_withgroups",
  "formtabs":[
    {
      "caption":"undefined",
      "pos":1,
      "MIGX_id":14,
      "MIGXtype":"formtab",
      "MIGXtyperender":"<h3>formtab<\/h3>",
      "fields":[
        {
          "MIGX_id":32,
          "MIGXtype":"field",
          "MIGXtyperender":"<h3>...field<\/h3>",
          "field":"title",
          "caption":"Ingredient",
          "description":"",
          "description_is_code":"0",
          "inputTV":"",
          "inputTVtype":"",
          "validation":"",
          "configs":"",
          "restrictive_condition":"[[migxrecipes_checkType? &value=`ingredient`]]",
          "display":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":"",
          "useDefaultIfEmpty":"0",
          "MIGXlayoutid":0,
          "MIGXcolumnid":0,
          "MIGXcolumnwidth":0,
          "MIGXcolumnminwidth":"",
          "MIGXcolumnstyle":"",
          "MIGXcolumncaption":"",
          "MIGXlayoutstyle":"",
          "MIGXlayoutcaption":"",
          "pos":1
        },
        {
          "MIGX_id":33,
          "MIGXtype":"field",
          "MIGXtyperender":"<h3>...field<\/h3>",
          "field":"type",
          "caption":"",
          "description":"",
          "description_is_code":"0",
          "inputTV":"",
          "inputTVtype":"hidden",
          "validation":"",
          "configs":"",
          "restrictive_condition":"[[migxrecipes_checkType? &value=`ingredient`]]",
          "display":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":"ingredient",
          "useDefaultIfEmpty":"0",
          "MIGXlayoutid":0,
          "MIGXcolumnid":0,
          "MIGXcolumnwidth":0,
          "MIGXcolumnminwidth":"",
          "MIGXcolumnstyle":"",
          "MIGXcolumncaption":"",
          "MIGXlayoutstyle":"",
          "MIGXlayoutcaption":"",
          "pos":2
        },
        {
          "MIGX_id":34,
          "MIGXtype":"field",
          "MIGXtyperender":"<h3>...field<\/h3>",
          "field":"title",
          "caption":"Group Title",
          "description":"",
          "description_is_code":"0",
          "inputTV":"",
          "inputTVtype":"",
          "validation":"",
          "configs":"",
          "restrictive_condition":"[[migxrecipes_checkType? &value=`group`]]",
          "display":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":"",
          "useDefaultIfEmpty":"0",
          "MIGXlayoutid":0,
          "MIGXcolumnid":0,
          "MIGXcolumnwidth":0,
          "MIGXcolumnminwidth":"",
          "MIGXcolumnstyle":"",
          "MIGXcolumncaption":"",
          "MIGXlayoutstyle":"",
          "MIGXlayoutcaption":"",
          "pos":3
        },
        {
          "MIGX_id":35,
          "MIGXtype":"field",
          "MIGXtyperender":"<h3>...field<\/h3>",
          "field":"type",
          "caption":"",
          "description":"",
          "description_is_code":"0",
          "inputTV":"",
          "inputTVtype":"hidden",
          "validation":"",
          "configs":"",
          "restrictive_condition":"[[migxrecipes_checkType? &value=`group`]]",
          "display":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":"group",
          "useDefaultIfEmpty":"0",
          "MIGXlayoutid":0,
          "MIGXcolumnid":0,
          "MIGXcolumnwidth":0,
          "MIGXcolumnminwidth":"",
          "MIGXcolumnstyle":"",
          "MIGXcolumncaption":"",
          "MIGXlayoutstyle":"",
          "MIGXlayoutcaption":"",
          "pos":4
        }
      ]
    }
  ],
  "contextmenus":"",
  "actionbuttons":"",
  "columnbuttons":"",
  "filters":"",
  "extended":{
    "migx_add":"Add Ingredient",
    "disable_add_item":1,
    "add_items_directly":"",
    "formcaption":"",
    "update_win_title":"",
    "win_id":"recipes_ingredients",
    "maxRecords":"",
    "addNewItemAt":"bottom",
    "multiple_formtabs":"",
    "multiple_formtabs_label":"",
    "multiple_formtabs_field":"",
    "multiple_formtabs_optionstext":"",
    "multiple_formtabs_optionsvalue":"",
    "actionbuttonsperrow":4,
    "winbuttonslist":"",
    "extrahandlers":"",
    "filtersperrow":4,
    "packageName":"migxrecipes",
    "classname":"",
    "task":"",
    "getlistsort":"",
    "getlistsortdir":"",
    "sortconfig":"",
    "gridpagesize":"",
    "use_custom_prefix":"0",
    "prefix":"",
    "grid":"",
    "gridload_mode":1,
    "check_resid":1,
    "check_resid_TV":"",
    "join_alias":"",
    "has_jointable":"yes",
    "getlistwhere":"",
    "joins":"",
    "hooksnippets":"",
    "cmpmaincaption":"",
    "cmptabcaption":"",
    "cmptabdescription":"",
    "cmptabcontroller":"",
    "winbuttons":"",
    "onsubmitsuccess":"",
    "submitparams":""
  },
  "columns":[
    {
      "MIGX_id":1,
      "header":"Ingredient",
      "dataIndex":"render_title",
      "width":60,
      "sortable":"false",
      "show_in_grid":1,
      "customrenderer":"",
      "renderer":"this.renderChunk",
      "clickaction":"",
      "selectorconfig":"",
      "renderchunktpl":"[[+type:is=`group`:then=`<h1 style=\"font-size:2em;\">[[+title]]<\/h1>`:else=`[[+title]]`]] ",
      "renderoptions":"",
      "editor":""
    },
    {
      "MIGX_id":2,
      "header":"Type",
      "dataIndex":"type",
      "width":20,
      "sortable":"false",
      "show_in_grid":1,
      "customrenderer":"",
      "renderer":"",
      "clickaction":"",
      "selectorconfig":"",
      "renderchunktpl":"[[migxrecipes_checkType? &value=`ingredient`]]",
      "renderoptions":"",
      "editor":""
    }
  ],
  "createdby":3,
  "createdon":"2016-02-08 21:38:22",
  "editedby":3,
  "editedon":"2016-02-09 08:21:52",
  "deleted":0,
  "deletedon":null,
  "deletedby":0,
  "published":1,
  "publishedon":null,
  "publishedby":0
}