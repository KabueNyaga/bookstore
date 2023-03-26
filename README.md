    BOOK STORE
Tables
    1.Inventory
        -item id
        -item category
        -item name
        -item quantity
        -item cost
    2.Sales
        -sale id
        -item(foreign key from inventory)
        -mode of payment
        -date of purchase
        -quantity
        -total price
    3.Client orders
        -client id
        -first name
        -second name
        -email
        -phone
        -order id(foreign key from orders table)
    4.Supplier
        -supplier id
        -name
        -email
        -phone
        -address
    5.Orders
        -order id
        -item id
        -quantity
        -price per item 
        -supplier id(foreign key from supplies table)
    6.Deliverlies
        -deliverly id
        -order id(foreign key form orders)
        -deliverly date
    7.Supplier payment
        -payment id
        -deliverly id(foreign key from delivery table)
        -date of payment
        -amount paid

Website
    -login for the library admin (DONE)
    -see all inventory
    -form for adding inventory
    -search for an inventory
    -see sales(join with inventory for more detailed view)
    -automatically add inventory sold to sales and reduce quantity
    -if client orders an item not in inventory create the order and if delivered add to inventory and mail sent to client if   delivered
    -if a supplier delivers an invoice is generated and amount paid. 