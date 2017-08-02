<!DOCTYPE html>
<html>
<head>
	<?$APPLICATION->ShowPanel();?>
	<?$APPLICATION->ShowHead()?>

	<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script><![endif]-->
	<title><?$APPLICATION->ShowTitle()?></title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />

</head>

<body>

<div class="wrapper">

	<header class="header">
		<nav>
			<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	".default", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "top",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
		</nav>
	</header><!-- .header-->

	<main class="content">
		