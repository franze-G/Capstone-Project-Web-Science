<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        // Validate request
        $request->validate([
            'task_id' => 'required|integer',
            'service_fee' => 'required|numeric|min:1'
        ]);

        $taskId = $request->input('task_id');
        $serviceFee = $request->input('service_fee');

        // Set up cURL
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, 'https://api.paymongo.com/v1/links');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'data' => [
                'attributes' => [
                    'amount' => (int)($serviceFee * 100), // Convert to cents
                    'description' => "Payment for task ID $taskId",
                    'remarks' => 'Thank you'
                ]
            ]
        ]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Basic c2tfdGVzdF9hVGpHOWI0Zmh4a1dGcWlSZ0g3cjhLYVI6'
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            // Handle cURL error
            Log::error('cURL Error:', ['error' => curl_error($ch)]);
            curl_close($ch);
            return response()->json(['error' => 'Failed to create payment link.'], 500);
        }

        curl_close($ch);

        $data = json_decode($response, true);

        // Log the response for debugging
        Log::info('PayMongo API Response:', $data);

        if (isset($data['data']['attributes']['client_key'])) {
            $clientKey = $data['data']['attributes']['client_key'];
            // Redirect to the PayMongo checkout URL
            return redirect("https://paymongo.com/checkout/$clientKey");
        }

        return response()->json(['error' => 'Failed to retrieve payment link.'], 500);
    }
}
