<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController
{

    #[Route("/pokemon/{id}")]
    public function getPokemon(EntityManagerInterface $doctrine, $id)
    {
        $repositorio = $doctrine->getRepository(Pokemon::class);
        $pokemon = $repositorio->find($id);
        return $this->render("pokemons/pokemon.html.twig", ["pokemon" => $pokemon]);
    }
    #[Route("/pokemons")]
    public function getPokemons(EntityManagerInterface $doctrine)
    {
        $repositorio = $doctrine->getRepository(Pokemon::class);
        $pokemons = $repositorio->findAll();

        return $this->render("pokemons/pokemons.html.twig", ["pokemons" => $pokemons]);
    }

    #[Route("/new/pokemons")]
    public function insertPokemon(EntityManagerInterface $doctrine)
        {
            $pokemon =  new Pokemon();
            $pokemon-> setNombre("charmander");
            $pokemon-> setDescripcion("odia el agua");
            $pokemon-> setImagen("https://assets.pokemon.com/assets/cms2/img/pokedex/full/004.png");
            $pokemon-> setCodigo(4);

            $pokemon2 =  new Pokemon();
            $pokemon2-> setNombre("pickachu");
            $pokemon2-> setDescripcion("come rayos");
            $pokemon2-> setImagen("https://assets.pokemon.com/assets/cms2/img/pokedex/full/025.png");
            $pokemon2-> setCodigo(25);

            $pokemon3 =  new Pokemon();
            $pokemon3-> setNombre("ratata");
            $pokemon3-> setDescripcion("tiene mucho diente");
            $pokemon3-> setImagen("https://assets.pokemon.com/assets/cms2/img/pokedex/full/019.png");
            $pokemon3-> setCodigo(19);

            $doctrine -> persist($pokemon);
            $doctrine -> persist($pokemon2);
            $doctrine -> persist($pokemon3);

            $doctrine -> flush();

            return new Response("pokemons añadidos");
        }
};
