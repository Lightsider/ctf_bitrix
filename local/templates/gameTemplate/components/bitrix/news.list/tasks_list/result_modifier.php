<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!CModule::IncludeModule("iblock"))

    return;

foreach ($arResult["ITEMS"] as $key => $arItem) {
    $res = CIBlockElement::GetByID($arItem['PROPERTIES']['category']['VALUE']);
    if ($ar_res = $res->GetNext())
        $arResult["ITEMS"][$key]['CATEGORY'] = $ar_res['NAME'];
}

global $USER;
// Для определения решенных заданий
$arSelect = Array("ID", "NAME", "PROPERTY_task.id");
$arFilter = Array("IBLOCK_ID" => 7, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_result" => "true",
    "PROPERTY_user" => $USER->GetID()); // Лог операций
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 100), $arSelect);
while ($ob = $res->GetNextElement()) {
    $arr= $ob->GetFields();
    $arResult['COMPLETE_TASKS'][] = $arr['PROPERTY_TASK_ID'];
}


foreach ($arResult["ITEMS"] as $key => $arItem) {
    $arSelect = Array("ID", "NAME");
    $arFilter = Array("IBLOCK_ID" => 7, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_result" => "true",
        "PROPERTY_task.id"=>$arItem['ID']); // Лог операций
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 100), $arSelect);
        $arResult["ITEMS"][$key]['COUNT_COMPLETE'] = $res->SelectedRowsCount();
}

?>

