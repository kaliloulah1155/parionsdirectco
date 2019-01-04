<?php

namespace App\Exports;
use App\User;
use Ixudra\Curl\Facades\Curl;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvoicesExport implements FromView {

    /**
     * @return View
     */
    public function view(): View
    {
        // TODO: Implement collection() method.
        $results = Curl::to('http://81.95.153.117:9000/admin/gamers')->asJson()->get();
        $listgamers=$results->data->list;

        return view('admin.players.players', [
            'invoices' => $listgamers
        ]);

    }
}
