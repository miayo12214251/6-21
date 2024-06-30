<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Post;

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
}
