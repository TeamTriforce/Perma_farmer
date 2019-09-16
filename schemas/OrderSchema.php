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

    const AVAILABLE_DATE = "order_available_date";

    const PICKED_DATE = "order_picked_date";

    const NOTIFICATION_SENT = "order_notification_sent";

    const QUANTITY = "product_quantity";

    const JOINED_TABLE = "cart";

}