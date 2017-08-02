<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(isset($_POST['SUBMIT']))
{
	$arResult = $USER->Register($_POST['LOGIN'], $_POST['NAME'],$_POST['LASTNAME'], $_POST['PASSWORD'], $_POST['CONFIRMPASS'],$_POST['EMAIL']);
}
$this->includeComponentTemplate();

?>