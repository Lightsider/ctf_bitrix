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
<div class="tasks-content">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
<?
$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>

<? if ($arItem['ID']==$arResult['COMPLETE_TASKS'][0]["PROPERTY_TASK_ID"]): ?>
    <div class="task-panel complete" id="<?= $arItem['ID'] ?>">
        <? else: ?>
        <div class="task-panel" id="<?= $arItem['ID'] ?>">
            <? endif; ?>
            <a href="#task<?= $arItem['ID'] ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="task-title">
                    <?= $arItem['NAME'] ?>
                </div>
                <div class="task-body">
                    <p class="price"><?= $arItem['PROPERTIES']['score']['VALUE'] ?></p>
                    <p>Решили: <?=$arItem['COUNT_COMPLETE']?> </p>
                </div>
                <div class="task-title">
                    <p class="category"><?= $arItem["CATEGORY"] ?></p>
                </div>
            </a>
        </div>
        <? endforeach; ?>
    </div>
    <div style="clear: both"></div>

    <? foreach ($arResult["ITEMS"] as $arItem): ?>


    <div id="task<?= $arItem['ID'] ?>" class="modalDialog">
        <? if ($arItem['ID']==$arResult['COMPLETE_TASKS'][0]["PROPERTY_TASK_ID"]): ?>
        <div class="modal complete">
            <? else: ?>
            <div class="modal">
                <? endif; ?>

                <a href="#close" title="Закрыть" class="close">X</a>
                <h2 class="modal-title"><?= $arItem['NAME'] ?></h2>
                <div class="modal-content">
                    <p class="task-category"> <?= $arItem['CATEGORY'] ?> </p>
                    <p class="price"><?= $arItem['PROPERTIES']['score']['VALUE'] ?></p>

                    <p> Решили: <?=$arItem['COUNT_COMPLETE']?> </p>

                    <div class="modal-description">
                        <?= $arItem['PREVIEW_TEXT'] ?>
                    </div>

                    <p class="error" style="display: none"></p>

                </div>
                <div class="modal-footer">
                <? if ($arItem['ID']==$arResult['COMPLETE_TASKS'][0]["PROPERTY_TASK_ID"]): ?>
                    <p> Задание уже решено вашей командой </p>
                    <?else:?>
                    <form id="" action="solve.php" method="post">
                        <div class="form-group field-onetask-flag required">
                            <input type="text" id="onetask-flag" class="" name="flag" maxlength="255"
                                   placeholder="School{}" aria-required="true">

                        </div>
                        <div class="form-group field-onetask-task_id required">
                            <input type="hidden" id="onetask-task_id" class="form-control" name="task_id"
                                   value="<?= $arItem['ID'] ?>">
                        </div>
                        <button type="submit" class="">Сдать</button>

                    </form>
                    <?endif;?>
                </div>
            </div>
        </div>
        <? endforeach; ?>


        <script>

            $('form').submit(function (e) {
                e.preventDefault();

                var data = $(this).serialize();
                $.ajax({
                    url: '/solve',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function (res) {
                        var taskId = "task" + res['id_task'];
                        if (res['message'] !== "Вы правильно решили задание") {
                            $("#" + taskId).find(".error").css("display", "block");
                            $("#" + taskId).find(".error").text(res['message']);
                        }
                        else {
                            var id = res['id_task'];
                            $("#" + id).addClass("complete");
                            console.log($("#" + id).html());
                            $("#" + taskId).find(".modal").addClass("complete");
                            $("#" + taskId).find(".modal-footer").html("<p> Задание уже решено вашей командой </p>");
                            $("#" + taskId).find(".error").text(res['message']);
                            $("#" + taskId).find(".error").css("display", "block");

                            //Исправление счета

                            $("#score").text(res['score'] + " pts");

                        }
                    },
                    error: function () {
                        alert('Что-то пошло не так. Попробуйте позже');
                    }
                });
                return false;
            });

        </script>