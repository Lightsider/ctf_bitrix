<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<div class="">

        <h2> Категории: </h2>
        <ul>
            <?foreach($arResult["ITEMS"] as $key=>$arItem):?>
                <?php if ($key === 0): ?>
                    <li class="sideline" id="all" onclick="view('all')" style="background-color: rgb(2, 149, 255); color: white;">
                <?php else: ?>
                    <li class="sideline" id="<?=$arItem['NAME'] ?>" onclick="view('<?=$arItem['NAME'] ?>')">
                <?php endif; ?>
                <?=$arItem['NAME']?>
                </li>
            <?php endforeach; ?>
        </ul>
</div>
<script>
    function view(cat = "all") {
        var panels = document.getElementsByClassName("task-panel");
        var sidelines = document.getElementsByClassName("sideline");
        for (i = 0; i < sidelines.length; i++) {
            sidelines[i].style.backgroundColor = "";
            sidelines[i].style.color = "";
        }
        if (cat !== "all") {

            var categories = document.getElementsByClassName("category");
            for (i = 0; i < panels.length; i++) {
                if (categories[i].innerText !== cat) panels[i].style.display = "none";
                else panels[i].style.display = "block";
            }
        }
        else {
            for (i = 0; i < panels.length; i++) {
                panels[i].style.display = "block";
            }
        }
        document.getElementById(cat).style.backgroundColor = "#0295ff";
        document.getElementById(cat).style.color = "white";
    }
</script>