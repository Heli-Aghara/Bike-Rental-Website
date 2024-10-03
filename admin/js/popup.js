/*const qty_popup = document.querySelector('.qty_popup');
const update_btn = document.querySelector('.update_btn');
// const update_btns = document.querySelectorAll('.update_btn');
const close_btn = document.querySelector('.close_btn');
console.log(update_btn);
console.log(qty_popup);

update_btn.addEventListener('click', ()=> {
    qty_popup.showModal();
})

close_btn.addEventListener('click', ()=> {
    qty_popup.close();

})

// update_btns.forEach(update_btn => {
//     update_btn.addEventListener('click', function() {
//       // Display dialog for the button clicked
//       // You can customize this part to show your dialog box
//       qty_popup.showModal();
//     });
//   });*/

// Select all update buttons and close buttons
const updateButtons = document.querySelectorAll('.update_btn');
const closeButton = document.querySelector('.close_btn');
const qtyPopup = document.querySelector('.qty_popup');

// Loop through all update buttons
updateButtons.forEach((button, index) => {
  button.addEventListener('click', function() {
    // Get the stock_id for the clicked row
    const stockId = button.closest('tr').querySelector('th').innerText;
    
    // Set the stock_id value in the dialog's hidden input
    document.querySelector('input[name="stock_id"]').value = stockId;
    
    // Display the dialog
    qtyPopup.showModal();
  });
});

// Add event listener to close the dialog
closeButton.addEventListener('click', () => {
  qtyPopup.close();
});
