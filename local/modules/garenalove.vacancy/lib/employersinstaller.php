<?

namespace Garenalove\Vacancy;

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;

Class EmployersInstaller
{
    public static $IBLOCK_ID;

    private static function addIBlockType()
    {
        if (!\CIBlockType::GetByID("employer")->GetNext()) {
            $fields = Array(
                'ID' => 'employer',
                'SECTIONS' => 'Y',
                'IN_RSS' => 'N',
                'SORT' => 100,
                'LANG' => Array(
                    'en' => Array(
                        'NAME' => 'Employers',
                    ),
                    'ru' => Array(
                        'NAME' => 'Работодатели',
                    )
                )
            );
            global $DB;
            global $APPLICATION;
            $employersBlockType = new \CIBlockType;
            $DB->StartTransaction();
            $res = $employersBlockType->Add($fields);
            if (!$res) {
                $DB->Rollback();
                $APPLICATION->ThrowException($employersBlockType->LAST_ERROR);
                die;
            } else {
                $DB->Commit();
            }
        }
    }

    private static function addIBlock()
    {
        if (!\CIBlock::GetById("employers")->GetNext()) {
            $vacancyIBlock = new \CIBlock;
            $fields = Array(
                "ACTIVE" => "Y",
                "NAME" => "Employers",
                "CODE" => "employers",
                "IBLOCK_TYPE_ID" => "employer",
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
            $employersPropertys = new \CIBlockProperty;
            $fields = Array(
                "NAME" => "Ф.И.О",
                "ACTIVE" => "Y",
                "SORT" => "500",
                "CODE" => "name",
                "PROPERTY_TYPE" => "S",
                "IBLOCK_ID" => self::$IBLOCK_ID,
            );

            $employersPropertys->Add($fields);

            $fields = Array(
                "NAME" => "Номер телефона",
                "ACTIVE" => "Y",
                "SORT" => "500",
                "CODE" => "phone",
                "PROPERTY_TYPE" => "S",
                "IBLOCK_ID" => self::$IBLOCK_ID,
            );

            $employersPropertys->Add($fields);

            $fields = Array(
                "NAME" => "Почта",
                "ACTIVE" => "Y",
                "SORT" => "500",
                "CODE" => "mail",
                "PROPERTY_TYPE" => "S",
                "IBLOCK_ID" => self::$IBLOCK_ID,
            );

            $employersPropertys->Add($fields);

            $fields = Array(
                "NAME" => "Адрес",
                "ACTIVE" => "Y",
                "SORT" => "500",
                "CODE" => "adress",
                "PROPERTY_TYPE" => "S",
                "IBLOCK_ID" => self::$IBLOCK_ID,
            );

            $employersPropertys->Add($fields);
        } else {
            die;
        }
    }

    public static function instalIBlock()
    {
        if (Loader::includeModule("iblock")) {

            self::addIBlockType();
            self::addIBlock();
            self::addIBlockPropertys();
            $IBlockConst = "define('EMPLOYER_IBLOCK_ID','".self::$IBLOCK_ID."');\n";
            file_put_contents(__DIR__."\constants.php",$IBlockConst,FILE_APPEND);
        } else {
            die;
        }
    }

    public static function uninstallIBlock()
    {
        if (Loader::includeModule("iblock")) {
            if (\CIBlockType::GetByID("employer")->GetNext()) {
                \CIBlockType::Delete("employer");
            }
            file_put_contents(__DIR__."\constants.php","<?php\n");
        }
    }
}

?>