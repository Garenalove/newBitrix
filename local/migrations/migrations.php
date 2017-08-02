<?php
    $is_console = PHP_SAPI == 'cli' || (!isset($_SERVER['DOCUMENT_ROOT']) && !isset($_SERVER['REQUEST_URI']));
	//if (!$is_console) die;
    @set_time_limit(0);
    @ignore_user_abort(true);

    $_SERVER["DOCUMENT_ROOT"] = realpath(__DIR__ . '/../../');
    $DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

    // Если инициализировать данную константу каким либо значением, то это запретит сбор статистики на данной странице.
    define('NO_KEEP_STATISTIC', true);
    // Если инициализировать данную константу значением "true" до подключения пролога, то это отключит проверку прав на доступ к файлам и каталогам.
    define('NOT_CHECK_PERMISSIONS', true);
    define('CHK_EVENT', true);
    // При установке в true отключает выполнение всех агентов
    define("NO_AGENT_CHECK", true);

    /** @noinspection PhpIncludeInspection */
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

    CModule::IncludeModule("iblock");



    $arFields = Array(
        'ID'=>'employer',
        'SECTIONS'=>'Y',
        'IN_RSS'=>'N',
        'SORT'=>100,
        'LANG'=>Array(
            'en'=>Array(
                'NAME'=>'Employers',
            ),
            'ru'=>Array(
                'NAME'=>'Работодатели',
            )
        )
    );

    $obBlocktype = new CIBlockType;
    $DB->StartTransaction();
    $res = $obBlocktype->Add($arFields);
    if(!$res)
    {
        $DB->Rollback();
        echo 'Error: '.$obBlocktype->LAST_ERROR.'<br>';
    }
    else
        $DB->Commit();

    

    $arFields = Array(
        'ID'=>'vacancy',
        'SECTIONS'=>'Y',
        'IN_RSS'=>'N',
        'SORT'=>100,
        'LANG'=>Array(
            'en'=>Array(
                'NAME'=>'Vacancies',
            ),
            'ru'=>Array(
                'NAME'=>'Вакансии',
            )
        )
    );

    $obBlocktype = new CIBlockType;
    $DB->StartTransaction();
    $res = $obBlocktype->Add($arFields);
    if(!$res)
    {
        $DB->Rollback();
        echo 'Error: '.$obBlocktype->LAST_ERROR.'<br>';
    }
    else
        $DB->Commit();



    $ID = 0;
    $ib = new CIBlock;
    $arFields = Array(
        "ACTIVE" => "Y",
        "NAME" => "Employers",
        "CODE" => "employers",
        "IBLOCK_TYPE_ID" => "employer",
        "SITE_ID" => "s1",
        "SORT" => 500,
        "DESCRIPTION_TYPE" => "text",
        "GROUP_ID" => Array("2"=>"D", "3"=>"R")
    );

    if ($ID > 0)
        $res = $ib->Update($ID, $arFields);
    else
    {
        $ID = $ib->Add($arFields);
        if($ID === false){
            echo 'Error: '.$ib->LAST_ERROR.'<br>';
        }
        $res = ($ID>0);
    }

    $ibp = new CIBlockProperty;
    $arFields = Array(
        "NAME" => "Ф.И.О",
        "ACTIVE" => "Y",
        "SORT" => "500",
        "CODE" => "name",
        "PROPERTY_TYPE" => "S",
        "IBLOCK_ID" => $ID,
    );

    $PropID = $ibp->Add($arFields);

    $arFields = Array(
        "NAME" => "Номер телефона",
        "ACTIVE" => "Y",
        "SORT" => "500",
        "CODE" => "phone",
        "PROPERTY_TYPE" => "S",
        "IBLOCK_ID" => $ID,
    );

    $PropID = $ibp->Add($arFields);

    $arFields = Array(
        "NAME" => "Почта",
        "ACTIVE" => "Y",
        "SORT" => "500",
        "CODE" => "mail",
        "PROPERTY_TYPE" => "S",
        "IBLOCK_ID" => $ID,
    );

    $PropID = $ibp->Add($arFields);

    $arFields = Array(
        "NAME" => "Адрес",
        "ACTIVE" => "Y",
        "SORT" => "500",
        "CODE" => "adress",
        "PROPERTY_TYPE" => "S",
        "IBLOCK_ID" => $ID,
    );

    $PropID = $ibp->Add($arFields);
    $EmployerIBlockID = $ID;



    $ID = 0;
    $ib = new CIBlock;
    $arFields = Array(
        "ACTIVE" => "Y",
        "NAME" => "Vacancies",
        "CODE" => "vacancies",
        "IBLOCK_TYPE_ID" => "vacancy",
        "SITE_ID" => "s1",
        "SORT" => 500,
        "DESCRIPTION_TYPE" => "text",
        "GROUP_ID" => Array("2"=>"D", "3"=>"R")
    );
    if ($ID > 0)
        $res = $ib->Update($ID, $arFields);
    else
    {
        $ID = $ib->Add($arFields);
        if($ID === false){
            echo 'Error: '.$ib->LAST_ERROR.'<br>';
        }
        $res = ($ID>0);
    }

    $ibp = new CIBlockProperty;
    $arFields = Array(
        "NAME" => "Название",
        "ACTIVE" => "Y",
        "SORT" => "500",
        "CODE" => "name",
        "PROPERTY_TYPE" => "S",
        "IBLOCK_ID" => $ID,
    );

    $PropID = $ibp->Add($arFields);

    $arFields = Array(
        "NAME" => "Специализация",
        "ACTIVE" => "Y",
        "SORT" => "500",
        "CODE" => "spec",
        "PROPERTY_TYPE" => "S",
        "IBLOCK_ID" => $ID,
    );

    $PropID = $ibp->Add($arFields);

    $arFields = Array(
        "NAME" => "Работодатель",
        "ACTIVE" => "Y",
        "SORT" => "500",
        "CODE" => "employer",
        "PROPERTY_TYPE" => "E",
        "IBLOCK_ID" => $ID,
        "LINK_IBLOCK_ID" => $EmployerIBlockID
    );

    $PropID = $ibp->Add($arFields);

    $arFields = Array(
        "NAME" => "Теги",
        "ACTIVE" => "Y",
        "SORT" => "500",
        "CODE" => "tags",
        "PROPERTY_TYPE" => "L",
        "IBLOCK_ID" => $ID,
    );

    $PropID = $ibp->Add($arFields);

    $arFields = Array(
        "NAME" => "Зарплата от",
        "ACTIVE" => "Y",
        "SORT" => "500",
        "CODE" => "payment",
        "PROPERTY_TYPE" => "N",
        "IBLOCK_ID" => $ID,
    );

    $PropID = $ibp->Add($arFields);

    $arFields = Array(
        "NAME" => "Зарплата до",
        "ACTIVE" => "Y",
        "SORT" => "500",
        "CODE" => "payment_up_to",
        "PROPERTY_TYPE" => "N",
        "IBLOCK_ID" => $ID,
    );

    $PropID = $ibp->Add($arFields);

    $arFields = Array(
        "NAME" => "Тестовое задание",
        "ACTIVE" => "Y",
        "SORT" => "500",
        "CODE" => "test",
        "PROPERTY_TYPE" => "F",
        "IBLOCK_ID" => $ID,
    );

    $PropID = $ibp->Add($arFields);

    $group = new CGroup;
    $arFields = Array(
      "ACTIVE"       => "Y",
      "C_SORT"       => 100,
      "NAME"         => "Администратор вакансий",
      "DESCRIPTION"  => "Администраторы вакансий",
      "STRING_ID"      => "vacanciesAdministrator"
      );
    $group->Add($arFields);
    
?>