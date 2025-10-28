<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfficeSession\OfficeSession;
use App\Http\Requests\OfficeSession\StoreOfficeSessionRequest;

class OfficeSessionController extends Controller
{
    public function index(Request $request)
    {
        $officeSessionQuery = OfficeSession::query();

        $officeSessionQuery->where(function ($sessionQuery) use ($request) {
            if ($request->filled('keyword')) {
                $sessionQuery->where('year', 'like', '%' . $request->query('keyword') . '%')
                            ->orWhere('session_no', 'like', '%' . $request->query('keyword') . '%')
                            ->orWhere('remarks', 'like', '%' . $request->query('keyword') . '%')
                            ->orwhereHas('type', function ($type) use ($request) {
                                $type->where('name', 'like', '%' . $request->query('keyword') . '%');
                            })
                            ->orWhereHas('council', function ($council) use ($request) {
                                $council->where('number', 'like', '%' . $request->query('keyword') . '%');
                            });
            }

            if ($request->filled('council_id')) {
                $sessionQuery->where('council_id', $request->query('council_id'));
            }

            if ($request->filled('year')) {
                $sessionQuery->where('year', $request->query('year'));
            }

            if ($request->filled('type_id')) {
                $sessionQuery->where('type_id', $request->query('type_id'));
            }
        });

        return response()->json([
            'sessions' => $officeSessionQuery->with(['council', 'type'])
                                            ->latest()
                                            ->paginate(100),
        ]);
    }

    public function store(StoreOfficeSessionRequest $request)
    {
        $session = OfficeSession::create([
            'council_id' => $request->validated('council_id'),
            'type_id' => $request->validated('type_id'),
            'year' => $request->validated('year'),
            'session_no' => $request->validated('session_no'),
            'date' => $request->validated('date'),
            'remarks' => $request->validated('remarks'),
        ]);

        return response()->json([
            'message' => 'Office session created successfully.',
            'session' => $session->load(['council', 'type']),
        ], 201);
    }

    public function update(StoreOfficeSessionRequest $request, OfficeSession $session)
    {
        $session->update([
            'council_id' => $request->validated('council_id'),
            'type_id' => $request->validated('type_id'),
            'year' => $request->validated('year'),
            'session_no' => $request->validated('session_no'),
            'date' => $request->validated('date'),
            'remarks' => $request->validated('remarks'),
        ]);

        return response()->json([
            'message' => 'Office session updated successfully.',
            'session' => $session->load(['council', 'type']),
        ]);
    }

    public function destroy(OfficeSession $session)
    {
        $session->delete();

        return response()->json([
            'message' => 'Office session deleted successfully.',
        ]);
    }
}
