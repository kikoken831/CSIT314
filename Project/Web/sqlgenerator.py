#TODO Generate random insert statements for Transactions
#TODO Generate random insert statements for CartItem
#all should be CSV

#output template
#(1, 1, 1, 1, 'COMPLETED', '2008-11-11 13:23:44', 12.34),
#(1,1,1),

#transactions 1-100
    #table id 1-20
    #cust id 1-100
    #coupon id NULL-5
    #status 'PENDING' or 'COMPLETED'
    #look up random date time generator
    #random value between 50-200.2f
#cartitem tid 1-100 where 3-7 are duplicated
    #item ID 1-15 
    #qty 2-4

import csv
import random
def transMaker():
    f = open("temp.csv","w")
    writer = csv.writer(f)
    for i in range(100):
        tableID = random.randint(1,20)
        custID = random.randint(1,100)
        coupID = random.randint(0,5)
        staffID = random.randint(1,10)
        status = "'COMPLETED'"
        pc = "placeholder"
        price = round(random.uniform(50,100),2)
        li = [tableID,custID,coupID,staffID,status,pc,price]
        writer.writerow(li)

    f.close()

def cartMaker():

    f = open("temp.csv","w")
    writer = csv.writer(f)
    for i in range(1,101):
        transID = i
        uni = []
        for j in range(random.randint(2,6)):
            itemID = random.randint(1,15)
            if(itemID not in uni):
                uni.append(itemID)
                qty = random.randint(1,5)
                li = [f'({transID}',itemID,f'{qty}),']
                writer.writerow(li)
        uni = []
    f.close()

cartMaker()