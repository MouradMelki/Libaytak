<?php 
function searchQuery($location=null,$BR,$NbrOfPers=null,$Type=null,$surf_min=null,$surf_max=null,$rooms=null,$price_min=null,$price_max=null){
	
	global $mysqli;
	$exec = null;
	$AND = null;
		
	$query = "SELECT h.id,h.id_type,h.id_user,h.NbrOfPers,h.RentBuy,h.description,h.NbrOfRooms,h.NbrOfToilets,
				h.NbrOfBathrooms,h.surface,h.price,ht.habType,lh.id_locCity,lh.coorX,lh.coorY 
				FROM habitat h 
				INNER JOIN habitattypes ht on h.id_type = ht.id 
				INNER JOIN lochabitat lh on h.id = lh.id_habitat WHERE ";
	
	if($BR != null){
		$query = $query."h.RentBuy=$BR ";
		$AND = "AND";
	}
	
	if($NbrOfPers != null){
		$query = $query."$AND h.NbrOfPers=$NbrOfPers ";
		$AND = "AND";
	}
			
	if($Type != null){
		$query = $query."$AND ht.id='$Type' ";
		$AND = "AND";
	}
				
	if($surf_min != null && $surf_max != null && $surf_min<$surf_max){
		$query = $query."$AND h.surface BETWEEN $surf_min AND $surf_max ";
		$AND = "AND";
	}elseif($surf_min != null && $surf_max == null){
		$query = $query."$AND h.surface > $surf_min ";
		$AND = "AND";
	}elseif($surf_max != null && $surf_min == null){
		$query = $query."$AND h.surface < $surf_max ";
		$AND = "AND";
	}elseif($surf_min != null && $surf_max != null && $surf_min>=$surf_max){
		header("Location: search.php?errorSearch=1");
	}

	if($rooms != null && $rooms != 0){
		$query = $query."$AND NbrOfRooms=$rooms ";
		$AND = "AND";
	}

	if($price_min != null && $price_max != null && $price_min<$price_max){
		$query = $query."$AND h.price BETWEEN $price_min AND $price_max ";
		$AND = "AND";
	}elseif($price_min != null && $price_max == null){
		$query = $query."$AND h.price > $price_min ";
		$AND = "AND";
	}elseif($price_max != null && $price_min == null){
		$query = $query."$AND h.price < $price_max ";
		$AND = "AND";
	}elseif($price_min != null && $price_max != null && $price_min>=$price_max){
		header("Location: search.php?errorSearch=1");
	}

	if($location != null){
		$getLoc = "SELECT * FROM loccity WHERE city = '$location'";
		$result = $mysqli->query($getLoc);
		if(!$result)
			header("Location: search.php?errorSearch=1");
		else
			$row = $result->fetch_array();
		$query = $query."$AND lh.id_locCity = $row[id] ";
	}
	$exec = $mysqli->query($query);
	return $exec;
}
?>
