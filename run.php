#!/usr/bin/env php
<?php

use Sichkarev\Task\Application;
use Sichkarev\Task\Commands\{StartCommand, TurnCommand, WalkCommand};
use Sichkarev\Task\DataProviders\FileDataProvider;
use Sichkarev\Task\Handlers\ConsoleExceptionHandler;
use Sichkarev\Task\Parsers\TextParser;
use Sichkarev\Task\Services\CalculateRouteService;
use Sichkarev\Task\Validators\TaskLogicValidator\Rules\{EndLineRule,
    FirstWordRule,
    MaxTestCaseCountRule,
    NumericInputValidRule,
    RouteCountCorrectRule,
    RouteTypeCorrectRule,
    RowStartWithFloatRule,
    TestCaseCountPeopleRule};
use Sichkarev\Task\Validators\TaskLogicValidator\TaskLogicValidator;

// подключаем composer autoload psr-4
require_once __DIR__ . './vendor/autoload.php';

// создаем экземпляр приложения и устанавливаем сервис расчёта
$service = new CalculateRouteService([
    StartCommand::class,
    WalkCommand::class,
    TurnCommand::class
]);
$app = new Application($service);

// устанавливаем обработчик ошибок приложения
$app->setExceptionHandler(new ConsoleExceptionHandler());

// добавляем в приложение провайдеры откуда у нас будут получены нужные нам данные
$app->addDataProvider(new FileDataProvider('.\data\input.txt'));

// определяем и устанавливаем парсер строк
$app->setDataParser(new TextParser());

// определяем валидатор и правила валидации
$validator = new TaskLogicValidator([
    RowStartWithFloatRule::class,
    RouteTypeCorrectRule::class,
    RouteCountCorrectRule::class,
    NumericInputValidRule::class,
    MaxTestCaseCountRule::class,
    FirstWordRule::class,
    TestCaseCountPeopleRule::class,
    EndLineRule::class
]);

// устанавливаем валидатор
$app->setValidator($validator);

$exitCode = $app->run();
exit($exitCode);
