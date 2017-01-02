<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Animal; 

class AnimalController extends Controller
{
    /**
     * @Route("/animals", name="animals")
     */
    public function listAnimalsAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Animal');

        $animals = $repository->findAll();

       return $this->render('animals/list.html.twig', array(
          'animals' => $animals,
        ));
    }

    /**
     * @Route("/add", name="add")
     * @Method({"GET"})
     */
    public function addAnimalAction( ) {
        
        return $this->render('animals/add.html.twig');
    }


    /**
     * @Route("/edit/{id}", name="edit")
     * @Method({"GET"})
     */
    public function editAnimalAction( Request $request ) {
        
        $repository = $this->getDoctrine()->getRepository('AppBundle:Animal');

        $animal = $repository->find($request->get('id'));

        return $this->render('animals/edit.html.twig' , array ( 'animal'  => $animal)  ) ;
    }
  /**
     * @Route("/save", name="save")
     * @Method({"POST"})
     */
    public function saveAnimalAction (Request  $request  ) {
        $animal = new Animal();

        $animal->setAge($request->get('age'));
        $animal->setFamille($request->get('famille')) ;

        $animal->setNourriture($request->get('nourriture')) ;  
        $animal->setRace($request->get('race')) ;  
        
        $em = $this->getDoctrine()->getManager();

        $em->persist($animal);

        $em->flush();
        return $this->redirectToRoute('animals');
    }

     /**
     * @Route("/saveEdited", name="save")
     * @Method({"POST"})
     */
    public function saveEditedAnimalAction (Request  $request  ) {
        
        $repository = $this->getDoctrine()->getRepository('AppBundle:Animal');

        $animal = $repository->find($request->get('id'));

        $animal->setAge($request->get('age'));
        $animal->setFamille($request->get('famille')) ;

        $animal->setNourriture($request->get('nourriture')) ;  
        $animal->setRace($request->get('race')) ;  
        
        $em = $this->getDoctrine()->getManager();

        $em->persist($animal);

        $em->flush();
        return $this->redirectToRoute('animals');
    }
}