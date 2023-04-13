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
create procedure select_sale @saleID nvarchar(255) as select sales.salesID,sales.Date_of_purchase,sales.Mode_of_payment,inventory.ItemID,inventory.Item_category, inventory.Item_name,sales.Quantity,inventory.Cost,sales.totals  from inventory inner join sales on sales.itemID=inventory.ItemID  where salesID =@saleID;
exec select_sale @saleID='sl001';
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
exec sp_rename 'Deliveries.orderID', 'deliveryID';
use bookstore;
select * from orders;

create procedure select_sale @saleID nvarchar(255) as select sales.salesID,sales.Date_of_purchase,sales.Mode_of_payment,inventory.ItemID,inventory.Item_category, inventory.Item_name,sales.Quantity,inventory.Cost,sales.totals  from inventory inner join sales on sales.itemID=inventory.ItemID  where salesID =@saleID;
exec select_sale @saleID='sl001';
create procedure select_ord @orderID nvarchar(255) as select  orders.OrderID,orders.Item_ID,inventory.Item_name,orders.Qty_ordered,orders.SupplierID,suppliers.s_name,orders.Date_of_order from orders join inventory on inventory.ItemID=orders.Item_ID join suppliers on suppliers.supplierID=orders.SupplierID where OrderID=@orderID;
exec select_ord @orderID='od002';
use bookstore;
select * from Client_orders;
select Client_orders.client_orderID,Client_orders.client_ID,Client_orders.client_name,Client_orders.client_email,Client_orders.OrderID,orders.Item_ID,inventory.Item_name,orders.Qty_ordered,orders.Date_of_order from Client_orders join orders on orders.OrderID=Client_orders.OrderID join inventory on inventory.ItemID=orders.Item_ID ;
create procedure select_clo @cloID nvarchar(255) as select Client_orders.client_orderID,Client_orders.client_ID,Client_orders.client_name,Client_orders.client_email,Client_orders.OrderID,orders.Item_ID,inventory.Item_name,orders.Qty_ordered,orders.Date_of_order from Client_orders join orders on orders.OrderID=Client_orders.OrderID join inventory on inventory.ItemID=orders.Item_ID where client_orderID=@cloID; ;
exec select_clo @cloID='clo001';
drop procedure select_clo;
select * from Deliveries;
select Deliveries.OrderID,Deliveries.Date_delivered,Deliveries.supplierID,suppliers.s_name from Deliveries inner join suppliers on suppliers.supplierID=Deliveries.supplierID;
create procedure select_del @delID nvarchar(255) as select 
	Deliveries.OrderID,
	orders.Item_ID,
	inventory.Item_name,
	Deliveries.Date_delivered,
	Deliveries.supplierID,
	suppliers.s_name
	from Deliveries join 
	orders on orders.OrderID=Deliveries.OrderID join
	inventory on inventory.ItemID=orders.Item_ID join
	suppliers on suppliers.supplierID=Deliveries.supplierID where Deliveries.OrderID=@delID;
exec select_del @delID='od010';
drop procedure select_del;
alter table Deliveries alter column Date_delivered date;

select 
	Deliveries.OrderID,
	orders.Item_ID,
	inventory.Item_name,
	Deliveries.Date_delivered,
	Deliveries.supplierID,
	suppliers.s_name
	from Deliveries join 
	orders on orders.OrderID=Deliveries.OrderID join
	inventory on inventory.ItemID=orders.Item_ID join
	suppliers on suppliers.supplierID=Deliveries.supplierID;

	select * from Suplier_payment;
	select 
		Suplier_payment.paymentID,
		Suplier_payment.supplierID,
		suppliers.s_name,
		Suplier_payment.amount_paid,
		Suplier_payment.payment_method,
		Suplier_payment.Date_of_payment from Suplier_payment join
		suppliers on suppliers.supplierID=Suplier_payment.supplierID;

create procedure select_supp_pay @payID nvarchar(255) as select 
		Suplier_payment.paymentID,
		Suplier_payment.supplierID,
		suppliers.s_name,
		Suplier_payment.amount_paid,
		Suplier_payment.payment_method,
		Suplier_payment.Date_of_payment from Suplier_payment join
		suppliers on suppliers.supplierID=Suplier_payment.supplierID where Suplier_payment.paymentID=@payID;

	exec select_supp_pay @payID='p002';
	alter table Suplier_payment alter column Date_of_payment date;

	SELECT sales.ItemID, SUM(sales.quantity * Inventory.Cost) AS total_rev FROM sales
INNER JOIN  Inventory ON sales.ItemID =Inventory.ItemID
WHERE sales.Date_of_purchase BETWEEN '2022/06/01' AND '2022/12/31'
GROUP BY sales.ItemID;

SELECT itemID,quantity, 
CASE 
	WHEN quantity >50 THEN 'High'
	WHEN quantity >10 THEN 'Average'
	ELSE 'Low'
	END AS comment
FROM Inventory;

use master;
	grant connect SQL to bookstore;

select SCHEMA_NAME();
select * from sys.schemas;

use bookstore;

create database Bookstore_db;
use Bookstore_db;


