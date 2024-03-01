<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    //

  public function index(Request $request)
  {
    //  dd(request()->path());

    if(request()->path()=='/'){
      return redirect('/project', 301);
    }



    $pageConfigs = ['pageHeader' =>true,'layoutWidth' => 'full'];


    return view('/content/project/home', ['pageConfigs' => $pageConfigs]);
  }
}
