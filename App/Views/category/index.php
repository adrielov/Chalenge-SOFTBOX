<ul class="collection bar-title">
    <li class="collection-item dismissable bg-blue">
    	<div><a href="/category/new" style="float:right"><i class="material-icons right font-white">add</i>Criar uma nova categoria</a></div>
    	<div>Categorias cadastradas</div>
    </li>
</ul>
<table class="striped" width="100%">
	<thead>
		<tr>
			<th data-field="id" style="text-align:center;" width="50">#Id</th>
			<th data-field="name" style="text-align:left;" width="200">Nome Da Categoria</th>
			<th data-field="price" style="text-align:left;" colspan="5"></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		if(is_array($this->get("categorys"))) {
				$categoryList = $this->get("categorys");
				
				foreach ($categoryList as $category) {
		?>
						<tr>
							<td style="text-align:center;"><?php echo $category['id']; ?></td>
							<td style="text-align:left;"><?php echo $category['name']; ?></td>
							<td style="text-align:left;"><b>Categoria criada em: </b><?php echo $category['created_at']; ?></td>
							<td style="text-align:center;" width="30"><a href="/category/edit/<?php echo $category['id']; ?>"><i class=" waves-effect material-icons font-purple">edit</i></a></td>
							<td style="text-align:center;" width="50"><a href="/category/delete/<?php echo $category['id']; ?>"><i class="waves-effect material-icons font-red">delete</i></a></td>
						</tr>
		<?php
			} 
		}
		else
			{
		?>
			<tr>
				<td colspan="5" style="text-align:center;">Nenhuma categoria encontrada!</td>
			</tr>
		<?php
			}
		 ?>
	</tbody>
</table>