<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;

if (!Loader::includeModule('highloadblock')) {
    return;
}

if (!empty($arParams['HL_BLOCK'])) {
    $hlId = $arParams['HL_BLOCK'];
    $hlblock = HL\HighloadBlockTable::getById($hlId)->fetch();
    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();

    $rsData = $entity_data_class::getList([
        'order' => [
            'SORT' => 'ASC'
        ],
        'limit' => $arParams['SLIDES_COUNT'],
        'cache' => [
            'ttl' => '3600'
        ],
    ])->fetchAll();

    foreach ($rsData as $item) {
        if ($item[$arParams['HL_PICTURE']]) {
            $item[$arParams['HL_PICTURE']] = CFile::GetFileArray(
                $item[$arParams['HL_PICTURE']]
            );
        }
        $arr['NAME'] = $item[$arParams['HL_NAME']];
        $arr['LINK'] = $item[$arParams['HL_LINK']];
        $arr['PICTURE'] = $item[$arParams['HL_PICTURE']];
        $arResult[] = $arr;
    }

    $this->includeComponentTemplate();
}