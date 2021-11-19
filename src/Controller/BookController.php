<?php

namespace App\Controller;

use App\Model\AuthorQuery;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;

class BookController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/api/books")
     */
    public function cget()
    {
        return iterator_to_array(AuthorQuery::create()->find());
    }
}
