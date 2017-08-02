<?
	function getVacancyList()
	{
		$sort = array
		(
			"name"=>"desc",

		);

		$filter = array
		(
			"ACTIVE" => "Y",
			"IBLOCK_ID" => VACANCY_IBLOCK_ID,
		);

		$select =array
		(
			"ID",
			"PROPERTY_ACTIVE_TO",
		);
		return CIBlockElement::GetList($sort, $filter,false,false,$select);
	}

	function checkOnEmpty($list)
	{
		$empyCellsId = array();
		while($item = $list->GetNextElement())
		{
			$item = $item->GetFields();
			if(!isset($item["PROPERTY_ACTIVE_TO_VALUE"]))
			{
				$empyCellsId[] = $item["ID"];
			}
		}
		return (empty($empyCellsId)) ? false : $empyCellsId;
	}

	function setActiveTo($emptyCells)
	{
		$objDateTime = new DateTime("1 day");
		foreach ($emptyCells as $key => $id) 
		{
			CIBlockElement::SetPropertyValues($id, VACANCY_IBLOCK_ID, $objDateTime->format("d.m.Y"), ACTIVE_TO_CODE);
		}
	}

	function checkVacancyDate($list)
	{
		$objDateTime = new DateTime("now");
		$el = new CIBlockElement();
		$updatedFields = array
		(
        	"ACTIVE" => "N",
        );
		while($item = $list->GetNextElement())
		{
			$item = $item->GetFields();
			$time = DateTime::createFromFormat("d.m.Y", $item["PROPERTY_ACTIVE_TO_VALUE"]);
			if($objDateTime >= $time)
			{
                $el->Update($item["ID"], $updatedFields);
			}
		}
	}

	function vacancyAgent()
	{
		CModule::IncludeModule("iblock");
		if($emptyCells = checkOnEmpty(getVacancyList()))
		{
			setActiveTo($emptyCells);
		}
		checkVacancyDate(getVacancyList());
		return "vacancyAgent();";
	}
?>
