<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
CModule::IncludeModule("iblock");

class myNewSlider extends CBitrixComponent
{

    function getUsers($arParams)
    {
        $arResult = array();

        $filter = Array
        (
            "GROUPS_ID" => Array($arParams['USER_GROUP'])
        );
        $arPar["SELECT"] = array("UF_SCORE");
        $rsUsers = CUser::GetList($by = "UF_SCORE", $order = "DESC", $filter,$arPar);
        while ($arItem = $rsUsers->GetNext()) {
            $arResult['ITEMS'][] = $arItem;
        }

        return $arResult;
    }

    public function executeComponent()
    {
        if ($this->StartResultCache()) {
            $this->arResult = array_merge($this->arResult, $this->getUsers($this->arParams));
            $this->includeComponentTemplate();
        }
    }
}