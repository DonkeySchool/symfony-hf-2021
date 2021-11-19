<?php

namespace App\Controller;

use App\Model\Base\BookQuery;
use App\Model\Book;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;

class BookController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/api/books")
     * @Rest\View(serializerGroups={"book_cget"})
     */
    public function cget()
    {
        return iterator_to_array(
            BookQuery::create()
                ->joinWithAuthor()
                ->find()
        );
    }

    /**
     * @Rest\Get("/api/books/{id}")
     * @Rest\View(serializerGroups={"book_get"})
     */
    public function getOne(Book $book)
    {
        return $book;
    }
}
