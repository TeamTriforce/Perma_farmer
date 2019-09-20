<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 19/09/2019
 * Time: 14:29
 */

require_once dirname(__FILE__) . "/php/Autoloader.php";

session_start();

if (isset($_POST["addProductId"])) {
    $productDao = new ProductDao();
    $product = $productDao->read((int)($_POST["addProductId"]));

    if ($product == null) {
        header('Location: error.php?errorCode=404');

        exit();
    }

    if (!in_array($product, $_SESSION["cart"]->getProducts())) {
        $_SESSION["cart"]->addProduct($product);
    }

    header('Location: nos-produits.php');

    exit();
}

if (isset($_POST["deleteProductId"])) {
    $productDao = new ProductDao();
    $product = $productDao->read((int)($_POST["deleteProductId"]));

    if ($product == null) {
        header('Location: error.php?errorCode=404');
    }

    $_SESSION["cart"]->removeProduct($product);

    header('Location: panier.php');

    exit();
}

if (isset($_POST["login"]) && isset($_POST["password"])) {
    $customerDao = new CustomerDao();
    $adminDao = new AdminDao();
    $adminId = $adminDao->login($_POST["login"], $_POST["password"]);
    $customerId = $customerDao->login($_POST["login"], $_POST["password"]);

    if ($adminId != null) {
        $_SESSION["id"] = $adminId[AdminSchema::ID];
        $_SESSION["token"] = $adminId[AdminSchema::TOKEN];

        header('Location: admin.php');

        exit();
    } else if ($customerId != null) {
        $_SESSION["id"] = $customerId[CustomerSchema::ID];
        $_SESSION["token"] = $customerId[CustomerSchema::TOKEN];

        header('Location: index.php');

        exit();
    } else {
        header('Location: error.php?errorCode=403');

        exit();
    }
}

if (isset($_POST["checkout"])) {
    $customerDao = new CustomerDao();

    if (isset($_SESSION["id"]) && isset($_SESSION["token"]) && $customerDao->checkToken($_SESSION["id"], $_SESSION["token"])) {
        $_SESSION["cart"]->setIdCustomer($_SESSION["id"]);
        $_SESSION["cart"]->setNotificationSent(false);
        $_SESSION["cart"]->setPicked(false);

        $orderDao = new OrderDao();

        $orderDao->create($_SESSION["cart"]);

        $_SESSION["cart"] = new Order([]);
        $_SESSION["cart"]->setProducts([]);

        header('Location: index.php');

        exit();
    } else {
        header('Location: login.php');

        exit();
    }
}

// ADMIN DELETE CALLS

if (isset($_POST["deleteProductId"])) {
    $adminDao = new AdminDao();

    if (isset($_SESSION["id"]) && isset($_SESSION["token"]) && $adminDao->checkToken($_SESSION["id"], $_SESSION["token"])) {
        $productDao = new ProductDao();
        $product = $productDao->read($_POST["deleteProductId"]);

        if ($product == null) {
            header('Location: error.php?errorCode=404');

            exit();
        } else {
            $productDao->delete($product->getId());

            header('Location: admin.php');

            exit();
        }
    } else {
        header('Location: error.php?errorCode=403');

        exit();
    }
}

if (isset($_POST["deleteCustomerId"])) {
    $adminDao = new AdminDao();

    if (isset($_SESSION["id"]) && isset($_SESSION["token"]) && $adminDao->checkToken($_SESSION["id"], $_SESSION["token"])) {
        $customerDao = new CustomerDao();
        $customer = $customerDao->read($_POST["deleteCustomerId"]);

        if ($customer == null) {
            header('Location: error.php?errorCode=404');

            exit();
        } else {
            $productDao->delete($customer->getId());

            header('Location: admin.php');

            exit();
        }
    } else {
        header('Location: error.php?errorCode=403');

        exit();
    }
}

if (isset($_POST["deleteAdminId"])) {
    $adminDao = new AdminDao();

    if (isset($_SESSION["id"]) && isset($_SESSION["token"]) && $adminDao->checkToken($_SESSION["id"], $_SESSION["token"])) {
        $admin = $adminDao->read($_POST["deleteAdminId"]);

        if ($admin == null) {
            header('Location: error.php?errorCode=404');

            exit();
        } else {
            $adminDao->delete($admin->getId());

            header('Location: admin.php');

            exit();
        }
    } else {
        header('Location: error.php?errorCode=403');

        exit();
    }
}

