<?php
include 'Entity/Transaction.php';
class TransactionController
{
    private $T_List;
    public function getPendingList(){
        if(Transaction::getPending() != null)
        {
            return Transaction::getPending();
        }
        else{
            return null;
        }
    }
    public function getCompletedList()
    {
        return Transaction::getCompleted();
    }
    public function getCartItems($id){
        return Transaction::getItems($id);
    }
    public function getOrderHistory($id)
    {
        return Transaction::getHistory($id);
    }
    public function setOrder($id)
    {
        Transaction::updateStatus($id);
    }
}