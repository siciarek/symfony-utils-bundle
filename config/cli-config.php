<?php

/**
 * Configuration file for Doctrine commandline scripts
 *
 * @author Jacek Siciarek <siciarek@gmail.com>
 */

require_once __DIR__ . '/../app/autoload.php';

use Symfony\Component\Yaml\Parser;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$yaml = new Parser();

$cnf = __DIR__ . '/config.yml';

$temp = $yaml->parse(file_get_contents($cnf));
$namespaces = array();

if ($temp === null) {
    throw new \Exception("Your namspaces config file " . $cnf . " is not properly configured.");
}

foreach ($temp as $namespace => $data) {
    $namespaces[__DIR__ . '/../' . $data["path"]] = $namespace;
}

$temp = $yaml->parse(file_get_contents(__DIR__ . '/../app/config/parameters.yml'));
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
$config->setAutoGenerateProxyClasses(false);
$config->setProxyDir(__DIR__ . '/doctrine/orm/Proxies');
$config->setProxyNamespace('Proxies');

foreach ($namespaces as $key => $namespace) {
    $alias = $namespace;
    $alias = preg_replace('/\W/', '', $alias);
    $alias = preg_replace('/Entity$/', '', $alias);
    $config->addEntityNamespace($alias, $namespace);
}

$entityManager = EntityManager::create($connectionOptions, $config);
return ConsoleRunner::createHelperSet($entityManager);
