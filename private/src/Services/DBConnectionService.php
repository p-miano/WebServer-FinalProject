<?php
/**
 * WebServer-FinalProject
 *
 * @autor Paula Miano <paulamiano@gmail.com>
 * (C) Copyright 2024 by Paula Miano
 */

namespace Services;

use Exception;
use JsonException;
use PDO;
use PDOException;
use Teacher\GivenCode\Abstracts\IService;
use Teacher\GivenCode\Exceptions\RuntimeException;

/**
 *
 */

class DBConnectionService implements IService {
    private const CONFIG_FILE_PATH = __DIR__ . '/../../private/config/config.json';
    private static ?PDO $connection = null;
    
    /**
     * @throws RuntimeException
     * @throws Exception
     */
    public static function getConnection(): PDO {
        try {
            if (!(self::$connection instanceof PDO)) {
                self::$connection = self::createConnection();
            }
            return self::$connection;
        } catch (PDOException $pdo_excep) {
            throw new Exception("Failure to open connection to the database: " . $pdo_excep->getMessage(), 500);
        }
    }
    
    /**
     * @throws RuntimeException
     * @throws Exception
     */
    private static function createConnection() : PDO {
        if (!file_exists(self::CONFIG_FILE_PATH)) {
            throw new RuntimeException("Configuration file not found.", 500);
        }
        if (!is_readable(self::CONFIG_FILE_PATH)) {
            throw new RuntimeException("Configuration file is not readable. Check permissions.", 500);
        }
        try {
            $raw_string = file_get_contents(self::CONFIG_FILE_PATH);
            $config = json_decode($raw_string, true, 512, JSON_THROW_ON_ERROR);
            $dsn =
                "{$config['db_type']}:host={$config['db_host']};port={$config['db_port']};dbname={$config['db_name']};";
            return new PDO($dsn, $config['db_username'], $config['db_password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $pdo_excep) {
            throw new Exception("Failure to open connection to the database: " . $pdo_excep->getMessage(), 500);
        } catch (JsonException $json_excep) {
            throw new Exception("Invalid JSON configuration format: " . $json_excep->getMessage(), 500);
        }
    }
    
}