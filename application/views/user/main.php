<div id="profile-card" class="container card">
    <div class="row">
        <div class="card left">
            <img src="<?php echo base_url()?>images/icon-profile.png"/>
        </div>
        <div class="center-align card-panel z-depth-2"><h3>Este es tu perfil, {{ label }}!</h3></div>
    </div>
    <div>
        <div class="row">
            <div class="profile-settings col s6">
                <h5>
                    Login: <input type="text" ng-model="edit.login" required>
                </h5>
            </div>    
            <div class="profile-settings col s6">
                <h5>
                    Contraseña: <input type="password" ng-model="edit.password" required>
                </h5>
            </div>
        </div>
        <div class="row">
            <div class="profile-settings col s6">
                <h5>
                    Nombre: <input type="text" ng-model="edit.username">
                </h5>
            </div>
            <div class="profile-settings col s6">
                <h5>
                    Apellido: <input type="text" ng-model="edit.lastname">
                </h5>
            </div>
        </div>
        <div class="row">
            <div class="profile-settings col s12">
                <h5 center-align>
                    Tipo de usuario: {{ edit.type }}
                </h5>
            </div>
        </div> 
        <div class="row">   
            <button class="btn col s4 offset-s4 waves-effect waves-light"  name="edit" ng-click="edit()">Actualizar información</button>
        </div>    
    </div>
</div>
