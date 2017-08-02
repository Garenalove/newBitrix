<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


if(isset($_POST['signin']))
{
	$arResult = $USER->Login($_POST['login'],$_POST['password'], "Y");
}
$this->includeComponentTemplate();

?>