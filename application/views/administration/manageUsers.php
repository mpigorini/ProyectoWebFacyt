<h5 class="center" style="cursor: default;">Administración de los Usuarios</h5>
<br>
<div class="row">
	<div class="col s3 offset-s2">
	    <div class="card-panel orange accent-4">
	    	<span class="white-text" style="text-align: justify; cursor: default; font-size: 16px;">Puede utilizar la herramienta <i class="material-icons prefix small">search</i> para buscar un usuario en especifico, o filtrar de acuerdo a un departamento, un cargo, etc.</span>
	    </div>
    </div>
    <div class="input-field col s3">
    	<i class="material-icons prefix small">search</i>
        <input id="filter" type="text" ng-model="search">
    	<label for="filter">Buscar usuarios...</label>
    </div>
</div>
<br>
<div class="container row">   
    <div class="card-panel col s9">
        <h5 class="center">Lista de usuarios del sistema</h5>
        <table class="bordered striped" style="display: block; height: 550px; overflow-y: auto;">
            <thead>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cédula</th>
                <th>Teléfono</th>
                <th>Tipo de usuario</th>
                <th>Departamento</th>
                <th>Cargo</th>
                <th>Editar</th>
                <th style="width: 4% !important;">Eliminar</th>
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
                    <td><a class="btn-floating waves-effect waves-light tale" title="Editar usuario {{user.name}}" ng-click="userEditMode($index)"><i class="material-icons">mode_edit</i></a></td>
                    <td><a class="btn-floating waves-effect waves-light red" title="Eliminar usuario {{user.name}}" ng-click="deleteUser(user.id)"><i class="material-icons">delete</i></a></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col s3 center-align">
    	<div class="card-panel orange accent-4">
    		<span class="white-text" style="text-align: justify; cursor: default; font-size: 17px;">Al presionar sobre <i class="material-icons prefix small">mode_edit</i>
    			para editar un usuario, se mostrara una nueva sección debajo que le permitirá realizar los cambios que desee.
				<br><br>
				También se mostrara una nueva sección debajo si presiona "Nuevo usuario", donde se le solicitaran los datos del usuario que desea agregar.
    		</span>
    	</div>
    	<button class="btn waves-effect waves-light  tale"  name="new_user" title="Agregar nuevo usuario" style="top: 100px;">Nuevo usuario</button>
    </div>
</div>
<br>
<div class="container" ng-show="editUser">
	<div class="card-panel">
		<div class="row cols 12">
			<h5 class="center" style="cursor: default;">Editar usuario {{user.name}} {{user.lastname}}</h5>
		</div>
		<div class="row">
			<div class="input-field col s6">
				<h5 style="cursor: default;">
					Login: <input ng-model="user.login" type="text">
				</h5>
	        </div>
	        <div  class="input-field col s6">
	            <h5 style="cursor: default;">
					Contraseña: <input ng-model="user.password" type="text">
				</h5>
	        </div>
        </div>
		<div class="row">
			<div class="input-field col s6">
				<h5 style="cursor: default;">
					Nombre: <input ng-model="user.name" type="text">
				</h5>
	        </div>
	        <div  class="input-field col s6">
	            <h5 style="cursor: default;">
					Apellido: <input ng-model="user.lastname" type="text">
				</h5>
	        </div>
        </div>
        <div class="row">
			<div class="input-field col s6">
				<h5 style="cursor: default;">
					Cedula: <input ng-model="user.cedula" type="text">
				</h5>
	        </div>
	        <div  class="input-field col s6">
	            <h5 style="cursor: default;">
					Teléfono: <input ng-model="user.phone" type="text">
				</h5>
	        </div>
        </div>
        <div class="row">
			<div class="input-field col s6">
				<h5 style="cursor: default;">
					Departamento actual: <input ng-model="user.department" type="text" readonly>
				</h5>
	        </div>
	        <div  class="input-field col s6">
	            <h5 style="cursor: default;">
					Cargo actual: <input ng-model="user.position" type="text" readonly>
				</h5>
	        </div>
        </div>
        <div class="row">
        	<div class="input-field col s12">
				<h5 style="cursor: default;">Nuevo departamento y cargo:</h5>
			
			    <select  ng-model="newDepartment"  material-select watch>
			        <option  ng-repeat="departmet in departments">{{departmet.name}}</option>
			    </select>
				
	        </div>
        </div>
        <div class="row">
			<div class="input-field col s12">
				<h5 style="cursor: default;">
					Actualmente {{user.name}} es un usuario: <input class="center-align" ng-model="user.type" type="text" readonly>
				</h5>
	        </div>
        </div>
        <div class="row">
			<div class="input-field col s12">
				<h5 style="cursor: default;">Cambiar el tipo de usuario:</h5>
				<select ng-model="user.newType">
			      	<option value="" disabled selected>Eliga el tipo de usuario...</option>
			      	<option value="Gerente">Gerente</option>
			      	<option value="Coordinador de sistema">Coordinador de sistema</option>
			      	<option value="Técnico">Técnico</option>
			      	<option value="Solicitante">Solicitante</option>
			    </select>
	        </div>
        </div>
        <div class="row center">
        	<button class="col s3 offset-s2 btn waves-effect waves-light  orange accent-4"  name="save_editUser" ng-click="updateUser()">Guardar</button>
        	<button class="col s3 offset-s2 btn waves-effect waves-light  orange accent-4"  name="cancel_editUser" ng-click="userViewMode()">Cancelar</button>
        </div>
	</div>
</div>
<script>
</script>
