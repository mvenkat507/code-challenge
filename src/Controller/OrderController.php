<?php

namespace App\Controller;

use App\Entity\Order;
use App\Factory\ResponseFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{

    public function __construct(private ResponseFactory $xmlresponsefactory)
    {
        
    }

    #[Route('/{type}', name: 'app_order', methods: ['GET'])]
    public function index(string $type): Response
    {
        // read the order json data
        $projectRoot =  $this->getParameter('kernel.project_dir');
        $orders = json_decode(file_get_contents($projectRoot . '/var/coding-challenge-1.json'), true);
        
        $result = [];
        foreach($orders as $order) {
            $order_data = new Order();
            $data = $this->getTotalOrderValue($order['items'], $order['discounts']);
            $order_data->setOrderID($order['order_id']);
            $order_data->setOrderDate(date('d/m/Y', strtotime($order['order_datetime'])));
            $order_data->setTotalOrderValue(round($data['total_items_price'],2));
            $order_data->setAverageUnitPrice(round(($data['total_items_price'] / $data['total_items']), 2));
            $order_data->setUnitCount($data['total_items']);
            $order_data->setCustomerState($order['customer']['shipping_address']['state']);
            $result[] = $order_data; 
        }

        $response = null;
        if($type == 'xml') {
            $response = $this->xmlresponsefactory->createXMLResponse($result, 'order'); 
        } elseif($type == 'csv') {
            $response = $this->xmlresponsefactory->createCSVResponse($result); 
        } else {
            $response = $this->xmlresponsefactory->createJsonResponse($result);
        }

        return $response; 
    }

    public function getTotalOrderValue($items, $discounts) {
        // find total items price
        $total_price = 0;
        $total_items = 0;
        foreach($items as $item) {
            $total_items += $item['quantity'];
            $total_price += ($item['quantity'] * $item['unit_price']);
        }

        // remove the discount price from total items price
        $discount_price = isset($discounts['value']) ? $discounts['value'] : 0;
        if($total_price > 0 && $discount_price > 0) {
            $total_price -= $discount_price;
        }

        return ['total_items' => $total_items, 'total_items_price' => $total_price];
    }
}
