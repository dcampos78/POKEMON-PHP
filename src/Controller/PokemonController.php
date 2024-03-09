<?php

namespace App\Controller;

use App\Entity\Debilidad;
use App\Entity\Pokemon;
use App\Form\PokemonType;
use App\Manager\PokemonManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController
{
    #[Route("/insert/pokemon", name: "insertPokemons")]
    public function insertPokemons(
        Request $request,
        EntityManagerInterface $doctrine,
        PokemonManager $manager
    ){

        $form = $this->createForm(PokemonType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $pokemon = $form->getData();

            $imagenPokemon = $form->get('ficheroImagen')->getData();
            if ($imagenPokemon) {
                $nomPokemonImagen = $manager->subirImagen(
                    $imagenPokemon,
                    $this->getParameter("kernel.project_dir")."/public/images"
                );

                $pokemon->setImagen("/images/$nomPokemonImagen");
            }

            $doctrine->persist($pokemon);
            $doctrine->flush();

            $this->addFlash("Exito", "pokemon insertado correctamente");

            return $this->redirectToRoute("getPokemons");
        }

        return $this->render("pokemons/insertPokemon.html.twig", ["pokemonForm" => $form]);
    }

    #[Route("/edit/pokemon/{id}", name: "editPokemons")]
    public function editPokemons(Request $request, EntityManagerInterface $doctrine, $id){

        $repositorio = $doctrine->getRepository(Pokemon::class);
        $pokemon = $repositorio->find($id);
        $form = $this->createForm(PokemonType::class, $pokemon);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $pokemon = $form->getData();

            $doctrine->persist($pokemon);
            $doctrine->flush();

            $this->addFlash("Exito", "pokemon insertado correctamente");

            return $this->redirectToRoute("getPokemons");

        }

        return $this->render("pokemons/insertPokemon.html.twig", ["pokemonForm" => $form]);
    }

    #[Route("/delete/pokemon/{id}", name: "deletePokemon")]
    public function deletePokemon($id, EntityManagerInterface $doctrine)
    {
        $repositorio = $doctrine->getRepository(Pokemon::class);
        $pokemon = $repositorio->find($id);

        $doctrine->remove($pokemon);
        $doctrine->flush();

        return $this->redirectToRoute("getPokemons");
    }


    #[Route("/pokemon/{id}", name: "getPokemon")]
    public function getPokemon(EntityManagerInterface $doctrine, $id)
    {
        $repositorio = $doctrine->getRepository(Pokemon::class);
        $pokemon = $repositorio->find($id);
        return $this->render("pokemons/pokemon.html.twig", ["pokemon" => $pokemon]);
    }
    #[Route("/pokemons", name: "getPokemons")]
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

            $debilidad = new Debilidad();
            $debilidad->setNombre("Fuego");

            $debilidad2 = new Debilidad();
            $debilidad2->setNombre("Agua");

            $debilidad3 = new Debilidad();
            $debilidad3->setNombre("Hipnosis");

            $pokemon->addDebilidade($debilidad2);

            $pokemon2->addDebilidade($debilidad);
            $pokemon2->addDebilidade($debilidad3);


            $doctrine -> persist($pokemon);
            $doctrine -> persist($pokemon2);
            $doctrine -> persist($pokemon3);
            $doctrine -> persist($debilidad);
            $doctrine -> persist($debilidad2);
            $doctrine -> persist($debilidad3);

            $doctrine -> flush();

            return new Response("pokemons añadidos");
        }
};
