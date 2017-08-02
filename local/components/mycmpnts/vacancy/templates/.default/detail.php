<?php
$APPLICATION->IncludeComponent(
    "mycmpnts:customDetail",
    ".default",
    Array(
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "ELEMENT_ID" => $arResult["VARIABLES"]["element_id"],
        "DETAIL_PAGE_URL" => $arParams["DETAIL_PAGE_URL"],
        "LIST_PAGE_URL" => $arParams["LIST_PAGE_URL"],
        "USER_ID"=>$USER->GetId(),
    )
);
