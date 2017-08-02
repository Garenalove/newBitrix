<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */
$arDefaultUrlTemplates404 = array(
    "vacancys" => 'index.php',
    "responses" => 'responses/',
);
$arParams["SEF_MODE"] = "Y";
$arDefaultVariableAliases404 = array();
$arDefaultVariableAliases = array();
$componentPage = "";
$arComponentVariables = array("element_id");
$arCustomPagesPath = array();
$arVariables = array();
$arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams["SEF_URL_TEMPLATES"]);
$arVariableAliases = CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases404, $arParams["VARIABLE_ALIASES"]);
$componentPage = CComponentEngine::ParseComponentPath($arParams["SEF_FOLDER"], $arUrlTemplates, $arVariables);
if ((!array_key_exists($componentPage, $arDefaultUrlTemplates404)) || empty($componentPage))
    $componentPage = "404";
CComponentEngine::InitComponentVariables($componentPage, $arComponentVariables, $arVariableAliases, $arVariables);
foreach ($arUrlTemplates as $url => $value)
    $arResult["PATH_TO_".strToUpper($url)] = $arParams["SEF_FOLDER"].$value;
$arResult["VARIABLES"] = $arVariables;
$this->IncludeComponentTemplate($componentPage);
