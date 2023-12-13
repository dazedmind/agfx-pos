let selectBtn = document.querySelectorAll('.btn-selector');
let popUp = document.getElementById('popup')
let popupBtn = document.getElementById('popup-btn')
let cancelBtn = document.getElementById('cancel-btn')

// INPUTS
let productCode = document.getElementById('product-code');
let productQty = document.getElementById('qty');

// PRODUCT ID
let bnwPrint = document.getElementById('bnw-print')
let coloredPrint = document.getElementById('colored-print')
let bnwImage = document.getElementById('bnw-img')
let coloredImage = document.getElementById('colored-img')
let idPackageA = document.getElementById('id-pkg-a')
let idPackageB = document.getElementById('id-pkg-b')
let editFee = document.getElementById('edit-fee')
let photoCopy = document.getElementById('photocopy')
let photoCopyB2B = document.getElementById('photocopy-b2b')

let promoPrint = document.getElementById('promo-print')
let promoXerox = document.getElementById('promo-xerox')
let promoImage = document.getElementById('promo-image')

let gcashInOut = document.getElementById('gcash')
// TOTAL
let subTotalBox = document.getElementById('total-box')
let totalTableBody = document.getElementById('total-table-body'); 
let saveBtn = document.getElementById('save-btn'); // Add this line

let selectedItems = [];
let totalAmount;
let price;
let productName;

let grandTotal = document.getElementById('grand-total');

// Create a workbook and worksheet
const wb = XLSX.utils.book_new();
const ws = XLSX.utils.aoa_to_sheet([['Product', 'Amount']]);
const clearBtn = document.getElementById('clear-btn');

// Cancel Button Function
cancelBtn.addEventListener('click', () => {
    popUp.classList.remove('open-popup');
})

selectBtn.forEach((btn) => {
    btn.addEventListener('click', () => {
        switch(btn.id){
            case 'bnw-print':
                price = 10;
                productName = 'BNW Print';
                productCode.value = 1;
                break;
            case 'colored-print':
                price = 15;
                productName = 'Colored Print';
                productCode.value = 2;
                break;
            case 'id-pkg-a':
                price = 65;
                productName = 'ID Package A';
                productCode.value = 3;
                break;
            case 'id-pkg-b':
                price = 65;
                productName = 'ID Package B';
                productCode.value = 4;
                break;
            case 'edit-fee':
                price = 15;
                productName = 'Edit Fee';
                productCode.value = 5;
                break;
            case 'bnw-img':
                price = 10;
                productName = 'BNW Image';
                productCode.value = 6;
                break;
            case 'colored-img':
                price = 25;
                productName = 'Colored Image';
                productCode.value = 7;
                break;
            case 'photocopy':
                price = 3;
                productName = 'Photocopy';
                productCode.value = 8;
                break;
            case 'photocopy-b2b':
                price = 6;
                productName = 'Photocopy Back-to-back';
                productCode.value = 9;
                break;
            case 'promo-print':
                price = 5;
                productName = 'Student BNW/Colored Print';
                productCode.value = 10;
                break;
            case 'promo-xerox':
                price = 3;
                productName = 'Student Photocopy';
                productCode.value = 11;
                break;
            case 'promo-image':
                price = 10;
                productName = 'Student Colored Image';
                productCode.value = 12;
                break;
            case 'gcash':
                    price = 10;
                    productName = 'GCash In/Out';
                    productCode.value = 13;
                    break;
        }
        popUp.classList.add('open-popup');
    });
});

saveBtn.addEventListener('click', () => {
    exportToExcel();
});

popupBtn.addEventListener('click', () => {
    // Check if productQty has a valid value
     if (productQty.value > 0) {
         totalAmount = price * productQty.value;
         // Add the selected item to the array
         selectedItems.push({ productName, totalAmount });

         updateTotalTable();
         updateGrandTotal(); // Add this line
     }

     popUp.classList.remove('open-popup');
 });

 function updateTotalTable() {
     // Clear the existing content of the table body
     totalTableBody.innerHTML = '';

     // Populate the table with the selected items
     selectedItems.forEach((item, index) => {
        let row = totalTableBody.insertRow();
         let cell1 = row.insertCell(0);
         let cell2 = row.insertCell(1);
        let cell3 =row.insertCell(2);

        cell1.textContent = item.productName;
        cell2.textContent = `₱${item.totalAmount}`;
    
        // Create a delete button
        let deleteButton = document.createElement('button');
        deleteButton.classList.add('remove-btn');
        deleteButton.innerHTML = '<i class="fa-solid fa-square-minus"></i>';
        deleteButton.addEventListener('click', () => {
            // Call a function to handle the deletion when the button is clicked
            deleteProduct(index, row);
        });

        // Append the button to the cell
        cell3.appendChild(deleteButton);
    });
 }

 function updateGrandTotal() {
    // Calculate the Grand Total
    let sumAmount = selectedItems.reduce((total, item) => total + item.totalAmount, 0);
    grandTotal.textContent = `Grand Total: ₱${sumAmount}`;
}

function deleteProduct(index, row) {
    // Remove the corresponding item from the selectedItems array
    selectedItems.splice(index, 1);

    // Remove the corresponding row from the table
    totalTableBody.removeChild(row);

    // Update the grand total
    updateGrandTotal();
}

function exportToExcel() {
    // Append the selected items to the existing worksheet
    selectedItems.forEach((item) => {
        XLSX.utils.sheet_add_aoa(ws, [[item.productName, item.totalAmount]], { origin: -1 });
    });

    // Save the workbook to a file
    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
    XLSX.writeFile(wb, 'selectedItems.xlsx');
}

clearBtn.addEventListener('click', () => {
    // Reset variables
    selectedItems = [];
    totalAmount = 0;
    price = 0;
    productName = '';

    // Clear the table
    totalTableBody.innerHTML = '';

    // Update the grand total
    updateGrandTotal();
});