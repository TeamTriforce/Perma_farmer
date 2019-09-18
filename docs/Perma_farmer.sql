#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: product
#------------------------------------------------------------

CREATE TABLE `product`(
        product_id          Int  Auto_increment  NOT NULL ,
        product_price       Float NOT NULL ,
        product_stock       Int NOT NULL ,
        product_image       Varchar (255) NOT NULL ,
        product_description Varchar (255) NOT NULL ,
        product_label       Varchar (100) NOT NULL
	,CONSTRAINT product_AK UNIQUE (product_label)
	,CONSTRAINT product_PK PRIMARY KEY (product_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: article
#------------------------------------------------------------

CREATE TABLE `article`(
        article_id      Int  Auto_increment  NOT NULL ,
        article_title   Varchar (255) NOT NULL ,
        article_content Varchar (255) NOT NULL ,
        article_image   Varchar (255) NOT NULL
	,CONSTRAINT article_PK PRIMARY KEY (article_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: admin
#------------------------------------------------------------

CREATE TABLE `admin`(
        admin_id        Int  Auto_increment  NOT NULL ,
        admin_password  Varchar (100) NOT NULL ,
        admin_authToken Varchar (100) NOT NULL ,
        admin_login     Varchar (100) NOT NULL
	,CONSTRAINT admin_AK UNIQUE (admin_login)
	,CONSTRAINT admin_PK PRIMARY KEY (admin_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: subscription
#------------------------------------------------------------

CREATE TABLE `subscription`(
        subscription_id     Int  Auto_increment  NOT NULL ,
        subscription_label  Varchar (100) NOT NULL ,
        subscription_price  Double NOT NULL ,
        subscription_weight Float NOT NULL
	,CONSTRAINT subscription_PK PRIMARY KEY (subscription_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: customer
#------------------------------------------------------------

CREATE TABLE `customer`(
        customer_id        Int  Auto_increment  NOT NULL ,
        customer_firstName Varchar (100) NOT NULL ,
        customer_lastName  Varchar (100) NOT NULL ,
        customer_email     Varchar (100) NOT NULL ,
        customer_password  Varchar (50) NOT NULL ,
        customer_code      Varchar (255) NOT NULL ,
        customer_authToken Varchar (255) NOT NULL ,
        customer_idSubscription    Int NOT NULL
	,CONSTRAINT customer_PK PRIMARY KEY (customer_id)
	,CONSTRAINT customer_subscription_FK FOREIGN KEY (customer_idSubscription) REFERENCES subscription(subscription_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: order
#------------------------------------------------------------

CREATE TABLE `order`(
        order_id               Int  Auto_increment  NOT NULL ,
        order_availableDate    Datetime NOT NULL ,
        order_pickedDate       Datetime NOT NULL ,
        order_notificationSent Int NOT NULL ,
        order_idCustomer            Int NOT NULL
	,CONSTRAINT order_PK PRIMARY KEY (order_id)

	,CONSTRAINT order_customer_FK FOREIGN KEY (order_idCustomer) REFERENCES customer(customer_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: cart
#------------------------------------------------------------

CREATE TABLE `cart`(
        product_id       Int NOT NULL ,
        order_id         Int NOT NULL ,
        product_quantity Int NOT NULL
	,CONSTRAINT cart_PK PRIMARY KEY (product_id,order_id)

	,CONSTRAINT cart_product_FK FOREIGN KEY (product_id) REFERENCES product(product_id)
	,CONSTRAINT cart_order0_FK FOREIGN KEY (order_id) REFERENCES `order`(order_id)
)ENGINE=InnoDB;

