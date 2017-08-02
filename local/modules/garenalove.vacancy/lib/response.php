<?

namespace Garenalove\Vacancy;

use \Bitrix\Main\Entity;


Class ResponseTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return "response_vacancy";
    }

    public static function getMap()
    {
        return array(

            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true,
            )),

            new Entity\IntegerField("VACANCY", array(
                'required' => true,
            )),

            new Entity\IntegerField("USER", array(
                'required' => true,
            )),

            new Entity\TextField('COVERING_LETTER', array(
                "required" => true,
            )),
        );
    }

}

?>