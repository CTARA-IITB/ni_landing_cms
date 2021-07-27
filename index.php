<?php
	require_once 'config.php';
	require_once 'functions.php';
	
	$arr_lc = getCategoriesAndIndicators();
	//echo "<pre>";
	//print_r($arr_lc);
	
	$arr_upt = getAllUpdates();
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<title>Nutrition India</title>

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link href="<?php echo VENDOR_WEBROOT;?>fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/responsive.css">
</head>
<body>
<div class="container-fluid px-0">
	<div class="p-3 top_head sticky">
		<div class='float-left w-50'><a href="https://www.mohfw.gov.in/" target="_blank"><img class='mfa' src='images/mhf.png'/></a></div>
		<div class='float-right w-50'><a href="http://poshanabhiyaan.gov.in/#/" target="_blank"><img class='pa' src='images/pa.png'/></a></div>
	</div>
	<div class="p-3 col-12">
		<div class='text-center align-content-center for-mobile align-items-center'>
			<!-- <div class="yellow-round-big"></div> -->
			<div class="pt-4 col-md-12 col-lg-6 col-12 float-left for-mobile-1 display-none-desktop pb-ipad">
				<div class="col-md-12 col-lg-6 col-12 nutrition-logo"></div>
			</div>
			<div class="pt-4 col-md-12 col-lg-6 col-12 float-left for-mobile-3">
				<div class="nutrition-logo display-none-mobile"></div>
				<div class="head-content">

			<!--	<div class="updates-div-heading">
						UPDATES
				</div> -->
					<div class="updates-div">
						<div class="div-carousel-updates">
							<div id="carousel_updates" class="carousel slide" data-ride="carousel" data-interval="20000">
								<div class="carousel-inner">
<?php
	$i=0;
	foreach($arr_upt as $k => $arr_uptval)
	{
		if($i == 0)
			echo "<div class='carousel-item active'>";
		else 
			echo "<div class='carousel-item'>";
		
		echo $arr_uptval['upt_desc'];
		//if(!empty($arr_uptval['upt_url']))
		//{
			//echo "<a class='px-2 color-yellow' href='".$arr_uptval['upt_url']."' target='_blank'></a>";
		//}
		echo "</div>";
		$i++;
	}
?>

								</div>
							</div>
							
						</div>
						<div><a class="carousel-control-next" href="#carousel_updates" role="button" data-slide="next">
    <span class="color-yellow fa fa-arrow-circle-right" aria-hidden="true"><i class=''></i></span>
    <span class="sr-only">Next</span>
  </a></div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-12 float-left for-mobile-2">
				<div class="yellow-round-big"></div>
				<div class="yellow-round-small"></div>
				<div class="div-carousel">
					<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" data-interval="6000000">
					  <div class="carousel-inner">
						<div class="carousel-item active">
						  <img class="d-block c-image" src="images/carousel/c1.png" alt="First slide">
						</div>
						<div class="carousel-item">
						  <img class="d-block c-image" src="images/carousel/c2.png" alt="Second slide">
						</div>
						<div class="carousel-item">
						  <img class="d-block c-image" src="images/carousel/c3.png" alt="Third slide">
						</div>
						
						<div class="carousel-item">
						  <img class="d-block c-image" src="images/carousel/c4.png" alt="Fourth slide">
						</div>
					  </div>
					</div>
				</div>
				<div class="i-icon"><a href="/reports/cnns-factsheets/" target="_blank"><img src="images/i-icon.png" class="img-width"></a></div>
			</div>
		</div>
	</div>
	<div class="clear text-center pt-4"><img src="images/downarrow.png" class="display-none-desktop"></div>
	<div class="col-12 col-lg-12 lifecycle-bg">
		<div class="pt-3 pl-4 lifecycle-head">Lifecycles</div>
		<div class="row d-flex justify-content-center pt-3">
			<div class="col-4 col-lg-12 p-0">
				<div class="set">
