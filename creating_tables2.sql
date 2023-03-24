create table books(
	book_id varchar(5) not null primary key,
    title varchar(100) not null,
    author varchar(100) not null,
    isbn int(13) not null,
    publisher varchar(100) not null,
    date_published date  not null,
    quantity int,
    price int);
alter table books add constraint isbn_unique  unique key (isbn);

create table journals(
	journal_id varchar(10) not null primary key,
    title varchar(100) not null,
    author varchar(100) not null,
    publisher varchar(100) not null,
    date_published date not null,
    quantity int,
    price int);

alter table journals drop column quantity;
alter table journals add quantity int not null after date_published;
alter table journals drop column price;
alter table journals add price int not null;

create table magazines(
	magazine_id varchar(10) not null primary key,
    title varchar(100) not null,
    quantity int not null,
    price int not null);
create table stationery(
	stationery_id varchar(10) not null primary key,
    s_name varchar(100) not null,
    quantity int not null,
    price int not null);
    
create table sports_equipment(
	sport_id varchar(10) not null primary key,
    sp_name varchar(100) not null,
    quantity int not null,
    price int not null);
alter table sports_equipment add brand varchar(50) null default 'generic' after sp_name;
  
  create table computer_accessory(
	compa_id varchar(10) not null primary key,
    ca_name varchar(100) not null,
    quantity int not null,
    price int not null);
alter table computer_accessory add brand varchar(50) null default 'generic' after ca_name;

create table sales(
	sale_id varchar(10) not null primary key,
    item_id varchar(10),
    foreign key (item_id) references books(book_id),
	foreign key (item_id) references journals(journal_id),
	foreign key (item_id) references  magazines(magazine_id),
	foreign key (item_id) references stationery(stationery_id),
	foreign key (item_id) references sports_equipment(sport_id),
	foreign key (item_id) references computer_accessory(compa_id),
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
    item_id varchar(10) not null,
    foreign key (item_id) references books(book_id),
	foreign key (item_id) references journals(journal_id),
	foreign key (item_id) references  magazines(magazine_id),
	foreign key (item_id) references stationery(stationery_id),
	foreign key (item_id) references sports_equipment(sport_id),
	foreign key (item_id) references computer_accessory(compa_id),
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

