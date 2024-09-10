<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("SLIDER_HL_NAME"),
	"DESCRIPTION" => GetMessage("SLIDER_HL_DESCRIPTION"),
	"ICON" => "/images/icon.png",
	"SORT" => 1,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "owner_components",
			"NAME" => GetMessage("SLIDER_HL_SECTION"),
			"SORT" => 1,
		)
	),
);