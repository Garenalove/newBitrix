<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

use Garenalove\Vacancy\ResponseTable;

function checkParams()
{
    return ($_REQUEST["PAGE"] == "FORM" &&
        CModule::IncludeModule("garenalove.vacancy")
    );
}

function add()
{
    global $USER;
    return ResponseTable::add(array(
        "VACANCY" => $_REQUEST['ID'],
        "USER" => $USER->GetId(),
        "COVERING_LETTER" => $_REQUEST['CL'],
    ));

}

function main()
{
    if (checkParams()) {
        echo add()->isSuccess();
    }
}

main();
?>