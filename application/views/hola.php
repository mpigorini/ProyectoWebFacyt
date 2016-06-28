
<body>
    
    <div><h1>HOLAAAAAAAAAAA</h1></div>
<?php
 include (APPPATH. '/libraries/ChromePhp.php');
$em =  $this->doctrine->em;
$qb =  $em->createQueryBuilder();

$qb->select('u')
    ->from('Users.php','u');
    
     \ChromePhp::log($qb->getQuery()->getResult());
?>
</body>