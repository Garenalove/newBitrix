<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->IncludeComponent(
    "mycmpnts:customList",
    ".default",
    Array(
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "PAGE_SIZE" => 2,
        "DETAIL_PAGE_URL" => $arParams["DETAIL_PAGE_URL"],
        "LIST_PAGE_URL" => $arParams["LIST_PAGE_URL"],
    )
);
?>