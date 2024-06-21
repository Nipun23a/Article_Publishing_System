document.addEventListener('DOMContentLoaded', function() {
    const userPicInput = document.getElementById('user_pic');
    const userPicOutput = document.getElementById('user_pic_output');

    if (userPicInput) {
        userPicInput.addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                userPicOutput.src = URL.createObjectURL(file);
                userPicOutput.style.display = 'block';
            }
        });
    }
});

