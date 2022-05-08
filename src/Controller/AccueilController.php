<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Auteur;
use App\Entity\Genre;
use App\Entity\Livre;
use Symfony\Bundle\MakerBundle\Validator;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    /**
     * @Route("bookland/init", name="init")
     */
    public function init(ValidatorInterface $validator) :Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        
        $auteurRepository = $this->getDoctrine()->getRepository(Auteur::class);
        $genrerepository = $this->getDoctrine()->getRepository(Genre::class);
        $livreRepository = $this->getDoctrine()->getRepository(Livre::class);
        $auteurs = $auteurRepository->findAll();
        $genres =  $genrerepository->findAll();
        $livres = $livreRepository->findAll();
        
        if($auteurs and $genres and $livres){
            return new Response(' Données déja existantes');
        }else{
         $auteur1 = new Auteur;
         $auteur1->setNomPrenom("Richard Thaler");
         $auteur1->setDateDeNaissance(new \DateTime('12-12-1945'));
         $auteur1->setNationalite("USA");
         $auteur1->setSexe("M");
           
         $auteur2 = new Auteur;
         $auteur2->setNomPrenom("Cass Sunstein");
         $auteur2->setDateDeNaissance(new \DateTime('23-11-1943'));
         $auteur2->setNationalite("allemagne");
         $auteur2->setSexe("M");

         $auteur3 = new Auteur;
         $auteur3->setNomPrenom("Francis Gabrelot");
         $auteur3->setDateDeNaissance(new \DateTime('29-01-1967'));
         $auteur3->setNationalite("france");
         $auteur3->setSexe("M");

         
         $auteur4 = new Auteur;
         $auteur4->setNomPrenom("Ayn Rand");
         $auteur4->setDateDeNaissance(new \DateTime('21-06-1950'));
         $auteur4->setNationalite("russie");
         $auteur4->setSexe("F");
          
         $auteur5 = new Auteur;
         $auteur5->setNomPrenom("Duschmol");
         $auteur5->setDateDeNaissance(new \DateTime('23-12-2001'));
         $auteur5->setnationalite("groland");
         $auteur5->setSexe("M");

         $auteur6 = new Auteur;
         $auteur6->setNomPrenom("Nancy Grave");
         $auteur6->setDateDeNaissance(new \DateTime('24-10-1952'));
         $auteur6->setNationalite("USA");
         $auteur6->setSexe("F");

         $auteur7 = new Auteur;
         $auteur7->setNomPrenom("James Encklin");
         $auteur7->setDateDeNaissance(new \DateTime('03-07-1970'));
         $auteur7->setNationalite("USA");
         $auteur7->setSexe("M");

         $auteur8 = new Auteur;
         $auteur8->setNomPrenom("Jean Dupont");
         $auteur8->setDateDeNaissance(new \DateTime('03-07-1970'));
         $auteur8->setNationalite("france");
         $auteur8->setSexe("M");


         $genre1 = new Genre;
         $genre1->setNom("science fiction");

         $genre2 = new Genre;
         $genre2->setNom("policier");

         $genre3 = new Genre;
         $genre3->setNom("philosophie");

         $genre4 = new Genre;
         $genre4->setNom("économie");

         $genre5 = new Genre;
         $genre5->setNom("psychologie");
         
         $livre1 = new Livre;
         $livre1->setTitre("Symfonystique");
         $livre1->setIsbn('978-2-07-036822-8');
         $livre1->setNbpages(117);
         $livre1->setDateDeParution(new \DateTime('20-01-2008'));
         $livre1->setNote(8);
         $livre1->addGenre($genre2);
         $livre1->addGenre($genre3);
         $livre1->addAuteur($auteur3);
         $livre1->addAuteur($auteur4);
         $livre1->addAuteur($auteur6);

         $livre2 = new Livre;
         $livre2->setTitre("La grève");
         $livre2->setIsbn('978-2-251-44417-8');
         $livre2->setNbpages(1245);
         $livre2->setDateDeParution(new \DateTime('12-06-1961'));
         $livre2->setNote(19);
         $livre2->addGenre($genre3);
         $livre2->addAuteur($auteur4);
         $livre2->addAuteur($auteur7);

         $livre3 = new Livre;
         $livre3->setTitre("Symfonyland");
         $livre3->setIsbn('978-2-212-55652-0');
         $livre3->setNbpages(131);
         $livre3->setDateDeParution(new \DateTime('17-09-1980'));
         $livre3->setNote(15);
         $livre3->addGenre($genre1);
         $livre3->addauteur($auteur8);
         $livre3->addauteur($auteur7);
         $livre3->addauteur($auteur4);

         $livre7 = new Livre;
         $livre7->setTitre("Négociation Complexe");
         $livre7->setIsbn('978-2-0807-1057-4');
         $livre7->setNbpages(234);
         $livre7->setDateDeParution(new \DateTime('25-09-1992'));
         $livre7->setNote(16);
         $livre7->addGenre($genre5);
         $livre7->addauteur($auteur1);
         $livre7->addauteur($auteur2);

         $livre4 = new Livre;
         $livre4->setTitre("Ma vie");
         $livre4->setIsbn('978-0-300-12223-7');
         $livre4->setNbpages(5);
         $livre4->setDateDeParution(new \DateTime('08-11-2021'));
         $livre4->setNote(03);
         $livre4->addGenre($genre2);
         $livre4->addauteur($auteur8);

         $livre5 = new Livre;
         $livre5->setTitre("Ma vie : suite");
         $livre5->setIsbn('978-0-141-18776-1');
         $livre5->setNbpages(5);
         $livre5->setDateDeParution(new \DateTime('09-11-2021'));
         $livre5->setNote(01);
         $livre5->addGenre($genre2);
         $livre5->addauteur($auteur8);

         $livre6 = new Livre;
         $livre6->setTitre("Le monde comme volonté et comme représentation");
         $livre6->setIsbn('978-0-141-18786-0');
         $livre6->setNbpages(1987);
         $livre6->setDateDeParution(new \DateTime('09-11-1821'));
         $livre6->setNote(19);
         $livre6->addGenre($genre3);
         $livre6->addauteur($auteur3);
         $livre6->addauteur($auteur6);
    
         $error = $validator->validate($livre1);
         if(count($error)==0)
            $entityManager->persist($livre1);
        $error = $validator->validate($livre2);
        if(count($error)==0)
            $entityManager->persist($livre2);
        $error = $validator->validate($livre3);
        if(count($error)==0)
             $entityManager->persist($livre3);
        $error = $validator->validate($livre4);
         if(count($error)==0)
            $entityManager->persist($livre4);
        $error = $validator->validate($livre5);
            if(count($error)==0)
               $entityManager->persist($livre5);
        $error = $validator->validate($livre6);
         if(count($error)==0)
            $entityManager->persist($livre6);
        $error = $validator->validate($livre7);
         if(count($error)==0)
            $entityManager->persist($livre7);

        $error = $validator->validate($auteur1);
        if(count($error)==0)
            $entityManager->persist($auteur1);
        $error = $validator->validate($auteur2);
        if(count($error)==0)
            $entityManager->persist($auteur2);
        $error = $validator->validate($auteur3);
        if(count($error)==0)
            $entityManager->persist($auteur3);
        $error = $validator->validate($auteur4);
        if(count($error)==0)
            $entityManager->persist($auteur4);
        $error = $validator->validate($auteur5);
        if(count($error)==0)
            $entityManager->persist($auteur5);
        $error = $validator->validate($auteur6);
        if(count($error)==0)
            $entityManager->persist($auteur6);
        $error = $validator->validate($auteur7);
        if(count($error)==0)
            $entityManager->persist($auteur7);
        $error = $validator->validate($auteur8);
        if(count($error)==0)
            $entityManager->persist($auteur8);




            
        $error = $validator->validate($genre1);
        if(count($error)==0)
            $entityManager->persist($genre1);
        $error = $validator->validate($genre2);
        if(count($error)==0)
            $entityManager->persist($genre2);
        $error = $validator->validate($genre3);
        if(count($error)==0)    
            $entityManager->persist($genre3);
        $error = $validator->validate($genre4);
        if(count($error)==0)   
            $entityManager->persist($genre4);
        $error = $validator->validate($genre5);
        if(count($error)==0)   
            $entityManager->persist($genre5);
         

         $entityManager->flush();

         return new Response('Succès d insertion  des données ');}



    }
}

