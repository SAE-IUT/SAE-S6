<?php

namespace App\DataFixtures;

use App\Entity\Adherent;
use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Emprunt;
use App\Entity\Livre;
use App\Entity\Reservations;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class BiblioFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // 1. Création des catégories
        $categoriesData = [
            ['Thriller', 'Suspense et intrigue'],
            ['Fantasy', 'Monde imaginaire et magie'],
            ['Historique', 'Événements et personnages historiques'],
            ['Jeunesse', 'Littérature pour enfants et adolescents'],
        ];
        $categories = [];
        foreach ($categoriesData as $categoryData) {
            [$nom, $description] = $categoryData;

            $category = (new Categorie())
                ->setNom($nom)
                ->setDescription($description);

            $categories[] = $category;
            $manager->persist($category);
        }
        $manager->flush();

        // 2. Création des auteurs
        $auteurs = [];
        for ($i = 0; $i < 8; $i++) {
            $dateNaissance = DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-60 years', '-20 years'));
            $dateDeces = DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-20 years', 'now'));

            $auteur = (new Auteur())
                ->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setDateNaissance($dateNaissance)
                ->setDateDeces($dateDeces)
                ->setNationalite($faker->country)
                ->setPhoto('https://picsum.photos/360/360?image=' . $i)
                ->setDescription($faker->sentence);

            $auteurs[] = $auteur;
            $manager->persist($auteur);
        }
        $manager->flush();

        // 3. Création des livres
        $livres = [];
        for ($i = 0; $i < 20; $i++) {
            $dateSortie = DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-5 years', 'now'));

            $livre = (new Livre())
                ->setTitre($faker->sentence(4))
                ->setDateSortie($dateSortie)
                ->setLangue($faker->languageCode)
                ->setPhotoCouverture('https://picsum.photos/360/360?image=' . ($i + 200));

            // Ajout des auteurs au livre
            shuffle($auteurs);
            $randomAuteurs = array_slice($auteurs, 0, mt_rand(1, 2));
            foreach ($randomAuteurs as $auteur) {
                $livre->addAuteur($auteur);
            }

            // Ajout des catégories au livre
            shuffle($categories);
            $randomCategories = array_slice($categories, 0, mt_rand(1, 2));
            foreach ($randomCategories as $category) {
                $livre->addCategory($category);
            }

            $livres[] = $livre;
            $manager->persist($livre);
        }
        $manager->flush();

        // 4. Création des adhérents
        $adherents = [];
        for ($i = 0; $i < 30; $i++) {
            $dateAdhesion = DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 years', 'now'));

            $adherent = (new Adherent())
                ->setDateAdhesion($dateAdhesion)
                ->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setDateNaiss($faker->dateTimeBetween('-50 years', '-20 years'))
                ->setEmail($faker->email)
                ->setAdressePostale($faker->postcode)
                ->setNumTel($faker->phoneNumber)
                ->setPhoto('https://picsum.photos/360/360?image=' . ($i + 300));

            $adherents[] = $adherent;
            $manager->persist($adherent);
        }
        $manager->flush();

        // 5. Création des emprunts
        for ($i = 0; $i < 40; $i++) {
            $dateEmprunt = DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-6 months', 'now'));
            $dateRetour = DateTimeImmutable::createFromMutable($faker->dateTimeBetween($dateEmprunt, '+2 weeks'));

            $emprunt = (new Emprunt())
                ->setDateEmprunt($dateEmprunt)
                ->setDateRetour($dateRetour);

            // Ajout des adhérents aux emprunts
            shuffle($adherents);
            $randomAdherents = array_slice($adherents, 0, mt_rand(1, 2));
            foreach ($randomAdherents as $adherent) {
                $emprunt->setAdherent($adherent);
            }

            // Ajout d'un livre à l'emprunt
            $livre = $livres[array_rand($livres)];
            $emprunt->setLivre($livre);

            $manager->persist($emprunt);
        }
        $manager->flush();

        // 6. Création des réservations
        for ($i = 0; $i < 15; $i++) {
            $dateResa = DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 month', 'now'));

            $reservation = (new Reservations())
                ->setDateResa($dateResa);
                // ->setStatut($faker->randomElement(['En attente', 'Confirmée', 'Annulée']));

            // Ajout des adhérents aux réservations
            shuffle($adherents);
            $randomAdherents = array_slice($adherents, 0, mt_rand(1, 2));
            foreach ($randomAdherents as $adherent) {
                $reservation->setAdherent($adherent);
            }

            // Ajout d'un livre à la réservation
            $livre = $livres[array_rand($livres)];
            $reservation->setLivre($livre);

            $manager->persist($reservation);
        }
        $manager->flush();
    }

}
