<?php
/**
 * Created by PhpStorm.
 * User: mahsyaj
 * Date: 16/09/2019
 * Time: 10:58
 */

abstract class OrderSchema
{

    const TABLE = "order";

    const ID = "order_id";

    const AVAILABLE_DATE = "order_availableDate";

    const PICKED_DATE = "order_pickedDate";

    const NOTIFICATION_SENT = "order_notificationSent";

    const QUANTITY = "product_quantity";

    const JOINED_TABLE = "cart";

    const CUSTOMER = "order_idCustomer";

    const PICKED = "order_picked";

}