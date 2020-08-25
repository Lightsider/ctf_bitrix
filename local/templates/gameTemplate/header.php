<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<head>
    <? $APPLICATION->ShowHead(); ?>
    <link rel="shortcut icon" href="<?= $APPLICATION->GetTemplatePath("img/logoWhite.png") ?>" type="image/x-icon">
    <?
    CJSCore::Init(array("jquery"));
    ?>
    <title><? $APPLICATION->ShowTitle() ?></title>
</head>
<body>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
<header>
    <?$APPLICATION->IncludeComponent("bitrix:menu", "game_menu", Array(
        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
        "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
        "DELAY" => "N",	// Откладывать выполнение шаблона меню
        "MAX_LEVEL" => "1",	// Уровень вложенности меню
        "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
            0 => "",
        ),
        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
        "MENU_CACHE_TYPE" => "A",	// Тип кеширования
        "MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
        "MENU_THEME" => "site",	// Тема меню
        "ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
        "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
    ),
        false
    );?>

</header>
<div class="content-back">
    <div class="content">
