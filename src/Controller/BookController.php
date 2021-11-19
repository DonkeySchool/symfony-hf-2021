<?php

namespace App\Controller;

use App\Form\BookType;
use App\Model\BookQuery;
use App\Model\Book;
use App\Model\Base\Book as BaseBook;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation as ApiDoc;

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

    /**
     * @ApiDoc\Operation(
     *     tags={"Books"},
     *     summary="Create book",
     *     @SWG\Parameter(
     *         name="form",
     *         in="body",
     *         @ApiDoc\Model(type=BookType::class)
     *     ),
     *     @SWG\Response(
     *         response="201",
     *         description="Book created",
     *         @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="title", type="string"),
     *              @SWG\Property(property="id", type="integer"),
     *         )
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid form"
     *     )
     * )
     * @Rest\Post("/api/books")
     * @Rest\View(serializerGroups={"book_get"}, statusCode=201)
     */
    public function post(Request $request)
    {
        $form = $this->createForm(BookType::class);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            $book = $form->getData();
            $book->save();

            return $book;
        }

        return $this->view(['form' => $form], Response::HTTP_BAD_REQUEST);
    }
}