-----------CREATING TABLES-----------
create table inventory(
	item_id varchar(10) not null primary key,
    item_category varchar(50) not null,
    item_name varchar (50) not null,
    quantity int not null,
    cost money not null,
	constraint CK_inventory_cost
	CHECK (cost > 0),
	supplierID varchar(10) not null,
	--constraint FK_suppliers_inventory
	--foreign key (supplierID) references suppliers(supplierID)
	);
	

    

    
create table sales(
	sale_id varchar(10) not null primary key,
    itemId varchar(10),
    --constraint FK_inventory_sales
    --foreign key (itemId) references inventory(itemId),
	mode_of_payment varchar(15) not null,
	CONSTRAINT CK_paymentMode
    CHECK (Mode_of_Payment IN ('Cash','Cheque','Credit_card')),
    date_of_purchase date not null,
    quantity int not null,
    total_price int); 
    
create table suppliers (
	supplier_id varchar(10) not null primary key,
    s_name varchar(50) not null,
    phone int not null unique,
    address varchar(50) not null
);

create table orders(
	order_id varchar(10) not null primary key,
    Item_id varchar(10) not null,
    --constraint FK_orders_inventory
    --foreign key (item_Id) references inventory(itemId),
    quantity int not null,
    supplierid varchar(10) not null,
    --foreign key (supplierid) references suppliers(supplierId),
	date_of_order date not null
);


create table client_orders(
	client_orderid varchar(10) not null primary key,
	client_id varchar(15) not null,
    client_name varchar(50) not null,
    client_email varchar(50) unique,
    Orderid varchar(10) not null,
    --foreign key (orderid) references orders(orderId),
	quantity int not null
    );

    create table deliveries(
		deliverly_id varchar(10) not null primary key,
        date_delivered date not null,
		Invoice_no varchar(50) not null,
		supplierID varchar(10),
		--foreign key(supplierID) references suppliers(supplierID)
);


create table suplier_payment(
	paymentid varchar(10) not null primary key,
    supplierId varchar(10) not null,
    --foreign key (supplierId) references suppliers(supplierID),
    date_of_payment date not null,
    payment_method varchar(15),
    amount_paid money not null DEFAULT 0,
	orderID varchar(10),
	--foreign key (orderID) references orders(orderID),
	);


------------------ALTERING TALBLES---------------------



ALTER TABLE inventory
ADD constraint FK_suppliers_inventory
FOREIGN KEY (supplierID) REFERENCES suppliers(supplierID);


ALTER TABLE inventory
ADD constraint CK_inventory_cost
CHECK (Cost > 0);
 

ALTER TABLE sales
ADD constraint FK_inventory_sales
FOREIGN KEY (ItemID) REFERENCES inventory(ItemID);

ALTER TABLE suppliers
ADD CONSTRAINT UQ_Suppliers_tel_no
UNIQUE(Tel_no);
select * from suppliers;
ALTER TABLE orders
ADD constraint FK_inventory_orders
FOREIGN KEY (Item_ID) REFERENCES inventory(ItemID);

ALTER TABLE orders
ADD constraint FK_supplier_orders
FOREIGN KEY (SupplierID) REFERENCES suppliers(supplierID);

ALTER TABLE Client_orders
ADD constraint UQ_email_clientOrders
UNIQUE(client_email);

ALTER TABLE Client_orders
ADD CONSTRAINT FK_orders_clientOrders
FOREIGN KEY (orderID) REFERENCES orders(orderID);

ALTER TABLE Deliveries
ADD CONSTRAINT FK_suppliers_deliveries
FOREIGN KEY (supplier_id) REFERENCES suppliers(supplierID);

ALTER TABLE Suplier_payment
ADD CONSTRAINT FK_suppliers_supplierPayment
FOREIGN KEY (supplierID) REFERENCES suppliers(supplierID);

ALTER TABLE Suplier_payment
ADD orderID nvarchar(20);




ALTER TABLE Suplier_payment
ADD CONSTRAINT DF_payment_amount
DEFAULT 0 FOR amount_paid;

select * from Deliveries;
exec sp_help Deliveries;

select Deliveries.deliveryID,Deliveries.Date_delivered,Deliveries.supplier_id,suppliers.s_name from Deliveries inner join suppliers on suppliers.supplierID=Deliveries.supplier_id;

select 
	Deliveries.deliveryID,
	orders.Item_ID,
	inventory.Item_name,
	Deliveries.Date_delivered,
	Deliveries.supplier_id,
	suppliers.s_name
	from Deliveries join 
	orders on orders.OrderID=Deliveries.deliveryID join
	inventory on inventory.ItemID=orders.Item_ID join
	suppliers on suppliers.supplierID=Deliveries.supplier_id;

create procedure select_del @delID nvarchar(25) as select 
Deliveries.deliveryID,
orders.Item_ID,
inventory.Item_name,
Deliveries.Date_delivered,
Deliveries.supplier_id,
suppliers.s_name
from Deliveries join 
orders on orders.OrderID=Deliveries.deliveryID join
inventory on inventory.ItemID=orders.Item_ID join
suppliers on suppliers.supplierID=Deliveries.supplier_id where Deliveries.deliveryID=@delID;
	drop procedure select_del;

select * from inventory;
select * from Client_orders;
sp_helplogins;
alter table suplier_payment  add constraint FK_supplierpayment_orders foreign key (orderID) references orders(OrderID);
alter table suplier_payment alter column orderID varchar(10);