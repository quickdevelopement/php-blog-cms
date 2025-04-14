

<script>
     const alert = document.getElementById('alert');
    if (alert) {
        setTimeout(function () {
            alert.style.display = 'none';
        }, 5000);
        clearTimeout();
    };

// open-modal for avatar
const uploadImage = document.getElementById('upload-image');
if(uploadImage){
    const closeModal = document.getElementById('close-modal');
    const modal = document.getElementById('default-modal');
    uploadImage.addEventListener('click', () => {
        modal.style.display = 'flex';
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });
    
}

    // Dashboard siderbar

    const sidebar = document.getElementById("sidebar");
    function sidebarMenuFunc() {
        sidebar.classList.toggle("-translate-x-full");
    }
</script>
</body>
</html>