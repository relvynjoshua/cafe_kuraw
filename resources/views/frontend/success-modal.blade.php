<!-- Success Modal -->
<div id="successModal" class="simple-modal" style="display: none;"> <!-- Hide modal initially -->
    <div class="simple-modal-content">
        <button class="simple-close-btn" id="closeModalBtn">&times;</button>
        <h5>Order Confirmation</h5>
        <p>Your order has been successfully placed! Your order is currently being processed.</p>
        <button class="btn btn-primary" id="confirmOrderBtn">OK</button>
    </div>
</div>

<style>
/* Simple Modal Styles */
.simple-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    display: none;  /* Initially hidden */
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.simple-modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    width: 300px;
}

.simple-close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    background: none;
    border: none;
    cursor: pointer;
}

.simple-close-btn:hover {
    color: red;
}

#confirmOrderBtn {
    background-color: green;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
}

#confirmOrderBtn:hover {
    background-color: darkgreen;
}

</style>