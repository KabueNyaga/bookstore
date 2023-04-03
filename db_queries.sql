 create database bookstore;
use bookstore;
create table users(
	id int primary key not null identity(1,1),
	username varchar(100) not null unique,
	pass varchar(255) not null
);

create table inventory (
	item_id varchar(10) not null primary key,
    item_category varchar(50) not null,
    item_name varchar (100) not null,
    quantity int not null,
    cost int not null);
    

    
create table sales(
	sale_id varchar(10) not null primary key,
    sale_itemid varchar(10),
    constraint FK_inventory_sales
    foreign key (sale_itemid) references inventory(item_id),
	mode_of_payment varchar(50) not null,
    date_of_purchase date not null,
    quantity int not null,
    total_price int); 
    
create table suppliers (
	supplier_id varchar(10) not null primary key,
    s_name varchar(100) not null,
    email varchar(100) not null unique,
    phone varchar(13) not null,
    address varchar(200) not null
);

create table orders(
	order_id varchar(10) not null primary key,
    order_itemid varchar(10) not null,
    constraint FK_orders_inventory
    foreign key (order_itemid) references inventory(item_id),
    quantity int not null,
    price int not null,
    order_supplierid varchar(10) not null,
    foreign key (order_supplierid) references suppliers(supplier_id)
);


create table client_order(
	client_id varchar(10) not null primary key,
    f_name varchar(50) not null,
    l_name varchar(50) not null,
    email varchar(100) ,
    phone varchar(13),
    client_orderid varchar(10) not null,
    foreign key (client_orderid) references orders(order_id)
    );

    create table delivery(
		deliverly_id varchar(10) not null primary key,
        d_order_id varchar(10) not null unique,
        foreign key (d_order_id) references orders(order_id),
        date_delivered date
);


create table supplier_payment(
	payment_id varchar(10) not null primary key,
    p_deliveryid varchar(10) not null unique,
    foreign key (p_deliveryid) references delivery(deliverly_id),
    date_of_payment date not null,
    payment_method varchar(50),
    amount_paid int not null);

;
select * from suppliers;
alter table suppliers add email varchar(150) ;
use bookstore;
update suppliers set email='macclintx@gmail.com' where supplierID='spp001';
select * from users;
alter table users add created_at datetime;

sp_help users;
use bookstore;
select * from inventory;



