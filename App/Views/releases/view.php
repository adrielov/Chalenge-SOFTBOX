<?php
	$release 				= 	$this->get("releases");
	$category 				= 	$this->get("category");
	$release['type_name'] 	= 	($release['type'] == "expense")?"Despesa":"Receita";
	$release['type']		= 	($release['type'] == "expense")?"trending_down":"trending_up";
	$type_color				= 	($release['type'] == "trending_down")?"font-red":"font-green";
?>
<ul class="collection bar-title">
	<li class="collection-item dismissable bg-blue">

		<ul class="right horizontal view-item">
	        <li><a href="/releases/edit/<?php echo $this->get("id"); ?>"><i class="material-icons" style="color:white!important">edit</i></a></li>
	        <li><a href="/releases/delete/<?php echo $this->get("id"); ?>"><i class="material-icons" style="color:white!important">delete</i></a></li>
	    </ul>
		<div><h5><i class="material-icons left" style="color:white!important">equalizer</i> Lançamento #<?php echo $this->get("id"); ?></h5></div>
	</li>
</ul>
<div class="col s6 no-padding">
	<table class="striped">
		<tbody>
			<tr>
				<td width="100"><b>Tipo:</b>
					<i class="material-icons <?php echo $type_color;?> right">
						<?php echo $release['type']; ?>
					</i>
				</td>
				<td><?php echo $release['type_name']; ?></td>
			</tr>
			<tr>
				<td width="100"><b>Categoria:</b></td>
				<td><?php echo $category['name']; ?></td>
			</tr>
			<tr>
				<td width="100"><b>Valor:</b></td>
				<td>R$ <?php echo $release['value']; ?></td>
			</tr>
			<tr>
				<td width="100"><b>Lançado em:</b></td>
				<td><?php echo $release['created_at']; ?></td>
			</tr>
		</tbody>
	</table>


</div>
<div class="col s6 no-padding">
	<blockquote style="margin:0px;">
		<?php echo $release['description']; ?>
	</blockquote>
</div>
