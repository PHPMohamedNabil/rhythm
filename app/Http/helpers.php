<?php

if(!function_exists('bread_crump'))
{
	function bread_crump($base_link,$links)
	{
		if(is_array($base_link) && is_array($links) )
		{
			
          $bread_crump='<ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="'.$base_link['link'].'">'.$base_link['name'].'</a></li>';

			foreach ($links as $name => $link)
			{
			   if(strstr($name,'.end'))
			   {
			   	 $bread_crump.='<li class="breadcrumb-item active" aria-current="page">'.strstr($name,'.end',true).'</li>';
			   }
			   else{
			   	 $bread_crump.='<li class="breadcrumb-item"><a href="'.$link.'">'.$name.'</a></li>';
			   }

			   	
			}

			$bread_crump.='</ol>';

			return $bread_crump;

		}

		return null;
		
	}

	

}


    function category_bread($parent_id,$categories)
    {
        foreach($categories as $category)
        {
               if($category->category_id == $parent_id)
               {
                   
               }
        }

    }


/* etc ... */

function GetVolumeLabel($drive) {
  // Try to grab the volume name
  if (preg_match('#Volume Serial Number is (.*)\n#i', shell_exec('dir '.$drive.':'), $m)) {
    $volname = ' ('.$m[1].')';
  } else {
    $volname = '';
  }
return $volname;
}

if(!function_exists('getHddSerial'))
{
	function getHddSerial()
    {
       $serial =  shell_exec('wmic DISKDRIVE GET SerialNumber 2>&1');

       $all_hdd_drivers_serial_numbers=array_filter(explode(' ',trim(str_replace(PHP_EOL,'',$serial))));
        
         return end($all_hdd_drivers_serial_numbers);
    }
}



    function filewrite($file,$data)
    {            
          return  file_put_contents($file,$data);
    }


    function getfiledata($file)
    {    
        if (file_exists($file))
        {
             $data=file_get_contents($file);

              return $data;
        }

    }

    function make_file($path,$data)
    {    
        // $data=getfiledata(DATABASE.'user_info.json');
         //$array=json_decode($data,true);

       return   filewrite($path,$data);
    }

    

    function is_image($image)
    {  
        $case=false;

       if (is_file($image))
       {
    	   if (function_exists('finfo_open') === true)
           {
               $finfo = finfo_open(FILEINFO_MIME_TYPE);

               if (is_resource($finfo) === true)
               {
                      $result = finfo_file($finfo, $image);

                      if (strstr($result,'image/'))
                      {
                      	 $case=true;
                      }
               }

                  finfo_close($finfo);
           }
       }       
            
          return $case;
       

    }



