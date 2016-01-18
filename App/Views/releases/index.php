  <ul class="collection bar-title">
    <li class="collection-item dismissable bg-blue">
    	<div><a href="/releases/new" style="float:right"><i class="material-icons right font-white waves-effect ">add</i>Novo Lançamento</a></div>
    	<div>Lista de lançamentos</div>
    </li>
</ul>
<table class="striped">
	<thead>
		<tr>
			<th data-field="id" style="text-align:center;" width="50">#Id</th>
			<th data-field="name" style="text-align:left;" width="250">Descrição</th>
			<th data-field="name" style="text-align:left;" width="120">Valor</th>
			<th data-field="name" style="text-align:left;" width="120">Categoria</th>
			<th data-field="name" style="text-align:center;" width="50">Tipo</th>
			<th data-field="name" style="text-align:center;" width="230">Lançado em</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		if(is_array($this->get("releases"))) {
				foreach ($this->get("releases") as $release) {

						$categorya			=   new App\Models\CategoryModel();
						$categorya->id  	= 	$release['category_id'];
					    $resultCategory 	=  	$categorya->get();
						$release['type']	= 	($release['type'] == "expense")?"trending_down":"trending_up";
						$type_color	= 	($release['type'] == "trending_down")?"font-red":"font-green";
		?>
						<tr>
							<td style="text-align:center;"><?php echo $release['id']; ?></td>
							<td style="text-align:left;"><?php echo $this->textLimit($release['description']); ?></td>
							<td style="text-align:left;">R$ <?php echo $this->formartNumber($release['value']); ?></td>
							<td style="text-align:left;"><?php echo $resultCategory['name']; ?></td>
							<td style="text-align:center;"><i class="material-icons <?php echo $type_color;?>"><?php echo $release['type']; ?></i></td>
							<td style="text-align:center;"><?php echo $release['created_at']; ?></td>
	        				<td style="text-align:center;" width="30"><a href="/releases/view/<?php echo $release['id']; ?>"><i class="waves-effect material-icons font-blue">pageview</i></a></td>
	        				<td style="text-align:center;" width="30"><a href="/releases/edit/<?php echo $release['id']; ?>"><i class=" waves-effect material-icons font-purple">edit</i></a></td>
	        				<td style="text-align:center;" width="50"><a href="/releases/delete/<?php echo $release['id']; ?>"><i class="waves-effect material-icons font-red">delete</i></a></td>
						</tr>
		<?php
			} 
		}
		else
			{
		?>
			<tr>
				<td colspan="6" style="text-align:center;">Nenhuma categoria foi cadastada!</td>
			</tr>
		<?php
			}
		 ?>
	</tbody>
</table>