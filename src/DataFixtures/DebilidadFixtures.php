<?php

namespace App\DataFixtures;

use App\Entity\Debilidad;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DebilidadFixtures extends Fixture
{
    protected $client;
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=10; $i++){
            $response = $this->client->request(
                'GET',
                "https://pokeapi.co/api/v2/type/$i"
            );
            $typeData = $response->toArray();

            $debilidad = new Debilidad();
            $debilidad->setNombre($typeData['name']);

            $this->addReference(Debilidad::class .$i, $debilidad);

            $manager->persist($debilidad);
        }

        $manager->flush();
    }
}
