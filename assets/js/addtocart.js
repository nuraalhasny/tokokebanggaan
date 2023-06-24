
var removeCartItemButton = document.getElementsByClassName('remove')
console.log(removeCartItemButton)
for (var i = 0; i < removeCartItemButton.length; i++) {
    var button = removeCartItemButton[i]
    button.addEventListener('click', removeCartItem) 

}

function removeCartItem(event){
    var buttonClicked = event.target
    buttonClicked.parentElement.parentElement.parentElement
    .parentElement.parentElement.parentElement.remove()
    updateCartTotal()
}
function addToCart() {
    var productName = document.querySelector(".product-name").textContent;
    var productPrice = document.querySelector(".product-price").textContent;
  
  
    var item = {
      name: productName,
      price: productPrice
    };
    cart.push(item);
  }