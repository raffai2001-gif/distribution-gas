function showForm(formId){
    document.querySelectorAll(".form-box").forEach(form => form.classList.remove("active"));
    document.getElementById(formId).classList.add("active");
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.order-box form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const name = form.name.value.trim();
            const address = form.address.value.trim();
            const phone = form.phone.value.trim();
            const role = form.role.value;
            
            if (!name || !address || !phone || !role) {
                e.preventDefault(); // يمنع الإرسال لو في خانة فاضية
                alert("يرجى ملء جميع الخانات");
            }
        });
    }
});