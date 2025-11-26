<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        $currentDate = Carbon::create($year, $month, 1);
        $startOfMonth = $currentDate->copy()->startOfMonth();
        $endOfMonth = $currentDate->copy()->endOfMonth();

        // Get agendas for the current month
        $agendas = Agenda::where('is_active', true)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        // Get all active agendas grouped by date for the calendar
        $agendaByDate = $agendas->groupBy(function ($item) {
            return $item->date->format('Y-m-d');
        });

        // Get upcoming agendas (next 5)
        $upcomingAgendas = Agenda::where('is_active', true)
            ->where('date', '>=', now())
            ->orderBy('date')
            ->orderBy('time')
            ->limit(5)
            ->get();

        return view('pages.agenda.index', compact('agendas', 'agendaByDate', 'currentDate', 'upcomingAgendas'));
    }

    public function show($id)
    {
        $agenda = Agenda::where('is_active', true)->findOrFail($id);

        return view('pages.agenda.show', compact('agenda'));
    }
}
