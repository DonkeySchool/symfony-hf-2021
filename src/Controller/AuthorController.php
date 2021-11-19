<?php

namespace App\Controller;

use App\Model\AuthorQuery;
use App\Model\Author;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;

class AuthorController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/api/authors")
     * @Rest\View(serializerGroups={"author_cget"})
     */
    public function cget()
    {
        return iterator_to_array(
            AuthorQuery::create()
                ->find()
        );
    }

    /**
     * @Rest\Get("/api/authors/{id}")
     * @Rest\View(serializerGroups={"author_get"})
     */
    public function getOne(Author $author)
    {
        return $author;
    }
}