<?php
	if(count($arr_lc) > 0)
	{
		$str_lc_details = array();
		
		foreach($arr_lc as $lcid => $arr_vals)
		{
			if($arr_vals['lc_default'] > 0)
			{
				$disabled = "enabled";
				$lifecyclesubhead = "lifecycle-subhead-selected  mobile-subhead-hide";
				$d2_class = "lifecycle-div-selected";
				$img_selected = "lifecycle-image-selected";
				$alignselfend = "align-self-end";
				
			}
			else 
			{
				$disabled = "disabled";
				$lifecyclesubhead = "lifecycle-subhead";
				$d2_class = "";
				$img_selected= "lifecycle-image";
				$alignselfend = "align-self-end";
			}
			
			//if(array_key_last($arr_lc))  $last-lc = " last-lc";
			
?>
					<div id="d1_<?php echo $lcid; ?>" class="pt-2 mr-1 float-left text-center cursor-pointer <?php echo $alignselfend; ?> w-lc" onclick="show(this);">
						<!-- <a href="javascript: void(0);" > -->
						<div id="d2_<?php echo $lcid; ?>"  class="<?php echo $d2_class; ?>">
							<img id="img_<?php echo $lcid; ?>" class="<?php echo $img_selected; ?>" src='<?php echo IMAGES_WEBROOT.'lifecycle/'.$arr_vals['lc_image']; ?>'>
						</div>
						<div id="d3_<?php echo $lcid; ?>" class="<?php echo $lifecyclesubhead; ?> text-center"><?php echo $arr_vals['lc_name']; ?></div>
						<!-- </a> -->
					</div>
<?php
			
			if(!empty($arr_vals['lc_url']))
			{
				//$lc_url = "<br><a href='".$arr_vals['lc_url']."' target='_blank'>Click Here</a> to view the graphs";
			}
			
			$str_lc_details[$lcid] = '
			
			<div id="div_detail_'.$lcid.'" class="col-12 col-lg-12 '.$disabled.' padding-rightleft ">
				<div class="tab-content">
					<div class="display-desktop-catimg text-center pb-3">
						<img class="lifecycle-detail-img" src="'.IMAGES_WEBROOT.'lifecycle/'.$arr_vals['lc_image'].'">
						<div class="lifecycle-detail-img-text">
							<div class="text-green display-none-desktop">'.$arr_vals['lc_name'].'</div>
						</div>
					</div>
					<div id="lc_desc_'.$lcid.'" class="display-desktop-cattext py-2 display-none-mobile-lifecycle">
						'.$arr_vals['lc_desc'].$lc_url.'
					</div>
					<div class="row col-lg-12 d-flex justify-content-center pb-3 div-category">';
					$cnt = count($arr_vals['category']);
					if($cnt < 1) $cnt = 1;
					$cols = 12/$cnt;
					
					foreach($arr_vals['category'] as $catid =>$arr_catval )
					{
						$str_lc_details[$lcid] .= '
						<div class="col-12 col-lg-'.$cols.' bgcolor-white p-content border-5px mobile-style">
							<div id="div_cat_'.$lcid."_".$catid.'" class="lifecycle-subhead-2">'.$arr_catval['cat_name'].'</div>
							<div id="div_ind_'.$catid.'" class="">
								<div class="pt-3 display-none-mobile">'.$arr_catval['cat_desc'].'</div>';
						foreach($arr_catval['indicator'] as $indid => $arr_indval)
						{
							$str_lc_details[$lcid] .= '
								<a class="indicators float-left m-1 p-1" href="'.$arr_indval['ind_url'].'" target="_blank">'.$arr_indval['ind_name'].'</a>
							';
						}
						
						$str_lc_details[$lcid] .= '
							</div>
						</div>';
					}
			$str_lc_details[$lcid] .= '	
					</div>
				</div>
			</div>
		';
		}
	}
	
?>
				</div>
			</div>

<?php 

echo "<div class='col-7 col-lg-11 lifecycle-detail-bg'>";
echo implode("", $str_lc_details); 
echo "</div>";
echo "";
?>

		</div>
	<div class='h-05'>&nbsp;</div>
	</div>
