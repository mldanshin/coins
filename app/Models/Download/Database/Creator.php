<?php

namespace App\Models\Download\Database;

use App\Models\Download\Repository;

/**
 * downloading a database dump
 * supported only MySql
 */
final class Creator
{
    private string $fileName = "db-coins.sql";
    private Repository $repository;
    private string $filePath;

    public function __construct()
    {
        $this->repository = Repository::instance();
        $this->initializeFilePath();
        $this->writeFile();
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    private function initializeFilePath(): void
    {
        $this->filePath = $this->repository->getPath($this->fileName);
    }

    /**
     * @throws \Exception
     */
    private function writeFile(): void
    {
        $res = exec($this->buildQuery());

        if ($res === false) {
            throw new \Exception("An error occurred when creating a dump of the database file");
        }
    }

    /**
     * @throws \Exception
     */
    private function buildQuery(): string
    {
        $dbConnection = config("default");

        switch ($dbConnection) {
            case "mysql":
                $dbUserName = config("database.connections.mysql.username");
                $dbPassword = config("database.connections.mysql.password");
                $dbName = config("database.connections.mysql.database");
                return "mysqldump -u$dbUserName -p$dbPassword --skip-compact $dbName > {$this->filePath}";
            default:
                throw new \Exception("Unknown type of database connection: '$dbConnection'");
        }
    }
}
