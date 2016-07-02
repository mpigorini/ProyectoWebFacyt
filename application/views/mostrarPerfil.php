<?php
 include (APPPATH. '/libraries/ChromePhp.php');

    \ChromePhp::log($this->doctrine->em);
?>

<p ng-show="usuarios.length == 0">No hay usuarios para mostrar</p>
<input type="text" ng-model="MostrarPerfil"/>
<ul>
   <li ng-repeat="user in usuarios | filter: MostrarPerfil">
    Nombre: {{ user.nombre }} Edad: {{ user.edad }}
   </li>
</ul>