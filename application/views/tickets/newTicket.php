<title>Nuevo ticket</title>
<div class="container">
    <p class="center">Hola, soy un nuevo ticket</p>
    <div class ="row">
        <div class="input-field col s12 m6">
            <select>
              <option value="" disabled selected>Choose your option</option>
              <option value="1">Option 1</option>
              <option value="2">Option 2</option>
              <option value="3">Option 3</option>
            </select>
            <label>Tipo de incidente</label>
        </div>
        <div class="input-field col s12 m6">
            <select>
                  <option value="" disabled selected>Choose your option</option>
                  <option value="1">Option 1</option>
                  <option value="2">Option 2</option>
                  <option value="3">Option 3</option>
            </select>
            <label>Nivel</label>
        </div>
    </div>
    <!-- Will always be TODAY -- not needed
    <div class ="row">
        <div class="input-field col s12">
            <input id="dateIn" type="date" class="datepicker">
            <label for="dateIn">Fecha de ingreso</label>
        </div>
    </div> -->
    <div class="row card-panel">
        <div class="input-field col s12">
                <i class="material-icons prefix">mode_edit</i>
                <textarea id="description" class="materialize-textarea"></textarea>
                <label for="description">Descripción</label>
        </div>
    </div>
    <div class="row card-panel">
        <div class="input-field col s12">
            <i class="material-icons prefix">mode_edit</i>
            <textarea id="evaluation" class="materialize-textarea"></textarea>
            <label for="evaluation">Evaluación</label>
        </div>
    </div>
    <div class="row card-panel">
        <div class="input-field col s12">
            <i class="material-icons prefix">mode_edit</i>
            <textarea id="observation" class="materialize-textarea"></textarea>
            <label for="observation">Observaciones</label>
        </div>
    </div>
    <div class="row">
	   <a class="col s4 offset-s4 m2 offset-m5 waves-effect waves-light yellow darken-4 btn">Enviar</a>
   	</div>
</div>