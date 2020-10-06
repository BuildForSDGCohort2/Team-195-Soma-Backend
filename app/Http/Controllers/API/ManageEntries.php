<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Course;
use App\CourseCatLang;
use App\Grade;
use App\Http\Controllers\Controller;
use App\Language;
use App\Lesson;
use App\Role;
use App\Student;
use App\Test;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageEntries extends Controller{
    //class to manage(add,update) the entries

    protected $message=null;

    public function __construct()
    {
        
    }

    public function manRole(Request $req)
    {
        //Function to manage the lessons(add,update)
            $id=$req->input('id');$role=null;
        if($id==null){
            //if not exists add the category
            $role=Role::create(
            [
                'name'=>$req->input('name'),
            ]
            );
            $message="role added Successfully!";
        }else
        {   //if exists update the category
            $message="role updated Successfully!";
            $role=Role::find($id);
            $role->name=$req->input('name');
            
            $role->save();
        }
        
        return response()->json(["message"=>$message,"role_id"=>$role->id]);
    }


    public function manCategory(Request $req)
    {
        //Function to manage the lessons(add,update)
            $id=$req->input('id');$category=null;
        if($id==null){
            //if not exists add the category
            $category=Category::create(
            [
                'name'=>$req->input('name'),
                'code'=>$req->input('code'),
            ]
            );
            $message="category added Successfully!";
        }else
        {   //if exists update the category
            $message="category updated Successfully!";
            $category=Category::find($id);
            $category->name=$req->input('name');
            $category->code=$req->input('code');
            
            $category->save();
        }
        
        return response()->json(["message"=>$message,"category_id"=>$category->id]);
    }

    public function manLanguage(Request $req)
    {
        //Function to manage the language(add,update)
            $id=$req->input('id');$language=null;
        if($id==null){
            //if not exists add the language
            $language=Language::create(
            [
                'name'=>$req->input('name'),
                'country'=>$req->input('country'),
            ]
            );
            $message="Language added Successfully!";
        }else
        {   //if exists update the language
            $message="Language updated Successfully!";
            $language=Language::find($id);
            $language->name=$req->input('name');
            $language->country=$req->input('country');
            
            $language->save();
        }
        
        return response()->json(["message"=>$message,"language_id"=>$language->id]);
    }

    public function manCourse(Request $req)
    {
        //Function to manage the courses(add,update)
        $id=$req->input('id');$cours=null;
        if($id==null){
            //if not exists add the course
            $course=Course::create(
            [
                'name'=>$req->input('name'),
                'description'=>$req->input('description'),
            ]
            );

            CourseCatLang::create(
                [
                    'course_id'=>$course->id,
                    'language_id'=>$req->input('language'),
                    'category_id'=>$req->input('category')
                ]
                );
            $message="Course added Successfully!";
        }else
        {   //if exists update the course
            $message="Course updated Successfully!";

            $course=Course::find($id);
            $course->name=$req->input('name');
            $course->description=$req->input('description');
            $course->save();
        }
        
        return response()->json(["message"=>$message,"course_id"=>$course->id]);
    }

    public function manLesson(Request $req)
    {
        //Function to manage the lessons(add,update)
            $id=$req->input('id');$lesson=null;
        if($id==null){
            //if not exists add the lesson
            $lesson=Lesson::create(
            [
                'name'=>$req->input('name'),
                'lesson_number'=>$req->input('lesson_number'),
            ]
            );
            $message="Lesson added Successfully!";
        }else
        {   //if exists update the lesson
            $message="Lesson updated Successfully!";
            $lesson=Lesson::find($id);
            $lesson->course()->dissociate();
            $lesson->name=$req->input('name');
            $lesson->lesson_number=$req->input('lesson_number');
            
            $lesson->save();
        }
        $course=Course::find($req->input('course'));
        $lesson->course()->associate($course);
        $lesson->save();
        return response()->json(["message"=>$message,"lesson_id"=>$lesson->id]);
    }


    public function manTest(Request $req)
    {
        $id=$req->input('id');$test=null;
        if($id==null){
            $test=Test::create(
                [ 
                    'question'=>$req->input('question'),  
                    'options'=>$req->input('optionTxt'),
                    'choice'=>$req->input('choice.value'),
                    'answer'=>$req->input('answer')
                ]
          );
          $message="test added Successfully!";
        }else
        {
            $test=Test::find($id);
            $test->modules()->dissociate();
            
            $test->update
            ([
                'question'=>$req->input('question'),  
                'options'=>$req->input('optionTxt'),
                'choice'=>$req->input('choice.value'),
                'answer'=>$req->input('answer')
            ]);
            
            $message="test updated Successfully!";
        }

        $course=Course::find($req->input('course'));
        $test->modules()->associate($course);
        
        $test->save();
        return response()->json(["message"=>$message,"test_id"=>$test->id]);
    }

    public function addGrade(Request $req)
    {
        $gr=Grade::where([["course_id",$req->input('course')],
                    ["user_id",auth()->user()->id]])->get();

        if(count($gr)<=0){
            $grade=Grade::create(
                [ 
                    'grade'=>$req->input('grade'),
                    
                ]
          );
          $message="Grade added Successfully!";
       

        $user=User::find(auth()->user()->id);
        $course=Course::find($req->input('course'));
        $grade->user()->associate($user);
        $grade->user()->associate($course);
        
        $grade->save();
        return response()->json(["message"=>$message,"grade "=>$gr]);
        }

        return response()->json(["message"=>"Test exists"]);
    }

    public function studentActivities(Request $req)
    {

        
            $student=Student::create(
                [ 
                    'lesson_id'=>$req->input('lesson'),
                    'user_id'=>auth()->user()->id
                ]
          );
          $message="Grade added Successfully!";
       

        
        return response()->json(["message"=>$message,"grade "=>$gr]);
    }


    public function delEntrie(Request $req)
    {
        # code...
        $table=$req->input('table');
        DB::table($table)->where('id', $req->input('id'))->delete();

        return response()->json("Entrie deleted succesfully! ");
    }
}

?>