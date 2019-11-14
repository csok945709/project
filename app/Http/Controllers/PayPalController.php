<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;
use Illuminate\Support\Facades\Auth;
use App\Document;
use App\KnowledgeInvoice;

class PayPalController extends Controller
{
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
   
     public function payment(Document $document)
    {
        $price = $document->price;
        $docID = $document->id;
        $caption = $document->caption;
        $data = [];
        $data['items'] = [
            [
                'name' => $caption,
                'price' => $price,
                'desc'  => $docID,
                'qty' => 1,
            ]
        ];
        $data['invoice_id'] = uniqid();
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.getRequest');
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
        $docID = (int)$response['L_DESC0'];
        $amount = (int)$response['AMT'];
        $PayerID = $response['PAYERID'];
        $UserId = Auth::user()->id;
        
        if (Auth::check()) {
          
            KnowledgeInvoice::create([
                'document_id' => $docID,
                'buyer_id' => $UserId,
                'paypal_payer_id' => $PayerID,
                'price' => $amount,
               
            ]);
        }else{
            return back()->withInput()->with('error','Something wrong');
        }

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            return redirect()->route('document.show', [$UserId, $docID]);
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
    

