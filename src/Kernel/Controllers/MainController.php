<?php

namespace Kernel\Controllers;

use Kernel\Models\DataCsv;

class MainController extends AbstractController
{
    public function main()
    {
        $this->view->renderHtml('main/main.php', [
            'data' => $data,
            ]);
    }
    
    public function add(): void
    {
        if (!empty($_POST)) {
            try {
                $data = DataCsv::createFromArray($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('main/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /data/' . $data->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('main/add.php');
    }
}


