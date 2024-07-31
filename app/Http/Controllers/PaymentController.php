<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Project;

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

        // Set up cURL for PayMongo
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
            'Authorization: Basic ' . base64_encode('sk_test_aTjG9B4FhUq6FVVvHjWmCk4y' . ':')
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

            // Store the task ID and client key in session
            session()->put('task_id', $taskId);
            session()->put('payment_client_key', $clientKey);

            // Redirect to the PayMongo checkout URL
            return redirect("https://paymongo.com/checkout/$clientKey");
        }

        return response()->json(['error' => 'Failed to retrieve payment link.'], 500);
    }

    public function handlePaymentCallback(Request $request)
    {
        // Fetch the necessary data from the request
        $taskId = session()->get('task_id');
        $paymentStatus = $request->input('status'); // Adjust based on actual callback payload

        if ($paymentStatus === 'paid') {
            $task = Project::find($taskId);
            if ($task) {
                $task->status = 'paid'; // Update task status
                $task->save();
            }

            // Redirect to the activity index page with task ID
            return redirect()->route('activity.index', ['task_id' => $taskId])
                            ->with('success', 'Payment successful! You can now rate the task.');
        }

        return redirect()->route('activity.index')
                        ->with('error', 'Payment failed.');
    }

    
}
