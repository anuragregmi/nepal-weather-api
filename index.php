<?php
/*
	Nepal-Weather-Api by Anurag Regmi.
*/


$no = 0;//global variable to store no of places

function get_weather($grp)
{
	$html = file_get_contents("http://mfd.gov.np/weather/"); // loads contents of weather page of Meteorological Forecasting Division Nepal.
	$html = substr($html,strpos($html,"<table"),(strpos($html,"</table>") - strpos($html,"<table"))); // fetches the table where is schedule
	$html = str_replace('</th></tr>','explode',$html); // replace operation to figure out end of each row
	$html = str_replace('</td></tr>','explode',$html); // replace operation
	$html = str_replace('</td>','\s',$html); //exchanges </td> with \s to it would be easy latter 
	$html = strip_tags($html);// removes html tag
	$html = str_replace('\s','&nbsp;',$html);// replaces earlier \s with &nbsp;
	$results = explode('explode',$html); // breacks each row so each member of array will contain info of a place $results[1] = info of 1 indexed place
	
	$noOfPlaces	= sizeof($results)-3;
	$GLOBALS['no'] = $noOfPlaces;
	for($i=1; $i<=$noOfPlaces; $i++)
	{
		$final[$i] = explode('&nbsp;',$results[$i]);//breaking into particular information of that place $final
	}
	
	$weather["status"] = "true";//sets status to true
	
	//converting index to value for the json formatt
	for($i=1; $i<=$noOfPlaces; $i++)
	{
		for($j=0; $j<=3 ; $j++)
		{
			if($j==0)
			{
				$weather[$i]["status"]= "true";
				$weather[$i]["place"]= $final[$i][$j];
			}

			else if($j==1)
			{
				$weather[$i]["max"]= $final[$i][$j]." C"; // + adding unit
			}

			else if($j==2)
			{
				$weather[$i]["min"]= $final[$i][$j]." C"; // + adding unit
			}

			else if($j==3)
			{
				if($final[$i][$j] != "Traces") 
				{	
					$weather[$i]["rain"]= $final[$i][$j]." mm"; // adding unit if not traces
				}
				
				else
				{
					$weather[$i]["rain"]= $final[$i][$j]; // if traces
				}
			}
		}
	}
	
	if ($grp === "all") //returns all data if argument is all
	{
		 return $weather;
	}
	
	else if($grp <= $noOfPlaces)
	{						
	 //for particular argument
		return $weather[$grp];
	}
	
	else
	{
		$weatherS["status"] = "false";
		$weatherS["msg"] = "sorry could not find that place";
		for ($n=1; $n<= $noOfPlaces;$n++)
		{
			$places[$n-1] = $weather[$n]["place"];
		}
		$weatherS["valid_places"] = $places;
		
		return $weatherS;
	}
}

