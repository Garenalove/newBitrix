<?

use Garenalove\Vacancy\ResponseTable;
use Garenalove\Vacancy\VacancyElement;

Class VacancyAdmin extends CBitrixComponent
{
    private function setFilter()
    {
        
    }


    private function getList()
    {
        CModule::IncludeModule("garenalove.vacancy");
        global $USER;
        $employerId = CUser::GetByID($USER->GetId())->GetNext()["UF_EMPLOYER_ID"];
        $filter = array(
            "PROPERTY_EMPLOYER" => $employerId,
        );
        return VacancyElement::getList($filter, array(), $this->arParams["PAGE_SIZE"]);
    }

    private function getItemsAndFields($list)
    {
        while ($unit = $list->GetNextElement()) {
            $item = $unit->GetFields();
            $item["PROPERTIES"] = $unit->GetProperties();
            $this->arResult["ITEMS"][] = $item;
        }
    }

    public function executeComponent()
    {
        $list = $this->getList();
        $this->getItemsAndFields($list);
        $this->arResult["NAV_STRING"] = $list->GetPageNavStringEx(
            $navComponentObject,
            "",
            "",
            "Y"
        );
        $list->SetUrlTemplates($this->arParams["DETAIL_PAGE_URL"], "", $this->arParams["LIST_PAGE_URL"]);;
        $this->includeComponentTemplate();
    }
}

?>
