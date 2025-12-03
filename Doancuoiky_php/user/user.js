document.addEventListener("DOMContentLoaded", function() {
  document.querySelectorAll('.dropdown').forEach(dropdown => {
    const btn = dropdown.querySelector('.dropdown-btn');

    btn.addEventListener('click', function(e) {
      e.stopPropagation(); // Ngăn lan sự kiện

      const isOpen = dropdown.classList.contains('show');

      // Đóng tất cả dropdown khác
      document.querySelectorAll('.dropdown').forEach(d => {
        if (d !== dropdown) d.classList.remove('show');
      });

      // Toggle dropdown hiện tại
      dropdown.classList.toggle('show', !isOpen);
    });
  });

  // Xử lý click vào item
  document.querySelectorAll('.dropdown-list div').forEach(item => {
    item.addEventListener('click', function(e) {
      e.stopPropagation();
      const value = this.getAttribute('data-value');
      const text = this.textContent.trim();

      // Cập nhật nút
      const btn = this.closest('.dropdown').querySelector('.dropdown-btn');
      btn.innerHTML = text + ' <span class="arrow">▾</span>';

      // Gọi hàm lọc
      filterCategory(value);

      // Đóng dropdown
      this.closest('.dropdown').classList.remove('show');
    });
  });

  // Click ngoài đóng dropdown
  document.addEventListener('click', function() {
    document.querySelectorAll('.dropdown').forEach(d => d.classList.remove('show'));
  });
});


//JS gọi PHP và đổ ra HTML

function loadProducts() {
    const filter = document.querySelector('.dropdown[data-type="filter"] .selected')?.dataset.value || "all";
    const category = document.querySelector('.dropdown[data-type="category"] .selected')?.dataset.value || "all";
    const price = document.querySelector('.dropdown[data-type="price"] .selected')?.dataset.value || "all";

    fetch(`/user/load_products.php?filter=${filter}&category=${category}&price=${price}`)
        .then(res => res.json())
        .then(products => displayProducts(products));
}

//DISPLAY PRODUCTS (đã thêm giảm giá + thành tiền)
function displayProducts(products) {
    const grid = document.getElementById('productGrid');
    grid.innerHTML = '';

    products.forEach(p => {
        let oldPrice = formatPrice(p.gia);
        let finalPrice = p.giam_gia > 0 ? formatPrice(p.gia - (p.gia * p.giam_gia / 100)) : oldPrice;

        const discountHTML = p.giam_gia > 0
            ? `<span class="product-discount">-${p.giam_gia}%</span>`
            : "";

        const priceHTML = p.giam_gia > 0
            ? `<div class="product-price">
                    <span class="old-price">${oldPrice}</span>
                    <span class="final-price">${finalPrice}</span>
               </div>`
            : `<div class="product-price">${oldPrice}</div>`;

        const card = `
        <div class="product-card">
            <div class="product-image">
                <img src="${p.hinh_anh}" alt="${p.ten_san_pham}">
                ${discountHTML}
            </div>
            <div class="product-info">
                <h3>${p.ten_san_pham}</h3>
                <p class="product-description">${p.mo_ta}</p>
                <div class="product-footer">
                    ${priceHTML}
                    <div class="product-actions">
                        <button class="action-btn view-btn" onclick="viewProduct(${p.id})">👁️</button>
                        <button class="action-btn cart-btn" onclick="quickAddToCart(${p.id})">🛒</button>
                    </div>
                </div>
            </div>
        </div>`;

        grid.innerHTML += card;
    });
}
