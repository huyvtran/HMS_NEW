<?php namespace OpenEMR\Common\Database{;;;;final class Connector{public$entityManager;private$logger;private function __construct(){$this->logger=new \OpenEMR\Common\Logging\Logger("\OpenEMR\Common\Database\Connector");$this->createConnection();}public static function Instance(){static$singletonInstance=null;if($singletonInstance===null){$singletonInstance=new Connector();if($GLOBALS['debug_ssl_mysql_connection']){error_log("CHECK SSL CIPHER IN DOCTRINE: ".print_r($singletonInstance->entityManager->getConnection()->query("SHOW STATUS LIKE 'Ssl_cipher';")->FetchAll(),true));}}return$singletonInstance;}private function createConnection(){global $sqlconf;$entityPath=array(__DIR__."../entities");$this->logger->trace("Connecting with ".($GLOBALS["doctrine_connection_pooling"]?"pooled":"non-pooled")." mode");$connection=array('driver'=>"pdo_mysql",'host'=>$sqlconf["host"],'port'=>$sqlconf["port"],'user'=>$sqlconf["login"],'password'=>$sqlconf["pass"],'dbname'=>$sqlconf["dbase"],'pooled'=>$GLOBALS["doctrine_connection_pooling"]);global $disable_utf8_flag;$driverOptionsString='';if(!$disable_utf8_flag){$this->logger->trace("Enabling utf8");$connection['charset']='utf8';$driverOptionsString='SET NAMES utf8';}$this->logger->trace("Clearing sql mode");if(!empty($driverOptionsString)){$driverOptionsString.=',sql_mode = \'\'';}else{$driverOptionsString='SET sql_mode = \'\'';}$this->logger->trace("Setting time zone");$driverOptionsString.=", time_zone = '".(new \DateTime())->format("P")."'";$connection['driverOptions']=array(1002=>$driverOptionsString);if(file_exists($GLOBALS['OE_SITE_DIR']."/documents/certificates/mysql-ca")){$connection['driverOptions'][\PDO::MYSQL_ATTR_SSL_CA]=$GLOBALS['OE_SITE_DIR']."/documents/certificates/mysql-ca";if(file_exists($GLOBALS['OE_SITE_DIR']."/documents/certificates/mysql-key")&&file_exists($GLOBALS['OE_SITE_DIR']."/documents/certificates/mysql-cert")){$connection['driverOptions'][\PDO::MYSQL_ATTR_SSL_KEY]=$GLOBALS['OE_SITE_DIR']."/documents/certificates/mysql-key";$connection['driverOptions'][\PDO::MYSQL_ATTR_SSL_CERT]=$GLOBALS['OE_SITE_DIR']."/documents/certificates/mysql-cert";}}$this->logger->trace("Wiring up Doctrine entities");$configuration=\Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($entityPath,true,null,null,false);$configuration->setAutoGenerateProxyClasses(true);$this->logger->trace("Creating connection");$this->entityManager=\Doctrine\ORM\EntityManager::create($connection,$configuration);$this->logger->trace("Wiring up SQL auditor to store audit entries in `log` table");$this->entityManager->getConfiguration()->setSQLLogger(new \OpenEMR\Common\Database\Auditor());}}}