if (isset($_POST["deleteOrderId"])) {
    $adminDao = new AdminDao();

    if (isset($_SESSION["id"]) && isset($_SESSION["token"]) && $adminDao->checkToken($_SESSION["id"], $_SESSION["token"])) {
        $orderDao = new OrderDao();
        $order = $orderDao->read($_POST["deleteOrderId"]);

        if ($order == null) {
            header('Location: error.php?errorCode=404');

            exit();
        } else {
            $orderDao->delete($order->getId());

            header('Location: admin.php');

            exit();
        }
    } else {
        header('Location: error.php?errorCode=403');

        exit();
    }
}

if (isset($_POST["deleteSubscriptionId"])) {
    $adminDao = new AdminDao();

    if (isset($_SESSION["id"]) && isset($_SESSION["token"]) && $adminDao->checkToken($_SESSION["id"], $_SESSION["token"])) {
        $subscriptionDao = new SubscriptionDao();
        $subscription = $subscriptionDao->read($_POST["deleteSubscriptionId"]);

        if ($subscription == null) {
            header('Location: error.php?errorCode=404');

            exit();
        } else {
            $subscriptionDao->delete($subscription->getId());

            header('Location: admin.php');

            exit();
        }
    } else {
        header('Location: error.php?errorCode=403');

        exit();
    }
}

// ADMIN CREATE CALLS

if (isset($_POST["createProduct"])) {
    $adminDao = new AdminDao();

    if (isset($_SESSION["id"]) && isset($_SESSION["token"]) && $adminDao->checkToken($_SESSION["id"], $_SESSION["token"])) {
        $productDao = new ProductDao();
        $product = Product::newInstance(0, $_POST["label"], (int)$_POST["price"], 0, $_POST["image"], (int)$_POST["stock"], $_POST["description"]);

        if (!$productDao->create($product)) {
            header('Location: error.php?errorCode=404');

            exit();
        } else {
            header('Location: admin.php');

            exit();
        }
    } else {
        header('Location: error.php?errorCode=403');

        exit();
    }
}

if (isset($_POST["createCustomer"])) {
    $adminDao = new AdminDao();

    if (isset($_SESSION["id"]) && isset($_SESSION["token"]) && $adminDao->checkToken($_SESSION["id"], $_SESSION["token"])) {
        $customerDao = new CustomerDao();
        $customer = Customer::newInstance(0, $_POST["firstName"], $_POST["lastName"], $_POST["email"], $_POST["password"], "", "", $_POST["idSubscription"]);

        if (!$customerDao->create($customer)) {
            header('Location: error.php?errorCode=404');

            exit();
        } else {
            header('Location: admin.php');

            exit();
        }
    } else {
        header('Location: error.php?errorCode=403');

        exit();
    }
}

if (isset($_POST["createAdmin"])) {
    $adminDao = new AdminDao();

    if (isset($_SESSION["id"]) && isset($_SESSION["token"]) && $adminDao->checkToken($_SESSION["id"], $_SESSION["token"])) {
        $admin = Admin::newInstance(0, $_POST["login"], $_POST["password"], "");

        if (!$adminDao->create($admin)) {
            header('Location: error.php?errorCode=404');

            exit();
        } else {
            header('Location: admin.php');

            exit();
        }
    } else {
        header('Location: error.php?errorCode=403');

        exit();
    }
}

if (isset($_POST["createOrder"])) {
    $adminDao = new AdminDao();

    if (isset($_SESSION["id"]) && isset($_SESSION["token"]) && $adminDao->checkToken($_SESSION["id"], $_SESSION["token"])) {
        $orderDao = new OrderDao();
        $order = Order::newInstance(0, null, null, false, [], $_POST["idCustomer"], false);

        if (!$orderDao->create($order)) {
            header('Location: error.php?errorCode=404');

            exit();
        } else {
            header('Location: admin.php');

            exit();
        }
    } else {
        header('Location: error.php?errorCode=403');

        exit();
    }
}

if (isset($_POST["createSubscription"])) {
    $adminDao = new AdminDao();

    if (isset($_SESSION["id"]) && isset($_SESSION["token"]) && $adminDao->checkToken($_SESSION["id"], $_SESSION["token"])) {
        $subscriptionDao = new SubscriptionDao();
        $subscription = Subscription::newInstance(0, $_POST["label"], (float)$_POST["price"], (float)$_POST["weight"]);

        if (!$subscriptionDao->create($subscription)) {
            header('Location: error.php?errorCode=404');

            exit();
        } else {
            header('Location: admin.php');

            exit();
        }
    } else {
        header('Location: error.php?errorCode=403');

        exit();
    }
}

// ADMIN UPDATE CALLS

