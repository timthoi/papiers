<?php
define('_JEXEC', 1);

define('JPATH_BASE', dirname(__FILE__));

define('DS', DIRECTORY_SEPARATOR);

require_once(JPATH_BASE . DS . 'includes' . DS . 'defines.php');
require_once(JPATH_BASE . DS . 'includes' . DS . 'framework.php');

require('libraries/src/Factory.php');
require('libraries/src/Uri/Uri.php');
require('libraries/src/Router/Route.php');
require('libraries/src/Language/Language.php');

$option             = array(); //prevent problems
$option['driver']   = 'mysql';            // Database driver name
$option['host']     = 'localhost';    // Database host name
$option['user']     = 'c0papier';       // User for database authentication
$option['password'] = 'Ducati99';   // Password for database authentication
$option['database'] = 'c0papier';      // Database name
$option['prefix']   = '';             // Database prefix (may be empty)

/*$option['user']     = 'root';       // User for database authentication
$option['password'] = '';   // Password for database authentication
$option['database'] = 'big_data_2';      // Database name*/

$dbOld = JDatabaseDriver::getInstance($option);

//clearAll();
migrateDocuments();
//migrateTypeDocument();
//migrateRegions();
//migrateCountries();
//migrateCities();
//migrateProvinces();
//migrateCategories();
//ivi7e_papiersdefamilles_categories

function clearAll()
{
    $dbOld = $GLOBALS['dbOld'];
    $sql   = "TRUNCATE TABLE `ivi7e_papiersdefamilles_documenttypes`";
    $dbOld->setQuery($sql);
    $dbOld->excute($sql);

    $sql = "TRUNCATE TABLE ` ivi7e_papiersdefamilles_documentmainnames`";
    $dbOld->setQuery($sql);
    $dbOld->excute($sql);
}

