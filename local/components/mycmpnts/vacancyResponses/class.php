<?

use Garenalove\Vacancy\ResponseTable;
use Garenalove\Vacancy\VacancyElement;

Class VacancyResponses extends CBitrixComponent
{
    private function getList()
    {
        CModule::IncludeModule("garenalove.vacancy");
        return ResponseTable::getList(array())->fetchAll();
    }

    private function setParams($list)
    {
        CModule::IncludeModule('iblock');
        foreach ($list as $key => $response) {
            $this->arResult[$key]["VACANCY"]['NAMES'] =  CIBlockElement::GetByID($response['VACANCY'])->GetNext()['NAME'];
            $this->arResult[$key]["VACANCY"]['URI'] = "/vacancy/".$response["VACANCY"].'/';
            $this->arResult[$key]["USER_EMAIL"] = CUser::GetByID(1)->GetNext()['EMAIL'];
            $this->arResult[$key]['COVERING_LETTER'] = $response['COVERING_LETTER'];
        }
    }

    public function executeComponent()
    {
        $this->setParams($this->getList());
        $this->includeComponentTemplate();
    }
}

?>