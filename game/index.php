<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Соревнования");
?>


<?
global $USER;

if (!$USER->IsAuthorized()) {
    LocalRedirect('login.php');
}
else
{
    LocalRedirect('tasks.php');
}

?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>