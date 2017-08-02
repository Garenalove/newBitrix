<?
use Garenalove\Vacancy\VacancyElement;
use Garenalove\Vacancy\ResponseTable;

Class CustomDetail extends CBitrixComponent
{

    private function getProperties($propertys)
    {
        $propertys = $propertys->GetNextElement();
        $this->arResult["VACANCY"]['employer']['name'] = $propertys->GetFields()["PROPERTY_EMPLOYER_PROPERTY_NAME_VALUE"];
        $propertys = $propertys->GetProperties();
        foreach ($propertys as $key => $property) {
            if ($key != "employer") {
                if ($property["PROPERTY_TYPE"] == "F") {
                    $property["VALUE"] = CFile::GetPath($property["VALUE"]);
                }
                $this->arResult["VACANCY"][$key] = $property["VALUE"];
            }
        }
    }

    private function setButton()
    {
        global $USER;
        if ($USER->GetId()) {
            $response = ResponseTable::getList(array(
                'filter' => array('VACANCY' => $this->arParams["ELEMENT_ID"], "USER" => $USER->GetId())
            ))->fetchAll();
            if (empty($response)) {
                $this->arResult["BUTTON"] = "Y";
            } else {
                $this->arResult["BUTTON"] = "N";
            }
        }
    }

    public function executeComponent()
    {

        CModule::IncludeModule("iblock");
        CModule::IncludeModule("garenalove.vacancy");
        $this->setButton();
        $this->arResult["VACANCY"]["ID"] = $this->arParams['ELEMENT_ID'];
        $vacancy = VacancyElement::getList(array(
            "ID" => $this->arParams["ELEMENT_ID"]
        ));
        if ($vacancy) {
            $this->getProperties($vacancy);
        } else {
            echo "Страница не найдена";
            die;
        }
        $this->IncludeComponentTemplate();
    }


}

?>