<ul class="collection bar-title">
    <li class="collection-item dismissable bar-title bg-blue">
        <div><a href="/releases" style="float:right"><i class="waves-effect material-icons right font-white">list</i>Ver lista de lançamentos</a></div>
        <div>Novo Lançamento </div>
    </li>
</ul>
<div class="row">
    <form class="col s12" method="post">

        <div class="input-field col s6">
          <input id="first_name" type="text" class="validate" name="value" length="5" >
          <label for="first_name" data-success="Verificado" data-error="Inválido!" >Valor</label>
    
        </div>

        <div class="input-field col s6">
            <select name="category_id" id="category" required>
                <?php 
                    if(is_array($this->get("categorys")))
                        {
                            foreach ($this->get("categorys") as $category) 
                                {
                ?>
                                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                <?php
                                }
                        }
                        else
                        {
                ?>
                            <option disabled  selected>NENHUMA CATEGORIA CADASTRADA</option>
                <?php
                        }
                ?>
                </select>
            <label>Selecione uma categoria</label>
          </div>
          <div class="input-field col s12">
            <textarea id="description" class="materialize-textarea" name="description" length="120" required></textarea>
           <label for="description" data-success="Verificado" data-error="Inválido!" >Descrição</label>
          </div>


       <div class="input-field col s6">
            <select name="type" required>
              <option value="recipe" selected>Receita</option>
              <option value="expense">Despesa</option>
            </select>
            <label>Tipos de lançamentos</label>
          </div>

        

   
            <div class="input-field col s6">
                <button class="btn waves-effect waves-light right cyan" type="submit" name="action">Cadastrar
                    <i class="material-icons right">send</i>
                </button>
            </div>
     
    </form>
</div>