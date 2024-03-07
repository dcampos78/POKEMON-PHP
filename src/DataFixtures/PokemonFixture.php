<?php

namespace App\DataFixtures;

use App\Entity\Pokemon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PokemonFixture extends Fixture
{
    protected $client;
    public function __construct(HttpClientInterface $client)
    {
        $this -> client = $client;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i=0; $i <20 ; $i++) {
            $idPokemon = $faker->randomNumber(3, true); 

            $response = $this->client->request(
                'GET',
                "https://pokeapi.co/api/v2/pokemon/$idPokemon"
            );
            $pokemonData = $response->toArray();
            $pokemon = new Pokemon();
            $pokemon-> setNombre($pokemonData["name"]);
            $pokemon-> setDescripcion($faker->text());
            $pokemon-> setImagen("https://assets.pokemon.com/assets/cms2/img/pokedex/full/$idPokemon.png");
            $pokemon-> setCodigo($idPokemon);

            $manager -> persist($pokemon);
        }

        $manager->flush();
        // $product = new Product();
        // $manager->persist($product);
    }
}
