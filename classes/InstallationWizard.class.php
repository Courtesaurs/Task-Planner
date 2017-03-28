<?php

namespace App;

require_once dirname(__FILE__). "/DataBase.class.php";


class InstallationWizard
{
    public function __construct()
    {
    }

    public function checkForCredentials()
    {
    }

    public function saveCredentials()
    {
    }

    public function initDataBase()
    {
        DataBase::initDataBase();
    }

    public function createAdminAccount()
    {
    }
}