<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController
{

    #[Route("/pokemon")]
    public function getPokemon()
    {
        $pokemon = [
            "nombre" => "Bellsprout",
            "descripcion" => "Si detecta algún movimiento a su alrededor, sea cuando sea, reacciona enseguida extendiendo sus finas lianas en esa dirección",
            "imagen" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/069.png",
            "codigo" => "N.º 0069",
        ];
        return $this->render("pokemons/pokemon.html.twig", ["pokemon" => $pokemon]);
    }
    #[Route("/pokemons")]
    public function getPokemons()
    {
        $pokemons = [
            [
                "nombre" => "Bellsprout",
                "descripcion" => "Si detecta algún movimiento a su alrededor, sea cuando sea, reacciona enseguida extendiendo sus finas lianas en esa dirección",
                "imagen" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/069.png",
                "codigo" => "N.º 0069"
            ],
            [
                "nombre" => "Pikachu",
                "descripcion" => "Pika Pikachuuuuuuu",
                "imagen" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/066.png",
                "codigo" => "N.º 0066"
            ],
            [
                "nombre" => "BolaPincho",
                "descripcion" => "Si detecta algún movimiento a su alrededor, sea cuando sea, reacciona enseguida extendiendo sus finas lianas en esa dirección",
                "imagen" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/077.png",
                "codigo" => "N.º 0077"
            ],
        ];
        return $this->render("pokemons/pokemons.html.twig", ["pokemons" => $pokemons]);
    }
};
