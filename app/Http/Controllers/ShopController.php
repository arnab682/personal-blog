<?php

namespace App\Http\Controllers;

use PayPal\Rest\ApiContext;
use App\Product;
use App\Facade\PayPal;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class ShopController extends Controller
{
    //
    public function index(){
      $products = Product::all();
      return view('shop.index', compact('products'));
    }

    public function singleProduct($id){
      $product = Product::findOrFail($id);
      return view('shop.singleProduct', compact('product'));
    }


    public function orderProduct($id){

      $apiContext = PayPal::apiContext();

      $payer = new Payer();
      $payer->setPaymentMethod("paypal");

      $item1 = new Item();
      $item1->setName('Ground Coffee 40 oz')
          ->setCurrency('USD')
          ->setQuantity(1)
          ->setSku("123123") // Similar to `item_number` in Classic API
          ->setPrice(7.5);
      $item2 = new Item();
      $item2->setName('Granola bars')
          ->setCurrency('USD')
          ->setQuantity(5)
          ->setSku("321321") // Similar to `item_number` in Classic API
          ->setPrice(2);
      $itemList = new ItemList();
      $itemList->setItems(array($item1, $item2));

      $details = new Details();
      $details->setShipping(1.2)
          ->setTax(1.3)
          ->setSubtotal(17.50);

      $amount = new Amount();
      $amount->setCurrency("USD")
          ->setTotal(20)
          ->setDetails($details);

      $transaction = new Transaction();
      $transaction->setAmount($amount)
          ->setItemList($itemList)
          ->setDescription("Payment description")
          ->setInvoiceNumber(uniqid());

      $baseUrl = "http//personal-blog.test";
      $redirectUrls = new RedirectUrls();
      $redirectUrls->setReturnUrl("$baseUrl/ExecutePayment.php?success=true")
          ->setCancelUrl("$baseUrl/ExecutePayment.php?success=false");

      $payment = new Payment();
      $payment->setIntent("sale")
          ->setPayer($payer)
          ->setRedirectUrls($redirectUrls)
          ->setTransactions(array($transaction));

      $request = clone $payment;

      try {
          $payment->create($apiContext);
      } catch (Exception $ex) {
          print("Created Payment Using PayPal. Please visit the URL to Approve.". $request);
          exit(1);
      }

      $approvalUrl = $payment->getApprovalLink();
       print("Created Payment Using PayPal. Please visit the URL to Approve."."<a href='".$approvalUrl."'>".$approvalUrl."</a>");
      return $payment;
    }
}
