<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>


<div class="full-block">
    <div class="hovergallery">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                     id="<?= $this->GetEditAreaId($arItem['ID']); ?>"
                     width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                     height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                     alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                     title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"/>
            <? endif; ?>
        <? endforeach; ?>
    </div>
    <div style="clear: both"></div>
</div>