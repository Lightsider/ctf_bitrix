<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

foreach ($arResult['ITEMS'] as $key => $arItem)
{
    // дата
    $arResult['ITEMS'][$key]['DISPLAY_DATE'] = CIBlockFormatProperties::DateFormat('d f', MakeTimeStamp($arItem['ACTIVE_FROM'], CSite::GetDateFormat()));
    // время
    $arResult['ITEMS'][$key]['DISPLAY_TIME'] = CIBlockFormatProperties::DateFormat('H:i', MakeTimeStamp($arItem['ACTIVE_FROM'], CSite::GetDateFormat()));
}