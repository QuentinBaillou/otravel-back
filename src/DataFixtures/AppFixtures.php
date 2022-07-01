<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Destinations;
use App\Entity\Landscapes;
use App\Entity\Nights;
use App\Entity\Providers;
use App\Entity\Seasons;
use App\Entity\Tags;
use App\Entity\Transports;
use App\Entity\Users;
use DateTime;
use Doctrine\DBAL\Connection;

class AppFixtures extends Fixture
{

    private $connexion;

    public function __construct(Connection $connexion)
    {
        $this->connexion = $connexion;
    }

    // we create un truncate function to auto increment at 1
    public function truncate()
    {
        $this->connexion->executeQuery('SET foreign_key_checks = 0');

        $this->connexion->executeQuery('TRUNCATE TABLE destinations');
        $this->connexion->executeQuery('TRUNCATE TABLE tags');
        $this->connexion->executeQuery('TRUNCATE TABLE transports');
        $this->connexion->executeQuery('TRUNCATE TABLE landscapes');
        $this->connexion->executeQuery('TRUNCATE TABLE seasons');
    }

    public function load(ObjectManager $manager): void
    {
        // we call the truncate function
        $this->truncate();

        /**** Tags *****/
        $allTagEnity = [];
        $allTags = [
            'transports en commun',
            'voiture',
            'camping car',
            'bateau',
            'train',
            'fusée spatiale',
            'printemps',
            'été',
            'automne',
            'hiver',
            'littoral',
            'montagneux',
            'plaine',
            'urbain',
            'désertique',
            'tropical',
            'enneigé',
            'volcanique'
        ];
        foreach ($allTags as $tagName)
        {
            $tag = new Tags();
            $tag->setName($tagName);
            $allTagEnity[] = $tag;
            $manager->persist($tag);
        }

        /**** Seasons *****/
        $allSeasonEntity = [];
        $allSeasons = [
            'printemps',
            'été',
            'automne',
            'hiver'
        ];
        foreach ($allSeasons as $seasonName)
        {
            $season = new Seasons();
            $season->setSeason($seasonName);
            $allSeasonEntity[] = $season;
            $manager->persist($season);
        }


        /**** Landscapes *****/
        $allLandscapesEntity =[];
        $allLandscapes = [
            'littoral',
            'montagneux',
            'plaine',
            'urbain',
            'désertique',
            'tropical',
            'enneigé',
            'volcanique'
        ];
         foreach ($allLandscapes as $landsapeName)
         {
             $newLandscape = new Landscapes();
             $newLandscape->setName($landsapeName);
             $allLandscapesEntity[] = $newLandscape;
             $manager->persist($newLandscape);
         }
        
        /**** Ways *****/
        $allWayEntity = [];
        $allWays = [
            'transports en commun',
            'voiture',
            'camping car',
            'bateau',
            'train',
            'fusée spatiale'
        ];
        foreach ($allWays as $wayName)
        {
            $way = new Transports();
            $way->setWay($wayName);
            $allWayEntity[] = $way;
            $manager->persist($way);
        }

        /**** Nigths *****/
        $allNights = [];
        for ($q = 1; $q < 22; $q++)
        {
            $newNight= new Nights();
            $newNight->setNightNb($q);
            $allNights[] = $newNight;
            $manager->persist($newNight);
        }

        /**** Destinations *****/
        $allDestinations = [];
        $states = [
            'Etats-Unis',
            'Ouest Canadien',
            'Canada',
            'Italie',
            'Japon',
            'Norvège',
            'Pays nordique',
            'Australie',
            'Hawaï',
            'Antartique',
            'Amérique du Sud',
            'République Tchéque',
            'France',
            'Émirats arabes unis',
            'Brésil',
            'Afrique du Sud',
            'Road Trip Alpes',
            'Etats-Unis',
            'Mars'
        ];
         
        $surnames =[
            'New York',
            'Vancouver',
            'Région de Québec',
            'Rome',
            'Tokyo',
            'fjords',
            'Circuit Norvège, Suède',
            'Côte Est',
            'Circuit des volcans + surf',
            'Croisiére polaire',
            'Bolivie, Paraguay, Uruguay, Argentine',
            'Prague',
            'Corse',
            'Dubaï',
            'Rio de janeiro',
            'Cape Town',
            'Suisse, Italie, Croatie',
            'Orlando',
            'Featuring Space-X'
        ];

        $pictures =[
            'https://cdn.pixabay.com/photo/2019/07/21/07/12/new-york-4352072_960_720.jpg',
            'https://cdn.pixabay.com/photo/2019/10/28/23/22/vancouver-4585887_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/04/24/17/25/frontenac-2257154_960_720.jpg',
            'https://cdn.pixabay.com/photo/2019/10/06/08/57/architecture-4529605_960_720.jpg',
            'https://cdn.pixabay.com/photo/2020/07/14/16/02/manga-5404746_960_720.jpg',
            'https://cdn.pixabay.com/photo/2020/02/07/16/20/lofoten-4827611_960_720.jpg',
            'https://cdn.pixabay.com/photo/2022/01/02/19/43/port-6910972_960_720.jpg',
            'https://cdn.pixabay.com/photo/2014/05/26/09/58/sydney-opera-house-354375_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/02/05/00/05/hawaii-2038861_960_720.jpg',
            'https://cdn.pixabay.com/photo/2016/03/31/21/17/landscape-1296307_960_720.jpg',
            'https://cdn.pixabay.com/photo/2020/05/15/14/21/andes-5173790_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/12/10/17/40/prague-3010407_960_720.jpg',
            'https://cdn.pixabay.com/photo/2018/08/20/22/16/coast-3620146_960_720.jpg',
            'https://cdn.pixabay.com/photo/2014/02/02/07/55/dubai-256585_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/01/08/19/30/rio-de-janeiro-1963744_960_720.jpg',
            'https://cdn.pixabay.com/photo/2016/02/24/03/06/helicopter-1218974_960_720.jpg',
            'https://cdn.pixabay.com/photo/2014/11/01/18/46/dubrovnik-512798_960_720.jpg',
            'https://cdn.pixabay.com/photo/2018/12/22/15/40/castle-3889852_960_720.jpg',
            'https://cdn.pixabay.com/photo/2011/12/13/14/30/mars-11012_960_720.jpg'
        ];
        $pictures2 =[
            'https://cdn.pixabay.com/photo/2020/06/08/20/58/nyc-5276112_960_720.jpg',
            'https://cdn.pixabay.com/photo/2012/06/21/02/01/totem-pole-50437_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/03/10/06/46/city-2131934_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/12/15/19/13/rome-3021586_960_720.jpg',
            'https://cdn.pixabay.com/photo/2013/11/25/09/52/japan-217882_960_720.jpg',
            'https://cdn.pixabay.com/photo/2019/02/22/12/26/water-4013446_960_720.jpg',
            'https://cdn.pixabay.com/photo/2018/11/30/13/33/northern-lights-3847784_960_720.jpg',
            'https://cdn.pixabay.com/photo/2016/07/02/04/45/heart-1492445_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/04/20/04/46/waikiki-2244523_960_720.jpg',
            'https://cdn.pixabay.com/photo/2021/03/11/08/18/penguins-6086503_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/07/26/21/30/bolivia-2543157_960_720.jpg',
            'https://cdn.pixabay.com/photo/2015/09/04/19/02/building-922531_960_720.jpg',
            'https://cdn.pixabay.com/photo/2018/10/05/22/47/corsican-3727038_960_720.jpg',
            'https://cdn.pixabay.com/photo/2021/09/26/11/54/architecture-6657475_960_720.jpg',
            'https://cdn.pixabay.com/photo/2020/01/31/21/25/brazil-4809011_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/05/12/00/22/muizenberg-2305734_960_720.jpg',
            'https://cdn.pixabay.com/photo/2020/05/10/19/27/passage-5155252_960_720.jpg',
            'https://cdn.pixabay.com/photo/2020/03/12/00/12/florida-4923565_960_720.jpg',
            'https://cdn.pixabay.com/photo/2012/11/28/09/08/moon-vehicle-67521_960_720.jpg'
        ];
        $pictures3 =[
            'https://cdn.pixabay.com/photo/2016/12/16/23/49/new-york-1912582_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/09/08/09/25/kayaks-2728181_960_720.jpg',
            'https://cdn.pixabay.com/photo/2015/12/01/21/57/sunset-1072942_960_720.jpg',
            'https://cdn.pixabay.com/photo/2015/05/09/22/44/the-altar-of-the-fatherland-760337_960_720.jpg',
            'https://cdn.pixabay.com/photo/2020/01/31/07/26/chef-4807317_960_720.jpg',
            'https://cdn.pixabay.com/photo/2019/02/07/16/15/fjord-3981546_960_720.jpg',
            'https://cdn.pixabay.com/photo/2019/09/05/07/23/village-4453338_960_720.jpg',
            'https://cdn.pixabay.com/photo/2013/12/10/00/23/koala-226279_960_720.jpg',
            'https://cdn.pixabay.com/photo/2016/06/02/05/40/hawaii-1430283_960_720.jpg',
            'https://cdn.pixabay.com/photo/2014/07/30/02/00/iceberg-404966_960_720.jpg',
            'https://cdn.pixabay.com/photo/2013/09/21/21/31/swamp-184745_960_720.jpg',
            'https://cdn.pixabay.com/photo/2016/07/09/21/46/prague-1506918_960_720.jpg',
            'https://cdn.pixabay.com/photo/2018/02/28/18/51/waters-3188752_960_720.jpg',
            'https://cdn.pixabay.com/photo/2019/03/09/21/30/downtown-4045035_960_720.jpg',
            'https://cdn.pixabay.com/photo/2020/01/29/18/48/brazil-4803291_960_720.jpg',
            'https://cdn.pixabay.com/photo/2016/02/24/05/16/art-1219118_960_720.jpg',
            'https://cdn.pixabay.com/photo/2019/03/31/14/31/italy-4093227_960_720.jpg',
            'https://cdn.pixabay.com/photo/2014/01/10/13/06/universal-studios-241596_960_720.jpg',
            'https://cdn.pixabay.com/photo/2012/11/28/09/08/mars-67522_960_720.jpg'
        ];
        $pictures4 =[
            'https://cdn.pixabay.com/photo/2018/05/24/02/07/new-york-3425660_960_720.jpg',
            'https://cdn.pixabay.com/photo/2019/07/14/21/19/canada-4338117_960_720.jpg',
            'https://cdn.pixabay.com/photo/2015/12/14/10/21/canada-1092352_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/01/03/02/31/italy-1948362_960_720.jpg',
            'https://cdn.pixabay.com/photo/2019/07/23/22/19/tokyo-4358758_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/09/02/19/26/norway-2708286_960_720.jpg',
            'https://cdn.pixabay.com/photo/2014/06/26/15/08/royal-palace-377913_960_720.jpg',
            'https://cdn.pixabay.com/photo/2016/11/04/21/34/beach-1799006_960_720.jpg',
            'https://cdn.pixabay.com/photo/2016/06/07/00/58/hawaii-1440739_960_720.jpg',
            'https://cdn.pixabay.com/photo/2019/03/29/18/39/iceberg-4089866_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/04/06/16/58/fishermen-2208810_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/05/30/01/42/prague-2355458_960_720.jpg',
            'https://cdn.pixabay.com/photo/2018/09/29/23/44/corsican-3712554_960_720.jpg',
            'https://cdn.pixabay.com/photo/2019/02/21/07/55/uae-4010835_960_720.jpg',
            'https://cdn.pixabay.com/photo/2015/12/09/12/26/rio-carnival-1084654_960_720.jpg',
            'https://cdn.pixabay.com/photo/2015/10/20/09/59/south-africa-997547_960_720.jpg',
            'https://cdn.pixabay.com/photo/2021/03/30/02/40/croatie-6135694_960_720.jpg',
            'https://cdn.pixabay.com/photo/2018/08/01/13/16/orlando-3577181_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/08/28/16/22/space-shuttle-2690279_960_720.jpg'
        ];
        $pictures5 =[
            'https://cdn.pixabay.com/photo/2015/03/11/12/31/buildings-668616_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/09/08/09/28/ocean-2728188_960_720.jpg',
            'https://cdn.pixabay.com/photo/2021/11/25/21/28/frozen-lake-6824631_960_720.jpg',
            'https://cdn.pixabay.com/photo/2018/05/13/23/49/trevi-3398398_960_720.jpg',
            'https://cdn.pixabay.com/photo/2019/12/03/05/57/sensoji-4669289_960_720.jpg',
            'https://cdn.pixabay.com/photo/2019/02/12/20/43/fjord-3993190_960_720.jpg',
            'https://cdn.pixabay.com/photo/2015/07/20/18/36/sweden-853150_960_720.jpg',
            'https://cdn.pixabay.com/photo/2015/01/01/22/54/sylvester-586224_960_720.jpg',
            'https://cdn.pixabay.com/photo/2015/11/09/02/17/hawaii-1034551_960_720.jpg',
            'https://cdn.pixabay.com/photo/2019/11/13/00/04/whale-4622268_960_720.jpg',
            'https://cdn.pixabay.com/photo/2012/07/06/17/11/caminito-51625_960_720.jpg',
            'https://cdn.pixabay.com/photo/2016/11/21/14/02/prague-1845560_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/07/29/10/31/windmill-gard-2551072_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/08/10/16/11/burj-al-arab-2624317_960_720.jpg',
            'https://cdn.pixabay.com/photo/2019/08/25/20/42/sunset-4430276_960_720.jpg',
            'https://cdn.pixabay.com/photo/2019/07/30/06/27/africa-4372120_960_720.jpg',
            'https://cdn.pixabay.com/photo/2016/09/19/22/46/lake-1681485_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/07/13/19/00/macaw-2501439_960_720.jpg',
            'https://cdn.pixabay.com/photo/2019/02/18/12/16/astronaut-4004417_960_720.jpg'
        ];


        for ($r = 0; $r < 19; $r++)
        {
            $newDestination = new Destinations();
         
            $newDestination->setState($states[$r]);
           
           
            $newDestination->setSurname($surnames[$r]);

            // load random picure from internet
            $newDestination->setPicture($pictures[$r]);
            $newDestination->setPicture2($pictures2[$r]);
            $newDestination->setPicture3($pictures3[$r]);
            $newDestination->setPicture4($pictures4[$r]);
            $newDestination->setPicture5($pictures5[$r]);

            $newDestination->setSummary('Aenean blandit, tortor ac pellentesque luctus, arcu enim aliquam augue, ac malesuada est magna a elit. Integer venenatis lacus id elit lacinia tincidunt. Cras purus leo, faucibus dictum dictum id, convallis id neque. Pellentesque consequat lorem a lacus egestas tempor. Nunc rutrum, ipsum interdum ullamcorper porta, metus velit faucibus lorem, in ullamcorper ligula odio a ipsum. In scelerisque enim eget sem vehicula, eu aliquet neque accumsan. Curabitur sit amet eros ut dui congue tristique et nec erat. Pellentesque est lorem, eleifend ac feugiat sit amet, scelerisque ut odio. Cras vel lectus ante. Sed est elit, fermentum sit amet neque a, tincidunt gravida urna. Proin hendrerit ex at lorem cursus tincidunt. Nunc ultricies rhoncus iaculis.
            Aenean blandit, tortor ac pellentesque luctus, arcu enim aliquam augue, ac malesuada est magna a elit. Integer venenatis lacus id elit lacinia tincidunt. Cras purus leo, faucibus dictum dictum id, convallis id neque. Pellentesque consequat lorem a lacus egestas tempor. Nunc rutrum, ipsum interdum ullamcorper porta, metus velit faucibus lorem, in ullamcorper ligula odio a ipsum. In scelerisque enim eget sem vehicula, eu aliquet neque accumsan. Curabitur sit amet eros ut dui congue tristique et nec erat. Pellentesque est lorem, eleifend ac feugiat sit amet, scelerisque ut odio. Cras vel lectus ante. Sed est elit, fermentum sit amet neque a, tincidunt gravida urna. Proin hendrerit ex at lorem cursus tincidunt. Nunc ultricies rhoncus iaculis.
            Aenean blandit, tortor ac pellentesque luctus, arcu enim aliquam augue, ac malesuada est magna a elit. Integer venenatis lacus id elit lacinia tincidunt. Cras purus leo, faucibus dictum dictum id, convallis id neque. Pellentesque consequat lorem a lacus egestas tempor. Nunc rutrum, ipsum interdum ullamcorper porta, metus velit faucibus lorem, in ullamcorper ligula odio a ipsum. In scelerisque enim eget sem vehicula, eu aliquet neque accumsan. Curabitur sit amet eros ut dui congue tristique et nec erat. Pellentesque est lorem, eleifend ac feugiat sit amet, scelerisque ut odio. Cras vel lectus ante. Sed est elit, fermentum sit amet neque a, tincidunt gravida urna. Proin hendrerit ex at lorem cursus tincidunt. Nunc ultricies rhoncus iaculis.
            Aenean blandit, tortor ac pellentesque luctus, arcu enim aliquam augue, ac malesuada est magna a elit. Integer venenatis lacus id elit lacinia tincidunt. Cras purus leo, faucibus dictum dictum id, convallis id neque. Pellentesque consequat lorem a lacus egestas tempor. Nunc rutrum, ipsum interdum ullamcorper porta, metus velit faucibus lorem, in ullamcorper ligula odio a ipsum. In scelerisque enim eget sem vehicula, eu aliquet neque accumsan. Curabitur sit amet eros ut dui congue tristique et nec erat. Pellentesque est lorem, eleifend ac feugiat sit amet, scelerisque ut odio. Cras vel lectus ante. Sed est elit, fermentum sit amet neque a, tincidunt gravida urna. Proin hendrerit ex at lorem cursus tincidunt. Nunc ultricies rhoncus iaculis.');

            $newDestination->setExtract('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus maximus ipsum non volutpat. Quisque a velit quis metus consequat pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus maximus ipsum non volutpat. Quisque a velit quis metus consequat pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus maximus ipsum non volutpat. Quisque a velit quis metus consequat pulvinar.');

            $newDestination->setPros('Lorem Ipsum is simply dummy text of the printing and typesetting industry
            Lorem Ipsum is simply dummy text of the printing and typesetting industry
            Lorem Ipsum is simply dummy text of the printing and typesetting industry');

            $newDestination->setCreatedAt(new DateTime("now"));
            $newDestination->setUpdatedAt(new DateTime("now"));

            $newDestination->setPricePerNight(mt_rand(200, 3000));

            /** Add transports for each destination */
            for ($g = 1; $g <= mt_rand(1, 3); $g++) {
                // Duplicates data are manage by method addGenre()
                $randomWay = $allWayEntity[mt_rand(0, count($allWayEntity) - 1)];
                $newDestination->addTransport($randomWay);
            }
            /** Add seasons for each destination */
            for ($j = 1; $j <= mt_rand(1, 3); $j++) {
                
                $randomSeason = $allSeasonEntity[mt_rand(0, count($allSeasonEntity) - 1)];
                $newDestination->addSeason($randomSeason);
            }
            /** Add landscapes for each destination */
            for ($k = 1; $k <= mt_rand(1, 3); $k++) {
                
                $randomLandscape = $allLandscapesEntity[mt_rand(0, count($allLandscapesEntity) - 1)];
                $newDestination->addLandscape($randomLandscape);
            }

            /** Add tags for each destination */
            for ($l = 1; $l <= mt_rand(1, 3); $l++) {
                
                $randomTag = $allTagEnity[mt_rand(0, count($allTagEnity) - 1)];
                $newDestination->addTag($randomTag);
            }

            $manager->persist($newDestination);
        }

        $manager->flush();
    }
}
