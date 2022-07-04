<?php

class OrderFunctions
{
    public static function getRoutes() {
        return [
            [
                'pattern' => 'user/orders',
                'method' => 'get',
                'action'  => function() {
                    return OrderFunctions::getOrders();
                },
            ],
        ];
    }

    public static function getOrders() {
        header('Content-type: application/json');
        $kirby = kirby();
        $user = $kirby->user();
        $role = null;
        $orders = array();
        if (isset($user)) {
            $usermail = $user->email();

            $site = $kirby->site();
            $orderPages = $site->index()->filterBy("intendedTemplate", "order")->listed()->filter(function($p) use($usermail) {
              return $p->email()->text() == $usermail;
            });
            foreach ($orderPages as $order) {

                array_push($orders, array("id" => $order->id(), "name" => $order->name(), "url"=>$order->url(), "invoiceNumber" => $order->invoiceNumber(), "date" => $order->invoicedate()->toDate("d.m.Y")));
            }
        }
        return json_encode(array("orders" => $orders));
    }
}
