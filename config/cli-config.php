<?php

/**
 * Configuration file for Doctrine commandline scripts
 */

define('PROJECT_DIRECTORY', __DIR__);

use Symfony\Component\Yaml\Parser;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$yaml = new Parser();

$temp = $yaml->parse(file_get_contents(PROJECT_DIRECTORY . '/app/config/config.yml'));
$dbcnf = $temp['doctrine']['dbal'];

if (array_key_exists('types', $dbcnf)) {
    foreach ($dbcnf['types'] as $name => $class) {
        Doctrine\DBAL\Types\Type::addType($name, $class);
    }
}

$cnf = PROJECT_DIRECTORY . '/config/namespaces.yml';

$temp = $yaml->parse(file_get_contents($cnf));
$namespaces = array();

if ($temp === null) {
    throw new \Exception("Your namspaces config file " . $cnf . " is not properly configured.");
}

foreach ($temp as $namespace => $data) {
    $namespaces[PROJECT_DIRECTORY . '/' . $data["path"]] = $namespace;
}

$temp = $yaml->parse(file_get_contents(PROJECT_DIRECTORY . '/app/config/parameters.yml'));
$cnf = $temp["parameters"];

$connectionOptions = array(
    'driver'   => $cnf["database_driver"],
    'host'     => $cnf["database_host"],
    'password' => $cnf["database_password"],
    'dbname'   => $cnf["database_name"],
    'user'     => $cnf["database_user"],
    'port'     => $cnf["database_port"],
);

$config = new Configuration();
$config->setMetadataDriverImpl(new SimplifiedYamlDriver($namespaces));
$config->setAutoGenerateProxyClasses(true);
$config->setProxyDir(PROJECT_DIRECTORY . '/config/doctrine/orm/Proxies');
$config->setProxyNamespace('Proxies');

foreach ($namespaces as $key => $namespace) {
    $alias = $namespace;
    $alias = preg_replace('/\W/', '', $alias);
    $alias = preg_replace('/Entity$/', '', $alias);
    $config->addEntityNamespace($alias, $namespace);
}

$em = EntityManager::create($connectionOptions, $config);

if (array_key_exists('mapping_types', $dbcnf)) {
    foreach ($dbcnf['mapping_types'] as $key => $value) {
        $em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping($key, $value);
    }
}

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));
