<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>


    
   <?php 
		$x = realpath(".")."/"; 
		$y = explode("/",substr($x,strpos($x,"/cms"))); 
		$a = strpos($y[1],"_"); 
	
		//fetch the common includes 
		if ($a === false) { 
			 require_once("/cms3prod_active/cds/uicomponents/common/include.php"); 
			$site_root="/$y[1]_$y[2]/$y[3]";
			$corporate_root="/cms3prod_active/corporate";
	
		} else { 
			 require_once("/$y[1]/$y[2]/uicomponents/common/include.php"); 
		 	$site_root="/$y[1]/$y[2]";
			 $corporate_root="/cms3prod_active/corporate";
		} 
		
		
		echo "<base href='".$sitebase."'/>"; 
		include($corporate_root."/uicomponents/mstoner/scripts/include_functions.php");
		include($corporate_root."/uicomponents/mstoner/scripts/spiff_loader2.php");
		echo "<!-- ".$_SERVER['SCRIPT_NAME']."-->\n\n";
		$sitename="Career Development Services";
   ?> 
              

 
<link rel="stylesheet" type="text/css" href="http://www.njit.edu/corporate/uicomponents/styles/njit.css" /> 
<link rel="stylesheet" type="text/css" href="http://www.njit.edu/corporate/uicomponents/styles/print.css" media="print" /> 

<!--[if lt IE 9]><script type="text/javascript" src="http://www.njit.edu/corporate/uicomponents/scripts/html5shim-1.6.2.min.js"></script><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="http://www.njit.edu/corporate/uicomponents/styles/ie/ie7.css" /><![endif]-->
<!--[if IE 6]><link rel="stylesheet" type="text/css" href="http://www.njit.edu/corporate/uicomponents/styles/ie/ie6.css" /><![endif]-->
<script type="text/javascript" src="http://use.typekit.com/khd0xmd.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>


<? 


if (preg_match("/corporate/",$sitebase)) {

}

else{

if(file_exists($site_root."/uicomponents/css/styles.css")){
							echo "<link href='".$sitebase."/uicomponents/css/styles.css' rel='stylesheet' type='text/css' media='screen' />"; } 

}


?>





<script type="text/javascript">


onloadfunctions = function() {
	
	

	
}

window.onload = onloadfunctions;
</script>

<meta http-equiv="X-UA-Compatible" content="IE=7"/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta name="robots" content="all" /> <!-- tell visiting robots it's OK to index this page --> 
<meta name="MSSmartTagsPreventParsing" content="true" /> <!-- disallow MS SmartTags --> 
<meta name="description" content="Parent/Guardian Guide to CDS" /> 
<meta name="keywords" content="" /> 
<title>NJIT: Career Development Services: Parent/Guardian Guide to CDS</title>


</head>
<body class="subpage wrap">
<?php include($corporate_root."/uicomponents/includes/header.php");?>


<header id="sectionheader">
	<div id="titlebar">
	<h1><a href="">Career Development Services</a></h1>
    </div>
</header>
<div id="content" class="container">
	<div id="left">
		<nav id="subnavigation">
				
				<? 
				 
				if(file_exists($site_root."/uicomponents/components/lhcol.php")){
					include($site_root."/uicomponents/components/lhcol.php");
				}
				elseif (file_exists($site_root."/uicomponents/components/menu.xhtml")){
					include($site_root."/uicomponents/components/menu.xhtml");
				}
				elseif (file_exists($site_root."/components/menu.xhtml")){
					include($site_root."/components/menu.xhtml");
				} 
				
				else {
				
				echo ('<script type="text/javascript">
					$("body").addClass("fullwidth");
					</script>');
				
				}
				
				?>
				
		</nav>
				<aside class="misc">
					
				</aside>
			
			
	</div>	
			
					
	<section id="main">
		
			
			<header>
				<h1>Parent/Guardian Guide to CDS</h1> 
				<div class="breadcrumb"><a href="/">Home</a> &#187; <a href="">Career Development Services</a></div>
			</header>
			
			 
			<div id="body">
				

				
			</div>
		
			<div class="misc">
				
			</div>
			
			<div class="sct_hidden" id="Code">
				
					
				<? 
					$source=trim("");
					$tempfilenamePHP = substr(str_replace("/","_", str_replace(".php","",$_SERVER['SCRIPT_NAME'])).".html",1);
					$tempURLnamePHP = $source;
				//	echo $tempfilenamePHP." ".$tempURLnamePHP." ".$source;
					if(strlen($source)>0){
								echo "<div class=\"extcontent\" id=\"extcontent\">";
								if(preg_match("/http:/",$tempURLnamePHP)){
									harvest($tempURLnamePHP, $tempfilenamePHP, $collegename); }
								else{
									include($tempURLnamePHP);
								}	
								echo "</div>";
					}
				?>
				
			</div>
		
	</section>			
					
		</div>
<?php include($corporate_root."/uicomponents/includes/footer.php");?>
<? 
$googleA = '';
if ($googleA != '')
{
	echo "<script type=\"text/javascript\">
	var gaJsHost = ((\"https:\" == document.location.protocol) ? \"https://ssl.\" : \"http://www.\");
	document.write(unescape(\"%3Cscript src='\" + gaJsHost + \"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E\"));
	</script>
	<script type=\"text/javascript\">
	try {
	var pageTracker = _gat._getTracker(\"".$googleA."\");
	pageTracker._trackPageview();
	} catch(err) {}</script>";
}
?>
</body>

</html>