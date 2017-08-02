<?

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Application;
use \Bitrix\Main\ModuleManager;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Entity\Base;


Loc::loadMessages(__FILE__);

Class garenalove_vacancy extends CModule
{
    function __construct()
    {
        $arModuleVersion = array();
        include(__DIR__ . '/version.php');

        $this->MODULE_ID = 'garenalove.vacancy';
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = Loc::getMessage("GARENALOVE_VACANCY_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("GARENALOVE_VACANCY_MODULE_DESC");
        $this->PARTNER_NAME = Loc::getMessage("GARENALOVE_VACANCY_PARTNER_NAME");
        $this->PARTNER_URI = Loc::getMessage("GARENALOVE_VACANCY_PARTNER_URI");
    }

    public function isVersionD7()
    {
        return CheckVersion(ModuleManager::getVersion('main'), '14.00.00');
    }

    public function GetPath($notDocumentRoot = false)
    {
        if ($notDocumentRoot)
            return str_ireplace(Application::getDocumentRoot(), '', dirname(__DIR__));
        else
            return dirname(__DIR__);
    }

    function installDb()
    {
        if (!Application::getConnection(\Garenalove\Vacancy\ResponseTable::getConnectionName())->isTableExists(
            Base::getInstance('Garenalove\Vacancy\ResponseTable')->getDBTableName()
        )
        ) {
            Base::getInstance('Garenalove\Vacancy\ResponseTable')->createDbTable();
        }
        Garenalove\Vacancy\EmployersInstaller::instalIBlock();
        Garenalove\Vacancy\VacancyInstaller::installIBlock();

    }

    function uninstallDb()
    {
        Application::getConnection(Garenalove\Vacancy\ResponseTable::getConnectionName())->
        queryExecute('drop table if exists ' . Base::getInstance('\Garenalove\Vacancy\ResponseTable')->getDBTableName());
        \Bitrix\Main\Config\Option::delete($this->MODULE_ID);
        Garenalove\Vacancy\VacancyInstaller::uninstallIBlock();
        Garenalove\Vacancy\EmployersInstaller::uninstallIBlock();
    }


    function DoInstall()
    {
        global $APPLICATION;
        if ($this->isVersionD7()) {
            ModuleManager::registerModule($this->MODULE_ID);
            self::installDb();
            $APPLICATION->IncludeAdminFile(Loc::getMessage("GARENALOVE_VACANCY_INSTAL_TITLE")
                , $this->GetPath() . "/install/step.php");
        } else {
            $APPLICATION->ThrowException(Loc::getMessage("GARENALOVE_VACANCY_VERSION_EXCEPTION"));
        }
    }


    function DoUninstall()
    {
        global $APPLICATION;
        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();
        Loader::includeModule($this->MODULE_ID);
        if ($request["step"] < 2) {
            $APPLICATION->IncludeAdminFile(Loc::getMessage("ACADEMY_D7_UNINSTALL_TITLE"),
                $this->GetPath() . "/install/unstep1.php");

        } elseif ($request["step"] == 2) {

            if ($request["savedata"] != "Y") {
                self::uninstallDb();
            }
            ModuleManager::unRegisterModule($this->MODULE_ID);

            $APPLICATION->IncludeAdminFile(Loc::getMessage("ACADEMY_D7_UNINSTALL_TITLE"),
                $this->GetPath() . "/install/unstep2.php");
        }
    }

}

?>