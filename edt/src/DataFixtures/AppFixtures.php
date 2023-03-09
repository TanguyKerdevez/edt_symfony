<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Professeur;
use App\Entity\Avis;
use App\Entity\AvisCours;
use App\Entity\Salle;
use App\Entity\Matiere;
use App\Entity\Cours;

class AppFixtures extends Fixture
{

    public function newProf(string $nom, $prenom, $email) : Professeur
    {
        $prof = new Professeur();
        $prof->setNom($nom);
        $prof->setPrenom($prenom);
        $prof->setEmail($email);
        return $prof;
    }

    public function newMat(string $titre, $ref) : Matiere
    {
        $mat = new Matiere();
        $mat->setTitre($titre);
        $mat->setReference($ref);
        return $mat;
    }

    public function newAvis(int $note, string $com, $email) : Avis
    {
        $avis = new Avis();
        $avis->setNote($note);
        $avis->setCommentaire($com);
        $avis->setEmailEtudiant($email);
        return $avis;
    }

    public function newCours(string $type, $debut, $fin) : Cours
    {
        $cours = new Cours();
        $cours->setType($type);
        $cours->setDateHeureDebut(\DateTime::createFromFormat('Y-m-d H:i', $debut));
        $cours->setDateHeureFin(\DateTime::createFromFormat('Y-m-d H:i', $fin));
        return $cours;
    }

    public function newSalle(int $num) : Salle
    {
        $salle = new Salle();
        $salle->setNumero($num);
        return $salle;
    }

    public function newAvisCours(int $note, string $com, $email) : AvisCours
    {
        $avis = new AvisCours();
        $avis->setNote($note);
        $avis->setCommentaire($com);
        $avis->setEmailEtudiant($email);
        return $avis;
    }

    public function load(ObjectManager $manager): void
    {
        $mat1 = $this->newMat("Mathématiques", "MATH");
        $mat2 = $this->newMat("Français", "FRAN");

        $prof1 = $this->newProf("Rouge", "Jaques", "jaquesr@mail.com");
        $prof1->addMatiere($mat1);

        $prof2 = $this->newProf("Harris", "Pain", "painharris@mail.com");
        $prof2->addMatiere($mat2);

        $avis1 = $this->newAvis(3, "Le prof: 👌", "peter@gmail.com");
        $avis1->setProfesseur($prof2);

        $avis2 = $this->newAvis(2, "Boff...........", "poule@gmoule.com");
        $avis2->setProfesseur($prof1);

        $avis3 = $this->newAvis(0, "je l'aime pas 😤", "lad@gmail.com");
        $avis3->setProfesseur($prof1);

        $salle1 = $this->newSalle(1);
        $salle2 = $this->newSalle(2);
        $salle3 = $this->newSalle(3);

        $cours1 = $this->newCours("Informatique", "2023-03-06 10:00", "2023-03-06 12:00");
        $cours1->setProfesseur($prof2);
        $cours1->setMatiere($mat1);
        $cours1->setSalle($salle2);

        $cours2 = $this->newCours("Standard", "2022-04-03 04:00", "2022-04-03 12:00");
        $cours2->setProfesseur($prof1);
        $cours2->setMatiere($mat1);
        $cours2->setSalle($salle1);

        $cours3 = $this->newCours("Standard", "2022-05-04 09:00", "2022-05-04 11:00");
        $cours3->setProfesseur($prof2);
        $cours3->setMatiere($mat2);
        $cours3->setSalle($salle3);

        $cours4 = $this->newCours("Standard", "2022-05-04 09:00", "2022-05-04 11:00");
        $cours4->setProfesseur($prof2);
        $cours4->setMatiere($mat2);
        $cours4->setSalle($salle3);

        $avisCours1 = $this->newAvisCours(2, "Moyen....", "oli@gmail.com");
        $avisCours1->setCours($cours1);

        $avisCours2 = $this->newAvisCours(0, "Le cours j'ai trop réfléchis carrément 🤣🤣 🧠🧠", "ju@juju.u");
        $avisCours2->setCours($cours2);

        $avisCours3 = $this->newAvisCours(5, "Trop bien en vrai 👍👍👍", "jonathan@gmail.com");
        $avisCours3->setCours($cours3);

        $avisCours4 = $this->newAvisCours(4, "Je me suis échappé du cours, la je suis perdu dans la forêt svp aidez-moi 😱😱", "jul@gmail.com");
        $avisCours4->setCours($cours3);

        $avisCours5 = $this->newAvisCours(1, "On a appris pleins de trucs mais je suis toujours bête.", "moi@gmail.com");
        $avisCours5->setCours($cours2);
        

        $manager->persist($mat1);
        $manager->persist($mat2);
        $manager->persist($prof1);
        $manager->persist($prof2);
        $manager->persist($avis1);
        $manager->persist($avis2);
        $manager->persist($avis3);
        $manager->persist($salle1);
        $manager->persist($salle2);
        $manager->persist($salle3);
        $manager->persist($cours1);
        $manager->persist($cours2);
        $manager->persist($cours3);
        $manager->persist($cours4);
        $manager->persist($avisCours1);
        $manager->persist($avisCours2);
        $manager->persist($avisCours3);
        $manager->persist($avisCours4);
        $manager->persist($avisCours5);

        $manager->flush();
    }

    
}
