<?

namespace Garenalove\Vacancy;

use Bitrix\Main\Loader;
use \Bitrix\Main\Application;

Class VacancyInstaller
{
    private static $IBLOCK_ID;

    private static function addIBlockType()
    {
        if (!\CIBlockType::GetByID("vacancy")->GetNext()) {
            $fields = Array(
                'ID' => 'vacancy',
                'SECTIONS' => 'Y',
                'IN_RSS' => 'N',
                'SORT' => 100,
                'LANG' => Array(
                    'en' => Array(
                        'NAME' => 'Vacancies',
                    ),
                    'ru' => Array(
                        'NAME' => 'Вакансии',
                    )
                )
            );
            global $DB;
            global $APPLICATION;
            $vacancyBlockType = new \CIBlockType;
            $DB->StartTransaction();
            $res = $vacancyBlockType->Add($fields);
            if (!$res) {
                $DB->Rollback();
                $APPLICATION->ThrowException($vacancyBlockType->LAST_ERROR);
                die;
            } else {
                $DB->Commit();
            }
        }
    }

    private static function addIBlock()
    {
        if (!\CIBlock::GetById("vacancies")->GetNext()) {
            $vacancyIBlock = new \CIBlock;
            $fields = Array(
                "ACTIVE" => "Y",
                "NAME" => "Vacancies",
                "CODE" => "vacancies",
                "IBLOCK_TYPE_ID" => "vacancy",
                "SITE_ID" => "s1",
                "SORT" => 500,
                "DESCRIPTION_TYPE" => "text",
                "GROUP_ID" => Array("2" => "D", "3" => "R")
            );
            global $APPLICATION;
            if (!self::$IBLOCK_ID = $vacancyIBlock->Add($fields)) {
                $APPLICATION->ThrowException($vacancyIBlock->LAST_ERROR);
                die;
            }
        }
    }

    private static function addIBlockPropertys()
    {
        if (self::$IBLOCK_ID) {
            $vacancyPropertys = new \CIBlockProperty;
            $fields = Array(
                "NAME" => "Название",
                "ACTIVE" => "Y",
                "SORT" => "500",
                "CODE" => "name",
                "PROPERTY_TYPE" => "S",
                "IBLOCK_ID" => self::$IBLOCK_ID,
            );

            $vacancyPropertys->Add($fields);

            $fields = Array(
                "NAME" => "Специализация",
                "ACTIVE" => "Y",
                "SORT" => "500",
                "CODE" => "spec",
                "PROPERTY_TYPE" => "S",
                "IBLOCK_ID" => self::$IBLOCK_ID,
            );

            $vacancyPropertys->Add($fields);

            $fields = Array(
                "NAME" => "Работодатель",
                "ACTIVE" => "Y",
                "SORT" => "500",
                "CODE" => "employer",
                "PROPERTY_TYPE" => "E",
                "IBLOCK_ID" => self::$IBLOCK_ID,
                "LINK_IBLOCK_ID" => EmployersInstaller::$IBLOCK_ID,
            );

            $vacancyPropertys->Add($fields);

            $fields = Array(
                "NAME" => "Теги",
                "ACTIVE" => "Y",
                "SORT" => "500",
                "CODE" => "tags",
                "PROPERTY_TYPE" => "L",
                "IBLOCK_ID" => self::$IBLOCK_ID,
            );

            $vacancyPropertys->Add($fields);

            $fields = Array(
                "NAME" => "Зарплата от",
                "ACTIVE" => "Y",
                "SORT" => "500",
                "CODE" => "payment",
                "PROPERTY_TYPE" => "N",
                "IBLOCK_ID" => self::$IBLOCK_ID,
            );

            $vacancyPropertys->Add($fields);

            $fields = Array(
                "NAME" => "Зарплата до",
                "ACTIVE" => "Y",
                "SORT" => "500",
                "CODE" => "payment_up_to",
                "PROPERTY_TYPE" => "N",
                "IBLOCK_ID" => self::$IBLOCK_ID,
            );

            $vacancyPropertys->Add($fields);

            $fields = Array(
                "NAME" => "Тестовое задание",
                "ACTIVE" => "Y",
                "SORT" => "500",
                "CODE" => "test",
                "PROPERTY_TYPE" => "F",
                "IBLOCK_ID" => self::$IBLOCK_ID,
            );

            $fields = Array(
                "NAME" => "Тестовое задание",
                "ACTIVE" => "Y",
                "SORT" => "500",
                "CODE" => "test",
                "PROPERTY_TYPE" => "F",
                "IBLOCK_ID" => self::$IBLOCK_ID,
            );

            $vacancyPropertys->Add($fields);
        } else {
            die;
        }
    }

    public static function installIBlock()
    {
        if (Loader::includeModule("iblock")) {
            self::addIBlockType();
            self::addIBlock();
            self::addIBlockPropertys();
            $IBlockConst = "define('VACANCY_IBLOCK_ID','".self::$IBLOCK_ID."');\n";
            file_put_contents(__DIR__."\constants.php",$IBlockConst,FILE_APPEND);
        } else {
            die;
        }
    }

    public static function uninstallIBlock()
    {
        if (Loader::includeModule("iblock")) {
            if (\CIBlockType::GetByID("vacancy")->GetNext()) {
                \CIBlockType::Delete("vacancy");
            }
            file_put_contents(__DIR__."\constants.php","<?php\n");
        }
    }

}

?>