function alltonepali(array $final)
{
	for($i=1; $i<=$GLOBALS['no']; $i++)
	{
		for($j=0; $j<=3 ; $j++)
		{
			if($j==0)//replacing name with nepali name
			{
				$weather[$i]["status"]= "true";
				if($i == 1)
				{
						$weather[$i]["place"] = "डढेलधुरा";
				}
				
				else if($i ==2)
				{
						$weather[$i]["place"] = "दिपाएल";
				}
				
				else if($i ==3)
				{
						$weather[$i]["place"] = "धनगढी";
				}
				
				else if($i ==4)
				{
						$weather[$i]["place"] = "बिरेन्द्र्नगर";
				}
				
				else if($i ==5)
				{
						$weather[$i]["place"] = "नेपालगञ्ज";
				}
				
				else if($i ==6)
				{
						$weather[$i]["place"] = "जुम्ला";
				}
				
				else if($i ==7)
				{
						$weather[$i]["place"] = "दाङ";
				}
				
				else if($i ==8)
				{
						$weather[$i]["place"] = "पोखरा";
				}
				
				else if($i ==9)
				{
						$weather[$i]["place"] = "भैरहवा";
				}
				
				else if($i ==10)
				{
						$weather[$i]["place"] = "सिमारा";
				}
				
				else if($i ==11)
				{
						$weather[$i]["place"] = "काठमाडौं";
				}
				
				else if($i ==12)
				{
						$weather[$i]["place"] = "ओखल्ढुङ्गा";
				}
				
				else if($i ==13)
				{
						$weather[$i]["place"] = "ताप्लेजुङ";
				}
				
				else if($i ==14)
				{
						$weather[$i]["place"] = "धनकुटा";
				}
				
				else if($i ==15)
				{
						$weather[$i]["place"] = "बिराटनगर";
				}
				
				else if($i ==16)
				{
						$weather[$i]["place"] = "जोम्सोम";
				}
				
				else if($i ==17)
				{
						$weather[$i]["place"] = "धरान";
				}
				
				else if($i ==18)
				{
						$weather[$i]["place"] = "लुम्ले";
				}
				
				else if($i ==19)
				{
						$weather[$i]["place"] = "जनकपुर";
				}
				
				else if($i ==20)
				{
						$weather[$i]["place"] = "जिरी";
				}
			}

			else if($j==1)
			{
		
				$weather[$i]["max"]= changenumbers($final[$i]["max"]); // + adding unit
			}

			else if($j==2)
			{
				$weather[$i]["min"]= changenumbers($final[$i]["min"]); // + adding unit
			}

			else if($j==3)
			{
				if($final[$i]["rain"] != "Traces") 
				{	
					$weather[$i]["rain"]= changenumbers($final[$i]["rain"]); // adding unit if not traces
				}
				
				else
				{
					$weather[$i]["rain"]= "फाटफुट"; // if traces
				}
			}
		}
	}

	return $weather;
}


function english($place)//for english
{
	$place = strtolower($place); //converting to lowercase
	
	//changing place name to place code
	
	if($place === "dadeldhura")
	{
		print_r(json_encode(get_weather(1)));
	}
	
	else if($place === "dipayal")
	{
		print_r(json_encode(get_weather(2)));
	}
	
	else if($place === "dhangadi")
	{
		print_r(json_encode(get_weather(3)));
	}
	
	else if($place === "birendranagar")
	{
		print_r(json_encode(get_weather(4)));
	}
	
	else if($place === "nepalgunj")
	{
		print_r(json_encode(get_weather(5)));
	}
	
	else if($place === "jumla")
	{
		print_r(json_encode(get_weather(6)));
	}
	
	else if($place === "dang")
	{
		print_r(json_encode(get_weather(7)));
	}
	
	else if($place === "pokhara")
	{
		print_r(json_encode(get_weather(8)));
	}
	
	else if($place === "bhairahawa")
	{
		print_r(json_encode(get_weather(9)));
	}
	
	else if($place === "simara")
	{
		print_r(json_encode(get_weather(10)));
	}
	
	else if($place === "kathmandu")
	{
		print_r(json_encode(get_weather(11)));
	}
	
	else if($place === "okhaldhunga")
	{
		print_r(json_encode(get_weather(12)));
	}
	
	else if($place === "taplejung")
	{
		print_r(json_encode(get_weather(13)));
	}
	
	else if($place === "dhankuta")
	{
		print_r(json_encode(get_weather(14)));
	}
	
	else if($place === "biratnagar")
	{
		print_r(json_encode(get_weather(15)));
	}
	
	else if($place === "jomsom")
	{
		print_r(json_encode(get_weather(16)));
	}
	
	else if($place === "dharan")
	{
		print_r(json_encode(get_weather(17)));
	}
	
	else if($place === "lumle")
	{
		print_r(json_encode(get_weather(18)));
	}
	
	else if($place === "janakpur")
	{
		print_r(json_encode(get_weather(19)));
	}
	
	else if($place === "jiri")
	{
		print_r(json_encode(get_weather(20)));
	}
	
	else if($place === "all")
	{
		print_r(json_encode(get_weather("all")));
	}
	
	else
	{
		$result = "{\"status\":\"false\",\"msg\":\"sorry could not find that place... please pass the place=[one of the valid places]\",\"valid_places\":['Dadeldhura','Dipayal','Dhangadi','Birendranagar','Nepalgunj','Jumla','Dang','Pokhara','Bhairahawa','Simara','Kathmandu','Okhaldhunga','Taplejung','Dhankuta','Biratnagar','Jomsom','Dharan','Lumle','Janakpur','Jiri']";

		echo $result;
	}
	
}



