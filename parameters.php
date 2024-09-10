<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;

if (!Loader::includeModule('highloadblock')) {
    return;
}

// Получаем список всех Highload блоков
$arHlBlocksList = [];

$result = HL\HighloadBlockTable::getList();
while ($hlblock = $result->fetch()) {
    $arHlBlocksList[$hlblock['ID']] = '[' . $hlblock['ID'] . '] ' . $hlblock['NAME'];
}

if (!empty($arCurrentValues['HL_BLOCK'])) {
    $hlblockId = $arCurrentValues['HL_BLOCK'];
// Получаем информацию о Highload блоке
    $hlblock = HL\HighloadBlockTable::getById($hlblockId)->fetch();
// Получаем описание сущности Highload блока
    $hlEntity = HL\HighloadBlockTable::compileEntity($hlblock);
// Получаем список полей сущности
    $hlFields = $hlEntity->getFields();
// Наполняем список доступных полей
    foreach ($hlFields as $fieldName => $field) {
        $arHlBlocksFields[$fieldName] = $fieldName;
    }
}

$arComponentParameters = [
    "GROUPS" => [],
    "PARAMETERS" => [
        'HL_BLOCK' => [
            'PARENT' => 'BASE',
            'NAME' => GetMessage('HL_BLOCK_LIST'),
            'TYPE' => 'LIST',
            'VALUES' => $arHlBlocksList,
            'SORT' => '1',
            'REFRESH' => 'Y',
        ],
        'HL_NAME' => [
            'PARENT' => 'BASE',
            'NAME' => 'Название',
            'TYPE' => 'LIST',
            'VALUES' => $arHlBlocksFields,
            'SORT' => '2',
            'REFRESH' => 'N',
        ],
        'HL_LINK' => [
            'PARENT' => 'BASE',
            'NAME' => 'Ссылка',
            'TYPE' => 'LIST',
            'VALUES' => $arHlBlocksFields,
            'SORT' => '3',
            'REFRESH' => 'N',
        ],
        'HL_PICTURE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Картинка',
            'TYPE' => 'LIST',
            'VALUES' => $arHlBlocksFields,
            'SORT' => '4',
            'REFRESH' => 'N',
        ],
        'SLIDES_COUNT' => [
            'PARENT' => 'VISUAL',
            'NAME' => 'Общее количество слайдов',
            'TYPE' => 'STRING',
            'REFRESH' => 'N',
            'SORT' => '1',
            'DEFAULT' => '10'
        ],
        'SLIDES_TO_SHOW' => [
            'PARENT' => 'VISUAL',
            'NAME' => 'Количество видимых слайдов',
            'TYPE' => 'STRING',
            'SORT' => '2',
            'REFRESH' => 'N',
            'DEFAULT' => '3'
        ],
        'SLIDES_TO_SCROLL' => [
            'PARENT' => 'VISUAL',
            'NAME' => 'Количество слайдов для прокрутки за один клик',
            'TYPE' => 'STRING',
            'SORT' => '3',
            'REFRESH' => 'N',
            'DEFAULT' => '1'
        ],
        'SLIDES_AUTO' => [
            'PARENT' => 'VISUAL',
            'NAME' => 'Автопрокрутка',
            'TYPE' => 'CHECKBOX',
            'SORT' => '4',
            'REFRESH' => 'N',
            'DEFAULT' => 'Y'
        ],
        'SLIDES_AUTO_SPEED' => [
            'PARENT' => 'VISUAL',
            'NAME' => 'Период автоскролла (мс)',
            'TYPE' => 'STRING',
            'SORT' => '5',
            'DEFAULT' => '5000',
        ],
        'SLIDER_DOTS' => [
            'PARENT' => 'VISUAL',
            'NAME' => 'Точки',
            'TYPE' => 'CHECKBOX',
            'SORT' => '6',
            'DEFAULT' => 'Y',
        ],
        'SLIDER_ARROWS' => [
            'PARENT' => 'VISUAL',
            'NAME' => 'Стрелки навигации',
            'TYPE' => 'CHECKBOX',
            'SORT' => '7',
            'DEFAULT' => 'Y',
        ],
        'SLIDER_FADE' => [
            'PARENT' => 'VISUAL',
            'NAME' => 'Эффект плавности (fade)',
            'TYPE' => 'CHECKBOX',
            'SORT' => '8',
            'DEFAULT' => 'Y',
        ],
        'SLIDER_CENTER' => [
            'PARENT' => 'VISUAL',
            'NAME' => 'Режим центрирования (centerMode)',
            'TYPE' => 'CHECKBOX',
            'SORT' => '9',
            'DEFAULT' => 'Y',
        ],
        'SLIDER_LOOP' => [
            'PARENT' => 'VISUAL',
            'NAME' => 'Бесконечная прокрутка',
            'TYPE' => 'CHECKBOX',
            'SORT' => '10',
            'DEFAULT' => 'Y',
        ],
        'SLIDER_FOCUS' => [
            'PARENT' => 'VISUAL',
            'NAME' => 'Фокус на активном элементе',
            'TYPE' => 'CHECKBOX',
            'SORT' => '11',
            'DEFAULT' => 'Y',
        ],
        'CACHE_TIME' => [],
        'SET_TITLE' => [],
    ],
];
