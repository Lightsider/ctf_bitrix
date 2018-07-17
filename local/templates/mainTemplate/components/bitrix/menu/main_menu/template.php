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

if (empty($arResult["ALL_ITEMS"]))
    return;
?>
<nav>
    <a href="/">
        <div class="text-logo">
            <p>SCHOOLCTF</p>
        </div>
    </a>
    <div class="container">
        <ul>
            <? foreach ($arResult["MENU_STRUCTURE"] as $itemID => $arColumns): ?>     <!-- first level-->
                <? if ($arResult["ALL_ITEMS"][$itemID]['SELECTED'] === true): ?>
                    <li class="active">
                <? elseif ($arResult["ALL_ITEMS"][$itemID]["LINK"] === "/game/"): ?>
                    <li class="primary">
                <? else: ?>
                    <li class="purple">
                <? endif; ?>
                <a href="<?= $arResult["ALL_ITEMS"][$itemID]["LINK"] ?>"><?= $arResult["ALL_ITEMS"][$itemID]["TEXT"]?></a>
                </li>
            <? endforeach; ?>
        </ul>
    </div>
</nav>

