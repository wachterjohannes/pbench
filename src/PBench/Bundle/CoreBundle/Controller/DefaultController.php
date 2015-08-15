<?php

namespace PBench\Bundle\CoreBundle\Controller;

use PBench\Component\Session\Document\DatabaseNotFoundErrorDocument;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     *
     * @return JsonResponse
     */
    public function statusAction()
    {
        // TODO global status
        return new JsonResponse();
    }

    /**
     * @Route("/{name}/")
     *
     * @param string $name
     *
     * @return JsonResponse
     */
    public function databaseAction($name)
    {
        $repository = $this->get('pbench.repository');

        if (!$repository->has($name)) {
            return new JsonResponse(new DatabaseNotFoundErrorDocument(), 404);
        }

        $session = $repository->login($name);

        return new JsonResponse($session->getDatabaseStatus());
    }
}
