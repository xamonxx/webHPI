<?php
// Simple scanner to find suspicious content in database
$dbs = [
    [
        'host' => 'localhost',
        'db'   => 'u603012205_homeputra_dbs',
        'user' => 'u603012205_homeputra_usn',
        'pass' => 'Woodyhouse97@'
    ],
    [
        'host' => 'localhost',
        'db'   => 'u603012205_mewahdb',
        'user' => 'u603012205_mewahusr',
        'pass' => 'Woodyhouse97@'
    ]
];

$suspicious_patterns = [
    '<script',
    '<iframe',
    'base64_decode',
    'eval(',
    'javascript:',
    'onload=',
    'onerror=',
    'http://', // Look for non-local links
    'https://'
];

foreach ($dbs as $config) {
    echo "Scanning DB: {$config['db']}\n";
    try {
        $pdo = new PDO("mysql:host={$config['host']};dbname={$config['db']}", $config['user'], $config['pass']);
        $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

        foreach ($tables as $table) {
            $columns = $pdo->query("SHOW COLUMNS FROM `$table`")->fetchAll(PDO::FETCH_ASSOC);
            $search_cols = [];
            foreach ($columns as $col) {
                if (strpos($col['Type'], 'varchar') !== false || strpos($col['Type'], 'text') !== false) {
                    $search_cols[] = $col['Field'];
                }
            }

            if (empty($search_cols)) continue;

            foreach ($search_cols as $col) {
                foreach ($suspicious_patterns as $pattern) {
                    $stmt = $pdo->prepare("SELECT COUNT(*) FROM `$table` WHERE `$col` LIKE ?");
                    $stmt->execute(['%' . $pattern . '%']);
                    $count = $stmt->fetchColumn();
                    if ($count > 0) {
                        echo "  [FOUND] Table: $table, Column: $col, Pattern: '$pattern' (Count: $count)\n";
                    }
                }
            }
        }
    } catch (Exception $e) {
        echo "  [ERROR] " . $e->getMessage() . "\n";
    }
}
