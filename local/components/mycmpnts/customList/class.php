<?

use Garenalove\Vacancy\VacancyElement;

Class CustomList extends CBitrixComponent
{

    private function getItemsAndFields($list)
    {
        while($unit = $list->GetNextElement())
        {
            $item = $unit->GetFields();
            $item["PROPERTIES"] = $unit->GetProperties();
            $this->arResult["ITEMS"][] = $item;
        }
    }

    public function executeComponent()
    {
        CModule::IncludeModule("garenalove.vacancy");
        $list = VacancyElement::getList(array(),array(), $this->arParams["PAGE_SIZE"]);
        $list->SetUrlTemplates($this->arParams["DETAIL_PAGE_URL"], "", $this->arParams["LIST_PAGE_URL"]);
        $this->getItemsAndFields($list);
        $this->arResult["NAV_STRING"] = $list->GetPageNavStringEx
        (
            $navComponentObject,
            "",
            "",
            "Y"
        );
        $this->includeComponentTemplate();
    }
}

?>
