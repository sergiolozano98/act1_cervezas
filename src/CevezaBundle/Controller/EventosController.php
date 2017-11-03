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
    /**
     * @Route("/crear/{nombre}/{ciudad}")
     */
    public function crearCerveza($nombre,$ciudad)
   {
     //nuevo objeto
     $cerveza = new Cerveza();
     $cerveza->setNombre($nombre);
     $cerveza->setPais($ciudad);
     $cerveza->setPoblacion("prueba");
     $cerveza->setTipo("prueba");
     $cerveza->setImportacion(2);
     $cerveza->setTamano(2);
     $cerveza->setfechaAlmacen(\DateTime::createFromFormat('d/m/Y','25/04/2015'));
     $cerveza->setCantidad(2);
     $cerveza->setFoto("prueba");
     //lanzamos contra la base de datos
     $mangDoct=$this->getDoctrine()->getManager();
     $mangDoct->persist($cerveza);
     $mangDoct->flush($cerveza);
     return $this->render('CevezaBundle:eventos:crearempresa.html.twig',array('allCerveza'=>$cerveza->getNombre()));

   }
}
