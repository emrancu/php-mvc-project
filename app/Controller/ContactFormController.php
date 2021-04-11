<?php

namespace App\Controller;

use App\Models\Contact;
use App\System\Middleware\DatabaseSetup;
use App\System\Request;
use App\System\Validator\Validator;
use Exception;

class ContactFormController
{

    public function __construct(DatabaseSetup $databaseSetup)
    {
        $databaseSetup->handle();
    }

    public function form(Request $request)
    {
        return view('contactForm');
    }

    public function saveData(Request $request)
    {
        if (isset($_COOKIE["form_submission"])) {
            return responseJson([
                "message" => "You have Already submitted a item"
            ], 422);
        }

        $check = Validator::execute($request, [
            'amount' => 'required|number',
            'buyer' => 'required|noSpecialChar|limit:5,50',
            'receipt_id' => 'required|limit:1,20',
            'buyer_email' => 'required|email',
            'note' => 'required|wordLimit:2,30',
            'city' => 'required|letter',
            'phone' => 'required|mobile',
            'entry_by' => 'required|number'
        ]);

        if (!$check['status']) {
            return responseJson($check, 422);
        }

        try {
            $purchase = new Contact();
            $insert = $purchase->insert($request);

            setcookie('form_submission', 'formSubmitted', time() + 86400);

        } catch (Exception $e) {
            return responseJson([
                "message" => "Something went wrong",
                "error" => $e->getMessage()
            ], 422);
        }

        sessionFlash('message', "Insert Successfully");
        return responseJson($insert);
    }


}
