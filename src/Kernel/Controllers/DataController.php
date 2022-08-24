<?php

namespace Kernel\Controllers;

use Kernel\Models\DataCsv;

class DataController extends AbstractController
{
    public function view()
    {
        $data = DataCsv::getData();

        if (data === null){
            throw new NotFoundException();
        }

        $this->view->renderHtml('main/data.php', [
            'data' => $data,
        ]);
    }
}

