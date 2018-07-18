<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
?>
<div class="bx-auth-reg">

    <? if ($USER->IsAuthorized()): ?>

        <? LocalRedirect('login.php') ?>

    <? else: ?>
    <div class="site-login">
        <style>
            .content {
                padding-top: 100px;
            }

            .content {
                min-height: 71.9vh;
            }
        </style>
        <div class="module form-module">
            <div class="form">
                <h2>Зарегистрируйте свой аккаунт</h2>

                <?
                if (count($arResult["ERRORS"]) > 0):

                    foreach ($arResult["ERRORS"] as $key => $error)
                        if (intval($key) == 0 && $key !== 0)
                            $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;" . GetMessage("REGISTER_FIELD_" . $key) . "&quot;", $error);

                    foreach ($arResult["ERRORS"] as $key => $error) {
                        ?>
                        <p class="error"><? echo HTMLToTxt($error); ?></p><?
                    }

                endif ?>

                <form method="post" action="<?= POST_FORM_ACTION_URI ?>" name="regform" enctype="multipart/form-data">
                    <?
                    if ($arResult["BACKURL"] <> ''):
                        ?>
                        <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                    <?
                    endif;
                    ?>
                    <? foreach ($arResult["SHOW_FIELDS"] as $FIELD): ?>
                        <?
                        switch ($FIELD) {
                            case "PASSWORD":
                                ?><input size="30" type="password" name="REGISTER[<?= $FIELD ?>]"
                                         value="<?= $arResult["VALUES"][$FIELD] ?>" autocomplete="off"
                                         class="bx-auth-input"
                                         placeholder="<?= GetMessage("REGISTER_FIELD_" . $FIELD) ?>"/>
                                <?
                                break;
                            case "CONFIRM_PASSWORD":
                                ?><input size="30" type="password" name="REGISTER[<?= $FIELD ?>]"
                                         value="<?= $arResult["VALUES"][$FIELD] ?>" autocomplete="off"
                                         placeholder="<?= GetMessage("REGISTER_FIELD_" . $FIELD) ?>"/><?
                                break;

                            case "PERSONAL_PHOTO":
                                ?><input size="30" type="file" name="REGISTER_FILES_<?= $FIELD ?>" /><?
                                break;
                            default: ?>
                                <input size="30" type="text" name="REGISTER[<?= $FIELD ?>]"
                                       value="<?= $arResult["VALUES"][$FIELD] ?>"
                                       placeholder="<?= GetMessage("REGISTER_FIELD_" . $FIELD) ?>"/>
                            <?
                        } ?>

                    <? endforeach ?>
                    <button type="submit" value="<?= GetMessage("AUTH_REGISTER") ?>"
                            name="register_submit_button"><?= GetMessage("AUTH_REGISTER") ?></button>
                </form>
            </div>
            <? endif ?>
        </div>