const body = document.querySelector("body"),
    sidebar = body.querySelector("nav"),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box");

// استرجاع الحالة من localStorage
if (localStorage.getItem("sidebarClosed") === "true") {
    sidebar.classList.add("close");
}

// إضافة حدث النقر على الزر لفتح وإغلاق الشريط الجانبي
toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    // حفظ الحالة في localStorage
    localStorage.setItem("sidebarClosed", sidebar.classList.contains("close"));
});

// عند النقر على صندوق البحث، يتم فتح الشريط الجانبي
searchBtn.addEventListener("click", () => {
    sidebar.classList.remove("close");
    localStorage.setItem("sidebarClosed", "false"); // تحديث الحالة في localStorage
});
