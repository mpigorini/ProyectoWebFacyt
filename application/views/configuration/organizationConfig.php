<title>Configuración de Organización</title>
<div class="container">
	<br>
        <h5 class="center-align" style="font-weight:300">Configuración de la Organización</h5>
    <br>
	<div class="row">
	    <div class="col s12 m5 card-panel blue-grey darken-1">
	        <p class="white-text">
    	        A su derecha se muestran todos los departamentos existentes.<br/>
    	        Para editar un departamento, haga click en <i class="material-icons">send</i> del departamento de su elección.<br/>
    	        Para crear un nuevo departamento, haga click en "nuevo".
	        </p>
	    </div>
        <div class="col s12 m6 offset-m1 card-panel">
            <p class="center">Lista de departamentos</p>
            <table style="width:80%;margin:auto">
                <thead>
                    <th>#</th>
                    <th>Nombre</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <tr ng-repeat="department in departments">
                        <td>{{$index+1}}</td>
                        <td>{{department.name}}</td>
                        <td><a class="btn-floating waves-effect waves-light" ng-click="loadDepartment($index)"><i class="material-icons">send</i></a></td>
                        <td><a class="btn-floating waves-effect waves-light red"><i class="material-icons">delete</i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
	</div>
	<br/>
    <div class="row" style="margin-left:20px; margin-right:20px">
        <h5 style="font-weight:300">Detalles del departamento</h5>
        <form>
            <div id="department-details" class ="row card-panel">
                <div ng-show="editDepartment" class="input-field col s12">
                    <input id="name" ng-model="department.name" type="text">
                    <label for="name" ng-class="{active:isDepartmentLoaded()}">Nombre del departamento</label>
                </div>
                <div ng-show="!editDepartment" class="input-field col s12">
                    <input id="name" ng-model="department.name" disabled type="text">
                    <label for="name" ng-class="{active:isDepartmentLoaded()}">Nombre del departamento</label>
                </div>
                <div ng-show="editDepartment" class="input-field col s12">
                    <textarea id="description" ng-model="department.description" class="materialize-textarea"></textarea>
                    <label for="description" ng-class="{active:isDepartmentLoaded()}">Descripción del departamento</label>
                </div>
                <div ng-show="!editDepartment" class="input-field col s12">
                    <textarea id="description" ng-model="department.description" disabled class="materialize-textarea"></textarea>
                    <label for="description" ng-class="{active:isDepartmentLoaded()}">Descripción del departamento</label>
                </div>
                <div class="row right-align">
                    <a class="btn waves-effect waves-light" ng-click="newDepartment()" ng-show="!editDepartment">Nuevo</a>
                    <a class="btn" ng-click="departmentEditMode()" ng-show="!editDepartment && (department.name != null || department.description != null)">Editar</a>
                    <a class="btn waves-effect waves-light" ng-click="saveDepartment()" ng-show="editDepartment">Guardar</a>
                    <a class="btn" ng-click="departmentViewMode()" ng-show="editDepartment">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
    <br/>
 <div id="positions-table" class="row" style="margin-left:20px; margin-right:20px">
        <h5 style="font-weight:300">Cargos dentro del departamento {{department.name}}</h5>
        <form>
            <div id="department-details" class ="row card-panel">
                <div ng-show="editDepartment" class="input-field col s12">
                    <input id="name" ng-model="department.name" type="text">
                    <label for="name" ng-class="{active:isDepartmentLoaded()}">Nombre del departamento</label>
                </div>
                <div ng-show="!editDepartment" class="input-field col s12">
                    <input id="name" ng-model="department.name" disabled type="text">
                    <label for="name" ng-class="{active:isDepartmentLoaded()}">Nombre del departamento</label>
                </div>
                <div ng-show="editDepartment" class="input-field col s12">
                    <textarea id="description" ng-model="department.description" class="materialize-textarea"></textarea>
                    <label for="description" ng-class="{active:isDepartmentLoaded()}">Descripción del departamento</label>
                </div>
                <div ng-show="!editDepartment" class="input-field col s12">
                    <textarea id="description" ng-model="department.description" disabled class="materialize-textarea"></textarea>
                    <label for="description" ng-class="{active:isDepartmentLoaded()}">Descripción del departamento</label>
                </div>
                <div class="row right-align">
                    <a class="btn waves-effect waves-light" ng-click="newDepartment()" ng-show="!editDepartment">Nuevo</a>
                    <a class="btn" ng-click="departmentEditMode()" ng-show="!editDepartment && (department.name != null || department.description != null)">Editar</a>
                    <a class="btn waves-effect waves-light" ng-click="saveDepartment()" ng-show="editDepartment">Guardar</a>
                    <a class="btn" ng-click="departmentViewMode()" ng-show="editDepartment">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>