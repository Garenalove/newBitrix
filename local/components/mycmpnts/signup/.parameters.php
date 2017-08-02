<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */

if(!CModule::IncludeModule("iblock"))
	return;


$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"DEFAULT_EMAIL" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("DEFAULT_EMAIL"),
			"TYPE" => "STRING",
			"DEFAULT" => "mail@mail.ru",
		),
	),
);
