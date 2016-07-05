<title>Nuevo ticket</title>
<div class="container">
	<br>
	<div>
	    <h5 class="center-align" style="font-weight:300">Creación de un nuevo ticket</h5>
	    <h6 class="center-align">Por favor llene todos los datos necesarios, ¡y nuestros técnicos atenderán a su solicitud a la mayor brevedad posible!</h6>
	</div>
	<br>
    <div class ="row card-panel">
        <div class="input-field col s12">
            <i class="material-icons prefix">mode_edit</i>
            <input id="subject" type="text" length="55">
            <label for="subject">Asunto</label>
        </div>
    </div>
    <div class="row card-panel">
        <div class="input-field col s12">
                <i class="material-icons prefix">message</i>
                <textarea id="description" class="materialize-textarea" length="500"></textarea>
                <label for="description">Descripción del incidente</label>
        </div>
    </div>
    
    <div class ="row">
        <div class="input-field col s12 m3">
            <select>
              <option value="" disabled selected>Elija el tipo de incidente</option>
              <option value="1">Option 1</option>
              <option value="2">Option 2</option>
              <option value="3">Option 3</option>
            </select>
            <label>Tipo de incidente</label>
        </div>
        <div class="input-field col s12 m3">
            <select>
                  <option value="" disabled selected>Elija el nivel del incidente</option>
                  <option value="1">Option 1</option>
                  <option value="2">Option 2</option>
                  <option value="3">Option 3</option>
            </select>
            <label>Nivel</label>
        </div>
        <div class="input-field col s12 m3">
            <select>
                  <option value="" disabled selected>Elija el departamento de origen del incidente</option>
                  <option value="1">Option 1</option>
                  <option value="2">Option 2</option>
                  <option value="3">Option 3</option>
            </select>
            <label>Departamento</label>
        </div>
        <div class="input-field col s12 m3">
            <select>
                  <option value="" disabled selected>Elija la prioridad del incidente</option>
                  <option value="1">Option 1</option>
                  <option value="2">Option 2</option>
                  <option value="3">Option 3</option>
            </select>
            <label>Prioridad</label>
        </div>
    </div>
    <div class="row">
        <a class="col s4 offset-s4 m2 offset-m5 waves-effect waves-light yellow darken-4 btn">Enviar</a>
   	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('select').material_select();
    $('input#subject, textarea#description').characterCounter();
});
</script>