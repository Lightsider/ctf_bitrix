<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Результаты");


if (!$USER->IsAuthorized()) {
    LocalRedirect('login.php');
    die();
}
?>
    <style>
        .content
        {
            width: 1072px;
            padding: 10px;
            padding-top: 50px;
            background-color: rgba(0,0,0,0.7);
        }
    </style>

    <p class="title" style="margin-top: 0">Результаты</p>
<?$APPLICATION->IncludeComponent("ctfbitrix:user_list", "results", Array(
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"USER_GROUP" => "6",	// Группа пользователей
		"COMPONENT_TEMPLATE" => "participiants"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>