<?php
use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Tools\Setup,
    Doctrine\ORM\EntityManager;

class Doctrine
{

    public $em;

    public function __construct()
    {
        //adsadsadsadsa
        require_once __DIR__ . '/Doctrine/ORM/Tools/Setup.php';
        Setup::registerAutoloadDirectory(__DIR__);

        // Carga la configuración de la base de datos desde CodeIgniter
        require __DIR__ . '/../config/database.php';

        $connection_options = array(
            'driver'        => 'pdo_mysql',
            'user'          => $db['default']['username'],
            'password'      => $db['default']['password'],
            'host'          => $db['default']['hostname'],
            'dbname'        => $db['default']['database'],
            'charset'       => $db['default']['char_set'],
            'driverOptions' => array(
                'charset'   => $db['default']['char_set'],
            ),
        );

        // Con esta configuración, tus archivos del modelo necesitan estar en application/models/Entity
        // Ejemplo: Al crear un nuevo Entity\User cargamos la clase desde application/models/Entity/User.php
        $models_namespace = 'Entity';
        $models_path = APPPATH . 'models';
        $proxies_dir = APPPATH . 'models/Proxies';
        $metadata_paths = array(APPPATH . 'models');

        // Establezca $ dev_mode = TRUE para deshabilitar el almacenamiento en caché mientras desarrollas
        // 5th param = false will force Doctrine to use the not-simple AnnotationReader which can handle our models now.
        $config = Setup::createAnnotationMetadataConfiguration($metadata_paths, $dev_mode = true, $proxies_dir, null, false);
        $this->em = EntityManager::create($connection_options, $config);

        $loader = new ClassLoader($models_namespace, $models_path);
        $loader->register();
    }

}