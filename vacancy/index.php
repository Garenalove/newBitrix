<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вакансии");
$APPLICATION->IncludeComponent(
    "mycmpnts:vacancy",
    ".default",
    Array(
        "SEF_FOLDER" =>  "/vacancy/",
        "DETAIL_PAGE_URL" =>  "/vacancy/#ELEMENT_ID#/",
        "LIST_PAGE_URL" => "/vacancy/",
    )
);
?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>