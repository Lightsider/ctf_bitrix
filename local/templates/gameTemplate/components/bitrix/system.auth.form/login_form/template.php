<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CJSCore::Init();
?>

<div class="bx-system-auth-form">
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

                <? if ($arResult["FORM_TYPE"] == "login"): ?>

                    <h2>Войдите в свой аккаунт</h2>
                    <form name="system_auth_form<?= $arResult["RND"] ?>" method="post" target="_top"
                          action="<?= $arResult["AUTH_URL"] ?>">
                        <?
                        if ($arResult["BACKURL"] <> ''): ?>
                            <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                        <? endif ?>
                        <?
                        foreach ($arResult["POST"] as $key => $value): ?>
                            <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
                        <? endforeach ?>
                        <input type="hidden" name="AUTH_FORM" value="Y"/>
                        <input type="hidden" name="TYPE" value="AUTH"/>

                        <input type="text" name="USER_LOGIN" maxlength="50" value="" size="17" placeholder="Логин"/>
                        <script>
                            BX.ready(function () {
                                var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
                                if (loginCookie) {
                                    var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
                                    var loginInput = form.elements["USER_LOGIN"];
                                    loginInput.value = loginCookie;
                                }
                            });
                        </script>
                        <input type="password" name="USER_PASSWORD" maxlength="50" size="17"
                               autocomplete="off" placeholder="Пароль"/>

                        <button type="submit" name="Login"><?= GetMessage("AUTH_LOGIN_BUTTON") ?></button>
                    </form>

                <?
                elseif ($arResult["FORM_TYPE"] == "otp"):
                    ?>

                    <form name="system_auth_form<?= $arResult["RND"] ?>" method="post" target="_top"
                          action="<?= $arResult["AUTH_URL"] ?>">
                        <?
                        if ($arResult["BACKURL"] <> ''):?>
                            <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                        <? endif ?>
                        <input type="hidden" name="AUTH_FORM" value="Y"/>
                        <input type="hidden" name="TYPE" value="OTP"/>
                        <table width="95%">
                            <tr>
                                <td colspan="2">
                                    <?
                                    echo GetMessage("auth_form_comp_otp") ?><br/>
                                    <input type="text" name="USER_OTP" maxlength="50" value="" size="17"
                                           autocomplete="off"/></td>
                            </tr>
                            <?
                            if ($arResult["CAPTCHA_CODE"]):?>
                                <tr>
                                    <td colspan="2">
                                        <?
                                        echo GetMessage("AUTH_CAPTCHA_PROMT") ?>:<br/>
                                        <input type="hidden" name="captcha_sid" value="<?
                                        echo $arResult["CAPTCHA_CODE"] ?>"/>
                                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?
                                        echo $arResult["CAPTCHA_CODE"] ?>" width="180" height="40"
                                             alt="CAPTCHA"/><br/><br/>
                                        <input type="text" name="captcha_word" maxlength="50" value=""/></td>
                                </tr>
                            <? endif ?>
                            <?
                            if ($arResult["REMEMBER_OTP"] == "Y"):?>
                                <tr>
                                    <td valign="top"><input type="checkbox" id="OTP_REMEMBER_frm" name="OTP_REMEMBER"
                                                            value="Y"/>
                                    </td>
                                    <td width="100%"><label for="OTP_REMEMBER_frm" title="<?
                                        echo GetMessage("auth_form_comp_otp_remember_title") ?>"><?
                                            echo GetMessage("auth_form_comp_otp_remember") ?></label></td>
                                </tr>
                            <? endif ?>
                            <tr>
                                <td colspan="2"><input type="submit" name="Login"
                                                       value="<?= GetMessage("AUTH_LOGIN_BUTTON") ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <noindex><a href="<?= $arResult["AUTH_LOGIN_URL"] ?>" rel="nofollow"><?
                                            echo GetMessage("auth_form_comp_auth") ?></a></noindex>
                                    <br/></td>
                            </tr>
                        </table>
                    </form>

                <?
                else:
                    ?>

                    <div class="form">
                        <h2 style="line-height: 1.2;">Вы уже авторизованы как <?= $arResult["USER_NAME"] ?>
                            <br>
                            [<?= $arResult["USER_LOGIN"] ?>]</h2>
                        <br>
                        <form action="<?= $arResult["AUTH_URL"] ?>">
                            <? foreach ($arResult["GET"] as $key => $value): ?>
                                <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
                            <? endforeach ?>

                            <input type="hidden" name="logout" value="yes"/>
                            <button type="submit" name="logout_butt"><?= GetMessage("AUTH_LOGOUT_BUTTON") ?></button>
                        </form>
                    </div>

                <? endif ?>
            </div>
            <?
            if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR']):?>
            <p class="error"><? echo HTMLToTxt($arResult["ERROR_MESSAGE"]["MESSAGE"]); ?></p>
            <? endif; ?>
            <?if (!$USER->IsAuthorized()):?>
                <a href="register.php">Или зарегистрироваться</a>
            <? endif; ?>

        </div>
    </div>