function migrateDocuments()
{
    $dbOld = $GLOBALS['dbOld'];

    $numGets = 10;
    //11391 15273 18700 22585 26286 30197 22285 11100
    //30462  30452 34310 38207
    $numOffet = 40570;
    $results  = array(1);

    //&& $numOffet<50
    while ( ! empty($results)) {
        echo '----begin transaction-----';
        $limits   = ' LIMIT ' . $numGets . ' OFFSET ' . $numOffet;
        $numOffet += $numGets;

        $sql = "SELECT a.id, a.date AS birthday, a.reference AS reference, a.tracabilite AS traceability, a.prix AS price,
                  b.id AS format_document, b.id AS types, b.nom AS type_name, c.id AS category, c.nom AS category_name, 
               CASE a.qualite
                   WHEN 'PH' THEN '1'
                   WHEN 'MIX' THEN '2'
                   WHEN 'MAN' THEN '3'
                   WHEN 'IMP' THEN '4'
                   WHEN 'GR' THEN '5' 
                END AS qualities, 
                a.pages AS number_of_pages, a.commentaire AS note, a.contenu AS description, age, token AS path, drop2 AS origin_image, lien_miniature AS mini_image
            FROM  GA_document AS a"
            . ' LEFT JOIN types_document AS b ON a.type = b.denomination '
            . ' LEFT JOIN categories_document AS c ON a.categorie = c.denomination '
            /*  . ' WHERE a.reference = "FPM200983"'*/
            . $limits;
        $dbOld->setQuery($sql);
        $dbOld->query();
        $results = $dbOld->loadObjectList();

        /*  drop2
      drop/97ce04db749c074625845aa5e02792dd75a2a88c_108.jpg
      lien_miniature
      ../drop-mini/drop/97ce04db749c074625845aa5e02792dd75a2a88c_108.jpg*/


        //  var_dump($results); die;
        $ordering = 1;

        foreach ($results as $item) {
            $db = JFactory::getDbo();
            $db->transactionStart();
            // create path if not exist

             /*if (empty($item->path) && isset($item->origin_image)) {
                 $tmpPath    = explode("/", $item->origin_image);
                 $tmpPath    = explode("_", $tmpPath[1]);
                 $item->path = $tmpPath[0];
             }

             $mainPath    = "images_documents";
             $main_pic    = $mainPath . '/' . $item->path . '/document_avatar';
             $main_pic_thumb    = $mainPath . '/' . $item->path . '/document_avatar/thumb';
             $gallery_pic = $mainPath . '/' . $item->path;

             if ( ! JFolder::exists($gallery_pic)) {
                 $resultFolder = mkdir($gallery_pic, 0777, true);
                 chmod($gallery_pic, 0777);

                 if ( ! $resultFolder) {
                     $mainPath    = "images_documents2";
                     $main_pic    = $mainPath . '/' . $item->path . '/document_avatar';
                     $gallery_pic = $mainPath . '/' . $item->path;

                     $resultFolder = mkdir($gallery_pic, 0777, true);
                     chmod($gallery_pic, 0777);

                     if ( ! $resultFolder) {
                         $mainPath    = "images_documents3";
                         $main_pic    = $mainPath . '/' . $item->path . '/document_avatar';
                         $gallery_pic = $mainPath . '/' . $item->path;

                         $resultFolder = mkdir($gallery_pic, 0777, true);
                         chmod($gallery_pic, 0777);

                         if ( ! $resultFolder) {
                             $mainPath    = "images_documents4";
                             $main_pic    = $mainPath . '/' . $item->path . '/document_avatar';
                             $gallery_pic = $mainPath . '/' . $item->path;

                             $resultFolder = mkdir($gallery_pic, 0777, true);
                             chmod($gallery_pic, 0777);

                             if ( ! $resultFolder) {
                                 $mainPath    = "images_documents5";
                                 $main_pic    = $mainPath . '/' . $item->path . '/document_avatar';
                                 $gallery_pic = $mainPath . '/' . $item->path;

                                 $resultFolder = mkdir($gallery_pic, 0777, true);
                                 chmod($gallery_pic, 0777);

                                 if ( ! $resultFolder) {
                                     $mainPath    = "images_documents7";
                                     $main_pic    = $mainPath . '/' . $item->path . '/document_avatar';
                                     $gallery_pic = $mainPath . '/' . $item->path;

                                     $resultFolder = mkdir($gallery_pic, 0777, true);
                                     chmod($gallery_pic, 0777);
                                 }
                             }
                         }
                     }
                 }
                 //  JFolder::create($gallery_pic, 777);
             }

             // die('x');
             if ( ! JFolder::exists($main_pic)) {
                 mkdir($main_pic, 0777, true);
                 chmod($main_pic, 0777);
                 // JFolder::create($main_pic, 777);
             }

             if ( ! JFolder::exists($main_pic_thumb)) {
                 mkdir($main_pic_thumb, 0777, true);
                 chmod($main_pic_thumb, 0777);
                 // JFolder::create($main_pic, 777);
             }
 //            var_dump($main_pic);
 //            var_dump($item);die;

             // copy images from  images_documentsxxx/path -> images_documents
             $orginPath = 'image_document/';
             if (JFolder::exists($orginPath . $item->path)) {
                 $tmpFiles = JFolder::files($orginPath . $item->path, '.jpg|.png|.jpeg|.pdf', false, false, array());
                 foreach ($tmpFiles as $tmpFile) {
                     $file = $orginPath . $item->path . '/' . $tmpFile;

                     if (file_exists($file)) {
                         if (strpos($tmpFile, '-2') !== false) {
                             $newfile = $main_pic . '/' . $tmpFile;
                             $tmp     = JFile::copy($file, $newfile);
                         }
                         else {
                             $newfile = $main_pic_thumb . '/' . $tmpFile;
                             $tmp     = JFile::copy($file, $newfile);
                         }

                         chmod($newfile, 0777);
                     }
                 }
             }

             if (isset($item->origin_image) && ! empty($item->origin_image)) {
                 $file = $item->origin_image;

                 $tmpArr  = explode("/", $item->origin_image);
                 $newfile = $main_pic . '/' . $tmpArr[1];

                 if (file_exists($file)) {
                     $tmp = JFile::copy($file, $newfile);
                     chmod($newfile, 0777);
                 }
             }

             if (isset($item->mini_image) && ! empty($item->mini_image)) {
                 $tmpArr = explode("/", $item->mini_image);
                 $file   = $tmpArr[1] . '/' . $tmpArr[2] . '/' . $tmpArr[3];

                 if (file_exists($file)) {
                     $tmpArr2   = explode(".", $tmpArr[3]);
                     $file2  = $tmpArr2[0] . '_thumb' . '.' . $tmpArr2[1];

                     $newfile = $main_pic_thumb . '/' . $file2;
                     $tmp     = JFile::copy($file, $newfile);
                     chmod($newfile, 0777);
                 }
             }*/

             /*$obj              = new stdClass();
             $obj->id          = $item->id;
             $obj->birthday    = $item->birthday;
             $obj->gallery_pic = json_encode($gallery_pic);
             $obj->main_pic    = json_encode($main_pic);
             $obj->num_id      = $item->reference;

             if (empty($item->reference)) {
                 // $obj->num_id      = 'TK' . sprintf('%05d', $item->id);
             }

             $obj->traceability = $item->traceability;
             // set defaul = jpg
             $obj->format_document = 1;
             $obj->qualities       = $item->qualities;
             $obj->number_of_pages = $item->number_of_pages;
             $obj->note            = $item->note;
             $obj->description     = $item->description;
             $obj->age             = $item->age;
             $obj->published       = 1;
             $obj->ordering        = $ordering;
             $obj->price           = $item->price;*/

            $obj              = new stdClass();
            $obj->id          = $item->id;
             // Find locations
             $sql = "SELECT e.nom AS city_id, e.pays AS country_id, d.num_departement AS departement_id, f.num_region AS region_id
                 FROM  GA_document_has_lieu AS a"
                 . ' LEFT JOIN GA_lieu AS b ON a.lieu_id = b.id '
                 . ' LEFT JOIN lieux_unique AS e ON b.villes_unique = e.id '
                 . ' LEFT JOIN pays AS c ON e.pays = c.id '
                 . ' LEFT JOIN departements AS d ON e.departement = d.num_departement'
                 . ' LEFT JOIN regions AS f ON d.num_region = f.num_region '
                 . ' WHERE a.document_id = ' . $item->id;

             $dbOld->setQuery($sql);
             $dbOld->query();
             $resultLocations = $dbOld->loadAssocList();

            /* echo "<pre>";
            print_r($resultLocations);

             echo "</pre>";*/
             $tmp = '[';


             foreach ($resultLocations as $promotion) {
                 if (empty($promotion['region_id']) && empty($promotion['city_id']) && empty($promotion['country_id']) && empty($promotion['departement_id'])) {
                     break;
                 }

                 $tmp .= '{"region_id":"' . $promotion['region_id'] . '", "city_id":"' . $promotion['city_id'] . '", "departement_id":"' . $promotion['departement_id'] . '", "country_id":"' . $promotion['country_id'] . '"},';

                 // Insert in __papiersdefamilles_documentlocations
                 $objDocumentlocations                 = new stdClass();
                 $objDocumentlocations->document_id    = $item->id;
                 $objDocumentlocations->region_id      = $promotion['region_id'];
                 $objDocumentlocations->city_id        = $promotion['city_id'];
                 $objDocumentlocations->country_id     = $promotion['country_id'];
                 $objDocumentlocations->departement_id = $promotion['departement_id'];

                 try {
                     //$where1 = ($promotion['city_id']) ? ' AND a.city_id = "' . $promotion['city_id'] . '"' : '';
                     $where2 = ($promotion['country_id']) ? ' AND a.country_id = "' . $promotion['country_id'] . '"' : '';
                     $where3 = ($promotion['region_id']) ? ' AND a.region_id = "' . $promotion['region_id'] . '"' : '';
                     $where4 = ($promotion['departement_id']) ? ' AND a.departement_id = "' . $promotion['departement_id'] . '"' : '';
                     // Find locations
                     $sql = "SELECT id
                        FROM  ivi7e_papiersdefamilles_documentlocations AS a"

                         . ' WHERE a.document_id = ' . $item->id
                        // . $where1
                         . $where2
                         . $where3
                         . $where4;

                     $db->setQuery($sql);
                     $db->query();
                     $count = $db->loadResult();

                     if ($count) {
                         $objDocumentlocations->id = $count;

                         $resultInsertDocumentlocations = $db->updateObject('#__papiersdefamilles_documentlocations',
                             $objDocumentlocations, 'id');
                     } else {
                         $resultInsertDocumentlocations = $db->insertObject('#__papiersdefamilles_documentlocations',
                             $objDocumentlocations);
                     }

                 } catch (Exception $e) {
                     $db->transactionRollback();
                     echo $e->getMessage();
                 }
             }

             $tmp = rtrim($tmp, ",");
             $tmp .= ']';

             $obj->locations = $tmp;

             // Find main and secondary names
             /*$sql = "SELECT a.type, b.nom AS name, b.prenom AS first_name, a.ordre AS ordering,
                 CASE b.sexe
                    WHEN 'H' THEN '1'
                    WHEN 'F' THEN '2'
                 END AS sex
                 FROM  GA_document_has_personne AS a"
                 . ' LEFT JOIN GA_personne AS b ON a.personne_id = b.id '
                 . ' WHERE a.document_id = ' . $item->id;

             $dbOld->setQuery($sql);
             $dbOld->query();
             $resultNames = $dbOld->loadAssocList();

             $tmp1 = '[';
             $tmp2 = '[';

             foreach ($resultNames as $promotion) {
                 if (empty($promotion['name']) && empty($promotion['first_name'])) {
                     break;
                 }

                 if ($promotion['type'] == 'personne_principale') {
                     $tmp1 .= '{"ordering":"' . $promotion['ordering'] . '", "surname":"' . $promotion['first_name'] . '", "name":"' . $promotion['name'] . '", "sex":"' . $promotion['sex'] . '"},';

                     // Insert in papiersdefamilles_documentmainnames
                     $objDocumentmainnames              = new stdClass();
                     $objDocumentmainnames->document_id = $item->id;
                     $objDocumentmainnames->name        = $promotion['name'];
                     $objDocumentmainnames->sur_name    = $promotion['first_name'];
                     $objDocumentmainnames->sex         = $promotion['sex'];
                     $objDocumentmainnames->ordering    = $promotion['ordering'];

                     try {
                         // Find documentmainnames
                         $where1 = ($promotion['name']) ? ' AND a.name = "' . $promotion['name'] . '"' : '';
                         $where2 = ($promotion['first_name']) ? ' AND a.sur_name = "' . $promotion['first_name'] . '"' : '';
                         $where3 = ($promotion['sex']) ? ' AND a.sex = "' . $promotion['sex'] . '"' : '';

                         $sql = "SELECT id
                        FROM  ivi7e_papiersdefamilles_documentmainnames AS a"

                             . ' WHERE a.document_id = ' . $item->id
                             . $where1
                             . $where2
                             . $where3;

                         $db->setQuery($sql);
                         $db->query();
                         $count = $db->loadResult();

                         if ($count) {
                             $objDocumentmainnames->id = $count;

                             $resultInsertDocumentmainnames = $db->updateObject('#__papiersdefamilles_documentmainnames',
                                 $objDocumentmainnames, 'id');
                         } else {
                             $resultInsertDocumentmainnames = $db->insertObject('#__papiersdefamilles_documentmainnames',
                                 $objDocumentmainnames);
                         }

                     } catch (Exception $e) {
                         $db->transactionRollback();
                         echo $e->getMessage();
                     }
                 } elseif ($promotion['type'] == 'personne_secondaire') {
                     $tmp2 .= '{"name":"' . $promotion['name'] . '", "first_name":"' . $promotion['first_name'] . '"},';

                     // Insert in papiersdefamilles_documentsecondarynames
                     $objDocumentsecondarynames              = new stdClass();
                     $objDocumentsecondarynames->document_id = $item->id;
                     $objDocumentsecondarynames->name        = $promotion['name'];
                     $objDocumentsecondarynames->first_name  = $promotion['first_name'];

                     try {
                         $where1 = ($promotion['name']) ? ' AND a.name = "' . $promotion['name'] . '"' : '';
                         $where2 = ($promotion['first_name']) ? ' AND a.sur_name = "' . $promotion['first_name'] . '"' : '';

                         // Find Documentsecondarynames
                         $sql = "SELECT id
                        FROM  ivi7e_papiersdefamilles_documentsecondarynames AS a"
                             . ' WHERE a.document_id = ' . $item->id
                             . $where1
                             . $where2;

                         $db->setQuery($sql);
                         $db->query();
                         $count = $db->loadResult();

                         if ($count) {
                             $objDocumentsecondarynames->id = $count;

                             $resultInsertsecondarynames = $db->updateObject('#__papiersdefamilles_documentsecondarynames',
                                 $objDocumentsecondarynames, 'id');
                         } else {
                             $resultInsertsecondarynames = $db->insertObject('#__papiersdefamilles_documentsecondarynames',
                                 $objDocumentsecondarynames);
                         }

                     } catch (Exception $e) {
                         $db->transactionRollback();
                         echo $e->getMessage();
                     }
                 }
             }

             $tmp1 = rtrim($tmp1, ",");
             $tmp1 .= ']';

             $tmp2 = rtrim($tmp2, ",");
             $tmp2 .= ']';

             $obj->main_persons      = $tmp1;
             $obj->secondary_persons = $tmp2;

            // Insert in documents

            $obj->categories = '["' . $item->category_name . '"]';
            $obj->types      = '["' . $item->type_name . '"]';*/

            try {
                // Find Documentsecondarynames
                $sql = "SELECT id
                       FROM  ivi7e_papiersdefamilles_documents AS a"

                    . ' WHERE a.id = ' . $obj->id;

                $db->setQuery($sql);
                $db->query();
                $count = $db->loadResult();

                if ($count) {
                    $obj->id = $count;

                    $resultInsert = $db->updateObject('#__papiersdefamilles_documents',
                        $obj, 'id');
                } else {
                    $resultInsert = $db->insertObject('#__papiersdefamilles_documents',
                        $obj);
                }

            } catch (Exception $e) {
                $db->transactionRollback();
                echo $e->getMessage();
            }

            echo $obj->id . ' success <br>';
            // Insert in documenttypes
            /*$objDocumenttype                   = new stdClass();
            $objDocumenttype->document_id      = $item->id;
            $objDocumenttype->type_document_id = $item->format_document;

            // Insert in documenttypes
            try {
                // Find documenttypes
                $where1 = ($item->format_document) ? ' AND a.type_document_id = ' . $item->format_document : '';

                $sql = "SELECT id
                       FROM  ivi7e_papiersdefamilles_documenttypes AS a"

                    . ' WHERE a.document_id = ' . $item->id
                    . $where1;

                $db->setQuery($sql);
                $db->query();
                $count = $db->loadResult();

                if ($count) {
                    $objDocumenttype->id = $count;

                    $resultInsertDocumenttypes = $db->updateObject('#__papiersdefamilles_documenttypes',
                        $objDocumenttype, 'id');
                } else {
                    $resultInsertDocumenttypes = $db->insertObject('#__papiersdefamilles_documenttypes',
                        $objDocumenttype);
                }

            } catch (Exception $e) {
                $db->transactionRollback();
                echo $e->getMessage();
            }*/


            // Insert in documentcategories
             /*$objDocumentcategories              = new stdClass();
             $objDocumentcategories->document_id = $item->id;
             $objDocumentcategories->category_id = $item->category;

             try {
                 $where1 = ($item->category) ? ' AND a.category_id = ' . $item->category : '';
                 // Find documenttypes
                 $sql = "SELECT id
                        FROM  ivi7e_papiersdefamilles_documentcategories AS a"

                     . ' WHERE a.document_id = ' . $item->id
                     . $where1;

                 $db->setQuery($sql);
                 $db->query();
                 $count = $db->loadResult();

                 if ($count) {
                     $objDocumentcategories->id = $count;

                     $resultInsertDocumenttypes = $db->updateObject('#__papiersdefamilles_documentcategories',
                         $objDocumentcategories, 'id');
                 } else {
                     $resultInsertDocumenttypes = $db->insertObject('#__papiersdefamilles_documentcategories',
                         $objDocumentcategories);
                 }
                 echo $item->id . "success <br>";
             } catch (Exception $e) {
                 $db->transactionRollback();
                 echo $e->getMessage();
             }*/

             try {
                 $db->transactionCommit();
             } catch (Exception $e) {
                 $db->transactionRollback();
                 echo $e->getMessage();
             }
             $ordering++;
         }
     }

     echo '<br>----done-----';
 }

 function migrateTypeDocument()
 {
     $dbOld = $GLOBALS['dbOld'];
     $sql   = "SELECT id, denomination, nom FROM  types_document";
     $dbOld->setQuery($sql);
     $dbOld->query();
     $results = $dbOld->loadObjectList();

     // var_dump($results);
     $ordering = 1;

     foreach ($results as $item) {
         $obj            = new stdClass();
         $obj->name      = $item->nom;
         $obj->id        = $item->id;
         $obj->alias     = $item->denomination;
         $obj->published = 1;
         $obj->ordering  = $ordering;

         $resultInsert = JFactory::getDbo()->insertObject('#__papiersdefamilles_typedocuments', $obj);
         $ordering++;
     }
 }

 /**
  *
  */
            function migrateCities()
            {
                $dbOld   = $GLOBALS['dbOld'];
                $numGets = 10;
                //11391 15273 18700 22585 26286
                $numOffet = 0;
                $results  = array(1);

                //&& $numOffet<50
                while ( ! empty($results)) {
                    echo '----begin transaction-----';
                    $limits   = ' LIMIT ' . $numGets . ' OFFSET ' . $numOffet;
                    $numOffet += $numGets;

                    $sql = "SELECT id, nom FROM lieux_unique  ORDER BY  id ASC " . $limits;
                    $dbOld->setQuery($sql);
                    $dbOld->query();
                    $results = $dbOld->loadObjectList();

                    // var_dump($results);
                    $ordering = 1;

                    foreach ($results as $item) {
                        /*if ($item->ville_nom) {
                            $sql   = "SELECT a.id FROM ivi7e_papiersdefamilles_cities as a WHERE a.name = '" . mysql_real_escape_string($item->ville_nom) . "'";
                            $db = JFactory::getDbo();
                            $db->setQuery($sql);
                            $db->query();
                            $isExist = $db->loadResult();
                        }*/
                        $obj            = new stdClass();
                        $obj->name      = $item->nom;
                        $obj->id        = $item->id;
                        $obj->published = 1;
                        $obj->ordering  = $ordering;

                        $resultInsert = JFactory::getDbo()->insertObject('#__papiersdefamilles_cities', $obj);
                        $ordering++;

                        echo $obj->id . ' success <br>';

                    }
                }

                echo '<br>----done-----';
            }

            function migrateProvinces()
            {
                $dbOld = $GLOBALS['dbOld'];
                $sql   = "SELECT num_departement, nom FROM  departements";
                $dbOld->setQuery($sql);
                $dbOld->query();
                $results = $dbOld->loadObjectList();

                //var_dump($results); die;
                $ordering = 1;

                foreach ($results as $item) {
                    $obj            = new stdClass();
                    $obj->name      = $item->nom;
                    $obj->id        = $item->num_departement;
                    $obj->published = 1;
                    $obj->ordering  = $ordering;

                    $resultInsert = JFactory::getDbo()->insertObject('#__papiersdefamilles_provinces', $obj);
                    $ordering++;

                    echo $obj->id . ' sucess<br>';
                }

                echo '<br>----done-----';
            }

            function migrateRegions()
            {
                $dbOld = $GLOBALS['dbOld'];
                $sql   = "SELECT num_region, nom FROM  regions";
                $dbOld->setQuery($sql);
                $dbOld->query();
                $results = $dbOld->loadObjectList();

                // var_dump($results);
                $ordering = 1;

                foreach ($results as $item) {
                    $obj            = new stdClass();
                    $obj->name      = $item->nom;
                    $obj->id        = $item->num_region;
                    $obj->published = 1;
                    $obj->ordering  = $ordering;

                    $resultInsert = JFactory::getDbo()->insertObject('#__papiersdefamilles_regions', $obj);
                    $ordering++;
                }
            }

            function migrateCountries()
            {
                $dbOld = $GLOBALS['dbOld'];
                $sql   = "SELECT id, code, nom_en_gb FROM  pays";
                $dbOld->setQuery($sql);
                $dbOld->query();
                $results = $dbOld->loadObjectList();

                // var_dump($results);
                $ordering = 1;

                foreach ($results as $item) {
                    $obj            = new stdClass();
                    $obj->name      = $item->nom_en_gb;
                    $obj->alias     = $item->code;
                    $obj->id        = $item->id;
                    $obj->published = 1;
                    $obj->ordering  = $ordering;

                    $resultInsert = JFactory::getDbo()->insertObject('#__papiersdefamilles_countries', $obj);
                    $ordering++;
                }
            }

            function migrateCategories()
            {
                $dbOld = $GLOBALS['dbOld'];
                $sql   = "SELECT id, denomination, nom FROM categories_document";
                $dbOld->setQuery($sql);
                $dbOld->query();
                $results = $dbOld->loadObjectList();

                $ordering = 1;

                foreach ($results as $item) {
                    $obj                = new stdClass();
                    $obj->id            = $item->id;
                    $obj->name          = $item->nom;
                    $obj->alias         = $item->denomination;
                    $obj->published     = 1;
                    $obj->creation_date = date("Y-m-d H:i:s");
                    $obj->ordering      = $ordering;
                    $resultInsert       = JFactory::getDbo()->insertObject('#__papiersdefamilles_categories', $obj);
                    $ordering++;
                }
            }
