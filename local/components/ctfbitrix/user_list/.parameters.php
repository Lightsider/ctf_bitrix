<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


$arList = CGroup::GetList($by="c_sort", $order="desc", Array());
while($arRes = $arList->Fetch())
    $arGroups[$arRes["ID"]] = "[".$arRes["ID"]."] ".$arRes["NAME"];

$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "USER_GROUP"=>array(
            "PARENT"=>"BASE",
            "NAME"=>"Группа пользователей",
            "TYPE"=>"LIST",
            "DEFAULT"=>"1",
            "VALUES" => $arGroups,
            "ADDITIONAL_VALUES" => "Y",
            "REFRESH" => "Y",
        ),
        "CACHE_TIME" => array("DEFAULT"=>36000000),

    ),
);

