<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController
{

    #[Route("/pokemon")]
    public function getPokemon(){
            $pokemon =[
                "nombre" => "Bellsprout",
                "descripcion" => "Si detecta algún movimiento a su alrededor, sea cuando sea, reacciona enseguida extendiendo sus finas lianas en esa dirección",
                "imagen" => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/069.png",
                "codigo" => "N.º 0069",
            ];   
            return $this -> render("pokemons/pokemon.html.twig", ["pokemon" => $pokemon]);

    }
};
