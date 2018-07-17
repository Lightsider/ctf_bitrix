<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
    <!--Стили для таблицы-->
    <style>
        table {
            margin: 20px;
            min-width: 95%;
        }

        table tr td {
            padding: 18px;
            background-color: #54214e;
            box-shadow: inset 0 0 5px black;
        }

        td:hover {
            background-color: rgba(255, 255, 255, 0.9);
        }

        .content {
            max-width: 800px;
        }

        th {
            padding-bottom: 10px;
        }
    </style>

<? foreach ($arResult['ORGS'] as $key => $orgs): ?>
    <table cellspacing='0'>
        <tr>
            <th style="text-align: center;" colspan="<?= $orgs['COUNT'] ?>"><?= $key ?></th>
        </tr>
        <tr>
            <? foreach ($orgs as $org): ?>
                <? if (isset($org["NAME"])): // чтобы убрать кол-во и ширину?>
                    <?
                    $this->AddEditAction($org['ID'], $org['EDIT_LINK'], CIBlock::GetArrayByID($org["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($org['ID'], $org['DELETE_LINK'], CIBlock::GetArrayByID($org["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <td style="text-align: center; width: <?= $orgs['WIDTH'] ?>%">
                        <a href="<?= $org['LINK'] ?>" target="_blank" id="<?= $this->GetEditAreaId($orgs['ID']); ?>">
                            <img height="70" title="<?= $org['PREVIEW_TEXT'] ?>"
                                 src="<?= $org["PREVIEW_PICTURE"]["SRC"] ?>">
                        </a>
                    </td>
                <? endif; ?>
            <? endforeach; ?>
        </tr>
    </table>
<? endforeach; ?>