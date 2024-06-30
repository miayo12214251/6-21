<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Person;
use App\Models\Post;
use Carbon\Carbon;

class PersonController extends Controller
{
    
    public function index(Person $person)
    {
        // Person に紐づく全ての投稿を取得（作成日の降順で取得）
        $posts = $person->posts()->orderBy('created_at2', 'DESC')->paginate(5);

        // 月別のアポ数、商談数、成約数の統計データを取得
        $appointmentsData = $person->posts()
            ->selectRaw('DATE_FORMAT(created_at2, "%Y-%m") as month_year')
            ->selectRaw('SUM(appointment) as total_appointment')
            ->groupBy('month_year')
            ->get();


        $meetingsData = $person->posts()
            ->selectRaw('DATE_FORMAT(created_at2, "%Y-%m") as month_year, SUM(meeting) as total_meeting')
            ->groupBy('month_year')
            ->orderBy('month_year')
            ->get();

        $contractsData = $person->posts()
            ->selectRaw('DATE_FORMAT(created_at2, "%Y-%m") as month_year, SUM(contract) as total_contract')
            ->groupBy('month_year')
            ->orderBy('month_year')
            ->get();

        return view('person.index')->with([
            'posts' => $posts,
            'appointmentsData' => $appointmentsData,
            'meetingsData' => $meetingsData,
            'contractsData' => $contractsData,
        ]);
    }
     
   public function team(Person $team)
{
    // Personモデルに紐づく投稿を取得し、チームごとに集計する
    $posts = DB::table('posts')
                ->join('person', 'posts.person_id', '=', 'person.id')
                ->where('person.team', $team->team) // $team->team はチーム名やIDに置き換える必要があります
                ->orderBy('posts.created_at2', 'desc')
                ->paginate(5);
                
    // チームごとの月別のアポ数、商談数、成約数の統計データを取得
    $appointmentsData = $team->posts()
            ->selectRaw('DATE_FORMAT(created_at2, "%Y-%m") as month_year')
            ->selectRaw('SUM(appointment) as total_appointment')
            ->groupBy('month_year')
            ->get();


        $meetingsData =  $team->posts()
            ->selectRaw('DATE_FORMAT(created_at2, "%Y-%m") as month_year, SUM(meeting) as total_meeting')
            ->groupBy('month_year')
            ->orderBy('month_year')
            ->get();

        $contractsData =  $team->posts()
            ->selectRaw('DATE_FORMAT(created_at2, "%Y-%m") as month_year, SUM(contract) as total_contract')
            ->groupBy('month_year')
            ->orderBy('month_year')
            ->get();

        return view('person.team')->with([
            'posts' => $posts,
            'appointmentsData' => $appointmentsData,
            'meetingsData' => $meetingsData,
            'contractsData' => $contractsData,
        ]);
    }
    
     public function department(Person $department)
{
    // Personモデルに紐づく投稿を取得し、チームごとに集計する
    $posts = DB::table('posts')
                ->join('person', 'posts.person_id', '=', 'person.id')
                ->where('person.department', $department->department) // $team->team はチーム名やIDに置き換える必要があります
                ->orderBy('posts.created_at2', 'desc')
                ->paginate(5);
                
    // チームごとの月別のアポ数、商談数、成約数の統計データを取得
    $appointmentsData = $department->posts()
            ->selectRaw('DATE_FORMAT(created_at2, "%Y-%m") as month_year')
            ->selectRaw('SUM(appointment) as total_appointment')
            ->groupBy('month_year')
            ->get();


        $meetingsData =  $department->posts()
            ->selectRaw('DATE_FORMAT(created_at2, "%Y-%m") as month_year, SUM(meeting) as total_meeting')
            ->groupBy('month_year')
            ->orderBy('month_year')
            ->get();

        $contractsData =  $department->posts()
            ->selectRaw('DATE_FORMAT(created_at2, "%Y-%m") as month_year, SUM(contract) as total_contract')
            ->groupBy('month_year')
            ->orderBy('month_year')
            ->get();

        return view('person.team')->with([
            'posts' => $posts,
            'appointmentsData' => $appointmentsData,
            'meetingsData' => $meetingsData,
            'contractsData' => $contractsData,
        ]);
    }
}