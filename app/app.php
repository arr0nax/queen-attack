<?php
date_default_timezone_set('America/Los_Angeles');
require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../src/Queen.php";
session_start();
if (empty($_SESSION['game'])) {
  $_SESSION['game'] = new Game;
}


$app = new Silex\Application();
$app->register(new Silex\Provider\TwigServiceProvider(), ["twig.path" => __DIR__."/../views"]);

$app->get('/', function() use ($app) {
    $_SESSION['game'] = new Game;
    return $app['twig']->render("root.html.twig");
});

$app->post('/move', function() use ($app) {
    $activeX = $_POST['xIndex'];
    $activeY = $_POST['yIndex'];
    $_SESSION['game']->selectPiece($activeX, $activeY);
    $_SESSION['game']->movePiece($activeX, $activeY);
    return json_encode($_SESSION['game']);
    });

return $app;
?>
