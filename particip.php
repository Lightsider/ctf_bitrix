<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Участники");
?>

	<p class="title">Участники</p>
<?$APPLICATION->IncludeComponent(
	"ctfbitrix:user_list",
	"participiants",
	array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"USER_GROUP" => "6",
		"COMPONENT_TEMPLATE" => "participiants"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>