<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;
use Illuminate\Support\Facades\Auth;
use App\Question;
use App\QuestionInvoice;

class QuestionPayPalController extends Controller
{
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */


     public function payment(Question $question)
    {
        $price = $question->reward;
        $courseID = $question->id;
        $title = $question->question_caption;
        $data = [];
        $data['items'] = [
            [
                'name' => $title,
                'price' => $price,
                'desc'  => $courseID,
                'qty' => 1,
            ]
        ];
        $data['invoice_id'] = uniqid();
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('questionPayment.success');
        $data['cancel_url'] = route('questionPayment.cancel');
        $data['total'] = $price;
        $provider = new ExpressCheckout;
        $response = $provider->setExpressCheckout($data);
        // This will redirect user to PayPal
        return redirect($response['paypal_link']);
    }
    public function paymentSuccess(Request $request)
    {   
       
        $token = $request->token;
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($token);
        $questionID = (int)$response['L_DESC0'];
        $amount = (int)$response['AMT'];
        $PayerID = $response['PAYERID'];
        $UserId = Auth::user()->id;
        if (Auth::check()) {
          
            QuestionInvoice::create([
                'question_id' => $questionID,
                'buyer_id' => $UserId,
                'paypal_payer_id' => $PayerID,
                'price' => $amount,
               
            ]);
        }else{
            return back()->withInput()->with('error','Something wrong');
        }
        $question = Question::where('id', $questionID)->where('user_id', $UserId)->update([
            'paid' => 1
        ]);
        
        // DB::table('courseregister')
        //         ->insert([
        //             'course_id' => $questionID,
        //             'user_id' => $UserId,
        //             "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
        //             "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
        //         ]);
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            return redirect()->route('profile.indexQuestion', [$UserId]);
        }
  
        dd('Something is wrong.');
    }
   
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }
    
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
}