<?php

namespace App\Controller;

use App\Form\UsuarioType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

 class UsuarioController extends AbstractController
{
    #[Route("/insert/usuario", name: "insertUsuarios")]
    public function insertUsuarios(Request $request, EntityManagerInterface $doctrine, UserPasswordHasherInterface $hasher){

        $form = $this->createForm(UsuarioType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $usuario = $form->getData();
            $password = $usuario -> getPassword();
            $passwordEncrypted = $hasher -> hashPassword($usuario, $password);
            $usuario -> setPassword($passwordEncrypted);

            $doctrine->persist($usuario);
            $doctrine->flush();

            $this->addFlash("Exito", "usuario insertado correctamente");

            return $this->redirectToRoute("getPokemons");

        }

        return $this->render("pokemons/insertPokemon.html.twig", ["pokemonForm" => $form]);



    }
    #[Route("/insert/admin", name: "insertAdmin")]
    public function insertAdmin(Request $request, EntityManagerInterface $doctrine, UserPasswordHasherInterface $hasher){

        $form = $this->createForm(UsuarioType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $usuario = $form->getData();
            $password = $usuario -> getPassword();
            $passwordEncrypted = $hasher -> hashPassword($usuario, $password);
            $usuario -> setPassword($passwordEncrypted);
            $usuario -> setRoles(['ROLE_USER', 'ROLE_ADMIN']);

            $doctrine->persist($usuario);
            $doctrine->flush();

            $this->addFlash("Exito", "usuario insertado correctamente");

            return $this->redirectToRoute("getPokemons");

        }

        return $this->render("pokemons/insertPokemon.html.twig", ["pokemonForm" => $form]);



    }
}