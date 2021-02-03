<?php


namespace App\DataFixtures;

use App\Entity\Place;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlaceFixtures extends Fixture
{
    public const PLACES = [
        'Acropole' => [
            'description' => 'L\'acropole se situe sur une colline de 156 m de hauteur dans la capitale grecque. Plusieurs monuments datant du ve siècle av. J.-C. se trouvent au sommet tels que le Parthénon, le temple d\'Athéna Niké et l\'Érechthéion. Ces derniers étaient destinés à certains dieux de la mythologie grecque',
            'picture' => 'https://cdn.futura-sciences.com/buildsv6/images/mediumoriginal/6/2/2/6222230c10_50163729_parthe-non-athe-nes.jpg',
        ],
        'Érechthéion' => [
            'description' => 'L’Érechthéion est un ancien temple grec d’ordre ionique situé sur l\'acropole d\'Athènes, au nord du Parthénon. C’est le dernier monument érigé sur l’Acropole avant la fin du ve siècle av. J.-C. et il est renommé pour son architecture à la fois élégante et inhabituelle.',
            'picture' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Erechtheum_Acropolis_Athens.jpg/1920px-Erechtheum_Acropolis_Athens.jpg',
        ],
        'Parthénon' => [
            'description' => 'Le Parthénon littéralement « la « salle » ou la « demeure » des vierges » , est un temple grec, situé sur l\'Acropole d\'Athènes, dédié à la déesse Athéna, que les Athéniens considéraient comme la patronne de leur cité.',
            'picture' => 'https://download.vikidia.org/vikidia/fr/images/thumb/0/0a/Parth%C3%A9non_-_2008.jpg/400px-Parth%C3%A9non_-_2008.jpg',
        ],
        'Sparte' => [
            'description' => 'Sparte est une ancienne ville grecque du Péloponnèse, perpétuée aujourd\'hui par la ville moderne du même nom de 18 185 habitants. Située sur l\'Eurotas, dans la plaine de Laconie, entre le Taygète et le Parnon, elle est l\'une des cités-États les plus puissantes de la Grèce antique, avec Athènes et Thèbes.',
            'picture' => 'http://decouvrirlagrece.com/wp-content/uploads/2019/12/archaia_sparti.jpg',
        ]

    ];

    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::PLACES as $title => $data) {
            $place = new Place();
            $place->setTitle($title);
            $place->setDescription($data['description']);
            $place->setPicture($data['picture']);
            $manager->persist($place);
            $this->addReference('place_'.($i +1), $place);
            $i ++;
        }
        $manager->flush();
    }

}