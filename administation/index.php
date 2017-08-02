<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Администрирование");
$APPLICATION->IncludeComponent(
    "bitrix:menu",
    ".default",
    array(
        "ALLOW_MULTI_SELECT" => "N",
        "DELAY" => "N",
        "MAX_LEVEL" => "1",
        "MENU_CACHE_GET_VARS" => array(),
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "ROOT_MENU_TYPE" => "adminMenu",
        "USE_EXT" => "N",
        "COMPONENT_TEMPLATE" => ".default"
    ),
    false
);
?>
<?
$APPLICATION->IncludeComponent(
    "mycmpnts:admin",
    ".default",
    Array(
        "SEF_FOLDER" => "/administation/",
        "DETAIL_PAGE_URL" => "/administation/responses/",
        "LIST_PAGE_URL" => "/administation/",
    )
);
?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>