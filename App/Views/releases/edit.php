<?php
$release              = $this->get("releases");
$category             = $this->get("category");
$release['type_name'] = ($release['type'] == "expense") ? "Despesa" : "Receita";
$release['type']      = ($release['type'] == "expense") ? "trending_down" : "trending_up";
$type_color           = ($release['type'] == "trending_down") ? "font-red" : "font-green";
?>
    <ul class="collection bar-title">
        <li class="collection-item dismissable bg-blue">
            <ul class="right horizontal view-item">
                <li><a href="/releases/delete/<?php echo $this->get("id"); ?>">
                <i class="material-icons" style="color:white!important">delete</i></a></li>
            </ul>
            <div>
                <h5><i class="material-icons left" style="color:white!important">equalizer</i>
                Editar lançamento #<?php echo $this->get("id"); ?></h5>
            </div>
        </li>
    </ul>

    <div class="row">
        <form class="col s12" method="post">

            <div class="input-field col s6">
                <input id="value" type="text" class="validate" value="<?php echo $release["value"]; ?>" length="7" maxlength="7" name="value">
                <label for="value" data-success="Verificado" data-error="Inválido!">Valor</label>

            </div>

            <div class="input-field col s6">
                <select name="category_id" id="category" required>
                    <?php
                        if (is_array($this->get("categorys"))) {
                            foreach ($this->get("categorys") as $category) {
                                if ($category['id'] == $release['category_id']) { ?>
                                
                        <option value="<?php echo $category['id']; ?>" selected><?php echo $category['name']; ?></option>

                        <?php } else { ?>

                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>

                            <?php } } } else { ?>

                                <option disabled selected>NENHUMA CATEGORIA CADASTRADA</option>

                            <?php } ?>
                </select>
                <label>Selecione uma categoria</label>
            </div>

            <div class="input-field col s12">
                <textarea id="description" class="materialize-textarea" name="description" length="300" maxlength="300" required><?php echo $release["description"]; ?>
                </textarea>
                <label for="description" data-success="Verificado" data-error="Inválido!">Descrição</label>
            </div>

            <div class="input-field col s6">
                <select name="type" required>
                    <option value="recipe" selected>Receita</option>
                    <option value="expense">Despesa</option>
                </select>
                <label>Tipos de lançamentos</label>
            </div>




            <div class="input-field col s6">
                <button class="btn waves-effect waves-light right cyan" type="submit" name="action">Atualizar dados
                    <i class="material-icons right">send</i>
                </button>
            </div>

        </form>
    </div>