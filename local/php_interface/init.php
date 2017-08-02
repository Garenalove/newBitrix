<?
	if(file_exists($_SERVER['DOCUMENT_ROOT']."/local/lib/constants.php"))
		require_once($_SERVER['DOCUMENT_ROOT']."/local/lib/constants.php");	
	if(file_exists($_SERVER['DOCUMENT_ROOT']."/local/lib/debug.php"))
		require_once($_SERVER['DOCUMENT_ROOT']."/local/lib/debug.php");	
	if(file_exists($_SERVER['DOCUMENT_ROOT']."/local/lib/agents/VacancyAgent.php"))
		require_once($_SERVER['DOCUMENT_ROOT']."/local/lib/agents/VacancyAgent.php");
