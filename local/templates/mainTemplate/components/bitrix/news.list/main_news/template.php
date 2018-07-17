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
<p class="title">Новости</p>


<? foreach ($arResult["ITEMS"] as $keyItem=>$arItem): ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="post" id="<?= $this->GetEditAreaId($arItem['ID']);?>">
        <p class="post-title"><?=$arItem["NAME"]?></p>
        <div class="post-img">
            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"] ?>">
        </div>
        <div class="post-content">
            <?=$arItem["PREVIEW_TEXT"]; ?>
        </div>
    </div>
    <?if(isset($arResult['ITEMS'][$keyItem+1])):?>
    <hr>
    <?endif;?>
<? endforeach; ?>
