<?php

use Slim\Http\Request;
use Slim\Http\Response;

include_once "model/revenue.php";
include_once "model/revenue-repository.php";

// Routes

$app->get('/{name}', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    $repository = new RevenueRepository();
    $list = $repository->list();
    echo json_encode($list);
    
});
