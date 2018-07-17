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

<? if (count($arResult['ITEMS']) != 0): ?>
    <div class="full-block">
        <table class="teams" cellspacing="0">
            <tbody>
            <tr>
                <th>№</th>
                <th>Логотип</th>
                <th>Команда</th>
                <th>Город</th>
                <th>Учебное заведение</th>
            </tr>

            <?
            $i = 1;
            foreach ($arResult['ITEMS'] as $arItem):?>
                <tr>
                    <td><?= $i ?></td>
                    <td>
                        <?
                        $renderImage = CFile::ResizeImageGet($arItem['PERSONAL_PHOTO'], Array("width"=>"80",
                            "height" => 80));
                        echo CFile::ShowImage($renderImage['src'], "0", 80,
                            "", "", true);
                        ?>
                    </td>
                    <td style="font-weight: bold;"><?= $arItem['NAME'] ?></td>
                    <td><?= $arItem['PERSONAL_CITY'] ?></td>
                    <td><?= $arItem['WORK_COMPANY'] ?></td>
                </tr>
                <?
                $i++;
            endforeach; ?>
            </tbody>
        </table>
    </div>
<? endif; ?>