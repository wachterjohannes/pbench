<?php

namespace PBench\Bundle\CoreBundle\Controller;

use PBench\Component\Session\Document\DatabaseNotFoundErrorDocument;
use PBench\Component\Session\Exception\SessionException;
use PBench\Component\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function statusAction()
    {
        // TODO global status
        return new JsonResponse();
    }

    /**
     * @Route("/{name}/", methods={"GET"})
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

    /**
     * @Route("/{name}/{id}", methods={"GET"})
     *
     * @param string $name
     * @param string $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getDocumentAction($name, $id, Request $request)
    {
        // TODO latest, revisions
        $revision = $request->get('rev', null);
        $revisions = $request->get('revs', false);
        $latest = json_decode($request->get('latest', 'false'));
        $openRevisions = json_decode($request->get('open_revs', '[]'));

        try {
            $session = $this->getSession($name);

            if (!$openRevisions) {
                return new JsonResponse($session->getDocumentRevisions($id, $revision));

            }

            return new JsonResponse($session->getDocument($id, $revision));
        } catch (SessionException $ex) {
            return new JsonResponse($ex->getErrorDocument(), $ex->getStatusCode());
        }
    }

    /**
     * @Route("/{name}/_local/{revision}", methods={"GET"})
     *
     * @param string $name
     * @param string $revision
     *
     * @return JsonResponse
     */
    public function hasChangeAction($name, $revision)
    {
        try {
            $session = $this->getSession($name);

            return new JsonResponse($session->getSynchronizedChange($name, $revision));
        } catch (SessionException $ex) {
            return new JsonResponse($ex->getErrorDocument(), $ex->getStatusCode());
        }
    }

    /**
     * @Route("/{name}/_local/{revision}", methods={"POST"})
     *
     * @param string $name
     * @param string $revision
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function storeSyncedChangeAction($name, $revision, Request $request)
    {
        $revisionDocument = json_decode($request->getContent(), true);

        try {
            $session = $this->getSession($name);

            return new JsonResponse(
                $session->storeSynchronizedChange(
                    $revisionDocument
                ), 201
            );

        } catch (SessionException $ex) {
            return new JsonResponse($ex->getErrorDocument(), $ex->getStatusCode());
        }
    }

    /**
     * @param string $name
     *
     * @return SessionInterface
     *
     * @throws SessionException
     */
    private function getSession($name)
    {
        $repository = $this->get('pbench.repository');

        if (!$repository->has($name)) {
            throw new SessionException(new DatabaseNotFoundErrorDocument(), 404);
        }

        return $repository->login($name);
    }
}
