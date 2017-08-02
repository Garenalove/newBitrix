<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<!DOCTYPE html>
<html>
<head>
	<title>dich</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?if($USER->GetId()==null):?>
	<form action="<?=POST_FORM_ACTION_URI?>" method="post">
		<input type="text" placeholder="<?=GetMessage('LOGIN')?>" name="login">
		<input type="password" placeholder="<?=GetMessage('PASSWORD')?>" name="password">
		<?ShowMessage($arResult);?>
		<input type="submit"  value="<?=GetMessage('SIGNIN')?>" name = "signin">
		<?$USER->Logout();?>
	</form>
	<?else:?>
		<p><?=$USER->GetLogin().GetMessage('AUTHO')?></p>
	<?endif?>
</body>
</html>