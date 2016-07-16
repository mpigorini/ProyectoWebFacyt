<div id="profile-card" class="container">
    <div class="row">
        <div class="left">
            <img ng-if="edit.type=='Solicitante'" width="128" height="128" title="Solicitante" src="<?php echo base_url()?>images/solicitante.png"/>
            <img ng-if="edit.type=='Gerente'" width="128" height="128" title="Gerente" src="<?php echo base_url()?>images/gerente.png"/>
            <img ng-if="edit.type=='Coordinador de sistema'" width="128" title="Coordinador de sistema" height="128" src="<?php echo base_url()?>images/coordinador.png"/>
            <img ng-if="edit.type=='Técnico'" width="128" height="128" title="Técnico" src="<?php echo base_url()?>images/tecnico.png"/>
        </div>
        <div class="center-align card-panel z-depth-2" style="cursor: default;"><h3>Este es tu perfil, {{ label }}!</h3></div>
    </div>
</div>
<div class="container">
    <div class="card-panel">
        <div class="row">
            <div class="input-field col s6">
                <h5 style="cursor: default;">
                    Login: <input type="text" ng-model="edit.login" readonly>
                </h5>
            </div>    
            <div class="profile-settings col s6">
                <h5 style="cursor: default;">
                    Contraseña:
                    <input type="password" ng-model="edit.password" ng-show="mode">
                    <input type="password" ng-model="edit.password" ng-show="!mode" readonly>
                </h5>
            </div>
        </div>
        <div class="row">
            <div class="profile-settings col s6">
                <h5 style="cursor: default;">
                    Nombre:
                    <input type="text" ng-model="edit.username" ng-show="mode">
                    <input type="text" ng-model="edit.username" ng-show="!mode" readonly>
                </h5>
            </div>
            <div class="profile-settings col s6">
                <h5 style="cursor: default;">
                    Apellido:
                    <input type="text" ng-model="edit.lastname" ng-show="mode">
                    <input type="text" ng-model="edit.lastname" ng-show="!mode" readonly>
                </h5>
            </div>
        </div>
        <div class="row">
            <div class="profile-settings col s6">
                <h5 style="cursor: default;">
                    Cedula: <input type="text" ng-model="edit.cedula" readonly>
                </h5>
            </div>
            <div class="profile-settings col s6">
                <h5 style="cursor: default;">
                    Teléfono:
                    <input type="number" ng-model="edit.phone" ng-show="mode">
                    <input type="number" ng-model="edit.phone" ng-show="!mode" readonly>
                </h5>
            </div>
        </div>
        <div class="row">
            <div class="profile-settings col s6">
                <h5 style="cursor: default;">
                    Cargo: <input type="text" ng-model="edit.position" readonly>
                </h5>
            </div>
            <div class="profile-settings col s6">
                <h5 style="cursor: default;">
                    Departamento: <input type="text" ng-model="edit.department" readonly>
                </h5>
            </div>
        </div>
        <div class="row">
            <div class="profile-settings col s12">
                <h5 style="cursor: default;">
                    Correo electrónico: <input class="center-align" type="text" ng-model="edit.email" readonly>
                </h5>
            </div>
        </div>
        <div class="row">
            <div class="profile-settings col s12">
                <h5 style="cursor: default;">
                    Tipo de usuario: <input class="center-align" type="text" ng-model="edit.type" readonly>
                </h5>
            </div>
        </div> 
        <div class="row">   
            <button class="btn col s4 offset-s4 waves-effect waves-light  yellow darken-4"  name="edit" ng-click="editMode()" ng-show="!mode">Actualizar información</button>
            <button class="btn col s4 offset-s4 waves-effect waves-light  yellow darken-4"  name="save" ng-click="save()" ng-show="mode" style="margin-bottom: 20px;">Guardar</button>
            <button class="btn col s4 offset-s4 waves-effect waves-light  yellow darken-4"  name="cancel" ng-click="viewMode()" ng-show="mode">Cancelar</button>  
        </div>    
    </div>
</div>
