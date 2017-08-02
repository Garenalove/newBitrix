<?

namespace Garenalove\Vacancy;


Class VacancyElement
{
    public static function getList($filter = array(), $fields = array(), $navigation = "")
    {
        if (\Bitrix\Main\Loader::includeModule("iblock")) {
            $sort = array(
                "name" => "desc",
            );

            $filter = array_merge($filter,
                array(
                    "IBLOCK_ID" => VACANCY_IBLOCK_ID,
                )
            );
            $fields = array_merge($fields,
                array(
                    "IBLOCK_ID",
                    "ID",
                    "NAME",
                    "PROPERT_SPEC",
                    "PROPERTY_EMPLOYER.PROPERTY_NAME",
                    "PROPERTY_PAYMENT",
                    "PROPERTY_PAYMENT_UP_TO",
                )
            );

            $navigation = array(
                "nPageSize" => $navigation,
            );
            return \CIBlockElement::GetList($sort, $filter, false, $navigation, $fields);
        }
    }

    //TODO: add, update and delete

    public static function add($id, $propertys)
    {
        return false;
    }

    public static function update($id, $propertys)
    {
        return false;
    }

    public static function delete($id)
    {
        return false;
    }

}


?>