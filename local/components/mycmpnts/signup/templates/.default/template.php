<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<!DOCTYPE html>
<html>
<head>
	<title>dich</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<form action="<?=POST_FORM_ACTION_URI?>" method="post">
		<input type="text" placeholder="<?=GetMessage('LOGIN')?>" name="LOGIN">
		<input type="text" placeholder="<?=GetMessage('EMAIL')?>" name="EMAIL">
		<input type="password" placeholder="<?=GetMessage('PASSWORD')?>" name="PASSWORD">
		<input type="password" placeholder="<?=GetMessage('CONFIRMPASS')?>" name="CONFIRMPASS">
		<input type="text" placeholder="<?=GetMessage('NAME')?>" name="NAME">
		<input type="text" placeholder="<?=GetMessage('LASTNAME')?>" name="LASTNAME">
		<?ShowMessage($arResult);?>
		<input type="submit"  value="<?=GetMessage('REG')?>" name = "SUBMIT">
	</form>
</body>
</html>