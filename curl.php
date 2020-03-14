<?php
function recibe_imagen ($url_origen,$archivo_destino){
	$mi_curl = curl_init ($url_origen);
	$fs_archivo = fopen ($archivo_destino, "w");
	curl_setopt ($mi_curl, CURLOPT_FILE, $fs_archivo);
	curl_setopt ($mi_curl, CURLOPT_HEADER, 0);
	curl_exec ($mi_curl);
	curl_close ($mi_curl);
	fclose ($fs_archivo);
}

function bajarimg($busqueda){
	$curl=curl_init();
	$busqueda1=$busqueda;
	$busqueda1=str_replace(" ","-",$busqueda1);
	$url="https://listado.mercadolibre.com.co/$busqueda1#D[A:$busqueda]";
	curl_setopt($curl,CURLOPT_URL,$url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$result=curl_exec($curl);
	preg_match_all("!https://http2.mlstatic.com/[^\s]*?.jpg!",$result,$match);
	$imagenes=array_values(array_unique($match[0]));

	for ($i=0; $i <count($imagenes) ; $i++) { 
		echo "<div style='float:left; margin :10 0 0 0;'>";
		echo "<img src='$imagenes[$i]'/>";
		echo "</div>";
	}
	curl_close($curl);
}
//echo recibe_imagen("https://scontent.fbaq6-1.fna.fbcdn.net/v/t1.0-9/88008615_696488417807466_5603373948231221248_n.jpg?_nc_cat=106&_nc_sid=110474&_nc_ohc=6QuCeTDqTCoAX_aFcTf&_nc_ht=scontent.fbaq6-1.fna&oh=949aa3e3e1ab8a6ccfa54ec9d66a356c&oe=5E92942E","File/mi_imagen.jpg");
echo bajarimg("computadores");
?>