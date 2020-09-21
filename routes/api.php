<?php

use App\Category;
use App\Course;
use App\Language;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', 'API\AuthController@login');
Route::post('register', 'API\AuthController@register');
 
Route::middleware('auth:api')->group(function(){
 
  Route::post('user_detail', 'API\AuthController@user_detail');
  
});

Route::group(['prefix'=>'man'], function ($router) {
  
  Route::post('category', 'API\ManageEntries@manCategory');
  Route::post('language', 'API\ManageEntries@manLanguage');
  Route::post('course', 'API\ManageEntries@manCourse');
  Route::post('lesson', 'API\ManageEntries@manLesson');
  Route::post('delete', 'API\ManageEntries@delEntrie');
  
});

Route::get('admin', function (Request $req)
{

//$user=User::find(auth()->user()->id);

//if ($user->role_id==1) {
    
    $cours=Course::where('id', '>', 0)->orderBy('id', 'desc')->get();
    $users=User::where('id', '>', 0)->orderBy('id', 'desc')->get();
    $cat=Category::where('id', '>', 0)->orderBy('id', 'desc')->get();
    $langs=Language::where('id', '>', 0)->orderBy('id', 'desc')->get();


foreach ($users as $key=> $user)
    $user->role;

foreach ($cours as $key=> $cour){
    $cour->languages;
    $cour->categories;
    $cour->lessons;
}


return response()->json(
[
    "course"=>$cours,
    "users"=>$users,
    "categories"=>$cat,
    "langs"=>$langs
]);
//}
});

Route::post('user-data', function (Request $req)
{
    $case=$req->input('case');

    if($case===0){
      $cours=Course::where('id', '>', 0)->orderBy('id', 'desc')->get();

      foreach ($cours as $key=> $cour){
        $cour->languages;
        $cour->categories;
        $cour->lessons;
     }
    return response()->json(["courses"=>$cours]);
    }else{
      $user=User::find(auth()->user()->id);
      $lessons=$user->lessons();
      foreach ($lessons as $key=> $lesson)
            $lesson->course;

      return response()->json(
        [
            "lessons"=>$lessons,
            "tests"=>$user->tests(),
            "practiceq"=>$user->practices()
            
        ]);
    }
}
);

Route::get("test",function () {

    return response()->json(["Test Api"=>"Success!"]);
});
