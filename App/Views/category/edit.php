<?php
    $category   =   $this->get("category");
?>
<ul class="collection bar-title">
    <li class="collection-item dismissable bar-title bg-blue">
        <div><a href="/category" style="float:right"><i class="material-icons right font-white">list</i>Ver categorias cadastradas</a></div>
        <div>Atualizar categoria </div>
    </li>
</ul>
<form class="col s12" method="post">
    <div class="row">
        <div class="input-field col s12">
            <input placeholder="Nome da sua nova categoria" id="first_name" value="<?php echo $category['name']; ?>" name="name" type="text" class="validate" required>
            <label for="first_name">Nome da categoria</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <button class="btn waves-effect waves-light right cyan" type="submit" name="action">Atualizar dados
                <i class="material-icons right">send</i>
            </button>
        </div>
    </div>
</form>