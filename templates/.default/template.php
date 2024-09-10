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

<div id="slider">
    <?
    foreach ($arResult as $arItem) {
    ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <a href="<?= $arItem['LINK'] ?>">
                <img src="<?= $arItem['PICTURE']['SRC'] ?>" alt="<?= $arItem['NAME'] ?>" />
            </a>
        </div>
    <?
    }
    ?>
</div>

<script>
    $(document).ready(function() {
        $('#slider').slick({
            slidesToShow: <?=$arParams['SLIDES_TO_SHOW']?>,
            slidesToScroll: <?=$arParams['SLIDES_TO_SCROLL']?>,
            autoplay: <?($arParams['SLIDER_AUTO']==='Y') ? 'true' : 'false' ?>,,
            autoplaySpeed: <?=$arParams['SLIDES_AUTO_SPEED']?>,
            arrows: <?($arParams['SLIDER_ARROWS']==='Y') ? 'true' : 'false' ?>,
            fade: <?($arParams['SLIDER_FADE']==='Y') ? 'true' : 'false' ?>,
            dots: <?($arParams['SLIDER_DOTS']==='Y') ? 'true' : 'false' ?>,
            centerMode: <?($arParams['SLIDER_CENTER']==='Y') ? 'true' : 'false' ?>,
            infinite: <?($arParams['SLIDER_LOOP']==='Y') ? 'true' : 'false' ?>,
            focusOnSelect: <?($arParams['SLIDER_FOCUS']==='Y') ? 'true' : 'false' ?>,
        });
    });
</script>
