<?php
namespace Src\Repository;

use Src\Applications\ApplicationSettings\ApplicationSettings;
use Src\Applications\ApplicationSettings\ApplicationSettingsFactory;

class Repository
{
    protected Database $connection;

    public function __construct(Database $connection)
    {
        $this->connection = $connection;
    }

    public function getSettingsByApplicationName(string $applicationName): ApplicationSettings
    {
        $sql = "SELECT s.meta_key, s.meta_val, s.type FROM settings s JOIN applications a ON a.application_id = s.application_id WHERE a.name = :name";
        $res = $this->connection->query($sql, ["name" => $applicationName]);

        $settings = ApplicationSettingsFactory::getByName($applicationName, $res);

        return $settings;
    }

    public function getAllApplications(): array
    {
        $sql = "SELECT a.name FROM applications a";
        $res = $this->connection->query($sql);
        return array_map(function($elem){
            return $elem['name'];
        }, $res);
    }
}