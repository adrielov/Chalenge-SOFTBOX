<?php
namespace App\Helpers;

class Utils {
	public static function textLimit($string,$size) {
		$string = (strlen($string) <= $size)?$string:substr($string, 0, $size).'...';
		return $string;
	}

	public static function formatNumber($value) {
		return number_format($value, 2, ',', '.');
	}

	static function generateBreadCrumb() {
		$path = $_SERVER["REQUEST_URI"];
		$def = "index";
		$dChunks = explode("/", $path);
		$dChunkcount = count($dChunks);
		echo '<a href="/" class="breadcrumb" >Painel</a>';

		for($i=1; $i<$dChunkcount; $i++) {
			echo "<a href=\"/";
			for($j=1; $j<=$i; $j++) {
				echo $dChunks[$j];
				if($j!=$dChunkcount-1) {
					print "/";
				}
			}

			if($i==$dChunkcount-1) {
				$prChunks = explode(".", $dChunks[$i]);
				$prChunks = str_replace(
					array('releases','view','category','new','edit','find'),
					array('Lançamentos','Visualizar','Categoria','Cadastrar','Editar','Procurar'), $prChunks);

				if ($prChunks[0] == $def) {
					$prChunks[0] = "";
				}
				$prChunks[0] = $prChunks[0] . "</a>";
			} else {
				$dChunks[$i] = str_replace(
					array('releases','view','category','new','edit','find'),
					array('Lançamentos','Visualizar','Categoria','Cadastrar','Editar','Procurar'), $dChunks[$i]);

				$prChunks[0]=$dChunks[$i] ."</a>";
			}

			echo "\" class=\"breadcrumb\" >";
			echo str_replace("_" , " " , $prChunks[0]);
		}
	}
}