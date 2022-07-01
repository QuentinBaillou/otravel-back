<?php

namespace App\Repository;

use App\Entity\Destinations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method Destinations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Destinations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Destinations[]    findAll()
 * @method Destinations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DestinationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Destinations::class);
    }

    /**
    * 
    * @return Destinations[] Returns an array of Destinations objects
    */
    public function findAllFiltered($transportsArray, $landscapesArray, $seasonsArray, $budget)
    {
        // On va chercher l'équivalent de PDO
        $connection = $this->getEntityManager()->getConnection();
        
        //dd($transportsArray);
        $conditionTransport = '';
           
        $countTransportsArray =  count($transportsArray);
        
        if ($countTransportsArray > 0) {
            $conditionTransport = '(';
            for ($i = 0 ; $i < $countTransportsArray; $i++) {
                $conditionTransport = $conditionTransport . $transportsArray[$i];
            
            if ($i === $countTransportsArray - 1) {
                $conditionTransport = $conditionTransport . ')';
                
            }
            else {
                $conditionTransport = $conditionTransport . ',';
                
            }
            
            }
            $joinTransport = ' inner join destinations_transports on destinations.id =  destinations_transports.destinations_id ';

            }

        //dd($landscapesArray);
        $conditionLandscape = '';
       
    
        $countLandscapesArray =  count($landscapesArray);
       //dd($landscapesArray);
        if ($countLandscapesArray > 0) {
            $conditionLandscape = '(';
            for ($i = 0 ; $i < $countLandscapesArray; $i++) {
                $conditionLandscape = $conditionLandscape . $landscapesArray[$i];
               
              if ($i === $countLandscapesArray - 1) {
                  $conditionLandscape = $conditionLandscape . ')';
                
              }
              else {
                  $conditionLandscape = $conditionLandscape . ',';
                
              }
              
            }
            $joinLandscape = ' inner join destinations_landscapes on destinations.id = destinations_landscapes.destinations_id ';

        }
       
        $conditionSeason = '';
       
    
        $countSeasonsArray =  count($seasonsArray);
       //dd($landscapesArray);
        if ($countSeasonsArray > 0) {
            $conditionSeason = '(';
            for ($i = 0 ; $i < $countSeasonsArray; $i++) {
                $conditionSeason = $conditionSeason . $seasonsArray[$i];
               
              if ($i === $countSeasonsArray - 1) {
                  $conditionSeason = $conditionSeason . ')';
                
              }
              else {
                  $conditionSeason = $conditionSeason . ',';
                
              }
              
            }
            $joinSeason = ' inner join destinations_seasons on destinations.id = destinations_seasons.destinations_id ';

        }



        // Définition requête
        $sql = 'SELECT DISTINCT destinations.* 
                FROM destinations ';

        // Join types de transports
        if (strlen($conditionTransport) > 0) {
            $sql = $sql . $joinTransport;
        }
        
        // Join types de paysages
        if (strlen($conditionLandscape) > 0) {
              $sql = $sql . $joinLandscape;
        }  

        // Join types de saisons
        if (strlen($conditionSeason) > 0) {
            $sql = $sql . $joinSeason;
      }  

        // Ajout conditions
        /*if (strlen($conditionTransport) > 0) {
            $sql = $sql .' WHERE  transports_id in ' . $conditionTransport;
        }
        if (strlen($conditionLandscape) > 0) {
            if (strlen($conditionTransport) > 0) {
                $sql = $sql .' and  landscapes_id in ' . $conditionLandscape;
            }
            else  
                $sql = ' WHERE  landscapes_id in ' . $conditionLandscape;{

            }   
        }*/
        if ((strlen($conditionTransport) > 0) && (strlen($conditionLandscape) > 0) && (strlen($conditionSeason) > 0))  {
            $sql = $sql .' WHERE  transports_id in ' . $conditionTransport .  ' and  landscapes_id in ' . $conditionLandscape . 
            ' and seasons_id in ' . $conditionSeason . ' and destinations.price_per_night <=' . $budget;
        } elseif (strlen($conditionTransport) > 0){
            $sql = $sql .' WHERE  transports_id in ' . $conditionTransport . ' and destinations.price_per_night <=' . $budget;
        } elseif (strlen($conditionLandscape) > 0){
            $sql = $sql .' WHERE  landscapes_id in ' . $conditionLandscape . ' and destinations.price_per_night <=' . $budget;
        } elseif (strlen($conditionSeason) > 0){
            $sql = $sql .' WHERE  seasons_id in ' . $conditionSeason . ' and destinations.price_per_night <=' . $budget;
        } 
          
        
        // Trié par prix par nuit croissant
        $sql = $sql . ' ORDER BY destinations.price_per_night ASC';
       // dd($sql);

        // exécution de la requete
        $results = $connection->executeQuery($sql);

        
       
        // returns an array of Destinations objects
       
        return $results->fetchAllAssociative();
    }

    // /**
    //  * @return Destinations[] Returns an array of Destinations objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Destinations
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
