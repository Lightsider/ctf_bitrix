<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?>
<?/**/?>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.register", 
	"register_form", 
	array(
		"USER_PROPERTY_NAME" => "",
		"SEF_MODE" => "Y",
		"SHOW_FIELDS" => array(
			0 => "EMAIL",
			1 => "NAME",
			2 => "PERSONAL_PHOTO",
			3 => "PERSONAL_CITY",
			4 => "WORK_COMPANY",
		),
		"REQUIRED_FIELDS" => array(
			0 => "EMAIL",
			1 => "NAME",
			2 => "PERSONAL_CITY",
			3 => "WORK_COMPANY",
		),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "tasks.php",
		"SET_TITLE" => "N",
		"USER_PROPERTY" => array(
		),
		"SEF_FOLDER" => "/",
		"COMPONENT_TEMPLATE" => "register_form"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>