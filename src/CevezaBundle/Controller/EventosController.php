<?php

namespace CevezaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CevezaBundle\Entity\Cerveza;
use Symfony\Component\HttpFoundation\Request;
//incluimos en nuestras librerias la clase del formulario
use CevezaBundle\Form\CervezaType;
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
     return $this->render('CevezaBundle:eventos:crearcerveza.html.twig',array('allCerveza'=>$cerveza->getNombre()));

   }
   /**
    * @Route("/formulario")
    */
   public function crearFormCerveza(Request $request)
   {
     $cerveza = new Cerveza();
    $form=$this->createForm(CervezaType::Class,$cerveza);
    $form->handleRequest($request);
    //si el request es enviado y validado , coge los datos
    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $cerveza = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
         $em = $this->getDoctrine()->getManager();
         $em->persist($cerveza);
         $em->flush();
        return $this->render('CevezaBundle:eventos:insertada.html.twig');
    }
    // y le pasamos el formulario por array, utilizamos createView que nos pinta el formulario.
    return $this->render('CevezaBundle:eventos:formulario.html.twig',array('form'=>$form->createView() ));

   }
   /**
    * @Route("/actualizarform/{id}")
    */
   public function actuFormCerveza( Request $request,$id)
   {


		 $cerveza = $this->getDoctrine()->getRepository('CevezaBundle:Cerveza')->findById($id);
     $form=$this->createForm(CervezaType::Class, $cerveza);
     $form->handleRequest($request);

     if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cerveza);
            $em->flush();
            return $this->render("CevezaBundle:eventos:update.html.twig");
        }
          return $this->render("CevezaBundle:eventos:update.html.twig", array('form'=>$form->createView() ));
    }

    }
