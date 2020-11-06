<?php namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\CartModel;


class Orders extends BaseController
{

    public function create(){

        $cartModel = new CartModel();

        $cartItems = $cartModel->fetch_all_cart_items();

        $payee_customer_email = $this->request->getPost('payee_customer_email');
        $payee_customer_name = $this->request->getPost('payee_customer_name');
        $amount = $this->request->getPost('amount');

        $contactNumber = $this->request->getPost('contact_number');
        $shippingAddress = $this->request->getPost('shipping_address');
        $billingAddress = $this->request->getPost('billing_address');

        $items_qty_json = '';

        $itemsJsonObject = array();

        foreach($cartItems as $cartItem){
            $itemsJsonObject[] = array(
                'product_id' => $cartItem['product_id'],
                'quantity' => $cartItem['quantity'],
                'material' => $cartItem['material'],
                'sie' => $cartItem['size']
            );
        }

        $items_qty_json = json_encode($itemsJsonObject);

        $publicOrderId = uniqid();

        $orderObject = array(
            'public_order_id' => $publicOrderId,
            'products_qty_json' => $items_qty_json,
            'amount_paid' => $amount,
            'status' => 'placed',
            'status_details' => 'Order is placed by payment made via RazorPay',
            'customer_email' => $payee_customer_email,
            'customer_name' => $payee_customer_name,
            'mode' => 'prepaid',
            'contact_number' => $contactNumber,
            'shipping_address' => $shippingAddress,
            'billing_address' => $billingAddress
        );

        $orderModel = new OrderModel();

        $res = $orderModel->insert($orderObject);

 
        if ($res) {
            exit('success');
        }else {
            exit('failure');
        }

    }

}