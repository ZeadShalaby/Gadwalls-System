const fileUpload = document.getElementById('fileUpload');
const fileIcon = document.getElementById('fileIcon');
const fileError = document.getElementById('fileError');

fileUpload.addEventListener('change', function() {
    if (this.files.length > 0) {
        // تم رفع ملف
        fileIcon.classList.remove('bx-upload');
        fileIcon.classList.add('bx-check-circle'); // تغيير الأيقونة إلى أيقونة النجاح
        fileIcon.style.color = 'green'; // تغيير اللون إلى الأخضر
        fileError.style.display = 'none'; // إخفاء رسالة الخطأ
    } else {
        // لم يتم رفع أي ملف
        fileIcon.classList.add('bx-upload');
        fileIcon.classList.remove('bx-check-circle'); // العودة إلى أيقونة الرفع
        fileIcon.style.color = '#007bff'; // إعادة اللون إلى اللون الافتراضي
        fileError.style.display = 'block'; // إظهار رسالة الخطأ
    }
});
