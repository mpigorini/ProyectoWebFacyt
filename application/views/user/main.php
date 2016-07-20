<div ng-if="loading" style="margin-left: 45%; margin-top: 10%;">
    <div class="preloader-wrapper big active">
        <div class="spinner-layer">
              <div class="circle-clipper left">
                <div class="circle"></div>
              </div><div class="gap-patch">
                <div class="circle"></div>
              </div><div class="circle-clipper right">
                <div class="circle"></div>
              </div>
        </div>
    </div>
</div>
<div ng-if="!loading">
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
                <div class="profile-settings col s6">
                    <h5 style="cursor: default;">
                        Login: <input type="text" ng-model="edit.login" readonly>
                    </h5>
                </div>    
                <div class="profile-settings col s6">
                    <h5 style="cursor: default;" ng-show="mode">
                        Contraseña:
                        <input type="password" ng-model="edit.password">
                    </h5>
                    <h5 style="cursor: default;" ng-show="!mode">
                        Contraseña:
                        <input type="password" ng-model="edit.password" readonly>
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="profile-settings col s6">
                    <h5 style="cursor: default;" ng-show="mode">
                        Nombre:
                        <input type="text" ng-model="edit.username">
                    </h5>
                    <h5 style="cursor: default;" ng-show="!mode">
                        Nombre:
                        <input type="text" ng-model="edit.username" readonly>
                    </h5>
                </div>
                <div class="profile-settings col s6">
                    <h5 style="cursor: default;" ng-show="mode">
                        Apellido:
                        <input type="text" ng-model="edit.lastname">
                    </h5>
                    <h5 style="cursor: default;" ng-show="!mode">
                        Apellido:
                        <input type="text" ng-model="edit.lastname" readonly>
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
                    <h5 style="cursor: default;" ng-show="mode">
                        Teléfono:
                        <input type="number" ng-model="edit.phone">
                    </h5>
                    <h5 style="cursor: default;" ng-show="!mode">
                        Teléfono:
                        <input type="number" ng-model="edit.phone" readonly>
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
            <div class="row" ng-class="{validate:notValid}">
                <div class="profile-settings input-field col s12">
                    <h5 style="cursor: default;" ng-show="mode">
                        Correo electrónico:
                        <input class="center-align" type="email" ng-model="edit.email" ng-change="validateEmail()">
                    </h5>
                    <h5 style="cursor: default;" ng-show="!mode">
                        Correo electrónico:
                        <input class="center-align" type="text" ng-model="edit.email" readonly>
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
            <div class="row" ng-show="!mode" >   
                <button class="btn col s2 offset-s5 waves-effect waves-light  yellow darken-4"  name="edit" ng-click="editMode()">Editar información</button>
            </div>
            <div class="row" ng-show="mode">    
                <button class="btn col s2 offset-s3 waves-effect waves-light  yellow darken-4"  name="save" ng-click="save()">Guardar</button>
                <button class="btn col s2 offset-s2 waves-effect waves-light  yellow darken-4"  name="cancel" ng-click="viewMode()">Cancelar</button>
            </div>
        </div>
    </div>
</div>
