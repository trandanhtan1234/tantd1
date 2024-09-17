<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\models\users;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\View\View;

class UsersExport implements FromView
{
    private $users;

    public function __construct($users) {
        $this->users = $users;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return view('backend.user.export_users', ['users' => $this->users]);
    }
}
