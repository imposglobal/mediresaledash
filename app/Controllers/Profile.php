<?php

namespace App\Controllers;
use App\Models\LoginModel;
use App\Models\CommonModel;



class Profile extends BaseController
{

   
   
  public function profile()
  {

    
      return view('profile/profile');
  }

  

}
