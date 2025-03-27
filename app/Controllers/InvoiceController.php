<?php

namespace App\Controllers;

use App\App;
use App\DB;
use App\Examples\Enum\Status;
use App\Models\Invoice;
use App\View;

class InvoiceController
{

    public function index(){
        $status = Status::PAID->value;
        $stmt = App::db()->query("SELeCt * FROM invoices WHERE status= $status");
        $invoices = $stmt->fetchAll();
        return View::make('invoices/index', ['invoices' => $invoices])->render();
    }
}