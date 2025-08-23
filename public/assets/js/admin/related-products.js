/**
 * Related Products Management for Admin Panel
 */

document.addEventListener('DOMContentLoaded', function() {
    initializeRelatedProducts();
});

function initializeRelatedProducts() {
    const addButton = document.getElementById('add-related-product');
    const container = document.getElementById('related-products-container');
    
    if (!addButton || !container) return;
    
    // Add new related product row
    addButton.addEventListener('click', function() {
        const newRow = createRelatedProductRow();
        container.appendChild(newRow);
        updateRemoveButtons();
    });
    
    // Handle remove button clicks
    container.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-related-product') || e.target.closest('.remove-related-product')) {
            const row = e.target.closest('.related-product-row');
            if (row) {
                row.remove();
                updateRemoveButtons();
            }
        }
    });
    
    // Initial update
    updateRemoveButtons();
}

function createRelatedProductRow() {
    const container = document.getElementById('related-products-container');
    const firstRow = container.querySelector('.related-product-row');
    
    if (!firstRow) return null;
    
    const row = document.createElement('div');
    row.className = 'related-product-row mb-3';
    
    // Get the products options from the first row
    const firstSelect = firstRow.querySelector('select[name="related_products[]"]');
    const optionsHtml = firstSelect ? firstSelect.innerHTML : '';
    
    row.innerHTML = `
        <div class="row align-items-end">
            <div class="col-md-6">
                <label class="form-label">اختر منتج ذو صلة</label>
                <select name="related_products[]" class="form-select">
                    ${optionsHtml}
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">نوع العلاقة</label>
                <select name="related_product_types[]" class="form-select">
                    <option value="frequently_bought_together">يُشترى مع بعض غالباً</option>
                    <option value="recommended">منتجات مُوصى بها</option>
                    <option value="similar">منتجات مشابهة</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-related-product">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    `;
    
    // Reset the select value to empty
    const newSelect = row.querySelector('select[name="related_products[]"]');
    if (newSelect) {
        newSelect.value = '';
    }
    
    return row;
}

function updateRemoveButtons() {
    const container = document.getElementById('related-products-container');
    if (!container) return;
    
    const rows = container.children;
    const removeButtons = container.querySelectorAll('.remove-related-product');
    
    removeButtons.forEach(button => {
        button.style.display = rows.length > 1 ? 'block' : 'none';
    });
}

// Export functions for global access if needed
window.RelatedProducts = {
    initialize: initializeRelatedProducts,
    createRow: createRelatedProductRow,
    updateButtons: updateRemoveButtons
};
