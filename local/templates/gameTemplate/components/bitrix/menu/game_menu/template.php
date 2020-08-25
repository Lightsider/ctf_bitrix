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
    <a href="/game">
        <div class="text-logo">
            <p>SCHOOLCTF</p>
        </div>
    </a>
    <div class="container">
        <ul>
            <? foreach ($arResult["MENU_STRUCTURE"] as $itemID => $arColumns): ?>     <!-- first level-->
                <? if ($arResult["ALL_ITEMS"][$itemID]["LINK"] === "/"): ?>
                    <li class="purple">
                <? elseif ($arResult["ALL_ITEMS"][$itemID]['SELECTED'] === true): ?>
                    <li class="active">
                <? else: ?>
                    <li class="primary">
                <? endif; ?>
                <a href="<?= $arResult["ALL_ITEMS"][$itemID]["LINK"] ?>"><?= $arResult["ALL_ITEMS"][$itemID]["TEXT"] ?></a>
                </li>
            <? endforeach; ?>
        </ul>
    </div>
    <div class="profile">
        <a href="login.php">
            <? if ($USER->IsAuthorized()): ?>
                <? $currentUser = $arResult['USER']; ?>
                <? if ($currentUser['PERSONAL_PHOTO']): ?>
                    <?
                    $renderImage = CFile::ResizeImageGet($currentUser['PERSONAL_PHOTO'], Array("width" => 38,
                        "height" => 38));
                    ?>
                    <div class="profile-logo" style="background-image: url('<?= $renderImage['src'] ?>')"></div>
                <? else: ?>
                    <div class="profile-logo"
                         style="background-image: url('<?= $APPLICATION->GetTemplatePath("img/no_logo.png") ?>')"></div>
                <? endif; ?>
                <div class="credits">
                    <p><b><?= $currentUser['NAME'] ?></b></p>
                    <? if (isset($currentUser['UF_SCORE'])): ?>
                        <p id='score'><?= $currentUser['UF_SCORE'] ?> pts</p>
                    <? else: ?>
                        <p id='score'>0 pts</p>
                    <? endif; ?>
                </div>
            <? else: ?>
                <p style='text-align: center;padding-top: 10px;padding-bottom: 10px;'>Вход</p>
            <? endif; ?>
        </a>
    </div>
</nav>