function nepali($place)
{
	$place = strtolower($place); //converting to lowercase
	
	//changing place name to place code
	
	if($place === "dadeldhura")
	{
		$wtr = get_weather(1);
		$wtr["place"] = "डढेलधुरा";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "dipayal")
	{
		$wtr = get_weather(2);
		$wtr["place"] = "दिपाएल";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "dhangadi")
	{
		$wtr = get_weather(3);
		$wtr["place"] = "धनगढी";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "birendranagar")
	{
		$wtr = get_weather(4);
		$wtr["place"] = "बिरेन्द्र्नगर";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "nepalgunj")
	{
		$wtr = get_weather(5);
		$wtr["place"] = "नेपालगञ्ज";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "jumla")
	{
		$wtr = get_weather(6);
		$wtr["place"] = "जुम्ला";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "dang")
	{
		$wtr = get_weather(7);
		$wtr["place"] = "दाङ";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "pokhara")
	{
		$wtr = get_weather(8);
		$wtr["place"] = "पोखरा";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "bhairahawa")
	{
		$wtr = get_weather(9);
		$wtr["place"] = "भैरहवा";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "simara")
	{
		$wtr = get_weather(10);
		$wtr["place"] = "सिमारा";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "kathmandu")
	{
		$wtr = get_weather(11);
		$wtr["place"] = "काठमाडौं";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "okhaldhunga")
	{
		$wtr = get_weather(12);
		$wtr["place"] = "ओखल्ढुङ्गा";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "taplejung")
	{
		$wtr = get_weather(13);
		$wtr["place"] = "ताप्लेजुङ";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "dhankuta")
	{
		$wtr = get_weather(14);
		$wtr["place"] = "धनकुटा";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "biratnagar")
	{
		$wtr = get_weather(15);
		$wtr["place"] = "बिराटनगर";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "jomsom")
	{
		$wtr = get_weather(16);
		$wtr["place"] = "जोम्सोम";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "dharan")
	{
		$wtr = get_weather(17);
		$wtr["place"] = "धरान";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "lumle")
	{
		$wtr = get_weather(18);
		$wtr["place"] = "लुम्ले";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "janakpur")
	{
		$wtr = get_weather(19);
		$wtr["place"] = "जनकपुर";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "jiri")
	{
		$wtr = get_weather(20);
		$wtr["place"] = "जिरी";
		$wtr["max"] = changenumbers($wtr["max"]);
		$wtr["min"] = changenumbers($wtr["min"]);
		if($wtr["rain"] === "Traces")
		{
			$wtr["rain"] = "फाटफुट";
		}
		else
		{
			$wtr["rain"] = changenumbers($wtr["rain"]);
		}
		
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
	}
	
	else if($place === "all")
	{
		$wtr = get_weather("all");
		$wtr = alltonepali($wtr);
		$wtr = json_encode($wtr,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		print_r($wtr);
		
	}
	
	else
	{
		$result = "{\"status\":\"false\",\"msg\":\"sorry could not find that place... please pass the place=[one of the valid places]\",\"valid_places\":[";
		$result = "{\"status\":\"false\",\"msg\":\"sorry could not find that place... please pass the place=[one of the valid places]\",\"valid_places\":['Dadeldhura','Dipayal','Dhangadi','Birendranagar','Nepalgunj','Jumla','Dang','Pokhara','Bhairahawa','Simara','Kathmandu','Okhaldhunga','Taplejung','Dhankuta','Biratnagar','Jomsom','Dharan','Lumle','Janakpur','Jiri']";

		echo $result;

	}
	
}


function changenumbers($strs)
{
	$strs = str_replace('0','०',$strs);
	$strs = str_replace('1','१',$strs);
	$strs = str_replace('2','२',$strs);
	$strs = str_replace('3','३',$strs);
	$strs = str_replace('4','४',$strs);
	$strs = str_replace('5','५',$strs);
	$strs = str_replace('6','६',$strs);
	$strs = str_replace('7','७',$strs);
	$strs = str_replace('8','८',$strs);
	$strs = str_replace('9','९',$strs);
	
	return $strs;
}

if(isset($_GET['placenp']))
{
	nepali($_GET['placenp']);
}

else if(isset($_GET['place']))
{
	english($_GET['place']);
	
}

?>
