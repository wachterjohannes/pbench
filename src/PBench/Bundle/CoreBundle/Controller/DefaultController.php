<?php

namespace PBench\Bundle\CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController
{
    /**
     * @Route("/")
     */
    public function statusAction()
    {
        // TODO global status
        return new JsonResponse();
    }


}
