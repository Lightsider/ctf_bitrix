<?php
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
?>
<?

if (!$USER->IsAuthorized()) {
    LocalRedirect('login.php');
    die();
}



$_REQUEST['sessid']=$_POST['DATA'][0]['value']; // для определение сессии из передаваемой формы


if(check_bitrix_sessid())
{
    $errors=array();
    if(strlen($_POST['DATA'][1]['value'])>255 or strlen($_POST['DATA'][1]['value'])<1)
        $errors['name']="Имя неверного формата";
    if(strlen($_POST['DATA'][2]['value'])>255 or strlen($_POST['DATA'][2]['value'])<1)
        $errors['surname']="Фамилия неверного формата";
    if(strlen($_POST['DATA'][3]['value'])>255 or strlen($_POST['DATA'][3]['value'])<1)
        $errors['company_name']="Название компании неверного формата";
    if(strlen($_POST['DATA'][4]['value'])>255 or strlen($_POST['DATA'][4]['value'])<1)
        $errors['position']="Должность неверного формата";
    if(!check_email($_POST['DATA'][5]['value']))
        $errors['mail']="Почта неверного формата";
    if(strlen($_POST['DATA'][6]['value'])>255 or strlen($_POST['DATA'][6]['value'])<1 or !is_numeric($_POST['DATA'][6]['value']))
        $errors['phone']="Телефон неверного формата";
    if(strlen($_POST['DATA'][7]['value'])>255 or strlen($_POST['DATA'][7]['value'])<1)
        $errors['where']="Откуда узнали о семинаре неверного формата";


    if(empty($errors))
    {
        CModule::IncludeModule('iblock');

        $el = new CIBlockElement;
        $iblock_id = 6;


        //Свойства
        $PROP = array();

        $PROP['surname'] = strip_tags($_POST['DATA'][2]['value']); //Свойство фамилия
        $PROP['name'] = strip_tags($_POST['DATA'][1]['value']); //название элемента
        $PROP['company_name'] = strip_tags($_POST['DATA'][3]['value']); //компания
        $PROP['position'] = strip_tags($_POST['DATA'][4]['value']); //должность
        $PROP['mail'] = strip_tags($_POST['DATA'][5]['value']); //почта
        $PROP['phone'] = strip_tags($_POST['DATA'][6]['value']); // телефон
        $PROP['from'] = strip_tags($_POST['DATA'][7]['value']); // откуда узнал


        //Основные поля элемента
        $fields = array(
            "DATE_CREATE" => date("d.m.Y H:i:s"), //Передаем дата создания
            "CREATED_BY" => $GLOBALS['USER']->GetID(),    //Передаем ID пользователя кто добавляет
            "IBLOCK_SECTION" => "", //ID разделов
            "IBLOCK_ID" => $iblock_id, //ID информационного блока он 6-ый
            "PROPERTY_VALUES" => $PROP, // Передаем массив значении для свойств
            "NAME" => strip_tags($_POST['DATA'][1]['value']." ".$_POST['DATA'][2]['value']),
            "ACTIVE" => "Y", //поумолчанию делаем активным или ставим N для отключении поумолчанию
            "PREVIEW_TEXT" => "", //Анонс
            "PREVIEW_PICTURE" => "", //изображение для анонса
            "DETAIL_TEXT"    => "",
            "DETAIL_PICTURE" => "" //изображение для детальной страницы
        );

        //Результат в конце отработки
        if ($ID = $el->Add($fields)) {
            header('Content-Type: application/json; charset=utf-8');
            $arr['STATUS']="Y";

            $arEventFields = array(
                "EMAIL"  =>  $PROP['mail'] ,
            );
            CEvent::SendImmediate("SEND_COUPON", "s1", $arEventFields,"N","8");
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        } else {
            echo 'Произошел как-то косяк Попробуйте еще разок';
        }


    }
    else
    {
        $errors['STATUS']="N";
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($errors,JSON_UNESCAPED_UNICODE);
    }
}
else
{
    echo 'Произошел как-то косяк Попробуйте еще разок';
}
?>