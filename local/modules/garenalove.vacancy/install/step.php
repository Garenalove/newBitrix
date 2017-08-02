<?
use Bitrix\Main\Localization\Loc;
if($ex = $APPLICATION->GetException()){
    echo CAdminMessage::ShowMessage(array(
        "TYPE" => "ERROR",
        "MESSAGE" => Loc::getMessage("MOD_INST_ERR"),
        "HTML" => true,
    ));
}
else {
    echo CAdminMessage::ShowMessage(array(
        "TYPE" => "OK",
        "MESSAGE" => Loc::getMessage("MOD_INST_OK"),
        "HTML" => true,
    ));
}
?>
<form action="<?echo $APPLICATION->GetCurPage();?>">
    <input type="hidden" name="lang" value="<?echo LANGUAGE_ID?>">
    <input type="submit" name="" value="<? echo Loc::getMessage("MOD_BACK"); ?>">
</form>