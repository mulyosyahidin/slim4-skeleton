<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class HomeAction
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $response->getBody()->write(json_encode([
            'success' => true,
            'message' => 'Welcome to Slim 4!',
        ]));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
