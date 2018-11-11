<?php

namespace App\Http\Controllers;

use App\Couple;
use Illuminate\Http\Request;

class CouplesController extends Controller
{
    /**
     * Display the specified Couple.
     *
     * @param  \App\Couple  $couple
     * @return \Illuminate\View\View
     */
    public function show(Couple $couple)
    {
        return view('couples.show', compact('couple'));
    }

    /**
     * Show the form for editing the specified Couple.
     *
     * @param  \App\Couple  $couple
     * @return \Illuminate\View\View
     */
    public function edit(Couple $couple)
    {
        $this->authorize('edit', $couple);

        return view('couples.edit', compact('couple'));
    }

    /**
     * Update the specified Couple in storage.
     *
     * @param  \App\Couple  $couple
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Couple $couple)
    {
        $this->authorize('edit', $couple);

        $coupleData = request()->validate([
            'marriage_date' => 'nullable|date|date_format:Y-m-d',
            'divorce_date'  => 'nullable|date|date_format:Y-m-d',
        ]);

        $couple->marriage_date = $coupleData['marriage_date'];
        $couple->divorce_date = $coupleData['divorce_date'];
        $couple->save();

        return redirect()->route('couples.show', $couple);
    }
}
