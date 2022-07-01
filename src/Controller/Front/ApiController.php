<?php

namespace App\Controller\Front;

use App\Entity\User;
use App\Repository\DestinationsRepository;
use App\Repository\LandscapesRepository;
use App\Repository\SeasonsRepository;
use App\Repository\TransportsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Models\JsonError;
use Exception;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use App\EvenListener\AuthenticationSuccessListener;


class ApiController extends AbstractController
{
   
    /**
     * @Route("/api/transports", name="api_list_transports", methods={"GET"})
     */
    public function listTransports(TransportsRepository $transportsRepository): Response
    {
      
        return $this->json(
            $transportsRepository->findAll(),
            // HTTP Status code
            200,
            // HTTP headers, here none
            [],
            // Group of properties to serialize
            ['groups'=> ['list_transport']]
        );
    }

    /**
     * @Route("/api/landscapes", name="api_list_landscapes", methods={"GET"})
     */
    public function listLandscapes(LandscapesRepository $landscapesRepository): Response
    {

        // We send a a JsonResponse
        return $this->json(
            $landscapesRepository->findAll(),
            // HTTP Status code
            200,
            // HTTP headers, here none
            [],
            // Group of properties to serialize
            ['groups'=> ['list_landscape']]
        );

    }

    /**
     * @Route("/api/destinations/list", name="api_list_destinations", methods={"GET"})
     */
    public function listDestination(DestinationsRepository $destinationsRepository): Response
    {

        // We send a a JsonResponse
        return $this->json(
            $destinationsRepository->findAll(),
            // HTTP Status code
            200,
            // HTTP headers, here none
            [],
            // Group of properties to serialize
            ['groups'=> ['list_destination']]
        );

    }

     /**
     * @Route("/api/destinations/{id}", name="api_destinations", methods={"GET"})
     */
    public function showDestination(DestinationsRepository $destinationsRepository, $id): Response
    {

        // We send a a JsonResponse
        return $this->json(
            $destinationsRepository->find($id),
            // HTTP Status code
            200,
            // HTTP headers, here none
            [],
            // Group of properties to serialize
            ['groups'=> ['show_destination']]
        );

    }

    /**
    * @Route("/api/seasons", name="api_seasons", methods={"GET"})
    */
    public function listSeasons(SeasonsRepository $seasonsRepository): Response
    {

        // We send a a JsonResponse
        return $this->json(
            $seasonsRepository->findAll(),
            // HTTP Status code
            200,
            // HTTP headers, here none
            [],
            // Group of properties to serialize
            ['groups'=> ['list_season']]
        );

    }
    
    /**
    * @Route("/api/destinations/form", name="api_destinations_form", methods={"POST"})
    */
    public function listDestinationsForm(Request $request, DestinationsRepository $destinationsRepository): Response
    {
       $jsonRecu = $request->getContent();
       // dd($jsonRecu);

       $data = json_decode($jsonRecu, true);
       // dd($data);

        // Tableau des id types de paysages envoyés par le form
        $landscapesArray=[];
        if (array_key_exists('selectedLandscapes', $data)) {
            $arraySelectedLandscapes = $data['selectedLandscapes'];
            
            foreach($arraySelectedLandscapes as $value) {
            $landscapesArray[] = $value['id'];
            }
        } /* else{
            return new JsonResponse("Si tu veux vraiment partir, sélectionne au moins un paysage!", Response::HTTP_UNPROCESSABLE_ENTITY);
        } */  
        //dd($landscapesArray);

       // Tableau des id transports envoyés par le form
       $transportsArray=[];
       if (array_key_exists('selectedTransports', $data)) {
            $arraySelectedTransports = $data['selectedTransports'];
            
            foreach($arraySelectedTransports as $value) {
                $transportsArray[] = $value['id'];
            }
       } /* else{
        return new JsonResponse("Si tu veux vraiment partir, sélectionne au moins un transport!", Response::HTTP_UNPROCESSABLE_ENTITY);
       } */
       //dd($transportsArray);
       
       // Tableau des id types de saisons envoyés par le form
       $seasonsArray=[];
       if (array_key_exists('selectedSeasons', $data)) {
           $arraySelectedSeasons = $data['selectedSeasons'];
        
           foreach ($arraySelectedSeasons as $value) {
               $seasonsArray[] = $value['id'];
           }
       } /* else{
           return new JsonResponse("Si tu veux vraiment partir, sélectionne au moins une saison!", Response::HTTP_UNPROCESSABLE_ENTITY);
       } */
       //dd($landscapesArray);

        // Traitement de budget
        $budget = $data['budget'];
        // dd($budget);

        return $this->json(
            $destinationsRepository->findAllFiltered($transportsArray, $landscapesArray, $seasonsArray, $budget),
            200,
            [],
            ['groups' => 'list_destinations']
        );
    }

