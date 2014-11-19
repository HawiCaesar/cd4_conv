<?php
require_once("../../includes/dbConf.php");
require('../../Connections/config.php');
	$aColumns = array( 'AutoID', 'MFLCode', 'fname', 'districtname', 'countyname','centralsitename','distance','typename','rolloutstatus','level' );
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "AutoID";
	
	/* 
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
			intval( $_GET['iDisplayLength'] );
	}
	
	
	/*
	 * Ordering
	 */
	$sOrder = "";
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
					($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "WHERE f.district=d.ID AND f.AutoID=fp.facility ";
	$swhere1="";
	if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
	{
		$sWhere .= "AND (";
		$swhere1=" WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
			$sWhere1 .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere1 = substr_replace( $sWhere1, "", -3 );
		$sWhere .= ')';
		$sWhere1 .= ')';
	}
	
	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}
	 $sTable="from facility f, facilitypatients fp, districts d WHERE f.district=d.ID AND f.AutoID=fp.facility";

	 $sql="select * from facility f, facilitypatients fp, districts d $sWhere $sOrder $sLimit";
	 
			$executeSql=mysql_query($sql) or die(mysql_error());
			/* Data set length after filtering */
			$sQuery = "
				select count(*) from facility f, facilitypatients fp, districts d $sWhere $sOrder 
			";
			$rResultFilterTotal = mysql_query( $sQuery) or die(mysql_error());
			$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
			$iFilteredTotal = $aResultFilterTotal[0];
			
			/* Total data set length */
			$sQuery = "
				SELECT COUNT(`".$sIndexColumn."`)
				$sTable
			";
			$rResultTotal = mysql_query( $sQuery) or die(mysql_error());
			$aResultTotal = mysql_fetch_array($rResultTotal);
			$iTotal = $aResultTotal[0];
			
			/*
			 * Output
			 */
			$output = array(
				"sEcho" => intval($_GET['sEcho']),
				"iTotalRecords" => $iTotal,
				"iTotalDisplayRecords" => $iFilteredTotal,
				"aaData" => array()
			);
			
			$mytab="";
			while($row1 = mysql_fetch_array($executeSql))  {
				$row = array();
				
				if($row1['level']==1){
				$type="Satellite";	
				} 
				else{
					$type="Central";
					} 
                if($row1['rolloutstatus']==1){
                	$state=0;
                	$status="Rolled Out &nbsp;".'<a href="rollout.php?id='.$row1['AutoID'].'& name='.$row1['fname'].'& status='.$state.'"><img src="../../img/close.gif" width="15" height="15"></a>';
                }
				else {
					$state=1;
					$status="Not Rolled &nbsp;".'<a href="rollout.php?id='.$row1['AutoID'].'& name='.$row1['fname'].'& status='.$state.'"><img src="../../img/msg-ok.gif" width="15" height="15"></a>';
				}
				
				$page_to= "' Are you sure you want to delete Facility " .$row1['fname']."'"; 	
				$patna=getSpecificPartner($row1['partnerID']);	

				$row[]=$row1['AutoID'];
				$row[]=$row1['MFLCode'];
				$row[]=$row1['fname'];
				$row[]=$row1['districtname'];
				$row[]=$row1['countyname'];
				$row[]=$type;
				$row[]=$row1['centralsitename'];
				$row[]=$row1['distance'];
				$row[]=$row1['typename'];
				$row[]=$patna[1];
				$row[]='<a href="resetpass.php?id='.$row1['AutoID'].'" title="Edit User">Reset</a>';
				$row[]=$status;
				$row[]='<a href="edit.php?id='.$row1['AutoID'].'" title="Edit User"><img src="../../img/edit.png"/></a>|<a href="delete.php?id='.$row1['AutoID'].'& name='.$row1['fname'].'"  onclick="return confirm('.$page_to.');" title="Delete User"><img src="../../img/delete.png"/></a>';
				
				$output['aaData'][] = $row;
            
				}
			echo json_encode( $output );


?>