function redirectToOrderPage(itemName, price, imageUrl) {
    window.location.href = `ordermenu.html?name=${itemName}&price=${price}&image=${encodeURIComponent(imageUrl)}`;
}
