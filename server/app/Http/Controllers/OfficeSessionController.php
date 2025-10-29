<?php

namespace App\Http\Controllers;

use App\Models\AttachmentType;
use Illuminate\Http\Request;
use App\Models\OfficeSession\OfficeSession;
use App\Http\Requests\OfficeSession\StoreOfficeSessionRequest;
use Illuminate\Support\Facades\Storage;

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
            'sessions' => $officeSessionQuery->with([
                                                'council', 
                                                'type'
                                            ])
                                            ->with('attachments', function ($attachments) {
                                                $attachments->with('type');
                                            })
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

        if ($request->hasFile('attachment.agenda')) {
            foreach ($request->file('attachment.agenda') as $file) {
                $path = $file->store("/office-sessions/" . $session->id . "/agenda", 'public');
            
                $session->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'type_id' => AttachmentType::where('name', 'agenda')->first()->id
                ]);
            }
        }

        if ($request->hasFile('attachment.minutes')) {
            foreach ($request->file('attachment.minutes') as $file) {
                $path = $file->store("/office-sessions/" . $session->id . "/minutes", 'public');
            
                $session->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'type_id' => AttachmentType::where('name', 'minutes')->first()->id
                ]);
            }
        }

        if ($request->hasFile('attachment.journal')) {
            foreach ($request->file('attachment.journal') as $file) {
                $path = $file->store("/office-sessions/" . $session->id . "/journal", 'public');
            
                $session->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'type_id' => AttachmentType::where('name', 'journal')->first()->id
                ]);
            }
        }

        if ($request->hasFile('attachment.audio')) {
            foreach ($request->file('attachment.audio') as $file) {
                $path = $file->store("/office-sessions/" . $session->id . "/audio", 'public');
            
                $session->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'type_id' => AttachmentType::where('name', 'audio')->first()->id
                ]);
            }
        }

        if ($request->hasFile('attachment.photo')) {
            foreach ($request->file('attachment.photo') as $file) {
                $path = $file->store("/office-sessions/" . $session->id . "/photo", 'public');
            
                $session->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'type_id' => AttachmentType::where('name', 'photo')->first()->id
                ]);
            }
        }

        if ($request->hasFile('attachment.attendance')) {
            foreach ($request->file('attachment.attendance') as $file) {
                $path = $file->store("/office-sessions/" . $session->id . "/attendance", 'public');
            
                $session->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'type_id' => AttachmentType::where('name', 'attendance')->first()->id
                ]);
            }
        }

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

        if ($request->hasFile('attachment.agenda')) {
            foreach ($request->file('attachment.agenda') as $file) {
                $path = $file->store("/office-sessions/" . $session->id . "/agenda", 'public');
            
                $session->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'type_id' => AttachmentType::where('name', 'agenda')->first()->id
                ]);
            }
        }

        if ($request->hasFile('attachment.minutes')) {
            foreach ($request->file('attachment.minutes') as $file) {
                $path = $file->store("/office-sessions/" . $session->id . "/minutes", 'public');
            
                $session->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'type_id' => AttachmentType::where('name', 'minutes')->first()->id
                ]);
            }
        }

        if ($request->hasFile('attachment.journal')) {
            foreach ($request->file('attachment.journal') as $file) {
                $path = $file->store("/office-sessions/" . $session->id . "/journal", 'public');
            
                $session->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'type_id' => AttachmentType::where('name', 'journal')->first()->id
                ]);
            }
        }

        if ($request->hasFile('attachment.audio')) {
            foreach ($request->file('attachment.audio') as $file) {
                $path = $file->store("/office-sessions/" . $session->id . "/audio", 'public');
            
                $session->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'type_id' => AttachmentType::where('name', 'audio')->first()->id
                ]);
            }
        }

        if ($request->hasFile('attachment.photo')) {
            foreach ($request->file('attachment.photo') as $file) {
                $path = $file->store("/office-sessions/" . $session->id . "/photo", 'public');
            
                $session->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'type_id' => AttachmentType::where('name', 'photo')->first()->id
                ]);
            }
        }

        if ($request->hasFile('attachment.attendance')) {
            foreach ($request->file('attachment.attendance') as $file) {
                $path = $file->store("/office-sessions/" . $session->id . "/attendance", 'public');
            
                $session->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'type_id' => AttachmentType::where('name', 'attendance')->first()->id
                ]);
            }
        }

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
