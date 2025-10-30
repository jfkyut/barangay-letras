<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomingCommunication\IncomingCommunication;
use App\Http\Requests\Incoming\StoreIncomingCommunicationRequest;

class IncomingCommunnicationController extends Controller
{
    public function index(Request $request)
    {
        $incomingQuery = IncomingCommunication::query();

        $incomingQuery->where(function ($incomingSubQuery) use ($request) {
            if ($request->filled('keyword')) {
                $incomingSubQuery->where('year', 'like', '%' . $request->query('keyword') . '%')
                                ->orWhere('month', 'like', '%' . $request->query('keyword') . '%')
                                ->orWhere('sequence_no', 'like', '%' . $request->query('keyword') . '%')
                                ->orWhere('reference_no')
                                ->orWhere('classification', 'like', '%' . $request->query('keyword') . '%')
                                ->orWhere('sender', 'like', '%' . $request->query('keyword') . '%')
                                ->orWhere('subject', 'like', '%' . $request->query('keyword') . '%')
                                ->orWhere('date_received', 'like', '%' . $request->query('keyword') . '%')
                                ->orWhere('addressee', 'like', '%' . $request->query('keyword') . '%')
                                ->orWhere('required_action', 'like', '%' . $request->query('keyword') . '%')
                                ->orWhere('remarks', 'like', '%' . $request->query('keyword') . '%');
            }

            if ($request->filled('year')) {
                $incomingSubQuery->where('year', $request->query('year'));
            }
        });

        return response()->json([
            'incoming_communications' => $incomingQuery->orderByDesc('year')
                                                    ->orderByDesc('reference_no')
                                                    ->paginate(100)
        ]);
    }

    public function store(StoreIncomingCommunicationRequest $request)
    {
       $incomingCommunication = IncomingCommunication::create($request->validated());

       return response()->json([
            'message' => 'Incoming communication created successfully.',
            'incoming_communication' => $incomingCommunication
       ]);
    }

    public function update(Request $request, IncomingCommunication $incomingCommunication)
    {
        return $request;
    }

    public function destroy(IncomingCommunication $incomingCommunication)
    {
        $incomingCommunication->delete();

        return response()->json(['message' => 'Incoming communication deleted successfully.']);
    }
}