    /**
    * @Route("/api/user/form", name="api_user_form", methods={"POST"})
    */
    public function createUser(EntityManagerInterface $entityManager, Request $request, SerializerInterface $serializerInterface,ValidatorInterface $validator, UserPasswordHasherInterface $encoder): Response
    {
         $data = $request->getContent();
         try {
            $newUser = $serializerInterface->deserialize($data, User::class, 'json');
            $hashedPassword = $encoder->hashPassword($newUser, $newUser->getPassword());
            $newUser->setPassword($hashedPassword);
         } catch (Exception $e) {
             return new JsonResponse("Un ou plusieurs champ(s) manquant!", Response::HTTP_UNPROCESSABLE_ENTITY);
         }
         
        $errors = $validator->validate($newUser);
        if (count($errors) > 0) {
            //dd($errors);
            $myJsonError = new JsonError(Response::HTTP_UNPROCESSABLE_ENTITY, "Des erreurs de validation ont été trouvées");
            $myJsonError->setValidationErrors($errors);
    
            return $this->json($myJsonError, $myJsonError->getError());
        }

         $entityManager->persist($newUser);
         $entityManager->flush();

         return $this->json(
             $newUser,
             Response::HTTP_CREATED,
             [], 
             ['groups' => ['show_user']]
         );

    }

    /**
     *@Route("/api/user/login", name="api_user_login", methods={"POST"})
     */
    public function loginUser(Request $request, SerializerInterface $serializerInterface, UserRepository $userRepository)
    {
        $data = $request->getContent();
        // dd($request);
        //$token = $request->headers->get('authorization');
        //dd($token);
        $userPost = $serializerInterface->deserialize($data, User::class, 'json');
        // dd($userPost);

       
        $user = $userRepository->findByEmail( $userPost->getEmail());
        // dd($userPost->getPassword());

        //$password = $userRepository->findByPassword( $userPost->getPassword());
        // dd($password);
        //if ($user !== NULL && $password !== NULL){ 
         if ((count($user) > 0) && (password_verify($userPost->getPassword(), $user[0]->getPassword()))){

            //$jsonTest = array('username' => $user[0]->getFirstName(), 'token' => $token);
            
            return $this->json(
                $user,
                //$jsonTest,
                200,
                [],
                ['groups' => ['show_username']]
            );
        }
        
        return new JsonResponse("email et/ou mot de passe incorrect", 401);

    }

    /**
    * @Route("/api/user/favoris", name="api_user_favoris", methods={"POST"})
    */
    public function favorite(Request $request, DestinationsRepository $destinationsRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        
        $jsonRecu = $request->getContent();
        $data = json_decode($jsonRecu, true);
        $id = $data['destination'];

        // dd($id);
        $destination = $destinationsRepository->findOneById($id);
        // dd($destination);
        $user->addDestination($destination);
        
        $entityManager->persist($user);
        $entityManager->flush();

        // We send a a JsonResponse
        return $this->json(
            $user,
            // HTTP Status code
            200,
            // HTTP headers, here none
            [],
            // Group of properties to serialize
            ['groups'=> ['show_favorite']]
        );

    }

    /**
    * @Route("/api/remove/favoris", name="api_remove_favoris", methods={"POST"})
    */
    public function removeFavorite(Request $request, DestinationsRepository $destinationsRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        
        $jsonRecu = $request->getContent();
        $data = json_decode($jsonRecu, true);
        $id = $data['destination'];

        // dd($id);
        $destination = $destinationsRepository->findOneById($id);
        // dd($destination);
        $user->removeDestination($destination);
        
        $entityManager->persist($user);
        $entityManager->flush();

        // We send a a JsonResponse
        return $this->json(
            $user,
            // HTTP Status code
            200,
            // HTTP headers, here none
            [],
            // Group of properties to serialize
            ['groups'=> ['show_favorite']]
        );

    }

    /**
    * @Route("/api/user/favoris/list", name="api_userfavoris_list", methods={"GET"})
    */
    public function favoriteList()
    {
        $user = $this->getUser();

        if($user){
        
            return $this->json(
                $user,
                200,
                [],
                // Group of properties to serialize
                ['groups'=> ['list_favorite']]
            );
        } else {
            return new JsonResponse("Pas de liste des favoris!", 404);
        }

    }

    /**
     * @Route("/api/user/profile", name="api_user_profile", methods={"GET"})
     */
    public function profile()
    {
        $user = $this->getUser();

        if($user){
        
            return $this->json(
                $user,
                200,
                [],
                // Group of properties to serialize
                ['groups'=> ['show_user']]
            );
        } else {
            return new JsonResponse("marche pas!", 404);
        }
       
    }

     /**
     * @Route("/api/user/remove/profile", name="api_user_remove_profile", methods={"GET"})
     */
    public function removeProfile(EntityManagerInterface $entityManager)
    {
        $user = $this->getUser();

        if($user){
            $entityManager->remove($user);
        
            //$entityManager->persist($user);
            $entityManager->flush();

            return $this->json(
                $user,
                200,
                [],
                // Group of properties to serialize
                ['groups'=> ['show_user']]
            );
        } else {
            return new JsonResponse("suppression profil marche pas!", 404);
        }
       
    }


}
