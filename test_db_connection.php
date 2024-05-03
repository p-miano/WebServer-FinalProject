<?php
declare(strict_types=1);
/**
 * WebServer-FinalProject
 *
 * @autor Paula Miano <paulamiano@gmail.com>
 * (C) Copyright 2024 by Paula Miano
 */
require_once 'private/src/Services/DBConnectionService.php';

use Services\DBConnectionService;

try {
    $pdo = DBConnectionService::getConnection();
    echo "Database connection established successfully!";
} catch (Exception $exception) {
    echo "Failed to connect to the database: " . $exception->getMessage();
}