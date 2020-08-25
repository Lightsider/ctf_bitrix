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
<?$APPLICATION->IncludeComponent(
	"ctfbitrix:user_list", 
	"results", 
	array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"USER_GROUP" => "6",
		"COMPONENT_TEMPLATE" => "results"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>