<?php



use Slim\Http\Request;
use Slim\Http\Response;

include_once "model/revenue.php";
include_once "model/revenue-repository.php";

// Routes

$app->get('/revenues', function (Request $request, Response $response, array $args) {
    $this->logger->info("Slim-Skeleton '/' route");
    $repository = new RevenueRepository();
    $list = $repository->listRevenues();
    echo json_encode($list);
    
});


$app->get('/revenues/{id}', function (Request $request, Response $response, array $args) {

    $repository = new RevenueRepository();
    $revenue = $repository->getRevenueById($args['id']);
    echo json_encode($revenue);

});

$app->post('/revenue', function (Request $request, Response $response, array $args) {
    $repository = new RevenueRepository();
    $revenue = new Revenue();
    $body = $request->getParsedBody();
    $revenue->setName($body['name']);
    $revenue->setAmount($body['amount']);
    $revenue->setDueDate($body['dueDate']);
    $revenue->setReceivedDate($body['receivedDate']);
    $revenue->setInformation($body['information']);
    $result = $repository->createRevenue($revenue);
    echo json_encode($result);
    
});


$app->put('/revenue/{id}', function (Request $request, Response $response, array $args) {
    $repository = new RevenueRepository();
    $revenue = new Revenue();
    $body = $request->getParsedBody();
    $revenue->setId($args['id']);
    $revenue->setName($body['name']);
    $revenue->setAmount($body['amount']);
    $revenue->setDueDate($body['dueDate']);
    $revenue->setReceivedDate($body['receivedDate']);
    $revenue->setInformation($body['information']);
    $result = $repository->updateRevenue($revenue);
    echo json_encode($result);

});


$app->delete('/revenue/{id}', function (Request $request, Response $response, array $args) {
    $repository = new RevenueRepository();
    $revenue = new Revenue();
    $revenue->setId($args['id']);
    $result = $repository->deleteRevenue($revenue);
    echo json_encode($result);

});
