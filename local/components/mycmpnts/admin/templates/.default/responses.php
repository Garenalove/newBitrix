<?php
$APPLICATION->IncludeComponent(
    "mycmpnts:vacancyResponses",
    ".default",
    Array(
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "PAGE_SIZE" => 2,
        "DETAIL_PAGE_URL" => $arParams["DETAIL_PAGE_URL"],
        "LIST_PAGE_URL" => $arParams["LIST_PAGE_URL"],
    )
);