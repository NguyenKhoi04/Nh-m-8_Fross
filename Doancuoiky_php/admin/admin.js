function checkLoginForm() {
    var username = document.forms["formDangnhap"]["txtTenDangNhap"].value;
    var password = document.forms["formDangnhap"]["txtMatKhau"].value;
    if (username == "") {
        alert("Tên đăng nhập không được để trống");
        return ;
    }
    if (password == "") {
        alert("Mật khẩu không được để trống");
        return ;
    }
    document.forms["formDangnhap"].submit();
}
// Khi tài liệu load xong
document.addEventListener("DOMContentLoaded", () => {
  // ====== 1️⃣ Dropdown menu toggle ======
  const dropdowns = document.querySelectorAll(".dropdown-btn");
  dropdowns.forEach(btn => {
    btn.addEventListener("click", () => {
      const parent = btn.parentElement;
      parent.classList.toggle("active");
    });
  });

  // ====== 2️⃣ Giữ nguyên header/footer, chỉ thay đổi nội dung section ======
  const links = document.querySelectorAll("a[data-link]");
  const content = document.getElementById("content");

  links.forEach(link => {
    link.addEventListener("click", async (e) => {
      e.preventDefault();
      const url = link.getAttribute("href");

      try {
        const response = await fetch(url);
        if (!response.ok) throw new Error("Không thể tải trang");
        const html = await response.text();

        // Tạo DOM ảo để chỉ lấy phần <section>
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, "text/html");
        const newSection = doc.querySelector("section");

        // Lưu lại vị trí cuộn hiện tại
        const oldScroll = window.scrollY;

        // Cập nhật nội dung
        content.innerHTML = newSection ? newSection.innerHTML : html;

        // Giữ nguyên vị trí cuộn nếu nội dung mới ngắn
        if (document.body.scrollHeight > window.innerHeight) {
          window.scrollTo(0, oldScroll);
        }

        // Cập nhật URL hiển thị (nhưng không reload)
        history.pushState(null, "", url);

      } catch (error) {
        console.error("Lỗi khi tải nội dung:", error);
        content.innerHTML = "<p style='color:red'>Không thể tải nội dung.</p>";
      }
    });
  });

  // ====== 3️⃣ Xử lý khi nhấn Back / Forward trên trình duyệt ======
  window.addEventListener("popstate", async () => {
    const response = await fetch(location.href);
    const html = await response.text();
    const parser = new DOMParser();
    const doc = parser.parseFromString(html, "text/html");
    const newSection = doc.querySelector("section");
    content.innerHTML = newSection ? newSection.innerHTML : html;
  });
});

