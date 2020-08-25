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
$errors = Array();

$_REQUEST['sessid'] = $_POST['sessid']; // для определение сессии из передаваемой формы

$task_id = $_POST['task_id'];
if (!is_numeric($task_id))
    $errors['task_id'] = "Неверный id таска";
$flag = trim($_POST['flag']);
if (!preg_match("/^School\{[a-z0-9]{0,248}\}$/", $flag))
    $errors['message'] = "Неверный формат флага";


if (check_bitrix_sessid()) {

    CModule::IncludeModule('iblock');

    $el = new CIBlockElement;
    $iblock_id = 7;


    //Свойства
    $PROP = array();

    global $USER;
    $PROP['task'] = $task_id;
    $PROP['user'] = $GLOBALS['USER']->GetID();
    $PROP['result'] = "false";


    if (!check_solve($task_id)) {
        // проверяем правильность

        $arSelect = Array("ID", "NAME", "PROPERTY_flag", "PROPERTY_score");
        $arFilter = Array("IBLOCK_ID" => 6, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "ID" => $task_id);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 100), $arSelect); // Берем задание
        $ob = $res->GetNextElement();
        $arOb = $ob->GetFields();
        $trueFlag = $arOb['PROPERTY_FLAG_VALUE'];


        if ($flag === $trueFlag) {
            $PROP['result'] = "true";


            $rsUser = CUser::GetByID($USER->GetID());
            $arUser = $rsUser->Fetch();

            $user = new CUser;
            $newScore = $arUser['UF_SCORE'] + $arOb['PROPERTY_SCORE_VALUE'];
            $fields = Array(
                "UF_SCORE" => $newScore,
            );

            $user->Update($USER->GetID(), $fields);


        } elseif (!isset($errors['message'])) {
            $errors['message'] = "Неверный флаг";
        }
    }

    $flag = htmlspecialcharsbx($flag);
    //Основные поля элемента
    $fields = array(
        "DATE_CREATE" => date("d.m.Y H:i:s"), //Передаем дата создания
        "CREATED_BY" => $GLOBALS['USER']->GetID(),    //Передаем ID пользователя кто добавляет
        "IBLOCK_SECTION" => "", //ID разделов
        "IBLOCK_ID" => $iblock_id, //ID информационного блока
        "PROPERTY_VALUES" => $PROP, // Передаем массив значении для свойств
        "NAME" => $flag,
        "ACTIVE" => "Y", //поумолчанию делаем активным или ставим N для отключении поумолчанию
        "PREVIEW_TEXT" => "", //Анонс
        "PREVIEW_PICTURE" => "", //изображение для анонса
        "DETAIL_TEXT" => "",
        "DETAIL_PICTURE" => "" //изображение для детальной страницы
    );


    //Результат в конце отработки
    if (!$ID = $el->Add($fields)) {
        echo 'Произошел как-то косяк Попробуйте еще разок';
    }
    if (empty($errors)) {
        header('Content-Type: application/json; charset=utf-8');
        $arr['STATUS'] = "Y";
        $arr['message'] = "Вы правильно решили задание";
        $arr['task_id'] = $task_id;
        $arr['score'] = $newScore;

        echo json_encode($arr, JSON_UNESCAPED_UNICODE);
    } else {
        $errors['STATUS'] = "N";
        $errors['task_id'] = $task_id;
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($errors, JSON_UNESCAPED_UNICODE);
    }
} else {
    echo 'Ошибка сессии';
}


function check_solve($task_id)
{
    global $USER;
    // Для определения решенных заданий
    $arSelect = Array("ID", "NAME", "PROPERTY_task.id");
    $arFilter = Array("IBLOCK_ID" => 7, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_result" => "true",
        "PROPERTY_user" => $USER->GetID(), "PROPERTY_task.id" => $task_id); // Лог операций
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 100), $arSelect);
    return $res->GetNextElement();
}

?>