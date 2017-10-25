<?php

namespace CevezaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CevezaBundle\Entity\Cerveza;
/**
 * @Route("/eventos")
 */
class EventosController extends Controller
{
    /**
     * @Route("/cerveza/{id}")
     */
     public function buscarCerveza($id)
    {
      //Recuperar el repositorio de la entidad Cerveza
      $repository = $this->getDoctrine()->getRepository(Cerveza::class);
      //metemos en la variable cerveza la info de la cervza filtrada por el id
      $cerveza = $repository->findById($id);
      //devolvemos y metemos en el array cerveza la info de antes metida en esa variable $cerveza
      return $this->render('CevezaBundle:eventos:all.html.twig',array('cerveza' => $cerveza));

    }

}
