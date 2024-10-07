document.querySelectorAll(".custom-file-upload").forEach(function (upload) {
    upload.addEventListener("click", function () {
        this.querySelector('input[type="file"]').click();
    });
});
document.addEventListener("DOMContentLoaded", function () {
    // Automatically get the location when the page loads
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                const locationText = `Latitude: ${latitude}, Longitude: ${longitude}`;
                document.getElementById("locations").value = locationText;
            },
            function (error) {
                console.error("Error getting location: " + error.message);
            }
        );
    } else {
        console.error("Geolocation is not supported by this browser.");
    }
});

// Handle file upload icons
function updateCoverIcon(inputId) {
    const bookCoverInput = document.getElementById("bookCover");
    const bookCoverIcon = document.getElementById("bookCoverIcon");
    const bookCoverText = document.getElementById("bookCoverText");

    if (bookCoverInput.files.length > 0) {
        bookCoverIcon.classList.remove("fas", "fa-upload");
        bookCoverIcon.classList.add("fas", "fa-check-circle");
        bookCoverText.textContent = "Cover selected";
    } else {
        bookCoverIcon.classList.remove("fas", "fa-check-circle");
        bookCoverIcon.classList.add("fas", "fa-upload");
        bookCoverText.textContent = "Choose a book cover";
    }

    const bookFileInput = document.getElementById("bookFile");
    const bookFileIcon = document.getElementById("bookFileIcon");
    const bookFileText = document.getElementById("bookFileText");

    if (bookFileInput.files.length > 0) {
        bookFileIcon.classList.remove("fas", "fa-upload");
        bookFileIcon.classList.add("fas", "fa-check-circle");
        bookFileText.textContent = "File selected";
    } else {
        bookFileIcon.classList.remove("fas", "fa-check-circle");
        bookFileIcon.classList.add("fas", "fa-upload");
        bookFileText.textContent = "Choose a book file";
    }

    const input = document.getElementById(inputId);
    const icon = document.getElementById(inputId + "Icon");

    if (input.files.length > 0) {
        // إذا تم اختيار ملف، غير لون الأيقونة إلى الأخضر
        icon.style.color = "green";
    } else {
        // إذا لم يتم اختيار ملف، غير لون الأيقونة إلى الأسود
        icon.style.color = "black";
    }
}
