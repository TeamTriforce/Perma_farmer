<?php

include "common_config.php";
require_once dirname(__FILE__) . "/../php/Autoloader.php";

if (isset($_SESSION["id"]) && isset($_SESSION["token"])) {
    $adminDao = new AdminDao();

    if ($adminDao->checkToken($_SESSION["id"], $_SESSION["token"])) {
        $orderDao = new OrderDao();

        if (isset($_GET[OrderSchema::ID])) {
            $order = $orderDao->read($_PUT[OrderSchema::ID]);

            $response_code = 200;

            echo json_encode($order);
        } else if (isset($_PUT[OrderSchema::ID])) {
            $order = $orderDao->read($_PUT[OrderSchema::ID]);

            if ($order != null) {
                if (isset($_PUT[OrderSchema::AVAILABLE_DATE])) {
                    $order->setAvailableDate($_PUT[OrderSchema::AVAILABLE_DATE]);
                }

                if (isset($_PUT[OrderSchema::PICKED_DATE])) {
                    $order->setPickedDate($_PUT[OrderSchema::PICKED_DATE]);
                }

                if (isset($_PUT[OrderSchema::NOTIFICATION_SENT])) {
                    $order->setNotificationSent($_PUT[OrderSchema::NOTIFICATION_SENT]);
                }

                if (isset($_PUT[OrderSchema::PICKED])) {
                    $order->setPicked($_PUT[OrderSchema::PICKED]);
                }

                if ($orderDao->update($order)) {
                    $response_code = 200;

                    echo "Order successfully updated.";
                } else {
                    $response_code = 400;

                    echo "An error occurred with the order update.";
                }
            } else {
                $response_code = 404;

                echo "Order not found.";
            }
        } else if (isset($_DELETE["id"])) {
            if ($orderDao->delete($_DELETE["id"])) {
                $response_code = 200;

                echo "Successfully deleted.";
            } else {
                $response_code = 404;

                echo "Order id not found.";
            }
        } else {
            $orders = $orderDao->queryAll();

            $response_code = 200;

            echo json_encode($orders);
        }
    } else {
        $response_code = 403;

        echo "Unauthorized.";
    }
} else {
    $response_code = 401;

    echo "You need to authenticate threw api/login.php.";
}

http_response_code($response_code);