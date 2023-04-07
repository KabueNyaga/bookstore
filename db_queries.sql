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

sp_help inventory;
use bookstore;
select * from inventory;
delete from inventory where ItemID='ss';

create procedure select_inv @ItemID nvarchar(255) as select * from inventory where ItemID =@ItemID;
create procedure select_supp @SupplierID nvarchar(255) as select * from suppliers where supplierID =@SupplierID;
exec select_inv @ItemID='a005';
exec select_supp @SupplierID='spp011';
drop procedure select_inv;
select * from Client_orders;
select *from orders;
delete from suppliers where SupplierID='spp011';
alter table inventory drop column supplierID;
select * from suppliers; 
sp_help suppliers;
exec sp_rename 'suppliers.Address','s_address';
SELECT supplierID FROM suppliers WHERE s_address = '7 Durham Lane';
select * from sales;
alter table sales alter column Date_of_purchase date;
SELECT Item_name FROM inventory;
SELECT ItemID FROM inventory  WHERE Item_name= 'USB'; 

select quantity from inventory where ItemID='a007';
select * from orders;
delete from orders where OrderID='';
alter table orders alter column Date_of_order date;
select * from Client_orders;
select * from suppliers where supplierID='spp016';
alter table suppliers drop Inventory$SuppliersInventoty;

drop table client_order;
alter table Client_orders drop column Quantity;
alter table Client_orders add unique(OrderID);
delete from Client_orders where client_orderID='clo55';
alter table suppliers drop column email;

INSERT INTO inventory (ItemID,Item_category,Item_name,Quantity,Cost,supplierID) VALUES ('ss','?','?',1,1,'spp011');

select * from sales;
alter table sales add totals int ;
select sales.salesID,sales.Date_of_purchase,sales.Mode_of_payment,inventory.ItemID,inventory.Item_category, inventory.Item_name,sales.Quantity,inventory.Cost,sales.totals  from inventory inner join sales on sales.itemID=inventory.ItemID ;
update sales set totals=3120 where salesID='sl070';
update sales set totals=34000 where salesID='sl009';
update sales set totals=1700 where salesID='sl008';
update sales set totals=1500 where salesID='sl034';
update sales set totals=1000 where salesID='sl053';
update sales set totals=200 where salesID='sl036';
update sales set totals=200 where salesID='sl048';
update sales set totals=200 where salesID='sl043';
update sales set totals=1000 where salesID='sl054';
update sales set totals=10000 where salesID='sl055';
update sales set totals=300 where salesID='sl039';
update sales set totals=800 where salesID='sl049';
update sales set totals=9000 where salesID='sl040';
update sales set totals=3000 where salesID='sl041';
update sales set totals=1399 where salesID='sl010';
update sales set totals=699 where salesID='sl011';
update sales set totals=455 where salesID='sl035';
update sales set totals=450 where salesID='sl056';
update sales set totals=900 where salesID='sl057';
update sales set totals=345 where salesID='sl031';
update sales set totals=464 where salesID='sl042';
update sales set totals=918 where salesID='sl012';
update sales set totals=459 where salesID='sl013';
update sales set totals=1377 where salesID='sl014';
update sales set totals=1962 where salesID='sl058';
update sales set totals=654 where salesID='sl059';
update sales set totals=7300 where salesID='sl060';
update sales set totals=10950 where salesID='sl061';
update sales set totals=954 where salesID='sl062';
update sales set totals=1908 where salesID='sl063';
update sales set totals=1335 where salesID='sl064';
update sales set totals=1198 where salesID='sl065';
update sales set totals=1198 where salesID='sl066';
update sales set totals=277 where salesID='sl032';
update sales set totals=885 where salesID='sl015';
update sales set totals=2124 where salesID='sl016';
update sales set totals=177 where salesID='sl017';
update sales set totals=299 where salesID='sl038';
update sales set totals=2990 where salesID='sl067';
update sales set totals=3445 where salesID='sl068';
update sales set totals=689 where salesID='sl069';
update sales set totals=156 where salesID='sl071';
update sales set totals=910 where salesID='sl072';
update sales set totals=4550 where salesID='sl073';
update sales set totals=900 where salesID='sl033';
update sales set totals=684 where salesID='sl074';
update sales set totals=1368 where salesID='sl075';
update sales set totals=4800 where salesID='sl076';
update sales set totals=240 where salesID='sl045';
update sales set totals=600 where salesID='sl077';
update sales set totals=120 where salesID='sl078';
update sales set totals=1500 where salesID='sl079';
update sales set totals=500 where salesID='sl080';
update sales set totals=20 where salesID='sl044';
update sales set totals=35 where salesID='sl050';
update sales set totals=1800 where salesID='sl081';
update sales set totals=1500 where salesID='sl082';
update sales set totals=25 where salesID='sl046';
update sales set totals=150 where salesID='sl083';
update sales set totals=35 where salesID='sl047';
update sales set totals=4000 where salesID='sl084';
update sales set totals=40000 where salesID='sl085';
update sales set totals=30000 where salesID='sl018';
update sales set totals=6000 where salesID='sl019';
update sales set totals=2000 where salesID='sl020';
update sales set totals=4500 where salesID='sl086';
update sales set totals=600 where salesID='sl030';
update sales set totals=400 where salesID='sl037';
update sales set totals=15000 where salesID='sl021';
update sales set totals=2300 where salesID='sl022';
update sales set totals=1000 where salesID='sl023';
update sales set totals=3000 where salesID='sl024';
update sales set totals=3400 where salesID='sl025';
update sales set totals=3000 where salesID='sl088';
update sales set totals=1500 where salesID='sl089';
update sales set totals=6000 where salesID='sl090';
update sales set totals=16800 where salesID='sl026';
update sales set totals=140000 where salesID='sl027';
update sales set totals=28000 where salesID='sl028';
update sales set totals=21000 where salesID='sl029';
update sales set totals=12000 where salesID='sl001';
update sales set totals=30000 where salesID='sl002';
update sales set totals=6000 where salesID='sl003';
update sales set totals=3000 where salesID='sl004';
update sales set totals=6000 where salesID='sl005';
update sales set totals=3000 where salesID='sl006';
update sales set totals=69000 where salesID='sl007';

insert into sales(totals) values (12000) where salesID='sl051';

exec sp_rename 'sales.ItemID' , 'itemID';
