document.addEventListener("DOMContentLoaded", function () {
    window.onload = function () {
        const notificationContainer = document.querySelector(
            ".notification-container"
        );

        setTimeout(() => {
            if (notificationContainer) {
                notificationContainer.style.display = "block";

                const notifications = document.querySelectorAll(
                    ".notification-alert"
                );

                notifications.forEach((notification) => {
                    setTimeout(() => {
                        notification.classList.add("remove-animation");

                        setTimeout(() => {
                            notification.remove();
                        }, 500);
                    }, 10000);

                    const readButton = notification.querySelector(
                        ".mark-as-read-button"
                    );
                    readButton.addEventListener("click", function () {
                        notification.classList.add("remove-animation");
                        setTimeout(() => {
                            notification.remove();
                        }, 500);
                    });
                });
            }
        }, 2200);
    };
});