</div>
	<footer class="footer p-0 mt-4">
		<div class="row  p-0 m-0 align-items-center">
			
			<div class="col-4">
				<a href="https://nutritionindia.info/" target="_blank"><img src="<?php echo IMAGES_WEBROOT; ?>nutrition-logo-footer.svg" class="nutrition-image"></a>
			</div>
			<div class="col-4">
				<a href="https://www.ctara.iitb.ac.in/" target="_blank"><img src="<?php echo IMAGES_WEBROOT; ?>ctara-logo.png" title="CTARA" class="iitb-image"></a>
			</div>
			<div class="col-4">
				<a href="http://unicef.in/" target="_blank"><img src="<?php echo IMAGES_WEBROOT; ?>unicefLogo.png"  class="unichef-image"></a>
			</div>
		</div> 
	</footer>

</body>
<script src='js/jquery36.min.js'></script>
<script src='js/bootstrap.min.js'></script>
<script>
	function show(ele)
	{
		//alert(ele.id);
		var id = ele.id;
		var splitid = id.split("_");
		var org_id = splitid[1];
		
		var d1 = "#d1_" + org_id;
		var d2 = "#d2_" + org_id;
		var d3 = "#d3_" + org_id;
		var img_id = "#img_" + org_id;
		var detail_id = "#div_detail_"+ org_id;
		
		$("a[id^=d1]").removeClass('align-self-end');
		$("div[id^=d2]").removeClass('lifecycle-div-selected');
		$("img[id^=img_]").removeClass('lifecycle-image-selected');
		$("img[id^=img_]").addClass('lifecycle-image');
		$("div[id^=d3]").removeClass('lifecycle-subhead-selected');
		$("div[id^=d3]").removeClass('mobile-subhead-hide');
		$("div[id^=d3]").addClass('lifecycle-subhead');
		//$("div[id^=d3]").addClass('p-2');
		//$("div[id^=d2]").addClass('p-2');
		
		$("div[id^=div_detail_]").removeClass('enabled');
		$("div[id^=div_detail_]").addClass('disabled');
		
		$(d1).addClass('align-self-end');
		$(d2).addClass('lifecycle-div-selected');
		$(img_id).removeClass('lifecycle-image');
		$(img_id).addClass('lifecycle-image-selected');
		$(d3).removeClass('lifecycle-subhead');
		//$(d3).removeClass('p-2');
		//$(d2).removeClass('p-2');
		$(d3).addClass('lifecycle-subhead-selected mobile-subhead-hide');
		$(detail_id).addClass('enabled');
		
		//alert(navigator.userAgent);

		if (/Mobi|Android/i.test(navigator.userAgent))
		{
			//alert("no");
			$('html, body').animate({
				scrollTop: $(".lifecycle-head").offset().top
			}, 1000);
		}
		else 
		{
			//alert("yes");
			$('html, body').animate({
				scrollTop: $(d3).offset().top
			}, 1000);
		}
	}
	
	$("div[id^='div_cat_']").click(function () {
		var id = $(this).prop("id").split("_");
		var last = id[id.length - 1];
		var lcid = id[id.length - 2];
		var ind_class = $("div[id='div_ind_"+last+"']").attr('class');
		if(ind_class == 'display-none-mobile-lifecycle')
		{
			$("div[id='div_ind_"+last+"']").removeClass('display-none-mobile-lifecycle');
			$("div[id='div_ind_"+last+"']").addClass('display-block-mobile-lifecycle');
			$("div[id='lc_desc_"+lcid+"']").addClass('disabled');
			$("div[id='lc_desc_"+lcid+"']").removeClass('enabled');
		}
		else 
		{
			$("div[id='div_ind_"+last+"']").removeClass('display-block-mobile-lifecycle');
			$("div[id='div_ind_"+last+"']").addClass('display-none-mobile-lifecycle');
			$("div[id='lc_desc_"+lcid+"']").addClass('enabled');
			$("div[id='lc_desc_"+lcid+"']").removeClass('disabled');
		}
	});
</script>
</html>
