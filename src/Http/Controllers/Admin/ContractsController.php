<?php

namespace Amethyst\Http\Controllers\Admin;

use Amethyst\Core\Http\Controllers\RestManagerController;
use Amethyst\Core\Http\Controllers\Traits as RestTraits;
use Amethyst\Managers\ContractManager;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContractsController extends RestManagerController
{
    use RestTraits\RestIndexTrait;
    use RestTraits\RestShowTrait;
    use RestTraits\RestCreateTrait;
    use RestTraits\RestUpdateTrait;
    use RestTraits\RestRemoveTrait;

    /**
     * The class of the manager.
     *
     * @var string
     */
    public $class = ContractManager::class;

    /**
     * Execute a common action.
     *
     * @param int                      $id
     * @param string                   $action
     * @param \Illuminate\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function commonAction($id, string $action, Request $request)
    {
        $entity = $this->getManager()->getRepository()->findOneBy(['id' => $id]);

        $result = $this->manager->$action($entity);

        if (!$result->ok()) {
            return $this->response(['errors' => $result->getSimpleErrors()], Response::HTTP_BAD_REQUEST);
        }

        return $this->response($this->serialize($result->getResource(), $request), Response::HTTP_OK);
    }

    /**
     * @param int                      $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function start($id, Request $request)
    {
        return $this->commonAction($id, 'start', $request);
    }

    /**
     * @param int                      $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function suspend($id, Request $request)
    {
        return $this->commonAction($id, 'suspend', $request);
    }

    /**
     * @param int                      $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function resume($id, Request $request)
    {
        return $this->commonAction($id, 'resume', $request);
    }

    /**
     * @param int                      $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function terminate($id, Request $request)
    {
        return $this->commonAction($id, 'terminate', $request);
    }
}
