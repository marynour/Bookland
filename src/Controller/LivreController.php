<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Entity\Auteur;
use App\Form\LivreType;
use App\Form\AugmenternoteType;
use App\Repository\LivreRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use App\Controller\Connection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;





/**
 * @Route("/livre")
 */
class LivreController extends AbstractController
{
    /**
     * @Route("/", name="livre_index", methods={"GET"})
     */
    public function index( LivreRepository $livreRepository): Response
    {
        return $this->render('livre/index.html.twig', [
            
            'livres' => $livreRepository->findAll(),
            
        ]);
    }

    /**
     * @Route("/livrenati", name="livrenatio", methods={"GET"})
     */
    public function findlivrenationality( LivreRepository $livreRepository): Response 
    {
        return $this->render('livre/livrenatio.html.twig', [

            'livres' => $livreRepository->findBynationality(),
        ]);
    
    }

    /**
     * @Route("/livreparite", name="livreparite", methods={"GET"})
     */
    public function findlivreparite( LivreRepository $livreRepository): Response 
    {
        return $this->render('livre/parite.html.twig', [

            'livres' => $livreRepository->findByparite(),
        ]);
    
    }

    /**
     * @Route("/datenote", name="note_date", methods={"GET", "POST"})
     */
    public function find_date_note(Request $request,LivreRepository $livreRepository): Response
    {
        $form = $this->createFormBuilder()
        ->add('date1',DateType::class, [
            'attr' => [
                'class' => 'form-control',
                'type' => 'date'
            ],
            'widget' => 'single_text'
        ])

        ->add('date2',DateType::class, [
            'attr' => [
                'class' => 'form-control',
                'type' => 'date'
            ],
            'widget' => 'single_text'
        ])

        ->add('notemin',TextType::class)
        ->add('notemax',TextType::class)
        ->add('Enregistrer',SubmitType::class)
        ->getForm()
        ;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $data=$form->getData();
            $date1=$data['date1'];
            $date2=$data['date2'];
            $notemin=$data['notemin'];
            $notemax=$data['notemax'];


            return $this->render('livre/index.html.twig', [

                'livres' => $livreRepository->findByDateandnote($date1,$date2,$notemin,$notemax),
            ]);
        }
        return $this->render('livre/date.html.twig', [
            'form' => $form->createView(),
         //   'livres' => $livreRepository->findByDate($data['date1'],$data['date2']),
        ]);
    }

    /**
     * @Route("/date", name="livre_date", methods={"GET", "POST"})
     */
    public function find_date(Request $request,LivreRepository $livreRepository): Response
    {
        $form = $this->createFormBuilder()
        ->add('date1',DateType::class, [
                'attr' => [
                'class' => 'form-control',
                'type' => 'date'
            ],
            'widget' => 'single_text'
        ])
        ->add('date2',DateType::class, [
            'attr' => [
                'class' => 'form-control',
                'type' => 'date'
            ],
            'widget' => 'single_text'
        ])
        ->add('save',SubmitType::class)
        ->getForm()
        ;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            
            $data=$form->getData();
            $date1=$data['date1'];
            $date2=$data['date2'];
            return $this->render('livre/index.html.twig', [
            
                'livres' => $livreRepository->findByDate($date1,$date2),
            ]);
        }
        return $this->render('livre/date.html.twig', [
            'form' => $form->createView(),
         //   'livres' => $livreRepository->findByDate($data['date1'],$data['date2']),
        ]);
    }
    /**
     * @Route("/numberp", name="livre_nbpages", methods={"GET", "POST"})
     */
    public function findnbpage(Request $request,LivreRepository $livreRepository): Response
    {
        $form = $this->createFormBuilder()
        
        ->add('genrenom',TextType::class,[
            'label' => ' Donnez un genre  :'
        ])
        ->add('Save',SubmitType::class)
        ->getForm()
        ;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $data=$form->getData();
            $genre=$data['genrenom'];

            return $this->render('livre/nbpages2.html.twig', [

                'livres' => $livreRepository-> findBypagenumber($genre),
                'genre'=>$genre
            ]);
        }
        return $this->render('livre/nbpages.html.twig', [
            'form' => $form->createView(),
         //   'livres' => $livreRepository->findByDate($data['date1'],$data['date2']),
        ]);
    }
    
    /**
     * @Route("/avgnbpage", name="livre_moyennenbpages", methods={"GET", "POST"})
     */
    public function findnbpagemoyenne(Request $request,LivreRepository $livreRepository): Response
    {
        $form = $this->createFormBuilder()
        
        ->add('genrenom',TextType::class,[
            'label' => ' Donnez un genre  :'
        ])
        ->add('Save',SubmitType::class)
        ->getForm()
        ;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $data=$form->getData();
            $genre=$data['genrenom'];

            return $this->render('livre/nbpagesmoyenne.html.twig', [

                'livres' => $livreRepository-> findBypagenumbermoyenne($genre),
                'genre'=>$genre
            ]);
        }
        return $this->render('livre/nbpages.html.twig', [
            'form' => $form->createView(),
         //   'livres' => $livreRepository->findByDate($data['date1'],$data['date2']),
        ]);
    }
    
    /**
     * @Route("/search", name="livre_search", methods={"GET", "POST"})
     */
    public function findtitre(Request $request,LivreRepository $livreRepository): Response
    {
        $form = $this->createFormBuilder()
        
        ->add('titre',TextType::class,[
            
            'label'=> 'Chercher par une partie de titre :',    
        ])
        ->add('chercher',SubmitType::class,[   
            'attr' =>['class'=>'btn btn-primary']  
        ])
        ->getForm()
        ;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $data=$form->getData();
            $titre=$data['titre'];

            return $this->render('livre/index.html.twig', [

                'livres' => $livreRepository-> findBypartietitre($titre)
                
            ]);
        }
        return $this->render('livre/search.html.twig', [
            'form' => $form->createView(),
         //   'livres' => $livreRepository->findByDate($data['date1'],$data['date2']),
        ]);
    }

    /**
     * @Route("/new", name="livre_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($livre);
            $entityManager->flush();

            return $this->redirectToRoute('livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livre/new.html.twig', [
            'livre' => $livre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/augmenter", name="augmenterlivre" , methods={"GET", "POST"})
     * 
     */

    public function augmenter(Request $request, LivreRepository $livreRepository){
        
        $form = $this->createForm(AugmenternoteType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $data = $form->getData();
          $valeur = $data['valeur'];
            if($valeur==null){

                $valeur = 1;

            }
            if($valeur < 0 ){

                $valeur = 0;

            }
         

             $auteur = $data['auteur'];
             
             $livres=$auteur->getLivres();

             foreach($livres as $livre){
            
                  $livre->setNote($livre->getNote() + $valeur);
                  $this->getDoctrine()->getManager()->flush();
                
                  
             }

           return $this->redirectToRoute('livre_index');
        }

             return $this->render('livre/augmenternote.html.twig', [
            'formulaire' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="livre_show", methods={"GET"})
     */
    public function show(Livre $livre): Response
    {
        return $this->render('livre/show.html.twig', [
            'livre' => $livre,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="livre_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Livre $livre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livre/edit.html.twig', [
            'livre' => $livre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="livre_delete", methods={"POST"})
     */
    public function delete(Request $request, Livre $livre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livre->getId(), $request->request->get('_token'))) {
            $entityManager->remove($livre);
            $entityManager->flush();
            
        }

        return $this->redirectToRoute('livre_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/augmenter_note/{id}", name="augmenternote")
     * 
     */
    public function augmenternote(Request $request, Livre $livre, EntityManagerInterface $entityManager): Response{
    
        if($livre){
            if($livre->getNote()==20){

                $livre->setNote($livre->getNote());
            } 
            else {
            $livre->setNote($livre->getNote()+1);
            $entityManager->flush();
            
            }
            return $this->redirectToRoute('livre_index',['id'=>$livre->getId()]);
        }
        


        return $this->redirectToRoute('livre_index');

    }

    /**
     * @Route("/dim_note/{id}", name="diminuernote")
     * 
     */
    public function diminuernote(Request $request, Livre $livre, EntityManagerInterface $entityManager): Response{

        if($livre){
            if($livre->getNote()==0){

                $livre->setNote($livre->getNote());
            } 
            else {
            $livre->setNote($livre->getNote()-1);
            $entityManager->flush();
            
            }
            return $this->redirectToRoute('livre_index',['id'=>$livre->getId()]);
        }
        


        return $this->redirectToRoute('livre_index');

    }
    
    

}
