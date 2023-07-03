<?php

namespace App\Http\Controllers;

use App\Models\FailOrPass;

class ResultController extends Controller
{
    //
    public function resultsCandidate()
    {

        $id = session('candidate_id');

    

        $res = FailOrPass::getResultsByCandidateId($id);

        return view('candidate.results', compact('res'));

    }
}
