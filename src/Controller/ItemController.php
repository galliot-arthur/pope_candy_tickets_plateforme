<?php

namespace App\Controller;

use App\Model\ItemModel;

/**
 * Class ItemController
 *
 */
class ItemController extends AbstractController
{


    /**
     * Display item listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $itemModel = new ItemModel();
        $items = $itemModel->selectAll();

        return $this
            ->twig
            ->render(
                'Item/index.html.twig',
                [
                    'items' => $items,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }


    /**
     * Display item informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $itemModel = new ItemModel();
        $item = $itemModel->selectOneById($id);

        return $this
            ->twig
            ->render(
                'Item/show.html.twig',
                [
                    'item' => $item,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }


    /**
     * Display item edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $itemModel = new ItemModel();
        $item = $itemModel->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $item['title'] = $_POST['title'];
            $itemModel->update($item);
        }

        return $this
            ->twig
            ->render(
                'Item/edit.html.twig',
                [
                    'item' => $item,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }


    /**
     * Display item creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $itemModel = new ItemModel();
            $item = [
                'title' => $_POST['title'],
            ];
            $id = $itemModel->insert($item);
            header('Location:/item/show/' . $id);
        }

        return $this
            ->twig
            ->render(
                'Item/add.html.twig',
                [
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }


    /**
     * Handle item deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $itemModel = new ItemModel();
        $itemModel->delete($id);
        header('Location:/item/index');
    }
}
