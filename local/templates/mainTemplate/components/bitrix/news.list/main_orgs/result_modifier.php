<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if (!CModule::IncludeModule("iblock"))            //Для вывода должности
    return;

foreach ($arResult["ITEMS"] as $key => $arItem):?>
    <?

    $arOrg = $arItem;
    $arOrg["LINK"] = $arItem["PREVIEW_PICTURE"] = $arItem['PROPERTIES']['LINK']['VALUE'];
    $arResult['ORGS'][$arItem['PROPERTIES']['ORGANIZATION_TYPE']['VALUE']][] = $arOrg;
    ?>
<? endforeach; ?>


<? foreach ($arResult['ORGS'] as $key => $orgs) {
    $count=count($orgs);
    $width = 100/$count;
    $arResult['ORGS'][$key]['COUNT']=$count;
    $arResult['ORGS'][$key]['WIDTH']=$width;
}
?>
