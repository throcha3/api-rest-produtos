<?php



$router->get("/api/produtos", "ProdutoController@getAll");

$router->group(['prefix' => "/api/produto"], function() use ($router){
    $router->get("/{id}", "ProdutoController@get");
    $router->post("/", "ProdutoController@store");
    $router->put("/{id}", "ProdutoController@update");
    $router->delete("/{id}", "ProdutoController@destroy");
});
