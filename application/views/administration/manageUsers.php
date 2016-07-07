<h5 class="center">Administración de los Usuarios</h5>
<div class="row">
    <div class="input-field col s2 offset-s5">
    	<i class="material-icons prefix small">search</i>
        <input id="filter" type="text" ng-model="search">
    	<label for="filter">Buscar usuarios...</label>
    </div>
</div>
<div class="container row">   
    <div class="card-panel col s9">
        <h5 class="center">Lista de usuarios del sistema</h5>
        <table class="bordered striped" style="display: block; max-height: 600px; overflow-x: auto;">
            <thead>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cédula</th>
                <th>Teléfono</th>
                <th>Tipo de usuario</th>
                <th>Departamento</th>
                <th>Cargo</th>
                <th style="width: 6% !important;">Editar</th>
            </thead>
            <tbody>
                <tr ng-repeat="user in users | filter:search">
                    <td>{{user.name}}</td>
                    <td>{{user.lastname}}</td>
                    <td>{{user.cedula}}</td>
                    <td>{{user.phone}}</td>
                    <td>{{user.type}}</td>
                    <td>{{user.department}}</td>
                    <td>{{user.position}}</td>
                    <td><a class="btn-floating waves-effect waves-light red"><i class="material-icons">mode_edit</i></a></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col s3">
    	<div class="card-panel orange accent-4">
    		<span class="white-text" style="text-align: justify; cursor: default; font-size: 17px;">Puede utilizar la herramienta <i class="material-icons prefix small">search</i> para buscar un usuario en especifico, o filtrar de acuerdo a un departamento o a un cargo.</span>
    	</div>
    </div>
</div>
