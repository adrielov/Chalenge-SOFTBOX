<ul class="collection bar-title">
    <li class="collection-item dismissable bar-title bg-blue">
        <div><a href="/category" style="float:right"><i class="material-icons right font-white">list</i>Ver categorias cadastradas</a></div>
        <div>Nova categoria </div>
    </li>
</ul>
    <form class="col s12" method="post">
        <div class="row">
            <div class="input-field col s12">
                <input placeholder="Nome da sua nova categoria" id="first_name" name="name" type="text" minlength="5" length="15" maxlength="15" class="validate" required>
                <label for="first_name">Nome da categoria</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light right cyan" type="submit" name="action">Cadastrar
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </div>
    </form>
