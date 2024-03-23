<?php

namespace App\Http\Controllers;

use App\Models\Project;
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

  public function list(Request $request)
  {
      $columns = [
          1 => 'id',
          2 => 'title',
          3 => 'email',
          4 => 'email_verified_at',
      ];

      $search = [];

      $totalData = Project::count();

      $totalFiltered = $totalData;

      $limit = $request->input('length');
      $start = $request->input('start');
      $order = $columns[$request->input('order.0.column')];
      $dir = $request->input('order.0.dir');

      if (empty($request->input('search.value'))) {
          $projects = Project::offset($start)
              ->limit($limit)
              ->orderBy($order, $dir)
              ->get();
      } else {
          $search = $request->input('search.value');

          $projects = Project::Where('title', 'LIKE', "%{$search}%")
              ->offset($start)
              ->limit($limit)
              ->orderBy($order, $dir)
              ->get();

          $totalFiltered = Project::Where('title', 'LIKE', "%{$search}%")
              ->count();
      }

      $data = [];

      if (!empty($projects)) {
          // providing a dummy id instead of database ids
          $ids = $start;

          foreach ($projects as $project) {
              $nestedData['id'] = $project->id;
              $nestedData['fake_id'] = ++$ids;
              $nestedData['name'] = $project->title;
              $nestedData['email'] = $project->title;

              $data[] = $nestedData;
          }
      }

      if ($data) {
          return response()->json([
              'draw' => intval($request->input('draw')),
              'recordsTotal' => intval($totalData),
              'recordsFiltered' => intval($totalFiltered),
              'code' => 200,
              'data' => $data,
          ]);
      } else {
          return response()->json([
              'message' => 'Internal Server Error',
              'code' => 500,
              'data' => [],
          ]);
      }
  }
}
