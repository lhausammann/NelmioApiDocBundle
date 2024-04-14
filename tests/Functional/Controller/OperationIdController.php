<?php

declare(strict_types=1);

/*
 * This file is part of the NelmioApiDocBundle package.
 *
 * (c) Nelmio
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nelmio\ApiDocBundle\Tests\Functional\Controller;

use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class OperationIdController
{
    // a route with only a symfony route annotation (generates GET Operation using available metadata as operationId)
    #[Route(path: '/generate/operation_id_route_unnamed', methods: 'GET')]
    public function getMustGenerateOperationIdByUnnamedRouteAnnotation(): JsonResponse
    {
        return new JsonResponse();
    }
    // a route with a named symfony route annotation (generates GET Operation using route name as operationId)
    #[Route(path: '/generate/operation_id_route', name: 'named_route', methods: 'GET')]
    public function getMustGenerateOperationIdByRouteAnnotation(): JsonResponse
    {
        return new JsonResponse();
    }

    // a route with an OA\Get annotation and a separate ApiDoc Annotation(extends GET operation with operationId)
    #[Route(path: '/generate/operation_id_with_security/', name: 'with_security', methods: 'GET')]
    #[OA\Get('OperationId must be generated automatically when additional OA/nelmio root annotations are present')]
    #[Security(name: 'bearerAuth')] // additioanl root annotations
    public function getWithAdditionalAnnotationsGeneratesOperationId(): JsonResponse
    {
        return new JsonResponse();
    }

    // a route with an OA\GET annotation (extends GET operation with operationId)
    #[Route(path: '/generate/operation_id_get', name: 'get_annotation', methods: 'GET')]
    #[OA\Get(summary: 'OperationId must be generated automatically if not provided')]
    public function getMustGenerateOperationIByGetAnnotation(): JsonResponse
    {
        return new JsonResponse();
    }

   // custom operationId is uesed when set explicitly
    #[Route(path: '/has/explicit/operationid', name: 'customOperationId', methods: 'GET')]
    #[OA\Get(summary: 'Custom operation id must be taken', operationId: 'customOperationId')]
    public function getWithCustomOperationId(): JsonResponse
    {
        return new JsonResponse();
    }
}
